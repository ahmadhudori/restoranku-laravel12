@extends('admin.layouts.master')
@section('title', 'Tambah Menu')
@section('content')
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h3>Tambah Data Menu</h3>
			<p class="text-subtitle text-muted">Silahkan isi data menu yang akan ditambahkan</p>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data" class="form form-vertical">
			@csrf
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="name">Nama Menu</label>
							<input type="text" class="form-control" id="name" placeholder="Enter nama menu" name="name" value="{{ old('name') }}" required>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi</label>
							<textarea type="text" class="form-control" id="description" placeholder="Deskripsi" name="description" required>{{ old('description') }}</textarea>
						</div>
						<div class="form-group">
							<label for="price">Harga</label>
							<input type="number" class="form-control" id="price" placeholder="Harga" name="price" value="{{ old('price') }}" required>
						</div>
						<div class="form-group">
							<label for="category">Kategori</label>
							<select name="category" class="form-select" id="category" required>
								<option value="">Pilih Kategori</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="image">Gambar</label>
							<input type="file" name="image" id="image" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="is_avtive">Status</label>
							<div class="form-check form-switch">
								<input type="hidden" name="is_active" value="0">
								<input type="checkbox" class="form-check-input" name="is_active" id="flexSwitchCheckChecked" value="1" checked>
								<label for="flexSwitchCheckChecked" class="form-check-label">Aktif/Tidak aktif</label>
							</div>
						</div>
						<div class="form-group mt-5 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
							<button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
							<a href="{{ route('items.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
        
@endsection