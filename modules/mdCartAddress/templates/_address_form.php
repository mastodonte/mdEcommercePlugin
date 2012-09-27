<fieldset>
  <legend>
    <b>Direccion de Entrega</b>
  </legend>

  <p>Para añadir una nueva dirección, por favor complete el siguiente formulario. </p>

  <form action="<?php echo ($form->isNew() ? url_for('@mdCartAddress-create') : url_for('@mdCartAddress-update')); ?>" method="POST" <?php echo ((isset($callback_js) && $callback_js) ? 'onsubmit="return mdCartAddress.execute(this)"' : ''); ?>>

    <input type="hidden" value="true" name="ajax" />

    <?php echo $form->renderHiddenFields(); ?>

    <?php echo $form['alias']->renderError(); ?>
    <label class="ecommerce-label"><?php echo __('Ecommerce_Alias'); ?>*:</label>
    <?php echo $form['alias']->render(array('class' => ( $form['alias']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['lastname']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Lastname'); ?>*:</label>
    <?php echo $form['lastname']->render(array('class' => ( $form['lastname']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['firstname']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Firstname'); ?>*:</label>
    <?php echo $form['firstname']->render(array('class' => ( $form['firstname']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['address']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Address'); ?>*:</label>
    <?php echo $form['address']->render(array('class' => ( $form['address']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['postcode']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Postcode'); ?>:</label>
    <?php echo $form['postcode']->render(array('class' => ( $form['postcode']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['city']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_City'); ?>*:</label>
    <?php echo $form['city']->render(array('class' => ( $form['city']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['country_code']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Country_code'); ?>*:</label>
    <?php echo $form['country_code']->render(array('class' => ( $form['country_code']->hasError() ? 'ecommerce_input_error' : ''))); ?>

    <?php echo $form['phone']->renderError(); ?>  
    <label class="ecommerce-label"><?php echo __('Ecommerce_Phone'); ?>*:</label>
    <?php echo $form['phone']->render(array('class' => ( $form['phone']->hasError() ? 'ecommerce_input_error' : ''))); ?>  

    <input class="button" type="submit" value="Guardar" />

  </form>

</fieldset>
