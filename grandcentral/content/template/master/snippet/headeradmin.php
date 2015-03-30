<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 *
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('master/css/header.css');
	$_APP->bind_script('master/js/header.js');
	$_APP->bind_css('master/css/tabs.css');
	$_APP->bind_script('master/js/tabs.js');
	$_APP->bind_css('master/css/options.css');
	$_APP->bind_script('master/js/options.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$page = i('page', current, 'admin');
	$sections = $page['section']->unfold();
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : null;

//	For the title
	$current = null;
	$back = null;
	$link = null;
	
	if (i('page', current)['key'] == 'home')
	{
		$invite = '<div class="clapalong">Clap along if you feel like <span>adding</span> a <span>page</span> called <span>something new</span>.</div>';
	}
	else $invite = null;
	
/********************************************************************************************/
//	Remove sections on the fly
/********************************************************************************************/
//	List
	$onlyfor['list'] = array(
		'tree' => array('page'),
	);
	$stripfrom['list'] = array(
		'live' => array('page'),
	);
	
//	Edit
	$onlyfor['edit'] = array(
		'zoning' => array('site', 'version', 'page'),
		'feed' => array('page'),
		'appconfig' => array('app'),
		'appini' => array('app'),
	);
	
//	Add and remove sections
	foreach ($sections as $section)
	{
		if (
		//	Some sections are only for some pages
			(isset($onlyfor[$page['key']->get()][$section['key']->get()]) && !in_array($handled_item, $onlyfor[$page['key']->get()][$section['key']->get()])) OR
		//	Some sections must be striped from some pages
			(isset($stripfrom[$page['key']->get()][$section['key']->get()]) && in_array($handled_item, $stripfrom[$page['key']->get()][$section['key']->get()]))
		) {
		//	Delete relation
			$i = array_search($section->get_nickname(), $page['section']->get());
			unset($sections[$i]);
		}
	}

/********************************************************************************************/
//	Fetch the altered sections
/********************************************************************************************/
//	Find the default section
	if (!$page['sectiondefault']->is_empty())
	{
		foreach ($page['sectiondefault']->unfold() as $key => $default)
		{
			foreach ($sections as $key => $section)
			{
				if ($section['key'] == $default['key'])
				{
					$defaultSection = $default['key'];
					break;
				}
			}
		}
	}
?>