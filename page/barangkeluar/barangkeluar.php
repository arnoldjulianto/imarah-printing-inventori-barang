




 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Barang Keluar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align:center;font-size:15px">
                <thead>
                                        <tr>
											<th>No</th>
											<th>Id Transaksi</th>
											<th>Tanggal Keluar</th>
											<th>No. SPK</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>
											<th>Jumlah Keluar</th>
											<th>Satuan</th>
											<th>Tujuan</th>
											<th>Diinput Oleh</th>
											<th>Pengaturan</th>
                                         
                                        </tr>
										</thead>
										
               
                  <tbody>
                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from barang_keluar join users on users.id = barang_keluar.id_user ");
									while ($data = $sql->fetch_assoc()) {
										
									?>
									
                                        <tr>
                                            <td><?php echo $no++; ?></td>
											<td><?php echo $data['id_transaksi'] ?></td>
											<td><?php echo $data['tanggal'] ?></td>
											<td><?php echo $data['nomor_spk'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['satuan'] ?></td>
											<td><?php echo $data['tujuan'] ?></td>
											<td><?php echo $data['username'] ?></td>
											<td style="min-width:150px">
												<a href="?page=barangkeluar&aksi=tambahbarangkeluar&id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</a>
												<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=barangkeluar&aksi=hapusbarangkeluar&id_transaksi=<?php echo $data['id_transaksi'] ?>" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i> Hapus</a>
											</td>
                                        </tr>
									<?php }?>

										   </tbody>
                                </table>
								<a href="?page=barangkeluar&aksi=tambahbarangkeluar" class="btn btn-primary" >Tambah</a>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>












