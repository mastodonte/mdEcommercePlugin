<?php

/**
 * PluginecCategoryTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginecCategoryTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PluginecCategoryTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('PluginecCategory');
  }

  public function addTranslation(Doctrine_Query $q) {
    $q->leftJoin($q->getRootAlias() . '.Translation t');
    return $q;
  }
  
  /**
   * Devuelve las categorias de un nivel dado. Usado para el FRONTEND principalmente
   * 
   * @param int $level
   * @param string $hydrationMode
   * @return Doctrine_Collection | array
   */
  public function getCategories($level = 0, $hydrationMode = Doctrine_Core::HYDRATE_RECORD) {
    
    $categorias = Doctrine::getTable('ecCategory')
      ->createQuery('c')
      ->where('c.level = ?', $level)
      ->leftJoin('c.Translation t')
      ->orderBy('c.level, c.position')->execute(array(), $hydrationMode);
    
    return $categorias;
    
  }
  
  /**
   * Devuelve todas las categorias. Usado para el FRONTEND principalmente
   * 
   * @param string $hydrationMode
   * @return Doctrine_Collection | array
   */
  public function getAllCategories($hydrationMode = Doctrine_Core::HYDRATE_RECORD) {
    
    $categorias = Doctrine::getTable('ecCategory')
      ->createQuery('c')
      ->leftJoin('c.Translation t')
      ->orderBy('c.level, c.position')->execute(array(), $hydrationMode);
    
    return $categorias;
    
  }
  
  /**
   * Es lo mismo que hacer Doctrine_Core::getTable('ecCategory')->getTree(),
   * la unica diferencia es que de esta manera se traen los atributos del i18n.
   * 
   * @param string $hydrationMode
   * @return Doctrine_Collection | array
   */
  public function getTreeCategoriesAdmin($hydrationMode = Doctrine_Core::HYDRATE_RECORD) {
    
    $categorias = Doctrine::getTable('ecCategory')
      ->createQuery('c')
      ->leftJoin('c.Translation t')
      ->orderBy('c.root_id, c.lft')->execute(array(), $hydrationMode);
    
    return $categorias;
    
  }
  

}