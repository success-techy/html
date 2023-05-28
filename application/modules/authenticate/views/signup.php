<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Deals</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Deals</h1>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
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
                  <form action="<?=base_url('authenticate/register')?>" method="post" role="form" class="form-validate"> 
                    <div class="form-group">
                      <input id="login-username" type="text" name="full_name" required data-msg="Please enter your Full Name" class="input-material">
                      <label for="login-username" class="label-material">Name</label>
                    </div>

                  <?=form_error('email')?>
                    <div class="form-group">
                      <input id="login-emailid" type="email" name="email" required data-msg="Please enter your Email Id" class="input-material">
                      <label for="login-username" class="label-material">Email ID</label>
                    </div>
                    <?=form_error('password')?>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div>
                    <div class="form-group">
                      <input id="login-conpasswordd" type="password" name="confirm_password" required data-msg="Please enter your confirm password" class="input-material">
                      <label for="login-password" class="label-material">Confirm Password</label>
                    </div>
                    <div class="form-group">
                      <input id="login-mobile" type="number" name="mobile" required data-msg="Please enter your Mobile Number" class="input-material" minlength="10" maxlength="15">
                      <label for="login-username" class="label-material">Mobile Number</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form><a href="<?=base_url('authenticate/reset')?>" class="forgot-pass">Forgot Password?</a><br><small>Already have an account? </small><a href="<?=base_url('authenticate/login')?>" class="signup">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
       <!--  <p>Design by <a href="https://bootstrapious.com/p/admin-template" class="external">Bootstrapious</a> -->
          <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="<?php echo base_url(); ?>assets/js/front.js"></script>
  </body>
</html>