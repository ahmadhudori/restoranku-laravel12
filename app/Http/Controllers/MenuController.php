<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class MenuController extends Controller
{
    public function index(Request $request)
	{
		$tableNumber = $request->query('meja');
		if($tableNumber) {
			Session::put('tableNumber', $tableNumber);
		}

		$items = Item::where('is_active', 1)
			->orderBy('name', 'asc')->get();
		
		return view('customer.menu', compact('items', 'tableNumber'));
	}

	/* Cart Controller */
	public function cart()
	{
		$cart = Session::get('cart');
		return view('customer.cart', compact('cart'));
	}

	public function addToCart(Request $request)
	{
		$menuId = $request->input('id');
		$menu = Item::find($menuId);

		if (!$menu) {
			return response()->json([
				'status' => 'error',
				'message' => 'Menu tidak ditemukan.'
			]);
		}

		$cart = Session::get('cart');

		if (isset($cart[$menuId])) {
			$cart[$menuId]['qty'] += 1;
		} else {
			$cart[$menuId] = [
				'id' => $menu->id,
				'name' => $menu->name,
				'image' => $menu->image,
				'price' => $menu->price,
				'qty' => 1
			];
		}

		Session::put('cart', $cart);
		return response()->json([
			'status' => 'success',
			'message' => 'Menu berhasil ditambahkan ke keranjang.',
			'cart' => $cart
		]);
	}

	public function updateCart(Request $request) {
		$item = $request->input('id');
		$newQty = $request->input('qty');

		if ($newQty <= 0) {
			return response()->json([
				'success' => false,
			]);
		}

		$cart = Session::get('cart');
		if (isset($cart[$item])) {
			$cart[$item]['qty'] = $newQty;
			Session::put('cart', $cart);
			Session::flash('success', 'Keranjang berhasil diupdate.');
			return response()->json([
				'success' => true
			]);
		}

		return response()->json([
			'success' => false
		]);
	}

	public function removeCart(Request $request) {
		$item = $request->input('id');
		$cart = Session::get('cart');
		if (isset($cart[$item])) {
			unset($cart[$item]);
			Session::put('cart', $cart);
			Session::flash('success', 'Menu berhasil dihapus dari keranjang.');
			return response()->json([
				'success' => true
			]);
		}
		return response()->json([
			'success' => false
		]);
	}

	public function clearCart() {
		Session::forget('cart');
		Session::flash('success', 'Keranjang berhasil dikosongkan.');
		return redirect()->route('cart');
	}

	/* Checkout */
	public function checkout() {
		$cart = Session::get('cart');
		if (empty($cart)) {
			return redirect()->route('cart')->with('error', 'Keranjang masih kosong.');
		}
		$tableNumber = Session::get('tableNumber');
		return view('customer.checkout', compact('cart', 'tableNumber'));
	}

	public function checkoutStore(Request $request) {
		$cart = Session::get('cart');
		$tableNumber = Session::get('tableNumber');
		if (empty($cart)) {
			return redirect()->route('cart')->with('error', 'Keranjang masih kosong.');
		}
		$validator = Validator::make($request->all(), [
			'fullname' => 'required|string|max:255',
			'nomorWhatsapp' => 'required',
			'payment_method' => 'required',
		]);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator);
		}

		$totalAmount = 0;
		foreach ($cart as $item) {
			$totalAmount += $item['price'] * $item['qty'];

			$itemDetail[] = 
			[
				'id' => $item['id'],
				'price' => (int) $item['price'] + ($item['price'] * 0.1),
				'quantity' => $item['qty'],
				'name' => substr($item['name'], 0, 20),
			];
		}

		$user = User::firstOrCreate([
			'fullname' => $request->fullname,
			'phone' => $request->nomorWhatsapp,
			'role_id' => 4,
		]);

		$order = Order::create([
			'order_code' => 'ORD-' . $tableNumber . '-' . time(),
			'user_id' => $user->id,
			'subtotal' => $totalAmount,
			'tax' => $totalAmount * 0.1,
			'grand_total' => $totalAmount + ($totalAmount * 0.1),
			'status' => 'pending',
			'table_number' => $tableNumber,
			'payment_method' => $request->payment_method,
			'note' => $request->note,
		]);

		foreach ($cart as $item) {
			OrderItem::create([
				'order_id' => $order->id,
				'item_id' => $item['id'],
				'quantity' => $item['qty'],
				'price' => $item['price'] * $item['qty'],
				'tax' => $item['price'] * 0.1 * $item['qty'],
				'total_price' => ($item['price'] * $item['qty']) + ($item['price'] * 0.1 * $item['qty']),
			]);
		}

		Session::forget('cart');
		return redirect()->route('menu')->with('success', 'Pesanan berhasil dibuat.');
	}
}
