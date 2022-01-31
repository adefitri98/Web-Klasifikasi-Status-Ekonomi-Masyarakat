<?php
	//Memanggil database
	include '../koneksi.php';
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
		    			<p align="center" style="font-size: 18px;"><b>Klasifikasi Status Ekonomi Masyarakat Kelurahan Sungai Andai</b></p>
		    			<br>
		    			<form action="" method="post">
		    				<div class="form-group row" style="font-size: 15px;">
							    <label for="colFormLabel" class="col-sm-2 col-form-label">Tahun Periode</label>
							    <div class="col-sm-8">
							    	<SELECT name="periode" class="form-control">
										<option value=”> </option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
									</SELECT>
							    </div>
							    <div class="col-sm-2">
							    	<input type="submit" class="btn btn-info btn-sm" value="Cari Data" name="search"/>
							    </div>
							</div>
		    			</form>
		    			<br>
		    			<!-- menampilkan hasil pencarian -->
					    <?php
					    if(isset($_POST['search'])){
					        $periode = $_POST['periode'];
							$query = mysqli_query($kon, "SELECT  * FROM tb_penduduk as a, tb_klasifikasi as b WHERE b.periode='$periode' AND a.kk=b.kk order by a.nama asc");
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
											<th scope="col" width="20%">Aksi</th>
										</tr>
									</thead>
									<tbody align="center">
										<?php
										$no=1;
										while($semua_data = mysqli_fetch_array($query))
										{
											echo "<tr>";
											echo "<td scope='row'>" .$no++."</td>";
											echo "<td scope='row'>" .$semua_data['nama']."</td>";
											echo "<td scope='row'>" .$semua_data['alamat']."</td>";
											echo "<td scope='row'>" .$semua_data['status']."</td>";
											echo "<td scope='row'>" .$semua_data['periode']."</td>";
											echo "<td scope='row'>";	
											echo "<a href='detail_penduduk.php?id=".$semua_data['id_klasifikasi']."' class='btn btn-info btn-sm'><img src='../gambar/see.png' width='20px'></a> | ";
											echo "<a href='edit.php?id=".$semua_data['id_klasifikasi']."' class='btn btn-info btn-sm'><img src='../gambar/edit.png' width='20px'></a> | ";
											echo "<a href=\"hapus.php?id=".$semua_data['id_klasifikasi']."\"
												onClick =\"return confirm('Hapus Data');\"
												 class='btn btn-danger btn-sm'><img src='../gambar/delete.png' width='20px'></a>";
											echo "</td>";
										}
										?>
									</tbody>
								</table>
							</div>
							<?php
					        }else{
					            echo "<br><center><h5>Data Belum Ada</h5></center>";
					        }
					    } else {?>
						<div class="table-responsive">
							<table class="table table-sm table-bordered" id="example" width="100%">
								<thead align="center">
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama</th>
										<th scope="col">Alamat</th>
										<th scope="col">Status</th>
										<th scope="col">Periode</th>
										<th scope="col" width="20%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$query2 = mysqli_query($kon, "SELECT  * FROM tb_penduduk as a, tb_klasifikasi as b WHERE  a.kk=b.kk order by a.nama asc");
									$no=1;
									while($semua_data = mysqli_fetch_array($query2))
									{

										echo "<tr>";
										echo "<td scope='row' align='center'>" .$no++."</td>";
										echo "<td scope='row'>" .$semua_data['nama']."</td>";
										echo "<td scope='row'>" .$semua_data['alamat']."</td>";
										echo "<td scope='row' align='center'>" .$semua_data['status']."</td>";
										echo "<td scope='row' align='center'>" .$semua_data['periode']."</td>";
										echo "<td scope='row' align='center'>";	
										echo "<a href='detail_penduduk.php?id=".$semua_data['id_klasifikasi']."' class='btn btn-info btn-sm'><img src='../gambar/see.png' width='20px'></a> | ";
										echo "<a href='edit.php?id=".$semua_data['id_klasifikasi']."' class='btn btn-info btn-sm'><img src='../gambar/edit.png' width='20px'></a> | ";
										echo "<a href=\"hapus.php?id=".$semua_data['id_klasifikasi']."\"
												onClick =\"return confirm('Hapus Data');\"
												 class='btn btn-danger btn-sm'><img src='../gambar/delete.png' width='20px'></a>";
										echo "</td>";
									}

									?>
								</tbody>
							</table>
						</div>
		    			<?php } ?>
					</div>
				</div>

				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

				<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
				<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
				<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

				<script type="text/javascript">
						$(document).ready(function(){
							$('#example').DataTable({
								"ordering": false,
									"autoWidth": true,
								});
							});
					</script>

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