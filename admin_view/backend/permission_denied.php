<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>
<div id="content">
 <div class="page-header">
  <div class="container-fluid">
   <div class="pull-right">
   
   </div>
   <h1><?php echo $page_title; ?></h1>
   <ul class="breadcrumb">
    <li><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
<li><a href="javascript:void();"><?php echo $page_title; ?></a></li>
   </ul>
  </div>
 </div>
 <div class="container-fluid">
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-exclamation-triangle"></i> Permission Denied!</h3>
    </div>
    <div class="panel-body">
      <p class="text-center">You do not have permission to access this page, please refer to your system administrator.</p>
    </div>
  </div>
 </div>
</div>

<?php $this->endSection(); ?>