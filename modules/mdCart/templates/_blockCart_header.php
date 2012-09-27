<?php $colapseExpandStatus = $sf_user->getAttribute('display', 'expanded', 'mdCart'); ?>

<h4>
  <a href="<?php echo url_for('@mdCart-cart'); ?>"><?php echo ucfirst(__('mdCart_Carrito')); ?></a>

  <span id="ecommerce-block_cart_expand" <?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? 'class="ecommerce-hidden"' : ''); ?>>&nbsp;</span>
  <span id="ecommerce-block_cart_collapse" <?php echo ((isset($colapseExpandStatus) && $colapseExpandStatus == 'collapsed') ? 'class="ecommerce-hidden"' : '' ); ?>>&nbsp;</span>
</h4>
