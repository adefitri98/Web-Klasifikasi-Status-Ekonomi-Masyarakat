<?php
//memasukkan koneksi database
include '../../koneksi.php';
 
	//kalau tidak ada id di query string
	if(!isset($_GET['id'])){
		header('Location: ../tampil_laporan_pertahun.php');
	}

	//ambil id dari query string
	$periode = $_GET['id'];

	//buat query untuk ambil data dari database
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.periode='$periode' and a.kk=b.kk");
	

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
	<title>Laporan Per Tahun</title>
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

</head>
<body>
		    			<p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk Periode <?php echo $periode;?></b></p>
		    			<br>
					        	<table border="1" cellpadding="5">
									<thead align="center">
										<tr>
											<th scope="col">No</th>
											<th scope="col">No Kartu Keluarga</th>
											<th scope="col">Nama Kepala keluarga</th>
											<th scope="col">TTL</th>
											<th scope="col">Jenkel</th>
											<th scope="col">Alamat</th>
											<th scope="col">Pekerjaan</th>
											<th scope="col">Pendapatan</th>
											<th scope="col">Asset</th>
											<th scope="col">Pengeluaran</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										$no=1;
										while($semua_data = mysqli_fetch_array($query))
										{
											echo "<tr>";
											echo "<td scope='row'>" .$no++."</td>";
											echo "<td scope='row'>" .$semua_data['kk']."</td>";
											echo "<td scope='row'>" .$semua_data['nama']."</td>";
											echo "<td scope='row'>" .$semua_data['tempat_lahir'].",".TanggalIndo($semua_data['tanggal_lahir'])."</td>";
											echo "<td scope='row'>" .$semua_data['jenkel']."</td>";
											echo "<td scope='row'>" .$semua_data['alamat']."</td>";
											echo "<td scope='row'>" .$semua_data['pekerjaan']."</td>";
											echo "<td scope='row'>" .$semua_data['pendapatan']."</td>";
											echo "<td scope='row'>" .$semua_data['asset']."</td>";
											echo "<td scope='row'>" .$semua_data['pengeluaran']."</td>";
											echo "<td scope='row'>" .$semua_data['status']."</td>";
											echo "</tr>";
										}
										?>
									</tbody>
								</table>

<i><br><br><p><b>
<?php 
$kaya=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE periode='$periode' and status='Kaya'");
$kaya=mysqli_num_rows($kaya);

$miskin=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE periode='$periode' and status='Miskin'");
$miskin=mysqli_num_rows($miskin);

if ($kaya > $miskin) {
	echo "Rata - Rata Status Ekonomi Masyarakat Sungai Andai Pada ".$periode." adalah Kaya";
} else if ($miskin > $kaya) {
	echo "Rata - Rata Status Ekonomi Masyarakat Sungai Andai Pada ".$periode." adalah Miskin";
} else if ($miskin == $kaya) {
	echo "Rata - Rata Status Ekonomi Masyarakat Sungai Andai Pada ".$periode." adalah Seimbang";
}
?>
</b></p></i>
</body>
</html>
