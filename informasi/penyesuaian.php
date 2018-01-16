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
    <link href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php include("../config/connect.php") ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('../elements/navbar.php');?>


        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Informasi : Jurnal Penyesuaian</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Data
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
                                        </div>
                                        <div class="form-group">
                                            <select name="no_akun" class="form-control">
                                                <?php
                                                    $query=mysql_query("SELECT * FROM akun WHERE status=1") or die(mysql_error());
                                                    $no=1;
                                                    while ($row = mysql_fetch_array($query)){
                                                        echo '<option value='.$row['no_akun'].'>'.$row['nama_akun'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Opsi</label>
                                        </div>
                                        <div class="form-group">
                                            <select name="opsi" class="form-control">
                                                <option value="1">Pemasukan</option>
                                                <option value="2">Pengeluaran</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nominal</label>
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="text" name="nominal" class="form-control" placeholder="Masukkan jumlah uang" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            <span class="input-group-addon">,00</span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="keterangan" class="form-control" placeholder="Maksimum 50 karakter."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                            <input type="reset" class="btn btn-default" value="Reset">
                                        </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Uraian</th>
                                                        <th>Ref</th>
                                                        <th>Debet</th>
                                                        <th>Kredit</th>
                                                        <!--th>Menu</th-->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                        
                                                        $query=mysql_query("select * from jurnal") or die(mysql_error());
                                                        $no=1;
                                                        while ($row = mysql_fetch_array($query)) 

                                                        {

                                                            echo  "<tr>";
                                                            echo "<td>".$row['tanggal']."</td>";
                                                            echo "<td>".$row['uraian']."</td>";
                                                            echo "<td>".$row['no_akun']." (".$row['nama_akun'].")</td>";
                                                            
                                                            if($row['debet'] != 0){
                                                                echo "<td>".$row['debet']."</td>";
                                                            }else{
                                                                echo "<td>-</td>";
                                                            }
                                                            if($row['kredit'] != 0){
                                                                echo "<td>".$row['kredit']."</td>";
                                                            }else{
                                                                echo "<td>-</td>";
                                                            }
                                                            /*echo "</td>";
                                                            
                                                            echo "<td align='center'>";
                                                                echo "<a class='btn btn-primary btn-circle' href='jurnal/info.php?no_transaksi=".$row['no_transaksi']."'><i class='fa fa-info' aria-hidden='true'></i></a>&nbsp;";
                                                                echo "<a class='btn btn-warning btn-circle' href='jurnal/edit.php?no_transaksi=".$row['no_transaksi']."' data-toggle='modal' data-target='#EditForm'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;";
                                                                echo "<a class='btn btn-danger btn-circle' href='jurnal/delete.php?no_transaksi=".$row['no_transaksi']."'><i class='fa fa-close' aria-hidden='true'></i></a>";
                                                            echo "</td>";
                                                            
                                                            echo  "</tr>";*/
                                                            

                                                        }
                                                        
                                                        ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <!-- /.table-responsive -->
                                    </div>
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
            <div id="DetailForm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="DetailForm" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    </div>
                </div>
            </div>
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
    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/sb-admin-2.js"></script>

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
    