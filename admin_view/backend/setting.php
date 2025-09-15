<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
               <!-- <a href="<?php echo base_url('admin/add_setting'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp; -->
           
            </div>
            <h1><?php echo $page_title; ?></h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
                 <li class="breadcrumb-item"><a href="<?php echo current_url(); ?>"><?php echo $page_title; ?></a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
        <?php if ($success = session()->getFlashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong><?php echo $success; ?></strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif ?>

      <?php if ($error = session()->getFlashdata('error')): ?>
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong><?php echo $success; ?></strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif ?>


            <div class="card-header"><i class="fa-solid fa-list"></i> List</div>
            <div id="user" class="card-body">
        
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                
                                  <td class="text-start">Store Name</td>
                                  <td class="text-start">Store Email</td>
                                 
                                  <td class="text-start">Action</td>
                                </tr>
                            </thead>
                            <tbody>
             
                    <tr>
                      
                        <td class="text-start"><?php echo  $config['config_name']; ?></td>
                          <td class="text-start"><?php echo  $config['config_email'] ?></td>
                                        
                        <td class="text-start"><a href="<?php echo base_url('admin/edit_setting'); ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i>&nbsp; Edit</button></a></td>
                      </tr>
                    
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-start"></div>
                        <div class="col-sm-6 text-end">Showing 1 to 1 of 1 (1 Pages)</div>
                    </div>
              
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>

