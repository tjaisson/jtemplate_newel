<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


$module->IsActive = false;
$idsToItem_el = array();


foreach ($list as $i => &$item)
{
	$idsToItem_el[$item->id] = $item;
	if ($item->type == 'alias')
		$aliasToId = $item->params->get('aliasoptions');
	else
		$aliasToId = $item->id;
	if ($aliasToId == $active_id)
	{
		$module->IsActive = true;
		$item->IsCurrent = true;
		$item->IsActive = true;
		$arr_length = count($item->tree)-1;
		for ($i = 0; $i < $arr_length ;$i++)
		{
			$idsToItem_el[$item->tree[$i]]->IsActive = true;
		}
	}
	else
	{
		$item->IsCurrent = false;
		$item->IsActive = false;
	}
}

?>

<ul class="nav menu<?php echo ($module->IsActive?" active":" inactive") . $class_sfx; ?>"<?php
	$tag = '';
	if ($params->get('tag_id') != null)
	{
		$tag = $params->get('tag_id') . '';
		echo ' id="' . $tag . '"';
	}
?>>
<?php
foreach ($list as $i => &$item)
{
	$class = $item->IsActive?"active":"inactive";
	if ($item->IsCurrent)
		$class .= ' current';
		
	if ($item->type == 'separator')
	{
		$class .= ' divider';
	}
	
	if($item->anchor_css) $class .= ' ' . $item->anchor_css; 

	$class = ' class="' . trim($class) . '"';

	echo '<li' . $class . '>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
		case 'heading':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="' . (($item->IsActive && (!$item->IsCurrent))?"active":"inactive") . '">';
	}
	elseif ($item->shallower)
	{
		// The next item is shallower.
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	else
	{
		// The next item is on the same level.
		echo '</li>';
	}
}
?></ul>
