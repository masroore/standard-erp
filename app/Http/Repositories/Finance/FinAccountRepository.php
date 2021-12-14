<?php
namespace App\Http\Repositories\Finance;
use App\Models\Finance\FinAccount;
use App\Models\Finance\FinCategory;
use App\Http\Interfaces\Finance\FinAccountInterface;
use App\Http\Repositories\LaravelLocalization;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image;


class FinAccountRepository  implements FinAccountInterface
{

    private $model;

    public function __construct(FinAccount $model)
    {
        $this->model = $model;
    }

    public function index(){
        $cats           = FinCategory::get();
        $rows      = $this->model::get();
        $routeName = 'accounts';

        $categories  = $this->model::orderBy('order_account','asc')->where('parent_id', 0)
        ->with('childrenCategories')
        ->get();

       // dd($categories);


        return view('backend.finance.accounts.index', compact('rows','routeName','cats','categories'));

    }//end of index

    public function create(){
        $cats      = FinCategory::get();
        $routeName = 'accounts';
        $categories  = $this->model::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();

        return view('backend.finance.accounts.create' , compact('categories','cats','routeName'));
    }// end of create

    public function store($request){

        //dd($request->all());

        $request->validate([
            'title_ar' => 'required|unique:fin_accounts,title_ar',
            'title_en' => 'required|unique:fin_accounts,title_en',
            'parent_id'=> 'required',
        ]);

        if($request->parent_id != 0){
            $accountLevel = $this->model::where('id' , $request->parent_id)->first();
            $accountLevel = $accountLevel->level + 1 ;
        }elseif($request->parent_id == 0){
            $accountLevel = 1 ;
        }

        $requestArray = ['level' => $accountLevel ] + $request->all() ;

        $row =  $this->model->create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء سجل جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Recourd Created Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of store


    public function edit($id){
        $cats      = FinCategory::get();
        $routeName = 'accounts';
        $categories  = $this->model::where('parent_id', 0)
        ->with('childrenCategories')
        ->get();
        $row = $this->model::where('id', $id)->first();

        return view('backend.finance.accounts.edit' , compact('categories','cats','routeName','row'));
    }// end of edit

    public function update($request,$id){
     //  dd($id);

        $request->validate([
            'title_en' => 'required|unique:fin_accounts,title_en,'.$id,
            'title_ar' => 'required|unique:fin_accounts,title_ar,'.$id,
            'parent_id'=> 'required',
        ]);

        if($request->parent_id != 0){
            $accountLevel = $this->model::where('id' , $request->parent_id)->first();
            $accountLevel = $accountLevel->level + 1 ;
        }elseif($request->parent_id == 0){
            $accountLevel = 1 ;
        }

        $requestArray = $requestArray = ['level' => $accountLevel ] + $request->all() ;

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
