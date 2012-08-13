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
  
  public function executeUpdateCart(sfWebRequest $request) 
  {
    // Obtenemos parametros
    $product_id = $request->getParameter('product_id');
    $quantity = $request->getParameter('quantity');

    return $this->renderText(mdCartController::getInstance()->run('update', array($product_id, $quantity)));
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
  
  // Si se quiere mejorar performance adaptar esta funcionalidad en el onload ejecutar un ajax aqui
  //public function executeInitCart(sfWebRequest $request) 
  //{
    //return $this->renderText('OK');
    //mdCartController::getInstance()->run('init', array());
  //}

  public function executeDisplayCart(sfWebRequest $request)
  {
    $this->getUser()->setAttribute('display', $request->getParameter('display'), mdCart::MD_CART_NAMESPACE);
    return $this->renderText('OK');
  }
  
  public function executeCart(sfWebRequest $request)
  {
    $this->redirectUnless($this->cart = mdCartController::getInstance()->init(), '@homepage');
  }
  
  public function executeCheckoutCart(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->cart = mdCartController::getInstance()->init();
      $this->setTemplate('confirm');
    }
    else
    {
      $this->setTemplate('checkout');
    }
  }

  public function executePaymentCart(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      try{

        // Creamos la orden
        $md_order = mdCartController::getInstance()->validate($request->getParameter('payment'), sfConfig::get('app_configuration_MD_NOTPAY'));

        //REDIRIJO AL MODULO PARTICULAR
        $this->redirect($request->getParameter('payment') . '/index?id=' . $md_order->getId());

      }catch(Exception $e){

        $this->getUser()->setFlash('error', $e->getMessage());
        $this->redirect('@homepage');

      }
    }
    else
    {
      $this->redirect('@mdCart-checkout');
    }    
  }
  
  public function executeAuthCart(sfWebRequest $request)
  {
    $this->setTemplate('checkout');
  }
  
  public function executePaymentFinish(sfWebRequest $request)
  {
    $this->setTemplate('finish');
  }  
}
