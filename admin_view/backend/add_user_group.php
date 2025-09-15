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
                <button type="submit" form="form-user-group" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
                <a href="<?php echo base_url('admin/user_group'); ?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
      <?php endif ?>s

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
                        <label for="input-name" class="col-sm-2 col-form-label">User Group Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="User Group Name"  class="form-control" />

                          <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Permission</label>
                        <div class="col-sm-10">
                            <div id="user-group-extension" class="form-control" style="height: 250px; overflow: auto;">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <td class="w-50"></td>
                                            <td class="text-center">Access</td>
                                            <!--  <td class="text-center">Modify</td> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                              <tr>
                                  <td><strong>All</strong></td>
                                  <td class="text-center">
                                      <input
                                          type="checkbox"
                                          id="input-permission-access"
                                          class="form-check-input"
                                          onchange="$('#user-group-extension input[name^=\'permission[]\']').prop('checked', $(this).prop('checked'));"
                                      />
                                  </td>
                              </tr>

                                     

            <?php if(!empty($menu_list)){ foreach ($menu_list as $key => $value){ ?>
             
                   <tr>
                      <td><label><?php echo $value->name.' > '.@$value->name; ?></label></td>
                      <td class="text-center">
                         <input type="checkbox" name="permission[]" value="<?php echo @$value->id; ?>" <?php echo @in_array($value->id, $menu_id)?'checked':''; ?> />
                   
                      </td>
                  </tr>
           
            <?php $level1 = $model->asObject()->where(array('parent_id'=>$value->id,'visible'=>1))->findAll();
            if ($level1) {
              foreach ($level1 as $key => $l1) {?>
             
                <tr>
                    <td><label><?php echo $value->name.' > '.@$l1->name; ?></label></td>
                    <td class="text-center">
                       <input type="checkbox" name="permission[]" value="<?php echo @$l1->id; ?>" <?php echo @in_array($l1->id, $menu_id)?'checked':''; ?> />
                 
                    </td>
                  </tr>

               <?php 
               $level2 = $model->asObject()->where(array('parent_id'=>$l1->id,'visible'=>1))->findAll();
               if ($level2) {
              foreach ($level2 as $key => $l2) {?>  

                   <tr>
                    <td><label><?php echo $value->name.' > '.$l1->name.' > '.$l2->name; ?></label></td>
                    <td class="text-center">
                      <input type="checkbox" name="permission[]" value="<?php echo $l2->id; ?>" <?php echo @in_array($l2->id, $menu_id)?'checked':''; ?> />
                 
                    </td>
                  </tr>

              <?php 
              $level3 = $model->asObject()->where(array('parent_id'=>$l2->id,'visible'=>1))->findAll();
              if ($level3) {
                foreach ($level3 as $key => $l3) {?>
                 
                  <tr>
                    <td><label> <?php echo $value->name.' > '.$l1->name.' > '.$l2->name.' > '.@$l3->name; ?></label></td>
                    <td class="text-center">
                       <input type="checkbox" name="permission[]" value="<?php echo @$l3->id; ?>" <?php echo @in_array($l3->id, $menu_id)?'checked':''; ?> />
                    </td>
                  </tr>

                <?php }} ?>
                <?php }} ?> 
                <?php }} ?>   
                <?php }} ?>





                          </tbody>
                        </table>
                     </div>
                   </div>
                 </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>
