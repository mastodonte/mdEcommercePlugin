<?php

class mdAutodetectLanguageFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {

    if ( $this->isFirstCall())
    {
      $request = $this->context->getRequest();
      if($request->hasParameter('lang') and in_array($request->getParameter('lang'), mdLanguage::$_pagelangs)){
        mdLanguage::setLanguage($request->getParameter('lang'));
      }else{
        $cookie = $request->getCookie(mdLanguage::COOKIE_LANGUAGE_NAME);
        if($cookie){
          mdLanguage::setLanguage($cookie);
        }else{
          $lang = mdLanguage::autoDetectLanguage();
          mdLanguage::setLanguage($lang);
        }
      }
    }

    $filterChain->execute();
  }
}
