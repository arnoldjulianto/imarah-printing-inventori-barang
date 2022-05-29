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
		$no = mysqli_query($koneksi, "select id_transaksi from barang_keluar_badstock order by id_transaksi desc");
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
		$sql = mysqli_query($koneksi, "select * from barang_keluar_badstock where id_transaksi = '$get_id_transaksi'");
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
<input type="hidden" name="jumlahlama" id="jumlahlama" value="<?=$jumlah?>" />
<div class="container-fluid">
	<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($get_id_transaksi)) echo 'Ubah'; else echo 'Tambah' ?> Barang Badstock</h6>
	</div>
	<div class="card-body">
		<div class="body">
			<div class="row">
				<div class="col-md-5">
						<div class="form-group">
							<label for="">Id Transaksi</label>
							<div class="form-line">
								<input type="text" name="id_transaksi" class="form-control" id="id_transaksi" value="<?php echo $format; ?>" readonly />  
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

					<div class="form-group">
						<label for="">Tujuan</label>
						<div class="form-line">
							<input type="text" name="tujuan" class="form-control" value="<?=$tujuan?>" required/>	 
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
								<small style="color:red" >stok awal + total barang keluar - total barang keluar - total barang badstock</small>
							</td>
							<td id="stoksaatini"></td>
						</tr>

						<?php if($get_id_transaksi != "") {?>
							<tr>
								<td>
									Jumlah Barang Badstock Sebelumnya 
								</td>
								<td id="jumlahbadstocksebelum"></td>
							</tr>
						<?php }?>

						<tr>
							<td>
								<?php if($get_id_transaksi != "") {?>Ubah<?php }?> Jumlah Barang Badstock
								<?php if($get_id_transaksi != "") {?>
									<br/>
									<small style="color:red">kosongkan bila tidak ingin mengubah</small>
								<?php }?>
							</td>
							<td>
								<input type="number" name="jumlahbadstock" id="jumlahbadstock" oninput="sum()" class="form-control" value=""  />
							</td>
						</tr>

						<tr>
							<td colspan=2>
								<hr style="border:1px solid black" />
							</td>
						</tr>

						<tr>
							<td>Update Stok</td>
							<td id="jumlahbadstocksesudah"></td>
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
	$nomor_spk= $_POST['nomor_spk'];
	$tanggal= $_POST['tanggal_keluar'];
	$barang= $_POST['barang'];
	$pecah_barang = explode(".", $barang);
	$kode_barang = $pecah_barang[0];
	$nama_barang = $pecah_barang[1];
	$jumlah= $_POST['jumlahbadstock'];
	if($jumlah == "") $jumlah = $_POST['jumlahlama'];
	$satuan= $_POST['satuan'];
	$tujuan= $_POST['tujuan'];
	$total= $_POST['total'];
	if(!ISSET($get_id_transaksi)){
		$sql = $koneksi->query("insert into barang_keluar_badstock (id_transaksi, nomor_spk
		, jenis_gudang, tanggal, kode_barang, nama_barang, jumlah, satuan, tujuan) values('$id_transaksi', '$nomor_spk', '$jenis_gudang','$tanggal','$kode_barang','$nama_barang','$jumlah','$satuan','$tujuan')");
		if($sql ) {?>
			<script type="text/javascript">
				alert("Simpan Data Berhasil");
				window.location.href="?page=barangkeluarbadstock&aksi=";	
			</script>
<?php
		}
	}
	else{
		$sql = $koneksi->query("update barang_keluar_badstock set nomor_spk = '$nomor_spk', jenis_gudang = '$jenis_gudang', tanggal = '$tanggal',kode_barang = '$kode_barang',nama_barang = '$nama_barang', jumlah = '$jumlah',satuan = '$satuan',tujuan = '$tujuan' where id_transaksi = '$id_transaksi' ");
		if($sql ) {?>
			<script type="text/javascript">
			alert("Simpan Data Berhasil");
			window.location.href="?page=barangkeluarbadstock&aksi=";	
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
      },
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
	 var jumlahbadstock = document.getElementById('jumlahbadstock').value;
	 var satuan ="";
	 if(typeof(document.getElementById('satuan')) !== "undefined" && document.getElementById('satuan') !== null ){
		satuan = document.getElementById('satuan').value;
	 }
	 var result;
	if(jumlahlama == "") result = parseInt(stok) - parseInt(jumlahbadstock);
	else {
		result = (parseInt(stok) + parseInt(jumlahlama) ) - parseInt(jumlahbadstock);
	}
	if (jumlahbadstock < 0) {
		Swal.fire({
			icon: 'error',
			title: 'Kesalahan Terjadi',
			text: 'Jumlah Barang Badstock Tidak Boleh Kurang Dari 0',
		})
		document.getElementById('jumlahbadstock').value = '';
		result = stok;
	 }
	 
	 if(result < 0) {
		var max = 0;
		if(jumlahlama != "") max = parseInt(stok) + parseInt(jumlahlama);
		else max = parseInt(stok);

		Swal.fire({
			icon: 'error',
			title: 'Kesalahan Terjadi',
			text: 'Jumlah Barang Badstock Maks. Yang Diizinkan Adalah '+max +" "+satuan,
		})
		document.getElementById('jumlahbadstock').value = '';
		result = stok;
	 }

	 if (!isNaN(result)) {
		 document.getElementById('jumlah').value = result;
	 }
	 else document.getElementById('jumlah').value = stok;

	 
	 if(typeof(document.getElementById('jumlahbadstocksebelum')) !== "undefined" && document.getElementById('jumlahbadstocksebelum') !== null ){
		 document.getElementById('jumlahbadstocksebelum').textContent = jumlahlama+" "+satuan; 
	 }
	 document.getElementById('jumlahbadstocksesudah').textContent = document.getElementById('jumlah').value+" "+satuan;
	 document.getElementById('stoksaatini').textContent = stok+" "+satuan;
 }
</script>								
								
								
								
								
								
