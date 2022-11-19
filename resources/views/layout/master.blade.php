<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Sistem yang digunakan untuk mencatat pengeluaran dan pemasukan keuangan Anda.">
	<title>@yield('title') | Sistem Pencatatan Pengeluaran dan Pemasukan Keuangan</title>
	<link rel="icon" type="image/png" href="{{asset('images/icon.png')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		.box{
			box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75);
		}
	</style>
</head>
<body>
	<div class="" style="margin-bottom: 30px;">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
  			</button>
  			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
					<li class="nav-item"><a class="nav-link" href="{{url('kategori')}}">Kategori</a></li>
					<li class="nav-item"><a class="nav-link" href="{{url('transaksi')}}">Transaksi</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	@yield('script')
</body>
</html>