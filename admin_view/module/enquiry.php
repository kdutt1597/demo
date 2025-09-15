<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
            
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

<style type="text/css">
  .list-group-item{
    font-size: 14px;
    font-weight: 600;
  }
</style>
            <div class="card-header"><i class="fa-solid fa-list"></i> List</div>
            <div id="user" class="card-body">
               <?php echo form_open('admin/delete_enquiry','id="form-user"'); ?> 
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                 <td style="width: 1px;" class="text-start"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                      <td class="text-start">#</td>
                                    <td class="text-start">Name</td>
                                     <td class="text-start">Email</td>
                                     <td class="text-start">Phone</td>
                                     <td class="text-start">Solution</td>
                                     <!--<td class="text-start">TYPE</td>-->
                                     <td class="text-start">Message</td>
                                     <td class="text-start">Date</td>
                                </tr>
                           
                            </thead>
                            <tbody>
                          <?php if(!empty($detail)){
                           foreach ($detail as $key => $value){?>
           
                             <tr>
                             <td class="text-start"><input type="checkbox" name="selected[]" value="<?php echo $value->id; ?>" /></td>
                             <td class="text-start"><?php echo $key+1; ?></td>
                             <td class="text-start"><?php echo $value->name; ?></td>
                              <td class="text-start"><?php echo $value->email; ?></td>
                              <td class="text-start"><?php echo $value->phone; ?></td>
                              <td class="text-start"><?php echo $value->solution_name; ?></td>
                              <!--<td class="text-start"><?php echo $value->type; ?></td>-->
                               <td class="text-start"><?php echo substr($value->message,0,150).'...'; ?></td>
                             

                              <td class="text-start"><?php echo $value->create_date; ?></td>
                            <td class="text-start"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?php echo $value->id;?>"><I class="fa fa-eye"></I></button> </td>

                            </tr>
      



<div class="modal fade" id="staticBackdrop<?php echo $value->id;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Enquiry Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
        <li class="list-group-item">Name:  <?php echo $value->name; ?></li>
        <li class="list-group-item">Email:  <?php echo $value->email; ?></li>
        <li class="list-group-item">Phone:  <?php echo $value->phone; ?></li>
        <li class="list-group-item">Solution:  <?php echo $value->solution_name; ?></li>
        <!--<li class="list-group-item">Type:  <?php echo $value->type; ?></li>-->
        <li class="list-group-item">Message:  <?php echo $value->message; ?></li>
          <li class="list-group-item">Date:  <?php echo $value->create_date; ?></li>
      </ul>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>








                        <?php } } ?>
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

