<form action="<?php echo url_for('@mdCart-payment'); ?>" method="GET">

  <?php //include_partial('mdCart/table_cart', array('cart' => $cart)); ?>

  <?php //include_component('mdCart', 'payMethods'); ?>

  <input id="md_resumen_pagar" class="float_right <?php echo (is_null($cart->getAddressDeliveryId()) ? 'boton-pagar' : 'boton-pagar-green'); ?>" type="submit" value="PAGAR" <?php echo (is_null($cart->getAddressDeliveryId()) ? 'disabled="disabled"' : ''); ?>>
</form>
