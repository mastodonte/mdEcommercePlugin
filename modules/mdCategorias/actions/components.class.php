<?php

class mdCategoriasComponents extends sfComponents {

  public function executeMenu($request) 
  {
    $this->categorias = array();
    
    foreach(ecCategory::getRoots() as $root){
      $this->categorias[] = ecCategory::getTreeAsArray($root->getId(), (is_null($this->maxdepth) ? 2 : $this->maxdepth));
    }
  }

}
