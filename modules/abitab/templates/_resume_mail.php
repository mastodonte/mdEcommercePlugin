<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<pre>
<?php echo __('Abitab_Su pedido está completo.'); ?>

<?php echo __('Abitab_Por favor, hága su deposito por abitab con la siguiente informacion:'); ?>

- <?php echo __('Abitab_la suma de:'); ?> <?php echo $order->getDisplayTotal(); ?> 

- <?php echo __('Abitab_a la cuenta: XXXX-YYYY'); ?>

<?php echo str_replace(
        '%link%', 
        '<a href="' . $link . '">link</a>',
        __('Abitab_Una vez realizado el deposito ingresa al siguiente %link% para ingresar el codigo de confirmacion y terminar la compra.')
      ); ?>
</pre>
