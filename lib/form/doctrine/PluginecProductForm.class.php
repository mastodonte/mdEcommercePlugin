<?php

/**
 * PluginecProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecProductForm extends BaseecProductForm {

  public function configure() {
    unset($this['created_at'], $this['updated_at'], $this['ec_categories_list'], $this['viewed']);

    $this->widgetSchema['warranty'] = new sfWidgetFormTextareaTinyMCE(
        array(
          'showTiny' => true,
          'width' => 500,
          'height' => 300,
          'config' => '
                  theme_advanced_buttons1 : "bold,italic,separator,bullist,separator,link, sub,sup,separator,charmap,image",
                  theme_advanced_buttons2 : "",
                  theme_advanced_buttons3 : "",
                  theme_advanced_path : false
                  '));
    /* array(
      'width'  => 550,
      'height' => 150,
      'config' => '
      theme_advanced_buttons1 : "bold,italic,separator,bullist,separator,link, sub,sup,separator,charmap",
      theme_advanced_buttons2 : "",
      theme_advanced_buttons3 : "",
      theme_advanced_path : false,
      language : "fr"
      ' */

    // Un solo idioma a la vez
    $this->embedI18n(array(sfContext::getInstance()->getUser()->getCulture()));
    $this->widgetSchema->moveField(sfContext::getInstance()->getUser()->getCulture(), sfWidgetFormSchema::FIRST);
  }

}
