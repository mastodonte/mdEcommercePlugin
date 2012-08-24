<fieldset style="width: 400px">
  <legend><img src="/img/admin/details.gif"> Detalles del pedido</legend>
  
  <div style="margin: 2px 0 1em 50px;">
    <table width="300px;" cellspacing="0" cellpadding="0" class="table">
      <tbody>
        <!--<tr>
          <td width="150px;">Artículos</td>
          <td align="right"><?php //echo $md_order->getMdCart()->getDisplayTotal(); ?></td>
        </tr>-->
        <!--<tr>
          <td>Envío</td>
          <td align="right">22,42 €</td>
        </tr>-->
        <tr style="font-size: 20px">
          <td>Total</td>
          <td align="right"><?php echo $md_order->getMdCart()->getDisplayTotal(); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</fieldset>