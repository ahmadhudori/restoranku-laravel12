@extends('admin.layouts.master')
@section('title', 'Karyawan')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/admin/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/compiled/css/table-datatable.css') }}">
@endsection
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Karyawan</h3>
                <p class="text-subtitle text-muted">Daftar karyawan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first d-flex justify-content-end align-items-center">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
					<i class="bi bi-plus"></i>
					Tambah Karyawan</a>
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
							<th>Username</th>
							<th>Nama Lengkap</th>
							<th>Email</th>
							<th>No.telp</th>
							<th>Role</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $users as $user )
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->fullname }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->role->role_name }}</td>
								<td>
									<a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
										<i class="bi bi-pencil"></i> Edit
									</a>
									<form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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