<?php

$host="localhost";
$user="root";
$pass="";
$dbname="siak";

$connect= new mysqli($host,$user,$pass,$dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$dbselect=mysqli_select_db($connect,$dbname);

$periode = mysqli_query($connect,"SELECT * FROM periode WHERE status_closing=0") or die(mysql_error());

while ($row = mysqli_fetch_array($periode)){
    $current_date = date('YYYY-MM-DD');
    $last_date = date('YYYY-MM-DD',strtotime($row['tanggal_selesai']));
    //echo date('Y-m-d', strtotime('+1 years'));
    if($current_date >= $last_date){
        $new_periode = "UPDATE periode SET status_closing=1 WHERE tanggal_selesai = '".date('Y-m-d')."';
                        INSERT INTO periode (no_periode, tanggal_mulai, tanggal_selesai, status_closing) VALUES ('','".date('Y-m-d')."','".date('Y-m-d', strtotime('+1 years'))."','0');";
        
        if(!mysqli_multi_query($connect,$new_periode)){
            echo "DB Error, could not query the database\n";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
    }
}

?>