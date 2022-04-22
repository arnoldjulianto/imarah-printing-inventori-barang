<?php 
$jenis_gudang ="";
$id = $_GET['id'];
if(ISSET($id)) { 
  $sql = $koneksi->query("select * from jenis_gudang Where id = $id ");
  $data = $sql->fetch_assoc();
  $jenis_gudang = $data['jenis_gudang'];
}

?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><?php if(ISSET($id)) echo "Ubah";else echo "Tambah"?> Jenis Gudang</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
                  
                  
                  <div class="body">
                  
                  <form method="POST" enctype="multipart/form-data">
                  

                  <label for="">Nama Gudang</label>
                  <div class="form-group">
                     <div class="form-line">
                      <input type="text" placeholder="Masukkan Nama Gudang" name="jenis_gudang" class="form-control" requered value="<?=$jenis_gudang?>" />	 
                  </div>
                  </div>
                      <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                  </form>
                  
<?php
if (isset($_POST['simpan'])){
    if(!isset($id)){
        $jenis_gudang= $_POST['jenis_gudang'];
        $sql = $koneksi->query("insert into jenis_gudang (jenis_gudang) values('$jenis_gudang')");
        if ($sql) {
            ?>
            
                <script type="text/javascript">
                alert("Data Berhasil Disimpan");
                window.location.href="?page=jenisgudang";
                </script>
                
                <?php
        }
  }
  else{
        $jenis_gudang= $_POST['jenis_gudang'];
        $sql = $koneksi->query("update jenis_gudang set jenis_gudang = '$jenis_gudang' where id = $id");
        if ($sql) {
            ?>
            
                <script type="text/javascript">
                alert("Data Berhasil Disimpan");
                window.location.href="?page=jenisgudang";
                </script>
                
                <?php
        }
  }
}

?>
                              
                              
                              
                      
                      
                      
                      
                      
