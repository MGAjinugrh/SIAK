<?php

include('../../config/connect.php');
$no_transaksi=mysqli_real_escape_string($_GET['no_transaksi']);

$stmt = mysqli_query("DELETE FROM jurnal WHERE no_transaksi='$no_transaksi'") or die(mysql_error());


if($stmt){
  header('location:http://localhost/siak/informasi/umum.php?message=success');
}else{
  header('location:http://localhost/siak/informasi/umum.php?message=failed');
}
?>