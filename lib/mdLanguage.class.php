<?php

class mdLanguage
{
  const DEFAULT_LANGUAGE = 'es';
  
  const COOKIE_LANGUAGE_NAME = '__Ulang';
  
  public static $_pagelangs = array( "es" => "es" );

  private static function getAcceptedLanguages()
  {
    preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $lang_parse);

    if (count($lang_parse[1])) 
    {
      $langs = array_combine($lang_parse[1], $lang_parse[4]);
      
      $rlangs = array();
      foreach ($langs as $lang => $val) {
        if ($val === '')
          $rlangs[substr($lang, 0, 2)] = 1;
        else if ($langs[substr($lang, 0, 2)] < $val)
          $rlangs[substr($lang, 0, 2)] = $val;
      }
      arsort($rlangs, SORT_NUMERIC);
    }
    else
    {
      $rlangs = array(self::DEFAULT_LANGUAGE => 1);
    }

    return $rlangs;
  }
  
  public static function autoDetectLanguage()
  {
    $langs = self::getAcceptedLanguages();
    
    foreach ($langs as $lang => $val) 
    {
      foreach(self::$_pagelangs as $key => $l)
      {
        if (strpos($lang, $key) === 0) 
        {
          return $key;
        }
      }
    }
    return self::DEFAULT_LANGUAGE;
  }
  
  public static function setLanguage($lang)
  {
    if(array_key_exists($lang, self::$_pagelangs))
    {
      sfContext::getInstance()->getUser()->setCulture($lang);

      sfContext::getInstance()->getResponse()->setCookie(self::COOKIE_LANGUAGE_NAME, $lang, time() + (15 * 24 * 3600));      
    }
  }
  
  public static function getLanguage()
  {
    $cookie = sfContext::getInstance()->getRequest()->getCookie(mdLanguage::COOKIE_LANGUAGE_NAME);
    if($cookie)
    {
      return $cookie;
    }
    else
    {
      return mdLanguage::autoDetectLanguage();
    }
  }
}
