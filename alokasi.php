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
				include 'alokasi_baru.php';
				break;
			case 'edit':
				include 'alokasi_edit.php';
				break;
			case 'hapus':
				include 'alokasi_hapus.php';
				break;
		}
	} else {

		echo '

			<div class="container">
			<div class="col-md-8">
				<h3 style="margin-bottom: -20px;">Data Master Alokasi</h3>
					<a href="./admin.php?hlm=alokasi&aksi=baru" class="btn btn-success btn-s pull-right">Tambah Data</a>
				<br/><hr/>

				<table class="table table-striped table-bordered">
					<thead style="background-color:#4682B4; color:white;">
				  	<tr>
						<th width="5%">No</th>
						<th width="35%">Jenis Alokasi</th>
					 	<th width="35%">Harga</th>
					 	<th width="20%">Tindakan</th>
				   	</tr>
				 </thead>
				 <tbody>';

			//skrip untuk menampilkan data dari database
		 	$sql = mysqli_query($koneksi, "SELECT * FROM jenis_alokasi");
		 	if(mysqli_num_rows($sql) > 0){
		 		$no = 0;

				 while($row = mysqli_fetch_array($sql)){
	 				$no++;
	 			echo '

				   <tr>
					 <td>'.$no.'</td>
					 <td>'.$row['jenis_alokasi'].'</td>
					 <td>RP. '.number_format($row['harga']).'</td>
					 <td>

					<script type="text/javascript" language="JavaScript">
					  	function konfirmasi(){
						  	tanya = confirm("Anda yakin akan menghapus user ini?");
						  	if (tanya == true) return true;
						  	else return false;
						}
					</script>

					 <a href="?hlm=alokasi&aksi=edit&id_jenis='.$row['id_jenis'].'" class="btn btn-warning btn-s">Edit</a>
					 <a href="?hlm=alokasi&aksi=hapus&submit=yes&id_jenis='.$row['id_jenis'].'" class="btn btn-danger btn-s tombol-hapus">Hapus</a>

					 </td>';
				}
			} else {
				 echo '<td colspan="8"><center><p class="add">Tidak ada data untuk ditampilkan. <u><a href="?hlm=alokasi&aksi=baru">Tambah data baru</a></u> </p></center></td></tr>';
			}
			echo '
			 	</tbody>
			</table>
			</div>
		</div>';
	}
}
?>
