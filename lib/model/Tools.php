<?php

class Tools {

  const MD_ROUND_UP = 'up';

  const MD_ROUND_DOWN = 'down';
  
  const COOKIE_KEY = 'Etn0d0ts4m3dy3k31k00c4l4r4p3v41c41s34ts3';
  
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
  public static function displayPrice($price, $currency = NULL) {
    if ($currency === NULL)
      $currency = mdCurrency::loadCurrency();
    /* if you modified this function, don't forget to modify the Javascript function formatCurrency (in tools.js) */
    if (is_int($currency))
      $currency = Currency::getCurrencyInstance((int) $currency);

    if (is_array($currency)) {
      $c_char = $currency['sign'];
      $c_format = $currency['format'];
      $c_decimals = (int) $currency['decimals'] * _PS_PRICE_DISPLAY_PRECISION_;
      $c_blank = $currency['blank'];
    } elseif (is_object($currency)) {
      $c_char = $currency->sign;
      $c_format = $currency->format;
      $c_decimals = (int) $currency->decimals * _PS_PRICE_DISPLAY_PRECISION_;
      $c_blank = $currency->blank;
    }
    else
      return false;

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
  public static function encrypt($passwd) {
    return md5(self::COOKIE_KEY . $passwd);
  }

}

?>
