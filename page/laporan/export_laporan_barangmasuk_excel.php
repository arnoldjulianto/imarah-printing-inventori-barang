
<?php
if (isset($_POST['submit']))
{?>

 <?php



	$koneksi = new mysqli("localhost","root","","inventori");

	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (".date('d-m-Y').").xls");
	
	$bln = $_POST['bln'] ;
	$thn = $_POST['thn'] ;
	$jenis_gudang = $_POST['jenis_gudang'] ;

?>	

<body>
<center>
<h2>Laporan Barang Masuk Bulan <?php echo $bln;?> Tahun <?php echo $thn;?></h2>
</center>
<table border="1">
  	<tr>
		<th>No</th>
		<th>Id Transaksi</th>
		<th>Tanggal Masuk</th>
		<th>Gudang</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Pengirim</th>
		<th>Jumlah Masuk</th>
		<th>Satuan Barang</th>
	</tr>
	

                    <?php 
									
									$no = 1;
									$where_bulan = "";
									$where_jenis_gudang = "";
									if($bln != 'all') $where_bulan = "and MONTH(tanggal) = '$bln'";
									if($jenis_gudang != 'all') $where_jenis_gudang = "and jenis_gudang = '$jenis_gudang'";
									$sql = $koneksi->query("select * from barang_masuk where YEAR(tanggal) = '$thn' ".$where_bulan." ".$where_jenis_gudang);
									while ($data = $sql->fetch_assoc()) {
									?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
											<td><?php echo $data['id_transaksi'] ?></td>
											<td><?php echo $data['tanggal'] ?></td>
											<td><?php echo $data['jenis_gudang'] ?></td>
											<td><?php echo $data['kode_barang'] ?></td>
											<td><?php echo $data['nama_barang'] ?></td>
											<td><?php echo $data['pengirim'] ?></td>
											<td><?php echo $data['jumlah'] ?></td>
											<td><?php echo $data['satuan'] ?></td>
                                        </tr>
									<?php }?>
					</table>	
					</body>
                                
	<?php 
	}
	?>
	
	<?php

	$koneksi = new mysqli("localhost","root","","inventori");
	

	$bln = $_POST['bln'] ;
	$thn = $_POST['thn'] ;
	$jenis_gudang = $_POST['jenis_gudang'];
	?>
	<div class="table-responsive">		
			<table  class="display table table-bordered" id="transaksi">
			
				<thead>
					<tr>
						<th>No</th>
						<th>Id Transaksi</th>
						<th>Tanggal Masuk</th>
						<th>Gudang</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Pengirim</th>
						<th>Jumlah Masuk</th>
						<th>Satuan Barang</th>
					</tr>
				</thead>
		<tbody>
									
		
		<?php
		$no = 1;
		$where_bulan = "";
		$where_jenis_gudang = "";
		if($bln != 'all') $where_bulan = "and MONTH(tanggal) = '$bln'";
		if($jenis_gudang != 'all') $where_jenis_gudang = "and jenis_gudang = '$jenis_gudang'";
		$sql = $koneksi->query("select * from barang_masuk where YEAR(tanggal) = '$thn' ".$where_bulan." ".$where_jenis_gudang);
		while ($data = $sql->fetch_assoc()) {							
		?>	
				 <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['id_transaksi'] ?></td>
					<td><?php echo $data['tanggal'] ?></td>
					<td><?php echo $data['jenis_gudang'] ?></td>
					<td><?php echo $data['kode_barang'] ?></td>
					<td><?php echo $data['nama_barang'] ?></td>
					<td><?php echo $data['pengirim'] ?></td>
					<td><?php echo $data['jumlah'] ?></td>
					<td><?php echo $data['satuan'] ?></td>
                </tr>
		<?php 
		}
		?>
		</tbody>
		</table>
		</div>
				