








 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Masuk</h6>
            </div>
            <div class="card-body">

	
<form id="Myform1" target="_BLANK">
    <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Mulai Tanggal</label>
            <input type="date" name="tanggal1" class="form-control" value="<?=date('Y-m-01')?>" />
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label>Hingga Tanggal</label>
            <input type="date" name="tanggal2" class="form-control" value="<?=date('Y-m-d')?>"  />
          </div>
        </div>

        <input type="hidden" id="method" name="method" value="" />
        <div class="col-md-3" style="display:flex;align-items:center">
            <button style="margin-right:10px" type="submit" class="btn btn-primary btn-sm" onClick="$('#method').val('')" ><i class="fa fa-filter"></i> Tampilkan</button>
            <?php if($_SESSION['level'] == 'admin' ) { ?>
              <button type="submit" class="btn btn-success btn-sm" onClick="$('#method').val('excel')"><i class="fa fa-file-excel"></i> Excel</button>
            <?php }?>  
        </div>

    </div>
</form>
    
          
   </table>
	
	<div class="tampung1"></div>

<script>
jQuery(document).ready(function($){
    Swal.fire({
        allowOutsideClick: false,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        }
    });
    $.ajax({
          type: 'GET',
          url: 'page/laporan/export_laporan_barangmasuk_excel.php',
          data: $('#Myform1').serialize(),
          success: function(data) {
            $(".tampung1").html(data);
            $('.table').DataTable();
            Swal.close()
          }
    });
});
</script>









