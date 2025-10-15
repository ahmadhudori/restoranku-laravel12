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
                <h3>Daftar Pesanan</h3>
                <p class="text-subtitle text-muted">Daftar berbagai pesanan yang masuk</p>
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
				@if (session('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert"><p><i class="bi bi-check-circle"></i>  {{ session('success') }}</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>
				@endif
                <table class="table table-striped" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Pesanan</th>
							<th>Nama Pelanggan</th>
							<th>Total Bayar</th>
							<th>Status</th>
							<th>No. Meja</th>
							<th>Metode Pembayaran</th>
							<th>Catatan</th>
							<th>Dibuat pada</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $orders as $order )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $order->order_code }}</td>
								<td>{{ $order->user->fullname }}</td>
								<td>Rp.{{ number_format($order->grand_total, 0, ',', '.') }}</td>
								<td>
									<span class="badge {{  $order->status == 'pending' ? 'bg-warning' : ($order->status == 'settlement' ? 'bg-success' : 'bg-danger') }}">{{ ucfirst($order->status) }}</span>
								</td>
								<td>{{ $order->table_number }}</td>
								<td>{{ $order->payment_method }}</td>
								<td>{{ $order->note ?? '-' }}</td>
								<td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
								<td>
									<a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
										<i class="bi bi-eye"></i> Detail
									</a>
								</td>
							</tr>
						@endforeach
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