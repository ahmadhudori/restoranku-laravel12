<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
		$orders = Order::all()->sortByDesc('created_at');
		return view('admin.order.index', compact('orders'));
	}

	public function show(Order $order) {
		$orderItems = $order->orderItems()->get();
		return view('admin.order.show', compact('order', 'orderItems'));
	}
}
