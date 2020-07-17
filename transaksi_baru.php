<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_nota = $_REQUEST['no_nota'];
		$jenis = $_REQUEST['id_jenis'];
		$jmltrn = $_REQUEST['jumlah_transaksi'];
		$jmldana = $_REQUEST['jumlah_dana'];
		$bayar = $_REQUEST['bayar'];
		$kembali = $_REQUEST['kembali'];
		$nama = $_REQUEST['nama'];
		$nohp = $_REQUEST['no_hp'];
		$email = $_REQUEST['email'];
		$id_user = $_SESSION['id_user'];

		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, id_jenis, jumlah_transaksi, bayar, kembali, jumlah_dana, nama, no_hp, email, tanggal, id_user) VALUES('$no_nota', '$jenis', '$jmltrn', '$bayar', '$kembali', '$jmldana', '$nama', '$nohp', '$email',  NOW(), '$id_user')");

		if($sql == true){
			?>
			<script>
				alert("Berhasil Menambahkan Transaksi Baru");
				window.location.href = './admin.php?hlm=transaksi';
			</script>
			<?php
			die();
		} else {
			?>
			<script>
				alert("Gagal Menambahkan Transaksi Baru");
				window.location.href = './admin.php?hlm=transaksi';
			</script>
			<?php
		}
	} else {
?>
<h2>Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">

		<?php

			$sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi");
				echo '<input type="text" class="form-control" id="no_nota" value="';

			$no_nota = "C001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_nota;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_nota) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_nota++;
					echo $no_nota;
				}
			}
				echo '"name="no_nota" placeholder="No. Nota" readonly>';

		?>
		</div>

		<label for="nama" class="col-sm-2 control-label">Nama Donatur</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
		</div>
	
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Jenis Alokasi</label>
		<div class="col-sm-3">
			<select name="id_jenis" class="form-control" id="jenis_alokasi" required>
				<option value="" disable>--- Pilih Jenis Alokasi Bantuan ---</option>
			<?php
				$q = mysqli_query($koneksi, "SELECT * FROM jenis_alokasi");
				while($data = mysqli_fetch_array($q)){
					echo '<option value="'.$data['harga'].'">'.$data['jenis_alokasi'].'</option>';
				}
			?>
			</select>
		</div>

		<label for="nama" class="col-sm-2 control-label">Nomor Handphone</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Handphone" required>
		</div>
	</div>
	<div class="form-group">
		<label for="harga" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="harga" name="harga" value="" required readonly>
		</div>

		<label for="nama" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
		</div>
	</div>
	<div class="form-group">
		<label for="jumlah_transaksi" class="col-sm-2 control-label">Jumlah Transaksi</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" placeholder="Isi dengan angka" value="" required>
		</div>

		
		<div class="col-sm-5" style="margin-left: 150px;">
			<button type="submit" name="submit" class="btn btn-success" style="margin-left: 50px;">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger" style="margin-left: 5px;">Batal</a>
		</div>
	
	</div>
	<div class="form-group">
		<label for="jumlah_dana" class="col-sm-2 control-label">Total Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="jumlah_dana" name="jumlah_dana" placeholder="Total Harga" required readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="bayar" class="col-sm-2 control-label">Bayar</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="bayar" name="bayar" placeholder="Isi dengan angka" required>
		</div>
	</div>
	<div class="form-group">
		<label for="kembali" class="col-sm-2 control-label">Kembalian</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="kembali" name="kembali" placeholder="Kembalian" required readonly>
		</div>
	</div>
	
	
	
</form>
<?php
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
