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
  <a href="<?php echo base_url('admin/industry');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
    <!-- <li class="nav-item"><a href="#tab-fee" data-bs-toggle="tab" class="nav-link">Fee</a></li> -->

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
         


                    <div class="row mb-3 required">
                        <label for="input-name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder=" name"  class="form-control" />

                          <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
                        </div>
                    </div>

                  
              

                    <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-10">
                           <textarea name="shortDescription" class="form-control" rows="5"><?php echo set_value('shortDescription',$shortDescription); ?></textarea>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="input-name" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                           <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>
                        </div>
                    </div>
                    
                

                      <div class="row mb-3 ">
                        <label for="input-name" class="col-sm-2 col-form-label">Sort Order</label>
                        <div class="col-sm-10">
                            <input type="number" name="sortOrder" value="<?php echo set_value('sortOrder',$sortOrder); ?>" placeholder="sortOrder"  class="form-control" />
                        </div>
                    </div>      

                
         
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
               <?php if (!empty($image)){ $ext = pathinfo($image, PATHINFO_EXTENSION); ?>
                              
               <?php if ($ext=='mp4') {?>
                            
                 <video muted autoplay loop playsinline class="future_media" width="200" height="200">
                    <source src="<?php echo base_url($image); ?>" type="video/mp4" >
                 </video>

                  <?php }else{ ?>
                       <img src="<?php echo base_url($image); ?>" width="100" height="100">
                  <?php } ?>

              <?php } ?>
              
              <input type="file" name="image"  id="input-image" class="form-control" />
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Thumbnail</label>
              <div class="col-sm-10">       
                <?php if (!empty($thumbnail)){ $ext = pathinfo($thumbnail, PATHINFO_EXTENSION); ?>
                              
               <?php if ($ext=='mp4') {?>
                            
                 <video muted autoplay loop playsinline class="future_media" width="200" height="200">
                    <source src="<?php echo base_url($thumbnail); ?>" type="video/mp4" >
                 </video>

                  <?php }else{ ?>
                       <img src="<?php echo base_url($thumbnail); ?>" width="100" height="100">
                  <?php } ?>

              <?php } ?>
              <input type="file" name="thumbnail"  id="input-image" class="form-control" />
              </div>
          </div>


              <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Solution title</label>
              <div class="col-sm-10">

           <input type="text" name="solution_title" value="<?php echo set_value('solution_title',$solution_title); ?>" placeholder=""  class="form-control" />
              </div>
          </div>

              <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Solution Description</label>
              <div class="col-sm-10">
                 <textarea name="solutionDescription" class="form-control" rows="5"><?php echo set_value('solutionDescription',$solutionDescription); ?></textarea>
          
              </div>
          </div>

            

           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Slug (optional)</label>
              <div class="col-sm-10">
                  <input type="text" name="slug" value="<?php echo set_value('slug',$slug); ?>" placeholder=""  class="form-control" />

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
          <!-- <td class="text-start">Image</td> -->
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control ckeditor"><?php echo $row->description; ?></textarea></td>

         <!--    <td class="text-center">
              <?php if (!empty($row->image)): ?>
                  <img src="<?php echo base_url($row->image) ?>" width="100" height="100">

                  <input type="hidden" name="old_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" class="form-control" name="images[]"  id="input-image' + image_row + '" /></td> -->

              <td class="text-right" style="width: 10%;"><input type="number" name="feature_sort_order[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


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
      html += '  <td class="text-left"><input type="text" name="featureTitle[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left" style="width: 30%;"><textarea name="featureDescription[]"  placeholder="Description" class="form-control ckeditor" id="editor'+image_row+'"></textarea></td>';
    // html += '  <td class="text-center"><input type="file" class="form-control" name="images[]"  id="input-image' + image_row + '" /></td>';

    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="feature_sort_order[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    CKEDITOR.replace('editor'+image_row)

    image_row++;
  }





</script>





<?php $this->endSection(); ?>