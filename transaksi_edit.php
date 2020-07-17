<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_transaksi = $_REQUEST['id_transaksi'];
		$jenis = $_REQUEST['id_jenis'];
		$harga = $_REQUEST['harga'];
		$jmltrn = $_REQUEST['jumlah_transaksi'];
		$jmldana = $_REQUEST['jumlah_dana'];
		$bayar = $_REQUEST['bayar'];
		$kembali = $_REQUEST['kembali'];
		$nama = $_REQUEST['nama'];
		$nohp = $_REQUEST['no_hp'];
		$email = $_REQUEST['email'];
		$id_user = $_SESSION['id_user'];

		$sql = mysqli_query($koneksi, "UPDATE transaksi SET id_jenis='$jenis', jumlah_transaksi = '$jmltrn', bayar='$bayar', kembali='$kembali', jumlah_dana='$jmldana', nama = '$nama', no_hp = '$nohp', email = '$email', tanggal=NOW(), id_user='$id_user' WHERE id_transaksi='$id_transaksi'");

		if($sql == true){
			?>
			<script>
				alert("Berhasil Memperbaharui Data Transaksi");
				window.location.href = './admin.php?hlm=transaksi';
			</script>
			<?php
			die();
		} else {
			?>
			<script>
				alert("Gagal Memperbaharui Data Transaksi");
				window.location.href = './admin.php?hlm=transaksi';
			</script>
			<?php
		}
	} else {

		$id_transaksi = $_REQUEST['id_transaksi'];

		$sql = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN jenis_alokasi ON transaksi.id_jenis=jenis_alokasi.harga WHERE id_transaksi='$id_transaksi'");
		while($row = mysqli_fetch_array($sql)){

?>

<h2>Edit Data Transaksi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<input type="hidden" name="id_transaksi" value="<?php echo $row['id_transaksi']; ?>">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="no_nota" value="<?php echo $row['no_nota']; ?>" name="no_nota" placeholder="No. Nota" readonly>
		</div>

		<label for="nama" class="col-sm-2 control-label">Nama Donatur</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama"value="<?php echo $row['nama']; ?>" name="nama" required>
		</div>
	</div>
	<div class="form-group">
		<label for="jenis_alokasi" class="col-sm-2 control-label">Jenis Alokasi</label>
		<div class="col-sm-3">
			<select name="id_jenis" class="form-control" id="jenis_alokasi" required>
				<option value="<?php echo $row['jenis_alokasi']; ?>"><?php echo $row['jenis_alokasi']; ?></option>

			<?php
				$q = mysqli_query($koneksi, "SELECT * FROM jenis_alokasi");
				while($data = mysqli_fetch_array($q)){
					echo '<option value="'.$data['harga'].'">'.$data['jenis_alokasi'].'</option>';
				}
			?>

			</select>
		</div>

		<label for="no_hp" class="col-sm-2 control-label">Nomor Handphone</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" placeholder="Nomor Handphone" required>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required readonly>
		</div>

		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Email" required>
		</div>
	</div>

	<div class="form-group">
		<label for="jumlah_transaksi" class="col-sm-2 control-label">Jumlah Transaksi</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" value="<?php echo $row['jumlah_transaksi']; ?>" placeholder="Isi dengan angka" required>
		</div>

		<div class="col-sm-5" style="margin-left: 150px;">
			<button type="submit" name="submit" class="btn btn-success" style="margin-left: 50px;">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger" style="margin-left: 5px;">Batal</a>
		</div>
	</div>

	<div class="form-group">
		<label for="jumlah_dana" class="col-sm-2 control-label">Total Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="jumlah_dana" name="jumlah_dana" value="<?php echo $row['jumlah_dana']; ?>" placeholder="Total Harga" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="bayar" class="col-sm-2 control-label">Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="bayar" name="bayar" value="<?php echo $row['bayar']; ?>" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kembali" class="col-sm-2 control-label">Kembalian</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="kembali" name="kembali" value="<?php echo $row['kembali']; ?>" placeholder="Kembalian" required>
		</div>
	</div>
</form>
<?php
	}
	}
}
?>

<script>

  $(document).ready(function(){

    $("#jenis_alokasi").change(function(){
      var harga = $(this).val();
      $("#harga").val(harga);
    });

     $("#jumlah_transaksi").change(function(){
      var harga = $("#harga").val();
      var jumlah_transaksi = $("#jumlah_transaksi").val();
      $("#jumlah_dana").val(harga * jumlah_transaksi);
    });

    $("#bayar").keyup(function(){
       	var harga = $("#harga").val();
        var bayar = $("#bayar").val();
        var jumlah_dana = $("#jumlah_dana").val();
        $("#kembali").val(bayar - jumlah_dana);
    });

  });
</script>
