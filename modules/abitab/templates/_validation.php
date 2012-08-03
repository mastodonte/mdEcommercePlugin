<form action="<?php echo url_for('@process-abitab'); ?>" method="POST">
  <input id="abitab_id" type="hidden" value="<?php echo $ec_abitab->getId(); ?>" name="id" />
  <input id="abitab_code" type="text" value="" name="code" />
  <input type="submit" value="Confirmar" />
</form>
