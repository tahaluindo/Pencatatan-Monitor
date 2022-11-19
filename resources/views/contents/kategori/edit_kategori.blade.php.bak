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
<h5 class="text-center">Edit Kategori</h5>
<div class="d-flex justify-content-center">
	<form action="{{url('kategori/'.$kategori->id)}}" method="POST" style="width: 30vw;">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Nama Kategori</label>
			<input type="text" name="kategori" required="" placeholder="nama kategori" value="{{$kategori->nama_kategori}}" class="form-control">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea required="" name="deskripsi" class="form-control">{{$kategori->deskripsi}}</textarea>
		</div>
		<input type="hidden" name="tipe" value="{{$tipe}}" required="">
		<button type="submit" class="btn btn-sm btn-info float-right">Simpan</button>
	</form>
</div>
@endsection