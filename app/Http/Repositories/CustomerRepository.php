<?php
namespace App\Http\Repositories;
use App\Models\Customer;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\CustomerInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
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
        $customers =  $this->customerModel::get();
        return $this->ApiResponse(200, 'Done', null,  $customers);
    }//end of index

    public function getById($id){
        $row =  $this->customerModel::where('id', $id)->first();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }
    public function store($request){
       //  dd();
      //  dd(url(base_path()));
       /***********   Add Customer  ***************
        * url    : https://store.prohussein.com/api/admin/add-customer
        * Method : POST 
        */
        $validation = Validator::make($request->all(),[
            'name'            => 'required|string', 
            'company_name'    => 'required|string',
            'is_active'       => 'required|numeric',  // 0 => not active , 1 => active
            // 'photo'           => 'mimes:jpeg,jpg,png,gif',
            'phone'           => 'required|digits:11',
            'fax'             => 'numeric',
            'email'           => 'required|email|unique:customers',
            'address'         => 'required',
            'tax_id'          => 'required|unique:customers',
            'tax_file_number' => 'required|unique:customers',
            'parent_id'       => 'exists:parent_companies,id',
            'group_id'        => 'exists:customer_groups,id',
            
       ]); 

       


       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $requestArray =  $request->all() ;

        //  if ($request->hasFile('photo')) {
        //         $file     = $request->file('photo');                                     
        //         $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
        //         $img      = Image::make($request->file('photo'));
        //         $img->fit(150, 150);
        //         $img->save(public_path('uploads/customers/photos/'. $fileName));
        //         $url =  url('public/uploads/customers/photos/' . $fileName);  

        //         $requestArray = ['photo' => $url] + $request->all() ;
        //     }
            //dd($requestArray['photo']);

        $image_64 = $requestArray['photo']; //your base64 encoded data
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
       
        // find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64); 
        $image = str_replace(' ', '+', $image); 
        $imageName = Str::random(10).'.'.$extension;

     
          //  public_path()->put($imageName, base64_decode($image));
        Storage::disk('files')->put($imageName, base64_decode($image));

        $file_bath = url('public/uploads/'.$imageName);
        $requestArray = ['photo' => $file_bath] + $request->all() ;
          
        $row =  $this->customerModel::create($requestArray);
      
        return $this->ApiResponse(200, 'Done', null,  $row);
       
       
    }// end of store 

    public function update($request,$id){

        $row =   $this->customerModel::FindOrFail($id);

     
            $validation = Validator::make($request->all(),[
                'name'            => 'required|string', 
                'company_name'    => 'required|string',
                'is_active'       => 'required|numeric', // 0 => not active , 1 => active
                'photo'           => 'mimes:jpeg,jpg,png,gif',
                'phone'           => 'required|digits:11',
                'fax'             => 'numeric',
                'email'           => 'required|email|unique:customers,email,'.$id,
                'address'         => 'required',
                'tax_id'          => 'required|unique:customers,tax_id,'.$id, 
                'tax_file_number' => 'required|unique:customers,tax_file_number,'.$id,
                'parent_id'       => 'exists:parent_companies,id',
                'group_id'        => 'exists:customer_groups,id',
            ]);

        
            if($validation->fails())
            {
                return $this->ApiResponse(422,'Validation Error', $validation->errors());
            }
        
        $requestArray = $request->all();   

        if ($request->hasFile('photo')) {
                $file     = $request->file('photo');                                     
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      = Image::make($request->file('photo'));
                $img->fit(150, 150);
                $img->save(public_path('uploads/customers/photos/'. $fileName));
                $url =  url('public/uploads/customers/photos/' . $fileName);  
                $requestArray = ['photo' => $url] + $request->all() ;
            }

        $row->update($requestArray);

        return $this->ApiResponse(200, 'Updated Successfully');
    }// end of update 

    public function destroy($id){+

          /***********   Delete Customer  ***************
        * url    : https://store.prohussein.com/api/admin/delete-customer/id
        * Method : POST 
        Response 
            {
            "status": 200,
            "message": "Deleted Successfully"
            }
        */

        $this->customerModel::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
