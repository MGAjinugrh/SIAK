<?php

include('../config/connect.php');
$no_akun=mysql_real_escape_string($_GET['no_akun']);
$status=mysql_real_escape_string($_GET['status']);


if($status == 1){
  $stmt = mysqli_query($connect,"UPDATE siak.akun SET status=2 WHERE no_akun='$no_akun'") or die(mysql_error());
}else if($status == 2){
  $stmt = mysqli_query($connect,"UPDATE siak.akun SET status=1 WHERE no_akun='$no_akun'") or die(mysql_error());
}else{
  //header('location:http://localhost/siak/master_akun.php?message=failed');
  echo mysql_error();
}


if($stmt){
  header('location:http://localhost/siak/master_akun.php?message=success');
}else{
  header('location:http://localhost/siak/master_akun.php?message=failed');
}
?>