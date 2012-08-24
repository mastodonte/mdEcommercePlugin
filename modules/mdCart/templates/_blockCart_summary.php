<a href="<?php echo url_for('@mdCart-cart'); ?>">
  <span class="ecommerce-ajax_cart_quantity" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
    <?php echo $cart->getQuantity(); ?>
  </span>
  <span class="ecommerce-ajax_cart_product_txt" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
    <?php echo format_number_choice('(-Inf,1]' . __('mdCart_producto') . '|(1,+Inf]' . __('mdCart_productos'), array(), $cart->getQuantity()); ?>
  </span> - 
  <span class="ecommerce-ajax_cart_total" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
    <?php echo $cart->getDisplayTotal(); ?>
  </span>
</a>

<span class="ecommerce-ajax_cart_no_product" style="display:<?php echo (($cart->getQuantity() > 0) ? 'none' : 'inline'); ?>">
  <?php echo __('mdCart_vacio'); ?>
</span>
