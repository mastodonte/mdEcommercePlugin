<?php

/**
 * PluginecCategory form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecCategoryForm extends BaseecCategoryForm {

  protected $parentId = null;

  public function setup() {
    parent::setup();
    
    unset($this['root_id'], $this['lft'], $this['rgt'], $this['level'], $this['ec_product_list']);
    $this->widgetSchema['parent_id'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'ecCategory',
        'add_empty' => '~ (agregar como raiz)',
        'order_by' => array('root_id, lft', ''),
        'method' => 'getIndentedName'
      ));
    $this->validatorSchema['parent_id'] = new sfValidatorDoctrineChoice(array(
        'required' => false,
        'model' => 'ecCategory'
      ));
    $this->setDefault('parent_id', $this->object->getParentId());
    $this->widgetSchema->setLabel('parent_id', 'Hija de');

    // Un solo idioma a la vez
    $this->embedI18n(array(sfContext::getInstance()->getUser()->getCulture()));
    $this->widgetSchema->moveField(sfContext::getInstance()->getUser()->getCulture(), sfWidgetFormSchema::FIRST);
  }

  public function updateParentIdColumn($parentId) {
    $this->parentId = $parentId;
    // further action is handled in the save() method
  }

  protected function doSave($con = null) {
    parent::doSave($con);

    $node = $this->object->getNode();

    if ($this->parentId != $this->object->getParentId() || !$node->isValidNode()) {
      if (empty($this->parentId)) {
        //save as a root
        if ($node->isValidNode()) {
          $node->makeRoot($this->object['id']);
          $this->object->save($con);
        } else {
          $this->object->getTable()->getTree()->createRoot($this->object); //calls $this->object->save internally
        }
      } else {
        //form validation ensures an existing ID for $this->parentId
        $parent = $this->object->getTable()->find($this->parentId);
        $method = ($node->isValidNode() ? 'move' : 'insert') . 'AsFirstChildOf';
        $node->$method($parent); //calls $this->object->save internally
      }
    }
  }

}
