<?php

require_once dirname(__FILE__).'/../lib/categoriasBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoriasBackendGeneratorHelper.class.php';

/**
 * categoriasBackend actions.
 *
 * @package    backend
 * @subpackage categoriasBackend
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class categoriasBackendActions extends autoCategoriasBackendActions
{  
  protected function addSortQuery($query)
  {
    //don't allow sorting; always sort by tree and lft
    $query->addOrderBy('root_id, lft');
  }
  
  public function executeBatch(sfWebRequest $request)
  {
    if ("batchOrder" == $request->getParameter('batch_action'))
    {
      return $this->executeBatchOrder($request);
    }
    
    parent::executeBatch($request);
  }
  
  public function executeBatchOrder(sfWebRequest $request)
  {
    $newparent = $request->getParameter('newparent');
    
    //manually validate newparent parameter
    
    //make list of all ids
    $ids = array();
    foreach ($newparent as $key => $val)
    {
      $ids[$key] = true;
      if (!empty($val))
        $ids[$val] = true;
    }
    $ids = array_keys($ids);
    
    //validate if all id's exist
    //$validator = new sfValidatorDoctrineChoice(array('model' => 'Tree'));
    try
    {
      // validate ids TODO hacer que funcione la validacion
      //$ids = $validator->clean($ids);
      //var_dump($ids); die();
      
      // the id's validate, now update the tree
      $count = 0;
      $flash = "";

      foreach ($newparent as $id => $parentId)
      {
        if (!empty($parentId))
        {
          $node = Doctrine::getTable('ecCategory')->find($id);
          $parent = Doctrine::getTable('ecCategory')->find($parentId);
          
          if (!$parent->getNode()->isDescendantOfOrEqualTo($node))
          {
            $node->getNode()->moveAsFirstChildOf($parent);
            $node->save();

            $count++;

            $flash .= "<br/>Moved '".$node['name']."' under '".$parent['name']."'.";
          }
        }
      }

      if ($count > 0)
      {
        $this->getUser()->setFlash('notice', sprintf("Tree order updated, moved %s item%s: " . $flash, $count, ($count > 1 ? 's' : '')));
      }
      else
      {
        $this->getUser()->setFlash('error', "You must at least move one item to update the tree order");
      }
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'Cannot update the tree order, maybe some item are deleted, try again');
    }
     
    $this->redirect('@ec_category');
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $object = $this->getRoute()->getObject();
    if ($object->getNode()->isValidNode())
    {
      $object->getNode()->delete();
    }
    else
    {
      $object->delete();
    }

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@ec_category');
  }

  public function executeListNew(sfWebRequest $request)
  {
    $this->executeNew($request);
    $this->form->setDefault('parent_id', $request->getParameter('id'));
    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $this->getUser()->setFlash('notice', $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.');

      $tree = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $tree)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $this->getUser()->getFlash('notice').' You can add another one below.');

        $this->redirect('@ec_category_new');
      }
      else
      {
        $this->redirect('@ec_category_edit?id='.$tree['id']);
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.');
    }
  }
  
  public function executeAssociate(sfWebRequest $request)
  {
    Doctrine_Query::create()
      ->delete()
      ->from('ecProductToCategory as cp')
      ->where('cp.ec_product_id = ?', $request->getParameter('object_id', -1))
      ->execute();
    
    $categorias = $request->getParameter('categorias', array());
    
    foreach($categorias as $id)
    {
      $cp = new ecProductToCategory();
      $cp->setEcCategoryId($id);
      $cp->setEcProductId($request->getParameter('object_id'));
      $cp->save();
    }
    
    return $this->renderText(mdBasicFunction::basic_json_response(true, array('message' => 'Se han asociado las categorias correctamente.')));
  }  
}

