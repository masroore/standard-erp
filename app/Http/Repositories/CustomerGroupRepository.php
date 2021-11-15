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


    public function __construct(CustomerGroup $customerGroup)
    {
        $this->customerGroupModel = $customerGroup;
    }

    public function index(){
        $routeName = 'customers';
        $rows = CustomerGroup::get();
        return view('backend.customerGroup.index',compact('routeName','rows'));
    }//end of index


    public function store($request){

        $request->validate([
            'name' => 'required|string|unique:customer_groups,name',
            'percent' => 'required|integer|max:100',
            'is_active' => 'string|max:3',
        ]);
        ($request->is_active == 'on')? $is_active = '1' : $is_active = '0';

        $requestArray =['is_active'=> $is_active]+$request->all();

       $this->customerGroupModel->create($requestArray);
        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء جروب جديد بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Group Created Successfully', 'Good Work');
        }
        return redirect()->back();

    }// end of store

    public function update($request,$id){
        $request->validate([
            'name' => 'required|string|unique:customer_groups,name,'. $id,
            'percent' => 'required|integer|max:100',
            'is_active' => 'string|max:3',
        ]);

            ($request->is_active == 'on')? $is_active = '1' : $is_active = '0';
            $requestArray =['is_active'=> $is_active]+$request->all();
            $customerGroup =   $this->customerGroupModel::FindOrFail($id);

            $customerGroup->update($requestArray);

            if( config('app.locale') == 'ar'){
                alert()->success('تم تعديل الجروب  بنجاح', 'عمل رائع');
            }else{
                alert()->success('The Group Updated Successfully', 'Good Work');
            }
            return redirect()->back();


    }// end of update

    public function destroy($id){
        $this->customerGroupModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف الجروب  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The Group Deleted Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of destroy


} // end of class

?>
