<?php

class mdCartComponents extends sfComponents {

  public function executeBlockCart($request) 
  {
    // Inicializa el carrito
    $this->cart = mdCartController::getInstance()->init((isset($this->md_cart_id) ? $this->md_cart_id : NULL));
  }
  
  public function executePayMethods($request) 
  {
    $this->methods = Doctrine::getTable('mdPaymentModule')
      ->createQuery('p')
      ->leftJoin('p.Translation t')
      ->where('p.active = ?', true)
      ->execute();
  }

}
