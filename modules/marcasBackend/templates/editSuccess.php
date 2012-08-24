<?php use_helper('I18N', 'Date') ?>
<?php include_partial('marcasBackend/assets') ?>

<?php slot('manufacturer'); ?>
<?php slot('nav') ?><?php echo __('Home_Marcas'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Marcas_Edit', array(), 'messages') ?></h1>

  <?php include_partial('marcasBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('marcasBackend/form_header', array('ec_manufacturer' => $ec_manufacturer, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('marcasBackend/form', array('ec_manufacturer' => $ec_manufacturer, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('marcasBackend/form_footer', array('ec_manufacturer' => $ec_manufacturer, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
