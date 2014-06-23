<?php
/**
 * String formated attributes handling class
 *
 * @package 	Core
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class attrSirtrevor extends _attrs implements ArrayAccess
{	
/**
 * Set array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function set($data)
	{
		$this->data = (string) $data;
		return $this;
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
		$definition = '`'.$this->params['key'].'` mediumtext CHARACTER SET '.database::charset.' COLLATE '.database::collation.' NOT NULL';
	//	retour
		return $definition;
	}
	
/**
 * Turn nicknames into links
 *
 * @return	string	la définition mysql
 * @access	public
 */
	public function read_links()
	{
	
	//	retour
		return $text;
	}
	
/**
 * Get array attribute
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function __toString()
	{
	//	Some vars
		$return = '';
		
		if ($this->get())
		{
		//	Decode json stored as a string
			$json = json_decode($this->get(), true);
		//	Instanciate a new Parsedown object
			$Parsedown = new Parsedown();
			$Parsedown->setBreaksEnabled(true);
		
		//	Loop through blocks
			foreach ($json['data'] as $block)
			{	
			//	Decode
				foreach ($block['data'] as $key => $value)
				{
				//	Build GC urls
				// $block['data'][$key] = str_replace('[page_1]', 'http://www.google.com', $block['data'][$key]);
				}
				
			//	HTML formatting
				switch ($block['type'])
				{
				//	Text
					case 'text':
					//	Return
					//	$return .= str_replace("\n", '</p><p>', $block['data']['text']);
						$return .= $Parsedown->text($block['data']['text']);
						break;
						
				//	Heading
					case 'heading':
					//	Return
						$text = $Parsedown->text($block['data']['text']);
						$return .= '<h2>'.str_replace(array('<p>', '</p>'),array('', '<br/>'), $text).'</h2>';
						break;
						
				//	List
					case 'list':
					//	Return
						$text = $Parsedown->text($block['data']['text']);
						$return .= str_replace(array('<p>', '</p>'),array('', ''), $text);
						break;
						
				//	Quote
					case 'quote':
					//	Return
						$text = $Parsedown->text($block['data']['text']);
						// $cite = $Parsedown->text($block['data']['cite']);
						$return .= '<blockquote>'.$text.'<cite>'.$block['data']['cite'].'</cite></blockquote>';
						break;
						
				//	Image-Gc
					case 'imagegc':
					//	Return
						$return .= media($block['data']['data[url]']);
						break;
						
				//	Break
					case 'break':
						$return .= '<hr />';
						break;
				}
			}
		}
		
	//	Return
		return $return;
	}

/**
 * ArrayAccess Interface methods
 *
 * @param	string	la variable
 * @return	string	une string
 * @access	public
 */
	public function offsetSet($offset, $value)
	{
		if (is_null($offset)) $this->data[] = $value;
		else $this->data[$offset] = $value;
	}
	public function offsetExists($offset)
	{
		return isset($this->data[$offset]);
	}
	public function offsetUnset($offset)
	{
		unset($this->data[$offset]);
	}
	public function offsetGet($offset)
	{
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
	}
	
/**
 * Default field attributes for Array	
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
	/*
		$params['blockTypes'] = array();
		$params['defaultType'] = array();
		$params['blockLimit'] = array();
		$params['blockTypeLimits'] = array();
		$params['onEditorRender'] = array();
	*/
	//	Return
		return $params;
	}
}
?>