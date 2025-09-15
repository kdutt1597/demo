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
  <a href="<?php echo base_url('admin/infrastructure');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <!-- <li class="nav-item"><a href="#tab-faq" data-bs-toggle="tab" class="nav-link">Faq</a></li> -->
 <li class="nav-item"><a href="#tab-images" data-bs-toggle="tab" class="nav-link">Images</a></li>

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="name"  class="form-control" />

                 <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
              </div>
          </div>

      

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                    <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>
              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Type</label>
              <div class="col-sm-10">
                    <select name="type" class="form-control">
                      <option value="">Select</option>
                      <?php foreach ($typeList as $key => $value): ?>
                        <option value="<?php echo $key; ?>" <?php echo $type==$key?'selected':''; ?>><?php echo $value; ?></option>
                      <?php endforeach ?>
                    </select>
              </div>
          </div>


          <!--<div class="row mb-3 ">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Industry Name</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="industry" value="<?php echo set_value('industry',$industry); ?>" placeholder="industry"  class="form-control" />-->

          <!--    </div>-->
          <!--</div> -->

           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                 <textarea name="address" class="form-control" rows="5"><?php echo set_value('address',$address); ?></textarea>
              </div>
          </div> 



       <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Iframe Map</label>
              <div class="col-sm-10">
                 <textarea name="map" class="form-control" rows="5"><?php echo set_value('map',$map); ?></textarea>
              </div>
          </div> 



        <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if (!empty($thumbnail)): ?>
                    <img src="<?php echo base_url($thumbnail); ?>" width="100" heigth="100">
                  <?php endif ?>
                  <input type="file" name="thumbnail"  class="form-control" />

              </div>
          </div> 

         <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Sort Order</label>
              <div class="col-sm-10">
                  <input type="text" name="sortOrder" value="<?php echo set_value('sortOrder',$sortOrder); ?>" placeholder=""  class="form-control" />
              </div>
          </div>

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


<div id="tab-faq" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Question</td>
            <td class="text-start">Answer</td>
             
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($faqList)){ foreach ($faqList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="question[]" value="<?php echo $row->title; ?>"  placeholder="question" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="answer[]"  placeholder="" class="form-control"><?php echo $row->description; ?></textarea></td>

                          
              <td class="text-right" style="width: 10%;"><input type="number" name="sort_order[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


             <td class="text-left"><button type="button" onclick="$('#image-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>




<div id="tab-images" class="tab-pane">

<div class="table-responsive">
        <table id="gallery" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Images</td>
                        
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($sliderList)){ foreach ($sliderList as $key => $row) {?>
         
         <tr id="gallery-row<?php  echo $row->id; ?>">  

            <td class="text-left">
              <?php if (!empty($row->image)): ?>
                <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
                <input type="hidden" name="old_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>


              <input type="file" name="images[]" class="form-control" /></td>
       
                          
              <td class="text-right" style="width: 10%;"><input type="number" name="gallery_sort_order[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


             <td class="text-left"><button type="button" onclick="$('#gallery-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="2"></td>
           <td class="text-left">
            <button type="button" onclick="addGallery();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
  var image_row = 0;

    function addImage() {
    html  = '<tr id="image-row' + image_row + '">';
      html += '  <td class="text-left"><input type="text" name="question[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left" style="width: 30%;"><textarea name="answer[]"  placeholder="" class="form-control"></textarea></td>';


    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="sort_order[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    image_row++;
  }




  var gallery = 0;

    function addGallery() {
    html  = '<tr id="gallery-row' + gallery + '">';
      html += '  <td class="text-left"><input type="file" name="images[]"   class="form-control required" /></td>';
 
    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="gallery_sort_order[]"  placeholder="Sort Order" value="1" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#gallery-row' + gallery  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#gallery tbody').append(html);

    gallery++;
  }


</script>





<?php $this->endSection(); ?>