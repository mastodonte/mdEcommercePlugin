<?php

class autoProductosComponents extends sfComponents {
  
  public function executeDestacados($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findDestacados(false, $this->limit);
  }
  
  public function executeRelacionados($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findRelacionados($this->producto, $this->categorias, $this->limit);
  }  

  public function executeRecientes($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findRecientes(false, $this->limit);
  }

  public function executeRandom($request) {
    $this->productos = Doctrine::getTable('ecProduct')->findRandom(false, $this->limit);
  }


}
