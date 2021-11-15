<?php
namespace App\Http\Repositories\Settings;

use App\Http\Interfaces\Settings\TaxInterface;
use App\Models\Customer;
use App\Http\Traits\ApiDesignTrait;

use App\Models\Settings\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;

class TaxRepository  implements TaxInterface
{
    use ApiDesignTrait;

     private $TaxModel;

    public function __construct(Tax $Tax)
    {
        $this->TaxModel = $Tax;
    }

    public function index(){
        $routeName = 'tax';
        $taxes  = $this->TaxModel->get();
        return view('backend.taxes.index',compact('routeName','taxes'));
    }//end of index

    public function store($request){

        $request->validate([
            'name'            => 'required|string|unique:taxes,name',
            'rate'       => 'required|numeric',

       ]);
        $requestArray =  $request->all();
        $this->TaxModel->create($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم انشاء ضريبه  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The tax created Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.tax.index');

    }// end of store

    public function update($request,$id){



        $request->validate([
                'name'            => 'required|unique:taxes,name,'.$id,
                'rate'       => 'required|numeric',
            ]);


            $row =   $this->TaxModel::FindOrFail($id);


        $requestArray = $request->all();



        $row->update($requestArray);

        if( config('app.locale') == 'ar'){
            alert()->success('تم تعديل ضريبه  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The tax updated Successfully', 'Good Work');
        }
        return redirect()->route('dashboard.tax.index');
    }// end of update

    public function destroy($id){+

        $this->TaxModel::FindOrFail($id)->delete();
        if( config('app.locale') == 'ar'){
            alert()->success('تم حذف ضريبه  بنجاح', 'عمل رائع');
        }else{
            alert()->success('The tax Deleted Successfully', 'Good Work');
        }
        return redirect()->back();
    }// end of destroy


} // end of class

?>
