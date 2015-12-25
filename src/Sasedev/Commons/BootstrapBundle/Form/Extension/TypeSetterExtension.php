<?php

namespace Sasedev\Commons\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\FormView;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 */
class TypeSetterExtension extends AbstractTypeExtension
{

	/**
	 *
	 * {@inheritDoc} @see AbstractTypeExtension::buildView()
	 */
	public function buildView(FormView $view, FormInterface $form, array $options)
	{

		$view->vars['original_type'] = $form->getConfig()
			->getType()
			->getBlockPrefix();

	}

	/**
	 *
	 * {@inheritDoc} @see FormTypeExtensionInterface::getExtendedType()
	 */
	public function getExtendedType()
	{

		return FormType::class;

	}

}
