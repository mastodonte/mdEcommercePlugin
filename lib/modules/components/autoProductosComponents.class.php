<?php

class autoProductosComponents extends sfComponents {

  public function executeMenu($request) {

  }
  
  public function executeDestacados($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findDestacados(false, $this->limit);
  }
  
  public function executeRelacionados($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findRelacionados($this->producto, $this->categorias, $this->limit);
  }  

  public function executeRecientes($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findDestacados(false, $this->limit);
  }
}
