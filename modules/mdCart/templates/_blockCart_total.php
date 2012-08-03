<?php $cartItems = $cart->getMdCartProducts(); ?>

<!--<span><?php //echo __('mdCart_shipping');  ?></span>
<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost"><?php //echo $shipping_cost;  ?></span>
<br/>-->

<table class="total">
  <tbody>
    <!-- <tr>
      <td align="right">
        <b>Sub-Total</b>
      </td>
      <td align="right">$1,000.00</td>
    </tr>
    <tr>
      <td align="right">
        <b>VAT 17.5%</b>
      </td>
      <td align="right">$175.00</td>
    </tr> -->
    
    <tr id="cart_block_no_products" <?php echo ($cartItems ? 'class="hidden"' : ''); ?>>
      <td align="right" colspan="2">
        <b><?php echo __('mdCart_sin productos'); ?></b>
      </td>
    </tr>
    
    <tr id="cart-prices">
      <td align="right">
        <b><?php echo __('mdCart_Total'); ?>:&nbsp;</b>
      </td>
      <td id="cart_block_total" class="price ajax_block_cart_total" align="right"><?php echo $cart->getDisplaySubTotal(); ?></td>
    </tr>
  </tbody>
</table>
