<?php
$koneksi = new mysqli("localhost","root","","inventori");
$bln = $_GET['bln'] ;
$thn = $_GET['thn'] ;

if ($_GET['method'] == 'excel' )
{?>

 <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Badstock (".date('d-m-Y').").xls");
?>	
	<center>
		<h2>Laporan Barang Badstock <?php if($bln <> "all") echo "Bulan ".$bln;?> Tahun <?php echo $thn;?></h2>
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
		</tr>
	</thead>
	<tbody>
	<?php
	$no = 1;
	$where_bulan = "";
	//$where_jenis_gudang = "";
	if($bln != 'all') $where_bulan = "and MONTH(tanggal) = '$bln'";
	//if($jenis_gudang != 'all') $where_jenis_gudang = "and jenis_gudang = '$jenis_gudang'";
	$sql = $koneksi->query("select * from barang_keluar_badstock where YEAR(tanggal) = '$thn' ".$where_bulan);
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
			</tr>
	<?php 
	}
	?>
	</tbody>
</table>
					