<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createRole(Request $request){

        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }

        $roles = new Role([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);
        if (!$roles){
            throw new ApiException(422, 'Unprocessable Entity');
        }
        $roles->save();
        return response()->json('Сохранено')->setStatusCode(200);
    }

    public function readRole(){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }

        $roles = Role::all();

        if ($roles->isEmpty()) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($roles)->setStatusCode(200);
    }

    public function updateRole(Request $request, $id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }

        $roles = Role::find($id);
        if (!$roles) {
            throw new ApiException(404, 'Not Found');
        }
        $roles->update($request->all());
        return response()->json('Категория обновлена')->setStatusCode(200);
    }

    public function deleteRole($id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }

        $role = Role::find($id);
        if (!$role) {
            throw new ApiException(404, 'Not Found');
        }
        $role->delete();
        return response()->json('Категория удалена')->setStatusCode(200);
    }

    public function updateUser(UserUpdateRequest $request, $id){
        $user = User::find($id);
        if (!$user) {
            throw new ApiException(404, 'Not Found');
        }
        $user->update($request->all());
        return response()->json($user)->setStatusCode(200);
    }

    public function deleteUser($id){
        $user = User::find($id);
        if (!$user) {
            throw new ApiException(404, 'Not Found');
        }
        $user->delete();
        return response()->json('Пользователь удален')->setStatusCode(200);
    }
}
