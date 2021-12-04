<?php
namespace App\Http\Repositories\Sales;
use App\Models\Finance\FinAccount;
use App\Http\Interfaces\Sales\SalQuotationInterface;
use App\Models\Customer;
use App\Models\Finance\FinSetting;
use App\Models\Sales\SalQuotation;
use App\Models\Sales\SalQuotationDetail;
use App\Models\Store\StoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SalQuotationRepository  implements SalQuotationInterface
{

    private $model;

    public function __construct(SalQuotation $model)
    {
        $this->model = $model;
    }

    public function index(){
        $routeName = 'quotations';
        $customers = Customer::select('id','name', 'company_name')->get();
        $rows      =   $this->model::get();
        return view('backend.sales.quotations.index',compact('routeName','customers','rows'));

    }//end of index

    public function create(){
       /// dd('welcom');
        $routeName='quotations';
        $customers = Customer::select('id','name', 'company_name')->get();
        $taxes = DB::table('taxes')->get();
        return view('backend.sales.quotations.create',compact('routeName','taxes','customers') );
    }// end of create

    public function store($request){

       // dd($request->all());
        $request->validate([
            'customer_id'   => 'required',
            'start_date'    => 'required',
            'expired_date'  => 'required',
            'reference_no'  => 'required',
        ]);

        // save master data
        $requestArray = ['added_by' => Auth::id(),'grand_total' => 0] + $request->all();
        $row =  $this->model->create($requestArray);

        // save details
        for ($i=0; $i < count($request->item_id); $i++) {
            if (isset($request->qty[$i]) && isset($request->sale_price[$i])) {
                SalQuotationDetail::create([
                    'sal_quotation_id'  => $row->id,
                    'item_id'           => $request->item_id[$i],
                    'qunatity'          => $request->qty[$i],
                    'unit_price'        => $request->sale_price[$i],
                    'tax_rate'          => $request->item_tax[$i] ,
                    'tax'               => ($request->item_tax[$i] / 100 + 1) * $request->sale_price[$i] ,
                    'discount'          => $request->disc_value[$i],
                    'discount_type'     => $request->disc_type[$i],
                    'total'             => $request->total_line_price[$i],
                ]);
            }
        }

        if( config('app.locale') == 'ar'){ alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع'); }
        else{alert()->success('The Recourd Created Successfully', 'Good Work'); }
        return redirect()->route('dashboard.quotations.index');
    }// end of store

    public function show($id){

       $row =  $this->model::where('id', $id)->with('quotationItem','customer')->first();
      // dd($row);
       return view('backend.sales.quotations.show', compact('row'));

    }
    public function edit($id){
        $routeName='quotations';
        $taxes = DB::table('taxes')->get();
        return view('backend.sales.quotations.edit',compact('routeName','taxes') );
    }// end of edit

    public function update($request,$id){
       $request->validate([
            'account_id'=> 'required',
            'account_key'=>'required',
        ]);


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
     return view('backend.sales.quotations.search', compact('StoItem','id'));


     }// end of search

} // end of class

?>
