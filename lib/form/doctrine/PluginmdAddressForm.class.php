<?php

/**
 * PluginmdAddress form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdAddressForm extends BasemdAddressForm
{
  public function setup()
  {
    parent::setup();
    
    unset($this['created_at'], $this['updated_at'], $this['active'], $this['dni']);
    
    $this->widgetSchema['customer_id'] = new sfWidgetFormInputHidden();
    
    $this->widgetSchema['country_code'] = new sfWidgetFormI18nChoiceCountry();
    
    $this->validatorSchema['country_code'] = new sfValidatorI18nChoiceCountry(array('required' => true));
  }
}
