<?php

class Tools {

  const MD_ROUND_UP = 'up';

  const MD_ROUND_DOWN = 'down';
  
  public static function md_round($value, $precision = 0) {
    $method = self::MD_ROUND_UP; // TODO: hacerlo configurable
    if ($method == self::MD_ROUND_UP)
      return self::ceilf($value, $precision);
    elseif ($method == self::MD_ROUND_DOWN)
      return self::floorf($value, $precision);
    return round($value, $precision);
  }

  public static function ceilf($value, $precision = 0) {
    $precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
    $tmp = $value * $precisionFactor;
    $tmp2 = (string) $tmp;
    // If the current value has already the desired precision
    if (strpos($tmp2, '.') === false)
      return ($value);
    if ($tmp2[strlen($tmp2) - 1] == 0)
      return $value;
    return ceil($tmp) / $precisionFactor;
  }

  public static function floorf($value, $precision = 0) {
    $precisionFactor = $precision == 0 ? 1 : pow(10, $precision);
    $tmp = $value * $precisionFactor;
    $tmp2 = (string) $tmp;
    // If the current value has already the desired precision
    if (strpos($tmp2, '.') === false)
      return ($value);
    if ($tmp2[strlen($tmp2) - 1] == 0)
      return $value;
    return floor($tmp) / $precisionFactor;
  }

  /**
   * Return price with currency sign for a given product
   * 
   * NOT CUSTOM YET
   *
   * @param float $price Product price
   * @param object $currency Current currency (object, id_currency, NULL => getCurrent())
   * @return string Price correctly formated (sign, decimal separator...)
   */
  public static function displayPrice($price, $currency_id = NULL) {
    if ($currency_id === NULL)
      $currency_id = mdCurrency::loadCurrency();
    
    /* if you modified this function, don't forget to modify the Javascript function formatCurrency (in tools.js) TODO: ver */
    if (is_int($currency_id))
      $currency = Doctrine::getTable('mdCurrency')->find($currency_id);
    else
      $currency = $currency_id;
    
    $_PS_PRICE_DISPLAY_PRECISION_ = 2; // TODO do configurable

    $c_char = $currency->getSign();
    $c_format = $currency->getFormat();
    $c_decimals = (int) $currency->getDecimals() * $_PS_PRICE_DISPLAY_PRECISION_;
    $c_blank = $currency->getBlank();

    $blank = ($c_blank ? ' ' : '');
    $ret = 0;
    if (($isNegative = ($price < 0)))
      $price *= - 1;
    
    $price = self::md_round($price, $c_decimals);
    
    switch ($c_format) {
      /* X 0,000.00 */
      case 1:
        $ret = $c_char . $blank . number_format($price, $c_decimals, '.', ',');
        break;
      /* 0 000,00 X */
      case 2:
        $ret = number_format($price, $c_decimals, ',', ' ') . $blank . $c_char;
        break;
      /* X 0.000,00 */
      case 3:
        $ret = $c_char . $blank . number_format($price, $c_decimals, ',', '.');
        break;
      /* 0,000.00 X */
      case 4:
        $ret = number_format($price, $c_decimals, '.', ',') . $blank . $c_char;
        break;
    }
    
    if ($isNegative)
      $ret = '-' . $ret;

    return $ret;
  }

  /**
   * Return price converted
   * 
   * NOT CUSTOM YET
   *
   * @param float $price Product price
   * @param object $currency Current currency object
   * @param boolean $to_currency convert to currency or from currency to default currency
   */
  public static function convertPrice($price, $currency = NULL, $to_currency = true) {
    if ($currency === NULL)
      $currency = Currency::getCurrent();
    elseif (is_numeric($currency))
      $currency = Currency::getCurrencyInstance($currency);

    $c_id = (is_array($currency) ? $currency['id_currency'] : $currency->id);
    $c_rate = (is_array($currency) ? $currency['conversion_rate'] : $currency->conversion_rate);

    if ($c_id != (int) (Configuration::get('PS_CURRENCY_DEFAULT'))) {
      if ($to_currency)
        $price *= $c_rate;
      else
        $price /= $c_rate;
    }

    return $price;
  }

  /**
   * Encrypt password
   *
   * @param object $object Object to display
   */
  public static function encrypt($string) {
    return md5(sfConfig::get('app_configuration_MD_SECURITY_KEY') . $string);
  }

  public static function generateKey($len = 6) {
    $pass = '';
    for ($i = 0; $i < $len; $i++) {
      $pass.= chr(rand(0, 25) + ord('a'));
    }
    return $pass;
  }
  
  /**
   * Envia un mail al usuario con los datos del metodo de pago
   * 
   * @param type $module_label
   * @param type $to
   * @param type $cart 
   */
  public static function sendCustomerMail($module_label, $to, $order, $link = NULL)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Partial'));
    
    $from = sfConfig::get('app_configuration_MD_SALE_FROM');

    $partial = get_partial($module_label . '/resume_mail', array('order' => $order, 'link' => $link));

    $options = array();
    $options['sender']    = array('name' => __('mdEcommerce_From'), 'email' => $from);
    $options['body']      = $partial;
    $options['subject']   = __("mdEcommerce_subject resume");
    $options['recipients'] = $to;
    
    mdMailHandler::sendMail($options);
  }  
  
  public static function wordCamelCase($str, $separator){
    $str = str_replace($separator, " ", $str);
    $str = ucwords(strtolower($str));
    $str = str_replace(' ', '', $str);
    return $str;
  }
}

?>
