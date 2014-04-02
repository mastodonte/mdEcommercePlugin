<td>
<div class="btn-group">
      <?php echo link_to(__('Agregar sub-categoria', array(), 'messages'), 'categoriasBackend/ListNew?id='.$ec_category->getId(), array(  'class' => 'btn btn-success',)) ?>    <?php echo $helper->linkToEdit($ec_category, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>    <?php echo $helper->linkToDelete($ec_category, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?></div>
</td>
