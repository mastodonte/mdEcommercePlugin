<div class="ecommerce-container">
  <?php include_partial('brou/payment', array('md_order' => $md_order, 'ec_brou' => $ec_brou)); ?>

  <?php include_partial('brou/validation', array('md_order' => $md_order, 'ec_brou' => $ec_brou)); ?>
</div>
