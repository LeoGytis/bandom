<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->get();

        return view('orders.index', ['orders' => $orders,]);
    }

    public function add(Request $request)
    {
        $order = new Order;

        $order->count = $request->orders_count;
        $order->hotel_id = $request->hotel_id;
        $order->user_id = Auth::user()->id;

        $order->save();

        return redirect()->route('orders-show');
    }

    public function showMyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('order.index', ['orders' => $orders]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders-show')->with('pop_message', 'Successfully deleted!');
    }

    public function approve(Order $order)
    {
        $order = new order;
        $order->name = $request->order_name;
        $order->s_time = $request->order_s_time;
        $order->save();
        return redirect()->route('order.index')->with('pop_message', 'Successfully created!');
    }
}