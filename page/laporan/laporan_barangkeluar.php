



 
 <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Laporan Barang Keluar</h6>
            </div>
            <div class="card-body">
              <form id="Myform2">
                  <div class="row form-group">
                    <div class="col-md-3">
                      <select class="form-control " name="bln">
                            <option value="all" selected="">ALL</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                      </select>
                    </div>

                    <div class="col-md-3">
                        <?php
                        $now=date('Y');
                        echo "<select name='thn' class='form-control'>";
                        for ($a=2018;$a<=$now;$a++)
                        {
                            $selected = "";
                            if($a == $now) $selected = "selected"; 
                            echo "<option value='$a' $selected >$a</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                        <input type="hidden" id="method" name="method" value="" />
                        <button style="margin-right:10px" type="submit" class="btn btn-primary btn-sm" onClick="$('#method').val('')" ><i class="fa fa-filter"></i> Tampilkan</button>
                        <button type="submit" class="btn btn-success btn-sm" onClick="$('#method').val('excel')"><i class="fa fa-file-excel"></i> Excel</button>
                  </div>
              </form>

<div class="tampung2"></div>

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
          url: 'page/laporan/export_laporan_barangkeluar_excel.php',
          data: $('#Myform2').serialize(),
          success: function(data) {
            $(".tampung2").html(data);
            $('.table').DataTable();
            Swal.close()
          }
    });
})
</script>












