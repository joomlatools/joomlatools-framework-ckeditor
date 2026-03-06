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

<ktml:script src="media://koowa/com_ckeditor/ckeditor/ckeditor.js" />
<ktml:script src="media://koowa/com_ckeditor/js/editor.js" />

<script>
(function($) {

    var id     = <?= json_encode($id); ?>;
    var config = <?= new KObjectConfigJson($options) ?>;

    $(document).ready(function() {
        var instance = CKEDITOR.replace(id, config);

        if (typeof Joomla === 'undefined') {
            Joomla = {editors: {instances: {}}};
        }
        Joomla.editors.instances[id] = {
            'id': id,
            'element':  null,
            'getValue': function () { return instance.getData(); },
            'setValue': function (text) { return instance.setData(text); },
            'getSelection': function() { return instance.getSelection().getSelectedText(); },
            'replaceSelection': function (text) { return instance.insertHtml(text); },
            'onSave': function() { return ''; }
        };

        instance.setData(<?= json_encode($text); ?>);
    });


})(kQuery);

function jInsertEditorText(text, editor)
{
    CKEDITOR.instances[editor].insertHtml(text);
}
</script>

<textarea id="<?= $id ?>" <?= $placeholder ? 'placeholder="' . translate($placeholder) . '" ' : '' ?>name="<?= $name ?>" class="<?= $class ?>" style="visibility:hidden"><?= $text ?></textarea>
