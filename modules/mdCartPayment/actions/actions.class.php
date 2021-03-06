<?php

/**
 * mdCartPayment actions.
 *
 * @package    frontend
 * @subpackage mdCartPayment
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mdCartPaymentActions extends sfActions
{
  public function executePaymentCart(sfWebRequest $request)
  {
    if($this->getUser()->isAuthenticated())
    {
      try{
        
        // Creamos la orden
        $md_order = mdCartController::getInstance()->validate($request->getParameter('payment'), sfConfig::get('app_configuration_MD_NOTPAY'));

      }catch(Exception $e){

        $this->getUser()->setFlash('error', $e->getMessage());
        $this->redirect('@homepage');

      }

      //REDIRIJO AL MODULO PARTICULAR
      $this->redirect($request->getParameter('payment') . '/index?id=' . $md_order->getId());        

    }
    else
    {
      $this->redirect('@mdCart-checkout');
    }    

  }
}
