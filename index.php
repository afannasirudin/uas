<?php
//KONFIGURASI
$hostDB     = "localhost";
$usernameDB = "root";
$passwordDB = "";
$namaDB     = "coba";

//KONEKSI KE DATABASE
$con = mysqli_connect($hostDB,$usernameDB,$passwordDB,$namaDB);

//CEK KONEKSI
if(mysqli_connect_errno())
{
	echo "KONEKSI GAGAL";
	die;
}

//AKSES DATABASE
include("MODELS/database.php");

//MEMANGGIL DATABASE
$database = new database;

//AKSES CONTROLLERS
include("CONTROLLERS/controllers.php");



?>
