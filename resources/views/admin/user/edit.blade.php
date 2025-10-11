@extends('admin.layouts.master')
@section('title', 'Edit Data Karyawan')
@section('content')
<div class="page-title">
	<div class="row">
		<div class="col-12 col-md-6 order-md-1 order-last">
			<h3>Edit Data Karyawan</h3>
			<p class="text-subtitle text-muted">Silahkan isi data karyawan yang akan diedit</p>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<h5 class="alert-heading">Updated Failed</h5>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		</div>
		@endif
		<form action="{{ route('users.update', $user->id) }}" method="post" class="form form-vertical">
			@csrf
			@method('PUT')
			<div class="form-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="fullname">Nama Karyawan</label>
							<input type="text" class="form-control" id="fullname" placeholder="Enter nama karyawan" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
						</div>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="{{  old('username', $user->username)}}" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email', $user->email) }}" required>
						</div>
						<div class="form-group">
							<label for="phone">No.telp</label>
							<input type="text" class="form-control" id="phone" placeholder="Enter no telpon" name="phone" value="{{   old('phone', $user->phone) }}" required>
						</div>
						<div class="form-group">
							<label for="role">Role</label>
							<select name="role_id" id="role" class="form-select" required>
								<option value="">Pilih Role</option>
								@foreach ($roles as $role)
									<option value="{{ $role->id }}" {{ old('role_id') || $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
							<small><a href="#" class="toggle-password" data-target="password">Lihat password</a></small>
						</div>
						<div class="form-group">
							<label for="password_confirmation">Konfirmasi Password</label>
							<input type="password" class="form-control" id="password_confirmation" placeholder="Enter password" name="password_confirmation">
							<small><a href="#" class="toggle-password" data-target="password_confirmation">Lihat password</a></small>
						</div>
						
						<div class="form-group mt-5 d-flex justify-content-end">
							<button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
							<button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
							<a href="{{ route('users.index') }}" class="btn btn-danger me-1 mb-1">Batal</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
        
@endsection
@section('script')
<script>
	// Toggle password visibility
	document.querySelectorAll('.toggle-password').forEach(function(element) {
		element.addEventListener('click', function(e) {
			e.preventDefault();
			var target = this.getAttribute('data-target');
			var input = document.getElementById(target);
			if (input.type === 'password') {
				input.type = 'text';
				this.textContent = 'Sembunyikan password';
			} else {
				input.type = 'password';
				this.textContent = 'Lihat password';
			}
		});
	});
</script>
@endsection