<?php
namespace App\Http\Repositories;
use App\Models\BankInfo;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\BankInfoInterface;
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
        
       /**   All Bank info 
        * url   : https://store.prohussein.com/api/admin/all-bank-info
        * Method : POST 

        *response 

                    {
            "status": 200,
            "message": "Done",
            "data": [
                {
                "id": 1,
                "beneficiary_bank_name": "alex",
                "beneficiary_bank_branch": "cairo",
                "beneficiary_bank_address": "cairo new ",
                "beneficiary_bank_street": "10th ffjfjjm",
                "beneficiary_bank_city": "alex",
                "beneficiary_bank_swift_code": "012365441",
                "beneficiary_bank_code": "45d5d55",
                "intermediary_bank_name": "testettetgdgd",
                "beneficiary_name": "dddd",
                "beneficiary_address": "frr252",
                "beneficiary_street": "rr4r44r4",
                "beneficiary_city": "redrf",
                "beneficiary_account_no": "1236547896325877441223",
                "iban_code": "ffds2r5r5fd2g",
                "customer_id": 3,
                "supplier_id": null,
                "created_at": "2021-06-04T16:25:59.000000Z",
                "updated_at": "2021-06-04T16:29:56.000000Z"
                },
                {
                "id": 4,
                "beneficiary_bank_name": "cip",
                "beneficiary_bank_branch": "cairo",
                "beneficiary_bank_address": "cairo new ",
                "beneficiary_bank_street": "10th ffjfjjm",
                "beneficiary_bank_city": "alex",
                "beneficiary_bank_swift_code": "012365441",
                "beneficiary_bank_code": "45d5d55",
                "intermediary_bank_name": "testettetgdgd",
                "beneficiary_name": "dddd",
                "beneficiary_address": "frr252",
                "beneficiary_street": "rr4r44r4",
                "beneficiary_city": "redrf",
                "beneficiary_account_no": "1236547896325877441223",
                "iban_code": "ffds2r5r5fd2g",
                "customer_id": 3,
                "supplier_id": null,
                "created_at": "2021-06-04T16:28:49.000000Z",
                "updated_at": "2021-06-04T16:28:49.000000Z"
                }
            
            ]
            }
        */

        $bankInfo =  $this->bankInfoModel::get();
        return $this->ApiResponse(200, 'Done', null,  $bankInfo);
    }//end of index

    public function getById($id){
        $row =  $this->bankInfoModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }

    public function store($request){
       
 
       /**   Add Bank info 
        * url   : https://store.prohussein.com/api/admin/add-bank-info
        * Method : POST 
        */

        $validation = Validator::make($request->all(),[
            'beneficiary_bank_name'          => 'required|string', 
            'beneficiary_bank_branch'        => 'required|string',
            'beneficiary_bank_address'       => 'required|string',  
            'beneficiary_bank_street'        => 'nullable|string',
            'beneficiary_bank_city'          => 'nullable|string',
            'beneficiary_bank_swift_code'    => 'nullable|string',
            'beneficiary_bank_code'          => 'nullable|string',
            'intermediary_bank_name'         => 'nullable|string',
            'beneficiary_name'               => 'required|string',
            'beneficiary_address'            => 'required|string',
            'beneficiary_street'             => 'string',
            'beneficiary_city'               => 'string',
            'beneficiary_account_no'         => 'string' ,
            'iban_code'                      => 'string' ,
            'customer_id'                    => 'nullable|exists:customers,id' ,
            'supplier_id'                    => 'nullable|exists:suppliers,id' ,
            
       ]); 


       // success response 

       /* 
            *{
        "status": 200,
        "message": "Done",
        "data": {
            "beneficiary_bank_name": "cip0",
            "beneficiary_bank_branch": "cairo",
            "beneficiary_bank_address": "cairo new ",
            "beneficiary_bank_street": "10th ffjfjjm",
            "beneficiary_bank_city": "alex",
            "beneficiary_bank_swift_code": "012365441",
            "beneficiary_bank_code": "45d5d55",
            "intermediary_bank_name": "testettetgdgd",
            "beneficiary_name": "dddd",
            "beneficiary_address": "frr252",
            "beneficiary_street": "rr4r44r4",
            "beneficiary_city": "redrf",
            "beneficiary_account_no": "1236547896325877441223",
            "iban_code": "ffds2r5r5fd2g",
            "supplier_id": null,
            "customer_id": "3",
            "updated_at": "2021-06-08T21:11:20.000000Z",
            "created_at": "2021-06-08T21:11:20.000000Z",
            "id": 5
        }
        }
        */

        // field response
        
        /* 
        {
        "status": 422,
        "message": "Validation Error",
        "errors": {
            "beneficiary_bank_name": [
            "The beneficiary bank name field is required."
            ]
        }
        }
        */
       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $requestArray =  $request->all() ;

         
        $row =  $this->bankInfoModel::create($requestArray);
      
         return $this->ApiResponse(200, 'Done', null,  $row);
       
       
    }// end of store 

    public function update($request,$id){

        $row =   $this->bankInfoModel::FindOrFail($id);

         /**   Updare Bank info 
        * url   : https://store.prohussein.com/api/admin/update-bank-info/id
        * Method : POST 
        */

            $validation = Validator::make($request->all(),[
                'beneficiary_bank_name'          => 'required|string', 
                'beneficiary_bank_branch'        => 'required|string',
                'beneficiary_bank_address'       => 'required|string',  
                'beneficiary_bank_street'        => 'nullable|string',
                'beneficiary_bank_city'          => 'nullable|string',
                'beneficiary_bank_swift_code'    => 'nullable|string',
                'beneficiary_bank_code'          => 'nullable|string',
                'intermediary_bank_name'         => 'nullable|string',
                'beneficiary_name'               => 'required|string',
                'beneficiary_address'            => 'required|string',
                'beneficiary_street'             => 'string',
                'beneficiary_city'               => 'string',
                'beneficiary_account_no'         => 'string' ,
                'iban_code'                      => 'string' ,
                'customer_id'                    => 'nullable|exists:customers,id' ,
                'supplier_id'                    => 'nullable|exists:suppliers,id' ,
            ]);

            // response 

            /*
            {
            "status": 200,
            "message": "Updated Successfully"
            }*/

            if($validation->fails())
            {
                return $this->ApiResponse(422,'Validation Error', $validation->errors());
            }
        
        $requestArray = $request->all();   
        $row->update($requestArray);

        return $this->ApiResponse(200, 'Updated Successfully');
    }// end of update 

    public function destroy($id){

         /**   delete Bank info 
        * url   : https://store.prohussein.com/api/admin/delete-bank-info/id
        * Method : POST 

        // response 

                    {
            "status": 200,
            "message": "Deleted Successfully"
            }
        */
        $this->bankInfoModel::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
