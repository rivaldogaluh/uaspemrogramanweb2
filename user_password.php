<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$pwdlama = MD5($_REQUEST['passwordlama']);
		$cek = mysqli_query($koneksi, "SELECT password FROM user WHERE password='$pwdlama'");
		$result = mysqli_num_rows($cek);

		if ($result == 1){

			$password = $_REQUEST['passwordbaru'];
			$repassword = $_REQUEST['repassword'];
			
			if($repassword != $password){
				?>
					<script>
						alert("Inputan password tidak sama");
						window.location.href = './admin.php?hlm=user';
					</script>
				<?php
			}else{
				
				$id_user = $_REQUEST['id_user'];
				$pwd = MD5($password);
				
				$sql = mysqli_query($koneksi, "UPDATE user SET password = '$pwd' WHERE id_user = '$id_user' ");
				
				if ($sql == true){
					?>
						<script>
							alert("Password Telah diperbaharui");
							window.location.href = './admin.php?hlm=user';
						</script>
					<?php
					die();
				}else{
					?>
						<script>
							alert("Password Gagal diperbaharui");
							window.location.href = './admin.php?hlm=user&aksi=password';
						</script>
					<?php
				}
			}
		}
		else{
			?>
				<script>
					alert("Gagal, Pastikan Password Lama yang anda masukan benar!");
					window.location.href = './admin.php?hlm=user';
				</script>
			<?php
		}
	}
}
	
	$id_user = $_REQUEST['id_user'];

	$sql1 = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
	$row = mysqli_fetch_array($sql1);

?>

<h2>Ganti Password User</h2>
<hr>

<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
		<label for="passwordlama" class="col-sm-2 control-label">Password Lama</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="passwordlama" placeholder="Masukan Password Lama">
		</div>
	</div>
	<div class="form-group">
		<label for="passwordbaru" class="col-sm-2 control-label">Password Baru</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="passwordbaru" placeholder="Masukan Password Baru">
		</div>
	</div>
	<div class="form-group">
		<label for="repassword" class="col-sm-2 control-label">Ulangi Password</label>
		<div class="col-sm-4">
			<input type="password" class="form-control" name="repassword" placeholder="Ulangi Password Baru">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=user" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>