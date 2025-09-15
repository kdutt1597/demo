<?php
$this->extend('layouts/master_admin');
$this->section('page');
$wconfig = websetting();
    
?>


    <div id="content">
        <div class="page-header">
            <div class="container-fluid">
              
                <h1><?php echo $page_title; ?></h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo current_url(); ?>"><?php echo $page_title; ?></a></li>
                </ol>
            </div>
        </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="tile tile-primary">
                                <div class="tile-heading">Total Solutions <span class="float-end"> </span></div>
                                <div class="tile-body">
                                    <i class="fa-solid fa-tasks"></i>
                                    <h2 class="float-end"><?php echo $SolutionCount; ?></h2>
                                </div>
                                <div class="tile-footer"><a href="<?php echo base_url('admin/solutions'); ?>">View more...</a></div>
                            </div>
                        </div>
                     
                      <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="tile tile-primary">
                                <div class="tile-heading">Total Service <span class="float-end"> </span></div>
                                <div class="tile-body">
                                    <i class="fa-solid fa-wrench"></i>
                                    <h2 class="float-end"><?php echo $ServiceCount; ?></h2>
                                </div>
                                <div class="tile-footer"><a href="<?php echo base_url('admin/services'); ?>">View more...</a></div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="tile tile-primary">
                                <div class="tile-heading">Total Industry <span class="float-end"> </span></div>
                                <div class="tile-body">
                                    <i class="fa-solid fa-industry"></i>
                                    <h2 class="float-end"><?php echo $indusryCount; ?></h2>
                                </div>
                                <div class="tile-footer"><a href="<?php echo base_url('admin/industry'); ?>">View more...</a></div>
                            </div>
                        </div>
                
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="tile tile-primary">
                                <div class="tile-heading">Total Enquiry</div>
                                <div class="tile-body">
                                    <i class="fa-solid fa-users"></i>
                                    <h2 class="float-end"><?php echo $enquiryCount; ?></h2>
                                </div>
                                <div class="tile-footer"><a href="<?php echo base_url('admin/enquiry'); ?>">View more...</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header"><i class="fa-solid fa-globe"></i> World Map</div>
                                <div class="card-body">
                                    <div id="vmap" style="width: 100%; height: 260px;"></div>
                                </div>
                            </div>
                            <link type="text/css" href="<?php echo ADMIN_CATALOG; ?>javascript/jquery/jqvmap/jqvmap.css" rel="stylesheet" media="screen" />
                            <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/jqvmap/jquery.vmap.js"></script>
                            <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/jqvmap/maps/jquery.vmap.world.js"></script>

                                    <script type="text/javascript">
                                <!--
                                $(document).ready(function () {
                                    $.ajax({
                                        url: '',
                                        dataType: 'html',
                                        success: function (json) {
                                            data = [];

                                            for (i in json) {
                                                data[i] = json[i]['total'];
                                            }

                                            $('#vmap').vectorMap({
                                                map: 'world_en',
                                                backgroundColor: '#FFFFFF',
                                                borderColor: '#FFFFFF',
                                                color: '#9FD5F1',
                                                hoverOpacity: 0.7,
                                                selectedColor: '#666666',
                                                enableZoom: true,
                                                showTooltip: true,
                                                values: data,
                                                normalizeFunction: 'polynomial',
                                                onLabelShow: function (event, label, code) {
                                                    if (json[code]) {
                                                        label.html('<strong>' + label.text() + '</strong><br />' + 'Orders ' + json[code]['total'] + '<br />' + 'Sales ' + json[code]['amount']);
                                                    }
                                                }
                                            });
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                                        }
                                    });
                                });
                                //-->
                            </script>
                           
                        </div>

                         <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="float-end">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-regular fa-calendar"></i> <i class="fa-solid fa-caret-down"></i></a>
                                        <div id="range" class="dropdown-menu dropdown-menu-right">
                                            <a href="day" class="dropdown-item">Today</a> <a href="week" class="dropdown-item">Week</a> <a href="month" class="dropdown-item active">Month</a> <a href="year" class="dropdown-item">Year</a>
                                        </div>
                                    </div>
                                    <i class="fa-solid fa-chart-bar"></i> Sales Analytics
                                </div>
                                <div class="card-body">
                                    <div id="chart-sale" style="width: 100%; height: 260px;"></div>
                                </div>
                            </div>
                            <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/flot/jquery.flot.js"></script>
                            <script type="text/javascript" src="<?php echo ADMIN_CATALOG; ?>javascript/jquery/flot/jquery.flot.resize.min.js"></script>
                           


                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header"><i class="fa-regular fa-calendar"></i> Recent Activity</div>
                                <div class="table-responsive">
                                <table class="table">
                                <thead>
                                <tr>
                                <td>Email ID</td>
                                <td>Modify Date</td>
                                </tr>
                                </thead>
                                <tbody>
                                 <?php foreach ($admin as $key => $value): ?>
                                   <tr>
                                       <td> <?php echo $value->email; ?></td>
                                       <td><?php echo $value->modify_date; ?></td>
                                   </tr>
                                 <?php endforeach ?>   
                               

                                </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header"><i class="fa-solid fa-shopping-cart"></i> Latest Services</div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td class="text-start">#</td>
                                                <td>Name</td>
                                                <td>Status</td>                                  
                                                <td class="text-start">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($letestProduct)){foreach ($letestProduct as $key => $value) {?>
                                        
                                            <tr>
                                                    <td class="text-start"><?php echo $key+1; ?></td>
                                                <td class="text-start"><?php echo $value->name; ?></td>
                                                <td class="text-start"><?php echo $value->status?'Active':'Deactive'; ?></td>
                                                <td class="text-start"><a href="<?php echo base_url('admin/services'); ?>"><button class="form-control btn btn-info">View</button></a></td>
                                            </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
              
            </div>
           
         
<script type="text/javascript">

$('#range a').on('click', function (e) {
    e.preventDefault();

    $(this).parent().find('a').removeClass('active');

    $(this).addClass('active');
    let range = $(this).attr('href');


    $.ajax({
        type: 'get',
        url: 'admin/chartData',
        type: 'POST',
        data:{range:range},
        success: function (json) {
            obj = JSON.parse(json);
                     
            // if (typeof json['order'] == 'undefined') {
            //     return false;
            // }
     

            var option = {
                shadowSize: 0,
                colors: ['#9FD5F1', '#1065D2'],
                bars: {
                    show: true,
                    fill: true,
                    lineWidth: 1
                },
                grid: {
                    backgroundColor: '#FFFFFF',
                    hoverable: true
                },
                points: {
                    show: false
                },
                xaxis: {
                    show: true,
                    ticks: obj.xaxis
                }
            }

                $.plot('#chart-sale', [obj.order, obj.customer], option);

            $('#chart-sale').bind('plothover', function (event, pos, item) {
                $('.tooltip').remove();

                if (item) {
                    $('<div id="tooltip" class="tooltip top show"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');

                    $('#tooltip').css({
                        position: 'absolute',
                        left: item.pageX - ($('#tooltip').outerWidth() / 2),
                        top: item.pageY - $('#tooltip').outerHeight(),
                        pointer: 'cursor'
                    }).fadeIn('slow');

                    $('#chart-sale').css('cursor', 'pointer');
                } else {
                    $('#chart-sale').css('cursor', 'auto');
                }
            });
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});

$('#range a.active').trigger('click');

</script>

<?php echo $this->endSection(); ?>