<?php use_helper('Date') ?>

<?php
$user = $md_order->getCustomer();

?>
<fieldset style="width: 400px">
  <legend>Información del cliente</legend>
  <span style="font-weight: bold; font-size: 14px;">
    <a href="#">
      <?php echo $user->getFullname(); ?>
    </a>
  </span> (#<?php echo $user->getId(); ?>)<br>
  (<a href="mailto:<?php echo $user->getEmail(); ?>"><?php echo $user->getEmail(); ?></a>)
  <br /><br />Cuenta registrada: <?php echo format_datetime($user->getCreatedAt(), 'g', $sf_user->getCulture()); ?><br />
  <!-- Pedidos válidos realizados: <b>7</b><br />
  Total gastos desde su registro: <b>6 537,51 €</b><br />-->
</fieldset>
<br />