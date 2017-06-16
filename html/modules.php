<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the submenu style, you would use the following include:
 * <jdoc:include type="module" name="test" style="submenu" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a submenu
 */


function modChrome_no($module, &$params, &$attribs)
{
	if ($module->content)
	{
		echo $module->content;
	}
}

function modChrome_hidden($module, &$params, &$attribs)
{
}

function modChrome_el_html5($module, &$params, &$attribs)
{
	$moduleTag      = $params->get('module_tag', 'div');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass    = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';

	// Temporarily store header class in variable
	$headerClass    = $params->get('header_class');
	$headerClass    = !empty($headerClass) ? ' class="' . htmlspecialchars($headerClass) . '"' : '';

	if (!empty ($module->content))
	{
		if($module->module == "mod_menu")
		{
			$MenClass =  $module->IsActive?"active":"inactive";
		}
		else
		{
			$MenClass = "";
		}
		
		echo '<' . $moduleTag . ' class="moduletable ' . $MenClass . htmlspecialchars($params->get('moduleclass_sfx'))  . $moduleClass .'">';

		if ((bool) $module->showtitle)
		{
			echo '<' . $headerTag . $headerClass . '>' . $module->title . '</' . $headerTag . '>';
		}

		echo $module->content;
		echo '</' . $moduleTag . '>';
	}
}


function modChrome_elfl($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($module->module == "mod_menu")
		{
		echo "<div class=\"" . ($module->IsActive?"active":"inactive") . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		}
		else
		{
		echo "<div class=\"" . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		}
		if ($module->showtitle)
		{
			echo "<h3 class=\"page-header\">" . $module->title . "</h3>";
		}
		echo $module->content;
		echo "</div>";
	}
}

function modChrome_well($module, &$params, &$attribs)
{
	if ($module->content)
	{
		if($module->module == "mod_menu")
		{
			$MenClass =  $module->IsActive?"active":"inactive";
		}
		else
		{
			$MenClass = "";
		}
		echo "<div class=\"well " . $MenClass . htmlspecialchars($params->get('moduleclass_sfx')) . "\">";
		if ($module->showtitle)
		{
			echo "<h3 class=\"page-header\">" . $module->title . "</h3>";
		}
		echo $module->content;
		echo "</div>";
	}
}
?>
