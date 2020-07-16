<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){
				
		$id_user = $_REQUEST['id_user'];
		$username = $_REQUEST['username'];
		$nama = $_REQUEST['nama'];
		$alamat = $_REQUEST['alamat'];
		$nohp = $_REQUEST['hp'];
		$level = $_REQUEST['level'];
		
		$sql = mysqli_query($koneksi, "UPDATE user SET username = '$username', nama = '$nama', alamat = '$alamat', hp = '$nohp', level = $level WHERE id_user = '$id_user' ");
		
		if ($sql == true){
			?>
				<script>
					alert("Data User Telah diperbaharui");
					window.location.href = './admin.php?hlm=user';
				</script>
			<?php
			die();
		}else{
			?>
				<script>
					alert("Data User Gagal diperbaharui");
					window.location.href = './admin.php?hlm=user&aksi=edit';
				</script>
			<?php
		}
	}
}
	
	$id_user = $_REQUEST['id_user'];

	$sql1 = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
	$row = mysqli_fetch_array($sql1);

?>

<h2>Edit Data User</h2>
<hr>

<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
        <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
		<label for="username" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="username" value="<?php echo $row['username']; ?>" name="username" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama User</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" value="<?php echo $row['nama']; ?>" name="nama" placeholder="Nama User">
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Alamat</label>
		<div class="col-sm-4">
			<textarea name="alamat" class="form-control" placeholder="Masukan Alamat"><?php echo $row['alamat']; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nomor Handphone</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" value="<?php echo $row['hp']; ?>" name="hp" placeholder="Nomor Handphone">
		</div>
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Hak Akses</label>
		<div class="col-sm-3">
			<select name="level" class="form-control" required>
				<option value="<?php echo $row['level']?>">
				<?php
					$level = $row['level'];
					if($level == 1){
						echo 'Admin';
					} else {
						echo 'User Biasa';
					}
				?>
				</option>
				<option value="2">User Biasa</option>
				<option value="1">Admin</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=user" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
