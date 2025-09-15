

 
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<script type="text/javascript">

$(document).ready(function() {
    $('.multiple').select2();
});
   

//  $('.summernote').summernote({
 
//     height: ($(window).height() - 300),
//     callbacks: {
//         onImageUpload: function(image) {
//             let   attr = $(this).data('id');
//             uploadImage(image[0],attr);
//         }
//     }
// });




function uploadImage(image,attr) {
    var data = new FormData();
    data.append("image", image);
    $.ajax({
        url: "<?php echo base_url('admin/upload_image'); ?>",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
              var image = $('<img>').attr('src',url);
            $('#'+attr).summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}



</script>
<script src="<?php echo ADMIN_CATALOG; ?>ckfinder/config.js"></script>



<script>
              

CKEDITOR.replace('editor', {
    filebrowserBrowseUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );


CKEDITOR.replace('editor1', {
    filebrowserBrowseUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );

CKEDITOR.replace('editor2', {
    filebrowserBrowseUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );

CKEDITOR.replace('editor3', {
    filebrowserBrowseUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/ckfinder.html',
    filebrowserUploadUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserWindowWidth: '1000',
    filebrowserWindowHeight: '700'
} );


// manual upload
// CKEDITOR.replace('editor', {
//     filebrowserBrowseUrl: '<?php echo ADMIN_CATALOG; ?>/ckfinder/ckfinder.html',
//     filebrowserUploadUrl: '<?php echo base_url('admin/upload'); ?>',
//     filebrowserWindowWidth: '1000',
//     filebrowserWindowHeight: '700'
// } );
   
</script>

<footer id="footer"><a href="">Cyberworx</a> &copy; 2019-<?php echo date('Y'); ?> All Rights Reserved.</footer>
</div>
<script type="text/javascript" src="<?php echo CATALOG; ?>js/toastr.min.js"></script>
<script src="<?php echo ADMIN_CATALOG; ?>javascript/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>


<style>
    .toast-top-right .toast {
    background-color: #1d1d1d !important;
    box-shadow: 0 0 12px #484848 !important;
    border: 1px solid #3a3a3a;
}
</style>
