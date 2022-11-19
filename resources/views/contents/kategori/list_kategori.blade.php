@extends('layout.master')
@section('title',$title)

@section('content')
<h5 class="text-center">Daftar Kategori</h5>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('alert'))
<div class="alert alert-info">
	{{session('alert')}}
</div>
	
@endif
	<div class="row">
		<div class="col-md-6">
			<h5 class="text-center"><caption>Tabel Kategori Pemasukan</caption></h5>
			<button id="tambah_kpm" class="btn btn-sm btn-primary mb-sm-2" title="Tambah kategori pemasukan">Tambah</button>
			<div id="table_kpm"></div>
			<table class="table table-sm table-striped table-hover table-bordered mt-sm-2">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_kategori_pemasukan as $key => $kt)
					<tr id="kpm_{{$kt->id}}">
						<td>{{++$key}}</td>
						<td style="max-width: 115px;word-wrap: break-word;">{{$kt->nama_kategori}}</td>
						<td style="max-width: 130px;word-wrap: break-word;">{{$kt->deskripsi}}</td>
						<td style="max-width: 80px;">
							<form action="{{url('kategori/'.$kt->id)}}" method="POST">
								@method('DELETE')
								@csrf
								<input type="hidden" name="tipe" value="pemasukan">
								<button type="button" class="btn btn-sm btn-info bpm" value="{{$kt->id}}">Edit</button>
								<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h5 class="text-center"><caption>Tabel Kategori Pengeluaran</caption></h5>
			<button id="tambah_kpr" class="btn btn-sm btn-primary mb-sm-2" title="Tambah kategori pengeluaran">Tambah</button>
			<div id="table_kpr"></div>
			<table class="table table-sm table-striped table-hover table-bordered mt-sm-2">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_kategori_pengeluaran as $key => $kt)
					<tr id="kpr_{{$kt->id}}">
						<td>{{++$key}}</td>
						<td style="max-width: 115px;word-wrap: break-word;">{{$kt->nama_kategori}}</td>
						<td style="max-width: 130px;word-wrap: break-word;">{{$kt->deskripsi}}</td>
						<td style="max-width: 80px;">
							<form action="{{url('kategori/'.$kt->id)}}" method="POST">
								@method('DELETE')
								@csrf
								<input type="hidden" name="tipe" value="pengeluaran">
								<button type="button" class="btn btn-sm btn-info bpr" value="{{$kt->id}}">Edit</button>
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
	$("#tambah_kpm").click(function(){
		var html = '<form method="POST" action="{{url('kategori')}}"><table class="table"><tr><td>-</td><td>@csrf<input type="hidden" name="tipe" value="pemasukan" required=""><input type="text" name="kategori" required placeholder="nama kategori" class="form-control"></td><td><input type="text" required placeholder="deskripsi" class="form-control" name="deskripsi"></td><td><button type="submit" class="btn btn-sm btn-primary">Simpan</button></td></tr></table></form>';
		$("#table_kpm").html(html);
	});
	$("#tambah_kpr").click(function(){
		var html = '<form method="POST" action="{{url('kategori')}}"><table class="table"><tr><td>-</td><td>@csrf<input type="hidden" name="tipe" value="pengeluaran" required=""><input type="text" name="kategori" required placeholder="nama kategori" class="form-control"></td><td><input type="text" required placeholder="deskripsi" class="form-control" name="deskripsi"></td><td><button type="submit" class="btn btn-sm btn-primary">Simpan</button></td></tr></table></form>';
		$("#table_kpr").html(html);
	});
	var kpm_status = 0;
	var id_kpm;
	var old_element_kpm;
	$(document).on("click",".bpm",function(){
		if(kpm_status==0){
			id_kpm = $(this).val();
			old_element_kpm = $("#kpm_"+id_kpm).html();
			setFormKPM(id_kpm);
		}else{
			clearFormKPM(id_kpm,old_element_kpm);
			id_kpm = $(this).val();
			old_element_kpm = $("#kpm_"+id_kpm).html();
			setFormKPM(id_kpm);
		}
	});

	$(document).on("click",".close_kpm",function(){
		clearFormKPM(id_kpm,old_element_kpm);
		id_kpm='';
		old_element_kpm='';
	});

	var kpr_status = 0;
	var id_kpr;
	var old_element_kpr;
	$(document).on("click",".bpr",function(){
		if(kpr_status==0){
			id_kpr = $(this).val();
			old_element_kpr = $("#kpr_"+id_kpr).html();
			setFormKPR(id_kpr);
		}else{
			clearFormKPR(id_kpr,old_element_kpr);
			id_kpr = $(this).val();
			old_element_kpr = $("#kpr_"+id_kpr).html();
			setFormKPR(id_kpr);
		}
	});

	$(document).on("click",".close_kpr",function(){
		clearFormKPR(id_kpr,old_element_kpr);
		id_kpr='';
		old_element_kpr='';
	});

	function setFormKPM(id){
		$.ajax({
			url: "{{url('kategori')}}/"+id,
			type: "GET",
			data: {tipe: "pemasukan"},
			success: function(response){
				var html = '<td colspan="4"><form method="POST" action="{{url('kategori')}}/'+id+'" class="form-inline">@method('PUT') @csrf<input type="hidden" name="tipe" value="pemasukan" required=""><input type="text" name="kategori" required placeholder="nama kategori" class="form-control mr-sm-2" value="'+response.nama_kategori+'"><input type="text" required placeholder="deskripsi" class="form-control mr-sm-2" name="deskripsi" value="'+response.deskripsi+'"><button type="submit" class="btn btn-sm btn-primary mr-sm-2" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-sm btn-danger close_kpm" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button></form></td>';
				$("#kpm_"+id).html(html);
				kpm_status=1;
			}
		});
	}

	function clearFormKPM(id,html){
		$("#kpm_"+id).html(html);
		kpm_status=0;
	}

	function setFormKPR(id){
		$.ajax({
			url: "{{url('kategori')}}/"+id,
			type: "GET",
			data: {tipe: "pengeluaran"},
			success: function(response){
				var html = '<td colspan="4"><form method="POST" action="{{url('kategori')}}/'+id+'" class="form-inline">@method('PUT') @csrf<input type="hidden" name="tipe" value="pengeluaran" required=""><input type="text" name="kategori" required placeholder="nama kategori" class="form-control mr-sm-2" value="'+response.nama_kategori+'"><input type="text" required placeholder="deskripsi" class="form-control mr-sm-2" name="deskripsi" value="'+response.deskripsi+'"><button type="submit" class="btn btn-sm btn-primary mr-sm-2" title="Update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><button type="button" class="btn btn-sm btn-danger close_kpr" title="Cancel"><i class="fa fa-times" aria-hidden="true"></i></button></form></td>';
				$("#kpr_"+id).html(html);
				kpr_status=1;
			}
		});
	}

	function clearFormKPR(id,html){
		$("#kpr_"+id).html(html);
		kpr_status=0;
	}
</script>
@endsection