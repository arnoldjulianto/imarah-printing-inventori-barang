<?php
$koneksi = new mysqli("localhost","root","","inventori");
$tanggal1 = $_GET['tanggal1'] ;
$tanggal2 = $_GET['tanggal2'] ;
if ($_GET['method'] == 'excel' )
{?>

 <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Badstock (".date('d-m-Y').").xls");
?>	
	<center>
		<h2>Laporan Barang Badstock Mulai Tanggal <?=$tanggal1?> Hingga Tanggal <?=$tanggal2?></h2>
	</center>   
<?php 
}
?>
<table  class="display table table-bordered" id="transaksi" style="text-align:center;font-size:15px" >					
	<thead>
		<tr>
			<th>No</th>
			<th>Id Transaksi</th>
			<th>Tanggal Keluar</th>
			<th>No. SPK</th>
			<th>Kode Barang</th>
			<th>Nama Barang</th>			
			<th>Jumlah Badstock</th>
			<th>Satuan Barang</th>
			<th>Tujuan</th>
			<th>Diinput Oleh</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	$sql = $koneksi->query("select * from barang_keluar_badstock join users on users.id = barang_keluar_badstock.id_user where tanggal BETWEEN '$tanggal1' and '$tanggal2' ");
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
			<td><?php echo $data['keterangan'] ?></td>
			<td><?php echo $data['username'] ?></td>
			</tr>
	<?php 
	}
	?>
	</tbody>
</table>
					