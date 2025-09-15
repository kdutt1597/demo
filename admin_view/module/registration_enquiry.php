<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 

?>


<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
                <a href="<?php echo base_url('admin/add_investor_report'); ?>" data-toggle="tooltip" title="Add New"
                    class="btn btn-primary"><i class="fa fa-plus"></i></a> &nbsp;
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger"
                    onclick="confirm('Are you sure?') ? $('#form-user').submit() : false;"><i
                        class="fa fa-trash"></i></button>
            </div>
            <h1>
                <?php echo $page_title; ?>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:void();">
                        <?php echo $page_title; ?>
                    </a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">

            <!-- <div id="filter-product" class="col-lg-3 col-md-12 order-lg-last d-none d-lg-block mb-3">
                <div class="card">

                    <div class="card-header"><i class="fa-solid fa-filter"></i> Filter</div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/blog_enquiry') ?>" method="get">

                            <div class="mb-3">
                                <label for="input-name" class="form-label">Name</label>

                                <input type="text" name="name" class="form-control"
                                    value="<?php echo @$_GET['name']; ?>">

                            </div>





                            <div class="text-end">
                                <button type="submit" id="button-filter" class="btn btn-info"><i
                                        class="fa-solid fa-filter"></i> Filter</button>&nbsp;

                                <a href="<?php echo base_url('admin/blog_enquiry'); ?>"><button type="button"
                                        id="button-filter" class="btn btn-light"><i class="fa-solid fa-filter"></i>
                                        Reset</button></a>
                            </div>
                        </form>
                    </div>

                </div>
            </div> -->

            <style>
                .table-responsive {
                width: 100%;
                overflow-x: auto;
                }

                #data-registrations {
                table-layout: fixed;
                width: 100%;
                min-width: 1200px; /* Adjust as needed */
                }

                #data-registrations th, #data-registrations td {
                word-wrap: break-word;
                white-space: normal;
                padding: 8px;
                }

                /* Example: Set widths for each column (adjust as needed) */
                #data-registrations th:nth-child(1),
                #data-registrations td:nth-child(1) { width: 40px; }
                #data-registrations th:nth-child(2),
                #data-registrations td:nth-child(2) { width: 30px; }
                #data-registrations th:nth-child(3),
                #data-registrations td:nth-child(3) { width: 70px; }
                #data-registrations th:nth-child(4),
                #data-registrations td:nth-child(4) { width: 80px; }
                #data-registrations th:nth-child(5),
                #data-registrations td:nth-child(5) { width: 50px; }
                #data-registrations th:nth-child(6),
                #data-registrations td:nth-child(6) { width: 50px; }
                #data-registrations th:nth-child(7),
                #data-registrations td:nth-child(7) { width: 50px; }
                #data-registrations th:nth-child(8),
                #data-registrations td:nth-child(8) { width: 50px; }
                #data-registrations th:nth-child(9),
                #data-registrations td:nth-child(9) { width: 50px; }
                #data-registrations th:nth-child(10),
                #data-registrations td:nth-child(10) { width: 60px; }
                #data-registrations th:nth-child(11),
                #data-registrations td:nth-child(11) { width: 70px; }

            </style>



            <div class="col col-lg-12 col-md-12">

                <div class="card">
                    <?php if ($success = session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>
                            <?php echo $success; ?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>

                    <?php if ($error = session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>
                            <?php echo $success; ?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>

                    <style type="text/css">
                        .list-group-item {
                            font-size: 14px;
                            font-weight: 600;
                        }
                    </style>

                    <div class="card-header"><i class="fa-solid fa-list"></i> List</div>
                    <div id="user" class="card-body">
                        <?php echo form_open('admin/delete_registration_enquiry','id="form-user"'); ?>
                        <div class="table-responsive">
                            <table id="data-registrations" class="table table-bordered table-hover display nowrap">
                                <thead>
                                    <tr>
                                        <td style="width: 1px;" class="text-start"><input type="checkbox"
                                                onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                        </td>

                                        <td class="text-start">#</td>
                                        <td class="text-start">Name</td>
                                        <td class="text-start">Email</td>
                                        <td class="text-start">Location</td>
                                        <td class="text-start">Company</td>
                                        <td class="text-start">Job Title</td>
                                        <td class="text-start">Phone</td>
                                        <td class="text-start">Event</td> 
                                        <td class="text-start">Date</td>
                                        <td class="text-start">Action</td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php if (!empty($detail)): ?>
                                    <?php foreach ($detail as $key => $value){  ?>

                                    <tr>
                                        <td class="text-start"><input type="checkbox" name="selected[]"
                                                value="<?php echo $value->id; ?>" /></td>
                                        <td class="text-start">
                                            <?php echo $key+1; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->firstName.' '.$value->lastName; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->email; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->location; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->company_name; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->job_title; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->phone; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->event_name; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $value->create_date; ?>
                                        </td>
                                        <td class="text-start"><button type="button" class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop<?php echo $value->id;?>"><I
                                                    class="fa fa-eye"></I></button> </td>

                                    </tr>


                                    <div class="modal fade" id="staticBackdrop<?php echo $value->id;?>"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Enquiry Detail
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Name:
                                                            <?php echo $value->firstName.' '.$value->lastName; ?>
                                                        </li>
                                                        <li class="list-group-item">Email:
                                                            <?php echo $value->email; ?>
                                                        </li>
                                                        <li class="list-group-item">Phone:
                                                            <?php echo $value->phone; ?>
                                                        </li>
                                                        <li class="list-group-item">Event Name:
                                                            <?php echo $value->event_name; ?>
                                                        </li>
                                                        <li class="list-group-item">Company:
                                                            <?php echo $value->company_name; ?>
                                                        </li>
                                                        <li class="list-group-item">Job Title:
                                                            <?php echo $value->job_title; ?>
                                                        </li>
                                                        <li class="list-group-item">Date:
                                                            <?php echo $value->create_date; ?>
                                                        </li>
                                                    </ul>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php } ?>

                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">

                            <div class="col-sm-6 text-start">
                                <ul class="pagination">
                                    <?php if ($pager):?>
                                    <?= $pager->makeLinks($page,$perPage, $total) ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="col-sm-6 text-end">Showing
                                <?php echo $offset; ?> to
                                <?php echo $offset+count($detail); ?> of
                                <?php echo $total; ?> (
                                <?php echo $pages; ?> Pages)
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
  $('#data-registrations').DataTable({
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    scrollX: true,
  });
</script>

    <?php $this->endSection(); ?>