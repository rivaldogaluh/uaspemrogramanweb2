<?php

if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if( isset( $_REQUEST['aksi'] )){
		$aksi = $_REQUEST['aksi'];
		switch($aksi){
			case 'baru':
				include 'transaksi_baru.php';
				break;
			case 'edit':
				include 'transaksi_edit.php';
				break;
			case 'hapus':
				include 'transaksi_hapus.php';
				break;
			case 'cetak':
				include 'cetak_nota.php';
				break;
		}
	} else {

		echo '

			<div class="container">
				<h3 style="margin-bottom: -20px;">Daftar Transaksi</h3>
					<a href="./admin.php?hlm=transaksi&aksi=baru" class="btn btn-success btn-s pull-right">Tambah Data</a>
				<br/><hr/>

				<table class="table table-bordered table-striped">
				 <thead style="background-color:#4682B4; color:white;">
				   <tr>
					<th width="3%">No</th>
					<th width="7%">No. Nota</th>
					<th width="17%">Alokasi</th>
					<th width="10%">Harga</th>
					<th width="8%">Transaksi</th>
					<th width="10%">Jml Dana</th>
					<th width="15%">Nama Donatur</th>
					<th width="8%">Tanggal</th>
					<th width="23%">Tindakan</th>
				   </tr>
				 </thead>
				 <tbody>';

			//skrip untuk menampilkan data dari database
		 	$sql = mysqli_query($koneksi, "SELECT * FROM transaksi INNER JOIN jenis_alokasi ON transaksi.id_jenis=jenis_alokasi.harga ORDER BY no_nota ASC");
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr>
					 <td>'.$no.'</td>
					 <td>'.$row['no_nota'].'</td>
					 <td>'.$row['jenis_alokasi'].'</td>
					 <td>RP. '.number_format($row['harga']).'</td>
					 <td>'.$row['jumlah_transaksi'].'</td>
					 <td>RP. '.number_format($row['jumlah_dana']).'</td>
					 <td>'.$row['nama'].'</td>
					 <td>'.date("d M Y", strtotime($row['tanggal'])).'</td>
					 <td>

					<script type="text/javascript" language="JavaScript">
					  	function konfirmasi(){
						  	tanya = confirm("Anda yakin akan menghapus data ini?");
						  	if (tanya == true) return true;
						  	else return false;
						}
					</script>

					<a href="?hlm=cetak&id_transaksi='.$row['id_transaksi'].'" class="btn btn-info btn-s second" target="_blank">Cetak Nota</a>';
					if( $_SESSION['level'] == 1 ){
					echo'<a href="?hlm=transaksi&aksi=edit&id_transaksi='.$row['id_transaksi'].'" class="btn btn-warning btn-s">Edit</a>

					<a href="?hlm=transaksi&aksi=hapus&submit=yes&id_transaksi='.$row['id_transaksi'].'" class="btn btn-danger btn-s tombol-hapus">Hapus</a>';
					}
					echo'</td>';
				}
			} else {
				 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=transaksi&aksi=baru">Tambah data baru</a></u> </p></center></td></tr>';
			}
			echo '
			 	</tbody>
			</table>
		</div>';
	}
}
?>
