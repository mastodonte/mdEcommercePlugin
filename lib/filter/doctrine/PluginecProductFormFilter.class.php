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

    /*$this->widgetSchema['nombre'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['nombre'] = new sfValidatorString(array('required' => false));  */  
    
  }
  
  /*public function addNombreColumnQuery($query, $field, $values) {
    $value = $values['nombre'];
    $alias = $query->getRootAlias();
    if ($value != '')
      $query = $query->leftJoin($alias . ".Translation z")->addWhere('z.name like ?', '%' . $value . '%');
    
    return $query;
  }
  
  public function getFields() {
    $fields = parent::getFields();
    $fields['nombre'] = 'custom';
    return $fields;
  }*/
}

