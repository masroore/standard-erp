<?php
namespace App\Http\Repositories\Finance;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Finance\FinSettingInterface;
use App\Http\Repositories\LaravelLocalization;
use App\Models\Finance\FinSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class FinSettingRepository  implements FinSettingInterface
{

    private $model;

    public function __construct(FinSetting $model)
    {
        $this->model = $model;
    }

    public function index(){
        // dd(84584);
        // $cats           = FinCategory::get();
        $rows      = $this->model::get();
        $routeName = 'finSettings';

        $categories  = FinAccount::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $words =[
            Lang::get('site.Customer_master_account'),
            Lang::get('site.Supplier_master_account'),
            Lang::get('site.Sales_master_account'),
            Lang::get('site.Zero_sales_tax_main_account'),
            Lang::get('site.Purchases_master_account'),
            Lang::get('site.Calculation_of_cost_of_goods_sold'),
            Lang::get('site.Calculation_of_cost_of_services_sold'),
            Lang::get('site.Store_master_account'),
            Lang::get('site.Fund_master_account'),
            Lang::get('site.bad_debts_account'),
            Lang::get('site.Tax_main_account_(sales)'),
            Lang::get('site.Tax_main_account_(purchases)'),
            Lang::get('site.Bank_fees_and_account_fees'),
        ];

    //    dd($categories);


        return view('backend.finance.settings.index', compact('routeName','rows','categories','words'));

    }//end of index

    public function create(){
        $cats      = FinCategory::get();
        $routeName = 'finSettings';
        $categories  = $this->model::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();

        return view('backend.finance.accounts.create' , compact('categories','cats','routeName'));
    }// end of create

    public function store($request){

        // dd($request->all());

        $request->validate([
            'account_id'=> 'required',
            'account_key'=>'required',
        ]);


        $account_id = $request->account_id;
        $account_key = $request->account_key;
        $count = count($request->account_id);

        for($i = 0; $i < $count; $i++){
          $FinAccount =  FinAccount::where('id',$account_id[$i])->first();

            FinSetting::create([
                'user_id'=>Auth::user()->id,
                'title_ar'=>$FinAccount->title_ar,
                'title_en'=>$FinAccount->title_en,
                'account_id'=>$account_id[$i],
                'account_key'=>$account_key[$i],
            ]);
        }


        // $row =  $this->model->create($requestArray);

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
       $request->validate([
            'account_id'=> 'required',
            'account_key'=>'required',
        ]);

        $account_id = $request->account_id;
        $account_key = $request->account_key;
        $setting_id = $request->setting_id;
        $count = count($request->setting_id);

        for($i = 0; $i < $count; $i++){
          $FinAccount =  FinAccount::where('id',$account_id[$i])->first();
          $row =  $this->model->FindOrFail($setting_id[$i]);
          $row->update([
                'user_id'=>Auth::user()->id,
                'title_ar'=>$FinAccount->title_ar,
                'title_en'=>$FinAccount->title_en,
                'account_id'=>$account_id[$i],
                'account_key'=>$account_key[$i],
            ]);
        }

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل الاعدادات  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Settings Updated Successfully', 'Good Work');
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
