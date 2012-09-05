<?php $mdShipping = $md_order->getShippingData(); ?>

<div class="ecommerce-subcontainer">

  <h2>Contra Entrega:</h2>

  <form action="<?php echo url_for('@process-cashondelivery'); ?>" method="POST">
    
    <input id="md_order_id" type="hidden" value="<?php echo $md_order->getId(); ?>" name="md_order_id" />
    
    <p>Su orden sera entregada y abonada en el lugar donde usted indico anteriormente 
      <b><?php echo $mdShipping->getAddress(); ?>.</b>
    </p>

    <input class="button" type="submit" value="FINALIZAR" />
    
  </form>
  
</div>
