<?php
$filesJS = array(
  'mdEcommercePlugin/js/jquery-typewatch.pack.js',
  'mdEcommercePlugin/js/mdCart/mdCartTools.js',
  'mdEcommercePlugin/js/mdCart/mdSummaryAjax.js',
  'mdEcommercePlugin/js/mdCart/mdCartAjax.js'
);
?>

<?php use_javascript(assetsController::cccJs($filesJS), "last"); ?>

<div class="ecommerce-container">

  <h2><?php echo __('Productos_Lista de Compra'); ?></h2>
  
  <div id="ecommerce-md_cart_list">

    <?php include_partial('mdCart/cart_list', array('cart' => $cart)); ?>

  </div>

  <?php // Si el sitio maneja descuentos mostramos ?>
  <div id="ecommerce-md_cart_discounts">

    <?php include_partial('mdCart/cart_discount'); ?>  

  </div>
  
</div>
