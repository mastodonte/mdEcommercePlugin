<?php use_helper('I18N', 'Date') ?>
<?php include_partial('categoriasBackend/assets') ?>

<?php use_javascript('../mdEcommercePlugin/js/categoriasBackend/list/jquery.treeTable.js', 'last'); ?>
<?php use_stylesheet('../mdEcommercePlugin/css/categoriasBackend/list/jquery.treeTable.css', 'last'); ?>

<?php slot('categorias'); ?>
<?php slot('nav') ?><?php echo __('Home_Categorias'); ?><?php end_slot(); ?>

<div id="sf_admin_container">
  <h1><?php echo __('Categorias_List', array(), 'messages') ?></h1>

  <?php include_partial('categoriasBackend/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('categoriasBackend/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('ec_category_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('categoriasBackend/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('categoriasBackend/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('categoriasBackend/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('categoriasBackend/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
