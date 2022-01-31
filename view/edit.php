
<?php
	include '../koneksi.php';

	//kalau tidak ada id di query string
	if(!isset($_GET['id'])){
		header('Location: data_penduduk.php');
	}

	//ambil id dari query string
	$id_klasifikasi = $_GET['id'];

	//buat query untuk ambil data dari database
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk as a, tb_klasifikasi as b  WHERE b.id_klasifikasi='$id_klasifikasi' and a.kk=b.kk");
	$data=mysqli_fetch_array($query);
	

	//Jika data yang di-edit tidak ditemukan
	if(mysqli_num_rows($query) < 1){
		die("data tidak ditemukan...");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Penduduk</title>
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
		    			<p align="center" style="font-size: 18px;"><b>Edit Data Ekonomi <?php echo $data['nama']; ?></b></p>
		    			<br>
		    			<form action="tambah_klasifikasi3.php" method="post">
		    				<div class="form-row">
							    <div class="form-group col-md-6">
							      <label>No. Kartu Keluarga</label>
							      <input type="text" class="form-control" name="kk" value="<?php echo $data['kk']; ?>" readonly>
							      <input type="text" class="form-control" name="id" value="<?php echo $data['id_klasifikasi']; ?>" hidden>
							    </div>
							    <div class="form-group col-md-6">
							      <label>Nama Kepala Keluarga</label>
							      <input type="text" class="form-control" value="<?php echo $data['nama']; ?>" name="nama" required="">
							    </div>
							</div>
							<div class="form-group">
							    <label>Alamat</label>
							    <textarea name="alamat" placeholder="<?php echo $data['alamat']; ?>" class="form-control"></textarea>
							  </div>
							<div class="form-row">
							    <div class="form-group col-md-6">
							      <label>Tempat Lahir</label>
							      <input type="text" class="form-control" value="<?php echo $data['tempat_lahir']; ?>" name="tempat_lahir" required="">
							    </div>
							    <div class="form-group col-md-6">
							      <label>Tanggal Lahir</label>
							      <input type="date" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>" name="tanggal_lahir" required="">
							    </div>
							</div>
							  <div class="form-row">
							    <div class="form-group col-md-3">
							      <label>Agama</label>
							      <select name="agama" class="form-control" required="">
							        <option selected> </option>
							        <option value="Islam">Islam</option>
							        <option value="Kristen">Kristen</option>
							        <option value="Budha">Budha</option>
							        <option value="Konghucu">Konghucu</option>
							        <option value="Hindu">Hindu</option>
							      </select>
							    </div>
							    <div class="form-group col-md-3">
							      <label>Pekerjaan</label>
							      <select name="pekerjaan"  class="form-control" required="">
							        <option selected> </option>
							        <option value="PNS">PNS</option>
							        <option value="Buruh">Buruh</option>
							        <option value="Swasta">Swasta</option>
							        <option value="Wiraswasta">Wiraswasta</option>
							        <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
							      </select>
							    </div>
							  	<div class="form-group col-md-6">
							      <label>Jenis Kelamin</label>
							  		<div class="form-check">
									  <input class="form-check-input" type="radio" name="jenkel" value="Laki - Laki" checked>
									  <label class="form-check-label">
									    Laki - Laki
									  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  <input class="form-check-input" type="radio" name="jenkel" value="Perempuan">
									  <label class="form-check-label">
									    Perempuan
									  </label>
									</div>
							  	</div>
							  </div>
							  <br>
							  <table align="center">
						 		<td align="left"><a href = "javascript:history.back()" class="btn btn-secondary btn-md" align="left"> Kembali</a></td>
						 		<td width="90%"></td>
						 		<td align="right"><button type="submit" name="hitung" class="btn btn-info btn-md">Lanjut</button></td>
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