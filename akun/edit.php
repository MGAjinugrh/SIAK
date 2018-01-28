<?php

include('../config/connect.php');
$no_akun=mysql_real_escape_string($_POST['no_akun']);
$nama_akun=mysql_real_escape_string($_POST['nama_akun']);
$keterangan=mysql_real_escape_string($_POST['keterangan']);
echo $no_akun;
echo $nama_akun;
echo $keterangan;
$stmt = mysqli_query($connect,"UPDATE akun SET nama_akun='$nama_akun', keterangan='$keterangan' WHERE no_akun='$no_akun'");

if($stmt){
  header('location:http://localhost/SIAK/master_akun.php?message=success');
}else{
  echo("Error description: " . mysqli_error($connect));
}
?>