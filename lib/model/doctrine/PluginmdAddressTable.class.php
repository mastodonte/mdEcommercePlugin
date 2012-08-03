<?php

/**
 * PluginmdAddressTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginmdAddressTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object PluginmdAddressTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PluginmdAddress');
    }
    
    public function findAddressesDelivery($md_user_id, $last = false)
    {
      $records = Doctrine_Query::create()
        ->from('mdAddress a')
        ->where('a.customer_id = ?', $md_user_id)
        ->orderBy('a.id DESC')
        ->execute();
      
      if($last){
        return $records->getFirst();
      }
      
      return $records;
    }
    
    // Por ahora lo dejo comentado pero no se deberia usar este metodo
    /*public function findAddressDelivery($md_cart_id)
    {
      return Doctrine_Query::create()
        ->select('a.*')
        ->from('mdAddress a, mdCart m')
        ->where('m.address_delivery_id = a.id')
        ->andWhere('m.id = ?', $md_cart_id)
        ->execute()->getFirst();
    }*/
}