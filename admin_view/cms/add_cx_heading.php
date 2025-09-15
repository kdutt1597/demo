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
  <a href="<?php echo base_url('admin/cx_heading');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
<li class="nav-item"><a href="#tab-faq" data-bs-toggle="tab" class="nav-link">FAQ</a></li>
   <li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">Why Adoption</a></li>
<!-- <li class="nav-item"><a href="#tab-commited" data-bs-toggle="tab" class="nav-link">Committed</a></li> -->
 

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        <legend>Overview</legend>
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
                 <textarea name="description" class="form-control ckeditor" id="editor" rows="5"><?php echo set_value('description',$description); ?></textarea>
          
              </div>
          </div>

    



<!--    
        <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Left Description</label>
              <div class="col-sm-10">                

                  <textarea name="pillarTitle" class="form-control" rows="5"><?php echo set_value('pillarTitle',$pillarTitle); ?></textarea>
              </div>
          </div>
       

           <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Right Description</label>
              <div class="col-sm-10">
                 <textarea name="pillarDescription" class="form-control" rows="5"><?php echo set_value('pillarDescription',$pillarDescription); ?></textarea>
          
              </div>
          </div>
 -->

        
        <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($image)): ?>
                 <img src="<?php echo base_url($image) ?>" width="100" height="100">
           
                <?php endif ?>
                  <input type="file" name="image"   class="form-control" />

              </div>
          </div>

        <!--<div class="row mb-3">-->
        <!--      <label for="input-username" class="col-sm-2 col-form-label"> Image 2</label>-->
        <!--      <div class="col-sm-10">-->
        <!--        <?php if (!empty($bottomImage)): ?>-->
        <!--         <img src="<?php echo base_url($bottomImage) ?>" width="100" height="100">-->
           
        <!--        <?php endif ?>-->
        <!--          <input type="file" name="bottomImage"   class="form-control" />-->

        <!--      </div>-->
        <!--  </div> -->
        

           <!--   <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label"> left Description</label>
              <div class="col-sm-10">
              
                  <textarea name="goalTitle" class="form-control" rows="5"><?php echo set_value('goalTitle',$goalTitle); ?></textarea>

              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Right Description</label>
              <div class="col-sm-10">
                 <textarea name="goalDescription" class="form-control" rows="5"><?php echo set_value('goalDescription',$goalDescription); ?></textarea>
          
              </div>
          </div> -->
<!-- 
            <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($goalImage)): ?>
                 <img src="<?php echo base_url($goalImage) ?>" width="100" height="100">
           
                <?php endif ?>
                  <input type="file" name="goalImage"   class="form-control" />

              </div>
          </div> -->
<!-- 
          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Image</label>
              <div class="col-sm-10">
                <?php if (!empty($committedImage)): ?>
                 <img src="<?php echo base_url($committedImage) ?>" width="100" height="100">
           
                <?php endif ?>
                  <input type="file" name="committedImage"   class="form-control" />

              </div>
          </div>  -->
          
     <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="commitTitle" value="<?php echo set_value('commitTitle',$commitTitle); ?>" placeholder=""  class="form-control" />

              </div>
          </div> 


         <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
         
           <input type="text" name="commitDescription" value="<?php echo set_value('commitDescription',$commitDescription); ?>" placeholder=""  class="form-control" />
              </div>
          </div>
            
       <!--    -->


        
         
      </fieldset>

  </div>



<div id="tab-faq" class="tab-pane">

<div class="table-responsive">
        <table id="faq" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>
           <td class="text-start required">Question</td>
           <td class="text-start">Answer</td>
            <td class="text-start">Sort Order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($faqList)){ foreach ($faqList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="faqTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
           <td class="text-left"><textarea name="faqDescription[]" class="form-control" /><?php echo $row->description; ?></textarea></td>


            <td class="text-left"><input type="number" name="faqSortOrder[]" value="<?php echo $row->sort_order; ?>"  placeholder="" class="form-control" /></td>

             <td class="text-left"><button type="button" onclick="$('#faq-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addFaq();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

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
         <?php if (!empty($featureList)){ foreach ($featureList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="featureTitle[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left"><textarea name="featureDescription[]" class="form-control" /><?php echo $row->description; ?></textarea></td>

            <td class="text-left">
               <?php if (!empty($row->image)): ?>
                <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
                <input type="hidden" name="old_feature_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" name="featureImage[]"   placeholder="+" class="form-control" />
            </td>

            <td class="text-left"><input type="number" name="featureSortOrder[]" value="<?php echo $row->sort_order; ?>"  placeholder="+" class="form-control" /></td>

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


  

<div id="tab-commited" class="tab-pane">

<div class="table-responsive">
        <table id="commited" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>
               <td class="text-start">Image</td>
              <td class="text-start required">Sort Order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($commitList)){ foreach ($commitList as $key => $row) {?>
         
         <tr id="commited-row<?php  echo $row->id; ?>">  
                  

             <td class="text-left">
              <?php if (!empty($row->image)): ?>
                <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
                <input type="hidden" name="old_commit_image[]" value="<?php echo $row->image; ?>">
              <?php endif ?>
              <input type="file" name="commitImage[]"   placeholder="+" class="form-control" />
            </td>

             <td class="text-left"><input type="number" name="commitSortOrder[]" value="<?php echo $row->sort_order; ?>"  placeholder="+" class="form-control" /></td>

             <td class="text-left"><button type="button" onclick="$('#commited-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="2"></td>
           <td class="text-left">
            <button type="button" onclick="addCommited();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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





 
  var faq = 0;

    function addFaq() {
    html  = '<tr id="faq-row' + faq + '">';
      html += '  <td class="text-left"><input type="text" name="faqTitle[]"  placeholder="Title" class="form-control required" /></td>';

   html += '  <td class="text-left"><textarea name="faqDescription[]" class="form-control" /></textarea></td>';

   html += '  <td class="text-left"><input type="number" name="faqSortOrder[]"  placeholder="" class="form-control " /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#faq-row' + faq  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#faq tbody').append(html);

    faq++;
  }







  var feature = 0;

    function addFeature() {
    html  = '<tr id="image-row' + feature + '">';
      html += '  <td class="text-left"><input type="text" name="featureTitle[]"  placeholder="Title" class="form-control required" /></td>';

   html += '  <td class="text-left"><textarea name="featureDescription[]" class="form-control" /></textarea></td>';

     html += '  <td class="text-left"><input type="file" name="featureImage[]"  placeholder="" class="form-control " /></td>';

        html += '  <td class="text-left"><input type="number" name="featureSortOrder[]"  placeholder="" class="form-control " /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + feature  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    feature++;
  }




  var commit = 0;

    function addCommited() {
    html  = '<tr id="image-row' + commit + '">';

     html += '  <td class="text-left"><input type="file" name="commitImage[]"  placeholder="" class="form-control " /></td>';

    html += '  <td class="text-left"><input type="number" name="commitSortOrder[]"  placeholder="" class="form-control required" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + commit  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#commited tbody').append(html);

    commit++;
  }

</script>



<?php $this->endSection(); ?>