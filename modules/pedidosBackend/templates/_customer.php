<?php $mdUser = $md_order->getMdUser(); ?>
<?php if($mdUser): ?>
<?php echo $mdUser->getMdUserProfile()->getFullName(); ?>
<?php else: ?>
  <?php echo 'eliminado'; ?> 
<?php endif; ?>

