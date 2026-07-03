<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplay;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;
use App\Services\ReplayService;

class ReplayController extends Controller
{
    use BaseResponse;
    private $replayService;
    public function __construct(ReplayService $replayService)
    {
        $this->replayService = $replayService;
    }
    public function createReplay(CreateReplay $request)
    {
        try{
            $data = $request->all();
            $replay = $this->replayService->createReplay($data);
            return $this->successResponse('Replay created successfully', $replay,201);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }

    }
    public function getReplays()
    {
        try{
            $replays = $this->replayService->getReplays();
            return $this->successResponse('Replays retrieved successfully', $replays);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function getReplayById($replayId)
    {
        try{
            $replay = $this->replayService->getReplayById($replayId);
            if (!$replay) {
                return $this->errorResponse('Replay not found', 404);
            }
            return $this->successResponse('Replay retrieved successfully', $replay);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
}
