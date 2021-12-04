<?php
namespace App\Http\Repositories\Stores;
use App\Models\Store\StoCategory;
use App\Http\Interfaces\Stores\StoCategoryInterface;
//use App\Http\Traits\ApiDesignTrait;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class StoCategoryRepository  implements StoCategoryInterface
{
    //use ApiDesignTrait;
    private $model;

    public function __construct(StoCategory $model)
    {
        $this->model = $model;
    }

    public function index(){

        $rows = $this->model::orderBy('id','desc')->get();
        $categories = StoCategory::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();
        return view('backend.stores.categories.index', compact('rows','categories'));

    }//end of index

    public function create(){
        $categories = StoCategory::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();

        return view('backend.stores.categories.create', compact('categories'));
    }

    public function store($request){

        //dd($request->all());

        $request->validate([
            'title_ar' => 'required|unique:sto_categories,title_ar',
            'title_en' => 'required|unique:sto_categories,title_en',
            'parent_id'=> 'required',
        ]);

        if($request->parent_id != 0){
            $catLevel = $this->model::where('id' , $request->parent_id)->first();
            $catLevel = $catLevel->level +1 ;
            //dd($catLevel);
        }elseif($request->parent_id == 0){
            $catLevel = 1 ;
            //dd($catLevel);
        }

        $requestArray = ['level' => $catLevel ] + $request->all() ;

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
        $categories = StoCategory::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        return view('backend.stores.categories.edit', compact('categories','row'));
    }

    public function update($request ,$id){

        //dd($id);
        $request->validate([
            'title_en' => 'required|unique:sto_categories,title_en,' . $id,
            'title_ar' => 'required|unique:sto_categories,title_ar,' . $id,
            'parent_id'=> 'required',
        ]);


        if($request->parent_id != 0){
            $catLevel = $this->model::where('id' , $request->parent_id)->first();
            $catLevel = $catLevel->level +1 ;
            //dd($catLevel);
        }elseif($request->parent_id == 0){
            $catLevel = 1 ;
            //dd($catLevel);
        }

        $requestArray = ['level' => $catLevel ] + $request->all() ;


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
