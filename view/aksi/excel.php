<?php
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
	<title>Export Data Ekonomi</title>
</head>
<body>
	<style type="text/css">
		body{
			font-family: sans-serif;
		}
		table{
			margin: 20px auto;
			border-collapse: collapse;
		}
		table th,
		table td{
			border: 1px solid #3c3c3c;
			padding: 3px 8px;
		}
		a{
			background: blue;
			color: #fff;
			padding: 8x 10px;
			text-decoration: none;
			border-radius: 2px; 
		}
	</style>
	<!--coversi ke excel -->
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_ekonomi.xls");
	?>
<header>
		<h1>Laporan Data Ekonomi <?php echo $data['nama'] ;?> pada Periode <?php echo $data['periode']; ?></h1>
	<table border="1" cellpadding="5">
		<thead align="center">
			<tr>
				<th scope="col">No. Kartu Keluarga</th>
				<th scope="col">Nama Kepala Keluarga</th>
				<th scope="col">Tempat, Tanggal Lahir</th>
				<th scope="col">Jenis Kelamin</th>
				<th scope="col">Agama</th>
				<th scope="col">Alamat</th>
				<th scope="col">Pekerjaan</th>
				<th scope="col">Pendapatan</th>
				<th scope="col">Asset</th>
				<th scope="col">Pengeluaran</th>
				<th scope="col">Status Ekonomi</th>
			</tr>
		</thead>
		<tbody align="center">
			<?php
				echo "<tr>";
				echo "<td scope='row'>" .$data['kk']."</td>";
				echo "<td scope='row'>" .$data['nama']."</td>";
				echo "<td scope='row'>" .$data['tempat_lahir'].", " .TanggalIndo($data['tanggal_lahir'])."</td>";
				echo "<td scope='row'>" .$data['jenkel']."</td>";
				echo "<td scope='row'>" .$data['agama']."</td>";
				echo "<td scope='row'>" .$data['alamat']."</td>";
				echo "<td scope='row'>" .$data['pekerjaan']."</td>";
				echo "<td scope='row'>" .$data['pendapatan']."</td>";
				echo "<td scope='row'>" .$data['asset']."</td>";
				echo "<td scope='row'>" .$data['pengeluaran']."</td>";
				echo "<td scope='row'>" .$data['status']."</td>";
				echo "</tr>";
			?>
		</tbody>
	</table>
</body>
</html>