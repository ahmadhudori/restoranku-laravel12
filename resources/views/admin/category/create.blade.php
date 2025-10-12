@extends('admin.layouts.master')
@section('title', 'Tambah Kategori')
@section('content')
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h3>Tambah Data Kategori</h3>
			<p class="text-subtitle text-muted">Silahkan isi data kategori yang akan ditambahkan</p>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<h5 class="alert-heading">Create Failed</h5>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		</div>
		@endif
		<form action="{{ route('categories.store') }}" method="post" class="form form-vertical">
			@csrf
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="name">Nama Kategori</label>
							<input type="text" class="form-control" id="name" placeholder="Enter nama kategori" name="cat_name" value="{{ old('cat_name') }}" required>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi</label>
							<textarea type="text" class="form-control" id="description" placeholder="Deskripsi" name="description" required>{{ old('description') }}</textarea>
						</div>
						
						<div class="form-group mt-5 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
							<button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
							<a href="{{ route('categories.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
        
@endsection