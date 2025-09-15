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
  <a href="<?php echo base_url('admin/careers');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
 <!--  <li class="nav-item"><a href="#tab-authorize" data-bs-toggle="tab" class="nav-link">Data</a></li> -->

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Job Title</label>
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



          <!--  <div class="row mb-3 ">-->
          <!--    <label for="input-lastname" class="col-sm-2 col-form-label">Roles and Responsibilities</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <textarea name="responsibility" class="form-control ckeditor" rows="5"><?php echo set_value('responsibility',$responsibility); ?></textarea>-->
          
          <!--    </div>-->
          <!--</div>-->


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Location</label>
              <div class="col-sm-10">
                  <input type="text" name="location" value="<?php echo set_value('location',$location); ?>" placeholder="Location"  class="form-control" />

              </div>
          </div>



          <!--<div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Job Function</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="jobFunction" value="<?php echo set_value('jobFunction',$jobFunction); ?>" placeholder="BUSINESS PROCESS SERVICES"  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->


          <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">ROLE</label>
              <div class="col-sm-10">
                  <input type="text" name="role" value="<?php echo set_value('role',$role); ?>" placeholder="Analyst"  class="form-control" />

              </div>
          </div>
          <!--  <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Desired Skills</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="desireSkill" value="<?php echo set_value('desireSkill',$desireSkill); ?>" placeholder=" HRO Payroll"  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->
          <!--  <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Skill</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="skill" value="<?php echo set_value('skill',$skill); ?>" placeholder="HRO"  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

         <!--<div class="row mb-3">-->
         <!--     <label for="input-username" class="col-sm-2 col-form-label">Grade</label>-->
         <!--     <div class="col-sm-10">-->
         <!--         <input type="text" name="grade" value="<?php echo set_value('grade',$grade); ?>" placeholder="BPO 1/2"  class="form-control" />-->

         <!--     </div>-->
         <!-- </div>-->

          <!-- <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Qualification</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="qualification" value="<?php echo set_value('qualification',$qualification); ?>" placeholder="MCA"  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->




             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Job Type</label>
              <div class="col-sm-10">
                  <input type="text" name="jobType" value="<?php echo set_value('jobType',$jobType); ?>" placeholder="Full Time"  class="form-control" />

              </div>
          </div>

          <!--   <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">CTC</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="text" name="salary" value="<?php echo set_value('salary',$salary); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

             <div class="row mb-3">
              <label for="input-username" class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                  <input type="text" name="link" value="<?php echo set_value('link',$link); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

          <!--   <div class="row mb-3">-->
          <!--    <label for="input-username" class="col-sm-2 col-form-label">Image</label>-->
          <!--    <div class="col-sm-10">-->
          <!--      <?php if (!empty($image)): ?>-->
          <!--        <img src="<?php echo base_url($image); ?>" width="100" height="100">-->
          <!--      <?php endif ?>-->
          <!--        <input type="file" name="image"   class="form-control" />-->

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
          <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">Sort order</label>
              <div class="col-sm-10">
       
                 <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>" placeholder=""  class="form-control" />

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



       <div id="tab-authorize" class="tab-pane">



  </div>




</div>
</form>
</div>
</div>
</div>
</div>






<?php $this->endSection(); ?>