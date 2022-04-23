<?php
include("../../koneksibarang.php");
$jenis_gudang =$_POST['jenis_gudang'];
$kode_barang =$_POST['kode_barang'];
    $sql = "SELECT *
    FROM gudang
    where jenis_gudang = '$jenis_gudang'";
    $result = mysqli_query($koneksi, $sql);                            
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    ?>
    <label for="">Barang</label>
    <div class="form-group">
          <div class="form-line">
                  <select name="barang" id="cmb_barang" class="form-control" >
                  <option value="">-- Pilih Barang  --</option>
                  <?php
                  while ($data = mysqli_fetch_assoc($result)) {
                    $selected = "";
                    if($kode_barang == $data['kode_barang']) $selected ="selected";
                    echo "<option value='$data[kode_barang].$data[nama_barang]' ".$selected." >$data[kode_barang] | $data[nama_barang]</option>";
                  }
                  ?>
                  
                  </select>	 
          </div>
    </div>
 <?php
    } else {
       echo "0 results";
    }

     mysqli_close($koneksi);
 
 ?>

<script>
jQuery(document).ready(function($) {
  
  $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
     $('.tampung').html('');
     var tamp = $(this).val(); // Ciptakan variabel provinsi
     $.ajax({
        type: 'POST', // Metode pengiriman data menggunakan POST
        url: 'page/barangmasuk/get_barang.php', // File yang akan memproses data
        data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
        success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota
        }
    });
  });
});

jQuery(document).ready(function($) {
   $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
     $('.tampung1').html('');
     var tamp = $(this).val(); // Ciptakan variabel provinsi
     $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
         data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
         success: function(data) { // Jika berhasil
              $('.tampung1').html(data); // Berikan hasil ke id kota
            }
           
     
    });
});
});
</script>
							
							