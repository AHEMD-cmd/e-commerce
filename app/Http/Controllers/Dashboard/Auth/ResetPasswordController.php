<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Auth\PasswordService;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ResetPasswordController extends Controller implements HasMiddleware
{
    protected $PasswordService;
    public function __construct(PasswordService $PasswordService)
    {
        $this->PasswordService = $PasswordService;
    }

    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function showResetForm($email, $token)
    {   
        $is_valid = $this->PasswordService->verifyOtp(['email' => $email , 'token' => $token]);

        if (!$is_valid) {
            return redirect()->route('dashboard.password.email');
        }

        return view('dashboard.auth.password.reset', ['email' => $email]);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $admin = $this->PasswordService->resetPassword($request->email, $request->password);
        if (!$admin) {
            return redirect()->back()->with(['error' => 'Try Again Latter!']);
        }

        return redirect()->route('dashboard.login')->with('success', 'Your Password Updated Successfully!');
    }
}
