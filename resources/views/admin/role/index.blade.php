@extends('admin.layouts.master')
@section('title', 'Role')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Role</h3>
                <p class="text-subtitle text-muted">Daftar role yang tersedia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
					<i class="bi bi-plus"></i>
					Tambah Role</a>
            </div>
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
							<th>Nama</th>
							<th>Deskripsi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $roles as $role )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $role->role_name }}</td>
								<td>{{ Str::limit($role->description, 15, '...') }}</td>
								<td>
									<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
										<i class="bi bi-pencil"></i> Edit
									</a>
									<form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
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