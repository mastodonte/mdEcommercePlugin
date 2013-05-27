<?php

class mdCartPaymentComponents extends sfComponents {
  
  public function executePayment_form($request) 
  {
    $this->cart = mdCartController::getInstance()->init();
        
    $this->methods = Doctrine::getTable('mdPaymentModule')
      ->createQuery('p')
      ->leftJoin('p.Translation t')
      ->where('p.active = 1')
      ->execute();
  }

}
