CKEDITOR.plugins.add( 'filelink', {
    icons: 'filelink',
    init: function( editor ) {
        editor.ui.addButton( 'Filelink', {
            label: 'Insert File',
            command: 'filelink.cmd',
            toolbar: 'insert'
        });

        var cmd = editor.addCommand('filelink.cmd', {exec:showDialogPlugin});
    }
});

function showDialogPlugin(e){
    kQuery.magnificPopup.open({
        items: {
            src: e.config.fileLinkUploadUrl,
            type: "iframe"
        },
        mainClass: "koowa_dialog_modal"
    });
}

kQuery(document).ready(function($) {
    CKEDITOR.on("instanceReady", function(e) {
        // Remove built-in image button
        $('.cke_button__image').hide();
    });
});
