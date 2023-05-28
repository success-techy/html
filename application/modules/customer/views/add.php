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
              <form class="form-horizontal" id="addForm" novalidate="novalidate" method="post" action="<?php echo base_url('customer/save');?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail31" placeholder="Name" name="name" required value="<?php echo isset($info['name'])?$info['name']:"";?>"> 
                      <input type="hidden" class="form-control" placeholder="Name" name="id" value="<?php echo $id;?>"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail12" placeholder="Email" name="email" required value="<?php echo isset($info['email'])?$info['email']:"";?>">

                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail34" placeholder="Phone Number (9876546789)" name="phone" required value="<?php echo isset($info['phone'])?$info['phone']:"";?>">
                    </div>
                  </div>
                   <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">DOB</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail35" placeholder="Date of Birth (1992-02-02)" name="dob" required value="<?php echo isset($info['dob'])?$info['dob']:"";?>"> 
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Education</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail36" placeholder="Education" name="education" required value="<?php echo isset($info['education'])?$info['education']:"";?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">City</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail37" placeholder="City" name="city" required value="<?php echo isset($info['city'])?$info['city']:"";?>">
                    </div>
                  </div>
                  <div id='TextBoxesGroup'>
                    <div id="TextBoxDiv1">
                      <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Courses</label>
                     <div class="col-sm-10">

                      <select class="form-control" name="courses[]">
                        <option value="">Select course</option>
                    <?php foreach($courses as $k => $v){?>
                        <option value="<?php echo $v['id'].'_'.$v['course_id'];?>" ><?php echo '('.$v['batch_name'].') - '.$v['title'];?></option>
                  <?php  }
                  ?>
                  </select>
                </div>
              </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">

                      <input type="date" class="form-control" id="inputEmail37" placeholder="2022-09-01" name="start_date[]" min="<?php echo date('Y-m-d');?>" onchange="handler(this);">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputEmail37" placeholder="2022-09-01" name="end_date[]" value="">
                    </div>
                  </div>
                      <input type='hidden' class="form-control" id='textboxid1' name="coure_inf_id[]" value="0">
                      <input type='button' value='Remove' class='removeButton' class="form-control" >
                    </div>
                    <?php $i=0;foreach($course_data as $kk => $vv){ ?>
                        <div id="TextBoxDiv1" class="TextBoxDiv">
                      <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Courses</label>
                     <div class="col-sm-10">

                      <select class="form-control" name="courses[]">
                        <option value="">Select course</option>
                    <?php foreach($courses as $k => $v){ $selected=""; if(isset($vv['course_id']) && $vv['batch_id'].'_'.$vv['course_id'] == $v['id'].'_'.$v['course_id']){echo $selected="selected";}?>
                        <option value="<?php echo $v['id'].'_'.$v['course_id'];?>" <?php echo $selected;?>><?php echo '('.$v['batch_name'].') - '.$v['title'];?></option>
                  <?php  }
                  ?>
                  </select>
                </div>
              </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Start Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputEmail37" placeholder="2022-09-01" name="start_date[]" required value="<?php echo isset($vv['start_date'])?$vv['start_date']:"";?>" onchange="handler(this);">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">End Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputEmail37" placeholder="2022-09-01" name="end_date[]" required value="<?php echo isset($vv['end_date'])?$vv['end_date']:"";?>">
                    </div>
                  </div>
                      <input type='hidden' class="form-control" id='textboxid1' name="coure_inf_id[]" value="<?php echo $vv['id'];?>">
                      <input type='button' value='Remove' class='removeButton' class="form-control" >
                    </div>
                    <?php $i++;}?>
                  </div><br>
                      <input type='button' value='Add' id='addButton'>

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
    $('.js-example-basic-multiple').select2();
    var vl = <?php echo json_encode($sel_data); ?>;
    var vv= [];
    //console.log(vl);
    for(var i=0; i<=vl.length-1; i++){
      vv.push(vl[i]);
    }
    //$('.js-example-basic-multiple').select2('val', vv);
    $(".js-example-basic-multiple").val(vv).trigger("change");


  var counter = <?php if(isset($sel_data)&&count($sel_data)>0){ echo count($sel_data);}else{echo 2;}?>;
  $("#addButton").click(function() {
    if (counter < 2) {
      alert("Add more textbox");
      return false;
    }

    var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv' + counter).attr("class", 'TextBoxDiv');

    newTextBoxDiv.after().html(
      '<input type="hidden" id="textboxid' + counter + '" value="0" class="form-control" name="coure_inf_id[]">' +
        '<div class="form-group row">'+
                '<label class="col-sm-2 col-form-label">Courses</label>'+
               '<div class="col-sm-10">'+
                '<select class="form-control" name="courses[]" id="select' + counter + '"> <?php foreach($courses as $k => $v){?>
                        <option value="<?php echo $v['id'].'_'.$v['course_id'];?>" ><?php echo '('.$v['batch_name'].') - '.$v['title'];?></option>'+
                  '<?php  }
                  ?>'+
            '</select>'+
          '</div>'+
        '</div>'+
        '<div class="form-group row">'+
            '<label for="inputEmail3" class="col-sm-2 col-form-label">Start Date</label>'+
              '<div class="col-sm-10">'+
                '<input type="date" class="form-control" id="textbox' + counter + '" placeholder="2022-09-01" name="start_date[]" required value=""  min="<?php echo date('Y-m-d');?>" onchange="handler(this);">'+
              '</div>'+
            '</div>'+
            '<div class="form-group row">'+
              '<label for="inputEmail3" class="col-sm-2 col-form-label">End Date</label>'+
              '<div class="col-sm-10">'+
                '<input type="date" class="form-control" placeholder="2022-09-01" name="end_date[]" required value="" id="textboxBx' + counter + '">'+
              '</div>'+
            '</div><input type="button" name="button' + counter +
      '" class="removeButton" value="Remove">');

    newTextBoxDiv.appendTo("#TextBoxesGroup");

    counter++;
  });

  $("body").on("click", ".removeButton", function() {
   // console.log(counter);
    if (counter <=1) {
      alert("Atleast one course should be there");
      return false;
    }
    counter = parseInt(counter) - 1;
   // console.log($(this).closest('.TextBoxDiv'));
    $(this).closest('.TextBoxDiv').remove();
  });

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

function handler(e){
  $(e).parent().parent().next().find('input[name="end_date[]"]').attr({
       "min" : $(e).val()         
    });

  //console.log($(e));
  //console.log($(e).parent().parent().next('input[name="end_date[]"]').remove());
  //alert(e.target.value);
} 
</script>
<style type="text/css">
  .error{
    color: red;
  }
</style>