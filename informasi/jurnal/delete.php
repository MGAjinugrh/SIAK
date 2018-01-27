<?php

include('../../config/connect.php');
$no_transaksi=mysql_real_escape_string($_GET['no_transaksi']);

$get_transaksi = mysqli_query($connect,"SELECT * FROM transaksi WHERE no_transaksi='$no_transaksi'");

/*NOTE :
  Lagi ngarang logika buat menentukan, kira-kira apa yang akan terjadi sama tabel buku besar
  kalo ada salah satu catatan transaksi yang gua delete dari tabel jurnal.
  Yang jelas, kaitannya ada antara nomor transaksi, nomor akun, dan periode transaksi
  terus apa yang akan terjadi sama nominal di tabel buku besar, gimana kalo seandainya gua hapus
  bukan yang paling akhir, pasti berubahnya banyak kan?? 
*/

while($transaksi = mysqli_fetch_array($get_transaksi)){

  if(){

  }
  $update_b_besar = mysqli_query($connect,"UPDATE buku_besar SET");

  $stmt = mysqli_query($connect,"DELETE FROM jurnal WHERE no_transaksi='$no_transaksi'") or die(mysql_error());

  if($stmt){
    header('location:http://localhost/SIAK/informasi/umum.php?message=success');
  }else{
    echo("Error description: " . mysqli_error($connect));
  }
}
?>