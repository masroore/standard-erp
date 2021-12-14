<?php
namespace App\Http\Repositories;
use App\Models\Supplier;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\SupplierInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
class SupplierRepository  implements SupplierInterface
{
    use ApiDesignTrait;

     private $supplierModel;

    public function __construct(Supplier $supplier)
    {
        $this->supplierModel = $supplier;
    }

    public function index(){

        $suppliers =  $this->supplierModel::get();
        return $this->ApiResponse(200, 'Done', null,  $suppliers);
    }//end of index


    public function getById($id){
        $row =  $this->supplierModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }


    public function store($request){

        /**  Add Supplier
        * url   : https://store.prohussein.com/api/admin/add-supplier
        * Method : POST

        */
        $validation = Validator::make($request->all(),[
            'contact_person'  => 'required|string',
            'company_name'    => 'required|string',
            'is_active'       => 'required|numeric',  // 0 => not active , 1 => active
            'photo'           => 'mimes:jpeg,jpg,png,gif',
            'phone'           => 'required|digits:11',
            'fax'             => 'numeric',
            'email'           => 'required|email|unique:suppliers',
            'address'         => 'required',
            'tax_id'          => 'required|unique:suppliers',
            'tax_file_number' => 'required|unique:suppliers',
       ]);

       // success response
           /* {
            "status": 200,
            "message": "Done",
            "data": {
                "photo": "https://store.prohussein.com/public/uploads/suppliers/photos/1623188150xmQecTXCJrV9Dyu.png",
                "contact_person": "test supplier 3",
                "email": "mohdamded@add.com",
                "phone": "01157809060",
                "address": "test address",
                "is_active": "1",
                "tax_id": "1234d56",
                "company_name": "testcompany",
                "tax_file_number": "123d65",
                "fax": "1236589",
                "updated_at": "2021-06-08T21:35:50.000000Z",
                "created_at": "2021-06-08T21:35:50.000000Z",
                "id": 4
            }
            }

            // failed response

            {
                "status": 422,
                "message": "Validation Error",
                "errors": {
                    "email": [
                    "The email has already been taken."
                    ],
                    "tax_id": [
                    "The tax id has already been taken."
                    ],
                    "tax_file_number": [
                    "The tax file number has already been taken."
                    ]
                }
                }

            */



       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $requestArray =  $request->all() ;

         if ($request->hasFile('photo')) {
                $file     = $request->file('photo');
                $fileName = time().Str::random(15).'.'.$file->getClientOriginalExtension();
                $img      = Image::make($request->file('photo'));
                $img->fit(150, 150);
                $img->save(public_path('uploads/suppliers/photos/'. $fileName));
                $url =  url('public/uploads/suppliers/photos/' . $fileName);

                $requestArray = ['photo' => $url] + $request->all() ;
            }

        $row =  $this->supplierModel::create($requestArray);

         return $this->ApiResponse(200, 'Done', null,  $row);


    }// end of store

    public function update($request,$id){

        $row =   $this->supplierModel::FindOrFail($id);

            /**   update supplier
            * url   : https://store.prohussein.com/api/admin/update-supplier/id
            * Method : POST
            */
            $validation = Validator::make($request->all(),[
                'contact_person'  => 'required|string',
                'company_name'    => 'required|string',
                'is_active'       => 'required|numeric', // 0 => not active , 1 => active
                'photo'           => 'mimes:jpeg,jpg,png,gif',
                'phone'           => 'required|digits:11',
                'fax'             => 'numeric',
                'email'           => 'required|email|unique:suppliers,email,'.$id,
                'address'         => 'required',
                'tax_id'          => 'required|unique:suppliers,tax_id,'.$id,
                'tax_file_number' => 'required|unique:suppliers,tax_file_number,'.$id,

            ]);

            // success response
            //                 {
            //   "status": 200,
            //   "message": "Updated Successfully"
            // }

            // failed response

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
                $img->save(public_path('uploads/suppliers/photos/'. $fileName));
                $url =  url('public/uploads/suppliers/photos/' . $fileName);
                $requestArray = ['photo' => $url] + $request->all() ;
            }

        $row->update($requestArray);

        return $this->ApiResponse(200, 'Updated Successfully');
    }// end of update

    public function destroy($id){
        $this->supplierModel::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy


} // end of class

?>
