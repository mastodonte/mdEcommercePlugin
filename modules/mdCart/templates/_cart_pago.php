<div id="ecommerce-payment-method">
  <div class="ecommerce-checkout-heading"><?php echo __('mdEcommerce_Paso 3: Forma de Pago'); ?></div>
  <div class="ecommerce-checkout-content" style="display:<?php echo (($sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">
    <?php if ($sf_user->isAuthenticated()): ?>

      <?php include_component('mdCart', 'payMethods'); ?>

    <?php endif; ?>          
  </div>
</div>