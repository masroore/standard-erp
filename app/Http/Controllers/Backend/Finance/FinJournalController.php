<?php

namespace App\Http\Controllers\Backend\Finance;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Finance\FinJournalInterface;
use Illuminate\Http\Request;

class FinJournalController extends Controller
{
    private $finJournalInterface;

    public function __construct(FinJournalInterface $finJournalInterface){
        $this->finJournalInterface = $finJournalInterface ;
        $this->middleware('auth');
    }// end of constructor

    public function index(){
      return $this->finJournalInterface->index();
    }

    public function create(){
        return $this->finJournalInterface->create();
    }

    public function store(Request $request){
      return $this->finJournalInterface->store($request);
    }

    public function edit($id){
        return $this->finJournalInterface->edit($id);
      }// end of edit

    public function update(Request $request ,$id){
      return $this->finJournalInterface->update($request,$id);
    }

    public function destroy($id){
      return $this->finJournalInterface->destroy($id);
    }// end of destroy
}

