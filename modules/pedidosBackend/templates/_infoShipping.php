<?php use_helper('I18N'); ?>
<?php $mdAddress = Doctrine::getTable('mdAddress')->find($md_order->getAddressDeliveryId()); ?>

<fieldset style="width: 400px;">
  <legend>
    <img alt="" src="../img/admin/delivery.gif">Dirección de envío
  </legend>
  
  <!-- <div style="float: right">
    <a href="#">
      <img src="../img/admin/edit.gif">
    </a>
    <a target="_blank" href="#">
      <img class="middle" alt="" src="../img/admin/google.gif">
    </a>
  </div>-->
  Nombre: <?php echo $mdAddress->getFirstname() . ' ' . $mdAddress->getLastname(); ?><br>
  Direccion: <?php echo $mdAddress->getAddress(); ?><br>
  Codigo Postal: <?php echo $mdAddress->getPostcode() . ' ' . $mdAddress->getCity(); ?><br>
  Pais: <?php echo format_country($mdAddress->getCountryCode()); ?><br>
  Telefono: <?php echo $mdAddress->getPhone() ?><br>
</fieldset>
