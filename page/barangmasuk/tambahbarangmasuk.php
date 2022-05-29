  
<?php 
$get_id_transaksi = $_GET['id_transaksi'];
$koneksi = new mysqli("localhost","root","","inventori");
$format = "";
$jenis_gudang = "";
$tanggal_masuk = $tanggal_masuk = date("Y-m-d");
$kode_barang = "";
$nama_barang = "";
$pengirim = "";
$jumlah = 0;
$satuan = "";
if(!ISSET($get_id_transaksi)){
	$no = mysqli_query($koneksi, "select id_transaksi from barang_masuk order by id_transaksi desc");
	$idtran = mysqli_fetch_array($no);
	$kode = $idtran['id_transaksi'];


	$urut = substr($kode, 8, 3);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");

	if(strlen($tambah) == 1){
		$format = "TRM-".$bulan.$tahun."00".$tambah;
	} else if(strlen($tambah) == 2){
		$format = "TRM-".$bulan.$tahun."0".$tambah;
		
	} else{
		$format = "TRM-".$bulan.$tahun.$tambah;

	}
}
else{
	$sql = mysqli_query($koneksi, "select * from barang_masuk where id_transaksi = '$get_id_transaksi'");
	$data = mysqli_fetch_assoc($sql);
	$format = $get_id_transaksi;
	$jenis_gudang = $data['jenis_gudang'];
	$tanggal_masuk = $data['tanggal'];
	$kode_barang = $data['kode_barang'];
	$nama_barang = $data['nama_barang'];
	$pengirim = $data['pengirim'];
	$jumlah = $data['jumlah'];
	$satuan = $data['satuan'];
}

?>

<form method="POST" enctype="multipart/form-data">
<select name="jenis_gudang" id="cmb_jenis_gudang" style="visibility:hidden" >
	<!-- <option value="">-- Pilih Gudang  --</option> -->
	<?php
	$sql = $koneksi -> query("select * from jenis_gudang order by id");
	while ($data=$sql->fetch_assoc()) {?>
		<option value='<?=$data[jenis_gudang]?>' <?php if($jenis_gudang == $data['jenis_gudang']) echo 'selected'?> ><?=$data[jenis_gudang]?></option>
<?php	}
	?>
</select>
  <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($get_id_transaksi)) echo 'Ubah'; else echo 'Tambah' ?> Barang Masuk</h6>
            </div>
            <div class="card-body">
				<div class="body">
						<input type="hidden" name="jumlahlama" id="jumlahlama" value="<?=$jumlah?>" />
						<div class="row">
							<div class="col-md-5">
								<div class="form-group ">
									<label for="">Id Transaksi</label>
									<div class="form-line">
										<input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly /> 
									</div>
								</div>
									
								<div class="form-group">
									<label for="">Tanggal Masuk</label>
									<div class="form-line">
										<input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" value="<?php echo $tanggal_masuk; ?>" />
									</div>
								</div>

								<div class="form-group">
									<label for="">Supplier</label>
									<div class="form-line">
										<select name="pengirim" class="form-control" >
										<option value="">-- Pilih Supplier  --</option>
										<?php
										
										$sql = $koneksi -> query("select * from tb_supplier order by nama_supplier");
										while ($data=$sql->fetch_assoc()) {
											$selected = "";
											if($pengirim == $data[nama_supplier] ) $selected = "selected";
										echo "<option value='$data[nama_supplier]' $selected >$data[nama_supplier]</option>";
										}
										?>
										
										</select>
									</div>
								</div>

								<div class="tampung"></div>
								<div class="tampung1"></div>
							</div>	

							<div class="col-md-7">
								<input readonly="readonly" name="jumlah" id="jumlah" type="hidden" class="form-control">	
								<div class="kode_barang_area"></div>
								<table class="table table-hover">
									<tr>
										<td>
											Stok Saat Ini <br/>
											<small style="color:red" >stok awal + total barang masuk - total barang keluar</small>
										</td>
										<td id="stoksaatini"></td>
									</tr>

									<?php if($get_id_transaksi != "") {?>
										<tr>
											<td>
												Jumlah Barang Masuk Sebelumnya 
											</td>
											<td id="jumlahmasuksebelum"></td>
										</tr>
									<?php }?>

									<tr>
										<td>
											<?php if($get_id_transaksi != "") {?>Ubah<?php }?> Jumlah Barang Masuk
											<?php if($get_id_transaksi != "") {?>
												<br/>
												<small style="color:red">kosongkan bila tidak ingin mengubah</small>
											<?php }?>
										</td>
										<td>
											<input type="number" name="jumlahmasuk" id="jumlahmasuk" oninput="sum()" class="form-control" value=""  />
										</td>
									</tr>

									<tr>
										<td colspan=2>
											<hr style="border:1px solid black" />
										</td>
									</tr>

									<tr>
										<td>Update Stok</td>
										<td id="jumlahmasuksesudah"></td>
									</tr>
								</table>
							</div>
						</div>
						<hr/>
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary col-12">
					</form>
							
							
							
<?php						
if (isset($_POST['simpan'])) {
	$id_transaksi= $_POST['id_transaksi'];
	$jenis_gudang= $_POST['jenis_gudang'];
	$tanggal= $_POST['tanggal_masuk'];
	$barang= $_POST['barang'];
	$pecah_barang = explode(".", $barang);
	$kode_barang = $pecah_barang[0];
	$nama_barang = $pecah_barang[1];
	$jumlah= $_POST['jumlahmasuk'];
	if($jumlah == "") $jumlah = $_POST['jumlahlama'];
	$pengirim= $_POST['pengirim'];
	$pecah_nama = explode($nama_supplier);
	$nama_supplier = $pecah_nama[0];
	$satuan = $_POST['satuan'];
	$current_stok = $_POST['jumlah'];

	if(!ISSET($get_id_transaksi)){
		$sql = $koneksi->query("insert into barang_masuk (id_transaksi, jenis_gudang, tanggal, kode_barang, nama_barang, jumlah, satuan, pengirim) values('$id_transaksi','$jenis_gudang','$tanggal','$kode_barang','$nama_barang','$jumlah','$satuan','$pengirim')");
			if ($sql) {
			?>
				<script type="text/javascript">
				alert("Simpan Data Berhasil");
				window.location.href="?page=barangmasuk&aksi=";
				
				</script>
				<?php
		}
	}
	else {
		$sql = $koneksi->query("update barang_masuk set jenis_gudang = '$jenis_gudang', tanggal = '$tanggal', kode_barang = '$kode_barang', nama_barang = '$nama_barang', jumlah = $jumlah, satuan = '$satuan' , pengirim = '$pengirim' where id_transaksi = '$id_transaksi' ");
		if ($sql) {
		?>
			<script type="text/javascript">
			alert("Simpan Data Berhasil");
			window.location.href="?page=barangmasuk&aksi=";
			
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
  	var id_transaksi = "<?php if(ISSET($get_id_transaksi)) echo $get_id_transaksi?>";  // Ciptakan variabel provinsi
  	Swal.fire({
        allowOutsideClick: false,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
  	$.ajax({
        type: 'POST', // Metode pengiriman data menggunakan POST
        url: 'page/ajax/get_barang.php', // File yang akan memproses data
        data: 'jenis_gudang=' + jenis_gudang+'&kode_barang=' + kode_barang+'&id_transaksi=' + id_transaksi, // Data yang akan dikirim ke file pemroses
        success: function(data) { // Jika berhasil
            $('.kode_barang_area').html(data); // Berikan hasil ke id kota
        },
		error:function(){
			Swal.close()
		}
    });
});

function sum() {
	 var stok = document.getElementById('stok').value;
	 var jumlahlama = document.getElementById('jumlahlama').value;
	 var jumlahmasuk = document.getElementById('jumlahmasuk').value;
	 
	 var result;
	 if(jumlahlama == "") result = parseInt(stok) + parseInt(jumlahmasuk);
	 else {
		 result = (parseInt(stok) - parseInt(jumlahlama) ) + parseInt(jumlahmasuk );
	 }

	 console.log("jumlahmasuk", jumlahmasuk)

	 if (jumlahmasuk < 0) {
		Swal.fire({
			icon: 'error',
			title: 'Kesalahan Terjadi',
			text: 'Jumlah Barang Masuk Tidak Boleh Kurang Dari Nol',
		})
		result = stok;
		document.getElementById('jumlahmasuk').value = '';
	 }

	 if (!isNaN(result)) {
		 document.getElementById('jumlah').value = result;
	 }
	 else {
		document.getElementById('jumlah').value = stok;
	 }

	 var satuan ="";
	 if(typeof(document.getElementById('satuan')) !== "undefined" && document.getElementById('satuan') !== null ){
		satuan = document.getElementById('satuan').value;
	 }
	 if(typeof(document.getElementById('jumlahmasuksebelum')) !== "undefined" && document.getElementById('jumlahmasuksebelum') !== null ){
		 document.getElementById('jumlahmasuksebelum').textContent = jumlahlama+" "+satuan; 
	 }
	 document.getElementById('jumlahmasuksesudah').textContent = document.getElementById('jumlah').value+" "+satuan;
	 document.getElementById('stoksaatini').textContent = stok+" "+satuan;
 }
 </script>
										
								
										
										
								
										
								
								
								
							
									
							
								
								
								
								
								
