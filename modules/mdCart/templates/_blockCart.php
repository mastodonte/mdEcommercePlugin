<?php use_helper('Text'); ?>

<?php $colapseExpandStatus = $sf_user->getAttribute('display', 'expanded', 'mdCart'); ?>

<?php if(is_null($cart)): ?>

<!-- MODULE Block cart -->
<div id="ecommerce-cart_block" class="block exclusive">
  
  <h4>
    <a href="<?php echo url_for('@mdCart-cart'); ?>"><?php echo ucfirst(__('mdCart_Carrito')); ?></a>
    
    <span id="ecommerce-block_cart_expand" <?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? '' : 'class="ecommerce-hidden"'); ?>>&nbsp;</span>
    <span id="ecommerce-block_cart_collapse" <?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'collapsed' ? '' : 'class="ecommerce-hidden"'); ?>>&nbsp;</span>
  </h4>
  
  <div class="ecommerce-block_content">
    <!-- block summary -->
    <div class="ecommerce-collapsed" id="ecommerce-cart_block_summary">
      <span style="display: none;" class="ecommerce-ajax_cart_quantity">0</span>
      <span style="display:none" class="ecommerce-ajax_cart_product_txt"></span>
      <span style="display: none;" class="ecommerce-ajax_cart_total">0,00</span>
      <span class="ecommerce-ajax_cart_no_product" style="display: inline-block;">(<?php echo __('mdCart_vacio'); ?>)</span>
    </div>
    
    <!-- block list of products -->
    <div class="ecommerce-expanded" id="ecommerce-cart_block_list">
      <p id="ecommerce-cart_block_no_products" style="opacity: 1; display: block;"><?php echo __('mdCart_sin productos'); ?></p>

      <p id="ecommerce-cart-prices">
        <span><?php echo __('mdCart_Total'); ?></span>
        <span class="ecommerce-price ecommerce-ajax_block_cart_total" id="ecommerce-cart_block_total">0,00</span>
      </p>
    </div>
  </div>

</div>
<!-- /MODULE Block cart -->

<?php else: ?>

<!-- MODULE Block cart -->
<div id="ecommerce-cart_block" class="ecommerce-block exclusive">
  
  <h4>
    <a href="<?php echo url_for('@mdCart-cart'); ?>"><?php echo ucfirst(__('mdCart_Carrito')); ?></a>
    
    <span id="ecommerce-block_cart_expand" <?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? 'class="ecommerce-hidden"' : ''); ?>>&nbsp;</span>
    <span id="ecommerce-block_cart_collapse" <?php echo ((isset($colapseExpandStatus) && $colapseExpandStatus == 'collapsed') ? 'class="ecommerce-hidden"' : '' ); ?>>&nbsp;</span>
  </h4>
  
  <div class="ecommerce-block_content">
    
    <!-- block summary -->
    <div id="ecommerce-cart_block_summary" class="<?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? 'ecommerce-collapsed' : 'ecommerce-expanded') ?>">
      
      <span class="ecommerce-ajax_cart_quantity" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
        <?php echo $cart->getQuantity(); ?>
      </span>
      <span class="ecommerce-ajax_cart_product_txt" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
        <?php echo format_number_choice('(-Inf,1]' . __('mdCart_producto') . '|(1,+Inf]' . __('mdCart_productos'), array(), $cart->getQuantity() ); ?>
      </span>
      <span class="ecommerce-ajax_cart_total" style="display:<?php echo (($cart->getQuantity() <= 0) ? 'none' : 'inline'); ?>">
        <?php echo $cart->getDisplayTotal(); ?>
      </span>
      <span class="ecommerce-ajax_cart_no_product" style="display:<?php echo (($cart->getQuantity() > 0) ? 'none' : 'inline'); ?>">
        <?php echo __('mdCart_vacio'); ?>
      </span>
      
    </div>
    
    <!-- block list of products -->
    <div id="ecommerce-cart_block_list" class="<?php echo (isset($colapseExpandStatus) && $colapseExpandStatus == 'expanded' || !isset($colapseExpandStatus) ? 'ecommerce-expanded' : 'ecommerce-collapsed') ?>">
      
      <?php $cartItems = $cart->getMdCartProducts(); ?>
      <?php if($cartItems): ?>
        <dl class="ecommerce-products">
          <?php foreach($cartItems as $cartItem): ?>
              
              <?php $product = $cartItem->getEcProduct(); ?>
          
              <dt id="ecommerce-cart_block_product_<?php echo $product->getId(); ?>" class="<?php
                if($firstItem){
                  echo 'first_item';
                }elseif ($lastItem) {
                  echo 'last_item';
                }else{
                  echo 'item';
                } ?>">
                
                <span class="ecommerce-quantity-formated">
                  <span class="ecommerce-quantity"><?php echo $cartItem->getQuantity(); ?></span> x
                </span>                
                <a class="ecommerce-cart_block_product_name" href="<?php echo url_for('@homepage'); ?>" title="<?php echo $product->getName(); ?>">
                  &nbsp;<?php echo truncate_text($product->getName(), 16); ?>
                </a>                
                <span class="ecommerce-remove_link"><a rel="nofollow" class="ecommerce-ajax_cart_block_remove_link" href="<?php echo url_for('@mdCart-remove') . '?product_id=' . $product->getId(); ?>" title="<?php echo __('mdCart_eliminar producto de mi carrito'); ?>">&nbsp;</a></span>
                <span class="ecommerce-price"><?php echo $product->getDisplayTotal($cartItem->getQuantity()); ?></span>                
              </dt>

          <?php endforeach; ?>
        </dl>
      <?php endif; ?>
      
      <p id="ecommerce-cart_block_no_products" <?php echo ($cartItems ? 'class="ecommerce-hidden"' : ''); ?>><?php echo __('mdCart_sin productos'); ?></p>      
                
      <p id="ecommerce-cart-prices">
        <!--<span><?php //echo __('mdCart_shipping'); ?></span>
        <span id="ecommerce-cart_block_shipping_cost" class="price ajax_cart_shipping_cost"><?php //echo $shipping_cost; ?></span>
        <br/>-->
        <span><?php echo __('mdCart_Total'); ?></span>
        <span id="ecommerce-cart_block_total" class="ecommerce-price ecommerce-ajax_block_cart_total"><?php echo $cart->getDisplaySubTotal(); ?></span>
      </p>
      
      <p id="ecommerce-cart-buttons">
	<a href="<?php echo url_for('@mdCart-cart'); ?>" class="ecommerce-button_small" title=""><?php echo __('mdCart_Carrito'); ?></a>
        <a href="<?php echo url_for('@mdCart-checkout'); ?>" id="ecommerce-button_order_cart" class="ecommerce-exclusive" title=""><?php echo __('mdCart_Check out'); ?></a>
      </p>
      
    </div>
  </div>
</div>
<!-- /MODULE Block cart -->

<?php endif; ?>


<?php
/*
  if $priceDisplay == 1}{
    convertPrice price=$cart->getOrderTotal(false)
  }
  { else }
  {
    convertPrice price=$cart->getOrderTotal(true)
  }
  {/if}

  LINK BORRAR: {$link->getPageLink('cart.php')}?delete&amp;id_product={$product.id_product}&amp;ipa={$product.id_product_attribute}&amp;token={$static_token}

  DESCUENTOS
 {if $discounts|@count > 0}
  <table id="vouchers">         
    <tbody>
    {foreach from=$discounts item=discount}
      <tr class="bloc_cart_voucher" id="bloc_cart_voucher_{$discount.id_discount}">
        <td class="name" title="{$discount.description}">{$discount.name|cat:' : '|cat:$discount.description|truncate:18:'...'|escape:'htmlall':'UTF-8'}</td>
        <td class="price">-{if $discount.value_real != '!'}{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}{/if}</td>
        <td class="delete"><a href="{$link->getPageLink("$order_process.php", true)}?deleteDiscount={$discount.id_discount}" title="{l s='Delete'}"><img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" width="11" height="13" class="icon" /></a></td>
      </tr>
    {/foreach}
    </tbody>
  </table>
{/if}

TAX
{if $show_tax && isset($tax_cost)}
  <span>{l s='Tax' mod='blockcart'}</span>
  <span id="ecommerce-cart_block_tax_cost" class="price ajax_cart_tax_cost">{$tax_cost}</span>
  <br/>
{/if}

MENSAJE IVA
{if $use_taxes && $display_tax_label == 1 && $show_tax}
{if $priceDisplay == 0}
<p id="ecommerce-cart-price-precisions">
  {l s='Prices are tax included' mod='blockcart'}
</p>
{/if}

  {if $priceDisplay == 1}
  <p id="ecommerce-cart-price-precisions">
    {l s='Prices are tax excluded' mod='blockcart'}
  </p>
  {/if}
{/if} 

BOTON LARGE
{if $order_process == 'order-opc'}_large{/if}
 */