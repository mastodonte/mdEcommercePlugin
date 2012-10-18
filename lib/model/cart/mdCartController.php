<?php

class mdCartController {

  private static $instance = NULL;

  private static $product_active = NULL;
  
  private function __construct() {
    
  }

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new mdCartController();
    }
    return self::$instance;
  }

  public function init($md_cart_id = NULL) {

    $currency = mdCurrency::loadCurrency(); // Objeto mdCurrency
    $lang = mdLanguage::getLanguage();      // Simbolo de lenguaje: es, en, pt

    $cookie_cart_id = sfContext::getInstance()->getRequest()->getCookie(mdCart::COOKIE_CART_NAME);

    if (!is_null($md_cart_id) && $cookie_cart_id != $md_cart_id)
      $cookie_cart_id = (int) $md_cart_id;

    if ((int) $cookie_cart_id) {

      $cart = Doctrine::getTable('mdCart')->find((int) $cookie_cart_id);

      if (!$cart)
        return NULL;

      if ($cart->orderExists()) { // Si ya tiene la orden efectuada => eliminamos carrito
        
        sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));

        return NULL;
  
      } elseif(sfContext::getInstance()->getUser()->isAuthenticated() && !is_null($cart->getCustomerId()) && $cart->getCustomerId() != sfContext::getInstance()->getUser()->getMdUserId()) {

        sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));

        return NULL;
        
      }
      
      if ($lang != $cart->getLang() || $currency->getId() != $cart->getCurrencyId()) {

        $cart->setLang($lang);
        $cart->setCurrencyId($currency);
        $cart->save();

      }
      
      if(sfContext::getInstance()->getUser()->isAuthenticated() && is_null($cart->getCustomerId())) {
        $cart->setCustomerId(sfContext::getInstance()->getUser()->getMdUserId());
        $cart->save();
      }

      /* Select an address if not set */
      if (sfContext::getInstance()->getUser()->isAuthenticated() && is_null($cart->getAddressDeliveryId()) && sfConfig::get('app_mdCart_autodetectaddress')) {
        $mdAddress = Doctrine::getTable('mdAddress')->findAddressesDelivery(sfContext::getInstance()->getUser()->getMdUserId(), true);
        if ($mdAddress) {
          $cart->setAddressDeliveryId($mdAddress->getId());
          $cart->save();
        }
      }

      return $cart;
    }

    return NULL;
  }

  public function add(sfWebRequest $request) {
    $product_id = $request->getParameter('product_id');
    $quantity = $request->getParameter('quantity');    
    
    if(sfConfig::get('app_attributes_enable', false)){
      $attributes_values = array();
      foreach(sfConfig::get('app_attributes_primarykeys') as $primary_key){
        $attributes_values[$primary_key] = $request->getParameter($primary_key);
      }
    }
    
    $cart = $this->init();

    // Update the cart ONLY if $this->cookies are available, in order to avoid ghost carts created by bots TODO
    //if (isset($_COOKIE[self::$cookie->getName()])) {}
    // Obtener producto en $product y validarlo: Existe y es ACTIVO sino EXCEPTION: Product is no longer available
    $product = Doctrine::getTable('ecProduct')->find($product_id);
    if (!$product || !$product->getActive())
      throw new Exception('Product is no longer available');

    self::$product_active = $product;
    
    // Validar cantidad para ese producto: $quantity > 0
    if ((int) $quantity > 0 && is_numeric($quantity)) {

      // Asociamos el producto con el carrito con la cantidad $quantity sino existia en el carrito lo creamos      
      if (is_null($cart)) {

        $cart = $this->create();
      }

      if(sfConfig::get('app_attributes_enable', false)){
        $cartItem = Doctrine::getTable('mdCartProducts')->findByPrimaryKey($cart->getId(), $product_id, $attributes_values);
      }else{
        $cartItem = Doctrine::getTable('mdCartProducts')->find(array($cart->getId(), $product_id));
      }

      if (!$cartItem) {

        $cartItem = new mdCartProducts();
        $cartItem->setMdCartId($cart->getId());
        $cartItem->setEcProductId($product_id);
        
        if(sfConfig::get('app_attributes_enable', false)){
          foreach($attributes_values as $key => $value){
            $function = 'set' . Tools::wordCamelCase($key, '_');
            $cartItem->$function($value);
          }
        }

      } else {

        $quantity = $quantity + $cartItem->getQuantity();
        
      }

      $cartItem->setQuantity($quantity);

      // !$in_stock sino valida: There is not enough product in stock
      if (!$product->isInStock($quantity))
        throw new Exception('There is not enough product in stock');

      $cartItem->save();
    }else {

      throw new Exception('Invalid quantity');
    }

    return $cart;
  }
  
  public function update(sfWebRequest $request) {
    $product_id = $request->getParameter('product_id');
    $quantity = $request->getParameter('quantity');
    
    if(sfConfig::get('app_attributes_enable', false)){
      $attributes_values = array();
      foreach(sfConfig::get('app_attributes_primarykeys') as $primary_key){
        $attributes_values[$primary_key] = $request->getParameter($primary_key);
      }
    }
    
    $cart = $this->init();

    // Update the cart ONLY if $this->cookies are available, in order to avoid ghost carts created by bots TODO
    //if (isset($_COOKIE[self::$cookie->getName()])) {}
    // Obtener producto en $product y validarlo: Existe y es ACTIVO sino EXCEPTION: Product is no longer available
    $product = Doctrine::getTable('ecProduct')->find($product_id);
    if (!$product || !$product->getActive())
      throw new Exception('Product is no longer available');

    self::$product_active = $product;
    
    // Validar cantidad para ese producto: $quantity > 0
    if ((int) $quantity > 0 && is_numeric($quantity)) {

      // Asociamos el producto con el carrito con la cantidad $quantity sino existia en el carrito lo creamos      
      if (is_null($cart)) {
        $cart = $this->create();
      }

      if(sfConfig::get('app_attributes_enable', false)){
        $cartItem = Doctrine::getTable('mdCartProducts')->findByPrimaryKey($cart->getId(), $product_id, $attributes_values);
      }else{
        $cartItem = Doctrine::getTable('mdCartProducts')->find(array($cart->getId(), $product_id));
      }

      if (!$cartItem) {
        
        $cartItem = new mdCartProducts();
        $cartItem->setMdCartId($cart->getId());
        $cartItem->setEcProductId($product_id);
        
        if(sfConfig::get('app_attributes_enable', false)){
          foreach($attributes_values as $key => $value){
            $function = 'set' . Tools::wordCamelCase($key, '_');
            $cartItem->$function($value);
          }
        }        
        
      }

      $cartItem->setQuantity($quantity);

      // !$in_stock sino valida: There is not enough product in stock
      if (!$product->isInStock($quantity))
        throw new Exception('There is not enough product in stock');

      $cartItem->save();
    }else {

      throw new Exception('Invalid quantity');
    }

    return $cart;
  }  

  public function remove(sfWebRequest $request) {
    $product_id = $request->getParameter('product_id');
    
    if(sfConfig::get('app_attributes_enable', false)){
      $attributes_values = array();
      foreach(sfConfig::get('app_attributes_primarykeys') as $primary_key){
        $attributes_values[$primary_key] = $request->getParameter($primary_key);
      }
    }
    
    $cart = $this->init();

    // Update the cart ONLY if $this->cookies are available, in order to avoid ghost carts created by bots
    //if (isset($_COOKIE[self::$cookie->getName()])) {}
    // Obtener producto en $product y validarlo: Existe sino existe return;
    $product = Doctrine::getTable('ecProduct')->find($product_id);
    if (!$product || !$product->getActive())
      throw new Exception('Product is no longer available');

    self::$product_active = $product;

    // Si no hay carrito return;
    if (is_null($cart))
      return NULL;

    // Eliminar producto del carrito
    if(sfConfig::get('app_attributes_enable', false)){
      $cartItem = Doctrine::getTable('mdCartProducts')->findByPrimaryKey($cart->getId(), $product_id, $attributes_values);
    }else{
      $cartItem = Doctrine::getTable('mdCartProducts')->find(array($cart->getId(), $product_id));
    }

    if ($cartItem) {
      $cartItem->delete();
    }

    // Si el carrito no tiene mas producto carrier_id = 0 save(); TODO

    return $cart;
  }

  public function clear() {
    $cart = $this->init();

    // Si no hay carrito return;
    if (is_null($cart))
      return NULL;

    $cartItems = $cart->getMdCartProducts();

    foreach ($cartItems as $cartItem) {
      $cartItem->delete();
    }

    return $cart;
  }

  public function create() {
    $currency = mdCurrency::loadCurrency(); // Objeto mdCurrency
    $lang = mdLanguage::getLanguage();      // Simbolo de lenguaje: es, en, pt

    $cart = new mdCart();
    $cart->setLang($lang);
    $cart->setCurrencyId($currency->getId());
    $cart->save();

    sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, $cart->getId(), time() + (15 * 24 * 3600));

    return $cart;
  }

  public function run($method, sfWebRequest $request) {
    if ($request->getParameter('ajax') == 'true') {
      try {

        $cart = call_user_func_array(array(&$this, $method), array($request));

        sfContext::getInstance()->getConfiguration()->loadHelpers('Partial');
        
        $stats = array('total' => $cart->getDisplayTotal(),
                       'productTotal' => $cart->getDisplaySubTotal(),
                       'discounts' => 0,
                       'shippingCost' => $cart->getDisplayTotalShipping(),
                       'taxCost' => 0,
                       'nbTotalProducts' => $cart->getQuantity(),
                       'product' => array(
                                      'id'    => self::$product_active->getId(),
                                      'price' => self::$product_active->retrievePrice()
                            ));
        
        return mdBasicFunction::basic_json_response(true, array( 'products' => get_component('mdCart', 'blockCart', array('md_cart_id' => $cart->getId())), 'summary' => $stats ));
        
      } catch (Exception $e) {

        return mdBasicFunction::basic_json_response(false, array('message' => $e->getMessage()));
      }
    } else {
      // Recargarmos la pagina
      header('location: ' . $request->getUri());
    }
  }

  public function updateAddress($mdAddress) {
    $cart = $this->init();

    if ($mdAddress && $mdAddress->getCustomerId() == $cart->getCustomerId()) 
    {
      $cart->setAddressDeliveryId($mdAddress->getId());
      $cart->save();
      
      sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'mdCart.updateAddress', array('mdAddress' => $mdAddress, 'cart' => $cart)));
    }
    else
    {
      sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));
      return NULL;
    }
  }
  
  /**
   * Validate an order in database
   */
  public function validate($module_label, $order_status_id) {
    $cart = $this->init();
    if ($cart && !$cart->orderExists()) {
      //$mdAddress = Doctrine::getTable('mdAddress')->find($cart->getAddressDeliveryId());

      // Copying data from cart
      $mdOrder = new mdOrder();
      $mdOrder->setMdCartId($cart->getId());
      $mdOrder->setCarrierId($cart->getCarrierId());
      $mdOrder->setCurrencyId($cart->getCurrencyId());
      $mdOrder->setCustomerId($cart->getCustomerId());
      $mdOrder->setAddressDeliveryId($cart->getAddressDeliveryId());
      $mdOrder->setLang($cart->getLang());
      $mdOrder->setModulePayment($module_label);
      $mdOrder->setTotalProducts($cart->getSubTotal());
      $mdOrder->setTotalShipping($cart->getTotalShipping());
      //if($mdAddress)
        //$mdOrder->setDeliveryDate($mdAddress->getDate());
      $mdOrder->save();

      sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'mdCart.validate', array('mdOrder' => $mdOrder)));

      $cartItems = $cart->getMdCartProducts();

      if ($cartItems) 
      {
        foreach ($cartItems as $cartItem) 
        {
          $product = $cartItem->getEcProduct();

          // Actualizar Stock TODO: analizar en prestashop
          $productQuantity = (int) $product->getQuantity();
          $quantityInStock = $productQuantity - (int) (($cartItem->getQuantity() < 0) ? $productQuantity : $cartItem->getQuantity());
          $product->setQuantity($quantityInStock);
          $product->save();
          if ($quantityInStock < 0)
            $outOfStock = true;

          // Aplicar descuento y tax TODO: Ver esto cuando se manejen descuentos y tax
          //$quantityDiscount = SpecificPrice::getQuantityDiscount((int) $product['id_product'], Shop::getCurrentShop(), (int) $cart->id_currency, (int) $vat_address->id_country, (int) $customer->id_default_group, (int) $product['cart_quantity']);
          //$unitPrice = Product::getPriceStatic((int) $product['id_product'], true, ($product['id_product_attribute'] ? intval($product['id_product_attribute']) : NULL), 2, NULL, false, true, 1, false, (int) $order->id_customer, NULL, (int) $order->{Configuration::get('PS_TAX_ADDRESS_TYPE')});
          //$quantityDiscountValue = $quantityDiscount ? ((Product::getTaxCalculationMethod((int) $order->id_customer) == PS_TAX_EXC ? Tools::ps_round($unitPrice, 2) : $unitPrice) - $quantityDiscount['price'] * (1 + $tax_rate / 100)) : 0.00;

          // Copy Products
          $mdOrderDetail = new mdOrderDetail();
          $mdOrderDetail->setMdOrderId($mdOrder->getId());
          $mdOrderDetail->setItemId($product->getId());
          $mdOrderDetail->setItemName($product->getName());
          $mdOrderDetail->setItemQuantity($cartItem->getQuantity());
          $mdOrderDetail->setItemPrice($product->retrievePrice());
          $mdOrderDetail->setItemWeight($product->getWeight());
          
          if(sfConfig::get('app_attributes_enable', false)){
            $pks = sfConfig::get('app_attributes_primarykeys');
            foreach($pks as $key){
              $set = 'set' . Tools::wordCamelCase($key, '_');
              $get = 'get' . Tools::wordCamelCase($key, '_');
              $mdOrderDetail->$set($cartItem->$get());
            }
          }
          
          $mdOrderDetail->save();
          
          // Save Stats about best sales
          $mdProductSale = $product->getMdProductSale();
          if(!$mdProductSale)
          {
            $mdProductSale = new mdProductSale();
            $mdProductSale->setProductId($product->getId());
          }
          $mdProductSale->setQuantity( ((int) $mdProductSale->getQuantity() + (int) (($cartItem->getQuantity() < 0) ? 0 : $cartItem->getQuantity())) );
          $mdProductSale->setSaleNbr( ((int) $mdProductSale->getSaleNbr() + 1) );
          $mdProductSale->save();
        }

        /*if (isset($outOfStock) && $outOfStock && Configuration::get('PS_STOCK_MANAGEMENT')) {
          $history = new OrderHistory();
          $history->id_order = (int) $order->id;
          $history->changeIdOrderState(Configuration::get('PS_OS_OUTOFSTOCK'), (int) $order->id);
          $history->addWithemail();
        }*/

        // Set order state in order history ONLY even if the "out of stock" status has not been yet reached
        // So you migth have two order states
        $mdOrderHistory = new mdOrderHistory();
        $mdOrderHistory->setMdOrderId($mdOrder->getId());
        $mdOrderHistory->setMdOrderStateId($order_status_id);
        $mdOrderHistory->save();

        // Actualiza la tabla product_sale iterando sobre cada producto del carrito
        // $new_history->changeIdOrderState((int) $id_order_state, (int) $order->id);
        // $new_history->addWithemail(true, $extraVars);

        // Eliminamos carrito
        sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));
        
        // Send an e-mail to customer and admin CADA MODULO SE ENCARGARA DE ENVIAR EL MAIL ??? o lo dejamos aca ???
        if($module_label != 'paypal'){
          $to = sfContext::getInstance()->getUser()->getEmail();
          $this->sendCustomerMail($to, $mdOrder);          
        }
      }
      else 
      {
        // Eliminamos carrito
        sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));
        
        throw new Exception('Order creation failed');
      }
      
      return $mdOrder;
    }
    else 
    {
      // Eliminamos carrito
      sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));
      
      throw new Exception('Cart cannot be loaded or an order has already been placed using this cart');
    }
  }
  
  /**
   * Envia un mail al usuario con los datos del metodo de pago
   * 
   * @param type $module_label
   * @param type $to
   * @param type $cart 
   */
  public static function sendCustomerMail($to, $order)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N', 'Partial'));
    
    $from = sfConfig::get('app_configuration_MD_SALE_FROM');

    $partial = get_partial('mdCart/resume_mail', array('mdOrder' => $order));

    $options = array();
    $options['sender']    = array('name' => __('mdEcommerce_From'), 'email' => $from);
    $options['body']      = $partial;
    $options['subject']   = __("mdEcommerce_subject resume");
    $options['recipients'] = $to;

    // MAIL AL CLIENTE
    mdMailHandler::sendMail($options);

    $options['sender']    = array('name' => __('mdEcommerce_From'), 'email' => $from);
    $options['body']      = $partial;
    $options['subject']   = __("mdEcommerce_subject resume");
    $options['recipients'] = $from;    
    
    // MAIL AL ADMIN
    mdMailHandler::sendMail($options);    
  }
}
