<?php
//CEK SESSION
session_start();
if(empty($_SESSION["username"]))
{
	header("location: index.php?page=login");
}
?>
<html>
<head>
	<title>Halaman Admin</title>
	<style type="text/css">
			h1{	font-family:arial; text-align:center;}
			body{color:black; font-family:arial;}	
			input{color:red; font-family:arial;}
			h5{font-style:italic align:center;}	
			h5{color:green;}
		</style>
</head>
<body>

<h5><a href="index.php?page=admin">Admin</a> | 
<a href="index.php?page=logout">Logout</a> |
<a href="index.php?page=password">Ganti Password</a> |</h5> 
<input class="search.php" type="text" placeholder="Cari..." required><input class="button" type="button" value="Cari">	
	


<h1>Halaman Admin</h1>

<?php
if(!empty($_GET["edit"]))
{
	$kode = $_GET["edit"];
	//TAMPIL DATA DETAIL
	$data = $database -> detailData($con,$kode);
?>

<form action="#" method="POST">
<pre>
<table cellpadding="4" cellspacing="0" border="1" width="100%">
	Nama Lengkap 			: <input type="text" value="<?php echo $data["nama"]; ?>" name="nama"><br>
	Alamat 				: <input type="text" value="<?php echo $data["alamat"]; ?>" name="alamat"><br>
	Tlp 				: <input type="text" value="<?php echo $data["no_telepon"]; ?>" name="tlp"><br>
	Agama 				: <input type="text" value="<?php echo $data["agama"]; ?>" name="agama"><br>
	Tempat Lahir 			: <input type="text" value="<?php echo $data["tempat"]; ?>" name="tempat"><br>
	Tanggal Lahir 			: <input type="text" value="<?php echo $data["tanggal"]; ?>" name="tanggal"><br>
	Jenis Kelamin		: <input type="text" value="<?php echo $data["kelamin"]; ?>" name="kelamin"><br>
	Jurusan Yang Dipilih: <input type="text" value="<?php echo $data["jurusan"]; ?>" name="jurusan"><br>
	
	Asal SMP 			: <input type="text" value="<?php echo $data["asal"]; ?>" name="asal"><br>
	Alamat SMP 			: <input type="text" value="<?php echo $data["alm_smp"]; ?>" name="alm_smp"><br>
	Tahun LULUS 		: <input type="text" value="<?php echo $data["lulus"]; ?>" name="lulus"><br>
	NISN 				: <input type="text" value="<?php echo $data["nis"]; ?>" name="nis"><br>
	
	Nilai 				: <input type="text" value="<?php echo $data["skhun"]; ?>" name="nilai"><br>
	<input type="submit" name="edit" value="EDIT DATA">
	</table>
</pre>
</form>

<?php
}
else
{
?>
<h2>Daftar Pendaftar</h2>
<a href="index.php" target="window"><button>Tambah Pendaftar</button></a>
<button onClick="window.print();">print</button>
<table cellpadding="4" cellspacing="0" border="1" width="100%" >
	<tr>
		<th>No.</th>
		<th>Nama Pendaftar</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>Agama</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Jenis Kelamin</th>
		<th>Jurusan Yang Dipilih</th>
		<th>Asal SMP</th>
		<th>Alamat SMP</th>
		<th>Tahun Lulus</th>
		<th>NISN</th>
		<th>Nilai UN</th>
		<th>Perintah</th>
	</tr>
	<?php
	//READ (Membaca Data)
	$no=1;
	$data = $database -> tampil($con);
	foreach($data as $value)
	{
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$value["nama"].'</td>
			<td>'.$value["alamat"].'</td>
			<td>'.$value["no_telepon"].'</td>
			<td>'.$value["agama"].'</td>
			<td>'.$value["tempat"].'</td>
			<td>'.$value["tanggal"].'</td>
			<td>'.$value["kelamin"].'</td>
			<td>'.$value["jurusan"].'</td>
			<td>'.$value["asal"].'</td>
			<td>'.$value["alm_smp"].'</td>
			<td>'.$value["lulus"].'</td>
			<td>'.$value["nis"].'</td>
			<td>'.$value["skhun"].'</td>
			<td>
				<a href="index.php?page=admin&edit='.$value["id_pendaftar"].'">Edit</a> | 
				<a href="index.php?page=admin&delete='.$value["id_pendaftar"].'">Delete</a>
			</td>
		</tr>
		';
		$no++;
	}
	?>
</table>
<?php
}
?>
</body>
</html>