<?php

/**
 * autoMdCartActions actions.
 *
 * @package    frontend
 * @subpackage mdCart
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class autoMdCartActions extends sfActions
{

  public function executeAddCart(sfWebRequest $request) 
  {
    return $this->renderText(mdCartController::getInstance()->run('add', $request));
  }
  
  public function executeUpdateCart(sfWebRequest $request) 
  {
    return $this->renderText(mdCartController::getInstance()->run('update', $request));
  }
  
  public function executeRemoveCart(sfWebRequest $request) 
  {
    return $this->renderText(mdCartController::getInstance()->run('remove', $request));
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
    // Obtenemos parametro step
    $this->step = $request->getParameter('step', -1);
    
    if(!$this->getUser()->isAuthenticated()){

        $this->step = 1;
        $this->setTemplate('checkout');

    }else{
      
      $this->step = ($this->step == -1 ? 2 : $this->step);
      
      $this->cart = mdCartController::getInstance()->init();
      if(is_null($this->cart)){
        
        //$this->getUser()->setFlash('notice', 'No cart set');
        $this->redirect('@homepage');
        
      }else{
        
        $this->addresses = Doctrine::getTable('mdAddress')->findAddressesDelivery($this->getUser()->getGuardUser()->getId());

        if($this->addresses->count() == 0)
        {
          // Si no tiene direcciones lo dirigimos a la pagina de creacion de direccion
          $this->redirect('@mdCartAddress-new');          
        }
        
      }
      
      $this->setTemplate('checkout');

    }
    
    $this->getUser()->setFlash('step', $this->step);
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
