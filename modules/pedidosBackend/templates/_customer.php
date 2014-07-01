<?php $user = $md_order->getCustomer(); ?>
<?php if($user): ?>
<?php echo $user; ?>
<?php else: ?>
  <?php echo 'eliminado'; ?> 
<?php endif; ?>

