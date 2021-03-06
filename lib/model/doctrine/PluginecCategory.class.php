<?php

/**
 * PluginecCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginecCategory extends BaseecCategory {
  const SF_CACHE_KEY = 'mdCategorias';

  public function getParent() {
    if (!$this->getNode()->isValidNode() || $this->getNode()->isRoot()) {
      return null;
    }

    $parent = $this->getNode()->getParent();

    return $parent;
  }
  
  public function isRoot() {
    return $this->getNode()->isRoot();
  }
  
  public function getParentId() {
    if (!$this->getNode()->isValidNode() || $this->getNode()->isRoot()) {
      return null;
    }

    $parent = $this->getNode()->getParent();

    return $parent['id'];
  }

  public function getIndentedName() {
    return str_repeat('- ', $this['level']) . $this['name'];
  }

  /**
   * Get direct children of object
   * 
   * @return Doctrine_Collection 
   */
  public function getChildren() {

    return $this->getNode()->getChildren();
  }

  /**
   * Get all children of object
   * 
   * @return Doctrine_Collection
   */
  public function getDescendants() {

    return $this->getNode()->getDescendants();
  }

  public static function getRoots() {

    return Doctrine::getTable('ecCategory')->getCategories(0);
  }

  public static function getTreeAsArray($category_id, $maxdepth = 1) {

    $result = Doctrine::getTable('ecCategory')->getAllCategories();

    if (!$result)
      return false;

    $resultParents = array();
    $resultIds = array();

    foreach ($result as $row) {

      //$node = $row->getNode();var_dump($node->isRoot()); die();

      $resultParents[$row->getParentId()][] = $row->toArray();
      $resultIds[$row->getId()] = $row->toArray();
    }

    $blockCategTree = self::_getTreeAsArray($resultParents, $resultIds, $maxdepth, $category_id);

    unset($resultParents);
    unset($resultIds);

    return $blockCategTree;
  }

  public static function getTreeForAssociate($object, $category_id, $maxdepth = 1) {

    $result = Doctrine::getTable('ecCategory')->getAllCategories();

    if (!$result)
      return false;

    $resultParents = array();
    $resultIds = array();

    foreach ($result as $row) {
      $resultParents[$row->getParentId()][] = $row->toArray();
      $resultIds[$row->getId()] = $row->toArray();
    }

    $blockCategTree = self::_getTreeAsArray2($object, $resultParents, $resultIds, $maxdepth, $category_id);

    unset($resultParents);
    unset($resultIds);

    return $blockCategTree;
  }
  
  private static function _getTreeAsArray2($object, $resultParents, $resultIds, $maxDepth, $id_category = 1, $currentDepth = 0) {

    $children = array();
    if($currentDepth == $maxDepth){
      
      if (isset($resultParents[$id_category]) && sizeof($resultParents[$id_category])) {
        $children = count($resultParents[$id_category]) > 0;
      }else{
        $children = false;
      }

    }
    
    if (isset($resultParents[$id_category]) && sizeof($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth)) {
      foreach ($resultParents[$id_category] as $subcat) {
        $children[] = self::_getTreeAsArray2($object, $resultParents, $resultIds, $maxDepth, $subcat['id'], $currentDepth + 1);
      }
    }

    if (!isset($resultIds[$id_category])) {
      return false;
    }

    $data = array(
      "id" => $id_category,
      'text' => '<input type="checkbox" name="categorias[]" value="' . $id_category . '" ' . (($object->hasCategory($id_category)) ? 'checked=""' : '') . ' style="position: relative; top: 3px;">&nbsp;' . $resultIds[$id_category]['Translation'][sfContext::getInstance()->getUser()->getCulture()]['name']
    );
    
    if(($currentDepth == $maxDepth) && $children){
      $data['hasChildren'] = $children;
    }elseif($currentDepth < $maxDepth && $children){
      $data['children'] = $children;
    }
    
    return $data;
      
  }
  
  private static function _getTreeAsArray($resultParents, $resultIds, $maxDepth, $id_category = 1, $currentDepth = 0) {

    $children = array();

    if (isset($resultParents[$id_category]) && sizeof($resultParents[$id_category]) && ($maxDepth == 0 || $currentDepth < $maxDepth)) {
      foreach ($resultParents[$id_category] as $subcat) {
        $children[] = self::_getTreeAsArray($resultParents, $resultIds, $maxDepth, $subcat['id'], $currentDepth + 1);
      }
    }

    if (!isset($resultIds[$id_category])) {
      return false;
    }

    return array(
      'id' => $id_category,
      'name' => $resultIds[$id_category]['Translation'][sfContext::getInstance()->getUser()->getCulture()]['name'],
      'children' => $children);
  }

  public function getSlug() {
    return mdBasicFunction::slugify($this->getName());
  }

}
