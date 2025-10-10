@extends('admin.layouts.master')
@section('title', 'Item')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Menu</h3>
                <p class="text-subtitle text-muted">Berbagai menu yang tersedia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('items.create') }}" class="btn btn-primary">
					<i class="bi bi-plus"></i>
					Tambah Menu</a>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
					<thead>
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Nama Menu</th>
							<th>Deskripsi</th>
							<th>Harga</th>
							<th>Kategori</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $items as $item )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									@if($item->image)
										<img src="{{ asset('img_item_upload/' . $item->image) }}" class="img-fluid rounded-top" alt="" onerror="this.onerror=null;this.src='{{ $item->image }}';" width="60">
									@else
										<img src="{{ asset('assets/admin/images/default.png') }}" alt="Default Image" width="60">
									@endif
								</td>
								<td>{{ $item->name }}</td>
								<td>{{ Str::limit($item->description, 15, '...') }}</td>
								<td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
								<td>
									<span class="badge {{  $item->category->cat_name == 'Makanan' ? 'bg-warning' : 'bg-info' }}">{{ $item->category->cat_name }}</span>
								</td>
								<td>
									<span class="badge {{ $item->is_active == '1' ? 'bg-success' : 'bg-danger' }}">{{ $item->is_active == '1' ? 'Tersedia' : 'Tidak Tersedia' }}</span>
								</td>
								<td>
									<a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">
										<i class="bi bi-pencil"></i> Edit
									</a>
									<form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
											<i class="bi bi-trash"></i> Hapus
										</button>
									</form>
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