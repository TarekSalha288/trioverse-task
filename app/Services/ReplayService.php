<?php
namespace App\Services;
use App\Models\Replay;
class ReplayService
{
    public function createReplay($data)
    {
        $user= auth()->user();
        if($user->can('manage all tickets')) {
            $data['user_id'] = $user->id;
        } else {
            $ticket = $user->tickets()->find($data['ticket_id']);
            if (!$ticket) {
                throw new \Exception('You do not have permission to create a replay for this ticket.',403);
            }
            $data['user_id'] = $user->id;
        }
        $replay = Replay::create($data);
        return $replay->load(['user', 'ticket.user']);
        }


    public function getReplayById($replayId)
    {
        $user = auth()->user();
        $replay = Replay::with(['user', 'ticket.user'])->find($replayId);
        if (!$replay) {
            return null;
        }
        if (! $user->can('manage all tickets') && $replay->ticket->user_id !== $user->id) {
            throw new \Illuminate\Auth\Access\AuthorizationException('You do not have permission to view this replay.',403);
        }
        return $replay;
    }

    public function getReplays()
    {
        $per_page = (int) request()->input('per_page', 10);
        $user = auth()->user();
        $query = Replay::with(['user', 'ticket.user']);
        if ($user->can('manage all tickets')) {
            return $query->paginate($per_page);
        } else {
            return $query->whereHas('ticket', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->paginate($per_page);
        }
    }
}
