<?php
namespace App\Http\Repositories\Stores;
use App\Models\Store\StoBrand;
use App\Http\Interfaces\Stores\StoBrandInterface;
//use App\Http\Traits\ApiDesignTrait;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class StoBrandRepository  implements StoBrandInterface
{
    //use ApiDesignTrait;
    private $model;

    public function __construct(StoBrand $model)
    {
        $this->model = $model;
    }

    public function index(){

        $rows = $this->model::orderBy('id','desc')->get();
        return view('backend.stores.brands.index', compact('rows'));

    }//end of index


    public function store($request){

       // dd($request->all());

        $request->validate([
            'title_ar' => 'required|unique:sto_brands,title_ar',
            'title_en' => 'required|unique:sto_brands,title_en',
        ]);


        $requestArray =  $request->all() ;
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
            'title_en' => 'required|unique:sto_brands,title_en,' . $id,
            'title_ar' => 'required|unique:sto_brands,title_ar,' . $id,
        ]);

        $requestArray = $request->all();

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
