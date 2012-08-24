<?php use_helper('Text'); ?>

<table collspan="0" cellspacing="0" >
  <?php $orderItems = $md_order->getMdOrderProducts(); ?>
  <?php foreach ($orderItems as $orderItem): ?>
    <tr>
      <td><a href="<?php echo url_for('@homepage'); ?>" title="<?php echo $orderItem->getItemName(); ?>"><?php echo truncate_text($orderItem->getItemName(), 36); ?></a></td>
      <td><?php echo __('mdCart_cantidad'); ?>: <?php echo $orderItem->getItemQuantity(); ?></td>
      <td></td>
      <td><?php echo $orderItem->getDisplayTotal($orderItem->getItemQuantity()); ?></td>
    </tr>
  <?php endforeach; ?>
  <tr>
    <td></td>
    <td></td>
    <td><?php echo __('mdCart_Costo de Envio');  ?></td>
    <td><?php echo $md_order->getDisplayTotalShipping(); ?></td>
  </tr>
<!--<tr>
  <td class="sin-bg"></td>
  <td class="sin-bg"></td>
  <td>I.V.A.</td>
  <td>$500.00</td>
</tr>-->
  <tr>
    <td></td>
    <td></td>
    <td><?php echo __('mdCart_Total'); ?>:</td>
    <td><?php echo $md_order->getDisplayTotal(); ?></td>
  </tr>
</table>
