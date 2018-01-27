<?php

include('../../config/connect.php');
$no_transaksi=mysql_real_escape_string($_POST['no_transaksi']);
$no_akun=mysql_real_escape_string($_POST['no_akun']);
$opsi=mysql_real_escape_string($_POST['opsi']);
$nominal=mysql_real_escape_string($_POST['nominal']);
$uraian=mysql_real_escape_string($_POST['uraian']);

$getakun = mysqli_query($connect,"SELECT * FROM akun WHERE no_akun='$no_akun'") or die(mysql_error());
$no=1;
while ($akun = mysqli_fetch_array($getakun)) 
{

    if($opsi == 1){
        $stmt = mysqli_query($connect,"UPDATE jurnal SET no_akun='".$akun['no_akun']."', nama_akun='".$akun['nama_akun']."', debet='$nominal', kredit=0, uraian='$uraian' WHERE no_transaksi='$no_transaksi' ");
    }else{
        $stmt = mysqli_query($connect,"UPDATE jurnal SET no_akun='".$akun['no_akun']."', nama_akun='".$akun['nama_akun']."', debet=0, kredit='$nominal', uraian='$uraian' WHERE no_transaksi='$no_transaksi' ");
    }
}

if($stmt){
    if($opsi == 1){
        $stmt = mysqli_query($connect,"UPDATE jurnal SET no_akun='".$akun['no_akun']."', nama_akun='".$akun['nama_akun']."', debet='$nominal', kredit=0, uraian='$uraian' WHERE no_transaksi='$no_transaksi' ");
    }else{
        $stmt = mysqli_query($connect,"UPDATE jurnal SET no_akun='".$akun['no_akun']."', nama_akun='".$akun['nama_akun']."', debet=0, kredit='$nominal', uraian='$uraian' WHERE no_transaksi='$no_transaksi' ");
    }

    //header('location:http://localhost/SIAK/informasi/umum.php?message=success');
}else{
    echo("Error description: " . mysqli_error($connect));
}
?>