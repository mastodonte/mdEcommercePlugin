<?php

class mdPaypalController {

  private static $instance = NULL;

  private function __construct() {
    
  }

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new mdPaypalController();
    }
    return self::$instance;
  }
  
  public function sale($md_order, $md_paypal) {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'I18N'));

    $expressCheckout = new Md_Express_Checkout();
    $expressCheckout->setReturnUrl(url_for('@mdPaypalReturnUrl', true) . '?PAYMENTACTION=Sale&register=' . $md_paypal->getId());
    $expressCheckout->setCancelUrl(url_for('@mdPaypalCancelUrl', true) . '?register=' . $md_paypal->getId());
    //$expressCheckout->setLocaleCode('');  TODO

    $options = array(
      'SHIPDISCAMT' => 0,
      'DESC' => __('Mensajes_Carrito de Compra'),
      'PAYMENTACTION' => 'Sale',
      'CURRENCYCODE' => 'USD'
    );
    $expressCheckout->addPaymentDetail($options);

    //'DESC' => $orderItem->getItemName(),
    foreach($md_order->getMdOrderProducts() as $orderItem)
    {
      //echo Tools::md_round($orderItem->getItemPrice(), 2);
      //echo $orderItem->getTotal($orderItem->getItemQuantity()); die();
      // Agrego los Items, van a ser 2, el aparato y la primera carga
      $options = array(
        'NAME' => $orderItem->getItemName(),
        'AMT' => (float)Tools::md_round($orderItem->getItemPrice(), 2),
        'QTY' => $orderItem->getItemQuantity()
      );
      $expressCheckout->addPaymentDetailsItem($options);      
    }

    // RECURRING PAYMENTS
    /*$options = array(
      'BILLINGTYPE' => 'RecurringPayments',
      'BILLINGAGREEMENTDESCRIPTION' => __('Mensajes_Suscripción mensual') . ' R$ ' . sfConfig::get('app_zaz_recurring_price')
    );
    $expressCheckout->addBillingAgreementDetails($options);*/

    $response = $expressCheckout->setExpressCheckout();
  }

  public function commitTransaction($token, $paymentaction) {
    sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');

    $expressCheckout = new Md_Express_Checkout();
    $expressCheckout->setToken($token);

    $details = $expressCheckout->getExpressCheckoutDetails();

    // ############################################
    // if(!$details) return false; manejar este error ?
    // Requerido para el doExpressCheckoutPayment, lo agregamos a prepo
    $details['PAYMENTACTION'] = $paymentaction;
    // ############################################
    
    $response = $expressCheckout->doExpressCheckoutPayment($details);

    if ($response) {
      $this->endTransaction($response);

      // RECURRING PAYMENTS
      /*$options = array(
        'BILLINGPERIOD' => 'Month',
        'BILLINGFREQUENCY' => 1,
        'AMT' => sfConfig::get('app_zaz_recurring_price'),
        'CURRENCYCODE' => zazController::CURRENCY_CODE,
        'DESC' => __('Mensajes_Suscripción mensual') . ' R$ ' . sfConfig::get('app_zaz_recurring_price'),
        'PROFILESTARTDATE' => date('c')
      );
      $expressCheckout->addRecurringPaymentProfileDetails($options);

      $response = $expressCheckout->createRecurringPaymentsProfile();

      if ($response) {

        // Si el status es ActiveProfile se recibe esto:
        // ["PROFILEID"]=>string(14) "I-M9R6FKPT63L6"
        // ["PROFILESTATUS"]=>string(13) "ActiveProfile"
        // ["TIMESTAMP"]=>string(20) "2011-08-03T18:31:05Z"
        // ["CORRELATIONID"]=>string(13) "d7d7cbdf83790"
        // ["ACK"]=>string(7) "Success"
        // ["VERSION"]=>string(4) "65.1"
        // ["BUILD"]=>string(7) "2020243"
        // Si el status no es ActiveProfile ver opciones

        $this->endRebuild($response);
      } else {
        sfContext::getInstance()->getLogger()->log('PAYPAL::commitTransaction - no se ha podido realizar el rebuild');
      }*/

      return true;
    } else {
      sfContext::getInstance()->getLogger()->log('PAYPAL::commitTransaction - no se ha podido realizar la venta');

      // Loguear que no se ha podido realizar la venta
      //$this->log(zazController::SALE, $expressCheckout->getErrors(), NULL, false);

      return false;
    }
  }

  public function endTransaction($response) {

  }

}
