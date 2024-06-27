<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Attraction;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartControler extends Controller
{
    public function add(Request $request, $id){
        $idUser = Auth::id();

        if (!$idUser) {
            return response()->json('Пользователь не авторизирован', 401);
        }

        $request->validate([
            'attraction_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $attraction = Attraction::find($id);
        if (!$attraction) {
            throw new ApiException(404, 'Not Found');
        }

        $cart = new Cart([
            'user_id' => $idUser,
            'attraction_id' => $id,
            'quantity' => $request->input('quantity'),
            'price' => $attraction->price*$request->input('quantity'),
        ]);

        $cart->save();

        return response()->json(['message' => 'Аттракцион добавлен в корзину'], 201);
    }

    public function show($id){
        $cart = Cart::find($id);
        if (!$cart) {
            throw new ApiException(404, 'Not Found');
        }
        return response()->json($cart)->setStatusCode(200);
    }

    public function delete($id){
        $cart = Cart::find($id);
        if (!$cart) {
            throw new ApiException(404, 'Not Found');
        }
        $cart->delete();
        return response()->json('корзина удалена')->setStatusCode(200);
    }

}
