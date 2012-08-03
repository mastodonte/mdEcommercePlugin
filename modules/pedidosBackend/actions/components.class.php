<?php

class pedidosBackendComponents extends sfComponents {

  public function executeInfoOrder($request) 
  {
  }
  
  public function executeInfoProducts($request) 
  {
  }
  
  public function executeInfoClient($request) 
  {
    
  }

  public function executeInfoShipping($request) 
  {
  }
  
  public function executeChangeState($request) 
  {
    $this->md_order_histories = Doctrine::getTable('mdOrderHistory')->findHistories($this->md_order->getId());
    $this->md_states = Doctrine_Query::create()->from('mdOrderState s')->leftJoin('s.Translation t')->execute();
  }
}
