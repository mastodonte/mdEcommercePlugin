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
      $cookie = $this->context->getRequest()->getCookie(mdLanguage::COOKIE_LANGUAGE_NAME);
      if($cookie)
      {
        mdLanguage::setLanguage($cookie);
      }
      else
      {
        $lang = mdLanguage::autoDetectLanguage();
        mdLanguage::setLanguage($lang);
      }
    }

    $filterChain->execute();
  }
}
