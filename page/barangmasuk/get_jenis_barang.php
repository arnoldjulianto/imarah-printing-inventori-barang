<?php
include("../../koneksibarang.php");
$jenis_gudang =$_POST['tamp'];
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
                    echo "<option value='$data[kode_barang].$data[nama_barang]'>$data[kode_barang] | $data[nama_barang]</option>";
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
  $('.tampung').html('')
   $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
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
  $('.tampung1').html('');
   $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
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
							
							