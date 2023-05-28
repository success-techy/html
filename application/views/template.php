<?php $this->load->view('includes/header'); ?>
<?php echo put_headers(); ?>
<?php $this->load->view('includes/header_js_css'); ?>
<?php $this->load->view('includes/top_panel'); ?>
<?php $this->load->view('includes/left_panel'); ?>
<?php $this->load->view($page); ?>
<?php $this->load->view('includes/footer'); ?>
<?php echo put_footers(); ?>
<?php $this->load->view('includes/footer_js_css'); ?>	