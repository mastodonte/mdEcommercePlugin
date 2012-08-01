<?php

/**
 * PluginecProduct form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage filter
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormFilterPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecProductFormFilter extends BaseecProductFormFilter
{
  public function configure()
  {
    unset($this['quantity'], $this['price'], $this['price_offer'], $this['warranty'], $this['viewed'], $this['created_at'], $this['updated_at']);
  }  
}
