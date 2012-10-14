<?php

require_once dirname(__FILE__).'/../lib/productosBackendGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productosBackendGeneratorHelper.class.php';

/**
 * productosBackend actions.
 *
 * @package    superventas
 * @subpackage productosBackend
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productosBackendActions extends autoProductosBackendActions
{
  public function executeAutosuggest(sfWebRequest $request) {
    $items = array();

    $datas = Doctrine::getTable('ecProduct')->autosuggest($request->getParameter('q'), 10);

    foreach ($datas as $data) {
      $items[] = array(
          "value" => $data->getId(),
          "name" => $data->getName()
      );
    }

    return $this->renderText(json_encode($items));
  }
}
