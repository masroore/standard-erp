<?php
namespace App\Http\Repositories\Stores;
use App\Models\Store\StoUnit;
use App\Http\Interfaces\Stores\StoUnitInterface;
//use App\Http\Traits\ApiDesignTrait;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class StoUnitRepository  implements StoUnitInterface 
{
    //use ApiDesignTrait; 
    private $model; 

    public function __construct(StoUnit $model)
    {
        $this->model = $model;
    }

    public function index(){
     
        $rows = $this->model::get();
       
        return view('backend.stores.units.index', compact('rows'));
  
    }//end of index

    public function create(){
        // $categories = StoCategory::where('parent_id', 0)
        // ->with('childrenCategories')
        // ->get();

        $units = StoUnit::where('base_unit', 0)->get();

        return view('backend.stores.units.create', compact('units'));
    }

    public function store($request){
       
        //dd($request->all());

        $request->validate([
            'unit_code' => 'required|unique:sto_units,unit_code',
            'unit_name' => 'required|unique:sto_units,unit_name',
          
        ]);  

       if($request->base_unit == 0){
           $operator        = null ; 
           $operation_value = null ; 
       }else {
            $operator        = $request->operator ; 
            $operation_value = $request->operation_value ; 
       }

        $requestArray = ['operator' => $operator , 'operation_value' => $operation_value] + $request->all() ; 
            
        $row =  $this->model->create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store


    public function edit($id){
        $row =  $this->model->FindOrFail($id);
        $units = StoUnit::get();
        return view('backend.stores.units.edit', compact('units','row'));
    }

    public function update($request ,$id){

        //dd($id);
        $request->validate([
            'unit_code' => 'required|unique:sto_units,unit_code,' . $id,
            'unit_name' => 'required|unique:sto_units,unit_name,' . $id,
        ]);
       
    
        if($request->base_unit == 0){
            $operator        = null ; 
            $operation_value = null ; 
        }else {
             $operator        = $request->operator ; 
             $operation_value = $request->operation_value ; 
        }
 
         $requestArray = ['operator' => $operator , 'operation_value' => $operation_value] + $request->all() ; 

        
        $row =  $this->model->FindOrFail($id);
        
        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Updated Successfully', 'Good Work');
        }
        return redirect()->back();
     
       
    }// end of update

    public function destroy($id){

        //dd($id);
        $this->model::FindOrFail($id)->delete();

        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف بيانات السجل بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Deleted Successfully', 'Good Work');
        }
        return redirect()->back();
      
    }// end of destroy 
} // end of class

?>
 