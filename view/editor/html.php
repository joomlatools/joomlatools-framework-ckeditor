<?php
/**
 * Nooku Framework - http://nooku.org/framework
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
class ComCkeditorViewEditorHtml extends KViewHtml
{
    protected function _initialize(KObjectConfig $config)
    {
        $locale = $this->getObject('translator')->getLocale();
        $config->append(array(
            'options' => array(
                'baseHref'          => '',
                'language'          => substr($locale, 0, strpos( $locale, '-' )),
                'contentsLanguage'  => substr($locale, 0, strpos( $locale, '-' )),
                'height'            => '',
                'width'             => '',
                'removeButtons'     => '',
                'autoheight'        => true,
                'toolbar'           => $this->toolbar ? $this->toolbar : 'standard',
            )
        ));

        parent::_initialize($config);
    }

    protected function _fetchData(KViewContext $context)
    {
        //Set editor id
        if(!$context->data->id) {
            $context->data->id = $context->data->name;
        }

        //Set editor options
        $context->data->append(array('options' => $this->getConfig()->options));

        //Set editor class
        $context->data->class = isset($this->attribs['class']) ? $this->attribs['class'] : '';

        parent::_fetchData($context);
    }
}