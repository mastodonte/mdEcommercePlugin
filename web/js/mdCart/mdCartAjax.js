//JS Object : update the cart by ajax actions
var ajaxCart = {

  createForm: function(self, qty){
    var f = document.createElement('form'); 
    f.style.display = 'none'; 
    self.parentNode.appendChild(f); 
    f.method = 'post'; 
    f.action = self.href;
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
  
  //override every button in the page in relation to the cart
  observers : function(){
    
    //for every 'add' buttons...
    $('.ajax_add_to_cart_button').unbind('click').click(function(){
      
      var form = ajaxCart.createForm(this, '1');

      if ($(this).attr('disabled') != 'disabled')
        ajaxCart.add(form, this, false);
      
      return false;
    });
    
    //for product page 'add' button...
    $('body#product p#add_to_cart input').unbind('click').click(function(){
      var form = ajaxCart.createForm($('#quantity_wanted').val());
      
      ajaxCart.add(form, this, true);
      
      return false;
    });

    //for 'delete' buttons in the cart block...
    $('#cart_block_list .ajax_cart_block_remove_link').unbind('click').click(function(){
      // Removing product from the cart
      ajaxCart.remove(this);
      
      return false;
    });
  },

  // cart to fix display when using back and previous browsers buttons
  refresh : function(){
    //send the ajax request to the server
    $.ajax({
      type: 'GET',
      url: '/frontend_dev.php/mdcart/init',
      async: true,
      cache: false,
      dataType : "json",
      data: 'ajax=true',
      success: function(jsonData)
      {
        ajaxCart.updateCart(jsonData);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
      // in front-office, do not display technical error
      //alert("TECHNICAL ERROR: unable to refresh the cart.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
      }
    });
  },
  
  // try to expand the cart
  expand : function(){
    /*$(['left_column', 'right_column']).each(function(id, parentId)
    {*/
      if ($('#cart_block #cart_block_list').hasClass('collapsed'))
      {
        $('#cart_block #cart_block_summary').slideUp(200, function(){
          $(this).addClass('collapsed').removeClass('expanded');
          $('#cart_block #cart_block_list').slideDown({
            duration: 600,
            complete: function(){
              $(this).addClass('expanded').removeClass('collapsed');
            }
          });
        });
        // toogle the button expand/collapse button
        $('#cart_block h4 span#block_cart_expand').fadeOut('slow', function(){
          $('#cart_block h4 span#block_cart_collapse').fadeIn('fast');
        });

        // TODO ************************************
        // save the expand statut in the user cookie
        /*$.ajax({
          type: 'GET',
          url: baseDir + 'modules/blockcart/blockcart-set-collapse.php',
          async: true,
          data: 'ajax_blockcart_display=expand' + '&rand=' + new Date().getTime()
        });*/
      }
    /*});*/
  },

  // try to collapse the cart
  collapse : function(){

    if ($('#cart_block #cart_block_list').hasClass('expanded'))
    {
      $('#cart_block #cart_block_list').slideUp('slow', function(){
        $(this).addClass('collapsed').removeClass('expanded');
        $('#cart_block #cart_block_summary').slideDown(700, function(){
          $(this).addClass('expanded').removeClass('collapsed');
        });
      });
      $('#cart_block h4 span#block_cart_collapse').fadeOut('slow', function(){
        $('#cart_block h4 span#block_cart_expand').fadeIn('fast');
      });

      // TODO ************************************
      // save the expand statut in the user cookie
      /*$.ajax({
        type: 'GET',
        url: baseDir + 'modules/blockcart/blockcart-set-collapse.php',
        async: true,
        data: 'ajax_blockcart_display=collapse' + '&rand=' + new Date().getTime()
      });*/
    }
  },

  // add a product in the cart via ajax
  add : function(form, callerElement, addedFromProductPage){
    //emptyCustomizations();
    
    //disabled the button when adding to do not double add if user double click
    if (addedFromProductPage)
    {
      $('body#product p#add_to_cart input').attr('disabled', 'disabled').removeClass('exclusive').addClass('exclusive_disabled');
      $('.filled').removeClass('filled');
    }
    else    
    $(callerElement).attr('disabled', 'disabled');

    if ($('#cart_block #cart_block_list').hasClass('collapsed'))
      this.expand();
    
    //send the ajax request to the server
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: $(form).serialize(),
      async: true,
      cache: false,
      dataType : "json",

      success: function(jsonData,textStatus,jqXHR)
      {
        // ANIMACION IMAGEN
        // add the picture to the cart
        var $element = $(callerElement).parent().parent().find('a.product_image img,a.product_img_link img');
        
        if (!$element.length)
          $element = $('#bigpic');
        
        var $picture = $element.clone();
        var pictureOffsetOriginal = $element.offset();

        if ($picture.size())
          $picture.css({
            'position': 'absolute', 
            'top': pictureOffsetOriginal.top, 
            'left': pictureOffsetOriginal.left
            });

        //var pictureOffset = $picture.offset();
        var cartBlockOffset = $('#cart_block').offset();

        // Check if the block cart is activated for the animation
        if (cartBlockOffset != undefined && $picture.size())
        {
          $picture.appendTo('body');
          $picture.css({
            'position': 'absolute', 
            'top': $picture.css('top'), 
            'left': $picture.css('left')
          })
          .animate({
            'width': $element.attr('width')*0.66, 
            'height': $element.attr('height')*0.66, 
            'opacity': 0.2, 
            'top': cartBlockOffset.top + 30, 
            'left': cartBlockOffset.left + 15
          }, 1000)
          .fadeOut(100, function() {
            ajaxCart.updateCartInformation(jsonData, addedFromProductPage);
          });
        }
        else
          ajaxCart.updateCartInformation(jsonData, addedFromProductPage);
      },     
      
      error: function(XMLHttpRequest, textStatus, errorThrown)
      {
        alert("TECHNICAL ERROR: unable to add the product.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
        //reactive the button when adding has finished
        if (addedFromProductPage)
          $('body#product p#add_to_cart input').removeAttr('disabled').addClass('exclusive').removeClass('exclusive_disabled');
        else
          $(callerElement).removeAttr('disabled');
      }
      
    });
  },

  //remove a product from the cart via ajax
  //obj debe ser un <a href=''></a>
  remove : function(obj){
    //send the ajax request to the server
    $.ajax({
      type: 'POST',
      url: obj.href,
      async: true,
      cache: false,
      dataType : "json",
      success: function(jsonData){
        ajaxCart.updateCart(jsonData);
        /*if ($('body').attr('id') == 'order' || $('body').attr('id') == 'order-opc')
          deletProductFromSummary(idProduct);*/
      },
      error: function() {
        alert('ERROR: unable to delete the product');
      }
    });
  },

  // Update the cart information
  updateCartInformation : function (jsonData, addedFromProductPage)
  {
    ajaxCart.updateCart(jsonData);

    //reactive the button when adding has finished
    if (addedFromProductPage)
      $('body#product p#add_to_cart input').removeAttr('disabled').addClass('exclusive').removeClass('exclusive_disabled');
    else
      $('.ajax_add_to_cart_button').removeAttr('disabled');
  },
  
  //display the products witch are in json data but not already displayed
  displayNewProducts : function(jsonData) {

  },

  //genarally update the display of the cart
  updateCart : function(jsonData) {
    //ajaxCart.updateCartEverywhere(jsonData);
    //ajaxCart.displayNewProducts(jsonData);
    //ajaxCart.refreshVouchers(jsonData);

    //update 'first' and 'last' item classes
    /*$('#cart_block dl.products dt').removeClass('first_item').removeClass('last_item').removeClass('item');
    $('#cart_block dl.products dt:first').addClass('first_item');
    $('#cart_block dl.products dt:not(:first,:last)').addClass('item');
    $('#cart_block dl.products dt:last').addClass('last_item');*/

    //reset the onlick events in relation to the cart block (it allow to bind the onclick event to the new 'delete' buttons added)
    ajaxCart.observers();
  }
};

//when document is loaded...
$(document).ready(function(){

  // expand/collapse management
  $('#block_cart_collapse').click(function(){
    ajaxCart.collapse();
  });
  $('#block_cart_expand').click(function(){
    ajaxCart.expand();
  });
  ajaxCart.observers();
  //ajaxCart.refresh();

});
