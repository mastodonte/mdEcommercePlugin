<div id="ecommerce-shipping-address">
  <div class="ecommerce-checkout-heading"><?php echo __('mdEcommerce_Paso 2: Detalles de Entrega'); ?></div>
  <div class="ecommerce-checkout-content" style="display:<?php echo (($sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">

    <?php if ($sf_user->isAuthenticated()): ?>

      <?php include_component('mdCartAddress', 'sendBlock'); ?>

    <?php endif; ?>

  </div>
</div>