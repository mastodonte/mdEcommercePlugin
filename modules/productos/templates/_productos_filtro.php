<?php use_javascript('/mdEcommercePlugin/js/mdAutoSearch.js', 'last'); ?>

<form id="ecommerce-md_auto_search_form" action="<?php echo url_for('productos/filter'); ?>" method="POST" style="display:none;">
  <input id="ecommerce-input_quantity" type="hidden" value="<?php echo ($sf_request->hasParameter('quantity') ? $sf_request->getParameter('quantity') : '16'); ?>" name="quantity" />
  <input id="ecommerce-input_sort_by" type="hidden" value="-1" name="sort_by" />
  <input id="ecommerce-input_page" type="hidden" value="1" name="page" />
  <input id="ecommerce-input_filter" type="hidden" value="grid" name="filter" />
  <input id="ecommerce-input_search" type="hidden" value="<?php echo $sf_request->getParameter('texto', '-1'); ?>" name="texto" />
  <input id="ecommerce-input_categoria" type="hidden" value="<?php echo (isset($categoria) && $categoria ? $categoria->getId() : '-1'); ?>" name="id" />  
  <input type="hidden" value="true" name="ajax" />
</form>
