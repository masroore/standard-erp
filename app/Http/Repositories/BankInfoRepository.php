<?php
namespace App\Http\Repositories;
use App\Models\BankInfo;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\BankInfoInterface;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
class BankInfoRepository  implements BankInfoInterface
{
    use ApiDesignTrait;

     private $bankInfoModel;

    public function __construct(BankInfo $bankInfo)
    {
        $this->bankInfoModel = $bankInfo;
    }

    public function index(){

        $rows =  $this->bankInfoModel::get();
        return view('backend.bankinfos.index',compact('rows'));

    }//end of index

    public function show($id){
        $row =  $this->bankInfoModel::where('id', $id)->get();
        //$CustomerGroup = DB::table('bankinfo_groups')->get();

        return view('backend.bankinfos.show', compact('row'));
    }//end of show

    public function create(){
        $customers = Customer::get();
        $suppliers = Supplier::get();
        return view('backend.bankinfos.create',compact('customers','suppliers'));
    }//e nd of create

    public function edit($id){
        $row =   $this->bankInfoModel::FindOrFail($id);
        $customers = Customer::get();
        $suppliers = Supplier::get();
        return view('backend.bankinfos.edit', compact('row','customers','suppliers'));
    }

    public function getById($id){
        $row =  $this->bankInfoModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }

    public function store($request){

        $request->validate([
            'beneficiary_name'               => 'required|string',
            'beneficiary_bank_name'          => 'required|string',
            'beneficiary_bank_branch'        => 'required|string',
            'beneficiary_bank_address'       => 'required|string',
            'beneficiary_bank_street'        => 'required|string',
            'beneficiary_bank_city'          => 'required|string',
            'beneficiary_bank_swift_code'    => 'required|string',
            'beneficiary_bank_code'          => 'required|string',
            'intermediary_bank_name'         => 'required|string',
            'beneficiary_address'            => 'required|string',
            'beneficiary_street'             => 'required|string',
            'beneficiary_city'               => 'required|string',
            'beneficiary_account_no'         => 'required|string' ,
            'iban_code'                      => 'required|string' ,
            'customer_id'                    => 'nullable|exists:customers,id|unique:bank_infos,customer_id' ,
            'supplier_id'                    => 'nullable|exists:suppliers,id|unique:bank_infos,supplier_id' ,

       ]);

        $this->bankInfoModel::create( $request->all());



        if( config('app.locale') == 'ar'){
            alert()->success('تم الانشاء بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.bankinfos.index');


    }// end of store

    public function update($request,$id){

        $request->validate([
            'beneficiary_name'               => 'required|string',
            'beneficiary_bank_name'          => 'required|string',
            'beneficiary_bank_branch'        => 'required|string',
            'beneficiary_bank_address'       => 'required|string',
            'beneficiary_bank_street'        => 'required|string',
            'beneficiary_bank_city'          => 'required|string',
            'beneficiary_bank_swift_code'    => 'required|string',
            'beneficiary_bank_code'          => 'required|string',
            'intermediary_bank_name'         => 'required|string',
            'beneficiary_address'            => 'required|string',
            'beneficiary_street'             => 'required|string',
            'beneficiary_city'               => 'required|string',
            'beneficiary_account_no'         => 'required|string' ,
            'iban_code'                      => 'required|string' ,
            'customer_id'                    => 'nullable|exists:customers,id|unique:bank_infos,customer_id,'.$id ,
            'supplier_id'                    => 'nullable|exists:suppliers,id|unique:bank_infos,supplier_id,'.$id,

       ]);

        $row =   $this->bankInfoModel::FindOrFail($id);
        $requestArray = $request->all();
        $row->update($requestArray);
        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.bankinfos.index');
    }// end of update

    public function destroy($id){

        $this->bankInfoModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
        }else{
            alert()->success('Deleted Successfully', 'Good Work');
        }


         return redirect()->route('dashboard.bankinfos.index');
    }// end of destroy


} // end of class

?>
