<?php use_helper('I18N', 'Date') ?>
<?php include_partial('productosBackend/assets') ?>

<?php use_javascript('tiny_mce/tiny_mce.js', 'last'); ?>

<?php slot('productos'); ?>
<?php slot('nav') ?><?php echo __('mdEcommerce_Productos'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('mdEcommerce_New', array(), 'messages') ?></h1>

  <?php include_partial('productosBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('productosBackend/form_header', array('ec_product' => $ec_product, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('productosBackend/form', array('ec_product' => $ec_product, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('productosBackend/form_footer', array('ec_product' => $ec_product, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
