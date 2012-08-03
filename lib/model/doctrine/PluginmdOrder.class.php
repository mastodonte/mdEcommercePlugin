<?php

/**
 * PluginmdOrder
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginmdOrder extends BasemdOrder
{
  // Se agrega este metodo porque no se declaro como clave foranea
  public function getMdOrderProducts()
  {
    return Doctrine::getTable('mdOrderDetail')->findBy('md_order_id', $this->getId());
  }
  
  // Se agrega este metodo porque no se declaro como clave foranea
  public function getMdCart()
  {
    return Doctrine::getTable('mdCart')->find($this->getMdCartId());
  }
  
  public function getQuantity(){
    $orderItems = $this->getMdOrderProducts();
    
    if(!$orderItems) return 0;

    $qty = 0;
    foreach($orderItems as $orderItem){
      $qty+= $orderItem->getItemQuantity();
    }
    
    return $qty;
  }
  
  public function getSubTotal(){
    $orderItems = $this->getMdOrderProducts();
    
    if(!$orderItems) return 0;

    $total = 0;
    foreach($orderItems as $orderItem){
      $total+= $orderItem->getTotal($orderItem->getItemQuantity());
    }
    
    return $total;
  }
  
  public function getTotal(){
    // costo productos + costo envio
    $total = $this->getSubTotal() + $this->getTotalShipping();  
    
    return $total;
  }  
  
  public function getDisplayTotal(){
    return Tools::displayPrice((float)$this->getTotal());
  }  
  
  public function getDisplaySubTotal(){
    return Tools::displayPrice((float)$this->getSubTotal());
  }
  
  public function getDisplayTotalShipping(){
    return Tools::displayPrice((float)$this->getTotalShipping());
  }   
  
  // Tuve que hacer este getter porque en el schema no lo defini como clave foranea
  public function getShippingData(){
    return Doctrine::getTable('mdAddress')->find($this->getAddressDeliveryId());
  }
  
  public function isOrderValid(){

    if(sfContext::getInstance()->getUser()->isAuthenticated())
    {
      return ($this->getCustomerId() == sfContext::getInstance()->getUser()->getMdUserId());
    }
    else
    {
      return false;
    }

  }
  
  /**
   * Setea la orden para ser revisada y setea el estado de la orden
   */
  public function callToReview($status = NULL){
    // Enviar Mail al Admin
    // TODO
    
    $this->setToReview(true);
    $this->save();
    
    if(!is_null($status))
    {
      $mdOrderHistory = new mdOrderHistory();
      $mdOrderHistory->setMdOrderId($this->getId());
      $mdOrderHistory->setMdOrderStateId($status);
      $mdOrderHistory->save();
    }
  }
  
  /**
   * Setea la orden como cancelada
   */
  public function callCanceled($status = NULL){    
    $mdOrderHistory = new mdOrderHistory();
    $mdOrderHistory->setMdOrderId($this->getId());
    $mdOrderHistory->setMdOrderStateId(sfConfig::get('app_configuration_MD_CANCELED'));
    $mdOrderHistory->save();
  }  
}