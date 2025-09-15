 <?php
  
$wconfig = websetting();
  
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="UTF-8"/>
  <title><?php echo $page_title; ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url($wconfig['config_favicon']); ?>">
  <base href="<?php echo base_url(); ?>" id="base" data-base="<?php echo base_url(); ?>/" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="expires" content="0">


  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/bootstrap.css" rel="stylesheet" media="screen"/>
  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/fonts/fontawesome/css/all.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/stylesheet.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/daterangepicker.js"></script>
  <link href="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/common.js"></script>

  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/toastr.css" rel="stylesheet" media="screen"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
<body>
<div id="container">
  <div id="alert" class="toast-container position-fixed top-0 end-0 p-3"></div>
  <header id="header" class="navbar navbar-expand navbar-light bg-light">
    <div class="container-fluid">
      <a href="<?php echo base_url(); ?>" class="navbar-brand d-none d-lg-block"><img src="<?php echo $wconfig['config_logo']; ?>" alt="Logo" title="Logo"  style="   height: 55px;
    background: black;  padding: 11px;"  /></a>
    </div>
  </header>

<div id="content">
  <div class="container-fluid">
    <br/>
    <br/>
    <div class="row justify-content-sm-center">
      <div class="col-sm-10 col-md-8 col-lg-5">
        <div class="card">
          <div class="card-header"><i class="fa-solid fa-lock"></i> Please enter your login details.</div>
          <div class="card-body">
              <form id="Login_Form">
                <div class="mb-3">
                <label for="input-username" class="form-label">Username</label>
                <div class="input-group">
                  <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                 <input type="text" name="username" placeholder="Username" id="input-username" class="form-control" autocomplete="off" />
                </div>
              </div>
              <div class="mb-3">
                <label for="input-password" class="form-label">Password</label>
                <div class="input-group mb-2">
                  <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                  <input type="password" name="password"  placeholder="Password" id="input-password" class="form-control"  autocomplete="off" />
                </div>
                <!-- <div class="mb-3"><a href="">Forgotten Password</a></div> -->
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-key"></i> Login</button>
              </div>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<footer id="footer"><a href="https://www.cyberworx.co.in">Cyberworx</a> &copy; 2009-<?php echo date('Y');?> All Rights Reserved.<br /></footer></div>

<script src="<?php echo ADMIN_CATALOG; ?>javascript/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_CATALOG; ?>javascript/Login.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_CATALOG; ?>javascript/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>
</body></html>


