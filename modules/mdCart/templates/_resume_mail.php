<?php $orderItems = $mdOrder->getMdOrderProducts(); ?>
<?php $mdShipping = $mdOrder->getShippingData(); ?>
<?php use_helper('Text'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo __('Mail_Title SuperVentas'); ?></title>
  </head>
  <body>
    <div class="email">
      <?php echo image_tag('/images/site/logo.jpg', array('absolute' => true, 'size' => '294x59', 'alt' => 'top')); ?>

      <h5><?php echo __('Mail_Gracias por comprar en SuperVentas.com.uy'); ?></h5>

      <span class="negrita"><?php echo __('Mail_Su número de orden es:'); ?></span><span class="verde"><?php echo $mdOrder->getId(); ?></span>

      <div class="carrito-tabla">
        <table cellspacing="0" collspan="0" class="tablacarrito">
          <tbody>
            <tr>
              <td class="menu-tabla"><?php echo __('Mail_Fotos producto'); ?></td>
              <td class="menu-tabla"><?php echo __('Mail_Nombre producto'); ?></td>
              <td class="menu-tabla"><?php echo __('Mail_Precio'); ?></td>
              <td class="menu-tabla"><?php echo __('Mail_Cantidad'); ?></td>
              <td colspan="2" class="menu-tabla"><?php echo __('Mail_Totales'); ?></td>
            </tr>
            <?php foreach($orderItems as $orderItem): ?>
            <?php $product = $orderItem->getEcProduct(); ?>
            <?php $instance = mdMediaManager::getInstance(mdMediaManager::MIXED, $product)->load(); ?>
            <tr>
              <td>
                <?php echo image_tag($instance->getAvatarUrl(NULL, array(mdWebOptions::WIDTH => '58', mdWebOptions::HEIGHT => '58', mdWebOptions::CODE => mdWebCodes::CROPRESIZE)), array('absolute' => true, 'size' => '58x58')); ?>
              </td>
              <td class="blue-texto"><a href="<?php echo url_for('@producto-show?id=' . $product->getId() . '&slug=' . $product->getSlug(), true); ?>"><?php echo truncate_text($orderItem->getItemName(), 36); ?></a></td>
              <td class="blue-texto"><span><?php echo $orderItem->getDisplayPrice(); ?></span></td>
              <td><span><?php echo $orderItem->getItemQuantity(); ?></span></td>
              <td class="blue-texto"><span><?php echo $orderItem->getDisplayTotal($orderItem->getItemQuantity()); ?></span></td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <td class="sin-bg">&nbsp;</td>
              <td colspan="2" class="sin-bg">&nbsp;</td>
              <td><?php echo __('Mail_Costo de envio'); ?></td>
              <td class="red-texto"><?php echo $mdOrder->getDisplayTotalShipping(); ?></td>
            </tr>
            <tr>
              <td class="sin-bg">&nbsp;</td>
              <td colspan="2" class="sin-bg">&nbsp;</td>
              <td><?php echo __('Mail_Total:'); ?></td>
              <td class="red-texto"><?php echo $mdOrder->getDisplayTotal(); ?></td>
            </tr>
            <tr>
              <td class="sin-bg">&nbsp;</td>
              <td colspan="2" class="sin-bg">&nbsp;</td>
            </tr>
          </tbody>
        </table>
      </div>
      <hr/>
      <h5><?php echo __('Mail_Donde se entrega:'); ?></h5>
      <p><strong><?php echo $mdShipping->getFirstname() . ' ' . $mdShipping->getLastname(); ?></strong></p>
      <p><?php echo $mdShipping->getAddress(); ?></p>
      <p><?php echo $mdShipping->getCity(); ?><?php echo ($mdShipping->getPostcode() != '' ? ', ' . $mdShipping->getPostcode() : ''); ?></p>
      <p><?php echo format_country($mdShipping->getCountryCode()); ?></p>
      <hr/>
      <span class="span-exitosa">
        <?php echo __('Mail_Ténga en cuenta este numero cuando nos contacte para buscar su orden fácilmente.<br />Ante cualquier eventualidad un representante Super Ventas se pondrá en contacto telefónicamente o email.<br />Si pagó con tarjeta de crédito usted verá un cargo de en su resumen mensual de Nalfer S.A. o de Superventas.com.uy'); ?>
      </span>
      <br />
      <span class="negrita"><?php echo __('Mail_Ante cualquier consulta no dude en contactarnos en el Servicio de atención al cliente'); ?></span><br />
      <p><?php echo __('Mail_TEL: +598 2409 55 38 o info@superventas.com.uy'); ?></p>
      <hr/>
      <p class="address">
        <?php echo __('Contacto_Mail_Pablo de Maria 1468 - C.P 11200'); ?><br/>
        <?php echo __('Contacto_Mail_Tel. 2409 5538 Cel.  095 530 680'); ?><br/>
        <?php echo __('Contacto_Mail_Montevideo - Uruguay'); ?><br />
        <span class="style1"><a href="mailto:<?php echo __('Contacto_Mail_info@superventas.com.uy'); ?>"><?php echo __('Contacto_Mail_info@superventas.com.uy'); ?></a><br />
          <a href="http://<?php echo __('Contacto_Mail_www.SuperVentas.com.uy'); ?>"><?php echo __('Contacto_Mail_www.SuperVentas.com.uy'); ?></a>
        </span><br/>
      </p>
      <p class="mail">
        <?php echo __('Contacto_Mail_El texto de este correo electrónico está dirigido exclusivamente al destinatario que figura en el mismo. Se advierte que puede contener información de carácter reservada, secreta o confidencial, así como datos de carácter personal. Por tanto, su utilización o divulgación sólo está permitida a las personas autorizadas. El contenido está alcanzado y regulado por la normativa de la República Oriental del Uruguay respecto a la Protección de los Datos Personales, en particular por la Ley No. 18.331 de 11-08-08, sus decretos reglamentarios No. 664/008 de 22-12-08 y No. 414/09 de 31-08-09, y por la restante que se sancione con posterioridad sobre el tema. Si el mensaje no está destinado a usted y lo ha recibido por error o por otras circunstancias, deberá abstenerse de leer, reproducir o difundir el contenido del mismo en forma alguna ni bajo ningún concepto. Le solicitamos además que lo comunique en forma inmediata por este medio al remitente y que lo elimine de manera segura e irrecuperable'); ?>
      </p>
    </div>
  </body>
</html>
