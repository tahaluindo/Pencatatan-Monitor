@extends('layout.master')

@section('title',$title)

@section('content')
	<h4 style="text-align: center">Dashboard</h4>
	<div class="row" style="margin-top: 30px;">
		<div class="col-md-4 box">
			<h6>Saldo :</h6>
			<hr>
			<p class="text-right">Rp <strong>{{number_format($saldo,0,'.','.')}}</strong></p>
		</div>
		<div class="col-md-4 box">
			<h6>Total Pengeluaran :</h6>
			<hr>
			<p class="text-right">Rp <strong>{{number_format($pengeluaran,0,'.','.')}}</strong></p>
		</div>
		<div class="col-md-4 box">
			<h6>Total Pemasukan :</h6>
			<hr>
			<p class="text-right">Rp <strong>{{number_format($pemasukan,0,'.','.')}}</strong></p>
		</div>
	</div>
@endsection