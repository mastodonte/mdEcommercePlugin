<?php // Mostramos el listado de mdEcommerce que tiene el carrito    ?>

<?php $cartItems = $cart->getMdCartProducts(); ?>
        
<div class="ecommerce-cart-info">
  <table>
    <thead>
      <tr>
        <td class="ecommerce-menu-tabla ecommerce-image"><?php echo __('mdEcommerce_Fotos producto'); ?></td>
        <td class="ecommerce-menu-tabla ecommerce-name"><?php echo __('mdEcommerce_Nombre producto'); ?></td>
        <td class="ecommerce-menu-tabla ecommerce-price"><?php echo __('mdEcommerce_Precio'); ?></td>
        <td class="ecommerce-menu-tabla ecommerce-quantity"><?php echo __('mdEcommerce_Cantidad'); ?></td>
        <td class="ecommerce-menu-tabla ecommerce-total"><?php echo __('mdEcommerce_Totales'); ?></td>
        <td class="ecommerce-menu-tabla ecommerce-remove">&nbsp;</td>
      </tr>
    </thead>
    <?php if ($cartItems): ?>
    <tbody>
      <?php foreach ($cartItems as $cartItem): ?>

        <?php $product = $cartItem->getEcProduct(); ?>

        <tr>
          <td class="ecommerce-image">
            <a href="<?php echo url_for('producto-show', $product); ?>">
              <img src="<?php echo $product->retrieveAvatar(array(mdWebOptions::WIDTH => 58, mdWebOptions::HEIGHT => 58, mdWebOptions::CODE => mdWebCodes::RESIZECROP)); ?>" />
            </a>
          </td>
          <td class="ecommerce-name"><a href="<?php echo url_for('producto-show', $product); ?>"><?php echo $product->getName(); ?></a></td>
          <td class="ecommerce-price"><span><?php echo $product->retrieveDisplayPrice(); ?></span></td>
          <td class="ecommerce-quantity">
            <input class="ecommerce-cart_quantity_input" size="3" name="<?php echo url_for('@mdCart-update') . '?product_id=' . $product->getId(); ?>" type="text" value="<?php echo $cartItem->getQuantity(); ?>"/>
          </td>
          <td class="ecommerce-total"><span class="ecommerce-cart_product_total"><?php echo $product->getDisplayTotal($cartItem->getQuantity()); ?></span></td>
          <td class="ecommerce-remove">
            <a class="ecommerce-cart_quantity_delete" href="<?php echo url_for('@mdCart-remove?product_id=' . $product->getId()); ?>">
              <img src="/mdEcommercePlugin/images/mdCart/delete.gif"/>
            </a>
          </td>
        </tr>

      <?php endforeach; ?>
    </tbody>

    <?php else: ?>

      <tr><td class="ecommerce-red-texto" colspan="5"><?php echo __('mdEcommerce_No hay productos agregados'); ?></td></tr>

    <?php endif; ?>

  </table>
</div>

<div class="ecommerce-cart-total">
  <table>
    <!--<tr>
      <td colspan="5"></td>
      <td class="ecommerce-right"><b><?php echo __('mdEcommerce_Subtotal'); ?>:</b></td>
      <td class="ecommerce-right  ecommerce-total"><?php echo $cart->getDisplaySubTotal(); ?></td>
    </tr>-->
    <!--<tr>
      <td colspan="5"></td>
      <td class="right"><b>IVA:</b></td>
      <td class="right  total">$210.00</td>
    </tr>-->
    <tr>
      <td colspan="5"></td>
      <td class="ecommerce-right"><b><?php echo __('mdEcommerce_Total'); ?>:</b></td>
      <td id="ecommerce-cart_order_total" class="ecommerce-right  ecommerce-total"><?php echo $cart->getDisplayTotal(); ?></td>
    </tr>
  </table>
</div>

<div class="ecommerce-buttons">
  <!--<div class="left"><a onclick="$('#basket').submit();" class="button larger"><span>Actualizar</span></a></div>-->
  <!--<div class="right"><a href="#" class="button larger"><span>Checkout</span></a></div>-->
  <div class="ecommerce-left"><a href="<?php echo url_for('@homepage'); ?>" class="ecommerce-button ecommerce-larger"><span><?php echo __('mdEcommerce_Continuar Comprando'); ?></span></a></div>
</div>

<?php $currency = mdCurrency::loadCurrency(); ?>
<script type="text/javascript">
  // <![CDATA[
  var _currencySign = '<?php echo $currency->getSign(); ?>';
  var _currencyRate = '<?php echo $currency->getConversionRate(); ?>';
  var _currencyFormat = '<?php echo $currency->getFormat(); ?>';
  var _currencyBlank = '<?php echo $currency->getBlank(); ?>';
  var _priceDisplayPrecision = '<?php echo $currency->getDecimals()*2; ?>'; //2 seria: $_PS_PRICE_DISPLAY_PRECISION_
  // ]]>
</script>
