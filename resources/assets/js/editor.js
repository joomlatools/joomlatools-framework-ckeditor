/**
 * Joomlatools Framework - https://www.joomlatools.com/developer/framework/
 *
 * @copyright   Copyright (C) 2011 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://github.com/nooku/joomlatools-framework-ckeditor for the canonical source repository
 */

kQuery(document).ready(function(){
    // Hook into koowa controller validate event
    kQuery('.k-js-form-controller').on('k:validate', function(context) {
        CKEDITOR.all().then(editors => {
            Object.keys(editors).forEach(name => {
                var element = document.getElementById(name);
                var editor  = editors[name];
        
                // If any instance is empty then abort the save action
                if (!editor.getData() && element.classList.contains('ckeditor-required')) {
                    return false;
                }
            });
        });
    });
});