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
  <a href="<?php echo base_url('admin/glossary');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Keys</label>
              <div class="col-sm-10">
                  <select name="alphabet" class="form-control">
                      <option>Select Option</option>
                      <?php foreach( range('A','Z') as $letter): ?>
                        <option value="<?= $letter ?>" <?= set_select('alphabet', $letter, ($letter == $alphabet)); ?>><?= $letter ?></option>
                      <?php endforeach; ?>    
                  </select>

                 <?php echo $validation->hasError('alphabet')?$validation->showError('alphabet','my_single'):''; ?>
              </div>
          </div>

          <div class="row mb-3 ">
            <label for="input-username" class="col-sm-2 col-form-label">Term</label>
              <div class="col-sm-10">
                    <input type="text" name="keyword" value="<?php echo set_value('keyword',$keyword); ?>" placeholder="Keyword"  class="form-control" />

                    <?php echo $validation->hasError('keyword')?$validation->showError('keyword','my_single'):''; ?>
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                    <textarea name="description" class="form-control ckeditor" rows="5"><?php echo set_value('description',$description); ?></textarea>
              </div>
              <?php echo $validation->hasError('keyword')?$validation->showError('description','my_single'):''; ?>
          </div>

           <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">Meta Title</label>
              <div class="col-sm-10">
                 <input type="text" name="metaTitle" value="<?php echo set_value('metaTitle',$metaTitle); ?>" placeholder="Meta Title"  class="form-control" />
              </div>
              <?php echo $validation->hasError('metaTitle')?$validation->showError('metaTitle','my_single'):''; ?>
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