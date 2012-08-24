<?php
/**
 * La pagina a la cual debe navegar luego del login o del registro es: @mdCart-checkout ( /mdcart/checkout )
 */
?>

<?php use_javascript('/mdEcommercePlugin/js/mdCartAddress/mdCartAddress.js'); ?>

<div class="ecommerce-section">
  <div class="ecommerce-container">

    <div class="ecommerce-checkout">
      
      <?php include_partial('mdCart/cart_authentication'); ?>
      
      <?php include_partial('mdCart/cart_entrega'); ?>
      
      <?php include_partial('mdCart/cart_pago'); ?>      

    </div>
  </div>
</div>
