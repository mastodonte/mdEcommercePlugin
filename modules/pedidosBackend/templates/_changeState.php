<?php use_helper('Date'); ?>

<fieldset style="width: 400px">
  <legend>Estado del pedido</legend>
  
  <table cellspacing="0" cellpadding="0" style="widtd: 429px" class="table">
    <tbody>
      <?php foreach($md_order_histories as $md_order_history): ?>
      <tr>
        <td><?php echo format_date($md_order_history->getCreatedAt(), 'dd/mm/yyyy HH:mm:ss'); ?></td>
        <!-- <td><img src="../img/os/3.gif"></td>-->
        <td><?php echo $md_order_history->getMdOrderState()->getName(); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
  <br />

  <form style="text-align:center;" method="post" action="/backend.php/pedidosBackend/changeOrderState">
    <select name="md_order_state_id">
      <?php foreach($md_states as $md_state): ?>
        <option value="<?php echo $md_state->getId(); ?>" <?php echo ($md_state->getId() == $md_order->getMdOrderStateId() ? 'selected=selected' : ''); ?>>
          <?php echo $md_state->getName(); ?>
        </option>
      <?php endforeach; ?>
    </select>
    <input type="hidden" value="<?php echo $md_order->getId(); ?>" name="md_order_id">
    <input type="submit" class="button" value="Cambiar" name="submitState">
  </form>  
</fieldset>

<br />
