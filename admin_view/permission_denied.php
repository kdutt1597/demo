<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <h1>Permission Denied</h1>
      <ol class="breadcrumb">
      
          <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
      
      </ol>
    </div>
  </div>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header"><i class="fa-solid fa-triangle-exclamation"></i> Permission Denied</div>
      <div class="card-body">
        <p class="text-center">Permission Denied</p>
      </div>
    </div>
  </div>
</div>

<?php $this->endSection(); ?>