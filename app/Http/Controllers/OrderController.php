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
        return view('order.index', ['orders' => $orders, 'statuses' => Order::STATUSES ]);
    }

    public function add(Request $request)
    {
        $order = new Order;

        $order->count = $request->hotels_count;
        $order->hotel_id = $request->hotel_id;
        $order->user_id = Auth::user()->id;
        $order->save();

        return redirect()->route('order.show');
    }

    public function showMyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('order.index', ['orders' => $orders, 'statuses' => Order::STATUSES]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index')->with('pop_message', 'Successfully deleted!');
    }

    public function setStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('pop_message', 'Order status has been changed.');
    }
}