<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function all()
    {
        $orders = Orders::with('user', 'items.product')->paginate(20);

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found'], 404);
        }

        foreach ($orders as $order) {
            foreach ($order->items as $orderItem) {
                $orderItem->product_name = $orderItem->product->name;
            }
        }

        return response()->json($orders, 200);
    }

    public function show($id)
    {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order, 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'order_date' => 'required|date',
                'total_price' => 'required|numeric',
                'order_items' => 'required|array',
                'order_items.*.product_id' => 'required|integer|exists:products,id',
                'order_items.*.quantity' => 'required|integer',
                'order_items.*.unit_price' => 'required|numeric',
            ]);

            if (Auth::check()) {
                $order = new Orders();
                $order->user_id = Auth::id();
                $order->order_date = $request->order_date;
                $order->total_price = $request->total_price;
                $order->save();

                foreach ($request->order_items as $orderItem) {
                    $item = new OrderDetails();
                    $item->order_id = $order->id;
                    $item->product_id = $orderItem['product_id'];
                    $item->quantity = $orderItem['quantity'];
                    $item->unit_price = $orderItem['unit_price'];
                    $item->save();

                    $product = Products::find($orderItem['product_id']);
                    $product->quantity -= $orderItem['quantity'];
                    $product->save();
                }

                return response()->json(['message' => 'Order added successfully'], 201);
            } else {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function get_order_items($id)
    {
        $order_items = OrderDetails::where('order_id', $id)->get();
        if ($order_items->isEmpty()) {
            return response()->json(['message' => 'No items found'], 404);
        }

        foreach ($order_items as $order_item) {
            $product = Products::where('id', $order_item->product_id)->pluck('name');
            $order_item->product_name = $product['0'];
        }

        return response()->json($order_items, 200);
    }

    public function get_user_orders($id)
    {
        $orders = Orders::where('user_id', $id)
            ->with(['items' => function($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

        foreach ($orders as $order) {
            foreach ($order->items as $order_item) {
                $product = Products::where('id', $order_item->product_id)->pluck('name');
                $order_item->product_name = $product['0'];
            }
        }

        return response()->json($orders, 200);
    }






public function update(Request $request, $id)
{
    try {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|integer|exists:products,id',
            'order_items.*.quantity' => 'required|integer',
            'order_items.*.unit_price' => 'required|numeric',
        ]);


        $order->order_date = $request->order_date;
        $order->total_price = $request->total_price;
        $order->save();

        OrderDetails::where('order_id', $id)->delete();

        foreach ($request->order_items as $orderItem) {
            $item = new OrderDetails();
            $item->order_id = $order->id;
            $item->product_id = $orderItem['product_id'];
            $item->quantity = $orderItem['quantity'];
            $item->unit_price = $orderItem['unit_price'];
            $item->save();

            $product = Products::find($orderItem['product_id']);
            $product->quantity -= $orderItem['quantity'];
            $product->save();
        }

        return response()->json(['message' => 'Order updated successfully'], 200);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}






public function delete($id)
{
    try {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        OrderDetails::where('order_id', $id)->delete();

        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 200);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
}
