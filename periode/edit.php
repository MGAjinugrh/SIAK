<?php

include('../config/connect.php');

if(isset($_POST['submit'])){
    $no_periode = mysql_real_escape_string($_POST['no_periode']);
    $tanggal_mulai = mysql_real_escape_string(date('Y-m-d',strtotime(($_POST['tanggal_mulai']))));
    $tanggal_selesai = mysql_real_escape_string(date('Y-m-d',strtotime(($_POST['tanggal_selesai']))));
    $status_closing = mysql_real_escape_string($_POST['status_closing']);

    $stmt = mysqli_query($connect,"UPDATE periode SET tanggal_selesai='$tanggal_selesai' WHERE no_periode='$no_periode' AND tanggal_mulai='$tanggal_mulai' AND status_closing='$status_closing'") or die(mysql_error());

    if($stmt){
    header('location:http://localhost/siak/periode/formedit.php?message=success');
    }else{
    header('location:http://localhost/siak/periode/formedit.php?message=failed');
    }

}
