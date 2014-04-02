<?php use_javascript('../mdEcommercePlugin/js/categoriasBackend/associate/jquery.treeview.js', 'last'); ?>
<?php use_javascript('../mdEcommercePlugin/js/categoriasBackend/associate/jquery.treeview.edit.js', 'last'); ?>
<?php use_javascript('../mdEcommercePlugin/js/categoriasBackend/associate/jquery.treeview.async.js', 'last'); ?>
<?php use_stylesheet('../mdEcommercePlugin/css/categoriasBackend/associate/jquery.treeview.css', 'last'); ?>

<fieldset>
<legend>Categorías</legend>

<!--<div id="treecontrol">
  <a title="Collapse the entire tree below" href="#"><img src="/images/categorias/associate/minus.gif" /> Collapse All</a>
  <a title="Expand the entire tree below" href="#"><img src="/images/categorias/associate/plus.gif" /> Expand All</a>
  <a title="Toggle the tree below, opening closed branches, closing open branches" href="#">Toggle All</a>
</div>-->

<div id="ec_drawer" class="notice" style="display: none;"></div>

<form id="ec_categorias_form" action="<?php echo url_for('@ec_category_associate'); ?>" method="POST" name="ec_category">

  <input name="object_id" type="hidden" value="<?php echo $object->getId(); ?>" />
  
  <ul id="black"></ul>
  
  <input class="btn btn-success" type="submit" value="Agregar" />
  
</form>  

</fieldset>

<script type="text/javascript">
  /*$(document).ready(function(){

    // second example
    $("#navigation").treeview({
      persist: "location",
      collapsed: true,
      unique: true
    });

  });*/

  function addCategories(form){
    mdShowLoading();
    $.ajax({
      url: $(form).attr('action'),
      data: $(form).serialize(),
      type: 'post',
      dataType: 'json',
      success: function(json){
        mdHideLoading();
        if(json.response == "OK"){
          $('#ec_drawer').html(json.options.message).show();
        }else {

        }
      }
    });
    return false;
  }

  $(document).ready(function() {
    // validate the form when it is submitted
    $("#ec_categorias_form").submit(function(){
      return addCategories(this);
    });
  });
</script>


  
<script type="text/javascript">
function initTrees() {
  $("#black").treeview({
    url: "<?php echo url_for('@ec_category_subtree') . '?object_id=' . $object->getId(); ?>"
  });
}
$(document).ready(function(){
  initTrees();
  $("#refresh").click(function() {
    $("#black").empty();
    initTrees();
  });
});
</script>












