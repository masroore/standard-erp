<?php
namespace App\Http\Repositories\Sales;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Sales\SalInvoiceInterface;
use App\Http\Repositories\LaravelLocalization;
use App\Models\Finance\FinSetting;
use App\Models\Sales\SalInvoiceDetail;
use App\Models\Store\StoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class SalQuotationRepository  implements SalInvoiceInterface
{

    private $model;

    public function __construct(FinSetting $model)
    {
        $this->model = $model;
    }

    public function index(){
        $routeName = 'sales';
        $rows = $this->model::get();
        return view('backend.sales.invoices.index',compact('routeName'));

    }//end of index

    public function create(){
        $routeName='sales';
        $taxes = DB::table('taxes')->get();

        return view('backend.sales.invoices.create',compact('routeName','taxes') );
    }// end of create

    public function store($request){
        $request->validate([
            'reference_no'    => 'required',
            'supplier_id'     => 'required|exists:suppliers,id' ,
            'store_id'        => 'required|exists:sto_stores,id' ,
            'date'            => 'required',
        ]);

        $totalQty         = array_sum($request->qty);
        $itemCount        = count($request->qty);
        $taxRate          = $request->invoice_tax ;
        $orderTax         = $request->invoice_tax_amount;
        $totalCost        = array_sum($request->purch_price);
        $totalDiscount    = $request->invoice_discount_amount;
        $totalTax         = $request->invoice_tax_amount + array_sum($request->item_tax_amount);


        if($request->invoice_payment_type == 1 || $request->paid_amount == $request->grand_total){
            $paid = 1;
        }else{
            $paid = 0;
        }

        if($request->document){
            $document = $request->document;
        }else{
            $document = "file to upload";
        }

        $monyId = 31;
        $requestArray = ['added_by' => Auth::id(),'money_id'=> $monyId , 'items_count' => $itemCount,
        'total_qty'=> $totalQty,'order_tax_rate'=>$taxRate,'order_tax'=>$orderTax,
        'total_cost'=>$totalCost,'total_discount'=>$totalDiscount,'total_tax'=>$totalTax,'is_paid'=>$paid,
        'document'=> $document] + $request->all();

        $row =  $this->model->create($requestArray);

        // save details

        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->purch_price[$i])) {
                SalInvoiceDetail::create([
                    'buy_invoice_id'    => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_price'        => $request->purch_price[$i],
                    'tax_rate'          => $request->item_tax_rate[$i] ,
                    'tax'               => $request->item_tax_amount[$i],
                    'discount'          => $request->disc_value[$i],
                    'discount_type'     => $request->disc_type[$i],
                    'purchase_unit_id'  => $request->purchase_unit_id[$i],
                    'total'             => $request->total_line_price[$i],
                ]);
            }
        }

        // handel journal details

        // handel payments

        // handel item quantity

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.purchases.index');
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
