<!DOCTYPE html>
<html lang="en">
<?php ?>
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
<?php include("config/connect.php"); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('elements/navbar.php');?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Master Akun</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Master Akun</div>
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
                                                    <strong>Gagal!</strong> Terjadi kesalahan.'.mysql_error().'
                                                </div>
                                            </div>
                                            </div>'; 
                                    } else {
                                        echo "";
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <form action="akun/insert.php" method="post">
                                        <div class="form-group">
                                            <label for="">Nomor Akun</label>
                                            <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' type="text" name="no_akun" id="no_akun" required="true" class="form-control" maxlength="2" placeholder="2 digit angka">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Akun</label>
                                            <input type="text" name="nama_akun" id="nama_akun"  required="true" class="form-control"  maxlength="20" placeholder="Maksimal 20 digit">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control"  maxlength="50" placeholder="Maksimal 50 digit"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
                                            <input type="reset" class="btn btn-default" value="Reset">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-9">
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No. Ref</th>
                                                    <th>Nama</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                    <th>Menu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                $query=mysqli_query($connect,"select * from akun") or die(mysql_error());
                                                $no=1;
                                                while ($row = mysqli_fetch_array($query)) 

                                                {

                                                    echo  "<tr>";
                                                    echo "<td>".$row['no_akun']."</td>";
                                                    echo "<td>".$row['nama_akun']."</td>";
                                                    if($row['status'] == 1){
                                                        echo "<td align='center' style='color:#2ecc71;'><i class='fa fa-check' aria-hidden='true'></i> Aktif</td>";
                                                    }else if($row['status'] == 2){
                                                        echo "<td align='center' style='color:#e74c3c;'><i class='fa fa-close' aria-hidden='true'></i>Tidak Aktif</td>";
                                                    }
                                                    echo "<td>".$row['keterangan']."</td>";
                                                    echo "<td align='center'>";
                                                    echo "<a class='btn btn-warning btn-circle' href='akun/editform.php?no_akun=".$row['no_akun']."' data-toggle='modal' data-target='#EditForm'><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;";

                                                    if($row['status'] == 1){
                                                        echo "<a class='btn btn-danger btn-circle' href='akun/status.php?no_akun=".$row['no_akun']."&status=".$row['status']."'><i class='fa fa-close' aria-hidden='true'></i></a>";
                                                    }else if($row['status'] == 2){
                                                        echo "<a class='btn btn-success btn-circle' href='akun/status.php?no_akun=".$row['no_akun']."&status=".$row['status']."'><i class='fa fa-check' aria-hidden='true'></i></a>";
                                                    }

                                                    echo "</td>";
                                                    echo  "</tr>";
                                                    

                                                }
                                                
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                            <!-- /.table-responsive -->
                            </div>
                            </div>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

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

    <!-- JQuery for running AJAX -->
    <!--script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script-->
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript">
    $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
</script>
<!--script type="text/javascript">
    
    
    function addAkun() {
    var no_akun=$("#no_akun").val();
    var nama_akun=$("#nama_akun").val();
    var keterangan=$("#keterangan").val();


    // AJAX code to send data to php file.
        $.ajax({
            type: "POST",
            url: "akun/insert.php",
            data: {no_akun:no_akun,nama_akun:nama_akun,keterangan:keterangan},
            dataType: "JSON",
            success: function(data) {
                /*$("#message").html(data);
            $("p").addClass("alert alert-success");*/
            $('#dataTables-example').load(document.URL + ' #dataTables-example');
            },
            error: function(err) {
            alert(err);
            }
        });

    }

</script-->
</body>

</html>
