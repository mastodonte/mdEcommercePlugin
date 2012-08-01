<?php use_javascript('../mdEcommercePlugin/js/categoriasBackend/associate/jquery.treeview.js', 'last'); ?>
<?php use_stylesheet('../mdEcommercePlugin/css/categoriasBackend/associate/jquery.treeview.css', 'last'); ?>

<h1>Categorias</h1>

<!--<div id="treecontrol">
  <a title="Collapse the entire tree below" href="#"><img src="/images/categorias/associate/minus.gif" /> Collapse All</a>
  <a title="Expand the entire tree below" href="#"><img src="/images/categorias/associate/plus.gif" /> Expand All</a>
  <a title="Toggle the tree below, opening closed branches, closing open branches" href="#">Toggle All</a>
</div>-->

<div id="ec_drawer" class="notice" style="display: none;"></div>

<form id="ec_categorias_form" action="<?php echo url_for('@ec_category_associate'); ?>" method="POST" name="ec_category">
  
  <input name="object_id" type="hidden" value="<?php echo $object->getId(); ?>" />
  
  <ul id="navigation">
    <?php $prevLevel = 0; ?>

    <?php foreach ($categorias as $record): ?>

      <?php if ($prevLevel > 0 && $record->getLevel() == $prevLevel)
        echo '</li>'; ?>    
      <?php
      if ($record->getLevel() > $prevLevel)
        echo '<ul>';
      elseif ($record->getLevel() < $prevLevel)
        echo str_repeat('</ul></li>', $prevLevel - $record->getLevel());
      ?>

      <li id ="node<?php echo $record->getId(); ?>">
        <span><input type="checkbox" name="categorias[]" value="<?php echo $record->getId(); ?>" <?php echo (($object->hasCategory($record->getId())) ? 'checked=""' : ''); ?> style="position: relative; top: 3px;"> <?php echo $record->getName(); ?></span>

        <?php $prevLevel = $record->getLevel();

      endforeach; ?>
    </li>
  </ul>
  <input type="submit" value="Agregar" />
</form>

<script type="text/javascript">
  $(document).ready(function(){

    // second example
    $("#navigation").treeview({
      //control: "#treecontrol",
      persist: "location",
      collapsed: true,
      unique: true
    });

  });

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
