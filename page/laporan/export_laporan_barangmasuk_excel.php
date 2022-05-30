<hr />
<?php
$koneksi = new mysqli("localhost","root","","inventori");
$tanggal1 = $_GET['tanggal1'] ;
$tanggal2 = $_GET['tanggal2'] ;
if ($_GET['method'] == 'excel' )
{
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (".date('d-m-Y').").xls");
?>	
	<center id="title">
		<h2>Laporan Barang Masuk <?php if($bln != "all") echo "Bulan ".$bln;?> Tahun <?php echo $thn;?></h2>
	</center>	                
<?php 
}?>	
<table  class="display table table-bordered " id="transaksi" style="text-align:center;font-size:15px">
		<thead>
			<tr>
				<th>No</th>
				<th>Id Transaksi</th>
				<th>Tanggal Masuk</th>
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
		$sql = $koneksi->query("select * from barang_masuk where tanggal BETWEEN '$tanggal1' and '$tanggal2' ");
		while ($data = $sql->fetch_assoc()) {							
		?>	
				 <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $data['id_transaksi'] ?></td>
					<td><?php echo $data['tanggal'] ?></td>
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
				