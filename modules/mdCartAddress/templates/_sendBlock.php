<div class="addresses">

  <p class="address_delivery select">
    <label for="id_address_delivery">Elija una dirección de entrega:</label>
    <select onchange="mdCartAddress.display();" class="address_select" id="id_address_delivery" name="id_address_delivery">
      <option selected="selected" value="1">topador</option>
      <option value="2">vacaciones</option>
      <option value="0">house</option>
    </select>
  </p>

  <div class="clear"></div>

  <ul id="address_delivery" class="address item" style="height: 156.4px;">
    <li class="address_title">Su dirección de entrega</li>
    <li class="address_firstname_lastname">Tonga Branda</li>
    <li class="address_address">Nueva Palmira 2221</li>
    <li class="address_postcode_city">11800 Montevideo</li>
    <li class="address_Country_name">Uruguay</li>
    <li class="address_phone">249494494</li>
    <!-- <li class="address_update"><a title="Actualizar" href="">Actualizar</a></li> TODO -->
  </ul>

  <br class="clear">

  <p class="address_add submit">
    <a class="button_large" title="Añadir" href="javascript:void(0)" onclick="mdCartAddress.expandForm();">Añadir nueva dirección</a>
  </p>
  
  <div id="address_form" style="display: none;">
    
    <?php include_component('mdCartAddress', 'form'); ?>
    
  </div>

</div>

<script>
  var formatedAddressFieldsValuesList = new Array();
  <?php $i = 0; 
  $addresses = array(1,3,4); ?>
  <?php foreach($addresses as $address): ?>
    var obj = {};
    obj.firsname_lastname = 'Gaston Caldeiro_<?php echo $i; ?>';
    obj.firsname_address = 'Nueva Palmira 2016_<?php echo $i; ?>';
    obj.postcode_city = '11800 Montevideo_<?php echo $i; ?>';
    obj.Country_name = 'Uruguay_<?php echo $i; ?>';
    obj.phone = '249494494_<?php echo $i; ?>';
    formatedAddressFieldsValuesList['<?php echo $i; ?>'] = obj;
    <?php $i++; ?>
  <?php endforeach; ?>
</script>
