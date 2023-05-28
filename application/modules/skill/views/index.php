
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <?php $this->load->view('includes/show_flashdata');?>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
           <div class="card">
              <div class="card-header">
                <h3 class="card-title">Job category List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableId" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        <!-- /.row -->

        
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   
   <!-- jQuery -->
<script src="<?php echo site_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo site_url('assets');?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('assets');?>/dist/js/adminlte.min.js"></script>

  <script>
  $(function () {
    $('#dataTableId').DataTable({
      "stateSave": true,
      "paging": true,
     // "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "serverSide": true,
       "ajax": {
              "url": "<?php echo base_url('skill/get_skill_list')?>",
              "type": "POST"
          }
    });

  });
  
  function change_status(e){
      var status = $(e).val();
      var id = $(e).attr('data-id');
          $.ajax({
              url: "<?php echo base_url(); ?>skill/updateSkillStatus",
              type: "post",
              data: {status:status,id:id},
              success: function(res){
                  var obj = JSON.parse(res);
                  if(obj.status == 'success'){
                //      location.reload();
                  }
              },
              error: function(err){
                  console.log(err);
              }
          });
 
  }
</script>