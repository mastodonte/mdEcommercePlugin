//JS Object : update the cart by ajax actions
// Los input de cantidades deben tener la clase "cart_quantity_input"
// El boton de eliminar de tener la clase "cart_quantity_delete"

// El summary debe tener los siguientes ids:
// id="cart_order_total": precio total
var mdSummaryAjax = {

  createForm: function(self, act, qty){
    var f = document.createElement('form'); 
    f.style.display = 'none'; 
    self.parentNode.appendChild(f); 
    f.method = 'post'; 
    f.action = act;
    var m = document.createElement('input'); 
    m.setAttribute('type', 'hidden'); 
    m.setAttribute('name', 'quantity'); 
    m.setAttribute('value', qty); 
    f.appendChild(m);
    m = document.createElement('input'); 
    m.setAttribute('type', 'hidden'); 
    m.setAttribute('name', 'ajax'); 
    m.setAttribute('value', 'true'); 
    f.appendChild(m);
    return f;
  },
  
  observers : function(){
    $('.ecommerce-cart_quantity_delete' ).unbind('click').click(function(){
      mdSummaryAjax.remove(this);
      return false;
    });
    
    $('.ecommerce-cart_quantity_input').typeWatch({
      highlight: true, 
      wait: 600, 
      captureLength: 0, 
      callback: updateQty
    });
  },  
  
  remove: function(obj){
    $.ajax({
      type: 'POST',
      url: $(obj).attr('href'),
      async: true,
      cache: false,
      data: 'ajax=true',
      dataType: 'json',
      success: function(json)
      {
        if (json.response == 'OK')
        {
          mdCartAjax.updateCart(json);

          $(obj).parents('tr').fadeOut('slow', function() {
            $(this).remove();
          });

          mdSummaryAjax.updateCartSummary(json.options.summary);
        }
        else
        {
          mdShowMessage(json.options.message);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        //alert("TECHNICAL ERROR: unable to save update quantity \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
      }
    });
    
  },

  update: function(obj){
    var _action = $(obj.el).attr('name');
    var qty = parseInt($(obj.el).attr('value'));

    var form = mdSummaryAjax.createForm(obj.el, _action, qty);
    
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: $(form).serialize(),
      async: true,
      cache: false,
      dataType : "json",
      success: function(json)
      {
        if (json.response == 'OK')
        {
          mdCartAjax.updateCart(json);
          mdSummaryAjax.updateCartSummary(json.options.summary, obj.el);
        }
        else
        {
          mdShowMessage(json.options.message);
        }
        $(form).remove();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        $(form).remove();
        //alert("TECHNICAL ERROR: unable to save update quantity \n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
      }
    });
  },
  
  updateCartSummary: function(object, htmlObj){
    $('#ecommerce-cart_order_total').html(object.productTotal);

    if(htmlObj != undefined){
      var qty = parseInt($(htmlObj).attr('value'));
      var price = parseFloat(object.product.price) * parseInt(qty);
      // Actualizo total del producto
      $(htmlObj).parents('tr').find('.ecommerce-cart_product_total').html(formatCurrency(price, _currencyFormat, _currencySign, _currencyBlank));      
    }
    
    if(typeof callAfterUpdateCart == 'function') {
      callAfterUpdateCart();
    }

  },
  
  up: function(obj)
  {
    var qty = parseInt($(obj.el).attr('value'));
    var newqty = qty+1;
    $(obj.el).attr('value', newqty);
    
    mdSummaryAjax.update(obj);
  },

  down: function(obj)
  {
    var qty = parseInt($(obj.el).attr('value'));
    var newqty = qty+1;
    $(obj.el).attr('value', newqty);

    if (newqty > 0){
      mdSummaryAjax.update(obj);
    }else{
      mdSummaryAjax.remove(obj);
    }
  }  
};

function updateQty(){
  mdSummaryAjax.update(this);  
}

//when document is loaded...
$(document).ready(function(){

  mdSummaryAjax.observers();

});
