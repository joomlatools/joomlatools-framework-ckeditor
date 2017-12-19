CKEDITOR.plugins.add( 'filelink', {
    icons: 'filelink',
    requires: ['iframedialog'],
    init: function( editor ) {
        editor.ui.addButton( 'Filelink', {
            label: 'Insert File',
            command: 'filelink.cmd',
            toolbar: 'insert'
        });

        var cmd = editor.addCommand('filelink.cmd', {exec:showDialogPlugin});

        CKEDITOR.dialog.addIframe(
            'filelink.dlg',
            'File Link',
            editor.config.fileLinkUploadUrl,
            800,
            400,
            function(){
            }
        );
    }
});

function showDialogPlugin(e){
    e.openDialog('filelink.dlg');
}

kQuery(document).ready(function($) {
    CKEDITOR.on("instanceReady", function(e) {
        // Remove built-in image button
        $('#cke_21').hide();
    });
});
