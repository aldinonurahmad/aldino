<?php 
session_start();
error_reporting(E_ALL);
include "koneksi.php";
if(empty($_SESSION['nick']))
{
	if(isset($_COOKIE['nick']))
	{
		$_SESSION['nick']=$_COOKIE['nick'];
		header("location:".$_SERVER['PHP_SELF']);
	}
	else
	{
		belum_login();
	}
}
else
{
	sudah_login();
}
function belum_login(){
?>
<!doctype html>
<html lang="en">
<meta charset="utf-8">
<head>
<title> Selamat Datang </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="style_sebelum.css" rel="stylesheet">
<script src="bootstrap/js/jQuery.js"></script>
<script src="ajaxku.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<!-- CONTAINER -->
<div class="container">
	<div class="row">
		<div class="span4 offset4">
			<h1 class="text-center text-info"> FORUM TANYA JAWAB BIDAN </h1>
			<p class="text-info text-center">Selamat Datang di forum tanya jawab bidan </br> aplikasi takon jawab bidan </p>
		</div>
	</div>
	<div class="row">
		<div class="span4 offset4">
			<img src="chat-icon.png" class="img-circle">
		</div>
	</div>
	</br>
	<div class="row">
		<div class="span4 offset4">
			<button href="#modalmasuk" class="btn btn-primary btn-block btn-large" data-toggle="modal" type="button"><i class="icon-share-alt icon-white"></i> Masuk</button> 
			<button href="#modaldaftar" class="btn btn-primary btn-large btn-block" data-toggle="modal" type="button"><i class="icon-user icon-white"></i> Daftar</button>
		<p class="text-center text-danger" > Copyright 2017 aldi@Jagoan_mama.com</p>
		</div>
	</div>
<!-- MODAL -->
<div id="modalmasuk" class="modal hide fade">
			<div class="modal-header">
			<h3> LOGIN</h3>
			</div>
			<div class="modal-body">
			<!-- modal form login -->
			<form class="form-horizontal" id="formmasuk" method="post" action="">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Nickname</label>
					<div class="controls">
					<input type="text" id="nick" placeholder="Nickname" required x-moz-errormessage='Form harus diisi 5-10 Karakter !'  pattern="[a-zA-Z]{5,10}"  >
					</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="inputPassword" >Password</label>
					<div class="controls">
					<input type="password" id="pass" placeholder="Password" required x-moz-errormessage='Form harus diisi 5-10 Karakter !'  pattern=".{5,10}"  >
					</div>
				</div>
				<div class="control-group">
				<div class="controls">
				<label class="checkbox">
					<input type="checkbox" id="cokie" value="ingataku"> Ingat Saya Dalam 1 Jam !
				</label>
				</div>
				</div>
				<div class="control-group">
					<div class="controls">
					<button type="submit" class="btn" id="masuk">Masuk</button>
					<button type="submit" class="btn btn-danger"  data-dismiss="modal">Kembali</button>
					</div>
				</div>
			</form>
				<p id="notif"></p>
			</div>
			<div class="modal-footer">
			</div>
</div>
<div id="modaldaftar" class="modal hide fade">
		<div class="modal-header">
			<h3> Daftar Member</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" id="formdaftar">
			<div class="control-group">
				<label class="control-label">Nickname</label>
				<div class="controls">
					<input type="text" id="dnick" placeholder="Nickname"  required x-moz-errormessage='Form harus diisi 5-10 Karakter !'  pattern="[a-zA-Z]{5,10}">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" >Email</label>
				<div class="controls">
					<input type="email" id="email" placeholder="Email" required required x-moz-errormessage='Email tidak valid !'>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls">
				<input type="password" id="dpass" placeholder="Password" required required x-moz-errormessage='Form harus diisi 5-10 Karakter !'  pattern=".{5,10}">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn" id="daftar">Daftar</button>
					<button type="submit" class="btn btn-danger"  data-dismiss="modal">Tutup</button>
				</div>
			</div>
			</form>
			<p id="dnotif"></p>
		</div>
		<div class="modal-footer">
		</div>
</div>
<!-- END MODAL -->
</div>
</html>
<?php }
function sudah_login(){
?>
<!doctype html>
<html lang="en">
<head>
<title> takok </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="style_sesudah.css" rel="stylesheet">
<script src="bootstrap/js/jQuery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="ajaxku.js"></script>

</head>
<body>
<div class="container">
	<div class="row">
		<div class="span6 offset2">
			<h1 class="text-info pull-left"> <marquee width="500" height="40">Slamat datang, tanya yang sopan ya :) </marquee></h1>
		</div>
		<div class="span2">
			<a href="logout.php" class="btn btn-danger"  type="button" ><i class="icon-off icon-white"></i> Keluar </a>
		</div>
	</div>
	<div class="row">
		<div class="span6 offset2">
				<div id="boxpesan">
				</div>
		</div>
		<div class="span2">
				<div class="boxonline">
				</div>
		</div>
	</div>
	</br>
	<div class="row">
		<div class="span6 offset2">
			<form method="post" action="" id="formpesan" class="form-inline">
			<input class="input-xlarge" name="pesan" type="text" placeholder="Ketik Pesan kemudian Enter !" required x-moz-errormessage="Ketik pesannya gan !">
			<input type='submit' value='Kirim' class='btn btn-info pull-right' id='pencet'>
			</form>
		<audio controls id="suara">
		<source src="/chat.mp3" type="audio/mpeg">
		Your browser does not support the audio element.
		</audio>
		</div>
		
	</div>
</div>
</body>
</html>
<?php  
}
