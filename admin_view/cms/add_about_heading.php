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
  <a href="<?php echo base_url('admin/about_heading');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Mission</a></li>
<!--<li class="nav-item"><a href="#tab-whyus" data-bs-toggle="tab" class="nav-link">Why Us</a></li>-->
</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        <legend>Overview</legend>

           <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                 
              <input type="text" name="title" class="form-control" rows="5" value="<?php echo set_value('title',$title); ?>">
              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Descripton</label>
              <div class="col-sm-10">
                   <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>

             
              </div>
          </div>

     


    

         <legend>Our Team’s</legend>


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="wtitle" value="<?php echo set_value('wtitle',$wtitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Descripton</label>
              <div class="col-sm-10">
                   <textarea name="wdescription" class="form-control" rows="5"><?php echo set_value('wdescription',$wdescription); ?></textarea>
              </div>
          </div>

      

           <legend>Recognitions </legend>
           <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" name="mTitle" value="<?php echo set_value('mTitle',$mTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

      

            <legend>Our Partners </legend>


             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="jfTitle" value="<?php echo set_value('jfTitle',$jfTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div>


         <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="jfDescription" class="form-control" rows="5"><?php echo set_value('jfDescription',$jfDescription); ?></textarea>
          
              </div>
          </div>


  <legend>Work With Us</legend>
          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Title</label>
              <div class="col-sm-10">
                 <input type="text" name="description2" value="<?php echo set_value('description2',$description2); ?>" placeholder=""  class="form-control" />
                 
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="jDescription2" class="form-control" rows="5"><?php echo set_value('jDescription2',$jDescription2); ?></textarea>
          
              </div>
          </div>

     
              
            <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if (!empty($image)): ?>
                    <img src="<?php echo base_url($image) ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="image" value="<?php echo set_value('image',$image); ?>" placeholder=""  class="form-control" />

              </div>
          </div>
          </div>
            

              <legend>Corporate Social Responsibility </legend>
          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Title</label>
              <div class="col-sm-10">
                 <input type="text" name="patentTitle" value="<?php echo set_value('patentTitle',$patentTitle); ?>" placeholder=""  class="form-control" />
                 
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="patentDescription" class="form-control ckeditor" rows="5"><?php echo set_value('patentDescription',$patentDescription); ?></textarea>
          
              </div>
          </div>
          
         <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                  <?php if (!empty($image1)): ?>
                    <img src="<?php echo base_url($image1) ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="image1" value="<?php echo set_value('image1',$image1); ?>" placeholder=""  class="form-control" />

              </div>
              

          <legend>Our Locations   </legend>
          <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label"> Title</label>
              <div class="col-sm-10">
                 <input type="text" name="companyTitle" value="<?php echo set_value('companyTitle',$companyTitle); ?>" placeholder=""  class="form-control" />
                 
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="companyDescription" class="form-control" rows="5"><?php echo set_value('companyDescription',$companyDescription); ?></textarea>
          
              </div>
          </div>

          <!--    <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Image</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <?php if (!empty($image2)): ?>-->
          <!--          <img src="<?php echo base_url($image2) ?>" width="100" height="100">-->
          <!--        <?php endif ?>-->
          <!--        <input type="file" name="image2" value="<?php echo set_value('image2',$image2); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

         <!--<legend>Let's stay in touch!  </legend>-->
         <!-- <div class="row mb-3 ">-->
         <!--     <label for="input-username" class="col-sm-2 col-form-label"> Title</label>-->
         <!--     <div class="col-sm-10">-->
         <!--        <input type="text" name="letTitle" value="<?php echo set_value('letTitle',$letTitle); ?>" placeholder=""  class="form-control" />-->
                 
         <!--     </div>-->
         <!-- </div>-->

         <!--  <div class="row mb-3 ">-->
         <!--     <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>-->
         <!--     <div class="col-sm-10">-->
         <!--        <textarea name="letDescription" class="form-control" rows="5"><?php echo set_value('letDescription',$letDescription); ?></textarea>-->
          
         <!--     </div>-->
         <!-- </div>-->
         
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
          <td class="text-start">Sort Order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($visionList)){ foreach ($visionList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
           <td class="text-left"><textarea  name="featureDescription[]" class="form-control"><?php echo $row->description; ?></textarea></td>
           
            <td class="text-left">
              <?php if (!empty($row->image)): ?>
                <img src="<?php echo base_url($row->image) ?>" width="100" height="100">

                <input type="hidden" name="old_why_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>

              <input type="file" name="whyimage[]" value="<?php echo $row->symbol; ?>"  placeholder="Title" class="form-control" />
            </td>


            <td class="text-left"><input type="number" name="featureSortOrder[]" value="<?php echo $row->sort_order; ?>"  placeholder="" class="form-control" /></td>


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



<div id="tab-whyus" class="tab-pane">

<div class="table-responsive">
        <table id="whyus" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Description</td>

          <td class="text-start">Sort Order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($whyusList)){ foreach ($whyusList as $key => $row) {?>
         
         <tr id="whyus-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="whyTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
           <td class="text-left"><input type="text" name="whyDescription[]" value="<?php echo $row->description; ?>"  placeholder="Title" class="form-control" /></td>

           
             <td class="text-left"><input type="number" name="whySortOrder[]" value="<?php echo $row->sort_order; ?>"  placeholder="" class="form-control" /></td>


             <td class="text-left"><button type="button" onclick="$('#whyus-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="4"></td>
           <td class="text-left">
            <button type="button" onclick="addWhyus();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
   html += '  <td class="text-left"><textarea  name="featureDescription[]"  placeholder="" class="form-control required"></textarea></td>';

      html += '  <td class="text-left"><input type="file" name="whyimage[]"  placeholder="" class="form-control " /></td>';

   html += '  <td class="text-left"><input type="number" name="featureSortOrder[]"  placeholder="" class="form-control required" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }


 var whyus = 0;
    function addWhyus() {
    html  = '<tr id="whyus-row' + whyus + '">';
      html += '  <td class="text-left"><input type="text" name="whyTitle[]"  placeholder="Title" class="form-control required" /></td>';

   html += '  <td class="text-left"><textarea name="whyDescription[]"  placeholder="" class="form-control "></textarea></td>';



    html += '  <td class="text-left"><input type="number" name="whySortOrder[]"  placeholder="" class="form-control " /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#whyus-row' + whyus  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#whyus tbody').append(html);

    whyus++;
  }

</script>



<?php $this->endSection(); ?>