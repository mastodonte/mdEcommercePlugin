<?php $mdPayment = Doctrine::getTable('mdPaymentModule')->findOneByLabel($md_order->getModulePayment()); ?>

<label>Modo de pago: </label>
<div style="margin: 2px 0 1em 190px;"><?php echo $mdPayment->getName(); ?></div>
