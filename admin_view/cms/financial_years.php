<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
               <a href="<?php echo base_url('admin/add_financial_year'); ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
              <!--<button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i class="fa fa-trash"></i></button>-->
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
    

    

      <div class="col col-lg-12 col-md-12">

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
               <?php echo form_open('admin/delete_financial_years','id="form-user"'); ?> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                 <td style="width: 1px;" class="text-start"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                   <td class="text-start">#</td>
                                  
                                   <td class="text-start">Name</td>
                                  
                                    <td class="text-start">Sort Order</td>                        
                                  <td class="text-start">Status</td>
                                 <td class="text-start">Action</td>
                                </tr>
                           
                            </thead>
                            <tbody>
                          <?php if(!empty($details)){
                           foreach ($details as $key => $value){?>
           
                             <tr>
                             <td class="text-start"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
                            <td class="text-start"><?php echo $key+1; ?></td>
                            <td class="text-start"><?php echo $value->name; ?></td>
                         
                             <td class="text-start"><?php echo $value->sortOrder; ?></td>
                             <td class="text-start"><?php echo $value->status==1?'Active':'Deactive'; ?></td>
                             <td class="text-start">
                              <a href="<?php echo base_url('admin/add_financial_year/'.$value->id); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary">
                               <i class="fa fa-pencil"></i>
                              </a>
                             </td>
                            </tr>
      
                        <?php } } ?>
                        </tbody>
                      </table>
                    </div>
                  
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php $this->endSection(); ?>

