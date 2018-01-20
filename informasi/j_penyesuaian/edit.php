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
            <form action="j_penyesuaian/update.php" entcype="multipart/form-data" method="post">
            <input type="text" value="<?php echo $row['no_transaksi'] ?>" hidden="true" name="no_transaksi" id="no_transaksi">
            <div class="form-group">
                <label>Akun</label>
                <select name="no_akun" class="form-control">
                    <?php
                        $query1=mysqli_query($connect,"SELECT * FROM akun WHERE status=1 ORDER BY no_akun ASC") or die(mysql_error());
                        $no=1;
                        while ($row_akun = mysqli_fetch_array($query1)){
                            ?><option value=<?php echo "'".$row_akun['no_akun']."'"; if($row_akun['no_akun'] == $row['no_akun']){ echo "selected"; }?>><?php echo $row_akun['nama_akun'];?></option><?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Opsi</label>
                <select name="opsi" class="form-control">
                <?php
                    if($row['debet'] != 0 && $row['kredit'] == 0){
                        echo '<option value="1" selected>Pemasukan</option>';
                        echo '<option value="0">Pengeluaran</option>';
                    }else{
                        echo '<option value="1" >Pemasukan</option>';
                        echo '<option value="0" selected>Pengeluaran</option>';
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <?php
                    if($row['debet'] != 0 && $row['kredit'] == 0){
                        echo '<input type="text" value="'.$row['debet'].'" name="nominal" class="form-control" placeholder="Masukkan jumlah uang" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
                    }else{
                        echo '<input type="text" value="'.$row['kredit'].'" name="nominal" class="form-control" placeholder="Masukkan jumlah uang" onkeypress="return event.charCode >= 48 && event.charCode <= 57">';
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="">Uraian</label>
                <textarea name="uraian" id="uraian" class="form-control"  maxlength="50" placeholder="Maksimal 50 digit"><?php echo $row['uraian']; ?></textarea>
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