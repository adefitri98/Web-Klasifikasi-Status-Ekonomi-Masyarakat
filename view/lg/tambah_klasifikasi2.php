<?php
	include '../koneksi.php';
	$query = mysqli_query($kon, "SELECT * FROM tb_penduduk");

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
		    		<div class="card-body " >
		    			<p align="center" style="font-size: 18px;"><b>Tambahkan Data Ekonomi</b></p>
		    			<br>
		    			<form action="simpan.php" method="post">
		    				<div class="form-row">
							    <div class="form-group col-md-12">
								    <label>Pilih Nama Kepala Keluarga</label>
									<select name="kk" class="form-control" >
						            	<option value=”> </option>
										<?php 
										while($data = mysqli_fetch_assoc($query) ){?>
											<option value="<?php echo $data['kk'];?>">
												<?php echo $data['kk']; ?> - <?php echo $data['nama']; ?>
											</option>
										<?php } ?>
								    </select>
							    </div>
		    				</div>
		    				<div class="form-row">
							    <div class="form-group col-md-4">
							      <label>Pendapatan</label>
							      <input type="text" class="form-control" name="pendapatan">
							    </div>
							    <div class="form-group col-md-4">
							      <label>Asset</label>
							      <input type="text" class="form-control" name="asset">
							    </div>
							    <div class="form-group col-md-4">
							      <label>Pengeluaran</label>
							      <input type="text" class="form-control" name="pengeluaran">
							    </div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-8">
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
								<div class="form-group col-md-4">
									<label>Masukkan Nilai K</label>
									<input type="text" name="k" class="form-control">
								</div>
							</div>
							  <br>
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