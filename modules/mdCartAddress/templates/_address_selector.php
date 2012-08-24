<?php use_helper('I18N'); ?>

<div class="ecommerce_address_selector">
  
  <form id="ecommerce_selector_form" action="<?php echo url_for('@mdCartAddress-validate'); ?>" method="POST">
    <label>Elija una dirección de entrega:</label>
    <select id="ecommerce_address_selector" name="address" onchange="mdCartAddress.display();">

      <?php foreach($addresses as $address): ?>

        <option value="<?php echo $address->getId(); ?>" <?php echo ($cart->getAddressDeliveryId() == $address->getId() ? 'selected="selected"' : ''); ?>><?php echo $address->getAlias(); ?></option>

      <?php endforeach; ?>

    </select>
  </form>
  
</div>

<script type="text/javascript">
  var formatedAddressFieldsValuesList = new Array();
  <?php $i = 0; ?>
  <?php foreach($addresses as $address): ?>
    var obj = {};
    obj.ecommerce_alias = '<?php echo $address->getAlias(); ?>';    
    obj.ecommerce_firsname_lastname = '<?php echo $address->getFirstname() . ' ' . $address->getLastname(); ?>';
    obj.ecommerce_firsname_address = '<?php echo $address->getAddress(); ?>';
    obj.ecommerce_postcode_city = '<?php echo $address->getPostcode() . ' ' . $address->getCity(); ?>';
    obj.ecommerce_country_name = '<?php echo format_country($address->getCountryCode()); ?>';
    obj.ecommerce_phone = '<?php echo $address->getPhone(); ?>';
    formatedAddressFieldsValuesList['<?php echo $address->getId(); ?>'] = obj;
    <?php $i++; ?>
  <?php endforeach; ?>
</script>
