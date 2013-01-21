<?php

/**
 * PluginecProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecProductFormFilter extends BaseecProductFormFilter
{
  public function configure()
  {
    unset($this['quantity'], $this['price'], $this['price_offer'], $this['warranty'], $this['viewed'], $this['created_at'], $this['updated_at'],
        $this['width'], $this['height'], $this['depth'], $this['weight']);

    $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['name'] = new sfValidatorPass(array('required' => false));  
  }
  
  public function addNameColumnQuery($query, $field, $values) {
    $value = $values['text'];
    $alias = $query->getRootAlias();
    if ($value != '')
      $query = $query->addWhere('t.name like ?', '%' . $value . '%');
    
    return $query;
  }
  
  public function getFields() {
    $fields = parent::getFields();
    $fields['name'] = 'Text';
    return $fields;
  }
}

