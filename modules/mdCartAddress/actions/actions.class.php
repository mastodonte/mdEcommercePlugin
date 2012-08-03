<?php

/**
 * mdCartAddress actions.
 *
 * @package    frontend
 * @subpackage mdCartAddress
 * @author     Gaston Caldeiro
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mdCartAddressActions extends sfActions
{

  public function executeCreate(sfWebRequest $request) 
  {
    $this->form = new mdAddressForm();
    $this->md_address = $this->form->getObject();
    
    if($this->getUser()->isAuthenticated())
    {
      return $this->processForm($request, $this->form);       
    }
    else
    {
      return $this->renderText(mdBasicFunction::basic_json_response(false, array('error' => __('Mensajes_You must be logged in'))));
    }
  }
  
  public function executeEdit(sfWebRequest $request) 
  {
    $parameters = $request->getParameter('md_address');
    $this->md_address = Doctrine::getTable('mdAddress')->find($parameters['id']);
    $this->form = new mdAddressForm($this->md_address);

    return $this->processForm($request, $this->form); 
  }  
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $parameters = $request->getParameter($form->getName());
    $parameters['customer_id'] = $this->getUser()->getMdUserId();
    //var_dump($parameters);die();
    //TODO no ajax
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    
    $form->bind($parameters, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? __('Mensajes_The item was created successfully.') : __('Mensajes_The item was updated successfully.');

      try {
        
        $md_address = $form->save();
        mdCartController::getInstance()->updateAddress($md_address); // Actualizamos el carrito
        
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);

        $partial = $this->getPartial('mdCartAddress/form', array('form' => $form));
      
        return $this->renderText(mdBasicFunction::basic_json_response(false, array('error' => $message, 'form' => $partial)));
      }

      $form = new mdAddressForm($md_address); //Actualizamos formulario
      
      $partial = $this->getPartial('mdCartAddress/form', array('form' => $form));
      
      return $this->renderText(mdBasicFunction::basic_json_response(true, array('message' => $notice, 'form' => $partial, 'md_address' => $md_address->toArray())));
    }
    else
    {
      $this->getUser()->setFlash('error', __('Mensajes_The item has not been saved due to some errors.'), false);
      
      $partial = $this->getPartial('mdCartAddress/form', array('form' => $form));
      
      return $this->renderText(mdBasicFunction::basic_json_response(false, array('error' => __('Mensajes_The item has not been saved due to some errors.'), 'form' => $partial)));
    }
  }

}
