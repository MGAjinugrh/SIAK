<?php

include('../../config/connect.php');
$no_akun=mysql_real_escape_string($_POST['no_akun']);
$opsi=mysql_real_escape_string($_POST['opsi']);
$nominal=mysql_real_escape_string($_POST['nominal']);
$keterangan=mysql_real_escape_string($_POST['keterangan']);
$no_periode = mysql_real_escape_string($_POST['no_periode']);

$debet = 0;
$kredit = 0;
if($opsi == 1){
    $debet = $nominal;
}else{
    $kredit = $nominal;
}

$getakun = mysqli_query($connect,"SELECT * FROM akun WHERE no_akun='$no_akun'") or die(mysql_error());
$no=1;
while ($akun = mysqli_fetch_array($getakun)) 
{
    //echo $row['nama_akun'];
    $stmt = mysqli_query($connect,"INSERT INTO siak.jurnal_penyesuaian(no_transaksi,tanggal,no_periode,no_akun,nama_akun,uraian,debet,kredit) VALUES('','".date('Y-m-d H:i:s')."','$no_periode','$no_akun','".$akun['nama_akun']."','$keterangan','$debet','$kredit')") or die(mysql_error());
}


if($stmt){
  header('location:http://localhost/siak/informasi/penyesuaian.php?message=success');
}else{
  header('location:http://localhost/siak/informasi/penyesuaian.php?message=failed');
}
?>