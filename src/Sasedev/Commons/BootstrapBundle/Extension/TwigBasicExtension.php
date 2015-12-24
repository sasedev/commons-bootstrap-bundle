<?php

namespace Sasedev\Commons\BootstrapBundle\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 *
 * @author sasedev <seif.salah@gmail.com>
 */
class TwigBasicExtension extends Twig_Extension
{

	/**
	 *
	 * {@inheritDoc} @see Twig_Extension::getFunctions()
	 */
	public function getFunctions()
	{
		$options = array('pre_escape' => 'html', 'is_safe' => array('html'));
		
		return array(new Twig_SimpleFunction('bsLabel', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsLabelPrimary', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsLabelSuccess', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsLabelInfo', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsLabelWarning', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsLabelDanger', array($this, 'labelFunction'), $options), 
			new Twig_SimpleFunction('bsBadge', array($this, 'labelFunction'), $options));
	}

	/**
	 * Returns the HTML code for a label.
	 * 
	 * @param string $text
	 *        	The text of the label
	 * @param string $type
	 *        	The type of label
	 * @return string The HTML code of the label
	 */
	public function labelFunction($text, $type = 'default')
	{
		return sprintf('<span class="label%s">%s</span>', ($type ? ' label-' . $type : ''), $text);
	}

	/**
	 *
	 * @param string $text        	
	 *
	 * @return string
	 */
	public function labelPrimaryFunction($text)
	{
		return $this->labelFunction($text, 'primary');
	}

	/**
	 * Returns the HTML code for a success label.
	 * 
	 * @param string $text
	 *        	The text of the label
	 * @return string The HTML code of the label
	 */
	public function labelSuccessFunction($text)
	{
		return $this->labelFunction($text, 'success');
	}

	/**
	 * Returns the HTML code for a warning label.
	 * 
	 * @param string $text
	 *        	The text of the label
	 * @return string The HTML code of the label
	 */
	public function labelWarningFunction($text)
	{
		return $this->labelFunction($text, 'warning');
	}

	/**
	 * Returns the HTML code for a important label.
	 * 
	 * @param string $text
	 *        	The text of the label
	 * @return string The HTML code of the label
	 */
	public function labelDangerFunction($text)
	{
		return $this->labelFunction($text, 'danger');
	}

	/**
	 * Returns the HTML code for a info label.
	 * 
	 * @param string $text
	 *        	The text of the label
	 * @return string The HTML code of the label
	 */
	public function labelInfoFunction($text)
	{
		return $this->labelFunction($text, 'info');
	}

	/**
	 * Returns the HTML code for a badge.
	 * 
	 * @param string $text
	 *        	The text of the badge
	 * @return string The HTML code of the badge
	 */
	public function badgeFunction($text)
	{
		return sprintf('<span class="badge">%s</span>', $text);
	}

	/**
	 *
	 * {@inheritDoc} @see Twig_ExtensionInterface::getName()
	 */
	public function getName()
	{
		return 'Sasedev.Commons.Bootstrap.Extension.TwigBasic';
	}
}
