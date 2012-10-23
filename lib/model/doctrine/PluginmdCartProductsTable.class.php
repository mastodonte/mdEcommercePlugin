<?php

/**
 * PluginmdCartProductsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmdCartProductsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginmdCartProductsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginmdCartProducts');
    }
    
    public function findByPrimaryKey($md_cart_id, $md_product_id, $additionals){
      $query = $this->createQuery('p')
              ->where('p.md_cart_id = ?', $md_cart_id)
              ->andWhere('p.ec_product_id = ?', $md_product_id);
      
      foreach($additionals as $key => $value){
        $query->andWhere('p.' . $key . ' = ?', $value);
      }
      
      return $query->fetchOne();
    }
}