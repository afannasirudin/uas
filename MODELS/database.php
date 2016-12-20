<?php
class database{

	function daftar($con,$nama,$tempat,$tanggal,$kelamin,$agama,$alamat,$warga,$asalse,$alamatse,$ajaran,$ayah,$kerja,$nilai)

	{
		//query
		$q1 = mysqli_query($con,"INSERT INTO tbl_pendaftaran VALUES(null,'$nama','$tempat','$tanggal','$kelamin','$agama','$alamat','$warga','$asalse','$alamatse','$ajaran','$ayah','$kerja');");
		$q2 = mysqli_query($con,"INSERT INTO tbl_nilai VALUES(null,'$nilai');");
		if($q1 && $q2)
		{
			echo '
			<script>alert("DATA BERHASIL DIMASUKKAN");window.location.href="";</script>
			';
		}
		
	}

	function login($con,$user,$pass)
	{
		$q = mysqli_query($con, "SELECT * FROM tbl_admin WHERE
			username = '$user' and password = '$pass';");
		$cek = mysqli_fetch_array($q);
		if(!empty($cek[0]))
		{
			session_start();
			$_SESSION["username"] = $user;
			header("location: index.php?page=admin");
		}
		else
		{
			echo '
			<script>
				alert("Username atau Password Salah !!");
				window.location.href="";
			</script>
			';
		}
	}

	function tampil($con)
	{
		$list = array();
		$q = mysqli_query($con,"SELECT * FROM tbl_pendaftaran
		JOIN tbl_nilai ON 
		tbl_nilai.id_pendaftar = tbl_pendaftaran.id_pendaftar
		ORDER BY tbl_pendaftaran.id_pendaftar DESC;");
		while($data = mysqli_fetch_array($q))
		{
			$list[] = $data;
		}
		return $list;
	}

	function hapusData($con,$kode)
	{
		$q1 = mysqli_query($con,"DELETE FROM tbl_pendaftaran WHERE id_pendaftar = '$kode';");
		$q2 = mysqli_query($con,"DELETE FROM tbl_nilai WHERE id_pendaftar = '$kode';");
		if($q1 & $q2)
		{
			echo'
			<script>
				alert("Data berhasil dihapus !!");
				window.location.href="index.php?page=admin";
			</script>
			';	
		}
		else
		{
			echo'
			<script>
				alert("Data tidak berhasil dihapus !!");
				window.location.href="index.php?page=admin";
			</script>
			';
		}
	}
	
	function info_admin($con)
	{
		$username = $_SESSION['username'];
		$query = mysqli_query($con, "SELECT tbl_nama_admin.nama_admin FROM tbl_admin JOIN tbl_nama_admin ON tbl_admin.id_admin=tbl_nama_admin.id_admin WHERE tbl_admin.username='$username'");
		return $query->fetch_array(MYSQLI_ASSOC);
	}

	function ganti_pass($con, $pass)
	{
		session_start();
		$user = $_SESSION['username'];
		$query = mysqli_query($con, "UPDATE tbl_admin SET password='$pass' WHERE username='$user'");
		echo '
			<script>
				alert("Ganti Password Berhasil!");
				window.location.href="index.php?page=login";
			</script>
		';
	}

	function detailData($con,$kode)
	{
		$q = mysqli_query($con,"SELECT * FROM tbl_pendaftaran
		JOIN tbl_nilai ON 
		tbl_nilai.id_pendaftar = tbl_pendaftaran.id_pendaftar
		WHERE tbl_pendaftaran.id_pendaftar = '$kode'
		ORDER BY tbl_pendaftaran.id_pendaftar DESC;");
		$data = mysqli_fetch_array($q);
		return $data;	
	}


	function editData($con,$nama,$tempat,$tanggal,$kelamin,$agama,$alamat,$warga,$asalse,$alamatse,$ajaran,$ayah,$kerja,$nilai,$kode)
	{
		//query
		$q1 = mysqli_query($con,"UPDATE tbl_pendaftaran SET 
		nama = '$nama',
		Tempat_lahir = '$tempat',
		Tanggal_lhir = '$tanggal',
		jenis_kelamin = '$kelamin',
		agama = '$agama',
		alamat = '$alamat',
		kewarganegaraan = '$warga',
		asalsekolah = '$asalse',
		alamatsekolah = '$alamatse',
		tahun_ajaran = '$ajaran',
		orangtua = '$ayah',
		pekerjaan = '$kerja'
		WHERE id_pendaftar = '$kode';");
		$q2 = mysqli_query($con,"UPDATE tbl_nilai SET 
		skhun ='$nilai'
		WHERE id_pendaftar = '$kode';");
		if($q1 & $q2)
		{
			echo '
			<script>
				alert("Data berhasil diedit !");
				window.location.href="index.php?page=admin";
			</script>
			';
		}
	}
}
?>