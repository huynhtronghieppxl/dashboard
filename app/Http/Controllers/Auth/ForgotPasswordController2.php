<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ForgotPasswordController2 extends Controller
{
    public function show()
    {
        return view("auth/forgot_password2");
    }
}
