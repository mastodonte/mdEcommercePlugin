<?php

/**
 * PluginecCategoryTranslation form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecCategoryTranslationForm extends BaseecCategoryTranslationForm {

  public function setup() {
    parent::setup();
    
    $this->widgetSchema['name'] = new sfWidgetFormInputText(array('label' => 'Nombre'));
  }

}
