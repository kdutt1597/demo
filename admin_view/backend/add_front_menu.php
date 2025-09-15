<?php 
$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
use App\Models\coreModule\FrontMenuModel;
$model = new FrontMenuModel();

?>

<div id="content">
 <div class="page-header">
 <div class="container-fluid">
  <div class="float-end">
  <button type="submit" form="form-user" data-bs-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i></button>
  <a href="<?php echo base_url('admin/front_menu');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-authorize" data-bs-toggle="tab" class="nav-link">Additional Data</a></li>

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
          <legend>Banner Section Details</legend>
       
          <div class="row mb-3">
              <label for="input-user-group" class="col-sm-2 col-form-label">Select Menu</label>
              <div class="col-sm-10">
           
           <select name="parent_id" id="input-user-group" class="form-control">
           <option value="">select option</option>
              
                  <?php
           if(!empty($menu_list)){

           foreach ($menu_list as $key => $value){ ?>
            <option value="<?php echo $value->id; ?>" <?php echo $value->id==$parent_id?'selected':''; ?>><?php echo $value->name; ?></option>
             <?php 
             $level1 = $model->asObject()->where(array('parent_id'=>$value->id))->findAll();

            if ($level1) {
            foreach ($level1 as $key => $l1) {?>

                <option value="<?php echo @$l1->id; ?>" <?php echo $l1->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.@$l1->name; ?></option>


           <?php 
           $level2 = $model->asObject()->where(array('parent_id'=>$l1->id))->findAll();
           if ($level2) {
          foreach ($level2 as $key => $l2) {?>     

            <option value="<?php echo $l2->id; ?>" <?php echo $l2->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name; ?></option>

        <?php 
        $level3 = $model->asObject()->where(array('parent_id'=>$l2->id))->findAll();
        if ($level3) {
          foreach ($level3 as $key => $l3) {?>

          <option value="<?php echo @$l3->id; ?>" <?php echo @$l3->id==$parent_id?'selected':''; ?>><?php echo $value->name.' > '.$l1->name.' > '.$l2->name.' > '.@$l3->name; ?></option>


        <?php } } ?>

        <?php }} ?>

        <?php }} ?> 

        <?php }} ?>



              </select>

              </div>
          </div>

          <div class="row mb-3 required">
              <label for="input-firstname" class="col-sm-2 col-form-label">Menu Name</label>
              <div class="col-sm-10">
                   <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="First Name" class="form-control" />
                  <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Banner</label>
              <div class="col-sm-10">
       
               <?php if (!empty($image)): ?>
                <img src="<?php echo base_url($image); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="image"  id="input-image" class="form-control" />
              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Banner Title</label>
              <div class="col-sm-10">
                 <input type="text" name="title" value="<?php echo set_value('title',$title); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>
        

            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Banner Sub Title</label>
              <div class="col-sm-10">
       
                <textarea name="subTitle" class="form-control" rows="4"><?php echo set_value('subTitle',$subTitle); ?></textarea>

              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Banner Description</label>
              <div class="col-sm-10">
       
                <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>

              </div>
          </div>

     
          

             <div class="row mb-3 ">
              <label for="input-password" class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                 <input type="text" name="link" value="<?php echo set_value('link',$link); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>


           <div class="row mb-3 ">
              <label for="input-password" class="col-sm-2 col-form-label">Show In</label>
              <div class="col-sm-10">
                <input type="checkbox" name="header" value="1" <?php echo $header?'checked':''; ?> /> Header  &nbsp;
              <input type="checkbox" name="footer" value="1" <?php echo $footer?'checked':''; ?> /> Footer
              </div>
          </div>
          
        <!--<div class="row mb-3 ">-->
        <!--      <label for="input-password" class="col-sm-2 col-form-label">Show In Hamburger</label>-->
        <!--      <div class="col-sm-10">-->
        <!--        <input type="checkbox" name="hamburger" value="1" <?php echo $hamburger?'checked':''; ?> /> Hamburger-->
            
        <!--      </div>-->
        <!--  </div>-->

            <div class="row mb-3 ">
              <label for="input-password" class="col-sm-2 col-form-label">Footer Colum Position</label>
              <div class="col-sm-10">
                 <select name="position" class="form-control">
                 <option value="">Select</option>
                <option value="1" <?php echo $position==1?'selected':''; ?>>Colum 1</option>
                <option value="2" <?php echo $position==2?'selected':''; ?>>Colum 2</option>
                <option value="3" <?php echo $position==3?'selected':''; ?>>Colum 3</option>
                <option value="4" <?php echo $position==4?'selected':''; ?>>Colum 4</option>
              </select>    
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-password" class="col-sm-2 col-form-label">Sort Order Header</label>
              <div class="col-sm-10">
                 <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-password" class="col-sm-2 col-form-label">Sort Order Footer</label>
              <div class="col-sm-10">
                  <input type="number" name="sort_order_footer" value="<?php echo set_value('sort_order_footer',$sort_order_footer); ?>"  placeholder="Sort Order" class="form-control" autocomplete="off" />
              </div>
          </div>
        
      </fieldset>
      <fieldset>
          <legend>Meta Section</legend>
          <div class="row mb-3 required">
              <label for="input-password" class="col-sm-2 col-form-label">Meta Title</label>
              <div class="col-sm-10">
                 <input type="text" name="metaTitle" value="<?php echo set_value('metaTitle',$metaTitle); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>
          <div class="row mb-3 required">
              <label for="input-confirm" class="col-sm-2 col-form-label">Meta Keyword</label>
              <div class="col-sm-10">
                  <input type="text" name="metaKeyword" value="<?php echo set_value('metaKeyword',$metaKeyword); ?>"  placeholder="" class="form-control"  />
              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Meta  Description</label>
              <div class="col-sm-10">
       
                <textarea name="metaDescription" class="form-control" rows="5"><?php echo set_value('metaDescription',$metaDescription); ?></textarea>

              </div>
          </div>

      </fieldset>
      <fieldset>
          <legend>Status</legend>
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

         <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label"> Title 1</label>
              <div class="col-sm-10">
       
                <input type="text" name="title1" value="<?php echo set_value('title1',$title1); ?>"  placeholder=""  class="form-control"   />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label"> Description 1</label>
              <div class="col-sm-10">
       
                <textarea name="description1" class="form-control" rows="5"><?php echo set_value('description1',$description1); ?></textarea>

              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label"> Title 2</label>
              <div class="col-sm-10">
       
                <input type="text" name="title2" value="<?php echo set_value('title2',$title2); ?>"  placeholder=""  class="form-control"   />

              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label"> Description 2</label>
              <div class="col-sm-10">
       
                <textarea name="description2" class="form-control" rows="5"><?php echo set_value('description2',$description2); ?></textarea>

              </div>
          </div>


           <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label"> Additional Image</label>
              <div class="col-sm-10">
            <?php if (!empty($additionalImage)): ?>
              <img src="<?php echo base_url($additionalImage) ?>" width="100" height="100">
            <?php endif ?>
               <input type="file" name="additionalImage" class="form-control">

              </div>
          </div>


  </div>

</div>
</form>
</div>
</div>
</div>
</div>
<?php $this->endSection(); ?>