<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<pre>
  <?php echo __('PagoEnLocal_Su pedido está completo.'); ?>

  <?php echo __('PagoEnLocal_Ha elegido pagar en nuestro local.'); ?>

  - <?php echo __('PagoEnLocal_la suma es de:'); ?> <?php echo $order->getDisplayTotal(); ?>

  <?php echo __('PagoEnLocal_Para cualquier pregunta, póngase en contacto con nuestro servicio de atencion al cliente 0900 1111'); ?>
</pre>
