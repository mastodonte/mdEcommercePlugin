<div class="ecommerce_address_block">

  <?php include_partial('mdCartAddress/address_info', array('addresses' => $addresses, 'cart' => $cart)); ?>
  
  <br class="clear">   
  
  <a title="Añadir" href="javascript:void(0)" onclick="mdCartAddress.expandForm();">Añadir nueva dirección</a><br class="clear"> 
  
  <div id="ecommerce_address_form" style="display: none;">
         
    <?php include_component('mdCartAddress', 'address_form', array('callback_js' => true)); ?>
    
  </div>

  <br class="clear">  
  
  <input class="button" type="button" value="Continuar" onclick="$('#ecommerce_selector_form').submit();" />
  
</div>
