var _timer_ejec = 0;
var _lock = false;
var _activate = false;
var _MAX_WAIT_CALL = 2;
 
var mdAutoSearch = {

  observers: function(){
    $('.bloque_filtro input[type=checkbox]').bind('click', function(){
      mdAutoSearch.reset();
    });
    
    $('#search_sort_by').change(function(){
      $('#input_sort_by').val($(this).val());
      $('#input_page').val(1); // Reseteamos le numero de pagina
      mdAutoSearch.execute();
    });
    
    $('#search_quantity').change(function(){
      $('#input_quantity').val($(this).val());
      $('#input_page').val(1); // Reseteamos le numero de pagina
      mdAutoSearch.execute();
    });

    $('a.search_view').live('click', function(event){
        event.preventDefault();
        $('#input_filter').val($(this).attr('href'));
        mdAutoSearch.execute();
    });

    $('.paginacion a').live('click', function(){
      var page = ($(this).hasClass('pager_image') ? $(this).find(':first-child').attr('alt') : $(this).text());
      if(!$(this).hasClass('current')){
        $('#input_page').val(page);
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
          $('#input_page').val(1); // Reseteamos le numero de pagina
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
    var form = $('#md_auto_search_form');
    
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
          $('#md_listado_productos').replaceWith(json.options.content);
          $('.container_paginacion').html(json.options.pager);
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
