<?php
namespace App\Http\Repositories\Finance;
use App\Http\Interfaces\Finance\FinBankInterface;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinBank;
use App\Models\Finance\FinSetting;

class FinBankRepository  implements FinBankInterface
{

    private $model;

    public function __construct(FinBank $model)
    {
        $this->model = $model;
    }

    public function index(){

        $rows = $this->model::orderBy('id','desc')->get();
        return view('backend.finance.banks.index', compact('rows'));

    }//end of index


    public function store($request){

        $request->validate([

            'title_en' => 'required|unique:fin_banks,title_en',
        ]);


         // create account for supplier
         $accountId = $this->createAccount($request->title_en);
        $row =  $this->model->create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_en,
            'account_id' => $accountId ,
        ]);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store

    protected function createAccount($name){
        $accSetting      =  FinSetting::where('account_key' , '=' , 'Banks')->first();
        $accountInfo     =  FinAccount::where('id', $accSetting->account_id )->first();

        $bankAccount     =  FinAccount::create([
        'title_ar'       => $name,
        'title_en'       => $name,
        'parent_id'      => $accSetting->account_id,
        'level'          => $accountInfo->level + 1,
        'description'    => 'create Bank Account',
        'cat_id'         => $accountInfo->cat_id,
        'start_amount'   => 0
        ]);

        return $bankAccount -> id ;
    }

    public function update($request,$id){
       //dd($id);

        $request->validate([
            'title_en' => 'required|unique:fin_banks,title_en,' . $id,
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
