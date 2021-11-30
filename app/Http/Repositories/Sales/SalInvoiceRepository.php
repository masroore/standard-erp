<?php
namespace App\Http\Repositories\Sales;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Sales\SalInvoiceInterface;
use App\Http\Repositories\LaravelLocalization;
use App\Models\Finance\FinSetting;
use App\Models\Store\StoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class SalInvoiceRepository  implements SalInvoiceInterface
{

    private $model;

    public function __construct(FinSetting $model)
    {
        $this->model = $model;
    }

    public function index(){
        $routeName = 'invoices';
        return view('backend.sales.invoices.index',compact('routeName'));

    }//end of index

    public function create(){
        $routeName='invoices';
        $taxes = DB::table('taxes')->get();

        return view('backend.sales.invoices.create',compact('routeName','taxes') );
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


    public function edit($id){

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
    public function search($value,$id){
        $StoItem =  StoItem::where(function ($query) use ($value){
                         $query->where('title_en', 'LIKE', '%'.$value.'%')
                             ->orWhere('title_ar', 'LIKE', '%'.$value.'%');
                     })->get();
     return view('backend.sales.invoices.search', compact('StoItem','id'));


     }// end of search
} // end of class

?>
