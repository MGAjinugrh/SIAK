<?php

include('../config/connect.php');
$no_akun=mysql_real_escape_string($_POST['no_akun']);
$nama_akun=mysql_real_escape_string($_POST['nama_akun']);
$keterangan=mysql_real_escape_string($_POST['keterangan']);

$stmt = mysqli_query($connect,"INSERT INTO SIAK.akun(no_akun,nama_akun,keterangan) VALUES('$no_akun', '$nama_akun', '$keterangan')") or die(mysql_error());

if($stmt){
  header('location:http://localhost/SIAK/master_akun.php?message=success');
}else{
  header('location:http://localhost/SIAK/master_akun.php?message=failed');
}
?>