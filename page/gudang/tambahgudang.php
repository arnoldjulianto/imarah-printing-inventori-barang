<?php 
$get_kode_barang = $_GET['kode_barang'];
$format = $nama_barang = $jenis_barang = $satuan = $jumlah = $jenis_gudang = "";
$koneksi = new mysqli("localhost","root","","inventori");
if(!ISSET($get_kode_barang)){
	$no = mysqli_query($koneksi, "select kode_barang from gudang order by kode_barang desc");
	$kdbarang = mysqli_fetch_array($no);
	$kode = $kdbarang['kode_barang'];

	$urut = substr($kode, 8, 3);
	$tambah = (int) $urut + 1;
	$bulan = date("m");
	$tahun = date("y");

	if(strlen($tambah) == 1){
		$format = "BAR-".$bulan.$tahun."00".$tambah;
	} else if(strlen($tambah) == 2){
		$format = "BAR-".$bulan.$tahun."0".$tambah;
		
	} else{
		$format = "BAR-".$bulan.$tahun.$tambah;
	}
}
else {
	$kode_barang = $_GET['kode_barang'];
	$sql = mysqli_query($koneksi, "select * from gudang where kode_barang = '$kode_barang' ");
	$data = mysqli_fetch_assoc($sql);
	$format = $data['kode_barang'];
	$jenis_gudang = $data['jenis_gudang'];
	$nama_barang = $data['nama_barang'];
	$jenis_barang = $data['jenis_barang'];
	$satuan = $data['satuan'];
	$jumlah = $data['jumlah'];
	$total_barang_masuk = $koneksi->query("select SUM(jumlah) as jumlah from barang_masuk where kode_barang = '$_GET[kode_barang]' ")->fetch_assoc();
	$total_barang_keluar = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar where kode_barang = '$_GET[kode_barang]' ")->fetch_assoc();
	if(!ISSET($total_barang_masuk['jumlah'])) $total_barang_masuk['jumlah'] = 0;
	if(!ISSET($total_barang_keluar['jumlah'])) $total_barang_keluar['jumlah'] = 0;    
	$jumlah = $jumlah + $total_barang_masuk['jumlah'] - $total_barang_keluar['jumlah']; 
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
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($get_kode_barang)) echo "Ubah"; else echo "Tambah"?> Stok Barang Gudang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							<div class="body">
							
                            <div class="form-group">
								<label for="">Kode Barang</label>
                               <div class="form-line">
                                  <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $format; ?>" readonly />	 
							</div>
                            </div>

							
							<label for="">Nama Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="nama_barang" class="form-control" value="<?=$nama_barang?>" required />	 
							</div>
                            </div>
							
							<label for="">Jenis Barang</label>
                            <div class="form-group">
                               <div class="form-line">
									<select name="jenis_barang" class="form-control" >
									<option value="">-- Pilih Jenis Barang  --</option>
									<?php
									
									$sql = $koneksi -> query("select * from jenis_barang order by id");
									while ($data=$sql->fetch_assoc()) {?>
										<option value='<?=$data[jenis_barang]?>' <?php if($jenis_barang == $data['jenis_barang']) echo 'selected'?> ><?=$data[jenis_barang]?></option>
							  <?php }?>
									</select>
								</div>
                            </div>

                            <label for="">Jumlah</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?php echo $jumlah; ?>" required <?php if(ISSET($get_kode_barang)) echo 'readOnly'?> /> 
								</div>
                            </div>

							<label for="">Satuan Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <select name="satuan" class="form-control" >
								<option value="">-- Pilih Satuan Barang --</option>
								<?php
								
								$sql = $koneksi -> query("select * from satuan order by id");
								while ($data=$sql->fetch_assoc()) {?>
									<option value='<?=$data[satuan]?>' <?php if($satuan == $data['satuan']) echo 'selected'?> ><?=$data[satuan]?></option>
						  <?php }?>
								</select>
							</div>
                            </div>
							
							<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
							
							
							
<?php

if (isset($_POST['simpan'])) {
		$kode_barang= $_POST['kode_barang'];
		$nama_barang= $_POST['nama_barang'];
		$jenis_gudang= $_POST['jenis_gudang'];
		$jenis_barang= $_POST['jenis_barang'];
		$jumlah= $_POST['jumlah'];
		$satuan= $_POST['satuan'];
		if(!ISSET($get_kode_barang)){
			$sql = $koneksi->query("insert into gudang (kode_barang, jenis_gudang, nama_barang, jenis_barang, jumlah, satuan ) values('$kode_barang', '$jenis_gudang', '$nama_barang','$jenis_barang','$jumlah','$satuan')");
			if ($sql) {
				?>
				
					<script type="text/javascript">
					alert("Data Berhasil Disimpan");
					window.location.href="?page=gudang&aksi=";
					</script>
					
					<?php
			}
		}
		else{
			$sql = $koneksi->query("update gudang set jenis_gudang = '$jenis_gudang', nama_barang = '$nama_barang', jenis_barang = '$jenis_barang', jumlah = $jumlah, satuan = '$satuan' where kode_barang = '$kode_barang' ");
			if ($sql) {?>
				<script type="text/javascript">
					alert("Data Berhasil Disimpan");
					window.location.href="?page=gudang&aksi=";
				</script>
<?php		}
		}
}
?>
										
										
										
								
								
								
								
								
