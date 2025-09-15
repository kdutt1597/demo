<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation();
use App\Models\coreModule\FrontMenuModel;
$model = new FrontMenuModel();


?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
               <a href="<?php echo base_url('admin/add_front_menu'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
              <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash"></i></button>
            </div>
            <h1><?php echo $page_title; ?></h1>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
                 <li class="breadcrumb-item"><a href="javascript:void();"><?php echo $page_title; ?></a></li>
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
               <?php echo form_open('admin/delete_front_menu','id="form-user"'); ?> 
           <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">Name</td>
                  <td class="text-left">Link</td>
                  <td class="text-left">Status</td>
                  <td class="text-left">Sort Order</td>
                  <td class="text-left">Action</td>
                </tr>
                           
                </thead>
                <tbody>
              <?php if (!empty($detail)): ?>
         <?php foreach ($detail as $key => $value){  ?>
           
         <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name; ?></td>
         <td class="text-left"><?php echo $value->link; ?></td>
         <td class="text-left"><?php echo $value->status==1?'Active':'Deactive'; ?></td>

         <td class="text-right"><?php echo $value->sort_order; ?></td>
         <td class="text-right">
          <a href="<?php echo base_url('admin/add_front_menu/'.$value->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>

            <?php 
            $level1 = $model->asObject()->where(array('parent_id'=>$value->id))->orderBy('sort_order','asc')->findAll();
         
            if ($level1) {
              foreach ($level1 as $key => $l1) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l1->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name; ?></td>
              <td class="text-left"><?php echo $l1->link; ?></td>
             <td class="text-left"><?php echo $l1->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l1->sort_order; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_front_menu/'.$l1->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
               <i class="fa fa-pencil"></i>
              </a>
             </td>
            </tr>

            <?php 
            $level2 = $model->asObject()->where(array('parent_id'=>$l1->id))->orderBy('sort_order','asc')->findAll();
            if ($level2) {
              foreach ($level2 as $key => $l2) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name; ?></td>
              <td class="text-left"><?php echo $l2->link; ?></td>
             <td class="text-left"><?php echo $l2->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l2->sort_order; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_front_menu/'.$l2->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
               <i class="fa fa-pencil"></i>
              </a>
             </td>
            </tr>


             <?php 
            $level3 = $model->asObject()->where(array('parent_id'=>$l2->id))->orderBy('sort_order','asc')->findAll();
            if ($level3) {
              foreach ($level3 as $key => $l3) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name.' > '.$l3->name; ?></td>
              <td class="text-left"><?php echo $l3->link; ?></td>
             <td class="text-left"><?php echo $l3->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l3->sort_order; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_front_menu/'.$l3->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
               <i class="fa fa-pencil"></i>
              </a>
             </td>
            </tr>
             <?php } } ?> 

            <?php } } ?>

            <?php } } ?>

           <?php } ?>

           <?php endif ?>
                        </tbody>
                      </table>
                    </div>
                  

                 <div class="row">
               
                  <div class="col-sm-6 text-start">
                    <ul class="pagination">
                    <?php if ($pager):?>    
                      <?= $pager->makeLinks($page,$perPage, $total) ?>
                     <?php endif; ?>
                    </ul>
                   </div>
                  <div class="col-sm-6 text-end">Showing <?php echo $offset; ?> to <?php echo $offset+count($detail); ?> of <?php echo $total; ?> (<?php echo $pages; ?> Pages)
                  </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>

