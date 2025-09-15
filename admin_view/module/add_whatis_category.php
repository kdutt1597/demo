<?php 
$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

 <div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
                <button type="submit" form="form-user-group" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                <a href="<?php echo base_url('admin/whatis_category'); ?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
                    <i class="fa-solid fa-reply"></i>
                </a>
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

            <div class="card-header"><i class="fa-solid fa-pencil"></i> <?php echo $page_title; ?></div>
            <div class="card-body">

                 <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">

                    <div class="row mb-3 required">
                        <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="cat_name" value="<?php echo set_value('cat_name',$cat_name); ?>" placeholder="name"  class="form-control" />

                          <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
                        </div>
                    </div>

                
                       <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Sort order</label>
                        <div class="col-sm-10">
                            <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>" placeholder=""  class="form-control" />
                        </div>
                    </div>
              

                    <div class="row mb-3">
                      <label for="input-status" class="col-sm-2 col-form-label">Status</label>
                      <div class="col-sm-10">
                          <div class="form-check form-switch form-switch-lg">
                              <input type="hidden" name="status" value="0" />
                              <input type="checkbox" name="status" value="1" id="input-status" class="form-check-input" <?php echo $status==1?'checked':''; ?> />
                          </div>
                      </div>
                  </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
