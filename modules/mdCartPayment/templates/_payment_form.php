<fieldset>
  <legend>
    <b>Formas de Pago</b>
  </legend>

  <p>Seleccione la forma con la que prefiera realizar el pago y luego presione en PAGAR</p>
  
  <form action="<?php echo url_for('@mdCart-payment'); ?>" method="GET">

    <?php include_partial('mdCartPayment/payment_methods', array('methods' => $methods)); ?>

    <input class="button" type="submit" value="PAGAR" <?php echo (is_null($cart->getAddressDeliveryId()) ? 'disabled="disabled"' : ''); ?>>

  </form>
</fieldset>      