<?php $mdProducts = $md_order->getMdOrderProducts(); ?>

<fieldset style="width: 868px; ">
  <legend>Artículos</legend>
  <table cellspacing="0" style="width: 100%;">
    <thead>
      <tr>
        <!--<th class="sf_admin_text sf_admin_list_th_id">Articulo</th>-->
        <th class="sf_admin_text sf_admin_list_th_name">Id</th>
        <th class="sf_admin_text sf_admin_list_th_display_price">Nombre</th>
        <th class="sf_admin_text sf_admin_list_th_quantity">Precio</th>
        <th class="sf_admin_boolean sf_admin_list_th_active">Cantidad</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($mdProducts as $mdProduct): ?>
      <tr class="sf_admin_row odd">
        <!--<td>
          <input type="checkbox" class="sf_admin_batch_checkbox" value="<?php echo $mdProduct->getId(); ?>" name="ids[]">
        </td>-->
        <td class="sf_admin_text sf_admin_list_td_id">
          <a href="#"><?php echo $mdProduct->getItemId(); ?></a>
        </td>
        <td class="sf_admin_text sf_admin_list_td_name">
          <a href="#"><?php echo $mdProduct->getItemName(); ?></a>
        </td>
        <td class="sf_admin_text sf_admin_list_td_display_price">
          <?php echo Tools::displayPrice($mdProduct->getItemPrice()); ?>
        </td>
        <td class="sf_admin_text sf_admin_list_td_quantity">
          <?php echo $mdProduct->getItemQuantity(); ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</fieldset>

