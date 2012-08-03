<div id="cart-buttons" class="buttons">
  <a href="<?php echo url_for('@mdCart-order'); ?>" class="button">
    <span class="s_text"><?php echo __('mdCart_Carrito'); ?></span>
  </a>
  <div class="checkout">
    <a href="<?php echo url_for('@mdCart-checkout'); ?>" class="button">
      <span><?php echo __('mdCart_Check out'); ?></span>
    </a>
  </div>
</div>
