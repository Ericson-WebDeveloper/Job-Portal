<?php
namespace App\Traits;

use App\Mail\ApplicationStatus;
use App\Mail\MailVerifyAccount;
use App\Mail\ResetPassMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait SendingEmail {

    public function sendEmail($to, $status, $job, $user)
    {
        try {
            Mail::to($to)->send(new ApplicationStatus($status, $job, $user));
            return true;
        } catch (\Exception $e) {
            return false;
        }
        
    }

    public function sendEmailResetPass($to, $user, $token)
    {
        Log::info("send email");
        try {
            Mail::to($to)->send(new ResetPassMail($user, $token));
            return true;
        } catch (\Exception $e) {
            return false;
        }
        
    }

    public function sendEmailVerifyAccount($to, $user, $token)
    {
        try {
            Mail::to($to)->send(new MailVerifyAccount($user, $token));
            return true;
        } catch (\Exception $e) {
            return false;
        }
        
    }
}