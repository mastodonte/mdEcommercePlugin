<div class="ecommerce-subcontainer">

  <h2>Giro brou:</h2>

  <form action="<?php echo url_for('@process-brou'); ?>" method="POST">
    
    <input id="brou_id" type="hidden" value="<?php echo $ec_brou->getId(); ?>" name="id" />
    
    <p>Usted debera realizar el deposito en nuestra cuenta en DOLARES 
      <b><?php echo sfConfig::get('app_brou_dollar_account'); ?></b> o PESOS 
      <b><?php echo sfConfig::get('app_brou_pesos_account'); ?></b>.
    </p>

    <p>Una vez realizado el deposito debe ingresar el numero del mismo en el siguiente campo de texto.</p>    
    
    <label class="comment_text_over" for="brou_code">Ingresa Numero de Deposito</label>
    <input type="text" name="code" value="" id="brou_code" /><br /><br />

    <p>Una vez confirmado el pago se le enviara un correo electronico 
    donde le llegara un link para ingresar el numero de deposito y finalizar la transaccion</p>

    <input class="button" type="submit" value="FINALIZAR" />
    
  </form>
  
</div>
