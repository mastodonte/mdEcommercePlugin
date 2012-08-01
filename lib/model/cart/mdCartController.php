<?php

class mdCartController {

  private static $instance = NULL;
  
  private function __construct(){}
  
  public static function getInstance(){
    if(is_null(self::$instance)){
      self::$instance = new mdCartController();
    }
    return self::$instance;
  }
  
  public function init(){

    $currency = mdCurrency::loadCurrency(); // Identificador de la moneda
    $lang = mdLanguage::getLanguage();      // Simbolo de lenguaje: es, en, pt

    $cookie_cart_id = sfContext::getInstance()->getRequest()->getCookie(mdCart::COOKIE_CART_NAME);
    
    if((int)$cookie_cart_id){
      
      $cart = Doctrine::getTable('mdCart')->find((int)$cookie_cart_id);
      
      if(!$cart) return NULL;

      if($cart->orderExists()){ // Si ya tiene la orden efectuada => eliminamos carrito
      
        sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, NULL, time() - (15 * 24 * 3600));
        //unset($cookie->id_cart, $cart, $cookie->checkedTOS);
        return NULL;
        
      //sfContext::getInstance()->getUser()->isAuthenticated() && $cookie->id_customer != $cart->getCustomerId() || TODO: CUANDO TENGA USUARIO VEMOS DE AGREGARLO  
      }elseif($lang != $cart->getLang() || $currency != $cart->getCurrencyId()){
        
        //if ($cookie->id_customer){  // TODO: CUANDO TENGA USUARIO VEMOS DE AGREGARLO  
          //$cart->setCustomerId((int) $cookie->id_customer);
        //}
        
        $cart->setLang($lang);
        $cart->setCurrencyId($currency);
        $cart->save();
        
        return $cart;
        
      }else{
        
        return $cart;
        
      }
        
      /* Select an address if not set */ // TODO: CUANDO TENGA USUARIO VEMOS DE AGREGARLO  
      //if (($cart->getAddressDeliveryId() == NULL || $cart->getAddressDeliveryId() == 0) && $cookie->id_customer) {
        //$cart->setAddressDeliveryId((int) Address::getFirstCustomerAddressId($cart->id_customer)); TODO
        //$cart->save();
      //}
      
    }
    
    return NULL;
  }

  public function add($product_id, $quantity){
    $cart = $this->init();

    // Update the cart ONLY if $this->cookies are available, in order to avoid ghost carts created by bots TODO
    //if (isset($_COOKIE[self::$cookie->getName()])) {}

    // Obtener producto en $product y validarlo: Existe y es ACTIVO sino EXCEPTION: Product is no longer available
    $product = Doctrine::getTable('ecProduct')->find($product_id);
    if(!$product || !$product->getActive()) throw new Exception('Product is no longer available');
    
    // Validar cantidad para ese producto: $quantity > 0
    if((int)$quantity > 0 && is_numeric($quantity)){
        
      // Asociamos el producto con el carrito con la cantidad $quantity sino existia en el carrito lo creamos      
      if(is_null($cart)){
        
        $cart = $this->create();
        
      }
      
      $cartItem = Doctrine::getTable('mdCartProducts')->find(array($cart->getId(), $product_id));
      
      if(!$cartItem){
        
        $cartItem = new mdCartProducts();
        $cartItem->setMdCartId($cart->getId());
        $cartItem->setEcProductId($product_id);
        
      }else{
        
        $quantity+= $cartItem->getQuantity();
        
      }

      $cartItem->setQuantity($quantity);
      
      // !$in_stock sino valida: There is not enough product in stock
      if( !$product->isInStock($quantity) )
       throw new Exception('There is not enough product in stock');
     
      $cartItem->save();
      
    }else{
      
      throw new Exception('Invalid quantity');
      
    }      

  }
  
  public function remove($product_id){
    $cart = $this->init();
    
    // Update the cart ONLY if $this->cookies are available, in order to avoid ghost carts created by bots
    //if (isset($_COOKIE[self::$cookie->getName()])) {}
    
    // Obtener producto en $product y validarlo: Existe sino existe return;
    $product = Doctrine::getTable('ecProduct')->find($product_id);
    if(!$product || !$product->getActive()) throw new Exception('Product is no longer available');
    
    // Si no hay carrito return;
    if(is_null($cart)) return NULL;
    
    // Eliminar producto del carrito
    $cartItem = Doctrine::getTable('mdCartProducts')->find(array($cart->getId(), $product_id));
      
    if($cartItem){
      $cartItem->delete();
    }
    
    // Si el carrito no tiene mas producto carrier_id = 0 save(); TODO
  }
    
  public function clear(){
    // TODO
  }
  
  public function create(){
    $currency = mdCurrency::loadCurrency(); // Identificador de la moneda
    $lang = mdLanguage::getLanguage();      // Simbolo de lenguaje: es, en, pt
    
    $cart = new mdCart();
    $cart->setLang($lang);
    $cart->setCurrencyId($currency);
    $cart->save();
    
    sfContext::getInstance()->getResponse()->setCookie(mdCart::COOKIE_CART_NAME, $cart->getId(), time() + (15 * 24 * 3600));
    
    return $cart;
  }
  
  public function run($method, $parameters) {
    $this->init();
    
    $request = sfContext::getInstance()->getRequest();
    
    if ($request->getParameter('ajax') == 'true') {
      try{
        
        call_user_func_array(array(&$this, $method), $parameters);
        return mdBasicFunction::basic_json_response(true, array());
        
      }catch(Exception $e){
        
        return mdBasicFunction::basic_json_response(false, array('message' => $e->getMessage()));
        
      }      
    }
    else 
    {
      // Recargarmos la pagina
      header('location: ' . $request->getUri());
    }
  }
  
}
