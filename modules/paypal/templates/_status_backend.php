<?php $mdPayment = Doctrine::getTable('mdPaymentModule')->findOneByLabel($md_order->getModulePayment()); ?>
<?php $registers = $md_order->getMdPaypal(); ?>

<div style="margin: 2px 0 1em 50px;">
  <table>
    <tbody>
      <tr>
        <td><label>Modo de pago: </label></td>
        <td><?php echo $mdPayment->getName(); ?></td>      
      </tr>
      <?php foreach($registers as $register): ?>

        <tr>        
          <td><label>Status:</label></td>
          <td><?php echo $register->getStatus(); ?></td>
        </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>
