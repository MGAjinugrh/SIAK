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

$getakun = mysqli_query($connect,"SELECT * FROM akun WHERE no_akun='$no_akun'");
$no=1;
while ($akun = mysqli_fetch_array($getakun)) 
{
    //echo $row['nama_akun'];
    $stmt = mysqli_query($connect,"INSERT INTO jurnal(no_transaksi,tanggal,no_periode,no_akun,nama_akun,uraian,debet,kredit) VALUES('','".date('Y-m-d H:i:s')."','$no_periode','$no_akun','".$akun['nama_akun']."','$keterangan','$debet','$kredit')") or die(mysql_error());
}


if($stmt){
    
    $get_transaksi = mysqli_query($connect,"SELECT DISTINCT * FROM jurnal ORDER BY no_transaksi DESC LIMIT 1");
    $no=1;
    while ($rowtransaksi = mysqli_fetch_array($get_transaksi)) 
    {
        $get_b_besar = mysqli_query($connect, "SELECT DISTINCT * FROM buku_besar WHERE no_akun='$no_akun' ORDER BY no_index DESC LIMIT 1");
        if(mysqli_num_rows($get_b_besar) >= 1){
            while ($rowbbesar = mysqli_fetch_array($get_b_besar)) 
            {                    
                $total = $rowbbesar['total'];
                if($opsi == 1){
                    $total = $total+$debet;
                }else{
                    $total = $total-$kredit;
                }  
            }
        }else{
            $total = 0;
            if($opsi == 1){
                $total = $total+$debet;
            }else{
                $total = $total-$kredit;
            }  
        }
        $nomor_transaksi = $rowtransaksi['no_transaksi'];
    }

    $b_besar = mysqli_query($connect, "INSERT INTO buku_besar (no_index, tanggal, no_periode, no_transaksi, no_akun, total) VALUES ('','".date('Y-m-d H:i:s')."','$no_periode','".$nomor_transaksi."','$no_akun', '$total')");

    if($b_besar){
        header('location:http://localhost/SIAK/informasi/umum.php?message=success');
    }else{
        echo("Error description: " . mysqli_error($connect));
    }

    //header('location:http://localhost/SIAK/informasi/umum.php?message=success');
}else{
    echo("Error description: " . mysqli_error($connect));
}
?>