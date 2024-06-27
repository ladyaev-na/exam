<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\AttractionCreateRequest;
use App\Http\Requests\CAttractionCreateRequest;
use App\Http\Requests\CAttractionUpdateRequest;
use App\Models\Attraction;
use App\Models\CategoryAttraction;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttractionController extends Controller
{
    public function createC(CAttractionCreateRequest $request){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $category = new CategoryAttraction($request->all());
        if(!$category){
            throw new ApiException(422, 'Unprocessable Entity');
        }else{
            $category->save();
        }
        return response()->json('Категория добавлена')->setStatusCode(200);
    }

    public function create(AttractionCreateRequest $request){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $attraction = new Attraction($request->all());
        if(!$attraction){
            throw new ApiException(422, 'Unprocessable Entity');
        }else{
            $attraction->save();
        }
        return response()->json('Аттракцион добавлен')->setStatusCode(200);
    }

    public function showAllC(){
        $categories = CategoryAttraction::all();
        if ($categories->isEmpty()) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($categories)->setStatusCode(200);
    }

     public function showAll(){
        $attraction = Attraction::all();
         if ($attraction->isEmpty()) {
             throw new ApiException(404, 'Not Found');
         }
        return response()->json($attraction)->setStatusCode(200);
    }



    public function showC($id){
        $category = CategoryAttraction::find($id);
        if (!$category) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($category)->setStatusCode(200);
    }
     public function show($id){
        $attraction = Attraction::find($id);
         if (!$attraction) {
             throw new ApiException(404, 'Not Found');
         }
        return response()->json($attraction)->setStatusCode(200);
    }


    public function updateC(CAttractionUpdateRequest $request, $id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $category = CategoryAttraction::find($id);
        if (!$category) {
            throw new ApiException(404, 'Not Found');
        }
        $category->update($request->all());
        return response()->json($category)->setStatusCode(200);
    }

     public function update(CAttractionUpdateRequest $request, $id){
         $user = Auth::user()->role_id;
         if ($user != 2){
             throw new ApiException(403, 'Forbidden');
         }
        $attraction = Attraction::find($id);
         if (!$attraction) {
             throw new ApiException(404, 'Not Found');
         }
        $attraction->update($request->all());
        return response()->json($attraction)->setStatusCode(200);
    }

    public function deleteC($id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $category = CategoryAttraction::find($id);
        if (!$category) {
            throw new ApiException(404, 'Not Found');
        }
        $category->delete();
        return response()->json('delete')->setStatusCode(200);
    }

    public function delete($id){
        $user = Auth::user()->role_id;
        if ($user != 2){
            throw new ApiException(403, 'Forbidden');
        }
        $attraction = Attraction::find($id);
        if (!$attraction) {
            throw new ApiException(404, 'Not Found');
        }
        $attraction->delete();
        return response()->json('delete')->setStatusCode(200);
    }
}
