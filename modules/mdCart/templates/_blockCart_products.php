<?php $cartItems = $cart->getMdCartProducts(); ?>

<?php if ($cartItems): ?>
  <table class="ecommerce-cart_table">
    <tbody>
      <?php foreach ($cartItems as $cartItem): ?>
        <?php $product = $cartItem->getEcProduct(); ?>

        <tr id="ecommerce-cart_block_product_<?php echo $product->getId(); ?>">
          <td class="ecommerce-image">
            <a href="<?php echo url_for('@homepage'); ?>">
              <img src="<?php echo $product->getAvatar()->getUrl(40, 40, 'resize', true); ?>"/>
            </a>
          </td>

          <td class="ecommerce-name">
            <a class="ecommerce-cart_block_product_name" href="<?php echo url_for('@homepage'); ?>" title="<?php echo $product->getName(); ?>">
              <?php echo truncate_text($product->getName(), 16); ?>
              <?php if(sfConfig::get('app_attributes_enable', false)): ?>
                <br />
                <span class="ecommerce-cart_block_attributes">
                  <?php $pks = sfConfig::get('app_attributes_primarykeys'); ?>
                  <?php foreach($pks as $primary_key): ?>
                    <?php $function = str_replace('Id', '', 'get' . Tools::wordCamelCase($primary_key, '_')); ?>
                    <?php echo ($primary_key == $pks[count($pks)-1] ? $cartItem->$function() : $cartItem->$function() . ' - '); ?>
                  <?php endforeach; ?>
                </span>
              <?php endif; ?>
            </a>
          </td>

          <td class="ecommerce-quantity">x&nbsp;<?php echo $cartItem->getQuantity(); ?></td>

          <td class="ecommerce-total"><?php echo $product->getDisplayTotal($cartItem->getQuantity()); ?></td>

          <td class="ecommerce-remove">
            <?php 
            if(sfConfig::get('app_attributes_enable', false)){
              $pks = sfConfig::get('app_attributes_primarykeys');
              $url = url_for('@mdCart-remove?product_id=' . $product->getId()) . '&'; 
              foreach($pks as $primary_key){
                $function = 'get' . Tools::wordCamelCase($primary_key, '_');
                $url.= $primary_key . ($primary_key == $pks[count($pks)-1] ? '=' . $cartItem->$function() : '=' . $cartItem->$function() . '&');
              }
            }else{
              $url = url_for('@mdCart-remove?product_id=' . $product->getId());            
            }
            ?>            
            
            <a rel="nofollow" class="ecommerce-ajax_cart_block_remove_link ecommerce-remove_link" href="<?php echo $url; ?>" title="<?php echo __('mdCart_eliminar producto de mi carrito'); ?>"></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
