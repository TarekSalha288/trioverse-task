<?php
namespace App\Services;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Support\Facades\Notification;

class TicketService
{
    public function createTicket($data)
    {
        $ticket = Ticket::create($data);
        $employees = User::role('employee')->get();
    if ($employees->isNotEmpty()) {
        Notification::send($employees, new NewTicketNotification($ticket));
    }
        return $ticket->load(['user', 'replays.user']);
    }

    public function getTicketById($ticketId)
    {
        $user = auth()->user();
        $ticket = Ticket::with(['user', 'replays.user'])->find($ticketId);
        if (!$ticket) {
          return null;
        }
        if (! $user->can('manage all tickets') && $ticket->user_id !== $user->id) {

           throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to view this ticket.',403);
        }
        return $ticket;
    }

    public function getTickets()
    {
        $per_page = (int) request()->input('per_page', 10);
        $user = auth()->user();
        $query = Ticket::with(['user', 'replays.user']);
        if ($user->can('manage all tickets')) {
            return $query->paginate($per_page);
        } else {
            return $query->where('user_id', $user->id)->paginate($per_page);
        }
    }
}
