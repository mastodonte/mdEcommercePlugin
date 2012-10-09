<?php
/**
 * Recibe en $cart el carrito asociado a la venta
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo __('mdEcommerce_Title Mail'); ?></title>
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" style="width:500px; border:none; margin:10px;">
      <tr>
        <td><?php echo image_tag('/images/logo.png', array('absolute' => true, 'alt' => __('mdEcommerce_www.dominio.com.uy'))); ?></td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0px 0px 0px;">
          <?php echo __('PagoEnLocal_Su pedido está completo.'); ?>
        </td>
      </tr>      
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0;">
          <?php echo __('PagoEnLocal_Ha elegido pagar en nuestro local.'); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0 0 10px 0;">
          <?php echo __('PagoEnLocal_la suma es de:'); ?>
          <span style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#D96A12; font-size:12px; font-weight:bold; padding-left:5px;">
            <?php echo $order->getDisplayTotal(); ?>
          </span>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0;">
          <?php echo __('PagoEnLocal_Para cualquier pregunta, póngase en contacto con nuestro servicio de atencion al cliente 0900 1111'); ?>
        </td>
      </tr>
    </table>
  </body>
</html>
