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
  <a href="<?php echo base_url('admin/service_heading');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
<!--<li class="nav-item"><a href="#tab-area" data-bs-toggle="tab" class="nav-link">Culture</a></li>-->


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

        

    <!--           <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image 2</label>
              <div class="col-sm-10">
                  <?php if (!empty($image2)): ?>
                    <img src="<?php echo base_url($image2) ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="image2"  placeholder=""  class="form-control" />

              </div>
          </div>

              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image 3</label>
              <div class="col-sm-10">
                  <?php if (!empty($image3)): ?>
                    <img src="<?php echo base_url($image3) ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="image3"  placeholder=""  class="form-control" />

              </div>
          </div> -->

     

         <legend>Fun and Dynamic Environment</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="ctitle" value="<?php echo set_value('ctitle',$ctitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>


         <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Descripton</label>
              <div class="col-sm-10">
                   <textarea name="cdescription" class="form-control" rows="5"><?php echo set_value('cdescription',$cdescription); ?></textarea>

                 
              </div>
          </div>

                <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image 1</label>
              <div class="col-sm-10">
                  <?php if (!empty($image)): ?>
                    <img src="<?php echo base_url($image) ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="image"  placeholder=""  class="form-control" />

              </div>
          </div>


          <legend>Benefits of Working with Us</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="otitle" value="<?php echo set_value('otitle',$otitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>
        
          <legend>Life@Proactive</legend>

              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="etitle" value="<?php echo set_value('etitle',$etitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

          <legend>Current Openings</legend>


              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="opentingTitle" value="<?php echo set_value('opentingTitle',$opentingTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="odescription" class="form-control" rows="5"><?php echo set_value('odescription',$odescription); ?></textarea>
          
              </div>
          </div>

      
          <legend>Didn’t Find a Perfect Fit for You?</legend>


              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="fitTitle" value="<?php echo set_value('fitTitle',$fitTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="fitDescription" class="form-control" rows="5"><?php echo set_value('fitDescription',$fitDescription); ?></textarea>
          
              </div>
          </div>

     
          
 <!--         <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if(!empty($edescription)){?>
                  <img src="<?php echo base_url($edescription); ?>" width="100" height="100">
                  <?php } ?>
                  <input type="file" name="edescription"  placeholder=""  class="form-control" />

              </div>
          </div> -->

   
         
      </fieldset>

  </div>




<!-- area -->


<div id="tab-feature" class="tab-pane">

<div class="table-responsive">
        <table id="area" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
           <!-- <td class="text-start ">Description</td> -->
           <td class="text-start ">Image</td>
           <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($areaList)){ foreach ($areaList as $key => $row) {?>
         
         <tr id="area-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="areaTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
<!-- 
              <td class="text-left" style="width: 30%;"><textarea name="areaDescription[]"  placeholder="Description" class="form-control"><?php echo $row->description; ?></textarea></td> -->

                 <td class="text-center">
              <?php if (!empty($row->image)): ?>
                  <img src="<?php echo base_url($row->image) ?>" width="100" height="100">

                  <input type="hidden" name="old_feature_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" class="form-control" name="featureImages[]"  id="input-image' + image_row + '" />
            </td>

              <td class="text-right" style="width: 10%;"><input type="number" name="areaSortOrder[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


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




<div id="tab-area" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Image</td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
          
            <td class="text-center">
              <?php if (!empty($row->image)): ?>
                  <img src="<?php echo base_url($row->image) ?>" width="100" height="100">

                  <input type="hidden" name="old_feature_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" class="form-control" name="featureImages[]"  id="input-image' + image_row + '" />
            </td>

              <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" /></td>


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
    html += '  <td class="text-left"><input type="text" name="areaTitle[]"  placeholder="Title" class="form-control required" /></td>';
        // html += '  <td class="text-left" style="width: 30%;"><textarea name="areaDescription[]"  placeholder="Description" class="form-control"></textarea></td>';
    html += '  <td class="text-center"><input type="file" class="form-control" name="featureImages[]"  id="input-image' + feature + '" /></td>';

    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="areaSortOrder[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#area-row' + area  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#area tbody').append(html);

    area++;
  }




  var feature = 0;

    function addFeature() {
    html  = '<tr id="image-row' + feature + '">';
      html += '  <td class="text-left"><input type="text" name="featureTitle[]"  placeholder="Title" class="form-control required" /></td>';

    html += '  <td class="text-center"><input type="file" class="form-control" name="featureImages[]"  id="input-image' + feature + '" /></td>';

    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="featureSortOrder[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }

</script>



<?php $this->endSection(); ?>