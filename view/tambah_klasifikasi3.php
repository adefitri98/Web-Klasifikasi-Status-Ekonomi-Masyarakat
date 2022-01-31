<?php
	include '../koneksi.php';


$id_klasifikasi=$_POST['id'];
$kk=$_POST['kk'];
$nama=$_POST['nama'];
$alamat=$_POST['alamat'];
$tanggal_lahir=$_POST['tanggal_lahir'];
$tempat_lahir=$_POST['tempat_lahir'];
$jenkel=$_POST['jenkel'];
$agama=$_POST['agama'];
$pekerjaan=$_POST['pekerjaan'];

$input1=mysqli_query($kon, 
	"UPDATE tb_penduduk SET 
	nama='$nama',
	tanggal_lahir='$tanggal_lahir', 
	tempat_lahir='$tempat_lahir', 
	alamat='$alamat', 
	jenkel='$jenkel', 
	agama='$agama',
	pekerjaan='$pekerjaan' WHERE kk='$kk'");

	$penduduk_query = mysqli_query($kon, "SELECT * FROM tb_klasifikasi WHERE id_klasifikasi='$id_klasifikasi'");
	$penduduk = mysqli_fetch_array($penduduk_query);

	$jumlah_data = mysqli_query($kon, "SELECT * FROM tb_data_training");
	$jumlah=mysqli_num_rows($jumlah_data);

	
	if ($jumlah%2==1) {
		$ganjil_genap="Genap";
		$mulai=2;
		$jumlah_angka=$jumlah/2;
	} else{
		$ganjil_genap="Ganjil";
		$mulai=3;
		$jumlah_angka=($jumlah/2)-1;
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Klasifikasi</title>
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
		    		<div class="card-body " >
		    			<p align="center" style="font-size: 18px;"><b>Tambahkan Data Ekonomi</b></p>
		    			<br>
		    			<form action="simpanedit.php" method="post">

		    				<input type="text" name="kk" value="<?php echo $kk; ?>" hidden>
		    				<input type="text" name="id" value="<?php echo $penduduk['id_klasifikasi']; ?>" hidden>
		    				<div class="form-row">
							    <div class="form-group col-md-4">
							      <label>Pendapatan</label>
							      <input type="text" class="form-control" name="pendapatan" value="<?php echo $penduduk['pendapatan'] ;?>">
							    </div>
							    <div class="form-group col-md-4">
							      <label>Asset</label>
							      <input type="text" class="form-control" name="asset" value="<?php echo $penduduk['asset'] ;?>">
							    </div>
							    <div class="form-group col-md-4">
							      <label>Pengeluaran</label>
							      <input type="text" class="form-control" name="pengeluaran" value="<?php echo $penduduk['pengeluaran'] ;?>">
							    </div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-12">
								    <label>Tahun Periode</label>
									<select name="periode" class="form-control">
									    <option selected> </option>
									    <option value="2016">2016</option>
									    <option value="2017">2017</option>
									    <option value="2018">2018</option>
									    <option value="2019">2019</option>
									    <option value="2020">2020</option>
									</select>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Masukkan Nilai K Pertama</label>
									<input type="text" name="k1" class="form-control" required="">
									<small class="form-text text-muted">Masukkan Angka <?php echo $ganjil_genap;?> dengan kisaran angka <?php echo $mulai; ?> - <?php echo sprintf('%.0f', $jumlah_angka);?></small>
								</div>
								<div class="form-group col-md-4">
									<label>Masukkan Nilai K Kedua</label>
									<input type="text" name="k2" class="form-control" required="">
									<small class="form-text text-muted">Masukkan Angka <?php echo $ganjil_genap;?> dengan kisaran angka <?php echo $mulai; ?> - <?php echo sprintf('%.0f', $jumlah_angka);?></small>
								</div>
								<div class="form-group col-md-4">
									<label>Masukkan Nilai K Ketiga</label>
									<input type="text" name="k3" class="form-control" required="">
									<small class="form-text text-muted">Masukkan Angka <?php echo $ganjil_genap;?> dengan kisaran angka <?php echo $mulai; ?> - <?php echo sprintf('%.0f', $jumlah_angka);?></small>
								</div>
							</div>
							<small><i><sup>*</sup>Syarat Ketentuan :<br>
							Masukkan nilai K yang berbeda antara Nilai K Pertama, Nilai K Kedua, Maupun Nilai K yang Ketiga</i></small>
							  <br><br>
							  <table align="center">
						 		<td align="left"><a href = "javascript:history.back()" class="btn btn-secondary btn-md" align="left"> Kembali</a></td>
						 		<td width="90%"></td>
						 		<td align="right"><button type="submit" name="hitung" class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal">Lanjut</button></td>
						 	</table>
		    			</form>
		    		</div>
		    	</div>
		    </div>

			<div class="col-3">
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