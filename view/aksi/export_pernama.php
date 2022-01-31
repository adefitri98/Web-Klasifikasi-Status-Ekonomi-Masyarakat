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
	$nama=mysqli_fetch_array($query);
	

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
	header("Content-Disposition: attachment; filename=Data_ekonomi_nama.xls");
	?>

</head>
<body>
		    			<p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk <?php echo $nama['nama'];?></b></p>
		    			<br>
		    			<table>
		    				<tr>
		    					<td>No KK :</td><td><?php echo $nama['kk'];?></td>
		    					<td></td>
		    					<td>Nama KK :</td><td><?php echo $nama['nama'];?></td>
		    				</tr>
		    				<tr>
		    					<td>TTL</td><td><?php echo $nama['tempat_lahir'];?>, <?php echo TanggalIndo($nama['tanggal_lahir']);?></td>
		    					<td></td>
		    					<td>Pekerjaan</td><td><?php echo $nama['pekerjaan'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Jenis Kelamin</td><td><?php echo $nama['jenkel'];?></td>
		    					<td></td>
		    					<td>Agama</td><td><?php echo $nama['agama'];?></td>
		    				</tr>
		    				<tr>
		    					<td>Alamat</td><td colspan="4"><?php echo $nama['alamat'];?></td>
		    				</tr>
		    			</table>
					        	<table border="1" cellpadding="5">
									<thead align="center">
										<tr>
											<th scope="col">No</th>
											<th scope="col">Pendapatan</th>
											<th scope="col">Asset</th>
											<th scope="col">Pengeluaran</th>
											<th scope="col">Status</th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										$no=1;
										$query1 = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.kk='$kk' and a.kk=b.kk");
										while($semua_data = mysqli_fetch_array($query1))
										{
											echo "<tr>";
											echo "<td scope='row'>" .$no++."</td>";
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
$kaya=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE kk='$kk' and status='Kaya'");
$kaya=mysqli_num_rows($kaya);

$miskin=mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE kk='$kk' and status='Miskin'");
$miskin=mysqli_num_rows($miskin);


if ($kaya > $miskin) {
	echo "Rata - Rata Status Ekonomi ".$nama['nama']." adalah Kaya ";
} else if ($miskin > $kaya) {
	echo "Rata - Rata Status Ekonomi ".$nama['nama']." adalah Miskin";
} else if ($miskin == $kaya) {
	echo "Rata - Rata Status Ekonomi ".$nama['nama']." adalah Seimbang";
}

?>
</b></p></i>
</body>
</html>
