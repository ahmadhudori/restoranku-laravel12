@extends('admin.layouts.master')
@section('title', 'Edit Role')
@section('content')
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h3>Edit Data Role</h3>
			<p class="text-subtitle text-muted">Silahkan isi data role yang akan diubah</p>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<h5 class="alert-heading">Update Failed</h5>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		</div>
		@endif
		<form action="{{ route('roles.update', $role->id) }}" method="post" enctype="multipart/form-data" class="form form-vertical">
			@csrf
			@method('PUT')
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="name">Nama Role</label>
							<input type="text" class="form-control" id="name" placeholder="Enter nama menu" name="role_name" value="{{ old('role_name', $role->role_name) }}" required>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi</label>
							<textarea type="text" class="form-control" id="description" placeholder="Deskripsi" name="description" required>{{ old('description', $role->description) }}</textarea>
						</div>
						
						<div class="form-group mt-5 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
							<button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
							<a href="{{ route('roles.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
        
@endsection