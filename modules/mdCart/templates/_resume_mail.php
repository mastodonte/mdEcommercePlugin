<?php $orderItems = $mdOrder->getMdOrderProducts(); ?>
<?php $mdShipping = $mdOrder->getShippingData(); ?>
<?php use_helper('Text'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo __('mdEcommerce_Title Mail'); ?></title>
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" style="width:800px; border:none; margin:10px;">
      <tr>
        <td style="padding:0 0 15px 0">
          <?php echo image_tag('/images/logo.png', array('absolute' => true, 'alt' => __('mdEcommerce_www.dominio.com.uy'))); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:5px 0;">
          <?php echo __('mdEcommerce_Gracias por comprar en'); ?>:&nbsp;
          <a href="http://<?php echo __('mdEcommerce_www.dominio.com.uy'); ?>" style="color:#D96A12; text-decoration:underline;"><?php echo __('mdEcommerce_www.dominio.com.uy'); ?></a>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:5px 0;">
          <?php echo __('mdEcommerce_Su número de orden es:'); ?> <strong><?php echo $mdOrder->getId(); ?></strong>
        </td>
      </tr>
      <tr>
        <td>
          <table cellpadding="0" cellspacing="0" style="border:5px solid #F7F7F7; margin:15px 0; width:790px;">
            <tr>
              <th style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:center; color:#4B4B4B; background:#F7F7F7;"><?php echo __('mdEcommerce_Fotos producto'); ?></th>
              <th style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:center; color:#4B4B4; background:#F7F7F7;"><?php echo __('mdEcommerce_Nombre producto'); ?></th>
              <th style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:center; color:#508484; background:#F7F7F7;"><?php echo __('mdEcommerce_Precio'); ?></th>
              <th style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:center; color:#4B4B4; background:#F7F7F7;"><?php echo __('mdEcommerce_Cantidad'); ?></th>
              <th style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:center; color:#4B4B4; background:#F7F7F7;"><?php echo __('mdEcommerce_Totales'); ?></th>
            </tr>
            <?php foreach ($orderItems as $orderItem): ?>
              <?php $product = $orderItem->getEcProduct(); ?>
              <?php $instance = mdMediaManager::getInstance(mdMediaManager::MIXED, $product)->load(); ?>
              <tr>
                <td style="padding:5px 0; text-align:center; border-bottom:3px solid #F7F7F7;">
                  <a href="<?php echo url_for('@producto-show?id=' . $product->getId() . '&slug=' . $product->getSlug(), true); ?>">
                    <?php echo image_tag($instance->getAvatarUrl(NULL, array(mdWebOptions::WIDTH => '58', mdWebOptions::HEIGHT => '58', mdWebOptions::CODE => mdWebCodes::CROPRESIZE)), array('absolute' => true, 'size' => '58x58')); ?>
                  </a>
                </td>
                <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:center; color:#4B4B4; padding:5px 0; border-bottom:3px solid #F7F7F7;">
                  <a href="<?php echo url_for('@producto-show?id=' . $product->getId() . '&slug=' . $product->getSlug(), true); ?>">
                    <?php echo truncate_text($orderItem->getItemName(), 36); ?>
                  </a>
                </td>
                <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:center; color:#4B4B4; padding:5px 0; border-bottom:3px solid #F7F7F7;">
                  <?php echo $orderItem->getDisplayPrice(); ?>
                </td>
                <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:center; color:#4B4B4; padding:5px 0; border-bottom:3px solid #F7F7F7;">
                  <?php echo $orderItem->getItemQuantity(); ?>
                </td>
                <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:center; color:#4B4B4; padding:5px 0; border-bottom:3px solid #F7F7F7;">
                  <?php echo $orderItem->getDisplayTotal($orderItem->getItemQuantity()); ?>
                </td>
              </tr>            
            <?php endforeach; ?>
            <tr>
              <td colspan="3" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:right; color:#4B4B4; padding:10px 10px 10px 0;">&nbsp;</td>              
              <td colspan="1" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:right; color:#4B4B4; padding:10px 10px 10px 0;">
                <?php echo __('mdEcommerce_Costo de envio'); ?>:
              </td>
              <td colspan="1" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:right; color:#4B4B4; padding:10px 10px 10px 0;">
                <strong><?php echo $mdOrder->getDisplayTotalShipping(); ?></strong>
              </td>
            </tr>
            <tr>
              <td colspan="3" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:12px; text-align:right; color:#4B4B4; padding:10px 10px 10px 0;">&nbsp;</td>              
              <td colspan="1" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:right; color:#4B4B4; padding:5px 10px 10px 0; font-weight:bold;">
                <?php echo __('mdEcommerce_Total'); ?>:
              </td>
              <td colspan="1" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14px; text-align:right; color:#4B4B4; padding:5px 10px 10px 0; font-weight:bold;">
                <?php echo $mdOrder->getDisplayTotal(); ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0 5px 0;">
          <strong><?php echo __('mdEcommerce_Donde se entrega'); ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0 0 2px 0;">
          <span style="color:#508484;"><?php echo $mdShipping->getFirstname() . ' ' . $mdShipping->getLastname(); ?></span>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <?php echo $mdShipping->getAddress(); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <?php echo $mdShipping->getCity(); ?><?php echo ($mdShipping->getPostcode() != '' ? ', ' . $mdShipping->getPostcode() : ''); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 0 0;">
          <?php echo format_country($mdShipping->getCountryCode()); ?>
        </td>
      </tr>
      <tr>
        <td style="padding:15px 0 0 0;">
          <p  style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; margin:0 0 3px 0;">
            <?php echo __('mdEcommerce_Texto Informativo'); ?>
          </p>
        </td>
      </tr>
      <tr>
        <td style="padding:15px 0 5px 0; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px;">
          <?php echo __('mdEcommerce_Ante cualquier consulta no dude en contactarnos en el Servicio de atención al cliente'); ?>
        </td>
      </tr>
      <tr>
        <td style="padding:0; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0 0 5px 0">
          <?php echo __('mdEcommerce_Telefono o Email'); ?> | <a href="mailto:<?php echo __('mdEcommerce_info@dominio.com.uy'); ?>" style="color:#D96A12; text-decoration:underline;"><?php echo __('mdEcommerce_info@dominio.com.uy'); ?></a>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:15px 0 5px 0;">
          <strong><?php echo __('mdEcommerce_Datos de la empresa'); ?></strong>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:0x 0 2px 0;">
          <?php echo __('mdEcommerce_Pablo de Maria 1468 - C.P 11200'); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <?php echo __('mdEcommerce_Tel. 2409 5538 Cel. 095 530 680'); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <?php echo __('mdEcommerce_Montevideo - Uruguay'); ?>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <a href="mailto:<?php echo __('mdEcommerce_info@dominio.com.uy'); ?>" style="color:#D96A12; text-decoration:underline;">
            <?php echo __('mdEcommerce_info@dominio.com.uy'); ?>
          </a>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:12px; padding:2px 0 2px 0;">
          <a href="http://<?php echo __('mdEcommerce_www.dominio.com.uy'); ?>" style="color:#D96A12; text-decoration:underline;">
            <?php echo __('mdEcommerce_www.dominio.com.uy'); ?>
          </a>
        </td>
      </tr>
      <tr>
        <td style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; text-align:left; color:#4B4B4B; font-size:10px; padding:15px 0 5px 0;">
          <?php echo __('mdEcommerce_Texto Informativo Footer'); ?>
        </td>
      </tr>
    </table>
  </body>
</html>
