<?php

class autoMdCategoriasComponents extends sfComponents {

  public function executeMenu($request) 
  {
    $this->categorias = array();
    
    foreach(ecCategory::getRoots() as $root){
      $this->categorias[] = ecCategory::getTreeAsArray($root->getId(), (is_null($this->maxdepth) ? 2 : $this->maxdepth));
    }
  }
  
  public function executeMenuFooter($request) 
  {
    $this->categorias = array();
    
    foreach(ecCategory::getRoots() as $root){
      $this->categorias[] = ecCategory::getTreeAsArray($root->getId(), (is_null($this->maxdepth) ? 2 : $this->maxdepth));
      //$this->categorias[] = ecCategory::getTreeAsArray($root->getId(), 0);
    }
    
    //var_dump($this->categorias); die();
  }  

  public function executeAccordion($request)
  {
    $this->parent = $this->categoria->isRoot() ? $this->categoria : $this->categoria->getParent();
    
    $records = ecCategory::getTreeAsArray($this->parent->getId(), 2);
    
    $this->categorias = $records['children'];
  }

}
