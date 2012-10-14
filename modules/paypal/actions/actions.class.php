<?php

/**
 * paypal actions.
 *
 * @package    frontend
 * @subpackage mdPaypal
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paypalActions extends sfActions {

  public function executeIndex(sfWebRequest $request) 
  {
    try{
      
      // Obtener la orden
      $this->md_order = Doctrine::getTable('mdOrder')->find($request->getParameter('id'));

      if($this->md_order && $this->md_order->isOrderValid())
      {
        $this->md_paypal = mdPaypal::create($this->md_order->getId());
        mdPaypalController::getInstance()->sale($this->md_order, $this->md_paypal);
      }
      else
      {
        $this->getUser()->setFlash('error', 'Invalid Order');
        $this->redirect('@homepage');
      }
    }catch (sfStopException $e) {
      
      throw $e; //rethrowing it, nothing else to do
      
    }catch(Exception $e){
      $this->getUser()->setFlash('error', $e->getMessage());
      $this->redirect('@homepage');
    }
  }
  
  public function executeValidate(sfWebRequest $request) {
    // TODO VALIDACIONES
    
    $token = $request->getParameter('token');
    $payerId = $request->getParameter('PayerID');
    $paymentaction = $request->getParameter('PAYMENTACTION');
    $register_id  = $request->getParameter('register');
      
    if (mdPaypalController::getInstance()->commitTransaction($token, $paymentaction)) 
    {
      $md_paypal = Doctrine::getTable('mdPaypal')->find($register_id);
      
      $md_paypal->setStatus(mdPaypal::$status['payed']);
      $md_paypal->setTransactionId($payerId);      
      $md_paypal->save();
      
      $md_order = $md_paypal->getMdOrder();
      
      $md_order->callToReview(sfConfig::get('app_configuration_MD_PAYED'));

      mdCartController::sendCustomerMail($this->getUser()->getEmail(), $md_order);
      
      $this->redirect('@mdCart-finish?id=' . $md_paypal->getMdOrderId());
    } 
    else 
    {
      $this->getUser()->setFlash('error', 'Paypal Error');
      $this->redirect('@homepage');
    }
  }
  
  public function executeCancel(sfWebRequest $request) {
    // TODO VALIDACIONES
    
    $register_id  = $request->getParameter('register');
    $md_paypal    = Doctrine::getTable('mdPaypal')->find($register_id);
    $md_paypal->setStatus(mdPaypal::$status['canceled']);
    $md_paypal->save();
    
    $md_order = $md_paypal->getMdOrder();    
    $md_order->callCanceled();
    
    //$this->getUser()->setFlash('error', 'Paypal Canceled');
    $this->redirect('@homepage');    
  }

}
