<?php
 //Mendefinisikan Konstanta
 define('HOST','localhost');
 define('USER','root');
 define('PASS','');
 define('DB','db_knn3');
 
 //membuat koneksi dengan database
 $kon = mysqli_connect(HOST,USER,PASS,DB) or die('Koneksi Gagal, Cek Setting Koneksi');
 ?>