<div class="box">
    <div class="box-heading"><?php echo $parent->getName(); ?></div>
    <div class="box-content">
        <div class="box-category">
            <ul id="navigation">
                <?php foreach ($categorias as $record_categoria): ?>
                    <?php $record_categoria = $record_categoria->getRawValue(); ?>
                    <?php $hasChildren = (count($record_categoria['children']) > 0); ?>

                    <li>
                        <a class="<?php echo ($hasChildren ? 'head' : ''); ?> <?php echo ($record_categoria['id'] == $categoria->getId() ? 'active' : ''); ?>" 
                           href="<?php echo ($hasChildren ? 'javascript:void(0)' : url_for('@productos-categoria?id=' . $record_categoria['id'] . '&name=' . mdBasicFunction::slugify($record_categoria['name'])) . '?s=' . base64_encode($parent->getId() . '-' . $parent->getName())); ?>">
                               <?php echo $record_categoria['name']; ?>
                        </a>

                        <?php if ($hasChildren): ?>

                            <?php $subcategorias = $record_categoria['children']; ?>

                            <ul>

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
    </div>
</div>

<script type="text/javascript">
    jQuery().ready(function(){
        jQuery('#navigation').accordion({
            header: '.head',
            active: false,
            alwaysOpen: false,
            animated: false,
            autoheight: false
        });
    });
</script>
