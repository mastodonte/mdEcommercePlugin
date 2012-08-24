<div class="ecommerce-container">
  <?php include_partial('redpagos/payment', array('md_order' => $md_order, 'redpagos' => $redpagos)); ?>

  <?php include_partial('redpagos/validation', array('md_order' => $md_order, 'redpagos' => $redpagos)); ?>
</div>