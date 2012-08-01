<?php

/**
 * mdCart actions.
 *
 * @package    frontend
 * @subpackage mdCart
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mdCartActions extends sfActions
{

  public function executeAddCart(sfWebRequest $request) 
  {
    // Obtenemos parametros
    $product_id = $request->getParameter('product_id');
    $quantity = $request->getParameter('quantity');

    return $this->renderText(mdCartController::getInstance()->run('add', array($product_id, $quantity)));
  }
  
  public function executeRemoveCart(sfWebRequest $request) 
  {
    // Obtenemos parametros
    $product_id = $request->getParameter('product_id');
    
    return $this->renderText(mdCartController::getInstance()->run('remove', array($product_id)));
  }
  
  public function executeClearCart(sfWebRequest $request) 
  {
    return $this->renderText(mdCartController::getInstance()->run('clear', array()));
  }
  
  public function executeInitCart(sfWebRequest $request) 
  {
    return $this->renderText('OK');
    //mdCartController::getInstance()->run('init', array());
  }

}
