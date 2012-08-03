<?php use_helper('Date') ?>

<?php
$mdUser = $md_order->getMdUser();
$mdUserProfile = $mdUser->getMdUserProfile();
?>
<fieldset style="width: 400px">
  <legend><img src="../img/admin/tab-customers.gif"> Información del cliente</legend>
  <span style="font-weight: bold; font-size: 14px;">
    <a href="#">
      <?php echo $mdUserProfile->getFullname(); ?>
    </a>
  </span> (#<?php echo $mdUserProfile->getId(); ?>)<br>
  (<a href="mailto:<?php echo $mdUser->getEmail(); ?>"><?php echo $mdUser->getEmail(); ?></a>)
  <br /><br />Cuenta registrada: <?php echo format_datetime($mdUser->getCreatedAt(), 'g', $sf_user->getCulture()); ?><br />
  <!-- Pedidos válidos realizados: <b>7</b><br />
  Total gastos desde su registro: <b>6 537,51 €</b><br />-->
</fieldset>
<br />