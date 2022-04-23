  

  
<?php 
$get_id_transaksi = $_GET['id_transaksi']; 
$format = "";
$jenis_gudang = "";
$nomor_spk = "";
$tanggal_keluar = $tanggal_keluar = date("Y-m-d");
$kode_barang = "";
$nama_barang = "";
$tujuan = "";
$jumlah = "";
$satuan = "";
$tanggal_keluar = date("Y-m-d");
if(!ISSET($get_id_transaksi)){
	$koneksi = new mysqli("localhost","root","","inventori");
	$no = mysqli_query($koneksi, "select id_transaksi from barang_keluar order by id_transaksi desc");
	$idtran = mysqli_fetch_array($no);
	$kode = $idtran['id_transaksi'];

	$urut = substr($kode, 8, 3);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");

	if(strlen($tambah) == 1){
		$format = "TRK-".$bulan.$tahun."00".$tambah;
	} else if(strlen($tambah) == 2){
		$format = "TRK-".$bulan.$tahun."0".$tambah;
		
	} else{
		$format = "TRK-".$bulan.$tahun.$tambah;

	}
}
else{
	$sql = mysqli_query($koneksi, "select * from barang_keluar where id_transaksi = '$get_id_transaksi'");
	$data = mysqli_fetch_assoc($sql);
	$format = $get_id_transaksi;
	$jenis_gudang = $data['jenis_gudang'];
	$nomor_spk = $data['nomor_spk'];
	$tanggal_keluar = $data['tanggal'];
	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
	$tujuan = $data['tujuan'];
	$jumlah = $data['jumlah'];
	$satuan = $data['satuan'];
}



?>
<script>
 function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahkeluar = document.getElementById('jumlahkeluar').value;
	 var result = 0;
	 if(jumlahkeluar > 0) result = parseInt(stok) - parseInt(jumlahkeluar);
	 else if (jumlahkeluar == 0) result = parseInt(stok) + parseInt(jumlahkeluar);
	 else if (jumlahkeluar < 0) {
		 alert("Jumlah Tidak Boleh Kurang Dari 0");
		 document.getElementById('jumlahkeluar').value = 0;
		 result = 0;
	 }
	 
	 if(result < 0) {
		 alert("Jumlah Maks. Yang Diizinkan Adalah "+stok);
		 document.getElementById('jumlahkeluar').value = stok;
		 result = 0;
	 }
	 if (!isNaN(result)) {
		 document.getElementById('total').value = result;
	 }
 }
 </script>
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($get_id_transaksi)) echo 'Ubah'; else echo 'Tambah' ?> Barang Keluar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">
							
							<form method="POST" enctype="multipart/form-data">
							
							<label for="">Id Transaksi</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly />  
							</div>
                            </div>

							<label for="">Gudang</label>
                            <div class="form-group">
                               <div class="form-line">
									<select name="jenis_gudang" id="cmb_jenis_gudang" class="form-control" >
										<option value="">-- Pilih Gudang  --</option>
										<?php
										$sql = $koneksi -> query("select * from jenis_gudang order by id");
										while ($data=$sql->fetch_assoc()) {?>
											<option value='<?=$data[jenis_gudang]?>' <?php if($jenis_gudang == $data['jenis_gudang']) echo 'selected'?> ><?=$data[jenis_gudang]?></option>
								<?php	}
										?>
									
									</select>
								</div>
                            </div>


							<label for="">Nomor SPK</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nomor_spk" class="form-control" value="<?=$nomor_spk?>" required />	 
							</div>
                            </div>
							
							<label for="">Tanggal Keluar</label>
                            <div class="form-group">
                               <div class="form-line">
                                 <input type="date" name="tanggal_keluar" class="form-control" id="tanggal_kelauar" value="<?php echo $tanggal_keluar; ?>" />
							</div>
                            </div>
							
					
							<div class="kode_barang_area"></div>
							<div class="tampung"></div>
					
							<label for="">Jumlah</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="number" name="jumlahkeluar" id="jumlahkeluar" onkeyup="sum()" class="form-control"  required value="<?=$jumlah?>" />	 
							</div>
                            </div>
							
							<label for="total">Total Stok</label>
                            <div class="form-group">
                               <div class="form-line">
                               <input readonly="readonly" name="total" id="total" type="number" class="form-control">
                            

							</div>
                            </div>
							
							<div class="tampung1"></div>
							
							<label for="">Tujuan</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="tujuan" class="form-control" value="<?=$tujuan?>" required/>	 
							</div>
                            </div>
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
<?php
if (isset($_POST['simpan'])) {
	$id_transaksi= $_POST['id_transaksi'];
	$jenis_gudang= $_POST['jenis_gudang'];
	$nomor_spk= $_POST['nomor_spk'];
	$tanggal= $_POST['tanggal_keluar'];
	$barang= $_POST['barang'];
	$pecah_barang = explode(".", $barang);
	$kode_barang = $pecah_barang[0];
	$nama_barang = $pecah_barang[1];
	$jumlah= $_POST['jumlahkeluar'];
	$satuan= $_POST['satuan'];
	$tujuan= $_POST['tujuan'];
	$total= $_POST['total'];
	if(!ISSET($get_id_transaksi)){
		$sql = $koneksi->query("insert into barang_keluar (id_transaksi, nomor_spk
		, jenis_gudang, tanggal, kode_barang, nama_barang, jumlah, satuan, tujuan) values('$id_transaksi', '$nomor_spk', '$jenis_gudang','$tanggal','$kode_barang','$nama_barang','$jumlah','$satuan','$tujuan')");
		if($sql ) {?>
			<script type="text/javascript">
				alert("Simpan Data Berhasil");
				window.location.href="?page=barangkeluar&aksi=";	
			</script>
<?php
		}
	}
	else{
		$sql = $koneksi->query("update barang_keluar set nomor_spk = '$nomor_spk', nomor_spk = '$jenis_gudang', tanggal = '$tanggal',kode_barang = '$kode_barang',nama_barang = '$nama_barang', jumlah = '$jumlah',satuan = '$satuan',tujuan = '$tujuan' where id_transaksi = '$id_transaksi' ");
		if($sql ) {?>
			<script type="text/javascript">
			alert("Simpan Data Berhasil");
			window.location.href="?page=barangkeluar&aksi=";	
			</script>
<?php
		}
	}
}
?>

<script>
jQuery(document).ready(function($) {
  $('.tampung').html('')
  var jenis_gudang = $('#cmb_jenis_gudang').val(); // Ciptakan variabel provinsi
  var kode_barang = "<?php if(ISSET($kode_barang)) echo $kode_barang?>";  // Ciptakan variabel provinsi
  	$.ajax({
        type: 'POST', // Metode tujuanan data menggunakan POST
        url: 'page/ajax/get_jenis_barang.php', // File yang akan memproses data
        data: 'jenis_gudang=' + jenis_gudang+'&kode_barang=' + kode_barang, // Data yang akan dikirim ke file pemroses
        success: function(data) { // Jika berhasil
            $('.kode_barang_area').html(data); // Berikan hasil ke id kota
        }
    });
});
</script>								
								
								
								
								
								
