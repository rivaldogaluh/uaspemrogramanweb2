<?php
session_start();
if( empty( $_SESSION['id_user'] ) ){
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	include "koneksi.php";
	include "fungsi_flash.php";
	 flash('example_message');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi PBS Covid-19</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/jquery-ui.min.css" rel="stylesheet">

	<link rel="stylesheet" href="dist/sweetalert2.min.css">
	<link rel="icon" type="image/png" href="img/listicon.png">

    <script src="js/jquery.min.js"></script>


	<style type="text/css">
	body {
	  min-height: 200px;
	  padding-top: 70px;
	}
   @media print {
	   .container {
		   margin-top: -30px;
	   }
	   #tombol,
      .noprint {
         display: none;
      }
   }
	.pesan{
	    display: none;
	    position: fixed;
	    border: 1px solid blue;
	    width: 200px;
	    top: 10px;
	    left: 200px;
	    padding: 5px 10px;
	    background-color: lightskyblue;
	    text-align: center;
	}
	</style>

  </head>

  <body>

    <?php include "menu.php"; ?>

    <div class="container">

	<?php
	if( isset($_REQUEST['hlm'] )){

		$hlm = $_REQUEST['hlm'];

		switch( $hlm ){
			case 'transaksi':
				include "transaksi.php";
				break;
			case 'laporan':
				include "laporan.php";
				break;
			case 'user':
				include "user.php";
				break;
			case 'alokasi':
				include "alokasi.php";
				break;
			case 'cetak':
				include "cetak_nota.php";
				break;
		}
	} else {
	?>
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Selamat Datang di Aplikasi Penerimaan Bantuan Sosial Covid-19</h2>

        <p>Halo <strong><?php echo $_SESSION['nama']; ?></strong>, Anda login sebagai
			<strong>
			<?php
				if($_SESSION['level'] == 1){
					echo 'Admin.';
				} else {
					echo 'Petugas Kasir.';
				}
			?>
			</strong>
		</p>

      </div>
	<?php
	}
	?>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript, Placed at the end of the document so the pages load faster -->
    <script src="dist/sweetalert2.all.min.js"></script>
	<script src="dist/myscript.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	 <script>
	//angka 500 dibawah ini artinya pesan akan muncul dalam 0,5 detik setelah document ready
    $(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	//angka 3000 dibawah ini artinya pesan akan hilang dalam 3 detik setelah muncul
    setTimeout(function(){$(".pesan").fadeOut('slow');}, 3000);
        </script>
  </body>

</html>
<?php
}
?>
