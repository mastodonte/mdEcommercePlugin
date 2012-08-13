<div id="ecommerce-checkout">
  
  <div class="ecommerce-checkout-heading"><?php echo __('mdEcommerce_Paso 1: Authentificacion'); ?></div>

  <div class="ecommerce-checkout-content" style="display:<?php echo ((!$sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">

    <?php if (!$sf_user->isAuthenticated()): ?>
      <div class="ecommerce-left">

        <?php include_component('mdUserManagementFrontend', 'basicRegisterForm'); ?>

      </div>
    
      <div class="ecommerce-right">
        
        <?php include_component('mdAuth', 'smallSigninAjax'); ?>
        
      </div>
    <?php endif; ?>

  </div>
  
</div>