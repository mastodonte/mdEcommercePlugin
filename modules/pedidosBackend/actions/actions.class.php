<?php

require_once dirname(__FILE__).'/../lib/pedidosBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pedidosBackendGeneratorHelper.class.php';

/**
 * pedidosBackend actions.
 *
 * @package    superventas
 * @subpackage pedidosBackend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pedidosBackendActions extends autoPedidosBackendActions
{
  public function executeDetail(sfWebRequest $request){
    $this->md_order = $this->getRoute()->getObject();
  }
  
  public function executeChangeOrderState(sfWebRequest $request){
    $md_order_id = $request->getParameter('md_order_id');
    $md_order_state_id = $request->getParameter('md_order_state_id');
    
    $md_order = Doctrine::getTable('mdOrder')->find($md_order_id);
    if($md_order->getMdOrderStateId() != $md_order_state_id){
      $md_order_state = Doctrine::getTable('mdOrderState')->find($md_order_state_id);
      if($md_order_state){
        $md_order_history = new mdOrderHistory();
        $md_order_history->setMdOrderId($md_order_id);
        $md_order_history->setMdOrderStateId($md_order_state_id);
        $md_order_history->save();
        $this->getUser()->setFlash('notice', 'The item was update successfully.');
      }
    }
    
    $this->md_order = $md_order;
    $this->setTemplate('detail');
  }
}
