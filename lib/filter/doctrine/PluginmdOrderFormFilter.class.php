<?php

/**
 * PluginmdOrder form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginmdOrderFormFilter extends BasemdOrderFormFilter {

  private $module_payments = array();
  
  public function setup() {
    parent::setup();
    
    $module_payments = Doctrine::getTable('mdPaymentModule')->findActiveModules();
    $info = array('' => '');
    foreach($module_payments as $module_payment){
      $info[$module_payment->getLabel()] = $module_payment->getName();
    }
    $this->module_payments = $info;
    
    unset($this['updated_at'], $this['delivery_date'], $this['conversion_rate'], $this['lang']
      , $this['secure_key'], $this['total_discounts'], $this['total_shipping'], $this['md_cart_id'], $this['delivery_date']
      , $this['md_discount_id'], $this['address_delivery_id'], $this['total_products'], $this['currency_id'], $this['carrier_id']);

    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
        
    $this->widgetSchema['module_payment'] = new sfWidgetFormChoice( array('choices' => $this->module_payments) );
    $this->validatorSchema['module_payment'] = new sfValidatorChoice( array('choices' => array_keys($this->module_payments), 'required' => false) );
    
    $this->widgetSchema['md_order_state_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mdOrderState'), 'add_empty' => true, 'query' => Doctrine_Query::create()->from('mdOrderState s')->leftJoin('s.Translation t')));
    
    $this->widgetSchema->moveField('id', sfWidgetFormSchema::FIRST);    
  }
  
  public function getFields()
  {
    $fields = parent::getFields();
    $fields['module_payment'] = 'ENUM';
    
    return $fields;
  }

}
