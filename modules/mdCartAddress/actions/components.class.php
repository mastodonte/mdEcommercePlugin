<?php

class mdCartAddressComponents extends sfComponents {

  public function executeSendBlock($request) 
  {
    // Obtenemos todas las direcciones del usuario que esta logueado
    $this->addresses = Doctrine::getTable('mdAddress')->findAddressesDelivery($this->getUser()->getMdUserId());
  }
  
  public function executeForm($request) 
  {
    $cart = mdCartController::getInstance()->init();
    if(is_null($cart->getAddressDeliveryId())){
    $this->form = new mdAddressForm();
    }else{
      $mdAddress = Doctrine::getTable('mdAddress')->find($cart->getAddressDeliveryId());
      $this->form = new mdAddressForm($mdAddress);
    }

  }

}
