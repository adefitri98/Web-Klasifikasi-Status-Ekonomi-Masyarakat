<?php
	//Memanggil database
	include '../koneksi.php';
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
		    			<!-- menampilkan hasil pencarian -->
					    <?php
					    if(isset($_POST['search'])){
					        $kk = $_POST['kk'];
							$query = mysqli_query($kon, "SELECT  * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.kk='$kk' AND a.kk=b.kk order by b.periode asc");
							$nama=mysqli_fetch_array($query);
		    				?><p align="center" style="font-size: 18px;"><b>Laporan Data Penduduk <?php echo $nama['nama']; ?></b></p><?php
							if(mysqli_num_rows($query) > 0){?>
					        <br>
					        <div class="table-responsive-sm">
					        	<table class="table table-sm table-bordered">
									<thead align="center">
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama</th>
											<th scope="col">Alamat</th>
											<th scope="col">Status</th>
											<th scope="col">Periode</th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										$no=1;
										$query1 = mysqli_query($kon, "SELECT  * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.kk='$kk' AND a.kk=b.kk order by b.periode asc");
										while($semua_data = mysqli_fetch_array($query1))
										{
											echo "<tr>";
											echo "<td scope='row'>" .$no++."</td>";
											echo "<td scope='row'>" .$semua_data['nama']."</td>";
											echo "<td scope='row'>" .$semua_data['alamat']."</td>";
											echo "<td scope='row'>" .$semua_data['status']."</td>";
											echo "<td scope='row'>" .$semua_data['periode']."</td>";
										}
										?>
									</tbody>
								</table>
							</div>
		    					<br>
				    			<p align="center">
				    				<a href = "javascript:history.back()" class="btn btn-secondary btn-sm"><img src="../gambar/kembali.png" width="20px"> Kembali</a>
				    				<?php echo "<a href = 'aksi/export_pernama.php?id=".$kk."' class='btn btn-success btn-sm'><img src='../gambar/simpan.png' width='20px'> Export Excel</a>";?>
				    				<?php echo "<a href = 'aksi/cetak_pernama.php?id=".$kk."' class='btn btn-danger btn-sm'><img src='../gambar/cetak.png' width='20px'> Cetak</a>";?>
				    			</p>
							<?php
					        }else{
					            echo "<br><center><h6>Data Belum Ada</h6></center><br><a href = 'javascript:history.back()'' class='btn btn-secondary btn-sm'><img src='../gambar/kembali.png' width='20px'> Kembali</a>";}
					    } else {}?>
					    
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