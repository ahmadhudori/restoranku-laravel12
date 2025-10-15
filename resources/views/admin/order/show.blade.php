@extends('admin.layouts.master')
@section('title', 'Orders')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Detail Pesanan</h3>
                <p class="text-subtitle text-muted">Detail pesanan yang masuk</p>
            </div>
            {{-- <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('items.create') }}" class="btn btn-primary">
					<i class="bi bi-plus"></i>
					Tambah Menu</a>
            </div> --}}
        </div>
    </div>
	<section class="section">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<p><strong>Nama Pelanggan:</strong> {{ $order->user->fullname }}</p>
						<p><strong>No. Meja:</strong> {{ $order->table_number }}</p>
						<p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
					</div>
					<div class="col-md-6">
						<p><strong>Status:</strong> 
							<span class="badge {{  $order->status == 'pending' ? 'bg-warning' : ($order->status == 'settlement' ? 'bg-success' : 'bg-danger') }}">{{ ucfirst($order->status) }}</span>
						</p>
						<p><strong>Catatan:</strong> {{ $order->note ?? '-' }}</p>
						<p><strong>Dibuat pada:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
					</div>
				</div>
	</section>
    <section class="section">
        <div class="card">
			<div class="card-header">
				<h4>Detail Pesanan</h4>
			</div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Nama Menu</th>
							<th>Jumlah</th>
							<th>Harga</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $orderItems as $oitem )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									@if($oitem->item->image)
										<img src="{{ asset('img_item_upload/' . $oitem->item->image) }}" class="img-fluid rounded-top" alt="" width="60" onerror="this.onerror=null;this.src='{{ $oitem->item->image }}';">
									@else
										{{-- <img src="{{ asset('assets/admin/images/default.png') }}" alt="Default Image" width="60"> --}}
										<p>gambar kosong</p>
									@endif
								</td>
								<td>{{ $oitem->item->name }}</td>
								<td>{{ $oitem->quantity }}</td>
								<td>Rp.{{ number_format($oitem->item->price, 0, ',', '.') }}</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="4" class="text-end"><strong>Subtotal:</strong></td>
							<td><strong>Rp.{{ number_format($order->subtotal, 0, ',', '.') }}</strong></td>
						</tr>
						<tr>
							<td colspan="4" class="text-end"><strong>Tax:</strong></td>
							<td><strong>Rp.{{ number_format($order->tax, 0, ',', '.') }}</strong></td>
						</tr>
						<tr>
							<td colspan="4" class="text-end"><strong>Total Bayar:</strong></td>
							<td><strong>Rp.{{ number_format($order->grand_total, 0, ',', '.') }}</strong></td>
						</tr>
					</tbody>
				</table>
            </div>
        </div>

    </section>
@endsection
@section('script')
<script src="{{ asset('assets/admin/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/admin/static/js/pages/simple-datatables.js') }}"></script>
@endsection