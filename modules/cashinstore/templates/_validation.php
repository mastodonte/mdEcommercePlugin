<div class="ecommerce-subcontainer">

  <h2>Pago en el local (al retirar la mercadería):</h2>

  <form action="<?php echo url_for('@process-cashinstore'); ?>" method="POST">
    
    <input id="md_order_id" type="hidden" value="<?php echo $md_order->getId(); ?>" name="md_order_id" />
    
    <p>Su orden será entregada y abonada en nuestro local en 
      <b><?php echo sfConfig::get('app_cashinstore_address'); ?></b>
      en el horario de Lunes a Viernes de 10 a 19 hs</p>

    <input class="button" type="submit" value="FINALIZAR" />
    
  </form>
  
</div>
