<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Notifications\SendOtpNotify;
use App\Services\Auth\PasswordService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ForgotPasswordController extends Controller implements HasMiddleware
{
    protected $otp2;
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
        $this->otp2  = new Otp;
    }

    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function showEmailForm()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendEmail(ForgotPasswordRequest $request)
    {
        $admin = $this->passwordService->verifyEmail($request->email);
        if (!$admin) {
            return redirect()->back()->withErrors(['email' => __('passwords.email_is_not_regiterd')]);
        }
        return redirect()->back()->with(['success' => __('passwords.check_your_email')]);
    }
 
}
