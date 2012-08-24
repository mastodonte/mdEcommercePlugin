var mdCartAddress = {

  display: function(){
    
    mdCartAddress.updateAddressDisplay();

  },

  execute : function(form, id){
    $(form).find('input[type=submit]').attr('disabled', 'disabled');

    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: $(form).serialize(),
      async: true,
      cache: false,
      dataType : "json",
      success: function(json,textStatus,jqXHR)
      {
        $(form).find('input[type=submit]').removeAttr('disabled');

        if(json.response == 'OK'){
          mdShowMessage(json.options.message);
          mdCartAddress.addAddress(json.options.md_address);
          mdCartAddress.expandForm();
          $('#ecommerce_address_form form input[type="text"]').val('');
        }else{
          $('#ecommerce_address_form').html(json.options.form);
          mdShowMessage(json.options.error);
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown)
      {
        $(form).find('input[type=submit]').removeAttr('disabled');
      }
    });

    return false;
  },
  
  expandForm: function(){
    $('#ecommerce_address_form').slideToggle();
  },
  
  updateAddressSelector: function()
  {
    if (formatedAddressFieldsValuesList.length <= 0)
      return false;

    var selector = $('#ecommerce_address_selector');
    selector.html('');
    for (var item in formatedAddressFieldsValuesList)
    {
      var data = formatedAddressFieldsValuesList[item];
      var template_option = '<option value="%id%">%alias%</option>';
      var template_option = template_option.replace('%id%', item).replace('%alias%', data.ecommerce_alias);
      selector.append($(template_option));
      selector.find("option[value=" + item + "]").attr("selected", true);
      mdCartAddress.updateAddressDisplay();
    }
  },

  updateAddressDisplay: function()
  {
    if (formatedAddressFieldsValuesList.length <= 0)
      return false;

    var idAddress = $('select#ecommerce_address_selector').val();
    mdCartAddress.buildAddressBlock(idAddress, $('#ecommerce_address_info'));

    // change update link TODO
    /*var link = $('ul#address_' + addressType + ' li.address_update a').attr('href');
    var expression = /id_address=\d+/;
    link = link.replace(expression, 'id_address='+idAddress);
    $('ul#address_' + addressType + ' li.address_update a').attr('href', link);*/
  },

  buildAddressBlock: function(id_address, dest_comp)
  {
    //var adr_titles_vals = getAddressesTitles();
    var li_content = formatedAddressFieldsValuesList[id_address];

    //var ordered_fields_name = ['title']; Se deberian de agregar a li_content
    //ordered_fields_name = ordered_fields_name.concat(formatedAddressFieldsValuesList[id_address]['ordered_fields']);
    //ordered_fields_name = ordered_fields_name.concat(['update']);
    //li_content['title'] = adr_titles_vals[address_type]; Titulo como li
    //li_content['update'] = '<a href="" title="Actualizar">Actualizar</a>'; // Actualizar como li 

    dest_comp.html('');

    mdCartAddress.appendAddressList(dest_comp, li_content);
  },

  appendAddressList: function(dest_comp, values)
  {
    for (var item in values)
    {
      var value = values[item];
      if (value != "" && item != 'ecommerce_alias')
      {
        var new_li = document.createElement('li');
        new_li.className = 'ecommerce_address_'+ item;
        new_li.innerHTML = values[item];
        dest_comp.append(new_li);
      }
    }
  },

  addAddress: function(data){
    var obj = {};
    obj.ecommerce_alias = data.alias;
    obj.ecommerce_firsname_lastname = data.firstname + " " + data.lastname;
    obj.ecommerce_firsname_address = data.address;
    obj.ecommerce_postcode_city = data.postcode + " " + data.city;
    obj.ecommerce_country_name = data.country_code;
    obj.ecommerce_phone = data.phone;
    formatedAddressFieldsValuesList[data.id] = obj;
    mdCartAddress.updateAddressSelector();
    mdCartAddress.updateAddressDisplay();
  }
};
