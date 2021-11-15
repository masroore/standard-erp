<?php
namespace App\Http\Repositories\Hr;
use App\Models\Department;
use App\Http\Traits\ApiDesignTrait;
use App\Http\Interfaces\Hr\DepartmentInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use DB;
class DepartmentRepository implements DepartmentInterface
{
    use ApiDesignTrait;

    private $departmentModel;

    public function __construct(Department $department)
    {
        $this->departmentModel = $department;
    }

    public function index(){
       $dpartments =  $this->departmentModel::get();
        return $this->ApiResponse(200, 'Done', null,  $dpartments);
    }//end of index

    public function getById($id){
        $row =  $this->departmentModel::where('id', $id)->get();
        return $this->ApiResponse(200, 'Done', null,  $row);
    }


    public function store($request){
        $validation = Validator::make($request->all(),[
            'name_ar' => 'required|string', 
            'name_en' => 'required|string',
       ]);

       if($validation->fails())
       {
           return $this->ApiResponse(422,'Validation Error', $validation->errors());
       }

        $dpartment =   $this->departmentModel::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en
        ]);
    
         return $this->ApiResponse(200, 'Done', null,  $dpartment);
       
       
    }// end of store 

    public function update($request){
        
        $validation = Validator::make($request->all(),[
            'name_ar' => 'required',
            'name_en' => 'required',
            'department_id' => 'required|exists:departments,id'
        ]);
        
        if($validation->fails())
        {
            return $this->ApiResponse(422,'Validation Error', $validation->errors());
        }

        $dpartment =   $this->departmentModel::FindOrFail($request->department_id);
        
        $dpartment->name_ar = $request->name_ar ;
        $dpartment->name_en = $request->name_en ;
        $dpartment->save();

        return $this->ApiResponse(200, 'Updated Successfully');
    

    }// end of update 

    public function destroy($request){
        $validation = Validator::make($request->all(),[
            'department_id' => 'required|exists:departments,id'
        ]);
        
        if($validation->fails())
        {
            return $this->ApiResponse(422,'Validation Error', $validation->errors());
        }

        $this->departmentModel::FindOrFail($request->department_id)->delete();
        return $this->ApiResponse(200, 'Deleted Successfully', null);
    }// end of destroy 


} // end of class

?>
