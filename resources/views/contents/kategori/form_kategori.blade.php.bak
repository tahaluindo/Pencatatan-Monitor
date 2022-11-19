@extends('layout.master')
@section('title',$title)
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
	<div class="col-md-6">
		<h5 class="text-center">Tambah Kategori Pemasukan</h5>
		<form action="{{url('kategori')}}" method="POST">
			@csrf
			<input type="hidden" name="tipe" value="pemasukan" required="">
			<div class="form-group">
				<label>Nama Kategori</label>
				<input type="text" name="kategori" required="" placeholder="nama kategori" class="form-control">
			</div>
			<div class="form-group">
				<label>Deskripsi</label>
				<textarea required="" name="deskripsi" class="form-control"></textarea>
			</div>
			<button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
		</form>
	</div>
	<div class="col-md-6">
		<h5 class="text-center">Tambah Kategori Pengeluaran</h5>
		<form action="{{url('kategori')}}" method="POST">
			@csrf
			<input type="hidden" name="tipe" value="pengeluaran" required="">
			<div class="form-group">
				<label>Nama Kategori</label>
				<input type="text" required="" name="kategori" placeholder="nama kategori" class="form-control">
			</div>
			<div class="form-group">
				<label>Deskripsi</label>
				<textarea required="" name="deskripsi" class="form-control"></textarea>
			</div>
			<button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
		</form>
	</div>
</div>
@endsection