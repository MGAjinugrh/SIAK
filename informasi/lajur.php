<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Aplikasi Akuntansi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link href="http://localhost/SIAK/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="http://localhost/SIAK/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="http://localhost/SIAK/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="http://localhost/SIAK/assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://localhost/SIAK/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://localhost/SIAK/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<?php include("../config/connect.php") ?>
<?php
    if(isset($_POST['submit']))    {
        $periode = mysqli_query($connect,"SELECT * FROM periode WHERE no_periode='".mysql_real_escape_string($_POST['periode_select'])."' ORDER BY no_periode DESC LIMIT 1") or die(mysql_error());
    }else{
        $periode = mysqli_query($connect,"SELECT * FROM periode ORDER BY no_periode DESC LIMIT 1") or die(mysql_error());
    }

    while ($periode_row = mysqli_fetch_array($periode)){
?>

<div id="wrapper">
<?php include('../elements/navbar.php'); ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Informasi : Neraca Lajur</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Periode saat ini : <?php echo date('d M Y', strtotime($periode_row['tanggal_mulai']))." hingga ".date('d M Y', strtotime($periode_row['tanggal_selesai'])); ?></h4>
                </div>
            </div>
            <div class="row">
                <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label>Pilih Periode Jurnal</label>
                            <select name="periode_select" class="form-control">
                            <?php
                                echo "<option value=".$periode_row['no_periode'].">".date('d M Y', strtotime($periode_row['tanggal_mulai']))." s/d ".date('d M Y', strtotime($periode_row['tanggal_selesai']))."</option>";
                            ?>/
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Go">
                            <a href="http://localhost/SIAK/informasi/umum.php" class="btn btn-default">Periode Sekarang</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php
                                if($row['status_closing'] == 1){
                                    echo 'Jurnal periode ini sudah closing.';
                                }else{
                                    echo 'Jurnal periode ini belum closing.';
                                }
                            ?>
                        </div>
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <tr>
                                        <th style='text-align:center; width:15%;' rowspan='2'>Akun</th>
                                        <th style='text-align:center;' colspan='2'>Saldo Buku Besar</th>
                                        <th style='text-align:center;' colspan='2'>Penyesuaian</th>
                                        <th style='text-align:center;' colspan='2'>Saldo Setelah Penyesuaian</th>
                                        <th style='text-align:center;' colspan='2'>Rugi Laba</th>
                                        <th style='text-align:center;' colspan='2'>Neraca</th>
                                    </tr>
                                    <tr>
                                        <th style='text-align:center;'>Debet</th>
                                        <th style='text-align:center;'>Kredit</th>
                                        <th style='text-align:center;'>Debet</th>
                                        <th style='text-align:center;'>Kredit</th>
                                        <th style='text-align:center;'>Debet</th>
                                        <th style='text-align:center;'>Kredit</th>
                                        <th style='text-align:center;'>Debet</th>
                                        <th style='text-align:center;'>Kredit</th>
                                        <th style='text-align:center;'>Debet</th>
                                        <th style='text-align:center;'>Kredit</th>
                                    </tr>

                                    <?php

                                        $query = mysqli_query($connect,"SELECT a.no_akun, a.nama_akun, (SELECT c.total FROM buku_besar AS c WHERE c.no_akun = a.no_akun AND c.tanggal = (SELECT MAX(b.tanggal) FROM buku_besar AS b WHERE b.no_akun = a.no_akun)) AS total_saldo, (SELECT c.total FROM buku_penyesuaian AS c WHERE c.no_akun = a.no_akun AND c.tanggal = (SELECT MAX(b.tanggal) FROM buku_penyesuaian AS b WHERE b.no_akun = a.no_akun)) AS total_penyesuaian FROM akun AS a ORDER BY a.no_akun ASC");
                                        if($query){
                                            $no = 0;

                                            $count = mysqli_num_rows($query);
                                            $total_semua = new SplFixedArray($count);
                                            
                                            while($row = mysqli_fetch_array($query)){
                                                $total_semua[$no] = $row['total_saldo'] + $row['total_penyesuaian'];

                                                echo "<tr>";
                                                echo "<td>(".$row['no_akun'].") ".$row['nama_akun']."</td>";
                                                
                                                if($row['total_saldo'] >= 0){
                                                    if($row['total_saldo'] == 0){
                                                        echo "<td></td>";
                                                    }else{
                                                        echo "<td>Rp ".number_format($row['total_saldo'], 0 , "" , "." ).",-</td>";
                                                    }
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td></td>";
                                                    echo "<td>Rp. ".number_format(abs($row['total_saldo']), 0 , "" , "." ).",-</td>";
                                                }


                                                if($row['total_penyesuaian'] >= 0){
                                                    if($row['total_penyesuaian'] == 0){
                                                        echo "<td></td>";
                                                    }else{
                                                        echo "<td>Rp ".number_format($row['total_penyesuaian'], 0 , "" , "." ).",-</td>";
                                                    }
                                                    echo "<td></td>";
                                                }else{
                                                    echo "<td></td>";
                                                    echo "<td>Rp. ".number_format(abs($row['total_penyesuaian']), 0 , "" , "." ).",-</td>";
                                                }
                                                
                                                if($total_semua[$no] >= 0){
                                                    if($total_semua[$no] == 0){
                                                        echo "<td>-</td>";
                                                    }else{
                                                        echo "<td>Rp ".number_format($total_semua[$no], 0 , "" , "." ).",-</td>";
                                                    }
                                                    echo "<td>-</td>";
                                                }else{
                                                    echo "<td>-</td>";
                                                    echo "<td>Rp. ".number_format(abs($total_semua[$no]), 0 , "" , "." ).",-</td>";
                                                }

                                                if($row['no_akun'] == '41' || $row['no_akun'] == '51' || $row['no_akun'] == '52' || $row['no_akun'] == '53' || $row['no_akun'] == '54' || $row['no_akun'] == '55' || $row['no_akun'] == '57'){
                                                    if($total_semua[$no] >= 0){
                                                        if($total_semua[$no] == 0){
                                                            echo "<td></td>";
                                                        }else{
                                                            echo "<td>Rp ".number_format($total_semua[$no], 0 , "" , "." ).",-</td>";
                                                        }
                                                        echo "<td>-</td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                    }else{
                                                        echo "<td>-</td>";
                                                        echo "<td>Rp. ".number_format(abs($total_semua[$no]), 0 , "" , "." ).",-</td>";
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                    }
                                                }else{
                                                    if($total_semua[$no] >= 0){
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        if($total_semua[$no] == 0){
                                                            echo "<td></td>";
                                                        }else{
                                                            echo "<td>Rp ".number_format($total_semua[$no], 0 , "" , "." ).",-</td>";
                                                        }
                                                        echo "<td>-</td>";
                                                    }else{
                                                        echo "<td></td>";
                                                        echo "<td></td>";
                                                        echo "<td>-</td>";
                                                        echo "<td>Rp. ".number_format(abs($total_semua[$no]), 0 , "" , "." ).",-</td>";
                                                    }
                                                }

                                                echo "</tr>";
                                                
                                                $no++;

                                            }
                                        }else{
                                            echo 'MySQL Error: ' . mysql_error();
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<!--javascript -->
    <!-- jQuery -->
    <!-- jQuery -->
    <script src="http://localhost/SIAK/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://localhost/SIAK/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="http://localhost/SIAK/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="http://localhost/SIAK/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="http://localhost/SIAK/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="http://localhost/SIAK/assets/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <!--script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script-->
<!-- end of javascript -->
</body>
</html>