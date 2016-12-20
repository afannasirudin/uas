<?php
//ROUTING
if(!empty($_GET["page"]))
{
	$page = mysql_real_escape_string(strtoupper($_GET["page"]));
	if($page == "LOGIN")
	{
		if(!empty($_POST["username"]) && !empty($_POST["password"]))
		{
			$user = mysql_real_escape_string($_POST["username"]);
			$pass = mysql_real_escape_string(md5($_POST["password"]));
			$database -> login($con,$user,$pass);
		}
		include("login.php");
	}
	else if($page == "ADMIN")
	{
		//DELETE DATA
		if(!empty($_GET["delete"]))
		{
			$kode = $_GET["delete"];
			$database -> hapusData($con,$kode);
		}
		
		//EDIT DATA
		if(isset($_POST["edit"]))
		{
			$kode = $_GET["edit"];
			$nama = mysql_real_escape_string($_POST["nama"]);
			$alamat = mysql_real_escape_string($_POST["alamat"]);
			$tlp = mysql_real_escape_string($_POST["tlp"]);
			$agama = mysql_real_escape_string($_POST["agama"]);
			$tempat = mysql_real_escape_string($_POST["tempat"]);
			$tanggal = mysql_real_escape_string($_POST["tanggal"]);
			$kelamin = mysql_real_escape_string($_POST["kelamin"]);
			$jurusan = mysql_real_escape_string($_POST["jurusan"]);
			$asal = mysql_real_escape_string($_POST["asal"]);
			$alm_smp = mysql_real_escape_string($_POST["alm_smp"]);
			$lulus = mysql_real_escape_string($_POST["lulus"]);
			$nis = mysql_real_escape_string($_POST["nis"]);
			$nilai = mysql_real_escape_string($_POST["nilai"]);
			
			$database -> editData($con,$nama,$alamat,$tlp,$agama,$tempat,$tanggal,$kelamin,$jurusan,$asal,$alm_smp,$lulus,$nis,$nilai,$kode);
		}
		
		include("views/admin.php");
	}
	else if($page == "LOGOUT")
	{
		session_start();
		session_destroy();
		header("location: index.php?page=login");
	}
	
	else
	{
		//HALAMAN ERROR
		include("views/index.php");
	}
}
else
{
	//TAMPILAN AWAL
	if(!empty($_POST["daftar"]))
	{
		$nama = mysql_real_escape_string($_POST["nama"]);
		$alamat = mysql_real_escape_string($_POST["alamat"]);
		$tlp = mysql_real_escape_string($_POST["tlp"]);
		$agama = mysql_real_escape_string($_POST["agama"]);
		$tempat = mysql_real_escape_string($_POST["tempat"]);
		$tanggal = mysql_real_escape_string($_POST["tanggal"]);
		$kelamin = mysql_real_escape_string($_POST["kelamin"]);
		$jurusan = mysql_real_escape_string($_POST["jurusan"]);
		$asal = mysql_real_escape_string($_POST["asal"]);
		$alm_smp = mysql_real_escape_string($_POST["alm_smp"]);
		$lulus = mysql_real_escape_string($_POST["lulus"]);
		$nis = mysql_real_escape_string($_POST["nis"]);
		$nilai = mysql_real_escape_string($_POST["nilai"]);
		
		$input = $database -> daftar($con,$nama,$alamat,$tlp,$agama,$tempat,$tanggal,$kelamin,$jurusan,$asal,$alm_smp,$lulus,$nis,$nilai);
		
	}
	include("form.php");
}
?>
