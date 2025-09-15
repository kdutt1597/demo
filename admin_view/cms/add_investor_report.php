<?php 
$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
use App\Models\Cms\ProjectCategoryModel;
$model = new ProjectCategoryModel();
?>

<div id="content">
 <div class="page-header">
 <div class="container-fluid">
  <div class="float-end">
  <button type="submit" form="form-user" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
  <a href="<?php echo base_url('admin/investor_reports');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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

<li class="nav-item"><a href="#tab-equipment" data-bs-toggle="tab" class="nav-link">Reports List</a></li>
</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
    

           <div class="row mb-3 required">
                <label for="input-username" class="col-sm-2 col-form-label">Select Financial Year</label>
                <div class="col-sm-10">
                   <select name="year_id" id="project_category_id" class="form-control">
                     <option value="">Select</option>
                      <?php foreach ($yearList as $key => $value): ?>
                       <option value="<?php echo $value->id;  ?>" <?php echo $year_id==$value->id?'selected':''; ?>><?php echo $value->name; ?></option>
                     <?php endforeach ?> 
                   </select>
                    <?php echo $validation->hasError('year_id')?$validation->showError('year_id','my_single'):''; ?>
                 </div>
            </div>



          <!--<div class="row mb-3 required">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Name</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="name"  class="form-control" />-->

          <!--       <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>-->
          <!--    </div>-->
          <!--</div>-->


          <!--<div class="row mb-3 ">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Sort Order</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="sortOrder" value="<?php echo set_value('sortOrder',$sortOrder); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->
                 

           
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






<div id="tab-equipment" class="tab-pane">

<div class="table-responsive">
        <table id="equipment" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

          <td class="text-start required">Title</td>
          <td class="text-start">Image</td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($reportList)){ foreach ($reportList as $key => $row) {?>
         
         <tr id="equipment-row<?php  echo $row->id; ?>">  
            <input type="hidden" name="equipment_old_id[]" value="<?php echo $row->id; ?>" >
           
            <td class="text-left" ><input type="text" name="equipmentTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
           
             <td class="text-center " >
              <?php if (!empty($row->image)): ?>
                    <a target="_blank" href="<?php echo base_url($row->image); ?>"><i class="fa fa-file fa-3x"></i></a>
                 
                  <input type="hidden" name="feature_old_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" class="form-control" name="featureImages[]">
            </td> 


              <td class="text-right" style="width: 10%;"><input type="number" name="equipmentSortOrder[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />

             <td class="text-left"><button type="button" onclick="confirm('Are you sure to remove  this record?') && remove_row('<?php echo $row->id; ?>')" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addEquipment();" data-toggle="tooltip" title="Add Equipment" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>







</div>
</form>
</div>
</div>
</div>
</div>


<script type="text/javascript">
 

function remove_row(id){
    if(id){
        $.ajax({
            url:"<?php echo base_url('admin/remove_report'); ?>",
            type:"POST",
            data:{id:id},
            success:function(res){
               $('#equipment-row'+id).remove();
            }
        })
    }


}








 var equipment = 0;

    function addEquipment() {
    html  = '<tr id="equipment-row' + equipment + '">';
      
      html += '  <td class="text-left" ><input type="text" name="equipmentTitle[]"  placeholder="Title" class="form-control required" /></td>';

    
     html += '  <td class="text-left" ><input type="file" name="featureImages[]"  class="form-control required" /></td>';


   html += '  <td class="text-right" style="width: 10%;"><input type="number" name="equipmentSortOrder[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#equipment-row' + equipment  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#equipment tbody').append(html);

    equipment++;
  }
</script>




<?php $this->endSection(); ?>