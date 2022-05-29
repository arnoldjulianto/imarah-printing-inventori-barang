<?php
include("../../koneksibarang.php");
$jumlah = "";
$tamp =$_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];
    $sql = "SELECT *
    FROM gudang
    where kode_barang = '$kode_bar'";
    $result = mysqli_query($koneksi, $sql); 
    // output data of each row
    while($data = mysqli_fetch_assoc($result)) {
      $jumlah = $data['jumlah'];
      $total_barang_masuk = $koneksi->query("select SUM(jumlah) as jumlah from barang_masuk where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
      $total_barang_keluar = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
      $total_barang_keluar_badstock = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar_badstock where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
      if(!ISSET($total_barang_masuk['jumlah'])) $total_barang_masuk['jumlah'] = 0;
      if(!ISSET($total_barang_keluar['jumlah'])) $total_barang_keluar['jumlah'] = 0;    
      if(!ISSET($total_barang_keluar_badstock['jumlah'])) $total_barang_keluar_badstock['jumlah'] = 0;    
      $jumlah = $jumlah + $total_barang_masuk['jumlah'] - $total_barang_keluar['jumlah'] - $total_barang_keluar_badstock['jumlah'] ;                           
    }
     mysqli_close($koneksi);
 ?>

						
<input id="stok" type="hidden" class="form-control" value="<?=$jumlah?>" />

							