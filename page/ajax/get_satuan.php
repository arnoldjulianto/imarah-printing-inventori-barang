<?php
include("../../koneksibarang.php");
$tamp =$_POST['tamp'];
$pecah_bar = explode(".", $tamp);
$kode_bar = $pecah_bar[0];
    $sql = "SELECT *
    FROM barang
    where kode_barang = '$kode_bar'";
    $result = mysqli_query($koneksi, $sql);                            
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
                                       
    ?>
      <input readonly="readonly" id="satuan" name="satuan" type="hidden" class="form-control" value="<?php echo $row["satuan"];?>"/>
 <?php
   		}
    } else {
       //echo "0 results";
    }

     mysqli_close($koneksi);
 
 ?>

 

<script>
$(document).ready(function($) {
  sum();
})
</script>
 
 
 