<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $id_transaksi = $_REQUEST['id_transaksi'];

    $sql = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");
        if($sql == true){
            ?>
            <script>
                alert("Berhasil Menghapus Data Transaksi");
                window.location.href = './admin.php?hlm=transaksi';
            </script>
            <?php
        }
    }
}
?>
