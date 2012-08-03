<?php
/**
 * Recibe en $categorias un arreglo de categorias de la forma:
 * array(2)
 *  [0]: array(
 *        'id' => 1,
 *        'name' => 'Informatica',
 *        'children' => array()
 *        ),
 *  [1]: array(
 *        'id' => 2,
 *        'name' => 'Oficinas',
 *        'children' => array()
 *        )
 */
echo 'OVERRIDE THIS TEMPLATE TO SHOW YOUR MENU';

?>

<?php
/* ************** */
/* EJEMPLO DE USO PARA UN MENU DE 2 niveles */
/* Obtenemos cantidad y quitamos el sfOutputEscaperArrayDecorator */

//$count = $categorias->count();
//$records = $categorias->getRawValue();
/* ************** */
?>

<?php //foreach($categorias as $categoria): ?>

  <?php //$children = $categoria['children']; ?>
  <!--
  <ul>
    <li><?php //echo $categoria['name']; ?>
      <?php //if(count($children) > 0): ?>
        <ul>
          <?php //foreach($children as $child): ?>
            <li><a href="#"><?php //echo $child['name']; ?></a></li>
          <?php //endforeach; ?>
        </ul>
      <?php //endif; ?>
    </li>
  </ul>
  -->
<?php //endforeach; ?>
