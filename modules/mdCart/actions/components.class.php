<?php

class mdCartComponents extends sfComponents {

  public function executeBlockCart($request) 
  {
    // Inicializa el carrito
    $this->cart = mdCartController::getInstance()->init();
  }

}
