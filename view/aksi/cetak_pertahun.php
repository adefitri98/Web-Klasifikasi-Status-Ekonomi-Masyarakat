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
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.periode='$periode' and a.kk=b.kk order by a.nama asc");
	

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
<body onload="window.print();">
	<div class="container-fluid">
		<div class="row">

		    <div class="col-12">
		    		<div class="card-body " >
		    			<p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk Periode <?php echo $periode;?></b></p>
		    			<br>
					        <div class="table-responsive-sm">
					        	<table class="table table-sm table-bordered">
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
					</div>

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
				</div>
			</div>
		</div>
	</div>
</body>
</html>
