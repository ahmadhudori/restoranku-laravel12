@extends('customer.layouts.master')
@section('title', 'Pesanan Berhasil Dibuat')
@section('content')
<div class="container-fluid py-5 d-flex justify-content-center">
	<div class="receipt border p-4 bg-white shadow" style="width: 450px; margin-top: 5rem">
		<h5 class="text-center mb-2">Pesanan Berhasil Dibuat</h5>
		@if ($order->payment_method == 'tunai' && $order->status == 'pending')
			<p class="text-center"><span class="badge bg-danger p-2">Menunggu Pembayaran</span></p>
		@elseif ($order->payment_method == 'qris' && $order->status == 'pending')
			<p class="text-center"><span class="badge bg-success">Menunggu Konfirmasi Pembayaran</span></p>
		@else
			<p class="text-center"><span class="badge bg-success">Pembayaran berhasil, pesanan segera diproses</span></p>
		@endif
		<hr>
		<h4 class="text-center fw-bold">Kode Bayar: <br> <span class="text-primary">{{ $order->order_code }}</span></h4>
		<hr>
		<h5 class="text-center mb-3">Detail Pesan</h5>
		<table class="table table-borderless">
			<tbody>
				@foreach ($orderItems as $orderItem)
					<tr>
						<td>{{ Str::limit($orderItem->item->name, 20)}} ({{ $orderItem->quantity }})</td>
						<td class="text-end fw-bold">Rp.{{ number_format($orderItem->item->price, 0, ',', '.') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<table class="table table-borderless">
			<tbody>
				<tr>
					<td>Subtotal</td>
					<td class="text-end">Rp.{{ number_format($order->subtotal, 0, ',', '.') }}</td>
				</tr>
				<tr>
					<td>Pajak (10%)</td>
					<td class="text-end">Rp.{{ number_format($order->tax, 0, ',', '.') }}</td>
				</tr>
				<tr>
					<td>Total</td>
					<td class="text-end fw-bold">Rp.{{ number_format($order->grand_total, 0, ',', '.') }}</td>
				</tr>
			</tbody>
		</table>

		@if ($order->payment_method == 'tunai')
			<p class="text-center small">Tunjukan kode bayar ini ke kasir untuk menyelesaikan pembayaran. Terima kasih!</p>
		@elseif ($order->payment_method == 'qris')
			<p class="text-center small">Yeayy. Pembayaran kamu berhasil, pesanan kamu akan segera kami proses!</p>
		@endif
		<hr>
		<a href="{{ route('menu') }}" class="btn btn-primary w-100 py-3 text-white">Kembali ke Menu</a>
	</div>	
</div>
@endsection