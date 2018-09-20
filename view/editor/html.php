<?php
/**
 * Joomlatools Framework - https://www.joomlatools.com/developer/framework/
 *
 * @copyright   Copyright (C) 2011 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://github.com/nooku/joomlatools-framework-ckeditor for the canonical source repository
 */

/**
 * Editor Html View Class
 *
 * @author  Terry Visser <http://github.com/terryvisser>
 * @package Koowa\Component\Ckeditor
 */
class ComCkeditorViewEditorHtml extends ComKoowaViewHtml
{
    protected function _initialize(KObjectConfig $config)
    {
        $locale = $this->getObject('translator')->getLocale();

        $config->append(array(
            'id'      => null,
            'name'    => null,
            'attribs' => [],
            'options' => [
                'baseHref'             => JUri::base(),
                'language'             => substr($locale, 0, strpos( $locale, '-' )),
                'contentsLanguage'     => substr($locale, 0, strpos( $locale, '-' )),
                'height'               => '',
                'width'                => '',
                'extraAllowedContent'  => ["hr[id]","img[data-*,title](*)","a[data-*,title](*)"],
                'autoGrow_bottomSpace' => 50,
                'extraPlugins'         => ['autocorrect'],
                'removePlugins'        => ['uploadfile', 'uploadimage'],
                'removeButtons'        => ['Subscript','Superscript','Styles','Anchor','AutoCorrect','Cut','Copy','PasteText'],
            ]
        ));

        if (!$config->options->toolbarGroups)
        {
            $config->options->toolbarGroups = [
                ["name" => "styles","groups" => ["styles"]],
                ["name" => "basicstyles","groups" => ["basicstyles","cleanup"]],
                ["name" => "links","groups" => ["links"]],
                ["name" => "editing","groups" => ["find","selection","spellchecker","editing"]],
                ["name" => "insert","groups" => ["insert"]],
                ["name" => "forms","groups" => ["forms"]],
                ["name" => "paragraph","groups" => ["list","indent","blocks","align","bidi","paragraph"]],
                ["name" => "clipboard","groups" => ["clipboard","undo"]],
                ["name" => "document","groups" => ["mode","document","doctools"]],
                ["name" => "tools","groups" => ["tools"]],
            ];
        }

        parent::_initialize($config);
    }

    protected function _fetchData(KViewContext $context)
    {
        //Set editor id
        if(!$context->data->id) {
            $context->data->id = $context->data->name;
        }

        foreach (['extraPlugins', 'removePlugins', 'removeButtons'] as $key) {
            $value = KObjectConfig::unbox($this->getConfig()->options->$key);

            if (is_array($value)) {
                $this->getConfig()->options->$key = implode(',', $value);
            }
        }

        //Set editor options
        $context->data->append(array('options' => $this->getConfig()->options));

        //Set editor class
        $class = KObjectConfig::unbox($this->getConfig()->attribs->class);
        $context->data->class = is_array($class) ? implode(' ', $class) : $class;

        parent::_fetchData($context);
    }
}