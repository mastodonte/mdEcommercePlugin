<?php // Mostramos el listado de productos que tiene el carrito  ?>

<?php $cartItems = $cart->getMdCartProducts(); ?>

<?php if ($cartItems): ?>

  <?php foreach ($cartItems as $cartItem): ?>

    <?php $product = $cartItem->getEcProduct(); ?>
    <?php echo $product->getName(); ?>

  <?php endforeach; ?>

<?php else: ?>

<p>El carrito no tiene productos ingresados</p>

<?php endif; ?>
