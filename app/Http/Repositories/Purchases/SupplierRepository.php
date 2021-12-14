<?php
namespace App\Http\Repositories\Purchases;
use App\Models\Supplier;
use App\Http\Interfaces\Purchases\SupplierInterface;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Image;
class SupplierRepository  implements SupplierInterface
{
    private $supplierModel;

    public function __construct(Supplier $supplier)
    {
        $this->supplierModel = $supplier;
    }// end of construct

    public function index(){
        $suppliers =  $this->supplierModel::get();
        return view('backend.purchases.suppliers.index', compact('suppliers'));
    }//end of index

    public function show($id){
        $row =  $this->supplierModel::where('id', $id)->get();
        return view('backend.purchases.suppliers.show', compact('row'));
    }//end of show

    public function create(){
        $countries = DB::table('countries')->get();
        return view('backend.purchases.suppliers.create', compact('countries'));
    }//e nd of create

    public function edit($id){
        $countries = DB::table('countries')->get();
        $row =   $this->supplierModel::FindOrFail($id);
        return view('backend.purchases.suppliers.edit', compact('countries','row'));
    }
    public function store($request){

        $validation = Validator::make($request->all(),[
            'contact_person'  => 'required|string',
            'company_name'    => 'required|string',
            'phone'           => 'required|digits:11',
            'fax'             => 'numeric|nullable',
            'email'           => 'required|email|unique:suppliers',
            'address'         => 'required',
       ]);

       // create account for supplier
        $accountId = $this->createAccount($request->company_name);

        if($request->taxclient == 1){
            $taxclient = 1;
        }else{
            $taxclient = 2;
        }

        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0; }

        $fileName = '';
        if ($request->hasFile('photo')) {
            $fileName = $this->uploadImage($request->file('photo'));
            }

        if($request->document){
            $fileName = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/suppliers/documents/'), $fileName);
            $document =  $fileName ;
        }else{
            $document = "";
        }

        $requestArray = ['is_active'        => $status ,
                         'account_id'       => $accountId ,
                         'document'         => $document,
                         'photo'            => $fileName
                         ,'is_tax_supplier' => $taxclient
                         ] +$request->all() ;

        $row =  $this->supplierModel::create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');


    }// end of store

    protected function createAccount($name){
        $accSetting      =  FinSetting::where('account_key' , '=' , 'Supplier')->first();
        $accountInfo     =  FinAccount::where('id', $accSetting->account_id )->first();

        $supplierAccount =  FinAccount::create([
        'title_ar'       => $name,
        'title_en'       => $name,
        'parent_id'      => $accSetting->account_id,
        'level'          => $accountInfo->level + 1,
        'description'    => 'create supplier Account',
        'cat_id'         => $accountInfo->cat_id,
        'start_amount'   => 0
        ]);

        return $supplierAccount -> id ;
    }

    public function update($request,$id){

        $row =   $this->supplierModel::FindOrFail($id);

            $validation = Validator::make($request->all(),[
                'contact_person'  => 'required|string',
                'company_name'    => 'required|string',
                'phone'           => 'required|digits:11',
                'fax'             => 'numeric',
                'email'           => 'required|email|unique:suppliers,email,'.$id,
                'address'         => 'required',
                'tax_id'          => 'required|unique:suppliers,tax_id,'.$id,
                'tax_file_number' => 'required|unique:suppliers,tax_file_number,'.$id,
            ]);

        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0;
        }
        $requestArray =   ['is_active' => $status] +$request->all() ;

        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Updated Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.suppliers.index');
    }// end of update

    public function destroy($id){
        $this->supplierModel::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of destroy

    protected function uploadImage($file){
        // $file     = $request->file('photo');
         $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
         $img      = Image::make($file);
         $img->fit(150, 150);
         $img->save(public_path('uploads/suppliers/photos/'. $fileName));
        return $fileName ;
     }//end of uploadImage


} // end of class

?>
