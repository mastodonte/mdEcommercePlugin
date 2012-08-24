<div id="ecommerce-shipping-address">
  <div class="ecommerce-checkout-heading"><?php echo __('mdEcommerce_Paso 2: Detalles de Entrega'); ?></div>
  <div class="ecommerce-checkout-content" style="display:<?php echo (($sf_user->isAuthenticated() && $sf_user->getFlash('step', 1) == 2) ? 'block' : 'none'); ?>">

    <?php if ($sf_user->isAuthenticated() && $sf_user->getFlash('step', 1) == 2): ?>

      <?php include_component('mdCartAddress', 'address_block'); ?>

    <?php endif; ?>

  </div>
</div>