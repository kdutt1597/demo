  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/bootstrap.css" rel="stylesheet" media="screen" />
  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/fonts/fontawesome/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo ADMIN_CATALOG; ?>stylesheet/stylesheet.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/daterangepicker.js"></script>
  <link href="<?php echo ADMIN_CATALOG; ?>javascript/jquery/datetimepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/common.js"></script>
  
<!--<script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/ckeditor/ckeditor.js"></script>-->
<!--<script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/ckeditor/adapters/jquery.js"></script>-->


 <!-- CKEDITOR 4 -->
<script src="<?php echo ADMIN_CATALOG; ?>/ckeditor/ckeditor.js"></script>


<link href="<?php echo ADMIN_CATALOG; ?>stylesheet/toastr.css" rel="stylesheet" type="text/css" />


<!-- select 2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<!-- datatable -->
<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<style>
    .cke_notifications_area{
        display : none;
    }
</style>
</head>

<?php 
use App\Models\coreModule\MenuModel;
use App\Models\coreModule\BackendModel;
$model = new MenuModel();
$backend = new BackendModel();


$adminDetail = $backend->asObject()->where(array('id'=>session()->get('adminLogin')))->first(); 
$wconfig = websetting();
?>

    <body>
        <div id="container">
           
            <header id="header" class="navbar navbar-expand navbar-light bg-light">
                <div class="container-fluid">
                    <a href="<?php echo base_url('admin/dashboard') ?>" class="navbar-brand d-none d-lg-block">
                        <img src="<?php echo $wconfig['config_logo']; ?>" alt="Logo" title="Logo" style="height: 54px;
    background: black;
    /* padding: 11px; */
    /* object-fit: contain;" />
                    </a>
                    <button type="button" id="button-menu" class="btn btn-link d-inline-block d-lg-none"><i class="fa-solid fa-bars"></i></button>
                    <ul class="nav navbar-nav">
                       <!--  <li id="nav-notification" class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle"><i class="fa-regular fa-bell"></i></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <span class="dropdown-item text-center">No results!</span>
                            </div>
                        </li> -->
                   
                        <li id="nav-profile" class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle">
                                <img src="<?php echo $adminDetail->photo?base_url($adminDetail->photo):base_url($wconfig['config_logo']); ?>" alt="<?php echo $wconfig['config_logo']; ?>" title="admin" class="rounded-circle" />
                                <span class="d-none d-md-inline d-lg-inline">&nbsp;&nbsp;&nbsp;<?php echo $adminDetail->username?$adminDetail->username:'User'; ?> <i class="fa-solid fa-caret-down fa-fw"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="<?php echo base_url('admin/profile'); ?>" class="dropdown-item"><i class="fa-solid fa-user-circle fa-fw"></i> Your Profile</a>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                 <li>
                                    <a target="_blank" href="<?php echo base_url(); ?>" class="dropdown-item"><i class="fa-solid fa-home fa-fw"></i> Website</a>
                                </li>
                            </ul>
                        </li>
                        <li id="nav-logout" class="nav-item">
                            <a href="<?php echo base_url('admin/logout'); ?>" class="nav-link">
                                <i class="fa-solid fa-sign-out"></i> <span class="d-none d-md-inline">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </header>
            <nav id="column-left">
                <div id="navigation"><span class="fa-solid fa-bars"></span> Navigation</div>
            <ul id="menu">
                   

 
        <?php 


        $menu = $model->asObject()->where(array('parent_id'=>0,'status'=>1,'visible'=>1))->orderBy('sort_order','asc')->findAll();

        foreach ($menu as $key => $value) {
          $level1 = $model->asObject()->where(array('parent_id'=>$value->id,'status'=>1,'visible'=>1))->orderBy('sort_order','asc')->findAll();
          if ($level1) { ?>
            
            <?php if ($this->AdminModel->hasPermission($value->id)) {?>
              <li id="menu-catalog">
              <a href="#collapse<?php echo $value->id; ?>" data-bs-toggle="collapse" class="parent collapsed"><?php echo $value->fafa; ?> <?php echo $value->name; ?></a>
               <ul id="collapse<?php echo $value->id; ?>" class="collapse">

             
              <?php foreach ($level1 as $key => $l1) {?>
                  
               
                  <?php 
                   $level2 = $model->asObject()->where(array('parent_id'=>$l1->id,'status'=>1,'visible'=>1))->orderBy('sort_order','asc')->findAll();
                  if (!empty($level2)) {?>
                  
                 <li>
                  <a href="#collapse<?php echo $l1->id;?>" data-bs-toggle="collapse" class="parent collapsed"><?php echo $l1->name; ?></a>
                  <ul id="collapse<?php echo $l1->id;?>" class="collapse">
                  <?php foreach ($level2 as $key => $l2) { if (@$this->AdminModel->hasPermission($l2->id)) {?>  

                   <li><a href="<?php echo base_url($l2->link); ?>"><?php echo $l2->name; ?></a></li>
                  <?php } } ?>
                  </ul>
                 </li>

                  <?php }else{ ?>
                   
                   <?php if ($this->AdminModel->hasPermission($l1->id)) {?>
                   <li><a href="<?php echo base_url($l1->link); ?>"><?php echo $l1->name; ?></a></li>   

                <?php } } ?>
              <?php }  ?>
              </ul>

             </li>

             <?php }  ?>
          <?php }else{?>
            

             <li id="menu-dashboard">
              <a href="<?php echo base_url($value->link); ?>"><?php echo $value->fafa; ?> <?php echo $value->name; ?></a>
             </li>

          <?php  } ?>


           <?php } ?>


              
                </ul>
               
            </nav>