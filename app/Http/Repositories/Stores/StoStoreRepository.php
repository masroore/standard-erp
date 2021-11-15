<?php
namespace App\Http\Repositories\Stores;
use App\Models\Store\StoStore;
use App\Models\User;
use App\Http\Interfaces\Stores\StoStoreInterface;
//use App\Http\Traits\ApiDesignTrait;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class StoStoreRepository  implements StoStoreInterface
{
    //use ApiDesignTrait; 
    private $model; 

    public function __construct(StoStore $model)
    {
        $this->model = $model;
    }

    public function index(){
        $users = User::get();
        $rows  = $this->model::with('user')->get();
        return view('backend.stores.stores.index', compact('rows','users'));
  
    }//end of index


    public function store($request){
       
       // dd($request->all());

        $request->validate([
            'title_ar' => 'required|unique:sto_stores,title_ar',
            'title_en' => 'required|unique:sto_stores,title_en',
        ]);  

        if($request->is_active){$status = $request->is_active; }else{$status = 0;}

        if($request->branch_id){$branch = $request->branch_id;}else{$branch = 1;}

        $requestArray =  ['is_active' => $status, 'branch_id' =>$branch ] + $request->all() ;
           //dd($requestArray);
        $row =  $this->model->create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of store

    public function update($request,$id){
       //dd($id);

        $request->validate([
            'title_en' => 'required|unique:sto_stores,title_en,' . $id,
            'title_ar' => 'required|unique:sto_stores,title_ar,' . $id,
        ]);
    
        if($request->is_active){$status = $request->is_active; }else{$status = 0;}

        if($request->branch_id){$branch = $request->branch_id;}else{$branch = 1;}

        $requestArray =  ['is_active' => $status, 'branch_id' =>$branch ] + $request->all() ;
        
        $row =  $this->model->FindOrFail($id);
        
        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل السجل  بنجاح', 'عمل رائع'); 
        }
        else{
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
 