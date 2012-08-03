<form action="<?php echo ($form->isNew() ? url_for('@mdCartAddress-create') : url_for('@mdCartAddress-edit')); ?>" onsubmit="return mdCartAddress.execute(this)">
  <input type="hidden" value="true" name="ajax" />
  <?php echo $form; ?>
</form>
