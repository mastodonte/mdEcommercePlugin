<div class="ecommerce-container">
  <?php include_partial('cashondelivery/payment', array('md_order' => $md_order)); ?>

  <?php include_partial('cashondelivery/validation', array('md_order' => $md_order)); ?>
</div>
