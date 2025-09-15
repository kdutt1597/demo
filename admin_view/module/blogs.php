<?php 

$this->extend('layouts/master_admin');
$this->section('page');
$validation = \Config\Services::validation(); 
?>

<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="float-end">
                <a href="<?php echo base_url('admin/add_blog'); ?>" data-toggle="tooltip" title="Add New"
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

            <div id="filter-product" class="col-lg-3 col-md-12 order-lg-last d-none d-lg-block mb-3">
                <div class="card">

                    <div class="card-header"><i class="fa-solid fa-filter"></i> Filter</div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/blogs') ?>" method="get">
                            <div class="mb-3">
                                <label for="input-name" class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo @$_GET['name']; ?>" placeholder="Name"
                                    id="input-name" class="form-control" autocomplete="off" />

                            </div>

                            <div class="mb-3">
                                <label for="input-name" class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($typeList as $key => $value): ?>
                                    <option value="<?php echo $key; ?>" <?php echo @$_GET['type']==$key?'selected':'';
                                        ?>>
                                        <?php echo $value; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="input-name" class="form-label">Category</label>
                                <select name="category" class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach ($blogCategoryList as $key => $value): ?>
                                    <option value="<?php echo $value->id; ?>" <?php echo @$_GET['category']==$value->
                                        id?'selected':''; ?>>
                                        <?php echo $value->name; ?>
                                    </option>
                                    <?php endforeach ?>
                                </select>

                            </div>


                            <div class="text-end">
                                <button type="submit" id="button-filter" class="btn btn-info"><i
                                        class="fa-solid fa-filter"></i> Filter</button>&nbsp;

                                <a href="<?php echo base_url('admin/blogs'); ?>"><button type="button"
                                        id="button-filter" class="btn btn-light"><i class="fa-solid fa-filter"></i>
                                        Reset</button></a>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card mt-3">
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
                            <?php echo $error; ?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>
                    <div class="card-header"><i class="fa-solid fa-filter"></i> Manage featured Ads</div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/adv') ?>" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="adv_id" value="1" />
                            <div class="mb-3">
                                <label for="input-name" class="form-label">Type</label>
                                <select id="type-select" name="Advtype" class="form-control">
                                    <option value="">Select</option>
                                    <option value="none">None</option>
                                    <?php foreach ($typeList as $key => $value): ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $value; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3" id="subtype-container" style="display: none;">
                                <label for="input-subtype" class="form-label">Subtype</label>
                                <select id="subtype-select" name="subtype" class="form-control">
                                    <option value="">Select</option>
                                    <!-- Options will be dynamically populated here -->
                                </select>
                            </div>
                            <div class="mb-3 adv_title" style="display:none;">
                                <label for="input-name" class="form-label">Title</label>
                                <input type="text" name="adv_title" placeholder="Name" id="input-name"
                                    class="form-control" autocomplete="off" />

                            </div>
                            <div class="mb-3 adv_img" style="display: none;">
                                <label for="input-subtype" class="form-label">Image/GIF</label>
                                <div class="col-sm-10">
                                    <input type="file" name="adv_img" class="form-control"
                                        accept="image/jpeg, image/png, image/gif, image/webp" />
                                </div>
                            </div>
                            <div class="mb-3 adv_url" style="display: none;">
                                <label for="input-subtype" class="form-label">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" name="adv_url" class="form-control" />
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-info"><i class="fa-solid fa-filter"></i>
                                    Add</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card mt-3">
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
                            <?php echo $error; ?>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>
                    <div class="card-header"><i class="fa-solid fa-filter"></i> Manage primary featured Ads</div>
                    <div class="card-body">
                        <form action="<?php echo base_url('admin/adv') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="adv_id" value="2" />
                            <div class="mb-3">
                                <label for="input-name" class="form-label">Type</label>
                                <select id="type-select2" name="Advtype" class="form-control">
                                    <option value="">Select</option>
                                    <option value="none">None</option>
                                    <?php foreach ($typeList as $key => $value): ?>
                                    <option value="<?php echo $key; ?>">
                                        <?php echo $value; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3" id="subtype-container2" style="display: none;">
                                <label for="input-subtype" class="form-label">Subtype</label>
                                <select id="subtype-select2" name="subtype" class="form-control">
                                    <option value="">Select</option>
                                    <!-- Options will be dynamically populated here -->
                                </select>
                            </div>
                            <div class="mb-3 adv_title2" style="display:none;">
                                <label for="input-name" class="form-label">Title</label>
                                <input type="text" name="adv_title" placeholder="Name" id="input-name"
                                    class="form-control" autocomplete="off" />

                            </div>
                            <div class="mb-3 adv_img2" style="display: none;">
                                <label for="input-subtype" class="form-label">Image/GIF</label>
                                <div class="col-sm-10">
                                    <input type="file" name="adv_img" class="form-control"
                                        accept="image/jpeg, image/png, image/gif, image/webp" />
                                </div>
                            </div>
                            <div class="mb-3 adv_url2" style="display: none;">
                                <label for="input-subtype" class="form-label">URL</label>
                                <div class="col-sm-10">
                                    <input type="text" name="adv_url" class="form-control" />
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-info"><i class="fa-solid fa-filter"></i>
                                    Add</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <script>
                document.getElementById('type-select').addEventListener('change', function () {
                    const selectedType = this.value;
                    const subtypeContainer = document.getElementById('subtype-container');
                    const subtypeSelect = document.getElementById('subtype-select');
                    const adv_img = document.querySelector('.adv_img');
                    const adv_title = document.querySelector('.adv_title');
                    const adv_url = document.querySelector('.adv_url');
                    $.ajax({
                        url: 'admin/typeEntry',
                        type: 'post',
                        data: { typeSelected: selectedType },
                        success: function (response) {
                            var dataSelected = JSON.parse(response);
                            console.log(dataSelected);
                            subtypeSelect.innerHTML = '<option value="">None</option>';

                            if (selectedType && dataSelected.length > 0) {
                                dataSelected.forEach(function (item) {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.textContent = item.title;
                                    subtypeSelect.appendChild(option);
                                });

                                subtypeContainer.style.display = 'block';
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                                adv_url.style.display = 'none';
                            } else if (selectedType === 'none') {
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'block';
                                adv_title.style.display = 'block';
                                adv_url.style.display = 'block';
                            } else {
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                                adv_url.style.display = 'none';
                            }
                        }
                    });
                });
                document.getElementById('type-select2').addEventListener('change', function () {
                    const selectedType = this.value;
                    const subtypeContainer = document.getElementById('subtype-container2');
                    const subtypeSelect = document.getElementById('subtype-select2');
                    const adv_img = document.querySelector('.adv_img2');
                    const adv_title = document.querySelector('.adv_title2');
                    const adv_url = document.querySelector('.adv_url2');
                    $.ajax({
                        url: 'admin/typeEntry',
                        type: 'post',
                        data: { typeSelected: selectedType },
                        success: function (response) {
                            var dataSelected = JSON.parse(response);
                            console.log(dataSelected);
                            subtypeSelect.innerHTML = '<option value="">None</option>';

                            if (selectedType && dataSelected.length > 0) {
                                dataSelected.forEach(function (item) {
                                    const option = document.createElement('option');
                                    option.value = item.id;
                                    option.textContent = item.title;
                                    subtypeSelect.appendChild(option);
                                });

                                subtypeContainer.style.display = 'block';
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                                adv_url.style.display = 'none';
                            } else if (selectedType === 'none') {
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'block';
                                adv_title.style.display = 'block';
                                adv_url.style.display = 'block';
                            } else {
                                subtypeContainer.style.display = 'none';
                                adv_img.style.display = 'none';
                                adv_title.style.display = 'none';
                                adv_url.style.display = 'none';
                            }
                        }
                    });
                });


            </script>





            <div class="col col-lg-9 col-md-12">

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


                    <div class="card-header"><i class="fa-solid fa-list"></i> List</div>
                    <div id="user" class="card-body">
                        <?php echo form_open('admin/delete_blogs','id="form-user"'); ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td style="width: 1px;" class="text-start"><input type="checkbox"
                                                onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                        </td>
                                        <td class="text-start">Title</td>
                                        <td class="text-start">Image</td>
                                        <td class="text-start">Short Description</td>
                                        <td class="text-start">Category</td>
                                        <td class="text-start">Type</td>
                                        <td class="text-start">Latest</td>
                                        <td class="text-start">Sort order</td>
                                        <td class="text-start">Status</td>
                                        <td class="text-start">Action</td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php if (!empty($groupedBlogs)) { 
                              foreach ($groupedBlogs as $blogId => $blog) { 
                                $blogData = $blog['data']; 
                                $categories = implode(', ', $blog['categories']); ?>
                                    <tr>
                                        <td class="text-start"><input type="checkbox" name="selected[]"
                                                value="<?php echo $blogData->id; ?>" /></td>
                                        <td class="text-start">
                                            <?php echo $blogData->title; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php if (!empty($blogData->thumbnail)) { 
                                            $ext = pathinfo($blogData->thumbnail, PATHINFO_EXTENSION);
                                            if ($ext=='mp4' || $ext == 'gif' || $ext == 'webm') { ?>
                                            <video muted autoplay loop playsinline class="future_media" width="100"
                                                height="100">
                                                <source src="<?php echo base_url($blogData->thumbnail); ?>"
                                                    type="video/<?= $ext ?>">
                                            </video>
                                            <?php } else { ?>
                                            <img src="<?php echo base_url($blogData->thumbnail); ?>" width="100"
                                                height="100">
                                            <?php } 
                                        } ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo substr($blogData->shortDescription, 0, 100) . '...'; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $categories; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $blogData->type; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $blogData->spotlight == 1 ? 'Yes' : ''; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $blogData->sort_order; ?>
                                        </td>
                                        <td class="text-start">
                                            <?php echo $blogData->status == 1 ? 'Active' : 'Deactive'; ?>
                                        </td>
                                        <td class="text-start">
                                            <a href="<?php echo base_url('admin/add_blog/' . $blogData->id); ?>"
                                                data-toggle="tooltip" title="Edit" class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } } ?>

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
</div>


<?php $this->endSection(); ?>