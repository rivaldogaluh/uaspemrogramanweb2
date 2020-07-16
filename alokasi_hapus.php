<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

if(isset($_REQUEST['submit'])){

    $idjns = $_REQUEST['id_jenis'];

    $sql = mysqli_query($koneksi, "DELETE FROM jenis_alokasi WHERE id_jenis='$idjns'");
        if($sql == true){
            ?>
                <script>
                    alert("Alokasi Telah dihapus");
                    window.location.href = './admin.php?hlm=alokasi';
                </script>
            <?php
            die();
        }
    }
}
?>
