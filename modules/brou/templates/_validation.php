<form action="<?php echo url_for('@process-brou'); ?>" method="POST">
  <input id="brou_id" type="hidden" value="<?php echo $ec_brou->getId(); ?>" name="id" />
  <input id="brou_code" type="text" value="" name="code" />
  <input type="submit" value="Confirmar" />
</form>
