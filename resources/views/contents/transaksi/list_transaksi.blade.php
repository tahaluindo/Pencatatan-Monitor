@extends('layout.master')
@section('title',$title)

@section('content')
<h5 class="text-center">Daftar Transaksi {{$caption}}</h5>
<hr>
@if(session('alert'))
<div class="alert alert-info">
	{{session('alert')}}
</div>
@endif
<div class="row">
	<div class="col-md-9">
		<form action="{{url('transaksi')}}" method="GET" class="form-inline">
			@csrf
			<label class="mr-sm-5"><strong>Filter :</strong></label>
			<label class="mr-sm-2">Start :</label>
			<input type="date" name="mulai" required="" class="form-control mr-sm-2 mb-2">
			<label class="mr-sm-2">End :</label>
			<input type="date" name="akhir" required="" class="form-control mr-sm-2 mb-2">
			<button type="submit" class="btn btn-sm btn-info">Filter</button>
		</form>
	</div>
	<div class="col-md-3">
		<h4 class="text-info">Saldo : Rp {{number_format($saldo,0,'.','.')}}</h4>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<h5 class="text-center"><caption>Pemasukan</caption></h5>
		<button type="button" class="btn btn-sm btn-primary mb-sm-2" id="tambah_lpm">Tambah</button>
		<div id="table_lpm" style="max-width: 100%;"></div>
		<table class="table table-sm table-hover table-striped table-bordered mt-sm-2">
			<thead>
				<tr>
					<th>No</th>
					<th>Pemasukan</th>
					<th>Deskripsi</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pemasukan as $key => $p)
				<tr id="lpm_{{$p->id}}">
					<td>{{++$key}}</td>
					<td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->pemasukan,0,'.','.')}}</td>
					<td style="max-width: 130px;word-wrap: break-word;">{{$p->deskripsi}}</td>
					<td style="max-width: 115px;word-wrap: break-word;">{{$p->kategori->nama_kategori}}</td>
					<td>
						<form action="{{url('transaksi/'.$p->id)}}" method="POST">
							@method('DELETE')
							@csrf
							<input type="hidden" name="tipe" value="pemasukan">
							<button value="{{$p->id}}" type="button" class="btn btn-sm btn-info lpm">Edit</button>
							<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<h5 class="text-center"><caption>Pengeluaran</caption></h5>
		<button type="button" class="btn btn-sm btn-primary mb-sm-2" id="tambah_lpr">Tambah</button>
		<div id="table_lpr" style="max-width: 100%;"></div>
		<table class="table table-sm table-hover table-striped table-bordered mt-sm-2">
			<thead>
				<tr>
					<th>No</th>
					<th>Pemasukan</th>
					<th>Deskripsi</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pengeluaran as $key => $p)
				<tr id="lpr_{{$p->id}}">
					<td>{{++$key}}</td>
					<td style="max-width: 115px;word-wrap: break-word;">Rp {{number_format($p->pengeluaran,0,'.','.')}}</td>
					<td style="max-width: 130px;word-wrap: break-word;">{{$p->deskripsi}}</td>
					<td style="max-width: 115px;word-wrap: break-word;">{{$p->kategori->nama_kategori}}</td>
					<td>
						<form action="{{url('transaksi/'.$p->id)}}" method="POST">
							@method('DELETE')
							@csrf
							<input type="hidden" name="tipe" value="pengeluaran">
							<button value="{{$p->id}}" type="button" class="btn btn-sm btn-info lpr">Edit</button>
							<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	$("#tambah_lpm").click(function(){
		var html = '<form action="{{url('transaksi')}}" method="POST" class="form-inline">@csrf<table><tr><td>Rp</td><td><input style="max-width: 100px;" type="number" name="nominal" required class="form-control" placeholder="Nominal" min="0"><input type="hidden" required name="jenis_transaksi" value="pemasukan"></td><td><input name="deskripsi" required class="form-control" placeholder="Deskripsi"></td><td><select name="kategori" required title="Kategori" class="form-control"><option value="">Pilih kategori</option>@foreach($kpm as $kt)<option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>@endforeach</select></td><td><button class="btn btn-sm btn-primary">Simpan</button></td></tr></table></form>';
		$("#table_lpm").html(html);
	});
	$("#tambah_lpr").click(function(){
		var html = '<form action="{{url('transaksi')}}" method="POST" class="form-inline">@csrf<table><tr><td>Rp</td><td><input style="max-width: 100px;" type="number" name="nominal" required class="form-control" placeholder="Nominal" min="0"><input type="hidden" required name="jenis_transaksi" value="pengeluaran"></td><td><input name="deskripsi" required class="form-control" placeholder="Deskripsi"></td><td><select name="kategori" required title="Kategori" class="form-control"><option value="">Pilih kategori</option>@foreach($kpr as $kt)<option value="{{$kt->id}}">{{$kt->nama_kategori}}</option>@endforeach</select></td><td><button class="btn btn-sm btn-primary">Simpan</button></td></tr></table></form>';
		$("#table_lpr").html(html);
	});
	var lpm_status = 0;
	var old_element_lpm;
	var id_lpm;
	$(document).on("click",".lpm",function(){
		if(lpm_status==0){
			id_lpm = $(this).val();
			old_element_lpm = $("#lpm_"+id_lpm).html();
			setElementLPM(id_lpm);
		}else{
			clearElementLPM(id_lpm,old_element_lpm);
			id_lpm = $(this).val();
			old_element_lpm = $("#lpm_"+id_lpm).html();
			setElementLPM(id_lpm);
		}
	});
	$(document).on("click","#close_lpm",function(){
		clearElementLPM(id_lpm,old_element_lpm);
		id_lpm='';
		old_element_lpm='';
	});
	var lpr_status = 0;
	var old_element_lpr;
	var id_lpr;
	$(document).on("click",".lpr",function(){
		if(lpr_status==0){
			id_lpr = $(this).val();
			old_element_lpr = $("#lpr_"+id_lpr).html();
			setElementLPR(id_lpr);
		}else{
			clearElementLPR(id_lpr,old_element_lpr);
			id_lpr = $(this).val();
			old_element_lpr = $("#lpr_"+id_lpr).html();
			setElementLPR(id_lpr);
		}
	});
	$(document).on("click","#close_lpr",function(){
		clearElementLPR(id_lpr,old_element_lpr);
		id_lpr='';
		old_element_lpr='';
	});
	function setElementLPM(id){
		$.ajax({
			url: "{{url('transaksi')}}/"+id,
			method: "GET",
			data: {tipe: 'pemasukan'},
			success: function(response){
				var html = '<td colspan="5"><form action="{{url('transaksi')}}/'+id+'" method="POST" class="form-inline">@method('PUT') @csrf<input type="hidden" name="tipe" value="pemasukan" required><input style="max-width: 120px;" name="nominal" class="form-control" required value="'+response.pemasukan+'" type="number" min="0"><input type="text" name="deskripsi" required class="form-control" value="'+response.deskripsi+'" style="max-width: 140px;"><select style="max-width: 200px;" name="kategori" class="form-control" required>@foreach($kpm as $kt)<option value="{{$kt->id}}" '+(response.id_kategori=={{$kt->id}} ? "selected" : "")+'>{{$kt->nama_kategori}}</option>@endforeach</select><button class="btn btn-sm btn-primary ml-sm-1 mr-sm-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button class="btn btn-sm btn-danger" id="close_lpm"><i class="fa fa-times" aria-hidden="true"></i></button></form></td>';
				$("#lpm_"+id).html(html);
				lpm_status=1;
			}
		});
	}

	function clearElementLPM(id,html){
		$("#lpm_"+id).html(html);
		lpm_status=0;
	}
	function setElementLPR(id){
		$.ajax({
			url: "{{url('transaksi')}}/"+id,
			method: "GET",
			data: {tipe: 'pengeluaran'},
			success: function(response){
				var html = '<td colspan="5"><form action="{{url('transaksi')}}/'+id+'" method="POST" class="form-inline">@method('PUT') @csrf<input type="hidden" name="tipe" value="pengeluaran" required><input style="max-width: 120px;" name="nominal" class="form-control" required value="'+response.pengeluaran+'" type="number" min="0"><input type="text" name="deskripsi" required class="form-control" value="'+response.deskripsi+'" style="max-width: 140px;"><select style="max-width: 200px;" name="kategori" class="form-control" required>@foreach($kpr as $kt)<option value="{{$kt->id}}" '+(response.id_kategori=={{$kt->id}} ? "selected" : "")+'>{{$kt->nama_kategori}}</option>@endforeach</select><button class="btn btn-sm btn-primary ml-sm-1 mr-sm-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button class="btn btn-sm btn-danger" id="close_lpr"><i class="fa fa-times" aria-hidden="true"></i></button></form></td>';
				$("#lpr_"+id).html(html);
				lpr_status=1;
			}
		});
	}

	function clearElementLPR(id,html){
		$("#lpr_"+id).html(html);
		lpr_status=0;
	}
</script>
@endsection