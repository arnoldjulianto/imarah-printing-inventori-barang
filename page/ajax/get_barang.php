<?php
  include("../../koneksibarang.php");
  $jenis_gudang =$_POST['jenis_gudang'];
  $kode_barang =$_POST['kode_barang'];
  $id_transaksi =$_POST['id_transaksi'];
  
  $sql = "SELECT *
  FROM barang
  where jenis_gudang = '$jenis_gudang'";
  $result = mysqli_query($koneksi, $sql);                            
  if (mysqli_num_rows($result) > 0) {
  // output data of each row
?>
    <label for="">Barang
    </label>
    <div class="form-group">
        <div class="form-line">
            <select name="barang" id="cmb_barang" class="form-control" 
            style="
            <?php if($id_transaksi <> "") {?>
            background: #eee; /*Simular campo inativo - Sugestão @GabrielRodrigues*/
            pointer-events: none;
            touch-action: none;
            <?php }?>
            " >

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
       //echo "0 results";
    }

     mysqli_close($koneksi);
 
 ?>

<script>
jQuery(document).ready(function($) {
  setData();  
  $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
    setData();
  });
});

function setData(){
    $('.tampung').html('');
    $('.tampung1').html('');
    var tamp = $('#cmb_barang').val(); // Ciptakan variabel provinsi
    $.ajax({
        type: 'POST', // Metode pengiriman data menggunakan POST
        url: 'page/ajax/get_stok_barang.php', // File yang akan memproses data
        data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
        success: function(data) { // Jika berhasil
            $('.tampung').html(data); // Berikan hasil ke id kota\
            $.ajax({
                type: 'POST', // Metode pengiriman data menggunakan POST
                url: 'page/ajax/get_satuan.php', // File yang akan memproses data
                data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
                success: function(data) { // Jika berhasil
                    $('.tampung1').html(data); // Berikan hasil ke id kota
                },
                error:function(){
                    Swal.close()
                }
            });
        },
        error:function(){
            Swal.close()
        }
    });
}
</script>
							
							