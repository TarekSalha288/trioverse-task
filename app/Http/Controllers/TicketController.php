<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicket;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    use BaseResponse;
    private $ticketService;
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }
    public function createTicket(CreateTicket $request)
    {
        try{
            $data=$request->validated();
            $data['user_id']=auth()->id();
            $ticket = $this->ticketService->createTicket($data);
            return $this->successResponse('Ticket created successfully', TicketResource::make($ticket), 201);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function getTickets()
    {
        try{
            $tickets = $this->ticketService->getTickets();
            return $this->successResponse('Tickets retrieved successfully', $tickets, 200);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function getTicketById( $ticketId)
    {
        try{
            $ticket = $this->ticketService->getTicketById($ticketId);
            if (!$ticket) {
                return $this->errorResponse('Ticket not found', 404);
            }
            return $this->successResponse('Ticket retrieved successfully', TicketResource::make($ticket), 200);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
}
