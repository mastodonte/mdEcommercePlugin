<form action="<?php echo url_for('@process-redpagos'); ?>" method="POST">
  <input id="redpagos_id" type="hidden" value="<?php echo $ec_redpagos->getId(); ?>" name="id" />
  <input id="redpagos_code" type="text" value="" name="code" />
  <input type="submit" value="Confirmar" />
</form>
