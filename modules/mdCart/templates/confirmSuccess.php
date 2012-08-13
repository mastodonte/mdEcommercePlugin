<?php
/**
 * La pagina a la cual debe navegar luego del login o del registro es: @mdCart-checkout ( /mdcart/checkout )
 */
?>

<div class="section" id="page_content">
  <div id="content-login" class="container">

    <div class="checkout">

      <div id="checkout">
        <div class="checkout-heading">Paso 1: Authentificacion</div>

        <div class="checkout-content login-content" style="display:<?php echo ((!$sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">

          <?php if (!$sf_user->isAuthenticated()): ?>
            <div class="left">

              <?php include_component('mdUserManagementFrontend', 'basicRegisterForm'); ?>

            </div>

            <?php include_component('mdAuth', 'smallSigninAjax'); ?>
          <?php endif; ?>

        </div>
      </div>

      <!--<div id="payment-address">
        <div class="checkout-heading"><span>Paso 2: Cuenta y Detalle de Facturaci&oacute;n</span></div>
        <div class="checkout-content"></div>
      </div>-->

      <div id="shipping-address">
        <div class="checkout-heading">Paso 2: Detalles de Entrega</div>
        <div class="checkout-content" style="display:<?php echo (($sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">

          <?php if ($sf_user->isAuthenticated()): ?>

            <?php include_component('mdCartAddress', 'sendBlock'); ?>

          <?php endif; ?>

        </div>
      </div>

      <!--<div id="shipping-method">
        <div class="checkout-heading">Paso 4: Forma de Entrega</div>
        <div class="checkout-content"></div>
      </div>-->

      <div id="payment-method">
        <div class="checkout-heading">Paso 3: Forma de Pago</div>
        <div class="checkout-content" style="display:<?php echo (($sf_user->isAuthenticated()) ? 'block' : 'none'); ?>">
          <?php if ($sf_user->isAuthenticated()): ?>

            <?php include_component('mdCart', 'payMethods'); ?>
          
          <?php endif; ?>          
        </div>
      </div>

      <!--<div id="confirm">
        <div class="checkout-heading">Paso 6: Confirmaci&oacute;n de Orden</div>
        <div class="checkout-content"></div>
      </div>-->
    </div>
  </div>
</div>
