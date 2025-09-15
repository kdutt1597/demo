<?php 
$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
 <div class="page-header">
 <div class="container-fluid">
  <div class="float-end">
  <button type="submit" form="form-user" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
  <a href="<?php echo base_url('admin/users');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
  <i class="fa-solid fa-reply"></i>
  </a>
</div>
<h1><?php echo $page_title; ?></h1>
  <ol class="breadcrumb"></ol>
  </div>
 </div>
  <div class="container-fluid">
  <div class="card">
  <div class="card-header"><i class="fa-solid fa-pencil"></i> <?php echo $page_title; ?></div>
 <div class="card-body">

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

 <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
<ul class="nav nav-tabs">
  <li class="nav-item"><a href="#tab-general" data-bs-toggle="tab" class="nav-link active">General</a></li>
<!--   <li class="nav-item"><a href="#tab-authorize" data-bs-toggle="tab" class="nav-link">Authorize</a></li> -->

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
          <legend>Users Details</legend>
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                  <input type="text" name="username" value="<?php echo set_value('username',$username); ?>" placeholder="Username"  class="form-control" />

                 <?php echo $validation->hasError('username')?$validation->showError('username','my_single'):''; ?>
              </div>
          </div>
          <div class="row mb-3">
              <label for="input-user-group" class="col-sm-2 col-form-label">User Group</label>
              <div class="col-sm-10">
           
                <select name="user_group_id" class="form-select" required="required">
                     <option value="">Select</option>
                   <?php foreach ($user_list as $key => $value): ?>
                    <option value="<?php echo $value->id; ?>" <?php echo $user_group_id==$value->id?'selected':''; ?> ><?php echo $value->name; ?></option>
                <?php endforeach ?>
                  </select>

                  <?php echo $validation->hasError('user_group_id')?$validation->showError('user_group_id','my_single'):''; ?>
              </div>
          </div>
          <div class="row mb-3 required">
              <label for="input-firstname" class="col-sm-2 col-form-label">First Name</label>
              <div class="col-sm-10">
                   <input type="text" name="firstname" value="<?php echo set_value('firstname',$firstname); ?>" placeholder="First Name" class="form-control" />
              <?php echo $validation->hasError('firstname')?$validation->showError('firstname','my_single'):''; ?>
              </div>
          </div>
          <div class="row mb-3 required">
              <label for="input-lastname" class="col-sm-2 col-form-label">Last Name</label>
              <div class="col-sm-10">
                 <input type="text" name="lastname" value="<?php echo set_value('lastname',$lastname); ?>" placeholder="Last Name"  class="form-control" />
          
              </div>
          </div>
          <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">E-Mail</label>
              <div class="col-sm-10">
       
                 <input type="text" name="email" value="<?php echo set_value('email',$email); ?>" placeholder="E-Mail"  class="form-control" />

              <?php echo $validation->hasError('email')?$validation->showError('email','my_single'):''; ?>
              </div>
          </div>

              <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">Photo</label>
              <div class="col-sm-10">
       
               <?php if (@$photo): ?>
                <img src="<?php echo base_url($photo); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="photo"  id="input-image" class="form-control" />
              </div>
          </div>

            
        
      </fieldset>
      <fieldset>
          <legend>Password</legend>
          <div class="row mb-3 required">
              <label for="input-password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                 <input type="password" name="password" value="<?php echo set_value('password'); ?>"  placeholder="Password"  class="form-control" autocomplete="off"  />
              </div>
          </div>
          <div class="row mb-3 required">
              <label for="input-confirm" class="col-sm-2 col-form-label">Confirm</label>
              <div class="col-sm-10">
                  <input type="password" name="confirm" value="<?php echo set_value('confirm'); ?>"  placeholder="Confirm" class="form-control" autocomplete="off" />
                   <?php echo $validation->hasError('confirm')?$validation->showError('confirm','my_single'):''; ?>
              </div>
          </div>
      </fieldset>
      <fieldset>
          <legend>Status</legend>
          <div class="row mb-3">
              <label for="input-status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                  <div class="form-check form-switch form-switch-lg">
                      <input type="hidden" name="status" value="0" />
                      <input type="checkbox" name="status" value="1" id="input-status" class="form-check-input" <?php echo $status==1?'checked':''; ?> />
                  </div>
              </div>
          </div>
      </fieldset>

  </div>



  <div id="tab-authorize" class="tab-pane">
  </div>

</div>
</form>
</div>
</div>
</div>
</div>
<?php $this->endSection(); ?>