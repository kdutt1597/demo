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
  <a href="<?php echo base_url('admin/home_heading');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Why Proactive</a></li>


</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        <legend>Future-Ready Solutions</legend>
          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="title" value="<?php echo set_value('title',$title); ?>" placeholder="title"  class="form-control" />

                 <?php echo $validation->hasError('title')?$validation->showError('title','my_single'):''; ?>
              </div>
          </div>

   

            <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>
          
              </div>
          </div>



           <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($image)): ?>
                <video width="150" height="200" controls>
                  <source src="<?php echo base_url($image) ?>" type="video/mp4">              
                </video>
           
                <?php endif ?>
                  <input type="file" name="image"   class="form-control" />

              </div>
          </div>
          
             <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Button Name</label>
              <div class="col-sm-10">
                  <input type="text" name="btn_name" value="<?php echo set_value('btn_name',$btn_name); ?>" placeholder=""  class="form-control" />
              </div>
          </div>
          
        <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Button Link</label>
              <div class="col-sm-10">
                  <input type="text" name="btn_link" value="<?php echo set_value('btn_link',$btn_link); ?>" placeholder=""  class="form-control" />
              </div>
          </div>

    
        <legend>Tailored Solutions</legend>

   
        <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="solutionTitle" value="<?php echo set_value('solutionTitle',$solutionTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>
       

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="solutionDescription" class="form-control" rows="5"><?php echo set_value('solutionDescription',$solutionDescription); ?></textarea>
          
              </div>
          </div>


 
           <legend>Key Offerings </legend>


             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="keyTitle" value="<?php echo set_value('keyTitle',$keyTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

 <legend>Key Offerings Service Tile </legend>


             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="serTitle" value="<?php echo set_value('serTitle',$serTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="serDescription" class="form-control" rows="5"><?php echo set_value('serDescription',$serDescription); ?></textarea>
          
              </div>
          </div>


              <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($serimage)): ?>
               <img src="<?php echo base_url($serimage) ?>" width="100" height="100">
           
                <?php endif ?>
                  <input type="file" name="serimage"   class="form-control" />

              </div>
          </div>



           <legend>Why Proactive </legend>


             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="whyTitle" value="<?php echo set_value('whyTitle',$whyTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>


  

            <legend>Our Customers</legend>

          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="customerTitle" value="<?php echo set_value('customerTitle',$customerTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>


         <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="cultureDescription" class="form-control" rows="5"><?php echo set_value('cultureDescription',$cultureDescription); ?></textarea>
          
              </div>
          </div>
     
     

        <legend>Our Partners</legend>

          <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
       
                 <input type="text" name="partnerTitle" value="<?php echo set_value('partnerTitle',$partnerTitle); ?>" placeholder=""  class="form-control" />

              </div>
           </div>

    <legend>Customer Success Stories</legend>
          
              <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
       
                 <input type="text" name="successTitle" value="<?php echo set_value('successTitle',$successTitle); ?>" placeholder=""  class="form-control" />

              </div>
           </div>
          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="successDescription" class="form-control" rows="5"><?php echo set_value('successDescription',$successDescription); ?></textarea>
          
              </div>
          </div>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($successImage)): ?>
                 <img src="<?php echo base_url($successImage) ?>" width="100" height="100">
           
                <?php endif ?>
                  <input type="file" name="successImage"   class="form-control" />

              </div>
          </div>


          <legend>Fresh Off The Blog</legend>
          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="blogTitle" value="<?php echo set_value('blogTitle',$blogTitle); ?>" placeholder=""  class="form-control" />

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
      
           <td class="text-start">Image</td>
                <td class="text-start required">Sort Order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
             

            <td class="text-left">
              <?php if (!empty($row->image)): ?>
                <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
                <input type="hidden" name="old_feature_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" name="featureImage[]"   placeholder="+" class="form-control" />
            </td> 
            
            
            <td class="text-left">
              <?php if (!empty($row->image2)): ?>
                <img src="<?php echo base_url($row->image2) ?>" width="100" height="100">
                <input type="hidden" name="old_feature_image2[]" value="<?php echo $row->image2; ?>">
              <?php endif ?>
              <input type="file" name="featureImage2[]"   placeholder="+" class="form-control" />
            </td> 
            
            
             <td class="text-left"><input type="text" name="featureValue[]" value="<?php echo $row->description; ?>"  placeholder="Title" class="form-control" /></td>

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
  var feature = 0;

    function addFeature() {
    html  = '<tr id="image-row' + feature + '">';
      html += '  <td class="text-left"><input type="text" name="featureTitle[]"  placeholder="Title" class="form-control required" /></td>';

   html += '  <td class="text-left"><input type="file" name="featureImage[]"  placeholder="" class="form-control " /></td>';
    
     html += '  <td class="text-left"><input type="file" name="featureImage2[]"  placeholder="" class="form-control " /></td>';


   html += '  <td class="text-left"><input type="text" name="featureValue[]"  placeholder="" class="form-control " /></td>';


    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }



</script>



<?php $this->endSection(); ?>