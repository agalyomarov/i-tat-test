<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $data = $request->validated();
            $data['token'] = Str::replace('-', '', Str::uuid() . Str::uuid());
            $data['password'] = Hash::make($data['password']);
            $data['token_session_expired'] = now()->addMinutes(env('SESSION_LIFETIME'));
            User::create($data);
            return ['success' => true, 'result' => $data['token']];
        } catch (\Exception $e) {
            return ['success' => false, 'errror' => $e->getMessage()];
        }
    }
}
