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
  <a href="<?php echo base_url('admin/solutions_test');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
          <div class="row mb-3">
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
            <div class="row mb-3 ">
              <label for="input-image-alt" class="col-sm-2 col-form-label">Image alt tag</label>
              <div class="col-sm-10">
                 <input name="image_alt" class="form-control" value="<?php echo set_value('image_alt',$image_alt); ?>" placeholder="" type="text"></input>
          
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
            <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Related Category</label>
              <div class="col-sm-10">
              <select name="blog_catId" id="relatedCategory" class="form-control">
                  <option value="">Select</option>
                  <?php foreach ($blogCategoryList as $key => $value): ?>
                      <option value="<?php echo $value->id; ?>" <?php echo $category==$value->id?'selected':''; ?>  ><?php echo $value->name; ?></option>
                  <?php endforeach ?>
              </select>
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="input-name" class="col-sm-2 col-form-label">Adv Blog</label>
              <div class="col-sm-10">
                  <select id="type-select" name="Advtype" class="form-control">
                    <option value="">Select</option>
                    <option value="none">None</option>
                    <?php foreach ($typeList as $key => $value): ?>
                      <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
            </div>
            
            <div class="row mb-3" id="subtype-container" style="display: none;">
              <label for="input-subtype" class="col-sm-2 col-form-label">Adv Blog List</label>
                <div class="col-sm-10">
                  <select id="subtype-select" name="adv_blogId" class="form-control">
                    <option value="">Select</option>
                    <!-- Options will be dynamically populated here -->
                  </select>
                </div>
            </div>
            <div class="row mb-3">
              <label for="input-name" class="col-sm-2 col-form-label">Adv Case Study Category</label>
              <div class="col-sm-10">
                  <select name="cs_blogId" class="form-control">
                    <option value="">Select</option>
                    <option value="none">None</option>
                    <?= $cs_blogId; ?>
                    <?php foreach ($blogCategoryList as $key => $value): ?>
                      <option value="<?php echo $value->id; ?>" <?php echo $cs_blogId==$value->id?'selected':''; ?>  ><?php echo $value->name; ?></option>
                    <?php endforeach ?>
                  </select>
              </div>
            </div>
            
            <!--<div class="row mb-3" id="subtypeCS-container" style="display: none;">-->
            <!--  <label for="input-subtype" class="col-sm-2 col-form-label">Adv CSX List</label>-->
            <!--    <div class="col-sm-10">-->
            <!--      <select id="subtypeCS-select" name="cs_blogId" class="form-control">-->
            <!--        <option value="">Select</option>-->
                    <!-- Options will be dynamically populated here -->
            <!--      </select>-->
            <!--    </div>-->
            <!--</div>-->
            <script>
                document.getElementById('type-select').addEventListener('change', function () {
                    const selectedType = this.value;
                    const subtypeContainer = document.getElementById('subtype-container');
                    const subtypeSelect = document.getElementById('subtype-select');
                    const adv_img = document.querySelector('.adv_img');
                    const adv_title = document.querySelector('.adv_title');
                    $.ajax({
                        url: 'admin/typeEntry',
                        type: 'post',
                        data: {typeSelected: selectedType},
                        success: function(response) {
                            var dataSelected = JSON.parse(response);
                            console.log(dataSelected);
                            subtypeSelect.innerHTML = '<option value="">None</option>'; 
                    
                            if (selectedType && dataSelected.length > 0) {
                                dataSelected.forEach(function(item) {
                                    const option = document.createElement('option');
                                    option.value = item.id; 
                                    option.textContent = item.title;
                                    subtypeSelect.appendChild(option);
                                });
                    
                                subtypeContainer.style.display = 'block'; 
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                            } else if(selectedType === 'none'){
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'block';
                                adv_title.style.display = 'block';
                            } else {
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                            }
                        }
                    });
                });
                
                // document.getElementById('typeCS-select').addEventListener('change', function () {
                //     const selectedType = this.value;
                //     const subtypeContainer = document.getElementById('subtypeCS-container');
                //     const subtypeSelect = document.getElementById('subtypeCS-select');
                //     const adv_img = document.querySelector('.adv_img');
                //     const adv_title = document.querySelector('.adv_title');
                //     $.ajax({
                //         url: 'admin/typeEntry',
                //         type: 'post',
                //         data: {typeSelected: selectedType},
                //         success: function(response) {
                //             var dataSelected = JSON.parse(response);
                //             console.log(dataSelected);
                //             subtypeSelect.innerHTML = '<option value="0">None</option>'; 
                    
                //             if (selectedType && dataSelected.length > 0) {
                //                 dataSelected.forEach(function(item) {
                //                     const option = document.createElement('option');
                //                     option.value = item.id; 
                //                     option.textContent = item.title;
                //                     subtypeSelect.appendChild(option);
                //                 });
                    
                //                 subtypeContainer.style.display = 'block'; 
                //                 adv_img.style.display = 'none';
                //                 adv_title.style.display = 'none';
                //             } else if(selectedType === 'none'){
                //                 subtypeContainer.style.display = 'none';
                //                 adv_img.style.display = 'block';
                //                 adv_title.style.display = 'block';
                //             } else {
                //                 subtypeContainer.style.display = 'none';
                //                 adv_img.style.display = 'none';
                //                 adv_title.style.display = 'none';
                //             }
                //         }
                //     });
                // });
                
            </script>
            
            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Contact Title</label>
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
                    <td class="text-start required">Data</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <?php $rowNo=0; if (!empty($featureList)) { foreach ($featureList as $key => $row) {  $rowNo = $row->id; ?>
                    <tr class="mb-3" id="image-row<?php echo $row->id; ?>">
                        <td class="text-left">
                            <!-- Title Input -->
                            <div class="mb-3">
                                <input type="hidden" name="keyid[]" value="<?= $row->id ?>" />
                                <label for="input-title-<?php echo $row->id; ?>" class="col-sm-2">Title</label>
                                <input type="text" name="title[]" value="<?php echo $row->title; ?>" placeholder="Title" id="input-title-<?php echo $row->id; ?>" class="form-control" />
                            </div>
                            <div class="row mb-3">
                                <label for="input-email" class="col-sm-2 ">Featured Thumbnail</label>
                                <div class="col-sm-10">       
                                <?php if (!empty($row->featuredThumb)): ?>
                                <img src="<?php echo base_url($row->featuredThumb); ?>" width="100" height="100">
                                <input type="hidden" name="old_featuredThumb[<?= $key ?>]" value="<?php echo $row->featuredThumb; ?>">
                                <?php endif ?>
                                <input type="file" name="featuredThumb[<?= $key ?>]"  id="input-image" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="input-thumb" class="col-sm-2">Thumbnail Alt tag</label>
                                <input type="text" name="thumb_alt[]" value="<?php echo $row->thumb_alt; ?>" placeholder="Alt Text" class="form-control" />
                            </div>
                            <div class="row mb-3">
                                <label for="input-email" class="col-sm-2 ">Featured Banner</label>
                                <div class="col-sm-10">       
                                <?php if (!empty($row->featuredBanner)): ?>
                                <img src="<?php echo base_url($row->featuredBanner); ?>" width="100" height="100">
                                <input type="hidden" name="old_featuredBanner[<?= $key ?>]" value="<?php echo $row->featuredBanner; ?>">
                                <?php endif ?>
                                <input type="file" name="featuredBanner[<?= $key ?>]"  id="input-image" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="input-banner" class="col-sm-2">Banner Alt tag</label>
                                <input type="text" name="banner_alt[]" value="<?php echo $row->banner_alt; ?>" placeholder="Alt Text" class="form-control" />
                            </div>
                            <!-- Short Description Input -->
                            <div class="mb-3">
                                <label for="input-short-desc" class="col-sm-2">Short Description</label>
                                <input type="text" name="short_description[]" value="<?php echo $row->short_description; ?>" placeholder="Short Description" id="input-short-desc-<?php echo $row->id; ?>" class="form-control" />
                            </div>

                            <!-- Header Q&A -->
                            <div class="mb-3">
                                <label for="input-header-qna-<?php echo $row->id; ?>" class="col-sm-2">Header QnA</label>
                                <ul class="d-flex list-inline align-items-center">
                                    <li class="list-inline-item w-50">
                                        <textarea name="headerQue[]" placeholder="Question" class="form-control"><?php echo $row->header_question; ?></textarea>
                                    </li>
                                    <li class="list-inline-item w-50">
                                        <textarea name="headerAns[]" id="ans-editor<?php echo $row->id; ?>" placeholder="Answer" class="form-control ckeditor"><?php echo $row->header_answer; ?></textarea>
                                    </li>
                                </ul>
                            </div>

                            <!-- Feature Description -->
                            <div class="mb-3">
                                <label for="editor<?php echo $row->id; ?>" class="col-sm-2">Feature Description</label>
                                <textarea name="featureDescription[]" placeholder="Description" id="editor<?php echo $row->id; ?>" class="form-control ckeditor">
                                    <?php echo $row->feature_description; ?>
                                </textarea>
                            </div>

                            <!-- Pointers Section -->
                            <div class="mb-3" id="pointers<?php echo $row->id; ?>">
                                <label class="col-sm-2">Pointers</label>
                                <?php if (!empty($row->pointers)) { ?>
                                    <?php foreach ($row->pointers as $pointer_key => $pointer) { ?>
                                        <ul class="list-inline d-flex align-items-center" id="pointer-row<?php echo $row->id . '-' . $pointer_key; ?>">
                                            <li class="list-inline-item">
                                                <textarea name="featurePointers[<?php echo $row->id; ?>][]" placeholder="Pointer" id="pointer-editor<?php echo $row->id . '-' . $pointer_key; ?>" class="form-control ckeditor">
                                                    <?php echo $pointer; ?>
                                                </textarea>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" onclick="$('#pointer-row<?php echo $row->id . '-' . $pointer_key; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" onclick="addPointers(<?php echo $row->id; ?>);" data-toggle="tooltip" title="Add Pointer" class="btn btn-primary">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                    
                                <?php } else { ?>
                                    <ul class="list-inline d-flex align-items-center" id="pointer-row<?php echo $row->id; ?>-0">
                                        <li class="list-inline-item">
                                            <textarea name="featurePointers[<?php echo $row->id; ?>][]" placeholder="Pointer" id="pointer-editor<?php echo $row->id ?>-0" class="form-control ckeditor"></textarea>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button" onclick="addPointers(<?php echo $row->id; ?>);" data-toggle="tooltip" title="Add Pointer" class="btn btn-primary">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </div>

                            <!-- Q&A Section -->
                            <div class="mb-3" id="QNA<?php echo $row->id; ?>">
                                <label class="col-sm-2">FAQs</label>
                                <?php if (!empty($row->questions)) { ?>
                                    <?php foreach ($row->questions as $question_key => $qa) {  ?>
                                        <ul class="list-inline d-flex align-items-center" id="qa-row<?php echo $row->id . '-' . $question_key; ?>">
                                            <li class="list-inline-item w-40">
                                                <textarea type="text" name="feature_que[<?php echo $row->id; ?>][]" placeholder="Question" class="form-control" ><?php echo $qa->question; ?></textarea>
                                            </li>
                                            <li class="list-inline-item w-40">
                                                <textarea type="text" name="feature_ans[<?php echo $row->id; ?>][]" id="faqans-editor<?php echo $row->id . '-' . $question_key; ?>" placeholder="Answer" class="form-control ckeditor" ><?php echo $qa->answer; ?></textarea>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" onclick="$('#qa-row<?php echo $row->id . '-' . $question_key; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" onclick="addQNA(<?php echo $row->id; ?>);" data-toggle="tooltip" title="Add Q&A" class="btn btn-primary">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                    
                                <?php } else { ?>
                                    <ul class="list-inline d-flex align-items-center" id="qa-row<?php echo $row->id; ?>-0">
                                        <li class="list-inline-item w-40">
                                            <textarea type="text" name="feature_que[<?php echo $row->id; ?>][]" placeholder="Question" class="form-control" ></textarea>
                                        </li>
                                        <li class="list-inline-item w-40">
                                            <textarea type="text" name="feature_ans[<?php echo $row->id; ?>][]" id="faqans-editor<?php echo $row->id ?>-0" placeholder="Answer" class="form-control ckeditor" ></textarea>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button" onclick="addQNA(<?php echo $row->id; ?>);" data-toggle="tooltip" title="Add Q&A" class="btn btn-primary">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </li>
                                    </ul>
                                <?php } ?>
                            </div>

                            <!-- Slug -->
                            <div class="mb-3">
                                <label for="input-slug-<?php echo $row->id; ?>" class="col-sm-2">Slug</label>
                                <input name="feature_slug[]" placeholder="Slug" value="<?php echo $row->slug; ?>" id="input-slug-<?php echo $row->id; ?>" class="form-control" />
                            </div>

                            <!-- Sort Order -->
                            <div class="mb-3">
                                <label for="input-sort-<?php echo $row->id; ?>" class="col-sm-2">Sort Order</label>
                                <input type="number" name="feature_sort_order[]" value="<?php echo $row->sort_order; ?>" placeholder="Sort Order" id="input-sort-<?php echo $row->id; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="input-sort-<?php echo $row->id; ?>" class="col-sm-2">Meta title</label>
                                <input type="text" name="meta_title[]" value="<?php echo $row->metaTitle; ?>" placeholder="Meta title" id="input-sort-<?php echo $row->id; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="input-sort-<?php echo $row->id; ?>" class="col-sm-2">Meta Keyword</label>
                                <input type="text" name="meta_keyword[]" value="<?php echo $row->metaKeyword; ?>" placeholder="Meta Keyword" id="input-sort-<?php echo $row->id; ?>" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="input-sort-<?php echo $row->id; ?>" class="col-sm-2">Meta Description</label>
                                <input type="text" name="meta_description[]" value="<?php echo $row->metaDescription; ?>" placeholder="Meta Description" id="input-sort-<?php echo $row->id; ?>" class="form-control" />
                            </div>
                            <div class="row mb-3">
                                <label for="input-status" class="col-sm-6">Status</label>
                                <div class="col-sm-4">
                                    <!-- <div class="form-check form-switch form-switch-lg"> -->
                                    <select name="featureStatus[]" class="form-control">
                                        <option value="1" <?= $row->status == 1 ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $row->status == 0 ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </td>

                        <!-- Remove Section -->
                        <td class="text-left">
                            <button type="button" onclick="$('#image-row<?php echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                                <i class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr> 
                <?php } } ?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-left">
                        <button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Special" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>
                        </button>
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
        var image_row = <?php echo $rowNo != 0?$rowNo+1:0; ?>;
        var pointer_row = {};
        var qna_row = {};
        
        // Initialize pointer_row and qna_row for existing rows
        <?php if (!empty($featureList)) { foreach ($featureList as $key => $row) { ?>
            pointer_row[<?php echo $row->id; ?>] = <?php echo count($row->pointers); ?>;
            qna_row[<?php echo $row->id; ?>] = <?php echo count($row->questions); ?>;
        <?php } } ?>
        
        function addImage() {
            pointer_row[image_row] = 0;
            qna_row[image_row] = 0;
            
            let html = `
                <tr class="mb-3" id="image-row${image_row}">
                    <td class="text-left">
                        <div class="mb-3">
                            <input type="hidden" name="keyid[]" value="${image_row}" />
                            <label for="input-status" class="col-sm-2">Title</label>
                            <input type="text" name="title[]" placeholder="Title" class="form-control required" />
                        </div>
                        <div class="row mb-3">
                            <label for="input-email" class="col-sm-2 ">Featured Thumbnail</label>
                            <div class="col-sm-10">
                            <input type="file" name="featuredThumb[]"  id="input-image" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="input-thumb" class="col-sm-2">Thumbnail Alt tag</label>
                            <input type="text" name="thumb_alt[]" placeholder="Alt Text" class="form-control" />
                        </div>
                        <div class="row mb-3">
                            <label for="input-email" class="col-sm-2 ">Featured Banner</label>
                            <div class="col-sm-10">
                            <input type="file" name="featuredBanner[]"  id="input-image" class="form-control" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="input-banner" class="col-sm-2">Banner Alt tag</label>
                            <input type="text" name="banner_alt[]" placeholder="Alt Text" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Short Description</label>
                            <input type="text" name="short_description[]" placeholder="Short description" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Header QnA</label>
                            <ul class="d-flex list-inline align-items-center">
                                <li class="list-inline-item w-50">
                                    <textarea name="headerQue[]" placeholder="Question" class="form-control"></textarea>
                                </li>
                                <li class="list-inline-item w-50">
                                    <textarea name="headerAns[]" id="ans-editor${image_row}" placeholder="Answer" class="form-control ckeditor"></textarea>
                                </li>
                            </ul>    
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Feature Description</label>
                            <textarea name="featureDescription[]" placeholder="Description" class="form-control ckeditor" id="editor${image_row}"></textarea>
                        </div>
                        <div class="mb-3" id="pointers${image_row}">
                            <label for="input-status" class="col-sm-2">Pointers</label>
                            <ul class="list-inline d-flex align-items-center" id="pointer-row${image_row}-0">
                                <li class="list-inline-item">
                                    <textarea name="featurePointers[${image_row}][]" placeholder="Pointer" class="form-control ckeditor" id="pointer-editor${image_row}-0"></textarea>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" onclick="addPointers(${image_row});" data-toggle="tooltip" title="Add Pointer" class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-3" id="QNA${image_row}">
                            <label for="input-status" class="col-sm-2">FAQs</label>
                            <ul class="d-flex list-inline align-items-center" id="qna-row${image_row}-0">
                                <li class="list-inline-item w-25">
                                    <textarea name="feature_que[${image_row}][]" placeholder="Question" class="form-control"></textarea>
                                </li>
                                <li class="list-inline-item w-25">
                                    <textarea name="feature_ans[${image_row}][]" placeholder="Answer" class="form-control ckeditor" id="faqans-editor${image_row}-0"></textarea>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" onclick="addQNA(${image_row});" data-toggle="tooltip" title="Add Pointer" class="btn btn-primary">
                                        <i class="fa fa-plus-circle"></i>
                                </li>
                            </ul>    
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Slug</label>
                            <textarea name="feature_slug[]" placeholder="Slug" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Sort Order</label>
                            <input type="number" name="feature_sort_order[]" placeholder="" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Meta Title</label>
                            <input type="text" name="meta_title[]" placeholder="" class="form-control required" />
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Meta Keyword</label>
                            <input type="text" name="meta_keyword[]" placeholder="" class="form-control required" />
                        </div>
                        <div class="mb-3">
                            <label for="input-status" class="col-sm-2">Meta Description</label>
                            <input type="text" name="meta_description[]" placeholder="" class="form-control required" />
                        </div>
                        <div class="row mb-3">
                            <label for="input-status" class="col-sm-2">Status</label>
                            <div class="col-sm-10">
                                <div class="form-check form-switch form-switch-lg">
                                    <input type="hidden" name="featureStatus" value="0" />
                                    <input type="checkbox" name="featureStatus" value="1" id="input-status" class="form-check-input" <?php echo $status==1?'checked':''; ?> />
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="text-left">
                        <button type="button" onclick="$('#image-row${image_row}, .tooltip').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </td>
                </tr>`;
        
            $('#images tbody').append(html);
        
            CKEDITOR.replace('ans-editor' + image_row);
            CKEDITOR.replace('editor' + image_row);
            CKEDITOR.replace(`pointer-editor${image_row}-0`);
            CKEDITOR.replace(`faqans-editor${image_row}-0`);
            
            image_row++;
        }
        
        function addPointers(rowId) {
            let current_pointer = pointer_row[rowId]++;
            let new_pointer_id = `pointer-row${rowId}-${current_pointer + 1}`;
            let editor_id = `pointer-editor${rowId}-${current_pointer + 1}`;
        
            let html = `
                <ul class="list-inline d-flex align-items-center" id="${new_pointer_id}">
                    <li class="list-inline-item">
                        <textarea name="featurePointers[${rowId}][]" placeholder="Pointer" class="form-control ckeditor" id="${editor_id}">Pointers</textarea>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" onclick="$('#${new_pointer_id}, .tooltip').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </li>
                </ul>`;
        
            $(`#pointers${rowId}`).append(html);
        
            CKEDITOR.replace(editor_id);
        }
        function addQNA(rowId) {
            let current_qna = qna_row[rowId]++;
            let new_pointer_id = `qna-row${rowId}-${current_qna + 1}`;
            let editor_id = `faqans-editor${rowId}-${current_qna + 1}`;
        
            let html = `
                <ul class="d-flex list-inline align-items-center" id="${new_pointer_id}">
                    <li class="list-inline-item w-25">
                        <textarea name="feature_que[${rowId}][]" placeholder="Question" class="form-control"></textarea>
                    </li>
                    <li class="list-inline-item w-25">
                        <textarea name="feature_ans[${rowId}][]" placeholder="Answer" class="form-control ckeditor" id="${editor_id}"></textarea>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" onclick="$('#${new_pointer_id}, .tooltip').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </li>
                </ul> `;
        
            $(`#QNA${rowId}`).append(html);
            CKEDITOR.replace(editor_id);
        
        }
</script>





<?php $this->endSection(); ?>