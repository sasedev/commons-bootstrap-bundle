<?php
namespace Sasedev\Commons\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpKernel\Kernel;
use Sasedev\Commons\BootstrapBundle\Util\LegacyFormHelper;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 */
class BootstrapCollectionType extends AbstractType
{

  /**
   *
   * {@inheritdoc} @see AbstractType::buildView()
   */
  public function buildView(FormView $view, FormInterface $form, array $options)
  {
    $view->vars = array_replace($view->vars, array(
      'allow_add' => $options['allow_add'],
      'allow_delete' => $options['allow_delete'],
      'add_button_text' => $options['add_button_text'],
      'add_button_class' => $options['add_button_class'],
      'delete_button_text' => $options['delete_button_text'],
      'delete_button_class' => $options['delete_button_class'],
      'sub_widget_col' => $options['sub_widget_col'],
      'button_col' => $options['button_col'],
      'prototype_name' => $options['prototype_name']
    ));

    if (false === $view->vars['allow_delete']) {
      $view->vars['sub_widget_col'] += $view->vars['button_col'];
    }
    if ($form->getConfig()->hasAttribute('prototype')) {
      $view->vars['prototype'] = $form->getConfig()
        ->getAttribute('prototype')
        ->createView($view);
    }
  }

  /**
   *
   * {@inheritdoc} @see AbstractType::configureOptions()
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $optionsNormalizer = function (Options $options, $value) {
      // @codeCoverageIgnoreStart
      $value['block_name'] = 'entry';

      return $value;
      // @codeCoverageIgnoreEnd
    };

    $defaults = array(
      'allow_add' => false,
      'allow_delete' => false,
      'prototype' => true,
      'prototype_name' => '__name__',
      'add_button_text' => 'Add',
      'add_button_class' => 'btn btn-primary btn-sm',
      'delete_button_text' => 'Delete',
      'delete_button_class' => 'btn btn-danger btn-sm',
      'sub_widget_col' => 10,
      'button_col' => 2,
      'options' => array()
    );

    if (Kernel::VERSION_ID >= 20800) {
      $defaults['entry_type'] = 'Symfony\Component\Form\Extension\Core\Type\TextType';
    } else {
      // map old class to new one using LegacyFormHelper
      $defaults['type'] = LegacyFormHelper::getType('text');
    }
    $resolver->setDefaults($defaults);
    $resolver->setNormalizer('options', $optionsNormalizer);
  }

  /**
   *
   * {@inheritdoc} @see AbstractType::getParent()
   */
  public function getParent()
  {
    return LegacyFormHelper::getType('collection');
  }

  /**
   * return Name
   */
  public function getName()
  {
    return 'bootstrap_collection';
  }

  /**
   *
   * {@inheritdoc} @see AbstractType::getBlockPrefix()
   */
  public function getBlockPrefix()
  {
    return $this->getName();
  }
}
