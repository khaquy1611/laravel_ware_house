<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {

    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember_me'))) {
            $request->session()->regenerate();
            return response()->json(['success' => true, 'message' => 'Đăng nhập thành công'], 200);
        }

        return response()->json(['success' => false , 'message' => 'Email hoặc mật khẩu bị sai'], 401);
    }
}
