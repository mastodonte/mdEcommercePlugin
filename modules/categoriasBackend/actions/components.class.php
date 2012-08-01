<?php

class categoriasBackendComponents extends sfComponents {

  public function executeAssociate($request) {

    $this->categorias = Doctrine::getTable('ecCategory')->getTreeCategoriesAdmin();

  }

}
