/**
 * Nooku Framework - http://nooku.org/framework
 *
 * @copyright   Copyright (C) 2011 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://github.com/nooku/joomlatools-framework-ckeditor for the canonical source repository
 */

kQuery(document).ready(function(){
    // Hook into koowa controller validate event
    kQuery('.k-js-form-controller').on('koowa:validate', function(context) {
        // Loop through all the editor intances
        // See: http://ckeditor.com/forums/CKEditor-3.x/Getting-CKEDITOR-instance
        for(var i in CKEDITOR.instances)
        {
            element = document.getElementById(CKEDITOR.instances[i].name);

            // If any instance is empty then abort the save action
            if(!CKEDITOR.instances[i].getData() && element.classList.contains('ckeditor-required')) {
                return false;
            }
        }
    });
});