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
  <a href="<?php echo base_url('admin/blogs');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
<li class="nav-item"><a href="#tab-authorize" data-bs-toggle="tab" class="nav-link">Data</a></li>
<li class="nav-item"><a href="#tab-ebook" data-bs-toggle="tab" class="nav-link">Whitepaper/Ebook</a></li>
<li class="nav-item"><a href="#tab-demand" data-bs-toggle="tab" class="nav-link">On Demand</a></li>
<li class="nav-item"><a href="#tab-podcast" data-bs-toggle="tab" class="nav-link">Podcast</a></li>
<li class="nav-item"><a href="#tab-event" data-bs-toggle="tab" class="nav-link">Event</a></li>

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                  <input type="text" name="title" value="<?php echo set_value('title',$title); ?>" placeholder="title"  class="form-control" />

                 <?php echo $validation->hasError('title')?$validation->showError('title','my_single'):''; ?>
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Short Description</label>
              <div class="col-sm-10">
                    <textarea name="shortDescription" class="form-control" rows="5"><?php echo set_value('shortDescription',$shortDescription); ?></textarea>
              </div>
          </div>
          
          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                 <textarea name="description" class="form-control ckeditor" id="editor" rows="5"><?php echo set_value('description',$description); ?></textarea>
          
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

  
         
      </fieldset>

  </div>


       <div id="tab-authorize" class="tab-pane">
        <div class="row mb-3">
                <label for="input-email" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">       
                    <select name="category[]" class="form-control" multiple>
                        <option value="">Select</option>
                        <?php 
                        // Convert $category string to an array
                        $selectedCategories = array_map('trim', explode(',', trim($category, '()')));
                        
                        foreach ($blogCategoryList as $key => $value): ?>
                            <option value="<?php echo $value->id; ?>" 
                                <?php echo (in_array($value->id, $selectedCategories)) ? 'selected' : ''; ?>>
                                <?php echo $value->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>



            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Type</label>
              <div class="col-sm-10">       
              <select name="type" class="form-control">
                  <option value="">Select</option>
                  <?php foreach ($typeList as $key => $value): ?>
                      <option value="<?php echo $key; ?>" <?php echo $type==$key?'selected':''; ?>  ><?php echo $value; ?></option>
                  <?php endforeach ?>
              </select>
              </div>
          </div>


        <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Author</label>
              <div class="col-sm-10">       
              <select name="author" class="form-control">
                  <option value="">Select</option>
                  <?php foreach ($authorList as $key => $value): ?>
                      <option value="<?php echo $value->id; ?>" <?php echo $author==$value->id?'selected':''; ?>  ><?php echo $value->name; ?></option>
                  <?php endforeach ?>
              </select>
              </div>
          </div>






<!--           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Scope</label>
              <div class="col-sm-10">       
              <select name="scope" class="form-control">
                  <option value="">Select</option>
                  <?php foreach ($scopeList as $key => $value): ?>
                      <option value="<?php echo $key; ?>" <?php echo $scope==$key?'selected':''; ?>  ><?php echo $value; ?></option>
                  <?php endforeach ?>
              </select>
              </div>
          </div> -->

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Image / Video</label>
              <div class="col-sm-10">       
               <?php if (!empty($image)){ $ext = pathinfo($image, PATHINFO_EXTENSION); if($ext=='mp4' || $ext == 'gif' || $ext == 'webm'){ ?>
               <video width="200" height="150" controls>
                  <source src="<?php echo base_url($image); ?>" type="video/<?= $ext ?>">
                  
                </video>
               <?php }else{?>
                <img src="<?php echo base_url($image); ?>" width="100" height="100">
              <?php }} ?>
              
              <input type="file" name="image"  id="input-image" class="form-control" />
              </div>
          </div>
          
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">ALT Tag</label>
              <div class="col-sm-10">       
             
              <input type="text" name="alt_tag" value="<?php echo set_value('alt_tag',$alt_tag) ?>" id="input-image" class="form-control" />
              </div>
          </div>

          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Thumbnail</label>
              <div class="col-sm-10">       
                 <?php if (!empty($thumbnail)){ $ext = pathinfo($thumbnail, PATHINFO_EXTENSION); ?>
                              
               <?php if ($ext=='mp4' || $ext == 'gif' || $ext == 'webm') {?>
                            
                 <video muted autoplay loop playsinline class="future_media" width="100" height="100">
                    <source src="<?php echo base_url($thumbnail); ?>" type="video/<?= $ext ?>" >
                 </video>

                  <?php }else{ ?>
                       <img src="<?php echo base_url($thumbnail); ?>" width="100" height="100">
                  <?php } ?>

              <?php } ?>

              <input type="file" name="thumbnail"  id="input-image" class="form-control" />
              </div>
          </div>
          
        <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">ALT Tag</label>
              <div class="col-sm-10">       
             
              <input type="text" name="alt_tag2" value="<?php echo set_value('alt_tag2',$alt_tag2) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          
          
          
            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Audio File</label>
              <div class="col-sm-10">       
               <?php if (!empty($audio)): ?>
                <audio controls>
                    <source src="<?php echo base_url($audio); ?>" type="audio/mpeg">
                 </audio>
              <?php endif ?>
              <input type="file" name="audio"  id="input-image" class="form-control" />
              </div>
          </div>
          
                              

            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Feature</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="feature" value="1"  id="input-image" <?php echo $feature==1?'checked':''; ?> />
              </div>
          </div>
          
        <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Trending</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="trending" value="1"  id="input-image" <?php echo $trending==1?'checked':''; ?> />
              </div>
          </div>
          
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Trending Sticky</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="sticky" value="1"  id="input-image" <?php echo $sticky==1?'checked':''; ?> />
              </div>
          </div>
            
    
            
            
                  <div class="row mb-3">
                  <label for="input-email" class="col-sm-2 col-form-label">Latest Blog</label>
                  <div class="col-sm-10">       
                 
                  <input type="checkbox" name="spotlight" value="1"  id="input-image" <?php echo $spotlight==1?'checked':''; ?> />
                  </div>
              </div>
            
            
         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Industry</label>
              <div class="col-sm-10">       
             
              <input type="text" name="industry" value="<?php echo set_value('industry',$industry) ?>" id="input-image" class="form-control" />
              </div>
          </div>

          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Client</label>
              <div class="col-sm-10">       
             
              <input type="text" name="client" value="<?php echo set_value('client',$client) ?>" id="input-image" class="form-control" />
              </div>
          </div>

            
            
           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Location</label>
              <div class="col-sm-10">       
             
              <input type="text" name="location" value="<?php echo set_value('location',$location) ?>" id="input-image" class="form-control" />
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Publish Date</label>
              <div class="col-sm-10">       
             
              <input type="text" name="publish" value="<?php echo set_value('publish',$publish) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Event End Date</label>
              <div class="col-sm-10">
              <input type="datetime-local" name="event_end_date" value="<?php echo set_value('event_end_date',$event_end_date) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          
              <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Reading Time</label>
              <div class="col-sm-10">       
             
              <input type="text" name="readingTime" value="<?php echo set_value('readingTime',$readingTime) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          

            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Slug (optional)</label>
              <div class="col-sm-10">
       
                 <input type="text" name="slug" value="<?php echo set_value('slug',$slug); ?>" placeholder=""  class="form-control" />

              </div>
          </div>
          
        <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Sort Order</label>
              <div class="col-sm-10">
       
                 <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>" placeholder=""  class="form-control" />

              </div>
          </div>
            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Size</label>
              <div class="col-sm-10">       
              <select name="size" class="form-control">
                    <option value="small" <?php echo $size=='small'?'selected':''; ?>  >Small</option>
                    <option value="large" <?php echo $size=='large'?'selected':''; ?>  >Large</option>
              </select>
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
            


  </div>

 <div id="tab-ebook" class="tab-pane">

         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Whitepaper/Ebook Download</label>
              <div class="col-sm-10">       
               <?php if (!empty($whitepaper_download)): ?>
                <a href="<?php echo base_url($whitepaper_download) ?>" target="_blank" ><i class="fa fa-file-pdf  fa-2x"></i></a>
              <?php endif ?>
              <input type="file" name="whitepaper_download"  id="input-image" class="form-control" />
              </div>
          </div>
          
        
     

</div>

 <div id="tab-demand" class="tab-pane">

       <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">On Demand Video </label>
              <div class="col-sm-10">       
               <?php if (!empty($video)): ?>
                
                <video width="200" height="150" controls>
                    <source src="<?php echo base_url($video) ?>" type="video/mp4">

                  </video>
              <?php endif ?>
              <input type="file" name="video"  id="input-image" class="form-control" />
              </div>
          </div>
  
</div>

 <div id="tab-podcast" class="tab-pane">

   <div class="row mb-3">
          <label for="input-email" class="col-sm-2 col-form-label">Podcast Video </label>
          <div class="col-sm-10">       
           <?php if (!empty($podcast)): ?>
            
            <video width="200" height="150" controls>
                <source src="<?php echo base_url($podcast) ?>" type="video/mp4">

              </video>
          <?php endif ?>
          <input type="file" name="podcast"  id="input-image" class="form-control" />
          </div>
      </div>
  
</div>

 <div id="tab-event" class="tab-pane">

          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Upcoming Events</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="upcoming" value="1"  id="input-image" <?php echo $upcoming==1?'checked':''; ?> />
              </div>
          </div>

          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Event Image</label>
              <div class="col-sm-10">       
                <?php if (!empty($event_image)): ?>
                  <img src="<?php echo base_url($event_image) ?>" width="100" height="100">
                <?php endif ?>
             
               <input type="file" name="event_image" class="form-control">
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Event Description</label>
              <div class="col-sm-10">       
             
              <textarea name="event_description" class="form-control" rows="5" ><?php echo $event_description; ?></textarea>
              </div>
          </div>

           <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Event Description</label>
              <div class="col-sm-10">       
             
              <textarea name="event_description1" class="form-control ckeditor" id="editor1" ><?php echo $event_description1; ?></textarea>
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