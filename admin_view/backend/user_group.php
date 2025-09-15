<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
               <a href="<?php echo base_url('admin/add_user_group'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
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
               <?php echo form_open('admin/delete_user_group','id="form-user"'); ?> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                         
                                <td class="text-start">User group Name</td>
                            
                                <td class="text-start">Action</td>
                              </tr>
                           
                            </thead>
                            <tbody>
                          <?php if(!empty($detail)){
                            foreach ($detail as $key => $value) { ?>
                            <tr>
                            <td class="text-center"> 
                            <input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" />
                              </td>
                      
                             <td class="text-start"><?= $value->name; ?></td>

                            <td class="text-right"><a href="<?php echo base_url('admin/add_user_group/'.$value->id); ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil"></i>&nbsp; Edit</button></a></td>
                          </tr>
                        <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-start"></div>
                        <div class="col-sm-6 text-end">Showing 1 to <?php echo $totals; ?> of <?php echo $totals; ?> (1 Pages)</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>

