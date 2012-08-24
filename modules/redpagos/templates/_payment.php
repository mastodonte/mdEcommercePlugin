<div class="ecommerce-subcontainer">
  <h2>Datos de entrega:</h2>

  <?php include_partial('mdCartAddress/resume', array('md_order' => $md_order)); ?>

  <h2>Datos de facturacion:</h2>

  <?php include_partial('mdCart/resume', array('md_order' => $md_order)); ?>
</div>