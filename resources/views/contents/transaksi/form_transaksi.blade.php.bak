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
<h5 class="text-center">Tambah Transaksi</h5>
<div class="d-flex justify-content-center">
	<form action="{{url('transaksi')}}" method="POST" style="width: 30vw;">
		@csrf
		<div class="form-group">
			<label>Jenis Transaksi</label>
			<select name="jenis_transaksi" required="" class="form-control">
				<option value="">Pilih Jenis Transaksi</option>
				<option value="pemasukan">Pemasukan</option>
				<option value="pengeluaran">Pengeluaran</option>
			</select>
		</div>
		<div class="form-group">
			<label>Kategori</label>
			<div id="kategori"></div>
		</div>
		<div class="form-group">
			<label>Nominal (Rp)</label>
			<input type="number" name="nominal" required="" class="form-control" placeholder="Rp ">
		</div>
		<div class="form-group">
			<label>Deskripsi</label>
			<textarea required="" name="deskripsi" class="form-control"></textarea>
		</div>
		<button type="submit" class="btn btn-sm btn-primary float-right">Simpan</button>
	</form>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$("select[name=jenis_transaksi]").change(function(){
		var value = $(this).val();
		var pemasukan = '';
		var html = '';
		@foreach($kategori_pemasukan as $kt)
		pemasukan = pemasukan+'<option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>';
		@endforeach
		var pengeluaran = '';
		@foreach($kategori_pengeluaran as $kt)
		pengeluaran = pengeluaran+'<option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>';
		@endforeach
		if(value=='pemasukan'){
			html = "<select name='kategori' required class='form-control'>"+pemasukan+"</select>";
		}else if(value=='pengeluaran'){
			html = "<select name='kategori' required class='form-control'>"+pengeluaran+"</select>";
		}
		$("#kategori").html(html);
	});
</script>
@endsection