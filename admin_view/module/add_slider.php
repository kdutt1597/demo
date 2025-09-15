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
  <a href="<?php echo base_url('admin/sliders');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-faq" data-bs-toggle="tab" class="nav-link">Sliders</a></li>

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
      <fieldset>
        
          <div class="row mb-3 required">
              <label for="input-username" class="col-sm-2 col-form-label">Slider Name</label>
              <div class="col-sm-10">
                  <input type="text" name="name" value="<?php echo set_value('name',$name); ?>" placeholder="name"  class="form-control" />

                 <?php echo $validation->hasError('name')?$validation->showError('name','my_single'):''; ?>
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Banner Heading</label>
              <div class="col-sm-10">
                  <input type="text" name="heading" value="<?php echo set_value('heading',$heading); ?>" placeholder="heading"  class="form-control" />

              </div>
          </div>

               <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Sub Heading</label>
              <div class="col-sm-10">
                  <input type="text" name="sub_heading" value="<?php echo set_value('sub_heading',$sub_heading); ?>" placeholder=""  class="form-control" />

              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                    <textarea name="description" class="form-control" rows="5"><?php echo set_value('description',$description); ?></textarea>
              </div>
          </div>


           <div class="row mb-3 ">
              <label for="input-username" class="col-sm-2 col-form-label">Slider Link</label>
              <div class="col-sm-10">
                  <input type="text" name="slider_link" value="<?php echo set_value('slider_link',$slider_link); ?>" placeholder=""  class="form-control" />

              </div>
          </div>


         
      </fieldset>

  </div>


<div id="tab-faq" class="tab-pane">

<div class="table-responsive">
        <table id="images" class="table table-striped table-bordered table-hover">
         <thead>
          <tr>

           <td class="text-start required">Title</td>
          <td class="text-start">Description</td>
          <td class="text-start">Image</td>
               <td class="text-start">Link </td>
          <td class="text-start">Sort Order </td>
           <td>Action</td>
          </tr>
         </thead>
         <tbody>
         <?php if (!empty($sliderList)){ foreach ($sliderList as $key => $row) {?>
         
         <tr id="image-row<?php  echo $row->id; ?>">  

            <td class="text-left"><input type="text" name="title[]" value="<?php echo $row->title; ?>"  placeholder="Title" class="form-control" /></td>
       
            <td class="text-left" style="width: 30%;"><textarea name="sliderDescription[]"  placeholder="Description" class="form-control"><?php echo $row->description; ?></textarea></td>

            <td class="text-center">
              <?php if (!empty($row->image)){   $ext = pathinfo($row->image, PATHINFO_EXTENSION); ?>

                   <?php if ($ext=='mp4') {?>
                            
                 <video muted autoplay loop playsinline class="future_media" width="200" height="200">
                    <source src="<?php echo base_url($row->image); ?>" type="video/mp4">
                 </video>

                  <?php }else{ ?>
                        <img src="<?php echo base_url($row->image) ?>" width="100" height="100">
                  <?php } ?>

                

                  <input type="hidden" name="old_image[]" value="<?php echo $row->image; ?>">
              <?php } ?>


              <input type="file" class="form-control" name="image[]"  id="input-image' + image_row + '" />

            </td>

              <td class="text-right" style="width: 10%;"><input type="text" name="link[]"  placeholder="Link" class="form-control " value="<?php echo $row->link; ?>" /></td>

              <td class="text-right" style="width: 10%;"><input type="number" name="sort_order[]"  placeholder="Sort Order" class="form-control" value="<?php echo $row->sort_order; ?>" />


             <td class="text-left"><button type="button" onclick="$('#image-row<?php  echo $row->id; ?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
       </td>
     </tr>  



        <?php } } ?>  



         </tbody>

         <tfoot>
          <tr>
           <td colspan="5"></td>
           <td class="text-left">
            <button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
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
  var image_row = 0;

    function addImage() {
    html  = '<tr id="image-row' + image_row + '">';
      html += '  <td class="text-left"><input type="text" name="title[]"  placeholder="Title" class="form-control required" /></td>';
    html += '  <td class="text-left" style="width: 30%;"><textarea name="sliderDescription[]"  placeholder="Description" class="form-control"></textarea></td>';
    html += '  <td class="text-center"><input type="file" class="form-control" name="image[]"  id="input-image' + image_row + '" /></td>';
    
     html += '  <td class="text-right" style="width: 10%;"><input type="text" name="link[]"  placeholder="Link" class="form-control " /></td>';

    html += '  <td class="text-right" style="width: 10%;"><input type="number" name="sort_order[]"  placeholder="Sort Order" class="form-control" /></td>';

    html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

    $('#images tbody').append(html);

    image_row++;
  }
</script>





<?php $this->endSection(); ?>