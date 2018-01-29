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

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Informasi : Jurnal Umum</h1>
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
                                <button class="btn btn-success" onclick="javascript:printDiv('printme')">Cetak</button>
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
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                    <?php   
                                        if (isset($_GET['message'])) {
                                            if ($_GET['message'] == 'success')
                                                echo '<div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <strong>Sukes!</strong> Data berhasil diupdate.
                                                    </div>
                                                </div>
                                                </div>';
                                            else if ($_GET['message'] == 'failed')
                                                echo '<div class="row">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-danger">
                                                        <strong>Gagal!</strong> Terjadi kesalahan.
                                                    </div>
                                                </div>
                                                </div>'; 
                                        } else {
                                            echo "";
                                        }
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <form action="jurnal/insert.php" method="post">
                                        <div class="form-group">
                                            <label for="">Akun</label>
                                            <input type="text" name="no_periode" value="<?php echo $periode_row['no_periode']; ?>" hidden>
                                        </div>
                                        <div class="form-group">
                                        <?php if($periode_row['status_closing'] == 0){
                                            echo '<select name="no_akun" class="form-control">';
                                        }else{
                                            echo '<select name="no_akun" class="form-control" disabled>';
                                        }
                                        ?>
                                            
                                        <?php
                                            $query=mysqli_query($connect,"SELECT * FROM akun WHERE status=1") or die(mysql_error());
                                            $no=1;
                                            while ($row = mysqli_fetch_array($query)){
                                                echo '<option value='.$row['no_akun'].'>'.$row['nama_akun'].'</option>';
                                            }
                                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Opsi</label>
                                        </div>
                                        <div class="form-group">
                                        <?php if($periode_row['status_closing'] == 0){
                                            echo '<select name="opsi" class="form-control">';
                                        }else{
                                            echo '<select name="opsi" class="form-control" disabled>';
                                        }
                                        ?>
                                                <option value="1">Pemasukan</option>
                                                <option value="2">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nominal</label>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <?php if($periode_row['status_closing'] == 0){
                                                echo '<input type="text" name="nominal" class="form-control" placeholder="Masukkan jumlah uang" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
                                            }else{
                                                echo '<input type="text" name="nominal" class="form-control" placeholder="Masukkan jumlah uang" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  disabled>';
                                            }
                                            ?>
                                            <span class="input-group-addon">,00</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                        </div>
                                        <div class="form-group">
                                        <?php if($periode_row['status_closing'] == 0){
                                            echo '<textarea name="keterangan" class="form-control" placeholder="Maksimum 50 karakter."></textarea>';
                                        }else{
                                            echo '<textarea name="keterangan" class="form-control" placeholder="Maksimum 50 karakter." disabled></textarea>';
                                        }
                                        ?>
                                        </div>
                                        <div class="form-group">
                                        <?php if($periode_row['status_closing'] == 0){
                                            echo '<input type="submit" class="btn btn-primary" value="Submit">
                                            <input type="reset" class="btn btn-default" value="Reset">';
                                        }else{
                                            echo '<input type="submit" class="btn btn-primary" value="Submit" disabled>
                                            <input type="reset" class="btn btn-default" value="Reset" disabled>';
                                        }
                                        ?>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-8">
                                    <div id="printme">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2" style="text-align:center;">Tanggal</th>
                                                        <th rowspan="2" style="text-align:center;">Uraian</th>
                                                        <th rowspan="2" style="text-align:center;">Ref</th>
                                                        <th colspan="2" style="text-align:center;">Transaksi</th>
                                                        <?php
                                                        if($periode_row['status_closing'] == 0){
                                                            echo '<th rowspan="2" style="text-align:center;">Menu</th>';
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <th>Debet</th>
                                                        <th>Kredit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                        
                                                        $query=mysqli_query($connect,"select * from jurnal");

                                                        if($query){
                                                            $no=1;
                                                            $count_debet = 0;
                                                            $count_kredit = 0;
                                                            while ($row = mysqli_fetch_array($query)) 

                                                            {

                                                                echo  "<tr>";
                                                                echo "<td>".date("j F Y",strtotime($row['tanggal']))."</td>";
                                                                echo "<td>".$row['uraian']."</td>";
                                                                echo "<td>".$row['no_akun']." (".$row['nama_akun'].")</td>";
                                                                
                                                                if($row['debet'] != 0){
                                                                    echo "<td>Rp ".number_format($row['debet'], 0 , "" , "." )."</td>";
                                                                }else{
                                                                    echo "<td>-</td>";
                                                                }
                                                                if($row['kredit'] != 0){
                                                                    echo "<td>Rp ".number_format($row['kredit'], 0 , "" , "." )."</td>";
                                                                }else{
                                                                    echo "<td>-</td>";
                                                                }
                                                                echo "</td>";
                                                                
                                                                if($periode_row['status_closing'] == 0){
                                                                echo "<td align='center'>";
                                                                    echo "<a class='btn btn-warning btn-circle' href='jurnal/edit.php?no_transaksi=".$row['no_transaksi']."' data-toggle='modal' data-target='#EditForm'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;";
                                                                    echo "<a class='btn btn-danger btn-circle' href='jurnal/delete.php?no_transaksi=".$row['no_transaksi']."'><i class='fa fa-close' aria-hidden='true'></i></a>";
                                                                echo "</td>";
                                                                }

                                                                echo  "</tr>";
                                                                
                                                                $count_debet= $count_debet+$row['debet'];
                                                                $count_kredit= $count_kredit+$row['kredit'];
                                                            }

                                                            echo "<tr>
                                                            <td colspan='3'>Total</td>
                                                            <td>Rp ".number_format($count_debet, 0 , "" , "." )."</td>
                                                            <td>Rp ".number_format($count_kredit, 0 , "" , "." )."</td>
                                                            <td></td>
                                                            </tr>";
                                                        }else{
                                                            echo 'MySQL Error: ' . mysql_error();
                                                        }
                                                        
                                                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                    </div>
                                <?php } ?>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
        <!-- /#page-wrapper -->
            <div id="EditForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="EditForm" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->

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

    <!-- Printing -->
    <script src="http://localhost/SIAK/assets/print.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>
