<?php
//memasukkan koneksi database
include '../../koneksi.php';
 
	//kalau tidak ada id di query string
	if(!isset($_GET['id'])){
		header('Location: ../detail_penduduk.php');
	}

	//ambil id dari query string
	$id_klasifikasi = $_GET['id'];

	//buat query untuk ambil data dari database
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.id_klasifikasi=$id_klasifikasi and a.kk=b.kk");
	$data=mysqli_fetch_array($query);
	

	//Jika data yang di-edit tidak ditemukan
	if(mysqli_num_rows($query) < 1){
		die("data tidak ditemukan...");
	}

	function TanggalIndo($date){
	  $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
	  $tahun = substr($date, 0, 4);
	  $bulan = substr($date, 5, 2);
	  $tgl   = substr($date, 8, 2);
	 
	  $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;   
	  return($result);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Penduduk</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<style type="text/css">
		body{
			padding: 20px;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		    	<div class="card">
		    		<div class="card-body">
		    			<br>
		    			<p><h3 align="center" style="font-size: 18px;"><b>Data Ekonomi <?php echo $data['nama']; ?> pada Periode <?php echo $data['periode']; ?></b></h3></p>
		    			<br>
		    			<table class="table table-lg table-bordered">
		    				<tr><td>No Kartu Keluarga</td><td><?php echo $data['kk']; ?></td></tr>
		    				<tr><td>Nama Kepala Keluarga</td><td><?php echo $data['nama']; ?></td></tr>
		    				<tr><td>Tempat, Tanggal Lahir</td><td><?php echo $data['tempat_lahir']; ?>, <?php echo TanggalIndo($data['tanggal_lahir']); ?></td></tr>
		    				<tr><td>Jenis Kelamin</td><td><?php echo $data['jenkel']; ?></td></tr>
		    				<tr><td>Agama</td><td><?php echo $data['agama']; ?></td></tr>
		    				<tr><td>Alamat</td><td><?php echo $data['alamat']; ?></td></tr>
		    				<tr><td>Pekerjaan</td><td><?php echo $data['pekerjaan']; ?></td></tr>

		    				<tr><td>Pendapatan</td><td><?php echo $data['pendapatan']; ?> Juta</td></tr>
		    				<tr><td>Asset</td><td><?php echo $data['asset']; ?> Juta</td></tr>
		    				<tr><td>Pengeluaran</td><td><?php echo $data['pengeluaran']; ?> Juta</td></tr>
		    				<tr><td>Status Ekonomi</td><td><b><?php echo $data['status']; ?></b></td></tr>
		    			</table>
		    			<br>
					</div>
				</div>	
	</div>
	<script>
		window.print();
	</script>
</body>
</html>