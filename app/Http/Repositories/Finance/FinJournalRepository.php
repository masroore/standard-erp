<?php
namespace App\Http\Repositories\Finance;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Finance\FinJournalInterface;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinJournalRepository  implements FinJournalInterface
{

    private $model;

    public function __construct(FinJournal $model)
    {
        $this->model = $model;
    }

    public function index(){
        $rows      = $this->model::orderBy('date','desc')->with('items')->get();
        $routeName = 'journals';
        return view('backend.finance.journals.index', compact('rows','routeName'));

    }//end of index

    public function create(){

        $rows        = FinAccount::get();
        $categories  = FinAccount::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $routeName = 'journals';


        return view('backend.finance.journals.create' , compact('routeName','categories','rows'));
    }// end of create

    public function store($request){

        // dd($request->all());

        $request->validate([
            'ref' => 'required|',
            'date' => 'required|date',
            'account_id'=> 'required|',
            'credit'=> 'required|',
            'debit'=> 'required|',
            'details'=> 'required|string',
        ]);


        $attachment = null;
        if($request->attachment){
            $file =$request->attachment;
            $name = time().'.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path('/uploads/journals');
                        $file->move($destinationPath, $name);
            $attachment = $name;
        }



        $row =  FinJournal::create([
            'user_id'=>Auth::user()->id,
            'ref'=>$request->ref,
            'date'=>$request->date,
            'details'=>$request->details,
            'attachment'=> $attachment,
        ]);

        // dd($row->id);
        $account_id = $request->account_id;
        $credit = $request->credit;
        $debit = $request->debit;
        $count = count($request->account_id);

        for($i = 0; $i < $count; $i++){
            FinJournalDetail::create([
                'journal_id'=>$row->id,
                'account_id'=>$account_id[$i],
                'credit'=>$credit[$i],
                'debit'=>$debit[$i],
            ]);
        }


        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store


    public function edit($id){

        $rows        = FinAccount::get();
        $categories  = FinAccount::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $routeName = 'journals';
        $jornal = $this->model::where('id', $id)->with('items')->first();
        return view('backend.finance.journals.edit' , compact('routeName','categories','rows','jornal'));
    }// end of edit

    public function update($request,$id){
      // dd($request->all());
        $request->validate([
            'ref' => 'required|',
            'date' => 'required|date',
            'account_id'=> 'required|',
            'credit'=> 'required|',
            'debit'=> 'required|',
            'details'=> 'required|string',
        ]);

        $row =  $this->model->FindOrFail($id);
        if($request->attachment){
            $file =$request->attachment;
            $name = time().'.'.$file->getClientOriginalExtension();
                        $destinationPath = public_path('/uploads/journals');
                        $file->move($destinationPath, $name);
            $attachment = $name;
        }else{
            $attachment = $row->attachment;
        }

        $requestArray = ['attachment' =>$attachment] + $request->all();

        $row->update($requestArray);

        //delete old item
        DB::table('fin_journal_details')->where('journal_id', '=', $id)->delete();
        // save details
        for ($i=0; $i < count($request->account_id); $i++) {
                FinJournalDetail::create([

                    'journal_id'       => $row->id,
                    'account_id'       => $request->account_id[$i],
                    'debit'            => $request->debit[$i],
                    'credit'           => $request->credit[$i],
                    'created_at'       => $row->created_at,
                    'updated_at'       => $row->updated_at,

                ]);
        }

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Updated Successfully', 'Good Work');
        }
        return redirect()->back();


    }// end of update

    public function destroy($id){

        //dd($id);
        $this->model::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy
} // end of class

?>
