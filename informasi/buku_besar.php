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
    <link href="http://localhost/siak/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="http://localhost/siak/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="http://localhost/siak/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="http://localhost/siak/assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="http://localhost/siak/assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://localhost/siak/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                                <a href="http://localhost/siak/informasi/buku_besar.php" class="btn btn-default">Periode Sekarang</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Buku Besar</div>
                            <div class="panel-body">
                            <div class='table-responsive'>    
                                <table class='table table-bordered table-striped'>
                                        <tr>
                                            <th rowspan='2' style='text-align:center;'>Tanggal</th>
                                            <th rowspan='2' style='text-align:center;'>Uraian</th>
                                            <th rowspan='2' style='text-align:center;'>Ref</th>
                                            <th rowspan='2' style='text-align:center;'>Debet</th>
                                            <th rowspan='2' style='text-align:center;'>Kredit</th>
                                            <th style='text-align:center;' colspan='2'>Saldo</th>
                                        </tr>
                                        <tr>
                                            <th style='text-align:center;'>Debet</th>
                                            <th style='text-align:center;'>Kredit</th>
                                        </tr>
                                    <?php 
                                    
                                    $query=mysqli_query($connect,"SELECT a.no_index, a.tanggal, a.no_akun, (SELECT nama_akun FROM akun WHERE no_akun=a.no_akun) AS nama_akun, (SELECT uraian FROM jurnal WHERE no_transaksi=a.no_transaksi) AS uraian, (SELECT debet FROM jurnal WHERE no_transaksi=a.no_transaksi) AS debet, (SELECT kredit FROM jurnal WHERE no_transaksi=a.no_transaksi) AS kredit, a.no_periode, a.total FROM buku_besar AS a ORDER BY a.no_akun ASC");
                                    $no=1;

                                    if($query){
                                        while ($row = mysqli_fetch_array($query)){

                                            $current_akun = $row['no_akun'];
                                            
                                            if($current_akun == $row['no_akun']){
                                                
                                                echo "<div class='table-responsive'>    
                                                    <table class='table table-bordered table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th rowspan='2' style='text-align:center;'>Tanggal</th>
                                                                <th rowspan='2' style='text-align:center;'>Uraian</th>
                                                                <th rowspan='2' style='text-align:center;'>Ref</th>
                                                                <th rowspan='2' style='text-align:center;'>Debet</th>
                                                                <th rowspan='2' style='text-align:center;'>Kredit</th>
                                                                <th style='text-align:center;' colspan='2'>Saldo</th>
                                                            </tr>
                                                            <tr>
                                                                <th style='text-align:center;'>Debet</th>
                                                                <th style='text-align:center;'>Kredit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>".date("j F Y",strtotime($row['tanggal']))."</td>
                                                                <td>".$row['uraian']."</td>
                                                                <td>".$row['no_akun']." (".$row['nama_akun'].")</td>
                                                                <td>".$row['debet']."</td>
                                                                <td>".$row['kredit']."</td>
                                                                <td>".$row['total']."</td>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>";
                                            }else{
                                                echo "<tr>
                                                        <td>".date("j F Y",strtotime($row['tanggal']))."</td>
                                                        <td>".$row['uraian']."</td>
                                                        <td>".$row['no_akun']." (".$row['nama_akun'].")</td>
                                                        <td>".$row['debet']."</td>
                                                        <td>".$row['kredit']."</td>
                                                        <td>".$row['total']."</td>
                                                        <td>-</td>
                                                    </tr>";
                                                $current_akun = $row['no_akun'];
                                            }

                                            /*echo "<div class='table-responsive'>    
                                                    <table class='table table-bordered table-striped'>
                                                        <thead>
                                                            <tr>
                                                                <th rowspan='2' style='text-align:center;'>Tanggal</th>
                                                                <th rowspan='2' style='text-align:center;'>Uraian</th>
                                                                <th rowspan='2' style='text-align:center;'>Ref</th>
                                                                <th rowspan='2' style='text-align:center;'>Debet</th>
                                                                <th rowspan='2' style='text-align:center;'>Kredit</th>
                                                                <th style='text-align:center;' colspan='2'>Saldo</th>
                                                            </tr>
                                                            <tr>
                                                                <th style='text-align:center;'>Debet</th>
                                                                <th style='text-align:center;'>Kredit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>";*/
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
    <script src="http://localhost/siak/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://localhost/siak/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="http://localhost/siak/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="http://localhost/siak/assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="http://localhost/siak/assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="http://localhost/siak/assets/dist/js/sb-admin-2.js"></script>

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
