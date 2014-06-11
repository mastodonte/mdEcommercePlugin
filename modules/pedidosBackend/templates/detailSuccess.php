<?php include_partial('pedidosBackend/assets') ?>

<?php slot('pedidos'); ?>
<?php slot('nav') ?><?php echo __('mdEcommerce_Pedidos'); ?> > <?php echo __('mdEcommerce_Detalle del Pedido'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <br>
  
  <h2 style="font-size: 1.4em;">
    <a href="<?php echo url_for('@md_order'); ?>">
      <img src="/sfDoctrinePlugin/images/previous.png" title="Página anterior" alt="Página anterior">
    </a>
    <?php echo $md_order->getCustomer()->getFullName(); ?> - Orden #<?php echo $md_order->getId(); ?>
  </h2>

  <?php include_partial('pedidosBackend/flashes') ?>  
  
  <div style="float:left">
    <?php
    $moduleName = 'pedidosBackend';
    /* BLOQUE 1 */
    ?>

    <?php include_component($moduleName, 'changeState', array('md_order' => $md_order)); ?>

    <?php
    /* BLOQUE 2 */
    ?>

    <?php include_component($moduleName, 'infoShipping', array('md_order' => $md_order)); ?>

  </div>

  <div style="float: left; margin-left: 40px">
    <?php
    /* BLOQUE 3 */
    ?>

    <?php include_component($moduleName, 'infoClient', array('md_order' => $md_order)); ?>  
    
    <?php
    /* BLOQUE 4 */
    ?>

    <?php include_component($moduleName, 'infoOrder', array('md_order' => $md_order)); ?>

  </div>

  <div class="clear">&nbsp;</div>

    <?php
    /* BLOQUE 5 */
    ?>

    <?php include_component($moduleName, 'infoProducts', array('md_order' => $md_order)); ?>  

</div>
