<script src="https://cdn.tiny.cloud/1/bi2to36pvadq4tx4wruovkisuw3vcnufz1gsob2gxcpzk8fw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea:not(.no-rte)",
        plugins: [
            "advlist autolink lists link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern",
            "media", "image", "imagetools"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,

        // Lets "image" and "media" buttons open the Laravel Filemanager popup
        // so admins can upload a new video/audio/image file (not just paste a URL).
        file_picker_types: 'image media file',
        file_picker_callback: function (callback, value, meta) {
            var lfmType = (meta.filetype === 'image') ? 'image' : 'file';

            // NOTE: the installed lfm package hardcodes its route prefix to
            // "filemanager" in LaravelFilemanagerServiceProvider@boot -
            // the 'prefix' key in config/lfm.php is NOT actually read.
            window.open(
                '/filemanager?type=' + lfmType,
                'FileManager',
                'width=900,height=600'
            );

            // lfm always calls SetUrl with an ARRAY of selected items (see
            // getSelectedItems() in laravel-filemanager's script.js), even
            // when only one file was picked.
            window.SetUrl = function (items) {
                if (!items || !items.length) { return; }
                var item = items[0];
                var isImageFile = /\.(png|jpe?g|gif|webp|svg|bmp)$/i.test(item.url);

                // Picked through the Image dialog's own browse button: let that
                // dialog's normal Save button do the insert, as before.
                if (meta.filetype === 'image') {
                    callback(item.url, { alt: item.name });
                    return;
                }

                // Picked through a different browse button (the generic "insert
                // file"/link one) but the file chosen is actually a picture - that
                // dialog would otherwise insert it as a plain text link
                // (<a href="...">url</a>), which is the "link shows instead of the
                // picture" bug. Insert the real <img> ourselves and close that
                // dialog instead of letting it add a link too.
                if (isImageFile && tinymce.activeEditor) {
                    tinymce.activeEditor.insertContent('<img src="' + item.url + '" alt="' + item.name + '" />');
                    if (tinymce.activeEditor.windowManager) {
                        tinymce.activeEditor.windowManager.close();
                    }
                    return;
                }

                callback(item.url, { text: item.name, title: item.name });
            };
        },
    };

    tinymce.init(editor_config);
</script>