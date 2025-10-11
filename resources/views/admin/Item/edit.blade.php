@extends('admin.layouts.master')
@section('title', 'Edit Menu')
@section('content')
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h3>Edit Data Menu</h3>
			<p class="text-subtitle text-muted">Silahkan isi data menu yang akan diubah</p>
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
		<form action="{{ route('items.update', $item->id) }}" method="post" enctype="multipart/form-data" class="form form-vertical">
			@csrf
			@method('PUT')
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="name">Nama Menu</label>
							<input type="text" class="form-control" id="name" placeholder="Enter nama menu" name="name" value="{{ old('name', $item->name) }}" required>
						</div>
						<div class="form-group">
							<label for="description">Deskripsi</label>
							<textarea type="text" class="form-control" id="description" placeholder="Deskripsi" name="description" required>{{ old('description', $item->description) }}</textarea>
						</div>
						<div class="form-group">
							<label for="price">Harga</label>
							<input type="number" class="form-control" id="price" placeholder="Harga" name="price" value="{{ old('price', $item->price) }}" step="any" required>
						</div>
						<div class="form-group">
							<label for="category">Kategori</label>
							<select name="category_id" class="form-select" id="category" required>
								<option value="" disabled>Pilih Kategori</option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ $item->category_id == $category->id || old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							@if ($item->image)
								<img src="{{ 'img_item_upload/' . $item->image }}" alt="{{ $item->image }}" class="img-tumbnail mb-2" width="200" onerror="this.onerror=null;this.src='{{ $item->image }}';">
							@endif
							<input type="file" name="image" class="form-control">
						</div>
						<div class="form-group">
							<label for="is_avtive">Status</label>
							<div class="form-check form-switch">
								<input type="hidden" name="is_active" value="0">
								<input type="checkbox" class="form-check-input" name="is_active" id="flexSwitchCheckChecked" value="1" {{ $item->is_active == '1' ? 'checked' : '' }}>
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