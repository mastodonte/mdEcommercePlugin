<form action="<?php echo ($form->isNew() ? url_for('@mdCartAddress-create') : url_for('@mdCartAddress-update')); ?>" method="POST">
  
  <input type="hidden" value="true" name="ajax" />
  
  <?php echo $form; ?>
  
  <input type="submit" value="Guardar" />
  
</form>


<?php //onsubmit="return mdCartAddress.execute(this)"
