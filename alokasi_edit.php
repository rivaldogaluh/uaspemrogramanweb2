<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$idjns = $_REQUEST['id_jenis'];
		$jenis = $_REQUEST['jenis_alokasi'];
		$harga = $_REQUEST['harga'];

		$sql = mysqli_query($koneksi, "UPDATE jenis_alokasi SET jenis_alokasi='$jenis', harga='$harga' WHERE id_jenis='$idjns'");

		if($sql == true){
			?>
				<script>
					alert("Alokasi Telah diperbaharui");
					window.location.href = './admin.php?hlm=alokasi';
				</script>
			<?php
			die();
		} else {
			?>
				<script>
					alert("Alokasi Gagal diperbaharui!!!");
					window.location.href = './admin.php?hlm=alokasi';
				</script>
			<?php
		}
	} else {

		$idjns = $_REQUEST['id_jenis'];

		$sql = mysqli_query($koneksi, "SELECT * FROM jenis_alokasi WHERE id_jenis='$idjns'");
		while($row = mysqli_fetch_array($sql)){

?>
<h2>Edit Data Master Alokasi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis Kendaraan</label>
		<div class="col-sm-4">
			<input type="hidden" name="id_jenis" value="<?php echo $row['id_jenis']; ?>">
			<input type="text" class="form-control" id="jenis_alokasi" value="<?php echo $row['jenis_alokasi']; ?>" name="jenis_alokasi" placeholder="Jenis Alokasi" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" value="<?php echo $row['harga']; ?>" name="harga" placeholder="Harga" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=alokasi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php

	}
	}
}
?>
