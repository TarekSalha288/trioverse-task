<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:check-valid-otp')]
#[Description('Command description')]
class CheckValidOtp extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
       User::whereNotNull('otp')->where('created_at','<',now()->subMinutes(10))->delete();

    }
}
