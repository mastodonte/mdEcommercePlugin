<div id="ecommerce-payment-method">
  <div class="ecommerce-checkout-heading"><?php echo __('mdEcommerce_Paso 3: Forma de Pago'); ?></div>
  <div class="ecommerce-checkout-content" style="display:<?php echo (($sf_user->isAuthenticated() && $sf_user->getFlash('step', 1) == 3) ? 'block' : 'none'); ?>">
    <?php if ($sf_user->isAuthenticated() && $sf_user->getFlash('step', 1) == 3): ?>

      <?php include_component('mdCartPayment', 'payment_form'); ?>

    <?php endif; ?>
  </div>
</div>