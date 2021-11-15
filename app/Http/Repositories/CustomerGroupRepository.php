<?php
namespace App\Http\Repositories;
use App\Models\CustomerGroup;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\CustomerGroupInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
class CustomerGroupRepository  implements CustomerGroupInterface
{
    use ApiDesignTrait;

     private $customerGroupModel;

    public function __construct(CustomerGroup $customerGroup)
    {
        $this->customerGroupModel = $customerGroup;
    }

    public function index(){
       $customerGroups =  $this->customerGroupModel::select('id' , 'name', 'percent')->get();
        return $this->ApiResponse(200, 'Done', null,  $customerGroups);
    }//end of index


    public function store($request){
       // dd('welcome');

        $validation = Validator::make($request->all(),[
            'name' => 'required', 
       ]);

       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $customerGroup =   $this->customerGroupModel::create([
            'name' => $request->name,
            'percent' => $request->percent,
            'is_active' => $request->is_active,
        ]); 

         return $this->ApiResponse(200, 'Done', null,  $customerGroup);
       
       
    }// end of store 

    public function update($request,$id){
        $customerGroup =   $this->customerGroupModel::FindOrFail($id);
            $validation = Validator::make($request->all(),[
                'name' => 'required'
            ]);

            if($validation->fails())
            {
                return $this->ApiResponse(422,'Validation Error', $validation->errors());
            }
        
    
        $customerGroup->name      = $request->name ;
        $customerGroup->percent   = $request->percent ;
        $customerGroup->is_active = $request->is_active ;
        $customerGroup->save();

        return $this->ApiResponse(200, 'Updated Successfully');
    

    }// end of update 

    public function destroy($id){
        $this->customerGroupModel::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
