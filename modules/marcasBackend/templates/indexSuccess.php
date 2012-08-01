<?php use_helper('I18N', 'Date') ?>
<?php include_partial('marcasBackend/assets') ?>

<?php slot('manufacturer'); ?>
<?php slot('nav') ?><?php echo __('Home_Marcas'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Marcas_List', array(), 'messages') ?></h1>

  <?php include_partial('marcasBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('marcasBackend/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('ec_manufacturer_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('marcasBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('marcasBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('marcasBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('marcasBackend/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
