<?php
include("../../koneksibarang.php");
$tamp =$_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];
    $sql = "SELECT *
    FROM gudang
    where kode_barang = '$kode_bar'";
    $result = mysqli_query($koneksi, $sql);                            
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      // $total_barang_masuk = $koneksi->query("select SUM(jumlah) as jumlah from barang_masuk where kode_barang = '$row[kode_barang]' ")->fetch_assoc();
      // $total_barang_keluar = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar where kode_barang = '$row[kode_barang]' ")->fetch_assoc();
      // if(!ISSET($total_barang_masuk['jumlah'])) $total_barang_masuk['jumlah'] = 0;
      // if(!ISSET($total_barang_keluar['jumlah'])) $total_barang_keluar['jumlah'] = 0;                                
    ?>
		
		<label for="stok">Stok</label>
        <div class="form-group">
            <div class="form-line">
              <input readonly="readonly" id="stok" type="number" class="form-control" value="<?php echo $row["jumlah"]?>" />
							</div>
      </div>
 <?php
   		}
    } else {
       //echo "0 results";
    }

     mysqli_close($koneksi);
 
 ?>

<script>
  jQuery(document).ready(function($) {
    sum();
  })
</script>
							