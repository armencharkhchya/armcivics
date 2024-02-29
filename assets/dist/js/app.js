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
    plugins: [
        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template textcolor paste  textcolor colorpicker"
    ],

    
    toolbar1: "save,newdocument,| media, | ,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    toolbar2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    //toolbar3: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,codehighlighting,netadvimage",
  
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
