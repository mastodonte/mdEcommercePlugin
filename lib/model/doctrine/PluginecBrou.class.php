<?php

/**
 * PluginecBrou
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginecBrou extends BaseecBrou
{
  public static $status = array('canceled' => 'canceled', 'rejected' => 'rejected', 'pending' => 'pending', 'payed' => 'payed');
  
  public static function create($md_order_id){
    $register =  new ecBrou();
    $register->setMdOrderId($md_order_id);
    $register->setSecurityKey(Tools::generateKey(12));
    $register->setStatus(self::$status['pending']);
    $register->save();
    
    $mdUser = Doctrine::getTable('mdUser')->find($register->getMdOrder()->getCustomerId());
    
    // Envio de Mail
    sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    
    $code = self::getOrderParams($register->getSecurityKey(), $register->getId(), $md_order_id);
    
    $link = url_for('@payment-brou?c=' . $code , true);
    
    Tools::sendCustomerMail('brou', $mdUser->getEmail(), $register->getMdOrder(), $link);

    return $register;
  }
  
  public static function getOrderParams($security_key, $register_id, $md_order_id){
    $time = time();
    $key = Tools::encrypt($security_key . $register_id . $md_order_id . $time);

    // key | security_key | register_id | md_order_id | timestamp
    $params = base64_encode($key . '|' . $security_key . '|' . $register_id . '|' . $md_order_id . '|' . $time);
    
    return $params;
  }

  /**
   * Valida los parametros de la orden y nos devuelve
   * el registro ecBrou correspondiente
   * 
   * @param string $code
   * @return ecBrou 
   */
  public static function checkOrderParams($code){
    $params = base64_decode($code);
    $info = explode('|', $params);

    // key | security_key | register_id | md_order_id | timestamp
    list($key, $security_key, $register_id, $md_order_id, $timestamp) = $info;

    $date = strtotime(date('Y-m-d H:i:s', $timestamp) . " +1 month");
    $now = time();

    // Validamos que no haya caducado el link
    if($date < $now)
    {
      throw new Exception('Out of date');        
    }

    // Validamos la key
    if($key != Tools::encrypt($security_key . $register_id . $md_order_id . $timestamp))
    {
      throw new Exception('Verification fail');
    }
    
    // Validamos registro
    $register = Doctrine::getTable('ecBrou')->find($register_id);
    if($register)
    {
      if($register->getSecurityKey() != $security_key || $register->getMdOrderId() != $md_order_id)
      {
        throw new Exception('Verification security fail');        
      }
    }
    else
    {
      throw new Exception('Verification order fail');
    }

    return $register;
  }
}