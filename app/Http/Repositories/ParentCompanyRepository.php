<?php
namespace App\Http\Repositories;
use App\Models\ParentCompany;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\ParentCompanyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
class ParentCompanyRepository  implements ParentCompanyInterface
{
    use ApiDesignTrait;

     private $parentCompanyModel;

    public function __construct(ParentCompany $parentCompany)
    {
        $this->parentCompanyModel = $parentCompany;
    }

    public function index(){
       $parentCompanies =  ParentCompany::select('id' , 'name', 'code')->get();
        return $this->ApiResponse(200, 'Done', null,  $parentCompanies);
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

        $parentCompany =   ParentCompany::create([
            'name' => $request->name,
            'code' => str_replace(' ', '_', $request->name). '_' . Str::random(5)
        ]);

         
               
         return $this->ApiResponse(200, 'Done', null,  $parentCompany);
       
       
    }// end of store 

    public function update($request,$id){
        $parentCompany =   ParentCompany::FindOrFail($id);
            $validation = Validator::make($request->all(),[
                'name' => 'required'
            ]);

            if($validation->fails())
            {
                return $this->ApiResponse(422,'Validation Error', $validation->errors());
            }
        
    
        $parentCompany->name = $request->name ;
        $parentCompany->save();

        return $this->ApiResponse(200, 'Updated Successfully');
    

    }// end of update 

    public function destroy($id){
        ParentCompany::FindOrFail($id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
