<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Akuntansi</title>

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

        <!-- Navigation -->
        <?php include('../elements/navbar.php');?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Informasi : Buku Besar</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Periode saat ini : <?php echo date('d M Y', strtotime($periode_row['tanggal_mulai']))." hingga ".date('d M Y', strtotime($periode_row['tanggal_selesai'])); ?></h4>
                    </div>
                </div>
                <div class="row">
                    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label>Pilih Periode Buku Besar</label>
                                <select name="periode_select" class="form-control">
                                <?php
                                    echo "<option value=".$periode_row['no_periode'].">".date('d M Y', strtotime($periode_row['tanggal_mulai']))." s/d ".date('d M Y', strtotime($periode_row['tanggal_selesai']))."</option>";
                                ?>/
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Go">
                                <a href="http://localhost/SIAK/informasi/buku_besar.php" class="btn btn-default">Periode Sekarang</a>
                            </div>
                        </div>
                    </form>
                </div>
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
                            <div class='table-responsive'>    
                            <table class='table table-bordered table-striped'>
                                <tr>
                                    <th style='text-align:center;'>Tanggal Transaksi Terakhir</th>
                                    <th style='text-align:center;'>Akun</th>
                                    <th style='text-align:center;'>Total Saldo</th>
                                </tr>
                                    <?php 
                                    
                                    $query=mysqli_query($connect,"SELECT a.tanggal, a.no_akun, (SELECT nama_akun FROM akun WHERE no_akun=a.no_akun) AS nama_akun, a.total FROM buku_besar AS a WHERE a.tanggal=(SELECT MAX(b.tanggal) FROM buku_besar AS b WHERE a.no_akun = b.no_akun) ORDER by a.no_akun ASC");
                                    $no=1;

                                    $current_akun = $row['no_akun'];
                                    if($query){
                                        while ($row = mysqli_fetch_array($query)){
                                            echo "<tr>";
                                            echo "<td>".date("j F Y H:i",strtotime($row['tanggal']))."</td>";
                                            echo "<td>".$row['no_akun']." (".$row['nama_akun'].")</td>";
                                            if($row['total'] < 0){
                                                echo "<td>Rp. (".number_format(abs($row['total']), 0 , "" , "." )."),-</td>";
                                            }else{
                                                echo "<td>Rp. ".number_format($row['total'], 0 , "" , "." ).",-</td>";
                                            }
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo("Error description: " . mysqli_error($connect));
                                    }
                                    ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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

</body>

</html>
