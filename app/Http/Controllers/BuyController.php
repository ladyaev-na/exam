<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    public function buyCart($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            throw new ApiException(404, 'Not Found');
        }

        $order = new Order([
            'attraction_id' => $cart->attraction_id,
            'quantity' => $cart->quantity,
            'price' => $cart->price,
        ]);

        $olderList = new OrderList([
           'order_id' => $order->id,
            'name' => 'a',
        ]);

        $order->save();
        $olderList->save();
        return response()->json('Товар куплен', 200);
    }
}
