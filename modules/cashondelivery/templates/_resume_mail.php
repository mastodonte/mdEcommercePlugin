<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<pre>
  <?php echo __('ContraEntrega_Su pedido está completo.'); ?>

  <?php echo __('ContraEntrega_Ha elegido pagar en el momento de la entrega.'); ?>

  <?php echo __('ContraEntrega_Le enviaremos su pedido en breve plazo.'); ?>

  - <?php echo __('ContraEntrega_la suma es de:'); ?> <?php echo $order->getDisplayTotal(); ?>

  <?php echo __('ContraEntrega_Para cualquier pregunta, póngase en contacto con nuestro servicio de atencion al cliente 0900 1111'); ?>
</pre>
