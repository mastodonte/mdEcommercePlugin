<div class="ecommerce-container">
  <?php include_partial('cashinstore/payment', array('md_order' => $md_order)); ?>

  <?php include_partial('cashinstore/validation', array('md_order' => $md_order)); ?>
</div>