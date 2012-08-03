<?php $colapseExpandStatus = $sf_user->getAttribute('display', 'expanded', 'mdCart'); ?>

<h4>
  <a href="<?php echo url_for('@mdCart-order'); ?>"><?php echo ucfirst(__('mdCart_Carrito')); ?></a>

  <span id="block_cart_expand" <?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? 'class="hidden"' : ''); ?>>&nbsp;</span>
  <span id="block_cart_collapse" <?php echo ((isset($colapseExpandStatus) && $colapseExpandStatus == 'collapsed') ? 'class="hidden"' : '' ); ?>>&nbsp;</span>
</h4>
