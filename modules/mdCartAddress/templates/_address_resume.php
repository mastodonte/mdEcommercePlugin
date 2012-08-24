<?php $mdShipping = $cart->getShippingData(); ?>
<div class="datos-entrega">
  <div class="datos-1">
    <span><?php echo $mdShipping->getFirstname() . ' ' . $mdShipping->getLastname(); ?></span><div class="clear"></div>
    <span><?php echo $mdShipping->getAddress(); ?></span><div class="clear"></div>
    <span><?php echo $mdShipping->getCity(); ?>, <?php echo $mdShipping->getPostcode(); ?></span><div class="clear"></div>
    <span><?php echo $mdShipping->getCountryCode(); ?></span><div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
