<?php
namespace App\Services;

use App\Jobs\SendOtpEmail;
use App\Mail\SendOtp;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    public function register($data)
    {
        $data['otp'] = rand(100000, 999999);
        $user = User::create($data);
        $user->assignRole('client');
        $token = $user->createToken('auth_token')->plainTextToken;
        SendOtpEmail::dispatch($user, $data['otp']);
        return ['user' => $user, 'token' => $token];
    }
    public function login($data)
    {
        if (!auth()->attempt($data)) {
            return null;
        }
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
    }
    public function verify($data){
        $user = auth()->user();
       if($user->otp==$data['otp']){
        $user->update(['otp'=>null,'email_verified_at'=>now()]);
        return true;
       }
       return false;
    }
}
