<?php use_helper('I18N'); ?>

<?php
if (!is_null($cart->getAddressDeliveryId())) {
  $address = $cart->getShippingData();
} else {
  $address = ($addresses->count() > 0 ? $addresses->getFirst() : false);
}
?>

<?php if ($address): ?>
<fieldset>
  <legend>
    <b>Su dirección de entrega</b>
  </legend>
  
  <?php include_partial('mdCartAddress/address_selector', array('addresses' => $addresses, 'cart' => $cart)); ?>

  <div class="clear"></div>
<?php endif; ?>

<ul id="ecommerce_address_info">
  <?php if ($address): ?>
    <li class="ecommerce_address_firstname_lastname"><?php echo $address->getFirstname() . ' ' . $address->getLastname(); ?></li>
    <li class="ecommerce_address_address"><?php echo $address->getAddress(); ?></li>
    <li class="ecommerce_address_postcode_city"><?php echo $address->getPostcode() . ' ' . $address->getCity(); ?></li>
    <li class="ecommerce_address_country_name"><?php echo format_country($address->getCountryCode()); ?></li>
    <li class="ecommerce_address_phone"><?php echo $address->getPhone(); ?></li>
    <!-- <li class="address_update"><a title="Actualizar" href="">Actualizar</a></li> TODO -->
  <?php endif; ?>
</ul>
    
<?php if ($address): ?>    
</fieldset>
<?php endif; ?>
