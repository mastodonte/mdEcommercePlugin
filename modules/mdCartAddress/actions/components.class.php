<?php

class mdCartAddressComponents extends sfComponents {

  public function executeAddress_block($request) 
  {
    $this->cart = mdCartController::getInstance()->init();
    
    // Obtenemos todas las direcciones del usuario que esta logueado
    $this->addresses = Doctrine::getTable('mdAddress')->findAddressesDelivery($this->getUser()->getGuardUser()->getId());
  }
  
  public function executeAddress_form($request) 
  {
    $cart = mdCartController::getInstance()->init();
    //if(is_null($cart->getAddressDeliveryId())){
      $this->form = new mdAddressForm();
    ///}else{
    //  $mdAddress = Doctrine::getTable('mdAddress')->find($cart->getAddressDeliveryId());
    //  $this->form = new mdAddressForm($mdAddress);
    //}
  }

}
