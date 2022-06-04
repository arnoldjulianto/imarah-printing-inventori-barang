 <?php
	
	$koneksi = new mysqli("localhost","root","","inventori");

	
	
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Stok_Gudang(".date('d-m-Y').").xls");

?>	

<h2>Laporan Stok Gudang</h2>

<table border="1" style="text-align:center">
	  <tr>
											<th>No</th>
											<th>Kode Barang</th>
											<th>Nama Barang</th>											
											<th>Jenis Barang</th>
											<th>Jumlah Barang</th>
											<th>Satuan</th>
											<th>Diinput Oleh</th>
                                        </tr>
	
 <?php 
									
									$no = 1;
									$sql = $koneksi->query("select * from gudang join users on users.id = gudang.id_user");
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
											<td><?php echo $jumlah ?></td>
											<td><?php echo $data['satuan'] ?></td>
											<td><?php echo $data['username'] ?></td>
                                        </tr>
									<?php }?>

                                </table>