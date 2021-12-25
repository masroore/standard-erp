<?php

namespace App\Http\Controllers\BackEnd\Tickets;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Tickets\TicketInterface;
use Illuminate\Http\Request;

class TicketController extends Controller
{
     private $ticketInterface;

    public function __construct(TicketInterface $ticketInterface){
        $this->ticketInterface = $ticketInterface ;
    }// end of constructor

    public function index(){
      return $this->ticketInterface->index();
    }

    public function show($id){
      return $this->ticketInterface->show($id);
    }

    public function store(Request $request){
      return $this->ticketInterface->store($request);
    }

    public function update(Request $request,$id){
      return $this->ticketInterface->update($request,$id);
    }

    public function moveTicket(Request $request){
      return $this->ticketInterface->moveTicket($request);
    }

    public function updateStatus(Request $request){
      return $this->ticketInterface->updateStatus($request);
    }

    public function updatePriority(Request $request){
      return $this->ticketInterface->updatePriority($request);
    }

    public function destroy($id){
      return $this->ticketInterface->destroy($id);
    }// end of destroy

    public function AddTicketReplay(Request $request){
       return $this->ticketInterface->AddTicketReplay($request);
    }

    public function getTicketReplay($id){
      return $this->ticketInterface->getTicketReplay($id);
    }

    public function getTicketAttachment($id){
      return $this->ticketInterface->getTicketAttachment($id);
    }
}
