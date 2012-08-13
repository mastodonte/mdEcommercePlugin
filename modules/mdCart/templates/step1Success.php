<?php
/**
 * La pagina a la cual debe navegar luego del login o del registro es: @mdCart-checkout ( /mdcart/checkout )
 */
?>

<div class="section" id="page_content">
  <div id="content-login" class="container">

    <div class="checkout">
      
      <?php include_partial('mdCart/cart_authentication'); ?>
      
      <?php include_partial('mdCart/cart_entrega'); ?>
      
      <?php include_partial('mdCart/cart_pago'); ?>      

    </div>
  </div>
</div>
