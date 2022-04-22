<?php 
$id = $_GET['id'];
if(ISSET($id)) { 
  $sql = $koneksi->query("Delete from jenis_gudang Where id = $id ");
}
?>
<script type="text/javascript">
    alert("Data Berhasil Dihapus");
    window.location.href="?page=jenisgudang";
</script>


