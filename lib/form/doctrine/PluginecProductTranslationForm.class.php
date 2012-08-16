<?php

/**
 * PluginecProductTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecProductTranslationForm extends BaseecProductTranslationForm {

  public function setup() {
    parent::setup();
   
    $this->widgetSchema['name'] = new sfWidgetFormInputText(array('label' => 'Nombre'));
    $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(
        array(
          'showTiny' => true,
          'width' => 500,
          'height' => 300,
          'config' => '
                  plugins : "preview,media,fullscreen",
                  theme_advanced_buttons1 : "bold,italic,separator,bullist,separator,link, sub,sup,separator,charmap, code, media, preview, fullscreen",
                  theme_advanced_buttons2 : "",
                  theme_advanced_buttons3 : "",
                  theme_advanced_path : false
                  ',
          'label' => 'Descripcion'));
    $this->widgetSchema['copete'] = new sfWidgetFormTextarea();    
  }

}
