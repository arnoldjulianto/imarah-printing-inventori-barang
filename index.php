
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
  <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
  <link href="vendor/bootstrap-5.2.0-beta1-dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Sweet Alert 2 -->
  <link href="vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Jquery -->
  <script src="vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand Kiri-->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=home&aksi=">
        <!-- LOGO -->
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-building"></i> -->
        </div>
        <div class="sidebar-brand-text mx-2">CV IMARA PRINTING</div>
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
        $queryMenu =  $koneksi->query("SELECT * from user_menu, user_access_menu WHERE user_menu.id_menu = user_access_menu.id_menu and level = '$level' and (user_menu.id_menu <> 1 and user_menu.id_menu <> 5) order by urutan_menu asc ");
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

	    <?php
        $page = $_GET['page'];
        $aksi = $_GET['aksi'];
        $pecah_page = explode("_", $page);
        if(!isset($aksi)) $aksi = '';
        $level = $data['level'];
        $queryMenu =  $koneksi->query("SELECT * from user_menu, user_access_menu WHERE user_menu.id_menu = user_access_menu.id_menu and level = '$level' and user_menu.id_menu = 5 order by urutan_menu asc ");
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
      <!-- Nav Item - Dashboard -->
          <a class="nav-link  <?=$collapsed?>" <?php echo $target; ?> data-target="#collapseLaporan<?= $i ?>">
                <i class="<?php echo $m['icon_1']?>"></i> 
                <span><?= $m['menu']; ?></span>
          </a>
          <?php
            $menuId = $m['id_menu'];
            $querySubMenu1 = $koneksi->query("SELECT * FROM user_sub_menu_1, user_menu, user_access_sub_menu_1 WHERE user_sub_menu_1.id_menu = user_menu.id_menu and user_menu.id_menu = '$menuId' and user_sub_menu_1.id_sub_menu_1 = user_access_sub_menu_1.id_sub_menu_1 and user_access_sub_menu_1.level = '$level' order by urutan_sub_menu_1 asc ");
            if($querySubMenu1->num_rows > 0) {
            ?>
                  <div id="collapseLaporan<?= $i; ?>" <?php echo $collapse_show ?> class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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
<?php }?>

       
	  
	  
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
         $pecah_page = explode("_", $page);
         if($aksi == "") $aksi = $page;
         if(ISSET($pecah_page[1]) ) {
           include "page/".$pecah_page[0]."/".$page.".php"; 
         }
         else {
           include "page/".$page."/".$aksi.".php";
         }
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

  <!-- Page level custom scripts -->
  <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>

    <!--script for this page-->
<script>

jQuery(document).ready(function($) {
  
});

jQuery(document).ready(function($){
  $('#Myform1').submit(function() {
    Swal.fire({
        allowOutsideClick: false,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    if($('#method').val() == 'excel') {
        window.open('page/laporan/export_laporan_barangmasuk_excel.php?'+$(this).serialize(), '_BLANK');
        Swal.close()
    }
    else{
        $.ajax({
            type: 'GET',
            url: 'page/laporan/export_laporan_barangmasuk_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung1").html(data);
              $('.table').DataTable();
              Swal.close()
            }
        });
    }
    return false;
    e.preventDefault();
  });

  $('#Myform2').submit(function() {
    Swal.fire({
        allowOutsideClick: false,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    if($('#method').val() == 'excel') {
        window.open('page/laporan/export_laporan_barangkeluar_excel.php?'+$(this).serialize(), '_BLANK');
        Swal.close()
    }
    else{
        $.ajax({
            type: 'GET',
            url: 'page/laporan/export_laporan_barangkeluar_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung2").html(data);
              $('.table').DataTable();
              Swal.close()
            }
        });
    }
    return false;
    e.preventDefault();
  });
        
  $('#Myform3').submit(function() {
    Swal.fire({
        allowOutsideClick: false,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    if($('#method').val() == 'excel') {
        window.open('page/laporan/export_laporan_barangkeluarbadstock_excel.php?'+$(this).serialize(), '_BLANK');
        Swal.close()
    }
    else{
        $.ajax({
            type: 'GET',
            url: 'page/laporan/export_laporan_barangkeluarbadstock_excel.php',
            data: $(this).serialize(),
            success: function(data) {
              $(".tampung3").html(data);
              $('.table').DataTable();
              Swal.close()
            }
        });
    }
    return false;
    e.preventDefault();
  });

});
</script>
</body>

</html>
