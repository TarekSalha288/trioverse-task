<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use App\Traits\BaseResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use BaseResponse;
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        try{
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $user = $this->authService->register($data);
            return $this->successResponse('User registered successfully. Please check your email for verification.', $user, 201);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function login(LoginRequest $request)
    {
        try{
            $data = $request->validated();
            $result = $this->authService->login($data);
            if (!$result) {
                return $this->errorResponse('Invalid credentials', 401);
            }
            return $this->successResponse('Login successful', $result);
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function logout()
    {
        try{
            $this->authService->logout();
            return $this->successResponse('Logout successful');
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
    public function verify(Request $request)
    {
        try{
            $data=$request->validate([
            'otp' => 'required|integer|digits:6',
            ]);
            $result = $this->authService->verify($data);
           if (!$result) {
              return $this->errorResponse('Invalid OTP', 401);
            }
             return $this->successResponse('OTP verified successfully');
        }catch(\Exception $e){
            return $this->exceptionResponse($e);
        }
    }

}
