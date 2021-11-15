<?php
namespace App\Http\Repositories\Finance;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Finance\FinJournalInterface;
use App\Http\Repositories\LaravelLocalization;
use App\Models\Finance\FinJournal;
use App\Models\Finance\FinJournalDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class FinJournalRepository  implements FinJournalInterface
{

    private $model;

    public function __construct(FinAccount $model)
    {
        $this->model = $model;
    }

    public function index(){
        $cats           = FinCategory::get();
        $rows      = $this->model::get();
        $routeName = 'accounts';

        $categories  = $this->model::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();

       // dd($categories);


        return view('backend.finance.accounts.index', compact('rows','routeName','cats','categories'));

    }//end of index

    public function create(){

        $rows      = $this->model::get();
        $categories  = $this->model::where('parent_id', 0)
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
                        $destinationPath = public_path('/files/journal');
                        $file->move($destinationPath, $name);
            $attachment = 'files/journal/'.$name;
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


    public function edit(){

    }// end of edit

    public function update($request,$id){
       //dd($id);

        $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
        ]);

        $requestArray = $request->all();

        $row =  $this->model->FindOrFail($id);

        $row->update($requestArray);

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
