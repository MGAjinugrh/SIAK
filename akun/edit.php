<?php

include('../config/connect.php');
$no_akun=mysql_real_escape_string($_POST['no_akun']);
$nama_akun=mysql_real_escape_string($_POST['nama_akun']);
$keterangan=mysql_real_escape_string($_POST['keterangan']);
echo $no_akun;
echo $nama_akun;
echo $keterangan;
$stmt = mysqli_query($connect,"UPDATE siak.akun SET nama_akun='$nama_akun', keterangan='$keterangan' WHERE no_akun='$no_akun'") or die(mysql_error());

if($stmt){
  header('location:http://localhost/siak/master_akun.php?message=success');
}else{
  header('location:http://localhost/siak/master_akun.php?message=failed');
}
?>