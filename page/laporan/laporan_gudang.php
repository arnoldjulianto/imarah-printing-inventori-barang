



<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stok Gudang</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                     <tr>
                        <th>No</th>
                        <th>Nama Gudang</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>											
                        <th>Jenis Barang</th>
                        <th>Stok Awal</th>
                        <!-- <th>Jumlah Barang Masuk</th>
                        <th>Jumlah Barang Keluar</th>
                        <th>Sisa Stok</th> -->
                        <th>Satuan</th>         
                     </tr>
										</thead>
										
               
                  <tbody>
                    <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from gudang");
									while ($data = $sql->fetch_assoc()) {
                    // $total_barang_masuk = $koneksi->query("select SUM(jumlah) as jumlah from barang_masuk where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
										// $total_barang_keluar = $koneksi->query("select SUM(jumlah) as jumlah from barang_keluar where kode_barang = '$data[kode_barang]' ")->fetch_assoc();
										// if(!ISSET($total_barang_masuk['jumlah'])) $total_barang_masuk['jumlah'] = 0;
										// if(!ISSET($total_barang_keluar['jumlah'])) $total_barang_keluar['jumlah'] = 0;
									?>
									
                  <tr>
                      <td><?php echo $no++; ?></td>
											<td><?php echo $data['jenis_gudang'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['jenis_barang'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
                      <?php /*
											<td><?php echo $total_barang_masuk['jumlah'] ?></td>
											<td><?php echo $total_barang_keluar['jumlah'] ?></td>
											<td><?php echo ($data['jumlah'] + $total_barang_masuk['jumlah']) - $total_barang_keluar['jumlah'] ?></td>
											*/?>
                      <td><?php echo $data['satuan'] ?></td>
                  </tr>
									<?php }?>

										   </tbody>
                                </table>
								<a href="page/laporan/export_laporan_gudang_excel.php"  class="btn btn-primary" style="margin-top:8 px"><i class="fa fa-print"></i>ExportToExcel</a>
								
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>












