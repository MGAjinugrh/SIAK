<?php

include('../config/connect.php');

$no_akun = mysql_real_escape_string($_GET['no_akun']);

$query=mysqli_query($connect,"select * from akun WHERE no_akun='$no_akun'") or die(mysql_error());
$no=1;
while ($row = mysqli_fetch_array($query)){ ?>

<div class="col-lg-12">
	<div class="panel panel-warning">
		<div class="panel-heading">
			Edit Akun : <?php echo $row['nama_akun']; ?>
		</div>
        <div class="panel-body">
            <form action="akun/edit.php" method="post">
            <input type="text" value="<?php echo $row['no_akun'] ?>" hidden="true" name="no_akun" id="no_akun" maxlength="2" placeholder="2 digit angka">
            <div class="form-group">
                <label for="">Nama Akun</label>
                <input type="text" value="<?php echo $row['nama_akun'] ?>" name="nama_akun" id="nama_akun"  required="true" class="form-control"  maxlength="20" placeholder="Maksimal 20 digit">
            </div>
            <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control"  maxlength="50" placeholder="Maksimal 50 digit"><?php echo $row['keterangan'] ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
                <a href="http://localhost/siak/master_akun.php" class="btn btn-success">Back</a>
            </div>
            </form>
        </div>

<?php } ?>
	</div>
</div>