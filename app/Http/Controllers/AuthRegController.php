<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\UserCreateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthRegController extends Controller
{
    public function create(UserCreateRequest $request){
        $users = new User($request->all());
        if (!$users){
            throw new ApiException(422, 'Unprocessable Entity');
        }
        $users->save();
        return response()->json('Регистрация успешна')->setStatusCode(200);
    }

    public function login(Request $request){
        $user = User::where('login', $request->login)
            ->where('password', $request->password)
            ->first();

        if (!$user) {
            throw new ApiException(422, 'Unprocessable Entity');
        }

        $newToken = Hash::make(microtime(true) * 1000);

        $user->api_token = $newToken;
        $user->save();

        return response()->json($user->api_token)->setStatusCode(200);
    }

    public function logout(Request $request) {
        $user = $request->user();

        if (!$user) {
            throw new ApiException(401, 'Unauthorized');
        }

        $user->api_token = null;

        $user->save();

        return response()->json('Вы успешно вышли из аккаунта')
            ->setStatusCode(200);

    }
}
