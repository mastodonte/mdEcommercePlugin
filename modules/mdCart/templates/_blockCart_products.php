<?php $cartItems = $cart->getMdCartProducts(); ?>

<?php if ($cartItems): ?>
  <table class="ecommerce-cart_table">
    <tbody>
      <?php foreach ($cartItems as $cartItem): ?>
        <?php $product = $cartItem->getEcProduct(); ?>

        <tr id="ecommerce-cart_block_product_<?php echo $product->getId(); ?>">
          <td class="ecommerce-image">
            <a href="product.html">
              <?php include_partial('productos/avatar', array('producto' => $product, 'width' => 40, 'height' => 40, 'code' => mdWebCodes::CROPRESIZE)); ?>
            </a>
          </td>

          <td class="ecommerce-name">
            <a class="ecommerce-cart_block_product_name" href="<?php echo url_for('@homepage'); ?>" title="<?php echo $product->getName(); ?>">
              &nbsp;<?php echo truncate_text($product->getName(), 16); ?>
            </a>
          </td>

          <td class="ecommerce-quantity">x&nbsp;<?php echo $cartItem->getQuantity(); ?></td>

          <td class="ecommerce-total"><?php echo $product->getDisplayTotal($cartItem->getQuantity()); ?></td>

          <td class="ecommerce-remove">
            <a rel="nofollow" class="ecommerce-ajax_cart_block_remove_link ecommerce-remove_link" href="<?php echo url_for('@mdCart-remove') . '?product_id=' . $product->getId(); ?>" title="<?php echo __('mdCart_eliminar producto de mi carrito'); ?>"></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
