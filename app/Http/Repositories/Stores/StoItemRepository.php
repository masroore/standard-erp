<?php
namespace App\Http\Repositories\Stores; 
use App\Models\Store\StoItem;
use App\Models\Store\StoCategory;
use App\Models\Store\StoBrand;
use App\Http\Interfaces\Stores\StoItemInterface;
//use App\Http\Traits\ApiDesignTrait;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;
use Auth;


class StoItemRepository  implements StoItemInterface
{
    //use ApiDesignTrait; 
    private $model; 

    public function __construct(StoItem $model)
    {
        $this->model = $model;
    }

    public function index(){
       
        $rows = $this->model::get();
        return view('backend.stores.items.index', compact('rows'));
  
    }//end of index

    public function create(){
        $categories = StoCategory::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $brands     = StoBrand::get();

        return view('backend.stores.items.create', compact('categories','brands'));
    }


    public function store($request){
       
       // dd($request->all());

        $request->validate([
            'title_ar' => 'required|unique:sto_items,title_ar',
            'title_en' => 'required|unique:sto_items,title_en',
            'code'     => 'required|unique:sto_items,title_en',
        ]);  
        $fileName = null;
        if($request->photo){
       
            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();;
            $img          = Image::make($img);
           
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/stores/items/images/'. $fileName));
        }

        if($request->branch_id){$branch = $request->branch_id;}else{$branch = 1;}
        $requestArray =   ['created_by' => Auth::user()->id, 'branch_id' =>$branch ,'image' => $fileName] + $request->all() ;
           //dd($requestArray);
        $row =  $this->model->create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store

    public function edit($id){
        $categories = StoCategory::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $brands     = StoBrand::get();
        $row        =  $this->model->FindOrFail($id);
        return view('backend.stores.items.edit', compact('categories','brands','row'));
    }

    public function update($request,$id){
       //dd($id);

        $request->validate([
            'title_en' => 'required|unique:sto_items,title_en,' . $id,
            'title_ar' => 'required|unique:sto_items,title_ar,' . $id,
            'code'     => 'required|unique:sto_items,code,' . $id,
        ]);
        $row =  $this->model->FindOrFail($id);

        if($request->photo){
       
            $img          = $request->photo;
            $fileName     = time().Str::random('10').'.'.$img->getClientOriginalExtension();;
            $img          = Image::make($img);
           
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path('uploads/stores/items/images/'. $fileName));

            $row->image      = $fileName ;
            $requestArray =   ['image' => $fileName] + $request->all() ;
        }

        
    
        if($request->branch_id){$branch = $request->branch_id;}else{$branch = 1;}

        $requestArray =   ['updated_by' => Auth::user()->id, 'branch_id' =>$branch ] + $request->all() ;
        
        
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
 