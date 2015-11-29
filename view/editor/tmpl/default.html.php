<?php
/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2011 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://github.com/nooku/nooku-ckeditor for the canonical source repository
 */
?>

<ktml:script src="media://koowa/com_ckeditor/ckeditor/ckeditor.js" />
<ktml:script src="media://koowa/com_ckeditor/js/editor.js" />

<?php $options = new  KObjectConfig($options);  ?>

<script>
    var defaultConfig = {
        baseHref              : '<?php echo $options->baseHref ?>',
        toolbar               : '<?php echo ($toolbar) ? $toolbar : $options->toolbar ?>',
        height                : '<?php echo $options->height ?>',
        width                 : '<?php echo $options->width ?>',
        language              : '<?php echo $options->language ?>',
        contentsLanguage      : '<?php echo $options->contentsLanguage ?>',
        contentsLangDirection : '<?php echo $options->contentsLangDirection ?>',
        scayt_autoStartup     : '<?php echo $options->scayt_autoStartup ?>',
        removeButtons         : '<?php echo $options->removeButtons ?>'
    };

    var preferredConfig = <?php echo (!is_null($config)) ? json_encode($config) : '""' ?>;

    var config_<?php echo $id ?> = (preferredConfig) ? preferredConfig : defaultConfig;

    jQuery(document).ready(function() {
        CKEDITOR.replace( '<?php echo $id ?>', config_<?php echo $id ?>);
    });
</script>

<textarea id="<?php echo $id ?>" name="<?php echo $name ?>" class="ckeditor editable-<?php echo $id ?> validate-editor <?php echo $class ?>" style="visibility:hidden"><?php echo $text ?></textarea>
