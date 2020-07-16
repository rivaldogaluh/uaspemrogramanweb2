<?php
    if( empty( $_SESSION['id_user'] ) ){

    	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    	header('Location: ./');
    	die();
    } else {
?>

<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body onload="window.print()">
    <div class="container">

<?php

    $id_transaksi = $_REQUEST['id_transaksi'];

    $sql = mysqli_query($koneksi, "SELECT no_nota, nama, jenis_alokasi, harga, jumlah_transaksi, jumlah_dana, bayar, kembali, tanggal, id_user FROM transaksi INNER JOIN jenis_alokasi ON transaksi.id_jenis = jenis_alokasi.harga WHERE id_transaksi='$id_transaksi'");

    list($no_nota, $nama, $jenis_alokasi, $harga, $jumlah_transaksi, $jumlah_dana, $bayar, $kembalian, $tanggal, $id_user) = mysqli_fetch_array($sql);

    echo '
        <center><h3>Penerimaan Bantuan Sosial Covid-19</h3></center>
        <hr/>
        <h4>Nota Nomor : <b>'.$no_nota.'</b></h4>
        <h4>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <b>'.date("d M Y", strtotime($tanggal)).'</b></h4>
        <table class="table table-bordered">
            <thead style="background-color:#4682B4; color:white;">
                <tr>
                    <th width="15%">Donatur</th>
                    <th width="14%">Alokasi</th>
                    <th width="13%">Harga</th>
                    <th width="7%">Transaksi</th>
                    <th width="15%">Jumlah Dana</th>
                    <th width="8%">Pembayaran</th>
                    <th width="8%">Kembalian</th>
                </tr>
            </thead>
        <tbody>

        <tr>
            <td>'.$nama.'</td>
            <td>'.$jenis_alokasi.'</td>
            <td>RP. '.number_format($harga).'</td>
            <td>'.$jumlah_transaksi.'</td>
            <td>RP. '.number_format($jumlah_dana).'</td>
            <td>RP. '.number_format($bayar).'</td>
            <td>RP. '.number_format($kembalian).'</td>
        <tr/>

        </tbody>
    </table>

    <div style="margin: 0 0 50px 70%;">
        <p style="margin-bottom: 60px; margin-left:40px;">Petugas Kasir</p>
        <p>';

        $sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
        list($nama) = mysqli_fetch_array($sql);

        echo "<b><u>$nama</u></b>";

        echo '</p>
    </div>

    <center>-------------------- Terima Kasih ------------------- </center>

    </div>
</body>
</html>';
}
?>
