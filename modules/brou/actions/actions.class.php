<?php

/**
 * brou actions.
 *
 * @package    frontend
 * @subpackage mdEcommercePlugin
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class brouActions extends sfActions
{
  public function executeIndex(sfWebRequest $request) 
  {
    try{
      
      // Procesar y crear la orden
      $this->md_order = Doctrine::getTable('mdOrder')->find($request->getParameter('id'));

      if($this->md_order && $this->md_order->isOrderValid())
      {
        $this->ec_brou = Doctrine::getTable('ecBrou')->getLastRegister($this->md_order->getId());
        if($this->ec_brou)
        {
          if($this->ec_brou->getStatus() == 'payed')
          {
            $this->getUser()->setFlash('notice', 'The order #' . $this->md_order->getId() . ' is already payed');
            $this->redirect('@homepage');
          }
        }
        else
        {
          // Crear registro en brou con security_key y status pending
          $this->ec_brou = ecBrou::create($this->md_order->getId());
        }
      }
      else
      {
        $this->getUser()->setFlash('error', 'Invalid Order');
        $this->redirect('@homepage');
      }

    }catch(Exception $e){
      $this->getUser()->setFlash('error', $e->getMessage());
      $this->redirect('@homepage');
    }
  }
  
  /**
   * Procesa el formulario postPago en brou para ingresar el codigo
   * y finalizar el pedido.
   * 
   * @param sfWebRequest $request 
   */
  public function executeProcess(sfWebRequest $request)
  {
    if($request->isMethod('POST'))
    {
      try{
        
        $ec_brou = Doctrine::getTable('ecBrou')->find($request->getParameter('id'));
        
        if($ec_brou)
        {
          $md_order = $ec_brou->getMdOrder();

          if($md_order && $md_order->isOrderValid())
          {
            $ec_brou->setCode($request->getParameter('code'));
            $ec_brou->setStatus(ecBrou::$status['payed']);
            $ec_brou->save();         
            
            $md_order->callToReview(sfConfig::get('app_configuration_MD_PAYED'));

            $this->redirect('@mdCart-finish?id=' . $ec_brou->getMdOrderId());            
          }
          else
          {
            $this->getUser()->setFlash('error', 'Permission Denied');
            $this->redirect('@homepage');            
          }
        }
        else
        {
          $this->getUser()->setFlash('error', 'Invalid Payment Identifier');
          $this->redirect('@homepage');          
        }

      }catch(Exception $e){

        $this->getUser()->setFlash('error', $e->getMessage());
        $this->redirect('@homepage');

      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'Invalid Invocation Method');
      $this->redirect('@homepage');
    }
  }  
  
  public function executeValidate(sfWebRequest $request)
  {
    try{
      $code = $request->getParameter('c');

      // Chequeamos validez del request y obtenemos la forma de pago: en este caso brou
      $this->ec_brou = ecBrou::checkOrderParams($code);

      // Obtenemos la orden asociada a la forma de pago
      $this->md_order = $this->ec_brou->getMdOrder();

      // Si la orden ya ha sido paga redireccionamos al homepage y notificamos
      if($this->ec_brou->getStatus() == 'payed')
      {
        $this->getUser()->setFlash('notice', 'The order #' . $this->md_order->getId() . ' is already payed');
        $this->redirect('@homepage');
        exit();
      }
      else
      {
        // Logueamos al usuario
        $md_user = $this->md_order->getMdUser();
        $md_passport = $md_user->retrieveMdPassport();

        $this->getUser()->signIn($md_passport, false);
      }

      $this->setTemplate('index');

    }catch(Exception $e){

      $this->getUser()->setFlash('error', $e->getMessage());
      $this->redirect('@homepage');

    }
  }

}

