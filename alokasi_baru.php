<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$jenis = $_REQUEST['jenis_alokasi'];
		$harga = $_REQUEST['harga'];

		$sql = mysqli_query($koneksi, "INSERT INTO jenis_alokasi(jenis_alokasi, harga) VALUES('$jenis', '$harga')");

		if($sql == true){
			?>
				<script>
					alert("Berhasil Menambahkan Data Alokasi");
					window.location.href = './admin.php?hlm=alokasi';
				</script>
			<?php
			die();
		} else {
			?>
				<script>
					alert("Gagal Menambahkan Data Alokasi");
					window.location.href = './admin.php?hlm=alokasi';
				</script>
			<?php
		}
	} else {
?>
<h2>Tambah Data Master Alokasi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis_alokasi" class="col-sm-2 control-label">Jenis Alokasi</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="jenis_alokasi" name="jenis_alokasi" placeholder="Jenis Alokasi" required>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" required>
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
?>
