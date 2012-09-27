<div class="ecommerce-subcontainer">

  <h2>Giro Abitab:</h2>

  <form action="<?php echo url_for('@process-abitab'); ?>" method="POST">
    
    <input id="abitab_id" type="hidden" value="<?php echo $ec_abitab->getId(); ?>" name="id" />
    
    <p>Usted debera realizar el giro a la siguiente persona 
      <b><?php echo sfConfig::get('app_abitab_username'); ?></b>
      con el siguiente Numero de C.I. <b><?php echo sfConfig::get('app_abitab_documento'); ?></b>.
    </p>

    <p>Una vez realizado el giro debe ingresar el numero del mismo en el siguiente campo de texto .</p>    
    
    <label class="comment_text_over" for="abitab_code">Ingresa Numero de Giro</label>
    <input type="text" name="code" value="" id="abitab_code" /><br /><br />

    <p>Una vez confirmado el pago se le enviara un correo electronico 
    donde le llegara un link donde debe ingresar el codigo de giro para finalizar la transaccion</p>

    <input class="button" type="submit" value="FINALIZAR" />
    
  </form>
  
</div>
