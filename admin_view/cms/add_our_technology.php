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
  <a href="<?php echo base_url('admin/our_technology');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
<li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Why We Using</a></li>
<li class="nav-item"><a href="#tab-area" data-bs-toggle="tab" class="nav-link">Conclusion</a></li>


</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        <legend>Overview</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="title" value="<?php echo set_value('title',$title); ?>" placeholder=""  class="form-control" />
                     <?php echo $validation->hasError('title')?$validation->showError('title','my_single'):''; ?>
              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Descripton</label>
              <div class="col-sm-10">
                   <textarea name="description" class="form-control" rows="5"><?php echo set_value('description',$description); ?></textarea>

                 
              </div>
          </div>

     

         <legend>Global Technology</legend>


           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Wired Descripton</label>
              <div class="col-sm-10">
                   <textarea name="wiredDescription" class="form-control" rows="5"><?php echo set_value('wiredDescription',$wiredDescription); ?></textarea>

                 
              </div>
          </div>
         <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Wireless Descripton</label>
              <div class="col-sm-10">
                   <textarea name="wirelessDescription" class="form-control" rows="5"><?php echo set_value('wirelessDescription',$wirelessDescription); ?></textarea>

                 
              </div>
          </div>




          <legend>Why we using Wired Technology</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="atitle" value="<?php echo set_value('atitle',$atitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="adescription" class="form-control" rows="5"><?php echo set_value('adescription',$adescription); ?></textarea>
          
              </div>
          </div>

          <legend>wired and wireless security comparison</legend>

             <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Wired Security Description</label>
              <div class="col-sm-10">
                 <textarea name="wiredSecurityDescription" class="form-control ckeditor" rows="5"><?php echo set_value('wiredSecurityDescription',$wiredSecurityDescription); ?></textarea>
          
              </div>
          </div>
           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Wireless Security Description</label>
              <div class="col-sm-10">
                 <textarea name="wirelessSecurityDescription" class="form-control ckeditor" rows="5"><?php echo set_value('wirelessSecurityDescription',$wirelessSecurityDescription); ?></textarea>
          
              </div>
          </div>

           <legend>Conclusion</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="ctitle" value="<?php echo set_value('ctitle',$ctitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="cdescription" class="form-control" rows="5"><?php echo set_value('cdescription',$cdescription); ?></textarea>
          
              </div>
          </div>

            <legend>Have a Security Requirement?</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="htitle" value="<?php echo set_value('htitle',$htitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                   <input type="text" name="link" value="<?php echo set_value('link',$link); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>

         
      </fieldset>

  </div>




<div id="tab-feature" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Description</td>
          <td class="text-start">Image</td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control"><?php echo $row->description; ?></textarea></td>

            <td class="text-center">
              <?php if (!empty($row->image)): ?>
                  <img src="<?php echo base_url($row->image) ?>" width="100" height="100">

                  <input type="hidden" name="old_feature_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" class="form-control" name="featureImages[]"  id="input-image' + image_row + '" /></td>

              <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


             <td class="text-left"><button type="button" onclick="$('#image-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="4"></td>
           <td class="text-left">
            <button type="button" onclick="addFeature();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>



<!-- area -->


<div id="tab-area" class="tab-pane">

<div class="table-responsive">
        <table id="area" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Comparison</td>
            <td class="text-start ">Wired</td>
           <td class="text-start ">Wireless</td>

           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($conclusionList)){ foreach ($conclusionList as $key => $row) {?>
         
         <tr id="area-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="conclusionTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>

            <td class="text-left"><input type="text" name="wired[]" value="<?php echo $row->wired; ?>"  placeholder="Title" class="form-control" /></td>
             <td class="text-left"><input type="text" name="wireless[]" value="<?php echo $row->wireless; ?>"  placeholder="Title" class="form-control" /></td>


             <td class="text-left"><button type="button" onclick="$('#area-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addArea();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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


 var area = 0;

    function addArea() {
    html  = '<tr id="area-row' + area + '">';
    html += '  <td class="text-left"><input type="text" name="conclusionTitle[]"  placeholder="Title" class="form-control required" /></td>';

    html += '  <td class="text-left"><input type="text" name="wired[]"  placeholder="Title" class="form-control required" /></td>';

      html += '  <td class="text-left"><input type="text" name="wireless[]"  placeholder="Title" class="form-control required" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#area-row' + area  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#area tbody').append(html);

    area++;
  }




  var feature = 0;

    function addFeature() {
    html  = '<tr id="image-row' + feature + '">';
      html += '  <td class="text-left"><input type="text" name="featureTitle[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control"></textarea></td>';
    html += '  <td class="text-center"><input type="file" class="form-control" name="featureImages[]"  id="input-image' + feature + '" /></td>';

    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }

</script>



<?php $this->endSection(); ?>