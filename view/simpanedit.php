<?php
include '../koneksi.php';
if (isset($_POST['hitung'])) {
	$kk=$_POST['kk'];
	$id_klasifikasi=$_POST['id'];
	$pendapatanN = $_POST['pendapatan'];
	$assetN = $_POST['asset'];
	$pengeluaranN = $_POST['pengeluaran'];
	$k1 = $_POST['k1'];
	$k2 = $_POST['k2'];
	$k3 = $_POST['k3'];
	$periode=$_POST['periode'];

	//Membaca Jumlah Baris Data Training Pada Database
	$sql = mysqli_query($kon,"SELECT * FROM tb_data_training ORDER BY id ASC");
	$numrows = mysqli_num_rows($sql);

	//Perhitungan Jarak KNN
	for ($i=1; $i <= $numrows; $i++)
	{	
		$sql1 = mysqli_query($kon, "SELECT * FROM tb_data_training Where id = $i");
		while($data = mysqli_fetch_array($sql1))
		{
			//Pengurangan(KNN)
			$v1 = $pendapatanN - $data['pendapatan'];
			$v2 = $assetN - $data['asset'];
			$v3 = $pengeluaranN - $data['pengeluaran'];
								
			//Pengkuadratan(KNN)
			$hit1 = (pow($v1,2)) + (pow($v2,2)) + (pow($v3,2));
								
			//Pengakaran(KNN)
			$hit2 = sqrt($hit1);
								
			//Penyimpanan perhitungan ke database sementara
			mysqli_query($kon,"INSERT INTO tb_sementara SET 
															id_sementara='$i',
															jarak='$hit2',
															pendapatan='$data[pendapatan]',
															asset='$data[asset]',
															pengeluaran='$data[pengeluaran]',
															status='$data[status]'");
		}	
	}

	//data yang sudah d sorting dari data pertama sampai data nilai K pertama
	$sql_1 = mysqli_query($kon,"SELECT * FROM tb_sementara ORDER BY tb_sementara.jarak ASC LIMIT 0,$k1");
	$x=1;  
	while($data = mysqli_fetch_array($sql_1))  {   
	mysqli_query($kon,"INSERT INTO tb_urut SET 
												id_urut='$x',
												jarak='$data[jarak]',
												status='$data[status]'");
												$x=$x+1;
											}

	//Penggunaan nilai K dalam KNN untuk penentuan STATUS
	$gol1a = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Miskin'");
	$gol2a = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Kaya'");
	$miskin1=mysqli_num_rows($gol1a);
	$kaya1=mysqli_num_rows($gol2a);

	if ($miskin1 > $kaya1) {
		$status1 = "Miskin";
	} else if ($kaya1 > $miskin1){
		$status1="Kaya";	
	}else {
		$status1 = "Seimbang";
	}

	$hapus_data1 = mysqli_query($kon,"DELETE FROM tb_urut");


	//data yang sudah d sorting dari data pertama sampai data nilai K kedua
	$sql_2 = mysqli_query($kon,"SELECT * FROM tb_sementara ORDER BY tb_sementara.jarak ASC LIMIT 0,$k2");
	$x=1;  
	while($data = mysqli_fetch_array($sql_2))  {    	
	//memasukkan data yang sudah di sorting mulai dari pertama sampai data nilai k1 ke dalam database urut  
	mysqli_query($kon,"INSERT INTO tb_urut SET 
												id_urut='$x',
												jarak='$data[jarak]',
												status='$data[status]'");
												$x=$x+1;
											}

	//Penggunaan nilai K dalam KNN untuk penentuan STATUS
	$gol1b = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Miskin'");
	$gol2b = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Kaya'");
	$miskin2=mysqli_num_rows($gol1b);
	$kaya2=mysqli_num_rows($gol2b);

	if ($miskin2 > $kaya2) {
		$status2 = "Miskin";
	} else if ($kaya2 > $miskin2){
		$status2="Kaya";	
	}else {
		$status2 = "Seimbang";
	}

	$hapus_data2 = mysqli_query($kon,"DELETE FROM tb_urut");

		//data yang sudah d sorting dari data pertama sampai data nilai K ketiga
	$sql_3 = mysqli_query($kon,"SELECT * FROM tb_sementara ORDER BY tb_sementara.jarak ASC LIMIT 0,$k3");
	$x=1;  
	while($data = mysqli_fetch_array($sql_3))  {    	
	//memasukkan data yang sudah di sorting mulai dari pertama sampai data nilai k1 ke dalam database urut  
	mysqli_query($kon,"INSERT INTO tb_urut SET 
												id_urut='$x',
												jarak='$data[jarak]',
												status='$data[status]'");
												$x=$x+1;
											}

	//Penggunaan nilai K dalam KNN untuk penentuan STATUS
	$gol1c = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Miskin'");
	$gol2c = mysqli_query($kon,"SELECT status FROM tb_urut WHERE status='Kaya'");
	$miskin3=mysqli_num_rows($gol1c);
	$kaya3=mysqli_num_rows($gol2c);

	if ($miskin3 > $kaya3) {
		$status3 = "Miskin";
	} else if ($kaya3 > $miskin3){
		$status3="Kaya";	
	}else {
		$status3 = "Seimbang";
	}

	$hapus_data3 = mysqli_query($kon,"DELETE FROM tb_urut");
	$hapus_sementara = mysqli_query($kon,"DELETE FROM tb_sementara");

	if ($status1 == $status2) {
		$statusnew=$status1;
	}

	else if ($status2 == $status3) {
		$statusnew=$status2;
	} 

	else if ($status1 == $status3) {
		$statusnew=$status1;
	} else{
		$statusnew="Status Belum Valid";
	}

	$edit_klasifikasi = mysqli_query($kon,"UPDATE tb_klasifikasi SET
								pendapatan='$pendapatanN',
								asset='$assetN',
								pengeluaran='$pengeluaranN',
								periode='$periode',
								kk='$kk',
								status='$statusnew',
								k1='$k1',
								k2='$k2',
								k3='$k3',
								s1='$status1',
								s2='$status2',
								s3='$status3'
								WHERE id_klasifikasi='$id_klasifikasi'
								");

	$input_training = mysqli_query($kon,"INSERT INTO tb_data_training SET
								id='',
								pendapatan='$pendapatanN',
								asset='$assetN',
								pengeluaran='$pengeluaranN',
								status='$statusnew'
								");
}


	$tampil=mysqli_query($kon,"SELECT * FROM tb_penduduk WHERE kk='$kk'");
	$tampil_data=mysqli_fetch_array($tampil);
	$tampil_klasifikasii=mysqli_query($kon,"SELECT * FROM tb_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");


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
		<div class="row">

		    <div class="col-9">
		    	<div class="card">
		    		<div class="card-header">
						<ul class="nav justify-content-center">
						  <li class="nav-item">
						    <a class="nav-link active" href="../index.php">Beranda</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="data_penduduk.php">Semua Data</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="tambah_data.php">Tambah Data</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="laporan.php">Laporan</a>
						  </li>
						</ul>
		    		</div>

		    		<div class="card-body" align="center">
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
		    					<?php $tampil_klasifikasi=mysqli_fetch_array($tampil_klasifikasii); ?>
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
		    				</div>
		    			</div>
		    		</div>
		    			<p><a href="data_penduduk.php" class="btn btn-info btn-sm">Selesai</a>
		    		</div>
		    	</div>
		    </div>

			<div class="col-3">
				<div class="card">
				    <div class="card-header">
				    	Semua Data Klasifikasi
				    </div>
				    <div class="card-body" style="height: 100%;">
        				<a href="data_penduduk.php" class="btn btn-info">Lihat Data</a>
				    </div>
				</div><br>
				<div class="card" align="center">
				    <div class="card-header">
				    	Profil Kelurahan Sungai Andai
				    </div>
				    <div class="card-body" style="height: 100%;">
				    	<img src="../gambar/sundai.jpg" style="max-height: 190px;"><br><br>
				    	<p align="justify" style="text-indent: 2em;">
				    	Sungai Andai adalah salah satu kelurahan di Kecamatan Banjarmasin Utara, Kota Banjarmasin, Provinsi Kalimantan Selatan, Indonesia. Sungai Andai merupakan pemekaran dari kelurahan Sungai Jingah. Sungai Andai memiliki 59 RT. Dasar Hukum pembentukan Kel. Sungai Andai adalah Perda Nomor 1 Tahun 2010 tentang Pemekaran, Perubahan Dan Pembentukan Kelurahan Dalam Daerah Kota Banjarmasin. 
				    	</p>
				    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>