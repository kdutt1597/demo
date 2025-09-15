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
  <a href="<?php echo base_url('admin/electronic_heading');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
<li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Benafits</a></li>
<li class="nav-item"><a href="#tab-area" data-bs-toggle="tab" class="nav-link">Collection</a></li>


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

     

         <legend>Benefits of E-waste Recycling </legend>

              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="benafitTitle" value="<?php echo set_value('benafitTitle',$benafitTitle); ?>" placeholder=""  class="form-control" />
                 
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if (!empty($benafitImage)): ?>
                    <img src="<?php echo base_url($benafitImage); ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="benafitImage"  placeholder=""  class="form-control" />

              </div>
          </div>


         <legend>Collection Mechanism of E-waste </legend>

              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="mechanismTitle" value="<?php echo set_value('mechanismTitle',$mechanismTitle); ?>" placeholder=""  class="form-control" />
                 
              </div>
          </div>

              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if (!empty($collectionImage)): ?>
                    <img src="<?php echo base_url($collectionImage); ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="collectionImage"  placeholder=""  class="form-control" />

              </div>
          </div>

         <legend>Do’s & Don’ts </legend>

           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Do’s</label>
              <div class="col-sm-10">
                   <textarea name="doDescription" class="form-control ckeditor" rows="5"><?php echo set_value('doDescription',$doDescription); ?></textarea>

                 
              </div>
          </div>
         <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Don’t</label>
              <div class="col-sm-10">
                   <textarea name="dontDescription" class="form-control ckeditor" rows="5"><?php echo set_value('dontDescription',$dontDescription); ?></textarea>

                 
              </div>
          </div>




          <legend>Collection Center List </legend>




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

         
      </fieldset>

  </div>




<div id="tab-feature" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Description</td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control"><?php echo $row->description; ?></textarea></td>


              <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


             <td class="text-left"><button type="button" onclick="$('#image-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
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

           <td class="text-start required">Title</td>
            <td class="text-start ">Description</td>

           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($collectionList)){ foreach ($collectionList as $key => $row) {?>
         
         <tr id="area-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="collectionTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>

            <td class="text-left"><textarea name="collectionDescription[]" placeholder="Title" class="form-control" /><?php echo set_value('collectionDescription',$row->description); ?></textarea> </td>

             <td class="text-left"><button type="button" onclick="$('#area-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="2"></td>
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
    html += '  <td class="text-left"><input type="text" name="collectionTitle[]"  placeholder="Title" class="form-control required" /></td>';

    html += '  <td class="text-left"><textarea name="collectionDescription[]" rows="5" class="form-control ckeditor" /></textarea></td>';

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
    
    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }

</script>



<?php $this->endSection(); ?>