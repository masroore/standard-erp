<?php
namespace App\Http\Repositories;
use App\Models\Contact;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\ContactInterface;
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
          /**   all contacts 
        * url   : https://store.prohussein.com/api/admin/all-contacts
        * Method : get
        
        {
  "status": 200,
  "message": "Done",
  "data": [
    {
      "id": 3,
      "name": "test customer",
      "phone": "01157809060",
      "photo": "http://localhost/emtech/public/uploads/contacts/photos/1622842606Ee7lSZMrwVTbYj2.png",
      "mobile": "12365478963",
      "whatsapp": "01236547896",
      "address": "test address",
      "department": "hr",
      "facebook": "https://www.facebook.com",
      "linkedin": "https://www.facebook.com",
      "twitter": "https://www.facebook.com/",
      "position": "1236589",
      "email": "mohamed@add.com",
      "customer_id": null,
      "supplier_id": null,
      "created_at": "2021-06-04T15:36:46.000000Z",
      "updated_at": "2021-06-04T15:36:46.000000Z"
    },
    {
      "id": 4,
      "name": "test customer",
      "phone": "01157809060",
      "photo": "http://localhost/emtech/public/uploads/contacts/photos/1622842758fN4BACWWq5gpYwE.png",
      "mobile": "12365478963",
      "whatsapp": "01236547896",
      "address": "test address",
      "department": "hr",
      "facebook": "https://www.facebook.com",
      "linkedin": "https://www.facebook.com",
      "twitter": "https://www.facebook.com/",
      "position": "1236589",
      "email": "mohamed@add.com",
      "customer_id": null,
      "supplier_id": null,
      "created_at": "2021-06-04T15:39:18.000000Z",
      "updated_at": "2021-06-04T15:39:18.000000Z"
    },
        */
        $contacts =  $this->contactModel::get();
        return $this->ApiResponse(200, 'Done', null,  $contacts);
    }//end of index

    

    public function getById($id){
        $row =  $this->contactModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }

    public function store($request){
       // dd('welcome');

       /**   Add contact 
        * url   : https://store.prohussein.com/api/admin/add-contact
        * Method : POST 
        */

       
        $validation = Validator::make($request->all(),[
            'name'             => 'required|string', 
            'mobile'           => 'digits:11',
            'department'       => 'required|string',  
            'photo'            => 'mimes:jpeg,jpg,png,gif',
            'phone'            => 'required|digits:11',
            'linkedin'         => 'url',
            'email'            => 'required|email',
            'address'          => 'required',
            'twitter'          => 'url',
            'position'         => 'required|string',
            'whatsapp'         => 'digits:11',
            'facebook'         => 'url',
            'customer_id'      => 'nullable|exists:customers,id',
            'supplier_id'      => 'nullable|exists:suppliers,id',
            
       ]); 

       // success response 

       /*{
        "status": 200,
        "message": "Done",
        "data": {
            "photo": "https://store.prohussein.com/public/uploads/contacts/photos/1623185976m7PCpPWjCEb2I7D.png",
            "name": "test customer 3",
            "email": "mmed@add.co",
            "phone": "01157852260",
            "address": "test address",
            "mobile": "12365478963",
            "whatsapp": "01236547896",
            "department": "hr",
            "facebook": "https://www.facebook.com",
            "linkedin": "https://www.facebook.com",
            "twitter": "https://www.facebook.com/",
            "position": "1236589",
            "customer_id": null,
            "supplier_id": "2",
            "updated_at": "2021-06-08T20:59:37.000000Z",
            "created_at": "2021-06-08T20:59:37.000000Z",
            "id": 8
        }
        }*/

       // fieled respons 
       /*
        {
            "status": 422,
            "message": "Validation Error",
            "errors": {
                "name": [
                "The name field is required."
                ],
                "department": [
                "The department field is required."
                ]
            }
        }
       */


       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }
     
        $requestArray =  $request->all() ;
         // dd($requestArray);
         if ($request->hasFile('photo')) {
                $file     = $request->file('photo');                                     
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      =  Image::make($request->file('photo'));
                //$img      = (string) Image::make($request->file('photo'))->encode('data-url');
                $img->fit(150, 150);
                $img->save(public_path('uploads/contacts/photos/'. $fileName));
                $url =  url('public/uploads/contacts/photos/' . $fileName);  

                $requestArray = ['photo' => $url] + $request->all() ;
            }
        
        $row =  $this->contactModel::create($requestArray);
      
         return $this->ApiResponse(200, 'Done', null,  $row);
       
       
    }// end of store 

    public function update($request,$id){
        
        $row =   $this->contactModel::FindOrFail($id);

         /**   Add contact 
        * url   : https://store.prohussein.com/api/admin/update-contact/id
        * Method : POST 
        */

            $validation = Validator::make($request->all(),[
                'name'             => 'required|string', 
                'mobile'           => 'digits:11',
                'department'       => 'required|string',  
                'photo'            => 'mimes:jpeg,jpg,png,gif',
                'phone'            => 'required|digits:11',
                'linkedin'         => 'url',
                'email'            => 'required|email',
                'address'          => 'required',
                'twitter'          => 'url',
                'position'         => 'required|string',
                'whatsapp'         => 'digits:11',
                'facebook'         => 'url',
                'customer_id'      => 'nullable|exists:customers,id',
                'supplier_id'      => 'nullable|exists:suppliers,id',
            ]);

            // response 
            // {
            // "status": 200,
            // "message": "Updated Successfully"
            // }

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
                $img->save(public_path('uploads/contacts/photos/'. $fileName));
                $url =  url('public/uploads/contacts/photos/' . $fileName);  
                $requestArray = ['photo' => $url] + $request->all() ;
            }

        $row->update($requestArray);

        return $this->ApiResponse(200, 'Updated Successfully');
    }// end of update 

    public function destroy($id){

           /**   delete contact 
        * url   : https://store.prohussein.com/api/admin/delete-contact/id
        * Method : POST 
        */

        // response 
        // {
        // "status": 200,
        // "message": "Deleted Successfully"
        // }
        $this->contactModel::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
