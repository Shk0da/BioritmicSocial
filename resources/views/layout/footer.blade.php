<script src="/public/js/jquery.min.js"></script>
<script src="/public/js/chart.js"></script>
<script src="/public/js/toolkit.js"></script>
<script src="/public/js/application.js"></script>
<script src="/public/js/dropzone.js"></script>

<script type="text/javascript" >
    $(document).ready(function() {
        Dropzone.options.myDropzone = {
            uploadMultiple: false,
            addRemoveLinks: false,
            dictDefaultMessage: '',
            init: function() {
                this.on("thumbnail", function(file, dataUrl) {
                    $('.dz-image-preview').hide();
                    $('.dz-file-preview').hide();
                });
                this.on("success", function(file, res) {
                    console.log('upload success...');
                    $('#img-thumb').attr('src', res.path);
                    $('input[name="pic_url"]').val(res.path);
                });
            }
        };

        var myDropzone = new Dropzone("#my-dropzone");
        $('#upload-submit').on('click', function(e) {
            e.preventDefault();
            $("#my-dropzone").trigger('click');
        });

    });
    Dropzone.autoDiscover = false;
</script>