<?php
/**
 * Integer formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://grandcentral.fr
 */
class attrBool extends _attrs
{
/**
 * Set attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (bool) $data;
		return $this;
	}
/**
 * xxxx
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
		return ($this->data === true) ? 'true' : 'false';
	}
/**
 * Definition mysql
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function mysql_definition()
	{
	//	definition
		$definition = '`'.$this->params['key'].'` tinyint(1) NOT NULL';
	//	retour
		return $definition;
	}
	
/**
 * Default field attributes for Bool	
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public static function get_properties()
	{
	//	Start with the default for all properties
		$params = parent::get_properties();
	//	Somes specifics for this attr
		# $params['somefield'] = array();
		# unset($param['somefield'])
	//	Return
		return $params;
	}
}
?>