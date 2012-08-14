<form action="<?php echo url_for('@process-cashinstore'); ?>" method="POST">
  <input id="md_order_id" type="hidden" value="<?php echo $md_order->getId(); ?>" name="md_order_id" />
  <input type="submit" value="Finalizar" />
</form>
