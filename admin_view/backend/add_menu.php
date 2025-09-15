<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
use App\Models\coreModule\MenuModel;
$model = new MenuModel();
?>



<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
                <button type="submit" form="form-user" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                <a href="<?php echo base_url('admin/menu'); ?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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

              <form action="<?php echo $form_action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">


                    <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Select Menu</label>
                        <div class="col-sm-10">
                             <select name="parent_id" id="input-user-group" class="form-control">
                 <option value="">select option</option>
              
             <?php
              if(!empty($menu_list)){

               foreach ($menu_list as $key => $value){ ?>
                <option value="<?php echo $value->id; ?>" <?php echo $value->id==$parent_id?'selected':''; ?>><?php echo $value->name; ?></option>
                 <?php 
                 $level1 = $model->asObject()->where(array('parent_id'=>$value->id,'visible'=>1))->findAll();

            if ($level1) {
            foreach ($level1 as $key => $l1) {?>

                <option value="<?php echo @$l1->id; ?>" <?php echo $l1->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.@$l1->name; ?></option>


                       <?php 
                       $level2 = $model->asObject()->where(array('parent_id'=>$l1->id,'visible'=>1))->findAll();
                       if ($level2) {
                      foreach ($level2 as $key => $l2) {?>     

                        <option value="<?php echo $l2->id; ?>" <?php echo $l2->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name; ?></option>

                    <?php 
                    $level3 = $model->asObject()->where(array('parent_id'=>$l2->id,'visible'=>1))->findAll();;
                    if ($level3) {
                      foreach ($level3 as $key => $l3) {?>

                      <option value="<?php echo @$l3->id; ?>" <?php echo @$l3->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name.' > '.@$l3->name; ?></option>


                    <?php } } ?>

                    <?php }} ?>

                    <?php }} ?> 

                    <?php }} ?>



                          </select>

                        </div>
                    </div>

                    <div class="row mb-3 required">
                        <label for="input-name" class="col-sm-2 col-form-label">Menu Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="Menu Name"  class="form-control" />

                          <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
                        </div>
                    </div>


                    <div class="row mb-3 ">
                        <label for="input-name" class="col-sm-2 col-form-label">Fa fa class</label>
                        <div class="col-sm-10">
                             <input type="text" name="fafa"  value="<?php echo set_value('fafa',$fafa); ?>" id="input-image" class="form-control" placeholder="<i class='fa fa-pencil'></i>" />
                         
                        </div>
                    </div>

                      <div class="row mb-3 ">
                        <label for="input-name" class="col-sm-2 col-form-label">Link</label>
                        <div class="col-sm-10">
                             <input type="text" name="link" value="<?php echo set_value('link',$link); ?>"  placeholder="Link"  class="form-control" autocomplete="off"  />
                         
                        </div>
                    </div>

                      <div class="row mb-3 ">
                        <label for="input-name" class="col-sm-2 col-form-label">Sort Order</label>
                        <div class="col-sm-10">
                             <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>"  placeholder="Sort Order" class="form-control" autocomplete="off" />
                         
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