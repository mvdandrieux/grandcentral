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
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('/css/app.css');
	$_APP->bind_script('/js/app.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	For easier access
	$_FIELD = $_PARAM['field'];
//	The stores values
	$value = $_FIELD->get_value();
//	List of the apps
	$apps = registry::get(registry::app_index);
	
/********************************************************************************************/
//	Build the app list
/********************************************************************************************/
	foreach ($apps as $app)
	{
		$about = $app->get_ini('about');
		$values[$app->get_key()] = $about['title'];
	}
//	sort
	natcasesort($values);
//	field
	$p = array(
		'placeholder' => '...',
		'values' => $values,
		'valuestype' => 'array'
	);
	$field = new fieldSelect($_FIELD->get_name().'[app]', $p);
	
//	Give the configure button the template name
	$cfgButtonLabel = (isset($value['template']) & !empty($value['template'])) ? $value['template'] : 'Configure';
	
/********************************************************************************************/
//	Autoload values
/********************************************************************************************/
//	app
	if (isset($value['app']) && !empty($value['app'])) $field->set_value($value['app']);
//	template
	$template = (isset($value['template']) & !empty($value['template'])) ? $value['template'] : null;
//	param
	$param = (isset($value['param']) & !empty($value['param'])) ? htmlspecialchars(json_encode($value['param']), ENT_COMPAT, 'UTF-8') : null;
?>