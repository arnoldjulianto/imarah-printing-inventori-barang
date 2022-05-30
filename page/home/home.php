<?php
$koneksi = new mysqli("localhost","root","","inventori");
$users = mysqli_query($koneksi, "select id from users");
$total_users = mysqli_num_rows($users);

$supplier = mysqli_query($koneksi, "select id from tb_supplier");
$total_supplier = mysqli_num_rows($supplier);

$gudang = mysqli_query($koneksi, "select id from gudang");
$total_gudang = mysqli_num_rows($gudang);

$barang_masuk = mysqli_query($koneksi, "select id from barang_masuk");
$total_barang_masuk = mysqli_num_rows($barang_masuk);

$barang_keluar = mysqli_query($koneksi, "select id from barang_keluar");
$total_barang_keluar = mysqli_num_rows($barang_keluar);

$barang_keluar_badstock = mysqli_query($koneksi, "select id from barang_keluar_badstock");
$total_barang_keluar_badstock = mysqli_num_rows($barang_keluar_badstock);
?>
       <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
           
          </div>
			<h3>Selamat Datang di Sistem Informasi Inventaris Barang</h3>
		  <br></br>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a  href="?page=pengguna"> 
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <h5>Data Users</h5>
                            <h4><?=$total_users?></h4>
                          </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			
			  <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                     <a  href="?page=supplier"> 
                       <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                         <h5>Data Supplier</h5>
                         <h4><?=$total_supplier?></h4>
                        </div>
                      </a>  
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-industry fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                     <a  href="?page=gudang">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            <h5>Data Gudang</h5>
                            <h4><?=$total_gudang?></h4>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          
                          </div>
                          <div class="col">
                          
                          </div>
                        </div>
                      </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-warehouse fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

			
			 <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a  href="?page=barangmasuk">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <h5>Barang Masuk</h5>
                            <h4><?=$total_barang_masuk?></h4>
                          </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a  href="?page=barangkeluar">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                              <h5>Barang Keluar</h5>
                              <h4><?=$total_barang_keluar?></h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-truck fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-dark shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a  href="?page=barangkeluarbadstock">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                              <h5>Barang Badstock</h5>
                              <h4><?=$total_barang_keluar_badstock?></h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-thumbs-down fa-2x text-black-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			
		
		
			
			
          </div>