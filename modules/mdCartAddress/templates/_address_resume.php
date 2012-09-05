<?php $mdShipping = $md_order->getShippingData(); ?>
<fieldset>
  <legend>
    <b>Direccion de Entrega</b>
  </legend>
  <div class="ecommerce-subcontainer">
    <span><?php echo $mdShipping->getAlias(); ?></span><div class="clear"></div>    
    <span><?php echo $mdShipping->getFirstname() . ' ' . $mdShipping->getLastname(); ?></span><div class="clear"></div>
    <span><?php echo $mdShipping->getAddress(); ?></span><div class="clear"></div>
    <span><?php echo $mdShipping->getCity(); ?>, <?php echo $mdShipping->getPostcode(); ?></span><div class="clear"></div>
    <span><?php echo format_country($mdShipping->getCountryCode()); ?></span><div class="clear"></div>
  </div>
  <div class="clear"></div>
</fieldset>

