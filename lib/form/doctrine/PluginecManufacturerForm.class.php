<?php

/**
 * PluginecManufacturer form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginecManufacturerForm extends BaseecManufacturerForm {

  public function configure() {
    $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
        'file_src' => '/uploads/' . ecManufacturer::FOLDER_NAME . '/' . $this->getObject()->getImage(),
        'is_image' => true,
        'edit_mode' => !$this->isNew(),
        'delete_label' => 'eliminar la imagen actual',
        'template' => '<div class="md_auto_image">%file%<br />%input%<br />%delete_label% %delete%</div>',
      ));
    
    $this->widgetSchema->setHelp('image', 'Importante: Se aconseja que la imagen tenga un alto de 70 pixeles y un ancho no mayor a 200 pixeles.');

    $this->validatorSchema['image'] = new sfValidatorFile(array(
        'required' => false,
        'path' => sfConfig::get('sf_upload_dir') . '/' . ecManufacturer::FOLDER_NAME,
        'mime_types' => 'web_images',
      ));

    $this->validatorSchema['image_delete'] = new sfValidatorPass();
  }

}
