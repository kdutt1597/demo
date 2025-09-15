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
  <a href="<?php echo base_url('admin/add_whatis');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-feature" data-bs-toggle="tab" class="nav-link">FAQ</a></li>
</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Title</label>
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
              <label for="input-email" class="col-sm-2 col-form-label">Banner</label>
              <div class="col-sm-10">       
               <?php if (!empty($image)): ?>
                <img src="<?php echo base_url($image); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="banner"  id="input-image" class="form-control" />
              </div>
          </div>
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">ALT Tag</label>
              <div class="col-sm-10">       
             
              <input type="text" name="banner_alt_tag" value="<?php echo set_value('banner_alt_tag',$banner_alt_tag) ?>" id="input-image" class="form-control" />
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
              <label for="input-email" class="col-sm-2 col-form-label">ALT Tag</label>
              <div class="col-sm-10">       
             
              <input type="text" name="thumb_alt_tag" value="<?php echo set_value('thumb_alt_tag',$thumb_alt_tag) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          
          
         <legend>What is Data</legend>

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
                                <?php echo $value->cat_name; ?>
                            </option>
                        <?php endforeach; ?>
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

            


           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Slug (optional)</label>
              <div class="col-sm-10">
                  <input type="text" name="slug" value="<?php echo set_value('slug',$slug); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Editor's Pick</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="editor_picks" value="1"  id="input-image" <?php echo $editor_picks==1?'checked':''; ?> />
              </div>
          </div>
          
         <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Top Resources</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="top_resources" value="1"  id="input-image" <?php echo $top_resources==1?'checked':''; ?> />
              </div>
          </div>
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Trending Insights</label>
              <div class="col-sm-10">       
             
              <input type="checkbox" name="trending_insights" value="1"  id="input-image" <?php echo $trending_insights==1?'checked':''; ?> />
              </div>
          </div>
          
               <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Sort Order</label>
              <div class="col-sm-10">       
             
              <input type="number" name="sortOrder" class="form-control" value="<?php echo set_value('sortOrder',$sortOrder); ?>"  id="input-image"  />
              </div>
          </div>
          <div class="row mb-3">
              <label for="input-email" class="col-sm-2 col-form-label">Publish Date</label>
              <div class="col-sm-10">       
             
              <input type="text" name="publish" value="<?php echo set_value('publish',$publish) ?>" id="input-image" class="form-control" />
              </div>
          </div>
          
</div>







<div id="tab-feature" class="tab-pane">

<div class="table-responsive">
  <table id="faqs" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <td class="text-start">Question</td>
        <td class="text-start">Answer</td>
        <td class="text-start">Sort Order</td>
        <td>Action</td>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($faqList)) { foreach ($faqList as $key => $row) { ?>
      <tr id="faq-row<?php echo $row->id; ?>">
        <td class="text-left"><input type="text" name="faq_question[]" value="<?php echo $row->question; ?>" placeholder="Question" class="form-control" /></td>
        <td class="text-left" style="width: 30%;"><textarea name="faq_answer[]" placeholder="Answer" class="form-control ckeditor"><?php echo $row->answer; ?></textarea></td>
        <td class="text-right" style="width: 10%;"><input type="number" name="faq_sort_order[]" placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" /></td>
        <td class="text-left"><button type="button" onclick="$('#faq-row<?php echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
      </tr>
      <?php } } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3"></td>
        <td class="text-left">
          <button type="button" onclick="addFaq();" data-toggle="tooltip" title="Add FAQ" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
var faq_row = 0;

function addFaq() {
  html = '<tr id="faq-row' + faq_row + '">';
  html += '  <td class="text-left"><input type="text" name="faq_question[]" placeholder="Question" class="form-control" /></td>';
  html += '  <td class="text-left" style="width: 30%;"><textarea name="faq_answer[]" placeholder="Answer" class="form-control ckeditor" id="faq-editor' + faq_row + '"></textarea></td>';
  html += '  <td class="text-right" style="width: 10%;"><input type="number" name="faq_sort_order[]" placeholder="Sort Order" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#faq-row' + faq_row + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#faqs tbody').append(html);
  CKEDITOR.replace('faq-editor' + faq_row);
  faq_row++;
}

</script>





<?php $this->endSection(); ?>