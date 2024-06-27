<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\NewCreateRequest;
use App\Http\Requests\NewUpdateRequest;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewController extends Controller
{
    public function create(NewCreateRequest $request){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $new = new Events($request->all());
        if(!$new){
            throw new ApiException(422, 'Unprocessable Entity');
        }else{
            $new->save();
        }
        return response()->json($new)->setStatusCode(200);
    }

    public function showAll(){
        $news = Events::all();
        if ($news->isEmpty()) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($news)->setStatusCode(200);
    }

    public function show($id){
        $new = Events::find($id);
        if (!$new) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($new)->setStatusCode(200);
    }

    public function update(NewUpdateRequest $request, $id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $new = Events::find($id);
        if (!$new) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($new)->setStatusCode(200);
    }

    public function delete($id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $new = Events::find($id);
        if (!$new) {
            throw new ApiException(404, 'Not Found');
        }
        $new->delete();
        return response()->json('delete')->setStatusCode(200);
    }
}
