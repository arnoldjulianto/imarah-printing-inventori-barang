




 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stok Barang Gudang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;font-size:15px">
                <thead>
                                        <tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>											
											<th>Jenis Barang</th>
											<th>Stok</th>
											<th>Satuan</th>
											<th>Diinput Oleh</th>
											<th>Pengaturan</th>
                                        </tr>
										</thead>
										
               
                  <tbody>
                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from barang join users on users.id = barang.id_user");
									while ($data = $sql->fetch_assoc()) {
										$jumlah = $data['jumlah'];
										$total_barang_masuk = $koneksi->query("select SUM(jumlah) as jumlah from barang_masuk where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
										$total_barang_keluar = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
										$total_barang_keluar_badstock = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar_badstock where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
										if(!ISSET($total_barang_masuk['jumlah'])) $total_barang_masuk['jumlah'] = 0;
										if(!ISSET($total_barang_keluar['jumlah'])) $total_barang_keluar['jumlah'] = 0;    
										if(!ISSET($total_barang_keluar_badstock['jumlah'])) $total_barang_keluar_badstock['jumlah'] = 0;    
										$jumlah = $jumlah + $total_barang_masuk['jumlah'] - $total_barang_keluar['jumlah'] - $total_barang_keluar_badstock['jumlah'] ; 
									?>
									
                  <tr>
                      <td><?php echo $no++; ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jenis_barang'] ?></td>
											<td><?php echo $jumlah?></td>
											<td><?php echo $data['satuan'] ?></td>
											<td><?php echo $data['username'] ?></td>
											<td width=200 >
											<a href="?page=gudang&aksi=tambahgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-success btn-sm" >Ubah</a>
											<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=gudang&aksi=hapusgudang&kode_barang=<?php echo $data['kode_barang'] ?>" class="btn btn-danger btn-sm" >Hapus</a>
											</td>
                                        </tr>
									<?php }?>

										   </tbody>
                                </table>
								<a href="?page=gudang&aksi=tambahgudang" class="btn btn-primary" >Tambah Stok Barang Gudang</a>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>












