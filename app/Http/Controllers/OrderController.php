<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

	public function updateStatus(Order $order) {
		if (Auth::user()->role->role_name == 'Admin' || Auth::user()->role->role_name == 'Chasier') {
			$order->status = 'settlement';
		} else {
			$order->status = 'cooked';
		}
		$order->save();
		return redirect()->route('orders.index')->with('success', 'Berhasil update status pesanan.');
	}
}
