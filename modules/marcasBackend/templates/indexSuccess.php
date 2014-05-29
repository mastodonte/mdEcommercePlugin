<?php use_helper('I18N', 'Date') ?>
<?php include_partial('marcasBackend/assets') ?>

<?php slot('manufacturer'); ?>
<?php slot('nav') ?><?php echo __('Home_Marcas'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Marcas_List', array(), 'messages') ?></h1>
  <div class="pull-right">
    <a href="#filterPopup" class="btn btn-info" data-toggle="modal"><i class="icon-search"></i> Filtrar</a>
  </div>

  <?php include_partial('marcasBackend/flashes') ?>

  <?php if ($configuration->hasFilterForm()): ?>
    <?php $filterValues = $sf_user->getRawValue()->getAttribute($this->getModuleName().'.filters', array(), 'admin_module'); if (!empty($filterValues)): ?>
    <div class="alert alert-info alert-block">
      <a href="#" class="close fade" data-dismiss="alert">&times;</a>
      Estos resultados estan filtrados. <a href="#filterPopup" data-toggle="modal">Modificar Filtro</a>
    </div>
    <?php endif; ?>

  <?php endif; ?>

  <div id="sf_admin_header">
    <?php include_partial('marcasBackend/list_header', array('pager' => $pager)) ?>
  </div>
  <div id="sf_admin_bar">
    <?php include_partial('marcasBackend/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
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
