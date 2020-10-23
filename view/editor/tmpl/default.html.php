<?
/**
 * Joomlatools Framework - https://www.joomlatools.com/developer/framework/
 *
 * @copyright   Copyright (C) 2011 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://github.com/nooku/joomlatools-framework-ckeditor for the canonical source repository
 */
?>

<?= helper('behavior.jquery'); ?>

<ktml:script src="media://koowa/com_ckeditor/js/ckeditor.js" />
<ktml:script src="media://koowa/com_ckeditor/js/editor.js" />

<script>
var CKEDITOR = {
    editors: [],
    get: function( elementId ) {
        var that = this;
        return new Promise(function(resolve, reject) {
            setTimeout(function() {
                resolve(that.editors[ elementId ]);
            }, 1000);
        });
    },
    all: function() {
        var that = this;
        return new Promise(function(resolve, reject) {
            setTimeout(function() {
                resolve(that.editors);
            }, 1000);
        });
    }
};

function createEditor( elementId ) {
    return ClassicEditor
        .create( document.getElementById( elementId ) )
        .then( editor => {
            CKEDITOR.editors[ elementId ] = editor;

            if (typeof Joomla === 'undefined') {
                Joomla = {editors: {instances: {}}};
            }

            Joomla.editors.instances[ elementId ] = {
                'id': elementId,
                'element':  null,
                'getValue': function () { return editor.getData(); },
                'setValue': function (text) { return editor.setData(text); },
                'replaceSelection': function (text) { return editor.setData(text); },
                'onSave': function() { return ''; }
            };
    
            editor.setData(<?= json_encode($text); ?>);
        } )
        .catch( err => console.error( err.stack ) );
}

(function($) {
    var id     = <?= json_encode($id); ?>;
    var config = <?= new KObjectConfigJson($options) ?>;

    $(document).ready(function() {
        createEditor('<?= $id ?>');
    });
})(kQuery);

function jInsertEditorText(text, editor)
{
    CKEDITOR.get(editor).setData(text);
}
</script>

<textarea id="<?= $id ?>" name="<?= $name ?>" class="<?= $class ?>">
    <?= $text ?>
</textarea>