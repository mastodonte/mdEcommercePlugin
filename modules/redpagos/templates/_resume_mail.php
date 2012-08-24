<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<pre>
  <?php echo __('Redpagos_Su pedido está completo.'); ?>

  <?php echo __('Redpagos_Por favor, hága su deposito por Redpagos con la siguiente informacion:'); ?>

  - <?php echo __('Redpagos_la suma de:'); ?> <?php echo $order->getDisplayTotal(); ?> 

  - <?php echo __('Redpagos_a la cuenta: XXXX-YYYY'); ?>

  <?php echo str_replace(
          '%link%', 
          '<a href="' . $link . '">link</a>',
          __('Redpagos_Una vez realizado el deposito ingresa al siguiente %link% para ingresar el codigo de confirmacion y terminar la compra.')
        ); ?>
</pre>
