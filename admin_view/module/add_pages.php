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
  <a href="<?php echo base_url('admin/pages');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
 <!--<li class="nav-item"><a href="#tab-counter" data-bs-toggle="tab" class="nav-link">Counter</a></li>-->
 <!--<li class="nav-item"><a href="#tab-images" data-bs-toggle="tab" class="nav-link">Images</a></li>-->
  <!-- <li class="nav-item"><a href="#tab-faq" data-bs-toggle="tab" class="nav-link">Faq</a></li> -->

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Page Title</label>
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


           <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Additional Title</label>
              <div class="col-sm-10">
       
                 <textarea name="title1" class="form-control" rows="5"><?php echo set_value('title1',$title1); ?></textarea>

              </div>
          </div>

              <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Additional Description</label>
              <div class="col-sm-10">
                 <textarea name="description1" class="form-control" rows="5"><?php echo set_value('description1',$description1); ?></textarea>
          
              </div>
          </div>

                 <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Additional image</label>
              <div class="col-sm-10">
                 <?php if (!empty($image1)): ?>
                <img src="<?php echo base_url($image1); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="image1"  id="input-image" class="form-control" />
          
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



           <div class="row mb-3 required">
              <label for="input-email" class="col-sm-2 col-form-label">Banner</label>
              <div class="col-sm-10">       
               <?php if (!empty($image)): ?>
                <img src="<?php echo base_url($image); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="image"  id="input-image" class="form-control" />
              </div>
          </div>

          <!-- <div class="row mb-3 ">-->
          <!--    <label for="input-email" class="col-sm-2 col-form-label">Banner Title</label>-->
          <!--    <div class="col-sm-10">-->
       
          <!--       <input type="text" name="bannerTitle" value="<?php echo set_value('bannerTitle',$bannerTitle); ?>" placeholder=""  class="form-control" />-->

          <!--    </div>-->
          <!--</div>-->

          <!--    <div class="row mb-3 ">-->
          <!--    <label for="input-lastname" class="col-sm-2 col-form-label">Banner Description</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <textarea name="bannerDescription" class="form-control" rows="5"><?php echo set_value('bannerDescription',$bannerDescription); ?></textarea>-->
          
          <!--    </div>-->
          <!--</div>-->


            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Slug (optional)</label>
              <div class="col-sm-10">
       
                 <input type="text" name="slug" value="<?php echo set_value('slug',$slug); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

          <!--    <div class="row mb-3">-->
          <!--    <label for="input-status" class="col-sm-2 col-form-label">Type</label>-->
          <!--    <div class="col-sm-10">-->
          <!--       <select name="type" class="form-control required">-->
          <!--         <option value="">Select</option>-->
          <!--         <?php foreach ($typeList as $key => $value): ?>-->
          <!--           <option value="<?php echo $key;  ?>" <?php echo $type==$key?'selected':''; ?>><?php echo $value; ?></option>-->
          <!--         <?php endforeach ?>-->
          <!--       </select>-->
          <!--    </div>-->
          <!--</div>-->


          <!-- <div class="row mb-3">-->
          <!--    <label for="input-status" class="col-sm-2 col-form-label">Sort Order</label>-->
          <!--    <div class="col-sm-10">-->
          <!--        <input type="number" name="sort_order" value="<?php echo set_value('sort_order',$sort_order); ?>" placeholder=""  class="form-control" />-->
          <!--    </div>-->
          <!--</div>-->

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

<div id="tab-faq" class="tab-pane">

<div class="table-responsive">
        <table id="special" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-left">Question</td>
  
           <td class="text-left">Answer</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($faqList)){ foreach ($faqList as $key => $row) {?>
         
         <tr id="special-row<?php  echo $row->id; ?>">  

       <td class="text-right"><textarea type="text" rows="5" name="question[]" placeholder="Question" class="form-control"><?php echo @$row->question; ?></textarea> 
       </td> 
       
         <td class="text-left" style="width: 20%;">
          <div class="input-group"><textarea type="text" rows="5" name="answer[]" placeholder="Answer " class="form-control"><?php echo @$row->answer; ?></textarea> 
         </div>
       </td>  
       <td class="text-left"><button type="button" onclick="$('#special-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="2"></td>
           <td class="text-left">
            <button type="button" onclick="addSpecial();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>


<div id="tab-counter" class="tab-pane">

<div class="table-responsive">
        <table id="counter" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-left">Title</td>
           <td class="text-left">Value</td>
           <td class="text-left">Symbol</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($counterList)){ foreach ($counterList as $key => $row) {?>
         
         <tr id="counter-row<?php  echo $row->id; ?>">  

       <td class="text-left"><input type="text"  name="counterTitle[]" value="<?php echo $row->title; ?>" placeholder="title" class="form-control"></td>
       
       <td class="text-left"><input type="text"  name="counterDescription[]" value="<?php echo $row->value; ?>" placeholder="description" class="form-control"></td>
       
       <td class="text-left"><input type="text"  name="counterSymbol[]" value="<?php echo $row->symbol; ?>" placeholder="Symbol" class="form-control"></td>

       <td class="text-left"><button type="button" onclick="$('#counter-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="3"></td>
           <td class="text-left">
            <button type="button" onclick="addCounter();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
           </td>
          </tr>
         </tfoot>
        </table>
       </div>

</div>


<div id="tab-images" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-left">Images</td>
           <td class="text-left">Sort order</td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($imagesList)){ foreach ($imagesList as $key => $row) {?>
         
         <tr id="images-row<?php  echo $row->id; ?>">  

        <td class="text-left">
          <?php if (!empty($row->image)): ?>
            <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
            <input type="hidden" name="old_image[]" value="<?php echo $row->image; ?>">
          <?php endif ?>
          <input type="file"  name="images[]" placeholder="" class="form-control">
        </td> 
       
       <td class="text-left"><input type="number" name="imagesSortOrder[]" placeholder="" class="form-control" value="<?php echo $row->sortOrder; ?>" ></td>

       <td class="text-left"><button type="button" onclick="$('#images-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="2"></td>
           <td class="text-left">
            <button type="button" onclick="addImages();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
  var special_row = 0;

  function addSpecial() {
    html  = '<tr id="special-row' + special_row + '">';
   
      html += '  <td class="text-left"><textarea type="text" rows="5" name="question[]" placeholder="Question" class="form-control"></textarea></td>';

    html += '  <td class="text-left"><textarea type="text" rows="5" name="answer[]" placeholder="Answer" class="form-control"></textarea></td>';
     
    html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#special tbody').append(html);

    $('.date').datetimepicker({
      language: 'en-gb',
      pickTime: false
    });

    special_row++;
  }





  var counter = 0;

  function addCounter() {
    html  = '<tr id="counter-row' + counter + '">';
   
      html += '  <td class="text-left"><input type="text"  name="counterTitle[]" placeholder="title" class="form-control"></td>';

    html += '  <td class="text-left"><input type="text" name="counterDescription[]" placeholder="description" class="form-control"></td>';

        html += '  <td class="text-left"><input type="text" name="counterSymbol[]" placeholder="+" class="form-control" ></td>';
     
    html += '  <td class="text-left"><button type="button" onclick="$(\'#counter-row' + counter + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#counter tbody').append(html);

    $('.date').datetimepicker({
      language: 'en-gb',
      pickTime: false
    });

    counter++;
  }




  var images = 0;

  function addImages() {
    html  = '<tr id="images-row' + images + '">';
   
      html += '  <td class="text-left"><input type="file"  name="images[]" placeholder="title" class="form-control"></td>';

    html += '  <td class="text-left"><input type="number" name="imagesSortOrder[]" placeholder="" class="form-control" ></td>';
     
    html += '  <td class="text-left"><button type="button" onclick="$(\'#images-row' + images + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    $('.date').datetimepicker({
      language: 'en-gb',
      pickTime: false
    });

    images++;
  }


</script>





<?php $this->endSection(); ?>