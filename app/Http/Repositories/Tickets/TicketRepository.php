<?php
namespace App\Http\Repositories\Tickets;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\TicketAttachment;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\Tickets\TicketInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;
use Carbon\Carbon;
use DB;
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
                                    ->with('users:id,name', 'department:id,name_ar,name_en', 'customer:id,name')->get();

        return $this->ApiResponse(200, 'Done', null,  $tickets);
    }//end of index 
 
    public function show($id){
       $ticket =  $this->ticketModel::where('id',$id)->select('id', 'subject' , 'status', 'priority' , 'start_at' , 'description','customer_id','department_id')
                                    ->with('users:id,name', 'department:id,name_ar,name_en', 'customer:id,name')->get();
        return $this->ApiResponse(200, 'Done', null, $ticket);
    }// end of destroy 

    public function store($request){
        
        // store ticket
        $requestArray = $request->all();
      //  dd($requestArray);
        $validation = Validator::make($request->all(),[
            'subject'          => 'required|string|min:4', 
            'status'           => 'required|string',
            'priority'         =>'required|string',
            'start_at'         =>'required',
            'description'      => 'required|string',
          
            'customer_id'      => 'exists:customers,id|nullable',
            'users'            => 'exists:users,id|nullable',
        
        ]);

        if($validation->fails())
        {
            return $this->ApiResponse(422,'Validation Error', $validation->errors());
        }
        $requestArray = [
            'start_at' => Carbon::parse($request->start_at) 
            ] + $request->all() ; 
        $ticket =   $this->ticketModel::create($requestArray);

        if(isset($requestArray['users']) && !empty($requestArray['users'])){
                $ticket->users()->sync($requestArray['users']);
        } // end of assign users 

         // store tickets attachment
        if(isset($requestArray['files']) && !empty($requestArray['files'])){
               
            foreach($requestArray['files'] as $file){

                // $mime = $file->getMimeType();
                // $arra = explode('/',$mime);
                // if($arra[0] == 'image') {
                                                        
                //     $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                //     $img      = Image::make($file);
                //     $img->save(public_path('uploads/tickets/images/'. $fileName));
                  
                //     $this->attachModel::create([
                //         'ticket_id' => $ticket->id,
                //         'file' => $fileName ,
                //         'type' => 'image',
                //         'link' => url('public/uploads/tickets/images/' . $fileName)

                //     ]);
                
                // }else {

                //     $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();  
                //     $file->move(public_path('uploads/tickets/documents/'), $fileName);

                //     $this->attachModel::create([
                //     'ticket_id' => $ticket->id,
                //     'file' => $fileName ,
                //     'type' => 'document',
                //     'link' => url('public/uploads/tickets/documents/' . $fileName)

                //     ]);
                // }

                $image_64 = $file; //your base64 encoded data
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
            
                // find substring fro replace here eg: data:image/png;base64,

                $image = str_replace($replace, '', $image_64); 
                $image = str_replace(' ', '+', $image); 
                $imageName = Str::random(10).'.'.$extension;

                Storage::disk('files')->put($imageName, base64_decode($image));

                $file_bath = url('public/uploads/'.$imageName);

                $this->attachModel::create([
                    'ticket_id' => $ticket->id,
                    'file' => $imageName ,
                    'type' => $extension,
                    'link' => $file_bath

                    ]);

            }// end foreach
        } // end of assign files 

        return $this->ApiResponse(200, 'Done', null,  $ticket);
       
    }// end of store 

    public function update($request){
        
        $validation = Validator::make($request->all(),[
            'subject'          => 'required|string|min:4', 
            'status'           => 'required|string',
            'priority'         =>'required|string',
            'start_at'         =>'required',
            'description'      => 'required|string',
            'department_id'    => 'exists:departments,id|nullable',
            'customer_id'      => 'exists:customers,id|nullable',
            'users'            => 'exists:users,id|nullable',
        
        ]);

        if($validation->fails())
        {
            return $this->ApiResponse(422,'Validation Error', $validation->errors());
        }

        $dpartment =   $this->ticketModel::FindOrFail($request->department_id);
        
        $dpartment->name_ar = $request->name_ar ;
        $dpartment->name_en = $request->name_en ;
        $dpartment->save();

       

        return $this->ApiResponse(200, 'Updated Successfully');
    

    }// end of update 

    public function moveTicket($request){

          $requestArray = $request->all();
          $validation = Validator::make($request->all(),[
            'ticket_id'        => 'required|exists:tickets,id',
           // 'is_moved'         => 'required',      // 0 => defualt 0 refeer to not moved  , 1 => refeer to moved 
            'move_type'        => 'required' ,    // 0 => not moved , 1 => internal , 2 => external	
            'move_description' => 'required|string|nullable',
            'users'            => 'exists:users,id|nullable',
            'move_date' => 'required'
            
       ]);

       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);
        
        $ticket->is_moved         = 1 ;
        $ticket->move_type        = $request->move_type ;
        $ticket->move_description = $request->move_description ;
        $ticket->move_date        = $request->move_date;
        $ticket->save();

        if(isset($requestArray['users']) && !empty($requestArray['users'])){
                $ticket->relocators()->sync($requestArray['users']);
        } // end of assign users 

          return $this->ApiResponse(200, 'Done', null,  $ticket);

    }// end of move ticket

    public function destroy($id){
        // $validation = Validator::make($request->all(),[
        //     'ticket_id' => 'required|exists:tickets,id'
        // ]);
        
        // if($validation->fails())
        // {
        //     return $this->ApiResponse(422,'Validation Error', $validation->errors());
        // }

        // $this->ticketModel::FindOrFail($request->ticket_id)->delete();

        $this->ticketModel::FindOrFail($id)->delete();
      
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 

    public function updateStatus($request){

        $validation = Validator::make($request->all(),[
            'ticket_id'   => 'required|exists:tickets,id',
            'status'      => 'required'
       ]);

       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);
        
        $ticket->status        = $request->status;
        $ticket->save();

          return $this->ApiResponse(200, 'Done', null,  $ticket);

    } //end of update Status

    public function updatePriority($request){

          $validation = Validator::make($request->all(),[
            'ticket_id'   => 'required|exists:tickets,id',
            'priority'      => 'required'
       ]);

       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $ticket =   $this->ticketModel::FindOrFail($request->ticket_id);
        
        $ticket->priority        = $request->priority;
        $ticket->save();

          return $this->ApiResponse(200, 'Done', null,  $ticket);

    } //end of update priority

    public function getStatusPriority($id){
        $ticket =  $this->ticketModel::where('id',$id)->select('status', 'priority') ->get();
                                  
        return $this->ApiResponse(200, 'Done', null, $ticket);
    }
    //////////////////// ticket replay ///////////////////////////////

    public function AddTicketReplay($request){

        $requestArray = $request->all();
        $validation = Validator::make($request->all(),[
            'ticket_id'     => 'required|exists:tickets,id',
            'user_id'       => 'required|exists:users,id',
            'reply_content' => 'required'
        ]);

        if($validation->fails())
        {
            return $this->ApiResponse(422,'Validation Error', $validation->errors());
        }

        // add replay 

        $ticketReply =   $this->replyModel::create($requestArray);

        //dd($ticketReply->id);
        // store tickets attachment
        if(isset($requestArray['files']) && !empty($requestArray['files'])){
                
            foreach($requestArray['files'] as $file){

                  $image_64 = $file; //your base64 encoded data
                $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
                $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
            
                // find substring fro replace here eg: data:image/png;base64,

                $image = str_replace($replace, '', $image_64); 
                $image = str_replace(' ', '+', $image); 
                $imageName = Str::random(10).'.'.$extension;

                Storage::disk('files')->put($imageName, base64_decode($image));

                $file_bath = url('public/uploads/'.$imageName);

                $this->attachModel::create([
                    'ticket_id' => $request->ticket_id,
                    'file' => $imageName ,
                    'reply_id'  => $ticketReply->id,
                    'type' => $extension,
                    'link' => $file_bath

                    ]);
            }// end foreach
        } // end of assign files 

        return $this->ApiResponse(200, 'Done', null,  $ticketReply);
    }// end of Add ticket replay 

    public function getTicketReplay($id){  

        $ticketReplies =  $this->replyModel::where('ticket_id',$id)->with('replyAttachments:id,file,type,link','user:id,name')->get();
        return $this->ApiResponse(200, 'Done', null, $ticketReplies);

    }// end of Get ticket replay

    //////////////////////////  ticket Attachment //////////////////////

    public function getTicketAttachment($id){

        $ticketAttachments =  $this->attachModel::where('ticket_id',$id)->get();
        return $this->ApiResponse(200, 'Done', null, $ticketAttachments);

    }// end dof get Ticket Attachment





} // end of class

?>

