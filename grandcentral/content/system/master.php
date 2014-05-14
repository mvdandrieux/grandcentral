<?php
/**
 * The master class
 * 
 * @package		Core
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
class master
{
	protected $app;
	protected static $content_type;
//	Storing
	protected static $zones;
	
/**
 * Create only one instance of the master
 *
 * @return	object	object master
 * @access	protected
 */
	public function __construct(itemPage $page)
	{
	//	define the master content type
		self::$content_type = (empty($page['type']['content_type'])) ? 'html' : $page['type']['content_type'];
	//	instanciate the app master
		$params['page'] = $page;
		$tpl = (mb_strpos($page['type']['app']['template'], '/') === 0) ? $page['type']['app']['template'] : '/'.$page['type']['app']['template'];
		$this->app = new app($page['type']['app']['app'], $tpl, $params);
	//	retrieve the template root
		$root = $this->app->get_templateroot().$tpl.'.'.$page['type']['content_type'].'.php';
	//	parse the template and parse zones
		self::$zones = self::get_zones($root);
	}
/**
 * Parse a template and extract zones
 *
 * @param	string	root to the tempalte
 * @access	public
 */
	public static function get_zones($root)
	{
	//	on analyse le contenu du template
		$html = (is_file($root)) ? file_get_contents($root) : null;
		$pattern = '/\<!--\s?ZONE\s?:\s?([a-zA-Z0-9_\-|]*)\s?--\>/';
		preg_match_all($pattern, $html, $tmp, PREG_SET_ORDER);
	//	Préparation du tableau de retour
		$zones = array();
		if (!empty($tmp))
		{
			foreach ($tmp as $zone)
			{
				$tmp = explode('|', $zone[1]);
				if (!isset($tmp[1])) $tmp[1] = null;
				$zones[$tmp[0]] = array(
					'key' => $tmp[0],
					'float' => $tmp[1],
					'toreplace' => $zone[0],
					'data' => array()
				);
			}
		}
	//	retour
		return $zones;
	}
	
/**
 * Display the master
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public function __tostring()
	{
	//	Load the master content
		$buffer = $this->app->__tostring();
	//	init vars
		$from = $to = array();
	//	fill the master's zones
		foreach (self::$zones as $zone)
		{
			$from[] = $zone['toreplace'];
			$to[] = $this->_prepare_zone($zone);
		}
		$buffer = str_replace($from, $to, $buffer);
	//	display
		return $buffer;
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone($zone)
	{
	//	zone avec template
		$key = 'zone/'.$zone['key'];
		$file = $this->app->get_templateroot().$key.'.html.php';
		if (is_file($file))
		{
			$param['zone'] = $zone;
			$app = app('content', $key, $param);
			$zone = $app->__tostring();
		}
	//	traitement générique d'une zone : concaténation des contenus
		else
		{
			$method = '_prepare_zone_'.$zone['key'];
			if (method_exists($this, $method))
			{
				$zone = $this->$method($zone);
			}
			else
			{
				$tmp = null;
				foreach ($zone['data'] as $data)
				{
					$tmp .= $data['data'];
				}
				$zone = $tmp;
			}
		}
		return $zone;
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone_css($zone)
	{
		$return = null;
		foreach ($zone['data'] as $css)
		{
		//	pour les fichiers css
			if ($css['type'] == 'file')
			{
				$file = new file($css['url']);
				$data = $file->get();
			//	remplacement des urls
				// $tmp = preg_replace('/url\([\'"]?([^\'"]*)[\'"]?\)/', 'url('.$css['app'].'$1)', $data);
				// $file->set()
			//	url
				$url = (SITE_DEBUG === true) ? $file->get_url(true).'?'.time() : $file->get_url(true);
			//	stylesheet
				$return .= '<link rel="stylesheet" href="'.$url.'"  media="all" type="text/css" charset="utf-8">';
			}
		//	pour les styles bruts
			else
			{
				$return .= '<style type="text/css" media="all">'.$css['data'].'</style>';
			}
		}
		return $return;
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	protected
 */
	protected function _prepare_zone_script($zone)
	{
		$return = null;
		foreach ($zone['data'] as $script)
		{
		//	pour les fichiers css
			if ($script['type'] == 'file')
			{
				if (filter_var($script['url'], FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED))
				{
					$url = $script['url'];
				}
				else
				{
					$file = new file($script['url']);
				//	url
					$url = (SITE_DEBUG === true) ? $file->get_url(true).'?'.time() : $file->get_url(true);
				}
				
			//	stylesheet
				$return .= '<script src="'.$url.'" type="text/javascript" charset="utf-8"></script>';
			}
		//	pour les styles bruts
			else
			{
				$return .= '<script type="text/javascript" charset="utf-8">'.$script['data'].'</script>';
			}
		}
		return $return;
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function bind_file($zone, $app, $file)
	{
		if (isset(self::$zones[$zone]))
		{
		//	recherche de versions précédentes
			$valid = true;
			foreach (self::$zones[$zone]['data'] as $value)
			{
				if (isset($value['url']) && $value['url'] == $file)
				{
					$valid = false;
					break;
				}
			}
			
		//	affectation
			$tmp = array(
				'type' => 'file',
				'url' => $file,
				'app' => $app
			);
			if ($valid) self::$zones[$zone]['data'][] = $tmp;
		}
		else
		{
			trigger_error('Zone <strong>'.$zone.'</strong> does not exists in the master. Try another one.', E_USER_WARNING);
		}
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function bind_code($zone, $code)
	{
		if (isset(self::$zones[$zone]))
		{
			$tmp = array(
				'type' => 'code',
				'data' => $code
			);
			self::$zones[$zone]['data'][] = $tmp;
		}
		else
		{
			trigger_error('Zone <strong>'.$zone.'</strong> does not exists in the master. Try another one.', E_USER_WARNING);
		}
	}
/**
 * 
 *
 * @return	string	la clé de l'app
 * @access	public
 */
	public static function get_content_type()
	{
		return self::$content_type;
	}

}
?>