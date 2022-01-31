<?php
//memasukkan koneksi database
include '../../koneksi.php';
 
	//kalau tidak ada id di query string
	if(!isset($_GET['id'])){
		header('Location: ../tampil_laporan_pernama.php');
	}

	//ambil id dari query string
	$kk = $_GET['id'];

	//buat query untuk ambil data dari database
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.kk='$kk' and a.kk=b.kk");
	$tampil_data = mysqli_fetch_array($query);
	

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
	<title>Laporan Per Nama</title>
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
		<div class="card">
		<div class="row">

		    <div class="col-12">
		    		<div class="card-body " >
		    			<p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk <?php echo $tampil_data['nama'];?></b></p>
		    			<br>
		    		<div class="row">
		    			<div class="col-6">
		    			<div class="table-responsive-sm">
		    				<table class="table">
		    					<tr>
		    						<td>Nomor Kartu Keluarga</td>
		    						<td><?php echo $tampil_data['kk'];?></td>
		    					</tr>
		    					<tr>
		    						<td>Nama Kepala Keluarga</td>
		    						<td><?php echo $tampil_data['nama'];?></td>
		    					</tr>
		    					<tr>
		    						<td>TTL</td>
		    						<td>
		    							<?php echo $tampil_data['tempat_lahir'];?>
		    							,
		    							<?php echo TanggalIndo($tampil_data['tanggal_lahir']);?></td>
		    					</tr>
		    					<tr>
		    						<td>Alamat</td>
		    						<td><?php echo $tampil_data['alamat'];?></td>
		    					</tr>
		    					<tr>
		    						<td>Agama</td>
		    						<td><?php echo $tampil_data['agama'];?></td>
		    					</tr>
		    					<tr>
		    						<td>Jenis Kelamin</td>
		    						<td><?php echo $tampil_data['jenkel'];?></td>
		    					</tr>
		    					<tr>
		    						<td>Pekerjaan</td>
		    						<td><?php echo $tampil_data['pekerjaan'];?></td>
		    					</tr>
		    				</table>
		    			</div>
		    		</div>
		    			<div class="col-6">
		    				<div class="table-responsive-sm">
		    					<?php 
								$query_klasifikasi = mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE kk='$kk' order by periode asc");
		    					while ($tampil_klasifikasi=mysqli_fetch_array($query_klasifikasi)){ ?>
		    					<table class="table table-sm">		    						
		    						<tr>
			    						<td>Pendapatan</td>
			    						<td><?php echo $tampil_klasifikasi['pendapatan'];?></td>
			    						<td>Asset</td>
			    						<td><?php echo $tampil_klasifikasi['asset'];?></td>
			    					</tr>
			    					<tr>
			    						<td>Pengeluaran</td>
			    						<td><?php echo $tampil_klasifikasi['pengeluaran'];?></td>
			    						<td>Periode</td>
			    						<td><?php echo $tampil_klasifikasi['periode'];?></td>
			    					</tr>
			    					<tr>
			    						<td colspan="4" align="center">----------------------------------------</td>
			    					</tr>
			    					
			    					<tr>
			    						<td>K Pertama</td>
			    						<td><?php echo $tampil_klasifikasi['k1'] ;?></td>
			    						<td>Status</td>
			    						<td><?php echo $tampil_klasifikasi['s1'] ;?></td>
			    					</tr>
			    					<tr>
			    						<td>K Pertama</td>
			    						<td><?php echo $tampil_klasifikasi['k2'] ;?></td>
			    						<td>Status</td>
			    						<td><?php echo $tampil_klasifikasi['s2'] ;?></td>
			    					</tr>
			    					<tr>
			    						<td>K Pertama</td>
			    						<td><?php echo $tampil_klasifikasi['k3'] ;?></td>
			    						<td>Status</td>
			    						<td><?php echo $tampil_klasifikasi['s3'] ;?></td>
			    					</tr>

			    					<tr>
			    						<td>Data Valid :</td>
			    						<td colspan="3" valign="midle"><p><b>Status Ekonomi <?php echo $tampil_klasifikasi['status'];?></b></p></td>
		    						</tr>
		    					</table>
		    					<br>
		    				<?php } ?>
		    				</div>

					</div>
				</div>

<i><br><br><p><b>
<?php 
$kaya=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE kk='$kk' and status='Kaya'");
$kaya=mysqli_num_rows($kaya);

$miskin=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE kk='$kk' and status='Miskin'");
$miskin=mysqli_num_rows($miskin);

if ($kaya > $miskin) {
	echo "Rata - Rata Status Ekonomi ".$tampil_data['nama']." adalah Kaya ";
} else if ($miskin > $kaya) {
	echo "Rata - Rata Status Ekonomi ".$tampil_data['nama']." adalah Miskin";
} else if ($miskin == $kaya) {
	echo "Rata - Rata Status Ekonomi ".$tampil_data['nama']." adalah Seimbang";
}
?>
</b></p></i>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
