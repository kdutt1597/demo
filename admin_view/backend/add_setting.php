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
  <a href="<?php echo base_url('admin/setting');?>" data-bs-toggle="tooltip" title="Back" class="btn btn-light">
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
  <li class="nav-item"><a href="#tab-image" data-bs-toggle="tab" class="nav-link">Image</a></li>
  <li class="nav-item"><a href="#tab-social" data-bs-toggle="tab" class="nav-link">Social</a></li>
  <li class="nav-item"><a href="#tab-mail" data-bs-toggle="tab" class="nav-link">Mail</a></li>

</ul>


 <div class="tab-content">
   <div id="tab-general" class="tab-pane active">
 
      <fieldset>
        <label>Meta</label>

          <div class="row mb-3 required">
              <label for="input-password" class="col-sm-2 col-form-label">Meta Title</label>
              <div class="col-sm-10">
                 <input type="text" name="config_meta_title" value="<?php echo set_value('config_meta_title',$config['config_meta_title']); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>
          <div class="row mb-3 ">
              <label for="input-confirm" class="col-sm-2 col-form-label">Meta Keyword</label>
              <div class="col-sm-10">
                    <textarea name="config_meta_keyword" class="form-control" rows="5"><?php echo set_value('config_meta_keyword',$config['config_meta_keyword']); ?></textarea>
              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Meta  Description</label>
              <div class="col-sm-10">
       
                <textarea name="config_meta_description" class="form-control" rows="5"><?php echo set_value('config_meta_description',$config['config_meta_description']); ?></textarea>

              </div>
          </div>
          <label>Enqury Form Heading</label>

           <div class="row mb-3">
              <label for="input-password" class="col-sm-2 col-form-label"> Title</label>
              <div class="col-sm-10">
                 <input type="text" name="form_title" value="<?php echo set_value('form_title',$config['form_title']); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-confirm" class="col-sm-2 col-form-label"> Description</label>
              <div class="col-sm-10">
                    <textarea name="form_description" class="form-control" rows="5"><?php echo set_value('form_description',$config['form_description']); ?></textarea>
              </div>
          </div>

         <div class="row mb-3">
              <label for="input-password" class="col-sm-2 col-form-label">Success Msg</label>
              <div class="col-sm-10">
                 <input type="text" name="success_msg" value="<?php echo set_value('success_msg',$config['success_msg']); ?>"  placeholder=""  class="form-control"   />
              </div>
          </div>
    
            <div class="row mb-3 ">
              <label for="input-confirm" class="col-sm-2 col-form-label"> Privacy policy Description</label>
              <div class="col-sm-10">
                    <textarea name="privacy_policy" class="form-control ckeditor" rows="5"><?php echo set_value('privacy_policy',$config['privacy_policy']); ?></textarea>
              </div>
          </div>

      </fieldset>


  </div>



    <div id="tab-authorize" class="tab-pane">

        <fieldset>
              
          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Store Name</label>
              <div class="col-sm-10">
                   <input type="text" name="config_name" value="<?php echo set_value('config_name',$config['config_name']); ?>" placeholder="" class="form-control" />
                  <?php echo $validation->hasError('config_name')?$validation->showError('config_name','my_single'):''; ?>
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
       
                <textarea name="config_address" class="form-control" rows="4"><?php echo set_value('config_address',$config['config_address']); ?></textarea>

              </div>
          </div>

             <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Google Iframe</label>
              <div class="col-sm-10">
       
                <textarea name="config_google_iframe" class="form-control" rows="4"><?php echo set_value('config_google_iframe',$config['config_google_iframe']); ?></textarea>

              </div>
          </div>


          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">E-Mail</label>
              <div class="col-sm-10">
                 <input type="text" name="config_email" value="<?php echo set_value('config_email',$config['config_email']); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Telephone</label>
              <div class="col-sm-10">
                 <input type="text" name="config_telephone" value="<?php echo set_value('config_telephone',$config['config_telephone']); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>

            <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Alternate No</label>
              <div class="col-sm-10">
                 <input type="text" name="config_alternate_no" value="<?php echo set_value('config_alternate_no',$config['config_alternate_no']); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Subscribe Title:</label>
              <div class="col-sm-10">
                 <input type="text" name="config_gst" value="<?php echo set_value('config_gst',$config['config_gst']); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>

                <div class="row mb-3 ">
              <label for="input-lastname" class="col-sm-2 col-form-label">Subscribe Description:</label>
              <div class="col-sm-10">
                 <input type="text" name="config_cin" value="<?php echo set_value('config_cin',$config['config_cin']); ?>" placeholder=""  class="form-control" />
          
              </div>
          </div>


             <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Footer Note</label>
              <div class="col-sm-10">
       
                <textarea name="config_footer_note" class="form-control" rows="4"><?php echo set_value('config_footer_note',$config['config_footer_note']); ?></textarea>

              </div>
          </div>
        

         

          <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Copywrite</label>
              <div class="col-sm-10">
       
                <textarea name="config_copywrite" class="form-control" rows="5"><?php echo set_value('config_copywrite',$config['config_copywrite']); ?></textarea>

              </div>
          </div>

      </fieldset>

  </div>


 <div id="tab-image" class="tab-pane">

        <fieldset>
              
          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Store Logo</label>
              <div class="col-sm-10">
                   <?php if (!empty($config['config_logo'])): ?>
                 <img src="<?php echo base_url($config['config_logo']); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="config_logo" class="form-control" id="input-logo" />
               <input type="hidden" name="old_config_logo" value="<?php echo $config['config_logo'] ?>">
              </div>
          </div>

              <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">>Favicon icon</label>
              <div class="col-sm-10">
                   <?php if (!empty($config['config_favicon'])): ?>
                 <img src="<?php echo base_url($config['config_favicon']); ?>" width="100" height="100">
              <?php endif ?>
              <input type="file" name="config_favicon" class="form-control" id="input-logo" />
               <input type="hidden" name="old_config_favicon" value="<?php echo $config['config_favicon'] ?>">
              </div>
          </div>

             <div class="row mb-3 ">
              <label for="input-email" class="col-sm-2 col-form-label">Footer Logo</label>
              <div class="col-sm-10">
       
                  <?php if (!empty($config['config_footer_logo'])): ?>
                 <img src="<?php echo base_url($config['config_footer_logo']); ?>" width="100" height="100">
                  <?php endif ?>
                  <input type="file" name="config_footer_logo" class="form-control" id="input-logo" />
                  <input type="hidden" name="old_config_footer_logo" value="<?php echo $config['config_footer_logo'] ?>">

              </div>
          </div>

      </fieldset>

  </div>


<div id="tab-social" class="tab-pane">

        <fieldset>
              
          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Facebook</label>
              <div class="col-sm-10">
                   <input type="text" name="config_facebook" value="<?php echo set_value('config_facebook',$config['config_facebook']); ?>" placeholder="" class="form-control" />
                 
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Twitter</label>
              <div class="col-sm-10">
                   <input type="text" name="config_twitter" value="<?php echo set_value('config_twitter',$config['config_twitter']); ?>" placeholder="" class="form-control" />
                 
              </div>
          </div>

          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Linkedin</label>
              <div class="col-sm-10">
                   <input type="text" name="config_linkedin" class="form-control" id="input-logo" value="<?php echo $config['config_linkedin']; ?>" />
                 
              </div>
          </div>

           <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Instagram</label>
              <div class="col-sm-10">
                    <input type="text" name="config_instagram" class="form-control" id="input-logo" value="<?php echo $config['config_instagram']; ?>" />
                 
              </div>
          </div>
          
           <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Mail</label>
              <div class="col-sm-10">
                   <input type="text" name="config_pinterest" class="form-control" id="input-logo" value="<?php echo $config['config_pinterest']; ?>" />
                 
              </div>
          </div>
          
           <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Youtube</label>
              <div class="col-sm-10">
                   <input type="text" name="config_youtube" class="form-control" id="input-logo" value="<?php echo $config['config_youtube']; ?>" />
                 
              </div>
          </div>
          
          <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">WhatssApp</label>
              <div class="col-sm-10">
                  <input type="text" name="whatsapp" class="form-control" value="<?php echo $config['whatsapp']; ?>" />
                 
              </div>
          </div>



      </fieldset>

  </div>


<div id="tab-mail" class="tab-pane">

     <legend>General</legend>
        <fieldset>
              
        <div class="row mb-3 ">
              <label for="input-firstname" class="col-sm-2 col-form-label">Mail Engine</label>
              <div class="col-sm-10">
                  <select name="config_mail_engine" id="input-mail-engine" class="form-select">
                      <option value="">None</option>
                      <option value="mail" <?php echo @$config['config_mail_engine'] =='mail'?'selected':''; ?>>Mail</option>
                      <option value="smtp" <?php echo @$config['config_mail_engine'] =='smtp'?'selected':''; ?>>SMTP</option>
                    </select>
              </div>
          </div>

          <div class="row mb-3">
              <label for="input-mail-parameter" class="col-sm-2 col-form-label">From E-Mail Address</label>
              <div class="col-sm-10">
                <input type="text" name="sending_email" value="<?php echo set_value('sending_email',$config['sending_email']) ?>" placeholder="Mail Parameters" id="input-mail-parameter" class="form-control">
               
              </div>
            </div>



          <div class="row mb-3">
              <label for="input-mail-parameter" class="col-sm-2 col-form-label">Receiver E-Mail Address</label>
              <div class="col-sm-10">
                <input type="text" name="to_email" value="<?php echo set_value('to_email',$config['to_email']) ?>" placeholder="Receiver Mail Address" id="input-mail-parameter" class="form-control">
                <div class="form-text"></div>
              </div>
            </div>
            
            
      </fieldset>

         <fieldset>
                <legend>SMTP</legend>
                <div class="row mb-3">
                  <label for="input-mail-smtp-hostname" class="col-sm-2 col-form-label">Hostname</label>
                  <div class="col-sm-10">
                    <input type="text" name="smtp_hostname" value="<?php echo set_value('smtp_hostname',$config['smtp_hostname']) ?>" placeholder="Hostname" id="input-mail-smtp-hostname" class="form-control">
                    <div class="form-text">Add 'tls://' or 'ssl://' prefix if security connection is required. (e.g. tls://smtp.gmail.com, ssl://smtp.gmail.com).</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="input-mail-smtp-username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="smtp_username" value="<?php echo set_value('smtp_username',$config['smtp_username']) ?>" placeholder="Username" id="input-mail-smtp-username" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="input-mail-smtp-password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="smtp_password" value="<?php echo set_value('smtp_password',$config['smtp_password']) ?>" placeholder="Password" id="input-mail-smtp-password" class="form-control">
                    <div class="form-text">For Gmail you might need to setup an application specific password here: <a href="https://security.google.com/settings/security/apppasswords" target="_blank">https://security.google.com/settings/security/apppasswords</a>.</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="input-mail-smtp-port" class="col-sm-2 col-form-label">Port</label>
                  <div class="col-sm-10">
                    <input type="text" name="smtp_port" value="<?php echo set_value('smtp_port',$config['smtp_port']) ?>" placeholder="Port" id="input-mail-smtp-port" class="form-control">
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
<?php $this->endSection(); ?>