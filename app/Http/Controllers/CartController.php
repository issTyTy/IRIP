<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userCart = $request->user()->cart;

        if (!$userCart) {
            $userCart = Cart::create(['user_id' => $request->user()->id]);
        }

        $cartItem = $userCart->items()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = new CartItem([
                'cart_id' => $userCart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            $userCart->items()->save($cartItem);
        }

        return response()->json(['message' => 'Product added to cart successfully'], 200);
    }

    public function viewCart(Request $request)
    {
        $userCart = $request->user()->cart;

        if (!$userCart) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        $cartItems = $userCart->items()->with('product')->get();

        return response()->json(['cart' => $cartItems], 200);
    }

    public function updateCartItem(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($itemId);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully'], 200);
    }

    public function removeCartItem(Request $request, $itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['message' => 'yeah its gone now!!'], 200);
    }
}

