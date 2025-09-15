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
  <a href="<?php echo base_url('admin/solutions');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
    <li class="nav-item"><a href="#tab-data" data-bs-toggle="tab" class="nav-link">Data</a></li>
  <li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Process</a></li>
    <!--<li class="nav-item"><a href="#tab-fee" data-bs-toggle="tab" class="nav-link">Fee</a></li>-->

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
            <label for="input-username" class="col-sm-2 col-form-label">Short Description </label>
              <div class="col-sm-10">
                   <textarea name="shortDescription" class="form-control" rows="5"><?php echo set_value('shortDescription',$shortDescription); ?></textarea>

              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                    <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>
              </div>
          </div>

          <!--<div class="row mb-3 ">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Feature Heading</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <textarea name="featureHeading" class="form-control" rows="5"><?php echo set_value('featureHeading',$featureHeading); ?></textarea>-->

          <!--    </div>-->
          <!--</div>-->

           <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">Meta Title</label>
              <div class="col-sm-10">
       
                 <input type="text" name="metaTitle" value="<?php echo set_value('metaTitle',$metaTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

         <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Meta Keyword</label>
              <div class="col-sm-10">
                 <textarea name="metaKeyword" class="form-control" rows="5"><?php echo set_value('metaKeyword',$metaKeyword); ?></textarea>
          
              </div>
          </div>

              <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Meta Description</label>
              <div class="col-sm-10">
                 <textarea name="metaDescription" class="form-control" rows="5"><?php echo set_value('metaDescription',$metaDescription); ?></textarea>
          
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


<div id="tab-data" class="tab-pane">
        <legend>Images</legend>
      
         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">       
               <?php if (!empty($image)): ?>
                <img src="<?php echo base_url($image); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="image"  id="input-image" class="form-control" />
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Thumbnail</label>
              <div class="col-sm-10">       
               <?php if (!empty($thumbnail)): ?>
                <img src="<?php echo base_url($thumbnail); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="thumbnail"  id="input-image" class="form-control" />
              </div>
          </div>

            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Key Hover Image</label>
              <div class="col-sm-10">       
               <?php if (!empty($keyImage)): ?>
                <img src="<?php echo base_url($keyImage); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="keyImage"  id="input-image" class="form-control" />
              </div>
          </div>
          
          
         <legend>Solution</legend>

          <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
       
                 <input type="text" name="productTitle" value="<?php echo set_value('productTitle',$productTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

             <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label"> Description</label>
              <div class="col-sm-10">
                 <textarea name="productDescription" class="form-control" rows="5"><?php echo set_value('productDescription',$productDescription); ?></textarea>
          
              </div>
          </div>

          <!-- <legend>Process</legend>-->

          <!--<div class="row mb-3 ">-->
          <!--    <label for="input-email" class="col-sm-2 col-form-label">Title</label>-->
          <!--    <div class="col-sm-10">-->
       
          <!--       <input type="text" name="processTitle" value="<?php echo set_value('processTitle',$processTitle); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

          <!--   <div class="row mb-3 ">-->
          <!--    <label for="input-lastname" class="col-sm-2 col-form-label"> Description</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <textarea name="processDescription" class="form-control" rows="5"><?php echo set_value('processDescription',$processDescription); ?></textarea>-->
          
          <!--    </div>-->
          <!--</div>-->

          <!-- <legend>Fee Structure</legend>-->

          <!--   <div class="row mb-3 ">-->
          <!--    <label for="input-email" class="col-sm-2 col-form-label">Title</label>-->
          <!--    <div class="col-sm-10">-->
       
          <!--       <input type="text" name="feeTitle" value="<?php echo set_value('feeTitle',$feeTitle); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

          <!--   <div class="row mb-3 ">-->
          <!--    <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <textarea name="feeDescription" class="form-control" rows="5"><?php echo set_value('feeDescription',$feeDescription); ?></textarea>-->
          
          <!--    </div>-->
          <!--</div>-->

          <!--<legend>Have a Security Requirement?</legend>-->

          <!--<div class="row mb-3 ">-->
          <!--    <label for="input-email" class="col-sm-2 col-form-label">Title</label>-->
          <!--    <div class="col-sm-10">-->
       
          <!--       <input type="text" name="securityTitle" value="<?php echo set_value('securityTitle',$securityTitle); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

          <!--   <div class="row mb-3 ">-->
          <!--    <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <textarea name="securityDescription" class="form-control" rows="5"><?php echo set_value('securityDescription',$securityDescription); ?></textarea>-->
          
          <!--    </div>-->
          <!--</div>-->

          


           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Slug (optional)</label>
              <div class="col-sm-10">
                  <input type="text" name="slug" value="<?php echo set_value('slug',$slug); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Feature</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="feature" value="1"  id="input-image" <?php echo $feature==1?'checked':''; ?> />
              </div>
          </div>
          
         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Key Offering</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="offering" value="1"  id="input-image" <?php echo $offering==1?'checked':''; ?> />
              </div>
          </div>
          
               <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Solution Sort Order</label>
              <div class="col-sm-10">       
             
              <input type="number" name="sortOrder" class="form-control" value="<?php echo set_value('sortOrder',$sortOrder); ?>"  id="input-image"  />
              </div>
          </div>
          
               <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Key Sort Order</label>
              <div class="col-sm-10">       
             
               <input type="number" name="key_sort_order" class="form-control" value="<?php echo set_value('key_sort_order',$key_sort_order); ?>"  id="input-image"  />
              </div>
          </div>


</div>







<div id="tab-feature" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Description</td>
          <!--<td class="text-start">Image</td>-->
          <td class="text-start">Slug </td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="title[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control ckeditor"><?php echo $row->description; ?></textarea></td>

            <!--<td class="text-center">-->
            <!--  <?php if (!empty($row->image)): ?>-->
            <!--      <img src="<?php echo base_url($row->image) ?>" width="100" height="100">-->

            <!--      <input type="hidden" name="old_image[]" value="<?php echo $row->image; ?>">-->
            <!--  <?php endif ?>-->
            <!--  <input type="file" class="form-control" name="images[]"  id="input-image' + image_row + '" /></td>-->

             
             <td class="text-right" style="width: 15%;"><textarea  name="feature_slug[]"  placeholder="" class="form-control" ><?php echo $row->slug; ?></textarea>
 <td class="text-right" style="width: 10%;"><input type="number" name="feature_sort_order[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />
             <td class="text-left"><button type="button" onclick="$('#image-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="4"></td>
           <td class="text-left">
            <button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>


<div id="tab-fee" class="tab-pane">

<div class="table-responsive">
        <table id="fees" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

          <td class="text-start required">Area</td>
          <td class="text-start">Fees</td>
          <td class="text-start">Arrival Time</td>

           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($feeList)){ foreach ($feeList as $key => $row) {?>
         
         <tr id="fee-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="area[]" value="<?php echo $row->area; ?>"  placeholder="Title" class="form-control" /></td>
       
             <td class="text-left"><input type="text" name="price[]" value="<?php echo $row->price; ?>"  placeholder="Title" class="form-control" /></td>

            <td class="text-left"><input type="text" name="arrival[]" value="<?php echo $row->arrival; ?>"  placeholder="Title" class="form-control" /></td>


             <td class="text-left"><button type="button" onclick="$('#fee-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addFee();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
      html += '  <td class="text-left"><input type="text" name="title[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control ckeditor" id="editor'+image_row+'"></textarea></td>';
    // html += '  <td class="text-center"><input type="file" class="form-control" name="images[]"  id="input-image' + image_row + '" /></td>';

   html += '<td class="text-right" style="width: 15%;"><textarea  name="feature_slug[]"  placeholder="" class="form-control" ></textarea></td>';
    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="feature_sort_order[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);
    
    CKEDITOR.replace('editor'+image_row)
    image_row++;
  }


 var fee = 0; 

  function addFee() {
    html  = '<tr id="fee-row' + fee + '">';
    html += '  <td class="text-left"><input type="text" name="area[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left"><input type="text" name="price[]"  placeholder="Fee" class="form-control required" /></td>';
    html += '  <td class="text-left"><input type="text" name="arrival[]"  placeholder="Arrival Time" class="form-control required" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#fee-row' + fee  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#fees tbody').append(html);

    fee++;
  }








</script>





<?php $this->endSection(); ?>