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
              <form class="form-horizontal" id="addForm" novalidate="novalidate" method="post" action="<?php echo base_url('job/save');?>">
                <div class="card-body">
                  <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="id"  value="<?php echo $id; ?>">
                  <select class="custom-select form-control-border border-width-2" id="type" name="type" onchange="change_status(this)" required> 
                    <option value="">Select Category</option>
                   <?php foreach($batch as $k => $v){?>
                    <option value="<?php echo $v['id'];?>" <?php echo isset($info['type']) && $v['id']==$info['type']?'selected':'';?>><?php echo $v['name'];?></option>
                   <?php }?>
                  </select>
                </div>
                </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Job Title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail215" placeholder="Title" name="title" required value="<?php echo isset($info['title'])?$info['title']:"";?>"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                      <textarea id="myTextarea" class="form-control" id="inputEmail36" placeholder="Short Description" name="description" rows="15" required><?php echo isset($info['description'])?$info['description']:"";?></textarea>

                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Min Experience</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail215" placeholder="Min Experience" name="start_exp" required value="<?php echo isset($info['start_experience'])?$info['start_experience']:"";?>"> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Max Experience</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail215" placeholder="Max Experience" name="end_exp" required value="<?php echo isset($info['end_experience'])?$info['end_experience']:"";?>"> 
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Job Location</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail215" placeholder="Job Location" name="city" required value="<?php echo isset($info['city'])?$info['city']:"";?>"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Company Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail215" placeholder="Company Name" name="company_name" required value="<?php echo isset($info['company_name'])?$info['company_name']:"";?>"> 
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
<script src="<?php echo site_url('assets');?>/tinymce/tinymce.min.js"></script>

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
    tinymce.init({
    selector: '#myTextarea'
});
    $('.js-example-basic-multiple').select2();
   
   /*var vl = <?php //echo json_encode($sel_data); ?>;
    var vv= [];
    console.log(vl);
    for(var i=0; i<=vl.length-1; i++){
      vv.push(vl[i]);
    }
    //$('.js-example-basic-multiple').select2('val', vv);
    $(".js-example-basic-multiple").val(vv).trigger("change");*/

    //$(".js-example-basic-multiple").val(vv).trigger("change");

   var id = $('#batch').val();
 /*  var sel = 0;
      if(id!=''){
          $.ajax({
              url: "<?php echo base_url(); ?>schedule/getCourseList",
              type: "post",
              data: {id:id},
              success: function(res){
                  var obj = JSON.parse(res);
                  let opt;
                  for(let i=0; i<=obj.length-1; i++){
                    let sel_txt = sel==obj[i]["id"]?"selected":"";
                  opt = opt+ '<option value="'+obj[i]['id']+'"'+sel_txt+'>'+obj[i]['title']+'</option>';
                  }
                  $('#course').html(opt);

              },
              error: function(err){
                  console.log(err);
              }
          });
      }else{
        $('#course').html('');
      }*/
 });
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
function change_status(e){
      var id = $(e).val();
      if(id!=''){
          $.ajax({
              url: "<?php echo base_url(); ?>schedule/getCourseList",
              type: "post",
              data: {id:id},
              success: function(res){
                $('#course').html("");
                  var obj = JSON.parse(res);
                  let opt;
                  for(let i=0; i<=obj.length-1; i++){
                    opt = opt+ '<option value="'+obj[i]['id']+'">'+obj[i]['title']+'</option>';
                  }
                  $('#course').html(opt);
              },
              error: function(err){
                  console.log(err);
              }
          });
      }else{
        $('#course').html('');
      }
 
  }
</script>
<style type="text/css">
  .error{
    color: red;
  }
</style>