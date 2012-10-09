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
          <?php echo __('Brou_Su pedido está completo.'); ?>
        </td>
      </tr>      
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0;">
          <?php echo __('Brou_Por favor, hága su deposito por brou con la siguiente informacion:'); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0 0 10px 0;">
          <?php echo __('Brou_la suma de:'); ?>
          <span style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#D96A12; font-size:12px; font-weight:bold; padding-left:5px;">
            <?php echo $order->getDisplayTotal(); ?>
          </span>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0;">
          <?php echo __('Brou_cuenta en dolares:'); ?>
          <span style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#D96A12; font-size:12px; font-weight:bold; padding-left:5px;">
            <?php echo sfConfig::get('app_brou_dollar_account'); ?>
          </span>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0;">
          <?php echo __('Brou_cuenta en pesos:'); ?>
          <span style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#D96A12; font-size:12px; font-weight:bold; padding-left:5px;">
            <?php echo sfConfig::get('app_brou_pesos_account'); ?>
          </span>
        </td>
      </tr>      
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0;">
          <?php echo str_replace(
            '%link%', 
            '<a href="' . $link . '" style="color:#D96A12; text-decoration:underline;">link</a>',
            __('Brou_Una vez realizado el deposito ingresa al siguiente %link% para ingresar el codigo de confirmacion y terminar la compra.')
          ); ?>
        </td>
      </tr>
    </table>
  </body>
</html>
