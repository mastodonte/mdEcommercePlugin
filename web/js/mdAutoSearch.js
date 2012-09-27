var _timer_ejec = 0;
var _lock = false;
var _activate = false;
var _MAX_WAIT_CALL = 2;
 
var mdAutoSearch = {

  observers: function(){
    $('.ecommerce-bloque_filtro input[type=checkbox]').bind('click', function(){
      mdAutoSearch.reset();
    });
    
    $('#ecommerce-search_sort_by').change(function(){
      $('#ecommerce-input_sort_by').val($(this).val());
      $('#ecommerce-input_page').val(1); // Reseteamos le numero de pagina
      mdAutoSearch.execute();
    });
    
    $('#ecommerce-search_quantity').change(function(){
      $('#ecommerce-input_quantity').val($(this).val());
      $('#ecommerce-input_page').val(1); // Reseteamos le numero de pagina
      mdAutoSearch.execute();
    });

    $('a.ecommerce-search_view').live('click', function(event){
        event.preventDefault();
        $('#ecommerce-input_filter').val($(this).attr('href'));
        $(this).parent().find('.filter_grid').removeClass('grid_current');
        $(this).parent().find('.filter_list').removeClass('list_current');
        $(this).addClass($(this).attr('href') + '_current');
        mdAutoSearch.execute();
    });

    $('.ecommerce-paginacion a').live('click', function(){
      var page = ($(this).hasClass('ecommerce-pager_image') ? $(this).find(':first-child').attr('alt') : $(this).text());
      if(!$(this).hasClass('current')){
        $('#ecommerce-input_page').val(page);
        mdAutoSearch.execute();
      }
    });
  },
  
  controller: function()
  {
    if(_activate){
      if(!_lock){
        _timer_ejec++;

        if(_timer_ejec == _MAX_WAIT_CALL){
          $('#ecommerce-input_page').val(1); // Reseteamos le numero de pagina
          mdAutoSearch.execute();
        }
      }
    }
  },
  
  reset: function(){
    _lock = true;
    _activate = true;
    _timer_ejec = 0;
    _lock = false;
  },
  
  execute : function(){
    _activate = false;
    mdShowLoading();
    var form = $('#ecommerce-md_auto_search_form');
    
    //send the ajax request to the server
    $.ajax({
      type: 'POST',
      url: form.attr('action'),
      async: true,
      cache: false,
      dataType : "json",
      data: $(form).serialize(),
      success: function(json)
      {
        if(json.response == "OK"){
          $('#ecommerce-md_listado_productos').replaceWith(json.options.content);
          $('.ecommerce-container_paginacion').html(json.options.pager);
          mdCartAjax.observers();
        }
        mdHideLoading();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        //alert("TECHNICAL ERROR: unable to refresh the cart.\n\nDetails:\nError thrown: " + XMLHttpRequest + "\n" + 'Text status: ' + textStatus);
      }
    });
  }
};

//when document is loaded...
$(document).ready(function(){

  mdAutoSearch.observers();

  var check = setInterval("mdAutoSearch.controller()", 1000);

});
