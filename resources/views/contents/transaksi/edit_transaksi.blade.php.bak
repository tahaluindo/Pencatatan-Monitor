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
<h5 class="text-center">Edit Transaksi {{($tipe=='pemasukan' ? 'Pemasukan' : 'Pengeluaran')}}</h5>
<div class="d-flex justify-content-center">
	<form action="{{url('transaksi/'.$transaksi->id)}}" method="POST" style="width: 30vw;">
		<input type="hidden" name="tipe" value="{{$tipe}}" required="">
		@method('PUT')
		@csrf
		<div class="form-group">
			<label>Kategori</label>
			<select name="kategori" required="" class="form-control">
				@foreach($kategori as $kt)
				<option value="{{$kt->id}}" {{($kt->id==$transaksi->id_kategori ? 'selected' : '')}}>{{$kt->nama_kategori}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Nominal (Rp)</label>
			<input type="number" name="nominal" required="" value="{{($tipe=='pemasukan' ? $transaksi->pemasukan : $transaksi->pengeluaran)}}" class="form-control">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea required="" name="deskripsi" class="form-control">{{$transaksi->deskripsi}}</textarea>
		</div>
		<button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
	</form>
</div>
@endsection