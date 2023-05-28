  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
      <div class="col-md-8">
     <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title;?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" id="addForm" novalidate="novalidate" method="post" action="<?php echo base_url('skill/save');?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail31" placeholder="Name" name="name" required value="<?php echo isset($info['name'])?$info['name']:"";?>"> 
                      <input type="hidden" class="form-control" placeholder="Name" name="id" value="<?php echo $id;?>"> 
                    </div>
                  </div>
                  <button type="submit" class="btn btn-info">Save</button>
                </div>
              </form>
            </div>
            </div>
    </section>
    <!-- /.content -->
  </div>
   
   <!-- jQuery -->
<script src="<?php echo site_url('assets');?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo site_url('assets');?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo site_url('assets');?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo site_url('assets');?>/plugins/jquery-validation/additional-methods.min.js"></script><!-- AdminLTE App -->
<script src="<?php echo site_url('assets');?>/dist/js/adminlte.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style type="text/css">
  .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
    cursor: default;
    padding-left: 2px;
    padding-right: 5px;
    color: black;
}
</style>
<script>
  $(document).ready(function() {
    var vl = <?php echo json_encode($sel_data); ?>;
    var vv= [];
    for(var i=0; i<=vl.length-1; i++){
      vv.push(vl[i]);
    }
    //$('.js-example-basic-multiple').select2('val', vv);
    $(".js-example-basic-multiple").val(vv).trigger("change");

    $('.js-example-basic-multiple').select2();
  });
  </script>
<script>

$(function () {
 /* $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });*/
  $('#addForm').validate({
    
    errorElement: 'span',
   /* errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },*/
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
<style type="text/css">
  .error{
    color: red;
  }
</style>