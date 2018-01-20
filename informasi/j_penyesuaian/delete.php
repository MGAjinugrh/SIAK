<?php

include('../../config/connect.php');
$no_transaksi=mysql_real_escape_string($_GET['no_transaksi']);

$stmt = mysqli_query($connect,"DELETE FROM jurnal_penyesuaian WHERE no_transaksi='$no_transaksi'") or die(mysql_error());


if($stmt){
  header('location:http://localhost/siak/informasi/penyesuaian.php?message=success');
}else{
  header('location:http://localhost/siak/informasi/penyesuaian.php?message=failed');
}
?>