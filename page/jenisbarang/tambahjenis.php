 <?php
 $id = $jenis_barang = "";
 if(ISSET($_GET['id'])){
	$id = $_GET['id'];
	$sql = mysqli_query($koneksi, "select * from jenis_barang where id = '$id'");
	$data = mysqli_fetch_assoc($sql);
	$jenis_barang = $data['jenis_barang'];
 }
 ?> 
 
 <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($_GET['id'])) echo 'Ubah'; else echo 'Tambah' ?> Jenis Barang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
							
							
							<div class="body">
							
							<form method="POST" enctype="multipart/form-data">
  							

							<label for="">Jenis Barang</label>
                            <div class="form-group">
                               <div class="form-line">
                                <input type="text" name="jenis_barang" class="form-control" value="<?=$jenis_barang?>" />	 
							</div>
                            </div>
					
							
						
								<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							
							</form>
						
							
							
							
							<?php
							
							if (isset($_POST['simpan'])) {
								$jenis_barang= $_POST['jenis_barang'];
								if(!ISSET($_GET['id'])){
								$sql = $koneksi->query("insert into jenis_barang (jenis_barang) values('$jenis_barang')");
									if ($sql) {
										?>
										<script type="text/javascript">
											alert("Data Berhasil Disimpan");
											window.location.href="?page=jenisbarang";
										</script>	
							<?php
									}
								}
								else{
									$sql = $koneksi->query("update jenis_barang set jenis_barang = '$jenis_barang' where id = '$id' ");
									if ($sql) {
									?>
									<script type="text/javascript">
										alert("Data Berhasil Disimpan");
										window.location.href="?page=jenisbarang";
									</script>
						<?php	
									}
								}
							}
							?>
										
										
										
								
								
								
								
								
