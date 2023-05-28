        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Document Upload</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
             <!-- Item -->
                <?php if ($this->session->flashdata('success')) { ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('success'); ?>
                  </div>
                  <?php } ?>

                  <?php if ($this->session->flashdata('error')) { ?>
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error'); ?>
                  </div>
                <?php } ?>
              <div class="row bg-white has-shadow">

                <!-- Item -->
                <div class="col-xl-3 col-sm-6">
                  Name : Test
                </div>
                <div class="col-xl-5 col-sm-6">
                  Email ID : karthick.provab@gmail.com
                </div>
                <div class="col-xl-3 col-sm-6">
                  Phone No. : 9036376616
                </div>
              </div>
              <div class="row bg-white has-shadow">

                 <form method="post" id="formProfile"  action="<?=site_url('dashboard/do_add_document');?>" class="form-horizontal"  enctype="multipart/form-data">
                <div class="form-group col-xl-12">
                  Business Licence<br>
                   <img src="<?php echo base_url(); ?>assets/images/image_place.png" width="100px" height="100px" class="img-responsive img-thumbnail user-image-trigger form-image" ><br>
                  <input type="file" name="bus_img"  accept="image/*" class="hide form-control">
                  <span class="help-block with-errors"></span>
                </div>
                <div class="form-group col-xl-12">
                  PAN Card<br>
                  <img src="<?php echo base_url(); ?>assets/images/image_place.png" width="100px" height="100px" class="img-responsive img-thumbnail user-image-triggers form-image1" ><br>
                  <input type="file" name="pan_img"  accept="image/*" class="hide form-control">
                  <span class="help-block with-errors"></span>
                </div>
                <input type="submit" name="save" class="btn btn-primary">
                </form>
              </div><br>
            </div>
          </section>

  <script type="text/javascript">
  var read_image = function(event, target) {
    $(target).attr('src', URL.createObjectURL(event.target.files[0]));
  };
   $('.form-image').on('click', function(){
            $(this).parents('.form-group').find('input[type=file]').trigger('click');
        });

        $('input[name=bus_img]').on('change', function(event) {
            if ($(this).val() !== "") {
                read_image(event, '.user-image-trigger');
            } else {
                $('.user-image-trigger').attr('src',base_url('assets/images/image_place.png'));
            }
        });
        $('.form-image1').on('click', function(){
            $(this).parents('.form-group').find('input[type=file]').trigger('click');
        });
        $('input[name=pan_img]').on('change', function(event) {
            if ($(this).val() !== "") {
                read_image(event, '.user-image-triggers');
            } else {
                $('.user-image-triggers').attr('src',base_url('assets/images/image_place.png'));
            }
        });
   
  </script>