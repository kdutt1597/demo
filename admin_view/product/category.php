<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
use App\Models\cms\ProductCategoryModel;
$model = new ProductCategoryModel();
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
               <a href="<?php echo base_url('admin/add_category'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
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
      <div class="row">
        
        <div id="filter-product" class="col-lg-3 col-md-12 order-lg-last d-none d-lg-block mb-3">
        <div class="card">

          <div class="card-header"><i class="fa-solid fa-filter"></i> Filter</div>
          <div class="card-body">
            <form action="<?php echo base_url('admin/category') ?>" method="get">
            <div class="mb-3">
              <label for="input-name" class="form-label">Name</label>
              <input type="text" name="name" value="<?php echo @$_GET['name']; ?>" placeholder="Name" id="input-name" class="form-control" autocomplete="off"/>
              <ul id="autocomplete-name" class="dropdown-menu"></ul>
            </div>
         
            <div class="text-end">
              <button type="submit" id="button-filter" class="btn btn-info"><i class="fa-solid fa-filter"></i> Filter</button>&nbsp;

              <a href="<?php echo base_url('admin/category'); ?>"><button type="button" id="button-filter" class="btn btn-light"><i class="fa-solid fa-filter"></i> Reset</button></a>
            </div>
            </form>
          </div>

        </div>
      </div>


      


      <div class="col col-lg-9 col-md-12">

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
               <?php echo form_open('admin/delete_category','id="form-user"'); ?> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                 <td style="width: 1px;" class="text-start"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                   
                                   <td class="text-start">Name</td>
                                    <td class="text-start">Slug</td>                                                                
                                  <td class="text-start">Status</td>
                                   <td class="text-start">Sort Order</td>
                                 <td class="text-start">Action</td>
                                </tr>
                           
                            </thead>
                            <tbody>
               <?php if (!empty($detail)): ?>
         <?php foreach ($detail as $key => $value){  ?>
           
         <tr>
         <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
         <td class="text-left"><?php echo $value->name; ?></td>
         <td class="text-left"><?php echo $value->slug; ?></td>
         <td class="text-left"><?php echo $value->status==1?'Active':'Deactive'; ?></td>

         <td class="text-right"><?php echo $value->sortOrder; ?></td>
         <td class="text-right">
          <a href="<?php echo base_url('admin/add_category/'.$value->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
           <i class="fa fa-pencil"></i>
          </a>
         </td>
        </tr>

            <?php 
            $level1 = $model->asObject()->where(array('parent'=>$value->id))->orderBy('sortOrder','asc')->findAll();
         
            if ($level1) {
              foreach ($level1 as $key => $l1) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l1->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name; ?></td>
              <td class="text-left"><?php echo $l1->slug; ?></td>
             <td class="text-left"><?php echo $l1->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l1->sortOrder; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_category/'.$l1->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
               <i class="fa fa-pencil"></i>
              </a>
             </td>
            </tr>

            <?php 
            $level2 = $model->asObject()->where(array('parent'=>$l1->id))->orderBy('sortOrder','asc')->findAll();
            if ($level2) {
              foreach ($level2 as $key => $l2) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name; ?></td>
              <td class="text-left"><?php echo $l2->slug; ?></td>
             <td class="text-left"><?php echo $l2->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l2->sortOrder; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_category/'.$l2->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
               <i class="fa fa-pencil"></i>
              </a>
             </td>
            </tr>


             <?php 
            $level3 = $model->asObject()->where(array('parent'=>$l2->id))->orderBy('sortOrder','asc')->findAll();
            if ($level3) {
              foreach ($level3 as $key => $l3) {?>
                
            <tr>
             <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $l2->id; ?>" /></td>
             <td class="text-left"><?php echo $value->name.'  >  '.$l1->name.' > '.$l2->name.' > '.$l3->name; ?></td>
              <td class="text-left"><?php echo $l3->slug; ?></td>
             <td class="text-left"><?php echo $l3->status==1?'Active':'Deactive'; ?></td>
          
             <td class="text-right"><?php echo $l3->sortOrder; ?></td>
             <td class="text-right">
              <a href="<?php echo base_url('admin/add_category/'.$l3->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
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
                      <?php echo $pager->links(); ?>
                       <?php endif; ?>
                      </ul>
                      </div>
                      <div class="col-sm-6 text-end">Showing <?php echo $offset; ?> to <?php echo $offset+count($detail); ?> of <?php echo $total; ?> (<?php echo $pages; ?> Pages)</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php $this->endSection(); ?>

