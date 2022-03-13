<?php
namespace App\Http\Repositories;
use App\Models\Contact;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\ContactInterface;
use App\Models\Customer;
use App\Models\Hr\HrEmployee;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
class ContactRepository  implements ContactInterface
{
    use ApiDesignTrait;

     private $contactModel;

    public function __construct(Contact $contact)
    {
        $this->contactModel = $contact;
    }

    public function index(){
        $rows =  $this->contactModel::get();
        $customers =  Customer::get();
        $suppliers =  Supplier::get();
        $routeName = 'contacts';
        return view('backend.contacts.index',compact('routeName','rows','customers','suppliers'));
    }//end of index



    public function getById($id){
        $row =  $this->contactModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }

    public function store($request){


        $request->validate([
            'name'             => 'required|string',
            'email'            => 'required|email',
            'department'       => 'required|string',
            'position'         => 'required|string',
            'address'          => 'required|string',
            'phone'            => 'required|array',
            'whatsapp'         => 'digits:11',
            // 'twitter'          => 'url',
            // 'facebook'         => 'url',
            // 'linkedin'         => 'url',
            'customer_id'      => 'nullable|exists:customers,id',
            'supplier_id'      => 'nullable|exists:suppliers,id',
            'photo'            => 'mimes:jpeg,jpg,png,gif',

       ]);


        if($request->customer_id == null && $request->supplier_id == null ){
            $requestArray = ['phone' => json_encode($request->phone), 'is_our_company' => '1']+$request->all();

        }else{
            $requestArray = ['phone' => json_encode($request->phone),]+$request->all();
        }

         if ($request->hasFile('photo')) {

                $file     = $request->file('photo');
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      =  Image::make($request->file('photo'));
                $img->fit(90, 90);
                $img->save(public_path('uploads/contacts/photos/'. $fileName));
                $url =  'uploads/contacts/photos/' . $fileName;

                if($request->customer_id == null && $request->supplier_id == null ){
                    $requestArray = ['photo' => $url ,'phone' => json_encode($request->phone), 'is_our_company' => '1']+$request->all();

                }else{
                    $requestArray = ['photo' => $url ,'phone' => json_encode($request->phone),]+$request->all();
                }
            }

            // dd($requestArray);


          $this->contactModel::create($requestArray);

          if( config('app.locale') == 'ar'){
            alert()->success('تم الانشاء بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Created Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.contacts.index');


    }// end of store

    public function update($request,$id){


        $request->validate([
            'name'             => 'required|string',
            'email'            => 'required|email',
            'department'       => 'required|string',
            'position'       => 'required|string',
            'address'       => 'required|string',
            'phone'           => 'required|array',
            'whatsapp'         => 'digits:11',
            'twitter'          => 'url',
            'facebook'         => 'url',
            'linkedin'         => 'url',
            'customer_id'      => 'nullable|exists:customers,id|unique:contacts,customer_id,'.$id,
            'supplier_id'      => 'nullable|exists:suppliers,id|unique:contacts,supplier_id,'.$id,
            'photo'            => 'mimes:jpeg,jpg,png,gif',

       ]);
       $row =   $this->contactModel::FindOrFail($id);

        $requestArray = $request->all();

            if($request->customer_id == null && $request->supplier_id == null ){
                $requestArray = ['phone' => json_encode($request->phone), 'is_our_company' => '1']+$request->all();

            }else{
                $requestArray = ['phone' => json_encode($request->phone),]+$request->all();
            }
        if ($request->hasFile('photo')) {

                $file     = $request->file('photo');
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      =  Image::make($request->file('photo'));
                $img->fit(90, 90);
                $img->save(public_path('uploads/contacts/photos/'. $fileName));
                $url =  'uploads/contacts/photos/' . $fileName;
                if($request->customer_id == null && $request->supplier_id == null ){
                    $requestArray = ['photo' => $url ,'phone' => json_encode($request->phone), 'is_our_company' => '1']+$request->all();

                }else{
                    $requestArray = ['photo' => $url ,'phone' => json_encode($request->phone),]+$request->all();
                }
            }

        $row->update($requestArray);
        if( config('app.locale') == 'ar'){
            alert()->success('تم التعديل بنجاح', 'عمل رائع');
        }else{
            alert()->success(' Updated Successfully', 'Good Work');
        }
         return redirect()->route('dashboard.contacts.index');
    }// end of update

    public function destroy($id){
        $contactModel =  $this->contactModel::FindOrFail($id);
        $contactModel->delete();
        ($contactModel->photo) ?unlink(public_path($contactModel->photo)) : '';

           if( config('app.locale') == 'ar'){
               alert()->success('تم  الحذف  بنجاح', 'عمل رائع');
           }else{
               alert()->success('Deleted Successfully', 'Good Work');
           }


            return redirect()->route('dashboard.contacts.index');
    }// end of destroy

    public function search($value){

        $rows =  $this->contactModel::where('name', 'LIKE', '%'.$value.'%')->get();
        $customers =  Customer::get();
        $suppliers =  Supplier::get();
     return view('backend.contacts.search', compact('rows','customers','suppliers'));


     }// end of search

     public function getByType($value){

        if($value == 'customers'){
            $rows =  $this->contactModel::where('customer_id', '>', 0)->get();
        }elseif($value == 'suppliers'){
            $rows =  $this->contactModel::where('supplier_id', '>', 0)->get();
        }else{
            $rows =  $this->contactModel::get();
        }
        $customers =  Customer::get();
        $suppliers =  Supplier::get();
     return view('backend.contacts.search', compact('rows','customers','suppliers'));


     }// end of search

} // end of class

?>
