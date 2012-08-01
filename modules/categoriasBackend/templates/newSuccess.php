<?php use_helper('I18N', 'Date') ?>
<?php include_partial('categorias/assets') ?>

<?php slot('categorias'); ?>
<?php slot('nav') ?><?php echo __('Home_Categorias'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Categorias_New', array(), 'messages') ?></h1>

  <?php include_partial('categorias/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('categorias/form_header', array('ec_category' => $ec_category, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('categorias/form', array('ec_category' => $ec_category, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('categorias/form_footer', array('ec_category' => $ec_category, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
