<?php
namespace App\Http\Repositories;
use App\Models\Customer;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\CustomerInterface;
use App\Models\Contact;
use App\Models\Country;
use App\Models\CustomerGroup;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;
class CustomerRepository  implements CustomerInterface
{
    use ApiDesignTrait;

     private $customerModel;

    public function __construct(Customer $customer)
    {
        $this->customerModel = $customer;
    }

    public function index(){
        $routeName = 'customers';
        $customers  = Customer::all(['name','company_name','email','phone','photo','is_active','id','opening_balance']);
        return view('backend.customers.index',compact('routeName','customers'));
    }//end of index

    public function show($id){
        $row =  $this->customerModel::where('id', $id)->first();
        $taxes = DB::table('taxes')->get();
        $parentCompanies = DB::table('parent_companies')->get();
        $CustomerGroup = DB::table('customer_groups')->get();
        $countries = Country::all(['country_code','country_enName','country_arName']);

        return view('backend.customers.show', compact('row','countries','CustomerGroup','taxes','parentCompanies'));
    }//end of show

    public function create(){
        $countries =  Country::all(['country_code','country_enName','country_arName']);
        $CustomerGroup = DB::table('customer_groups')->get();
        $taxes = DB::table('taxes')->get();
        $parentCompanies = DB::table('parent_companies')->get();
        return view('backend.customers.create',compact('countries','CustomerGroup','taxes','parentCompanies'));
    }//e nd of create

    public function edit($id){
        $countries = DB::table('countries')->get();
        $row =   $this->customerModel::FindOrFail($id);
        $CustomerGroup = DB::table('customer_groups')->get();
        $taxes = DB::table('taxes')->get();
        $parentCompanies = DB::table('parent_companies')->get();
        return view('backend.customers.edit', compact('row','countries','CustomerGroup','taxes','parentCompanies'));
    }
    public function getById($id){
        $row =  $this->customerModel::where('id', $id)->first();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }
    public function store($request){
     //   dd($request->all());
        $request->validate([
            'name'            => 'required|string',
            'company_name'    => 'required|string',
            'photo'           => 'mimes:jpeg,jpg,png,gif',
            'phone'           => 'required',
            'fax'             => 'numeric|nullable',
            'email'           => 'email|nullable',
            'address'         => 'nullable',
            'parent_id'       => 'exists:parent_companies,id',
            'group_id'        => 'exists:customer_groups,id',

       ]);

        if($request->tax_id){
            $request->validate([
                'tax_id'          => 'unique:customers',
            ]);
        }


       // create account for supplier

       $accountId = $this->createAccount($request->company_name);

        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0;
        }

        if($request->taxclient == 1){
            $taxclient = 1;
        }else{
            $taxclient = 2;
        }



        if ($request->hasFile('photo')) {
            $fileName = $this->uploadImage($request->file('photo'));
        }else{
            $fileName = '';
        }

        if($request->document){
            $doc = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/customers/documents/'), $doc);
            $document =  $doc ;
        }else{
            $document = "";
        }

        $requestArray = ['is_active' => $status ,'account_id' => $accountId, 'photo' =>$fileName ,'document'=>$document,'is_tax_customer'=> $taxclient] + $request->all();

        $this->customerModel->create($requestArray);


        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء عميل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The customer created Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.customers.index');

    }// end of store

    public function update($request,$id){

        $row =   $this->customerModel::FindOrFail($id);

        $request->validate([
                'name'            => 'required|string',
                'company_name'    => 'required|string',
                'photo'           => 'mimes:jpeg,jpg,png,gif',
                'phone'           => 'required',
                'fax'             => 'numeric|nullable',
                'email'           => 'email',
                'parent_id'       => 'exists:parent_companies,id',
                'group_id'        => 'exists:customer_groups,id',
            ]);

            if($request->tax_id){
                $request->validate([
                    'tax_id'          => 'unique:customers,tax_id,'.$id,
                    ]);
            }


        if($request->is_active == 1){
            $status = 1;
        }else{
            $status = 0;
        }

        if($request->taxclient == 1){
            $taxclient = 1;
        }else{
            $taxclient = 2;
        }

        if ($request->hasFile('photo')) {
            $fileName = $this->uploadImage($request->file('photo'));
        }else{
            $fileName = $row->photo;
        }

        if($request->document){
            $doc = time().'.'.$request->document->extension();
            $request->document->move(public_path('uploads/customers/documents/'), $doc);
            $document =  $doc ;
        }else{
            $document = $row->document;
        }

        $requestArray = ['is_active' => $status , 'photo' =>$fileName ,'document'=>$document,'is_tax_customer'=> $taxclient] + $request->all();
        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء عميل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The customer created Successfully', 'Good Work');
        }

        return redirect()->route('dashboard.customers.index');
    }// end of update

    public function customerContacts($id){
        $rows = Contact::where('customer_id', $id)->get();
        //dd($rows);
        return view('backend.customers.contacts', compact('rows'));
    }// end of customerContacts

    public function destroy($id){+

        $this->customerModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف العميل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Customer Deleted Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of destroy

    protected function createAccount($name){
        $accSetting      =  FinSetting::where('account_key' , '=' , 'Cutomer')->first();
        $accountInfo     =  FinAccount::where('id', $accSetting->account_id )->first();

        $customerAccount =  FinAccount::create([
        'title_ar'       => $name,
        'title_en'       => $name,
        'parent_id'      => $accSetting->account_id,
        'level'          => $accountInfo->level + 1,
        'description'    => 'create supplier Account',
        'cat_id'         => $accountInfo->cat_id,
        'start_amount'   => 0
        ]);

        return $customerAccount -> id ;
    }// end of createAccount

    protected function uploadImage($file){
       // $file     = $request->file('photo');
        $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
        $img      = Image::make($file);
        $img->fit(150, 150);
        $img->save(public_path('uploads/customers/photos/'. $fileName));
       return $fileName ;
    }//end of uploadImage

    protected function uploadDocument($doument){

    }


} // end of class

?>
