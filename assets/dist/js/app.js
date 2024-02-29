tinymce.init({
    selector: ".longtext,#longtextstatic",
    browser_spellcheck: true,
    paste_data_images: true,
    images_reuse_filename: true,
    forced_root_block: false,
    statusbar: false,
   
    automatic_uploads: true,
    relative_urls: false,
    remove_script_host: false,
    plugins: ['advlist', 'anchor', 'autolink', 'autoresize', 'bbcode', 'charmap', 'code', 'codesample', 'colorpicker', 'compat3x', 'contextmenu', 'directionality', 'emoticons', 'fullpage', 'fullscreen', 'help','hr', 'image', 'imagetools', 'importcss', 'insertdatetime', 'legacyoutput', 'link', 'lists', 'media', 'nonbreaking', 'noneditable', 'pagebreak', 'paste', 'preview', 'print', 'save', 'searchreplace', 'spellchecker', 'tabfocus', 'table', 'template', 'textcolor', 'textpattern', 'toc', 'visualblocks', 'visualchars', 'wordcount'],
    toolbar1: 'save | undo redo | styleselect | formatselect | fontselect | fontsizeselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link unlink anchor image media | insertdatetime | charmap emoticons | hr | codesample',
    toolbar2: 'fullscreen | visualblocks visualchars nonbreaking pagebreak | searchreplace | removeformat | spellchecker | visualaid | preview | code',
    
    // "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    //menubar: false,
    image_advtab: true,
    toolbar_items_size: 'small',

    file_picker_callback: function (callback, value, meta) {
        if (meta.filetype === 'image') {
            var inputFile = document.createElement("INPUT");
            inputFile.setAttribute("type", "file");
            inputFile.setAttribute("style", "display:none");
            inputFile.click();
            inputFile.addEventListener("change", function () {
                
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    callback(e.target.result, {
                        alt: ''
                    });
                };
                reader.readAsDataURL(file);
            });
        }
    },
    insertdatetime_dateformat: "%d/%m/%Y",
    insertdatetime_timeformat: "%H/%M/%S",
});
