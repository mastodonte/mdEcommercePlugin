<?php

/**
 * cashondelivery actions.
 *
 * @package    frontend
 * @subpackage mdEcommercePlugin
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class cashondeliveryActions extends sfActions
{
  public function executeIndex(sfWebRequest $request) 
  {
    // Procesar y crear la orden
    /*$this->md_order = Doctrine::getTable('mdOrder')->find($request->getParameter('id'));

    if(!$this->md_order || !$this->md_order->isOrderValid() || $this->md_order->getModulePayment() != 'cashondelivery')
    {
      $this->getUser()->setFlash('error', 'Invalid Order');
      $this->redirect('@homepage');
    }*/
  }
  
  /**
   * Procesa el formulario postPago en redpagos para ingresar el codigo
   * y finalizar el pedido.
   * 
   * @param sfWebRequest $request 
   */
  public function executeProcess(sfWebRequest $request)
  {
    if($request->isMethod('POST'))
    {
      // Procesar y crear la orden
      $this->md_order = Doctrine::getTable('mdOrder')->find($request->getParameter('md_order_id'));

      if($this->md_order && $this->md_order->isOrderValid())
      {
        $this->md_order->callToReview();

        $this->redirect('@mdCart-finish?id=' . $this->md_order->getId());
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'Invalid Invocation Method');
      $this->redirect('@homepage');
    }
  }
}
