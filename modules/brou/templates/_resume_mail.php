<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<pre>
<?php echo __('Brou_Su pedido está completo.'); ?>

<?php echo __('Brou_Por favor, hága su deposito por brou con la siguiente informacion:'); ?>

- <?php echo __('Brou_la suma de:'); ?> <?php echo $order->getDisplayTotal(); ?> 

- <?php echo __('Brou_a la cuenta: XXXX-YYYY'); ?>

<?php echo str_replace(
        '%link%', 
        '<a href="' . $link . '">link</a>',
        __('Brou_Una vez realizado el deposito ingresa al siguiente %link% para ingresar el codigo de confirmacion y terminar la compra.')
      ); ?>
</pre>