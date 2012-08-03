<?php

/**
 * PluginmdPaypalTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmdPaypalTable extends Doctrine_Table {

  /**
   * Returns an instance of this class.
   *
   * @return object PluginmdPaypalTable
   */
  public static function getInstance() {
    return Doctrine_Core::getTable('PluginmdPaypal');
  }
  
  public function getLastRegister($md_order_id){
    return Doctrine::getTable('mdPaypal')->createQuery('a')
      ->where('a.md_order_id = ?', $md_order_id)
      ->orderBy('a.id DESC')
      ->limit(1)
      ->fetchOne();
  }

}