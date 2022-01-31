<?php

include '../../koneksi.php';

$kk=$_POST['kk'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$tanggal_lahir=$_POST['tanggal_lahir'];
$tempat_lahir=$_POST['tempat_lahir'];
$jenkel=$_POST['jenkel'];
$agama=$_POST['agama'];
$pekerjaan=$_POST['pekerjaan'];

$input1=mysqli_query($kon, 
	"INSERT INTO tb_penduduk SET 
	kk='$kk', 
	nama='$nama',
	tanggal_lahir='$tanggal_lahir', 
	tempat_lahir='$tempat_lahir', 
	alamat='$alamat', 
	jenkel='$jenkel', 
	agama='$agama',
	pekerjaan='$pekerjaan' ");

	if ($input1) {
	   mysqli_close($koneksi);
	   header("location:../tambah_klasifikasi.php?id=$kk");
	  } else{
	    echo "Input Gagal";
	  }
?>