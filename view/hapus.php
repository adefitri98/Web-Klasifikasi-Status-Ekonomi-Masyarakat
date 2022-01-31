<?php
	include("../koneksi.php");

	if(isset($_GET['id'])){
		//ambil id dari query string
		$id_klasifikasi = $_GET['id'];

		//buat query hapus		
		$result = mysqli_query($kon, "DELETE FROM tb_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");

		//apakah query hapus berhasil?
		if ($result) {
			header('Location: data_penduduk.php');
		}else{
			die("gagal menghapus...");
		}
	}else{
		die("Akses dilarang...");
	}
?>