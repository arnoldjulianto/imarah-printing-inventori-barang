
<?php
mysqli_report (MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	session_start();
	$koneksi = new mysqli("localhost","root","","inventori");
	
if(empty($_SESSION['id'])){    
    header("location:login.php");
  }
?>	



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Inventaris Barang</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  <script src="vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand Kiri-->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index3.php">
        <!-- LOGO -->
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-building"></i> -->
        </div>
        <div class="sidebar-brand-text mx-2">PT. IMARA PRINTING</div>
      </a>

	  <!-- Divider -->
      <hr class="sidebar-divider my-0">
	  

 <?php
   if ($_SESSION['id']) {
	   $user = $_SESSION['id'];
   }
   $sql =$koneksi->query("select * from users where id='$user'");
   $data = $sql->fetch_assoc();
   ?>

  

  <!--sidebar start-->

    <li class="d-flex align-items-center justify-content-center">
        <a class="nav-link">
		 <img src="img/<?php echo $data['foto']?>" class="img-circle" alt="User" style="width:80px;height:80px;object-fit:cover;border-radius: 80px;"/></a>
		  <li class="d-flex align-items-center justify-content-left">
		  </li>
	  </li>
		 <li class="nav-item ">
        <a class="nav-link">
         	<div class="d-flex align-items-center justify-content-center" class="name">  <?php echo  $data['nama'];?></div></font>
			<div class="d-flex align-items-center justify-content-center" class="email"><?php echo $data['level'];?></div>
		 </a>
      </li>
      <?php
        $page = $_GET['page'];
        $aksi = $_GET['aksi']; 
        if(!isset($aksi)) $aksi = '';
        $level = $data['level'];
        $queryMenu =  $koneksi->query("SELECT * from user_menu, user_access_menu WHERE user_menu.id_menu = user_access_menu.id_menu and level = '$level' and user_menu.id_menu = 1 order by urutan_menu asc ");
          $i = 1;
          while ($m = $queryMenu->fetch_assoc()) {
              $menu = $m['id_menu'];

              if ($m['url'] == '') {
                  $target = 'href="#"  data-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo'.$i.'"  ';
                  $collapsed = "collapsed";
              } else {
                  $target = 'href="' .$m['url']. '"  ';
                  $collapsed = "";
              }
              $queryCekURLMenu = $koneksi->query("SELECT * from user_menu where url = '?page=$page&aksi=$aksi' and user_menu.id_menu = '$menu'");
              $CekURLMenu = $queryCekURLMenu->num_rows;

              if ($CekURLMenu > 0 ) {
                  echo '<li class="nav-item active">';
                  $collapse_show = 'class = "collapse show"';
                  $collapsed = "";
              } 
              else {
                  echo '<li class="nav-item">';
                  $collapse_show = 'class = "collapse" ';
                  $collapsed = "collapsed";
              }   
    ?>
      <!-- Nav Item - Dashboard -->
          <a class="nav-link  <?=$collapsed?>" <?php echo $target; ?> data-target="#collapseTwo<?= $i ?>">
                <i class="<?php echo $m['icon_1']?>"></i> 
                <span><?= $m['menu']; ?></span>
          </a>
      </li>
<?php }?>  

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pilih Menu
      </div>
	 
      <!-- Nav Item - Pages Collapse Menu -->
      <?php
        $page = $_GET['page'];
        $aksi = $_GET['aksi']; 
        if(!isset($aksi)) $aksi = '';
        $level = $data['level'];
        $queryMenu =  $koneksi->query("SELECT * from user_menu, user_access_menu WHERE user_menu.id_menu = user_access_menu.id_menu and level = '$level' and user_menu.id_menu <> 1 order by urutan_menu asc ");
          $i = 1;
          while ($m = $queryMenu->fetch_assoc()) {
              $menu = $m['id_menu'];

              if ($m['url'] == '') {
                  $target = 'href="#"  data-toggle="collapse" aria-expanded="true" aria-controls="collapseTwo'.$i.'"  ';
                  $collapsed = "collapsed";
              } else {
                  $target = 'href="' .$m['url']. '"  ';
                  $collapsed = "";
              }
              $queryCekURLMenu = $koneksi->query("SELECT * from user_menu where url = '?page=$page&aksi=$aksi' and user_menu.id_menu = '$menu'");
              $CekURLMenu = $queryCekURLMenu->num_rows;

              $queryCekURLSubMenu = $koneksi->query("SELECT * from user_menu, user_sub_menu_1 where url_sub_menu_1 = '?page=$page&aksi=$aksi' and user_menu.id_menu = '$menu' and user_menu.id_menu = user_sub_menu_1.id_menu order by urutan_sub_menu_1 asc ");
              $CekURLSubMenu = $queryCekURLSubMenu->num_rows;
              if ($CekURLSubMenu > 0 || $CekURLMenu > 0 ) {
                  echo '<li class="nav-item active">';
                  $collapse_show = 'class = "collapse show"';
                  $collapsed = "";
              } 
              else {
                  echo '<li class="nav-item">';
                  $collapse_show = 'class = "collapse" ';
                  $collapsed = "collapsed";
              }   
      ?>       
            <a class="nav-link  <?=$collapsed?>" <?php echo $target; ?> data-target="#collapseTwo<?= $i ?>">
                <i class="<?php echo $m['icon_1']?>"></i> 
                <span><?= $m['menu']; ?></span>
            </a>
            <!-- looping submenu, siapkan subemenu sesuai menu-->
            <?php
            $menuId = $m['id_menu'];
            $querySubMenu1 = $koneksi->query("SELECT * FROM user_sub_menu_1, user_menu, user_access_sub_menu_1 WHERE user_sub_menu_1.id_menu = user_menu.id_menu and user_menu.id_menu = '$menuId' and user_sub_menu_1.id_sub_menu_1 = user_access_sub_menu_1.id_sub_menu_1 and user_access_sub_menu_1.level = '$level' order by urutan_sub_menu_1 asc ");
            if($querySubMenu1->num_rows > 0) {
            ?>
                  <div id="collapseTwo<?= $i; ?>" <?php echo $collapse_show ?> class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <h6 class="collapse-header">Menu:</h6>
                          <?php while ($sm1 = $querySubMenu1->fetch_assoc()) {
                              $subMenuId = $sm1['id_sub_menu_1'];
                              $link = '?page='.$page.'&aksi='.$aksi;
                              ?>
                                  <?php if ( $link == $sm1['url_sub_menu_1']) : ?>
                                      <a class="collapse-item active" href="<?= $sm1['url_sub_menu_1']; ?>">
                                  <?php else : ?>
                                      <a class="collapse-item" href="<?=$sm1['url_sub_menu_1']; ?>">
                                  <?php endif; ?>
                                          <?= $sm1['nama_sub_menu']; ?>
                                      </a>
                          <?php } ?>
                      </div>    
                  </div>
            <?php }?>
        </li>  
      <?php
        $i++;
      } ?>

	    
	  
	      <!-- Heading -->
      <div class="sidebar-heading">
        Laporan
      </div>

	    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
          <i class="fas fa-fw fa-folder"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu Laporan:</h6>
            <a class="collapse-item" href="?page=laporan_supplier">Supplier</a>
            <a class="collapse-item" href="?page=laporan_gudang">Stok Gudang Impro</a>
            <a class="collapse-item" href="?page=laporan_gudangimprint">Stok Gudang Imprint</a>
            <a class="collapse-item" href="?page=laporan_barangmasuk">Barang Masuk Impro</a>
            <a class="collapse-item" href="?page=laporan_barangmasukimprint">Barang Masuk Imprint</a>
            <a class="collapse-item" href="?page=laporan_barangkeluar">Barang Keluar Impro</a>
            <a class="collapse-item" href="?page=laporan_barangkeluarimprint">Barang Keluar Imprint</a>             
            <a class="collapse-item" href="?page=laporan_badstockimpro">Bad Stock Impro</a>
            <a class="collapse-item" href="?page=laporan_badstockimprint">Bad Stock Imprint</a>
          </div>
        </div>
      </li>

       
	  
	  
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

		<!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
			 <div class="top-menu">
        <ul class="nav pull-right top-menu">
		
           <li><a onclick="return confirm('Apakah anda yakin akan logout?')" class="btn btn-danger" class="logout" href="logout.php">Keluar</a></li>
        </ul>
      </div>
             
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
		
		 <section class="content">
	
	
		      <?php
			   $page = $_GET['page'];
			   $aksi = $_GET['aksi'];
         if($aksi == "") $aksi = $page;
         include "page/".$page."/".$aksi.".php";
			   ?>
    

    </section>

 
</div>
      <!-- End of Main Content -->
  
   <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>-Sistem Informasi Inventaris Barang Imarah Printing-</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->

 <!-- Bootstrap core JavaScript-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  
    <!--script for this page-->
<script>

jQuery(document).ready(function($) {
   $('#cmb_jenis_gudang').change(function() { // Jika Select Box id provinsi dipilih
     $('.kode_barang_area').html('');
     var jenis_gudang = $('#cmb_jenis_gudang').val(); // Ciptakan variabel provinsi
     var kode_barang = "<?php if(ISSET($kode_barang)) echo $kode_barang?>"; // Ciptakan variabel provinsi
     $.ajax({
        type: 'POST', // Metode pengiriman data menggunakan POST
        url: 'page/barangmasuk/get_jenis_barang.php', // File yang akan memproses data
        data: 'jenis_gudang=' + jenis_gudang+'&kode_barang=' + kode_barang, // Data yang akan dikirim ke file pemroses
        success: function(data) { // Jika berhasil
            $('.kode_barang_area').html(data); // Berikan hasil ke id kota
        }
    });
  });
});

jQuery(document).ready(function($) {
  $('.tampung').html('')
   $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
     var tamp = $(this).val(); // Ciptakan variabel provinsi
     $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_barang.php', // File yang akan memproses data
         data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
         success: function(data) { // Jika berhasil
              $('.tampung').html(data); // Berikan hasil ke id kota
            }
           
     
    });
  });
});

jQuery(document).ready(function($) {
  $('.tampung1').html('');
   $('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
     var tamp = $(this).val(); // Ciptakan variabel provinsi
     $.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
         data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
         success: function(data) { // Jika berhasil
              $('.tampung1').html(data); // Berikan hasil ke id kota
            }
           
     
    });
});
});

jQuery(document).ready(function($){
        $(function(){
    $('#Myform1').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_barangmasuk_excel.php',
            data: $(this).serialize(),
            success: function(data) {
             $(".tampung1").html(data);
             $('.table').DataTable();

            }
        });

        return false;
         e.preventDefault();
        });
    });
});

  jQuery(document).ready(function($){
        $(function(){
    $('#Myform2').submit(function() {
        $.ajax({
            type: 'POST',
            url: 'page/laporan/export_laporan_barangkeluar_excel.php',
            data: $(this).serialize(),
            success: function(data) {
             $(".tampung2").html(data);
             $('.table').DataTable();

            }
        });

        return false;
         e.preventDefault();
        });
    });
});
</script>
</body>

</html>
