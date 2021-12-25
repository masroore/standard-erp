<?php
namespace App\Http\Repositories\Tickets;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\TicketAttachment;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\Tickets\TicketInterface;
use App\Models\Customer;
use App\Models\Hr\HrDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;

class TicketRepository implements TicketInterface
{
    use ApiDesignTrait;

    private $ticketModel;
    private $attachModel;
    private $replyModel;

    public function __construct(Ticket $ticket, TicketAttachment $attach, TicketReply $reply)
    {
        $this->ticketModel = $ticket;
        $this->attachModel = $attach;
        $this->replyModel = $reply;
    }

    public function index(){
      $tickets =  $this->ticketModel::select('id', 'subject' , 'status', 'priority' , 'start_at' , 'description','customer_id','department_id','is_moved')
                                    ->with('users:id', 'department:id,name_ar,name_en', 'customer:id,name')->get();
       $departments = HrDepartment::get();
       $customers  = Customer::get();
       $users = User::get();
    //    dd($tickets);
        $routeName = 'tickets';
        return view('backend.tickets.index',compact('routeName','tickets','departments','customers','users'));
    }//end of index

    public function show($id){
       $ticket =  $this->ticketModel::where('id',$id)->select('id', 'subject' , 'status', 'priority' , 'start_at' , 'description','customer_id','department_id')
                                    ->with('users:id,name','moved:id,name','ticketReplies.replyAttachments','ticketReplies.user','ticketAttachments:id,file,type,link,ticket_id', 'department:id,name_ar,name_en', 'customer:id,name')->first();
        $users = User::get();

        $routeName = 'tickets';
        return view('backend.tickets.show',compact('routeName','ticket','users'));
    }// end of destroy

    public function store($request){


        $request->validate([
                'subject'          => 'required|string|min:4|unique:tickets,subject',
                'status'           => 'required|string',
                'priority'         =>'required|string',
                'start_at'         =>'required',
                'description'      => 'required|string',
                'customer_id'      => 'exists:customers,id|nullable',
                'department_id'      => 'exists:hr_departments,id|nullable',
                'users[]'            => 'exists:users,id|nullable',
                'files[]'            => 'nullable|mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip',

        ]);

        $requestArray = $request->all();

             $ticket = $this->ticketModel;
             $ticket->start_at = Carbon::parse($request->start_at);
             $ticket->subject = $request->subject;
             $ticket->status = $request->status;
             $ticket->priority = $request->priority;
             $ticket->department_id = $request->department_id;
             $ticket->customer_id = $request->customer_id;
             $ticket->description = $request->description;
             $ticket->save();

             $ticket->users()->sync($requestArray['users']);




        if(isset($requestArray['files']) && !empty($requestArray['files'])){

            foreach($requestArray['files'] as $file){

                $image_64 = $file; //your base64 encoded data
                $extension = $file->getClientOriginalExtension();
                $replace = substr($image_64, 0, strpos($image_64, ',')+1);
                $image = str_replace($replace, '', $image_64);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10).'.'.$extension;
                $file->move(public_path('uploads/tickets/documents/'), $imageName);


                $file_bath = 'uploads/tickets/documents/'.$imageName;

                $this->attachModel::create([
                    'ticket_id' => $ticket->id,
                    'file' => $imageName ,
                    'type' => $extension,
                    'link' => $file_bath
                    ]);


            }// end foreach
        } // end of assign files
         // store tickets attachment


        if( config('app.locale') == 'ar'){
            alert()->success('تم الانشاء بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.tickets.index');

    }// end of store

    public function update($request,$id){


        $request->validate([
            'subject'          => 'required|string|min:4',
            'status'           => 'required|string',
            'priority'         =>'required|string',
            'start_at'         =>'required',
            'description'      => 'required|string',
            'customer_id'      => 'exists:customers,id|nullable',
            'department_id'      => 'exists:hr_departments,id|nullable',
            'users'            => 'exists:users,id|nullable',
            'files[]'            => 'nullable|mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip',

        ]);
        $requestArray = $request->all();
            $ticket =   $this->ticketModel::FindOrFail($id);
            $ticket->start_at = Carbon::parse($request->start_at);
            $ticket->subject = $request->subject;
            $ticket->status = $request->status;
            $ticket->priority = $request->priority;
            $ticket->department_id = $request->department_id;
            $ticket->customer_id = $request->customer_id;
            $ticket->description = $request->description;

            $ticket->save();
            $ticket->users()->sync([Auth::user()->id]);


            if(isset($requestArray['files']) && !empty($requestArray['files'])){

                foreach($requestArray['files'] as $file){

                    $image_64 = $file; //your base64 encoded data
                    $extension = $file->getClientOriginalExtension();

                    $replace = substr($image_64, 0, strpos($image_64, ',')+1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = Str::random(10).'.'.$extension;
                    $file->move(public_path('uploads/tickets/documents/'), $imageName);

                    $file_bath = 'uploads/tickets/documents/'.$imageName;

                    $this->attachModel::create([
                        'ticket_id' => $id,
                        'file' => $imageName ,
                        'type' => $extension,
                        'link' => $file_bath

                        ]);


                }// end foreach
            } // end of assign files



        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Updated Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.tickets.index');


    }// end of update

    public function moveTicket($request){

        $request->validate([
            'ticket_id'        => 'required|exists:tickets,id',
            'move_type'        => 'required' ,    // 0 => not moved , 1 => internal , 2 => external
            'move_description' => 'required|string|nullable',
            'users[]'            => 'exists:users,id|nullable',
            'move_date' => 'required'

       ]);
       $requestArray = $request->all();
    //    dd($requestArray);



        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);

        $ticket->is_moved         = 1 ;
        $ticket->move_type        = $request->move_type ;
        $ticket->move_description = $request->move_description ;
        $ticket->move_date        = $request->move_date;
        $ticket->save();
        if(isset($requestArray['users']) && !empty($requestArray['users'])){
                $ticket->relocators()->sync($requestArray['users']);

        } // end of assign users

        if( config('app.locale') == 'ar'){
            alert()->success('تم النقل بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Moved Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.tickets.show',$request->ticket_id);

    }// end of move ticket

    public function destroy($id){

       $attachModel = $this->attachModel::where('ticket_id',$id)->get();

        foreach($attachModel as $attach){

            unlink(public_path('uploads/tickets/documents/'.$attach->file));
        }
        $this->ticketModel::FindOrFail($id)->delete();


           if( config('app.locale') == 'ar'){
               alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
           }else{
               alert()->success('Deleted Successfully', 'Good Work');
           }


            return redirect()->route('dashboard.tickets.index');
    }// end of destroy

    public function updateStatus($request){

        $request->validate([
            'ticket_id'   => 'required|exists:tickets,id',
            'status'      => 'required'
       ]);


        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);

        $ticket->status        = $request->status;
        $ticket->save();



    } //end of update Status

    public function updatePriority($request){

        $request->validate([
            'ticket_id'   => 'required|exists:tickets,id',
            'priority'      => 'required'
       ]);


        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);

        $ticket->priority        = $request->priority;
        $ticket->save();

    } //end of update priority

    public function getStatusPriority($id){
        $ticket =  $this->ticketModel::where('id',$id)->select('status', 'priority') ->get();

        return $this->ApiResponse(200, 'Done', null, $ticket);
    }
    //////////////////// ticket replay ///////////////////////////////

    public function AddTicketReplay($request){

        $request->validate([
            'ticket_id'     => 'required|exists:tickets,id',
            'reply_content' => 'required|string',
            'file' => 'nullable|mimes:jpeg,jpg,png,gif,doc,pdf,docx,zip',
        ]);
        $requestArray = ['user_id'=> Auth::user()->id]+$request->all();

        // dd( $requestArray);


        $ticketReply =   $this->replyModel::create($requestArray);

        //dd($ticketReply->id);
        // store tickets attachment
        if(isset($requestArray['file']) && !empty($requestArray['file'])){


                    $file =$requestArray['file'];
                    $image_64 = $file; //your base64 encoded data
                    $extension = $file->getClientOriginalExtension();

                    $replace = substr($image_64, 0, strpos($image_64, ',')+1);
                    $image = str_replace($replace, '', $image_64);
                    $image = str_replace(' ', '+', $image);
                    $imageName = Str::random(10).'.'.$extension;
                    $file->move(public_path('uploads/tickets/replay/'), $imageName);


                    $file_bath = 'uploads/tickets/replay/'.$imageName;

                    $this->attachModel::create([
                        'ticket_id' => $request->ticket_id,
                        'file' => $imageName ,
                        'reply_id'  => $ticketReply->id,
                        'type' => $extension,
                        'link' => $file_bath

                        ]);

        } // end of assign files

        if( config('app.locale') == 'ar'){
            alert()->success('تم الانشاء بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.tickets.show',$request->ticket_id);
    }// end of Add ticket replay

    public function getTicketReplay($ticket_id){

        $ticketReplies =  $this->replyModel::where('ticket_id',$ticket_id)->with('replyAttachments:id,file,type,link,reply_id','user:id,name')->get();
        $routeName = 'tickets';

        // dd($ticketReplies);
        return view('backend.tickets.replay',compact('routeName','ticketReplies','ticket_id'));

    }// end of Get ticket replay

    //////////////////////////  ticket Attachment //////////////////////

    public function getTicketAttachment($id){

        $ticketAttachments =  $this->attachModel::where('ticket_id',$id)->get();
        return $this->ApiResponse(200, 'Done', null, $ticketAttachments);

    }// end dof get Ticket Attachment





} // end of class

?>

