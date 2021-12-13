<?php

namespace App\Http\Interfaces\Tickets;

interface TicketInterface{

    public function index();

    public function show($request);

    public function store($id);

    public function update($request,$id);

    public function moveTicket($request);

    public function updateStatus($request);

    public function updatePriority($request);

    public function destroy($id);

    public function AddTicketReplay($request);

    public function getTicketReplay($id);

    public function getTicketAttachment($id);

}// end of interface


?>
