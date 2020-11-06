<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {
    $this->removeFields();
 
    
    //eliminar campos del formulario, que no sean editables
    unset(
      $this['created_at'], $this['updated_at'],
      $this['expires_at'], $this['is_activated'],
      $this['token']
    );
    //validatorand toma un arreglo de validador de valores
    //validar el campo email como email
    $this->validatorSchema['email'] = new sfValidatorAnd(array(
      $this->validatorSchema['email'],
      new sfValidatorEmail(),
    ));
    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine_Core::getTable('JobeetJob')->getTypes(),
      'expanded' => true,
    ));
    //widget de opciones (dependiendo de los tipos especificados)
    
    $this->validatorSchema['type'] = new sfValidatorChoice(array(
      'choices' => array_keys(Doctrine_Core::getTable('JobeetJob')->getTypes()),
    ));
    //campo de entrada archivo
    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Company logo',
    ));
    //cambiar labels de los campos
    $this->widgetSchema->setLabels(array(
      'category_id'    => 'Category',
      'is_public'      => 'Public?',
      'how_to_apply'   => 'How to apply?',
    ));
    //validar que el archivo subido este en formato web, cambiar el nombre del archivo a algo unico
    $this->validatorSchema['logo'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/jobs',
      'mime_types' => 'web_images',
    ));
    //Mensaje de ayuda
    $this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');
    $this->widgetSchema->setNameFormat('job[%s]');
    $this->validatorSchema->setOption('allow_extra_fields', true);

  }
  protected function removeFields()
  {
    unset(
      $this['created_at'], $this['updated_at'],
      $this['expires_at'], $this['is_activated'],
      $this['token']
    );
  }
}
