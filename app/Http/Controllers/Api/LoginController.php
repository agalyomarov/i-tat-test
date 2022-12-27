<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $auth_data = $request->validated();
            $user = User::where('email', $auth_data['email'])->first();
            if (!$user) throw new \Exception('user not found');
            if (!Hash::check($auth_data['password'], $user->password)) throw new \Exception("password don't valid");
            $data['token'] = Str::replace('-', '', Str::uuid() . Str::uuid());
            $data['token_session_expired'] = now()->addMinutes(env('SESSION_LIFETIME'));
            User::where('email', $user->email)->update($data);
            return ['success' => true, 'result' => $data['token']];
        } catch (\Exception $e) {
            return ['success' => false, 'errror' => $e->getMessage()];
        }
    }
}
