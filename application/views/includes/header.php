<?php
if(!$_SESSION['admin_login']['is_logged']){
	redirect(base_url());
}
?>

<!DOCTYPE html>
	<html lang="en">
		<head>
		  <!-- Required meta tags -->
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <title><?php echo TITLE;?></title>
		    <!-- Google Font: Source Sans Pro -->
		  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">	  
	
	  <!-- Font Awesome Icons -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
	  <!-- overlayScrollbars -->
	  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	 
	    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="<?php //echo base_url('assets/');?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> -->

  <link rel="stylesheet" href="<?php echo base_url('assets/');?>/dist/css/adminlte.min.css">
