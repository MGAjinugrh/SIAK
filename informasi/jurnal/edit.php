<?php

include('../../config/connect.php');

$no_transaksi = mysql_real_escape_string($_GET['no_transaksi']);

$query=mysqli_query($connect,"select * from jurnal WHERE no_transaksi='$no_transaksi'") or die(mysql_error());
$no=1;
while ($row = mysqli_fetch_array($query)){ ?>

<div class="col-lg-12">
	<div class="panel panel-warning">
		<div class="panel-heading">
			Edit Transaksi : <?php echo $row['nama_akun']; ?> Tanggal <?php echo date("l, d M Y", strtotime($row['tanggal'])) ?>
		</div>
        <div class="panel-body">
            <form action="jurnal/edit.php" method="post">
            <input type="text" value="<?php echo $row['no_transaksi'] ?>" hidden="true" name="no_transaksi" id="no_transaksi">
            <div class="form-group">
                <label>Akun</label>
                <select name="no_akun" class="form-control">
                    <?php
                        $query1=mysqli_query("SELECT * FROM akun WHERE status=1") or die(mysql_error());
                        $no=1;
                        while ($row = mysqli_fetch_array($query1)){
                            echo '<option value='.$row['no_akun'].'>'.$row['nama_akun'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Opsi</label>
                <select name="opsi" class="form-control">
                <?php
                    if($row['debet'] !== '0.0' && $row['kredit'] === '0.0'){
                        echo '<option value="1" selected="true">Pemasukan</option>';
                        echo '<option value="0">Pengeluaran</option>';
                    }else{
                        echo '<option value="1" selected="true">Pemasukan</option>';
                        echo '<option value="0" selected>Pengeluaran</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control"  maxlength="50" placeholder="Maksimal 50 digit"><?php echo $row['keterangan'] ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                <a href="http://localhost/siak/informasi/umum.php" class="btn btn-success">Back</a>
            </div>
            </form>
        </div>

<?php } ?>
	</div>
</div>