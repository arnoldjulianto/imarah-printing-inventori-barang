 <?php
 $satuan ="";
 $id = $_GET['id'];
 if(ISSET($id)) { 
   $sql = $koneksi->query("select * from satuan Where id = $id ");
   $data = $sql->fetch_assoc();
   $satuan = $data['satuan'];
 }
 ?> 
 
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary"><?php if($satuan != "") echo "Ubah"; else echo "Tambah" ?> Satuan Barang</h6>
		</div>	
		<form method="POST" enctype="multipart/form-data">
		<div class="card-body">
            <div class="table-responsive">
				<label for="">Satuan Barang</label>
					<div class="form-group">
						<div class="form-line">
						<input type="text" name="satuan" class="form-control" value="<?=$satuan?>" required />	 
					</div>
			</div>	
		</div>	
		<div class="card-footer">
			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			</form>
		</div>
	</div>
</div>
					
<?php
if (isset($_POST['simpan'])) {
	if(!isset($id)) {
		$satuan= $_POST['satuan'];
		$sql = $koneksi->query("insert into satuan (satuan) values('$satuan')");
		if ($sql) { ?>
			<script type="text/javascript">
				alert("Data Berhasil Disimpan");
				window.location.href="?page=satuanbarang&aksi=";
			</script>
			
<?php
		}
	}
	else{
		$satuan= $_POST['satuan'];
		$sql = $koneksi->query("update satuan set satuan = '$satuan' where id = $id ");
		if ($sql) { ?>
		<script type="text/javascript">
				alert("Data Berhasil Disimpan");
				window.location.href="?page=satuanbarang&aksi=";
		</script>
<?php
		}
	}
}
?>
										
										
										
								
								
								
								
								
