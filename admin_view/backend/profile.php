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
                        <label for="input-name" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="<?php echo set_value('username',$detail->username); ?>" placeholder="Username"  class="form-control" />

                          <?php echo $validation->hasError('username')?$validation->showError('username','my_single'):''; ?>
                        </div>
                    </div>

                      <div class="row mb-3 required">
                        <label for="input-name" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="firstname" value="<?php echo set_value('firstname',$detail->firstname); ?>" placeholder="First Name" class="form-control" />
                         <?php echo $validation->hasError('firstname')?$validation->showError('firstname','my_single'):''; ?>
                        </div>
                    </div>

                      <div class="row mb-3 ">
                        <label for="input-name" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                             <input type="text" name="lastname" value="<?php echo set_value('lastname',$detail->lastname); ?>" placeholder="Last Name"  class="form-control" />
                            <?php echo $validation->hasError('lastname')?$validation->showError('lastname','my_single'):''; ?> 
                        </div>
                    </div>

                      <div class="row mb-3 required">
                        <label for="input-name" class="col-sm-2 col-form-label">E-Mail</label>
                        <div class="col-sm-10">
                           <input type="text" name="email" value="<?php echo set_value('email',$detail->email); ?>" placeholder="E-Mail"  class="form-control" />

                          <?php echo $validation->hasError('email')?$validation->showError('email','my_single'):''; ?>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Profile Photo</label>
                        <div class="col-sm-10">
                          <?php if (@$detail->photo): ?>
                          <img src="<?php echo base_url($detail->photo); ?>" width="100" height="100">
                        <?php endif ?>
                        <input type="file" name="photo"  id="input-image" class="form-control" />
                        </div>
                    </div>


                      <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" value="<?php echo set_value('password'); ?>"  placeholder="Password"  class="form-control" autocomplete="off"  />
                             <?php echo $validation->hasError('password')?$validation->showError('password','my_single'):''; ?>
                        </div>
                    </div>


                      <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                           <input type="password" name="confirm" value="<?php echo set_value('confirm'); ?>"  placeholder="Confirm" class="form-control" autocomplete="off" />
                        <?php echo $validation->hasError('confirm')?$validation->showError('confirm','my_single'):''; ?>
                        </div>
                    </div>

                    
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
