<?php
	include '../koneksi.php';
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
		    			<p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk Per-Tahun</b></p>
		    			<br>
		    			<form action="tampil_laporan_pertahun.php" method="post">
		    				<div class="form-group row" style="font-size: 15px;">
							    <label for="colFormLabel" class="col-sm-2 col-form-label">Periode</label>
							    <div class="col-sm-10">
							    	<SELECT name="periode" class="form-control">
										<option value=”> </option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
									</SELECT>
							    </div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12" align="center">
							   <input type="submit" class="btn btn-info btn-sm" name="search" style="width: 120px;" value="Lihat">
									</div>
							</div>
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
    </script>
</body>
</html>