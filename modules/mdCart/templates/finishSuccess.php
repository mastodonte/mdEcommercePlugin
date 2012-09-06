<div class="ecommerce-container">
  <h2><?php echo __('mdEcommerce_Compra exitosa!'); ?></h2>

  <div class="ecommerce-sub-container">
    <h3><?php echo __('mdEcommerce_Gracias por la compra'); ?></h3>
       
    <p><?php echo __('mdEcommerce_En este momento estamos procesando su pedido, una vez confirmados todos los datos le será enviada la confirmación del mismo vía Email.'); ?></p>

    <p><?php echo __('mdEcommerce_Su número de orden es:'); ?> #<?php echo $sf_request->getParameter('id'); ?></p>

    <p><?php echo __('mdEcommerce_Texto Informativo'); ?></p>
    
    <p><?php echo __('mdEcommerce_Ante cualquier consulta no dude en contactarnos en el Servicio de atención al cliente TEL: +598 2409 99 99 o info@miempresa.com.uy'); ?></p>

  </div>
</div>
