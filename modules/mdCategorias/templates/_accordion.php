<div class="ecommerce-box">

  <div class="ecommerce-box-heading"><?php echo $parent->getName(); ?></div>

  <ul id="ecommerce-navigation">
    <?php foreach ($categorias as $record_categoria): ?>
      <?php $record_categoria = $record_categoria->getRawValue(); ?>
      <?php $hasChildren = (count($record_categoria['children']) > 0); ?>

      <li class="<?php echo ($record_categoria['id'] == $categoria->getId() ? 'selected' : ''); ?>">
        <a class="head <?php echo ($record_categoria['id'] == $categoria->getId() ? 'selected' : ''); ?>" 
           href="<?php echo ($hasChildren ? 'javascript:void(0)' : url_for('@productos-categoria?id=' . $record_categoria['id'] . '&name=' . mdBasicFunction::slugify($record_categoria['name'])) . '?s=' . base64_encode($parent->getId() . '-' . $parent->getName())); ?>">
             <?php echo $record_categoria['name']; ?>
        </a>

        <?php if ($hasChildren): ?>

          <?php $subcategorias = $record_categoria['children']; ?>

          <ul style="display:<?php echo ($record_categoria['id'] == $categoria->getId() ? 'block' : 'none'); ?>">

            <?php foreach ($subcategorias as $subcategoria): ?>

              <?php $hasChildren = (count($subcategoria['children']) > 0); ?>

              <li>            
                <a href="<?php echo ($hasChildren && false ? 'javascript:void(0)' : url_for('@productos-categoria?id=' . $subcategoria['id'] . '&name=' . mdBasicFunction::slugify($subcategoria['name'])) . '?s=' . base64_encode($record_categoria['id'] . '-' . $record_categoria['name'])); ?>"><?php echo $subcategoria['name']; ?></a>
              </li>

            <?php endforeach; ?>

          </ul>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>

</div>

<script type="text/javascript">  
$(document).ready(function(){
  $('#ecommerce-navigation .head').click(function() {
    // Si hago click en el mismo item seleccionado retorno
    if($(this).hasClass('selected')) return;
    
    // Cierro los abiertos y le quito la clase
    $('a.selected').removeClass('selected').next().toggle('fast');

    $(this).addClass('selected').next().toggle('fast');

  }).next().hide();
  
  $('a.selected').next().show();
});  
</script>
