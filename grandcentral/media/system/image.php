<?php
/**
 * The group item of Grand Central
 * 
 * @package		Core
 * @author		Sylvain Frigui <sf@hands.agency>
 * @access		public
 * @link		http://grandcentral.fr
 */
class image extends media
{
	protected $width;
	protected $height;

/**
 * Obtenir, s'il existe, le contenu du fichier
 *
 * @return	string	le contenu du fichier
 * @access	public
 */
	public function get()
	{
		if ($this->exists() && empty($this->data))
		{
			$info = getimagesize($this->root);
			$this->mime = $info[2];
			$this->width = $info[0];
			$this->height = $info[1];
		
			if ($this->mime == IMAGETYPE_JPEG)
			{
			   $this->data = imagecreatefromjpeg($this->root);
			}
			elseif ($this->mime == IMAGETYPE_GIF)
			{
				$this->data = imagecreatefromgif($this->root);
			}
			elseif ($this->mime == IMAGETYPE_PNG)
			{
				$this->data = imagecreatefrompng($this->root);
			}
		}
		return $this->data;
	}

/**
 * Sauvegarder une image
 *
 * @param	bool	créer le répertoire du fichier si celui-ci n'existe pas. "false" par défaut.
 * @access	public
 */
	public function save($mkdir = false, $chmod = 0755, $quality = 100)
	{
		if (!is_dir($this->dir) && $mkdir === true) mkdir($this->dir, $chmod, true);
		
		if($this->get_mime() == IMAGETYPE_JPEG)
		{
			imagejpeg($this->data, $this->root, $quality);
      	}
		elseif( $this->get_mime() == IMAGETYPE_GIF )
		{
 			imagegif($this->data, $this->root);
      	}
		elseif($this->get_mime() == IMAGETYPE_PNG)
		{
 			imagepng($this->data, $this->root);
		}
		
		// chmod($this->root, $chmod);
	}

/**
 * Retourne la hauteur de l'image
 *
 * @access	public
 */
	public function get_height()
	{
		if ($this->exists() && empty($this->height))
		{
			$tmp = getimagesize($this->root);
			$this->width = $tmp[0];
			$this->height = $tmp[1];
		}
		return $this->height;
	}
	
/**
 * Retourne la largeur de l'image
 *
 * @access	public
 */
	public function get_width()
	{
		if ($this->exists() && empty($this->height))
		{
			$tmp = getimagesize($this->root);
			$this->width = $tmp[0];
			$this->height = $tmp[1];
		}
		return $this->width;
	}
	
/**
 * Retourne le chemin vers le thumbnail
 *
 * @access	public
 */
	public function thumbnail($width, $height, $quality = 100)
	{
		$app = app('cache');
		$file = $app->get_templateroot('site').'/media/thumbnail_w'.$width.'_h'.$height.$this->get_path();
		
		if (!is_dir($file))
		{
			$thumb = new image($file);
		//	création du thumbnail
			if (!$thumb->exists() || $thumb->get_created() < $this->get_created())
			{
				$this->copy($thumb->get_dir());
				$thumb = new image($file);
				$thumb->resize($width, $height, true);
				$thumb->save(true);
			}
		//	Return
			return $thumb;
		}
	}
    
    public function crop($width, $height)
    {
        $app = app('cache');
        $root = $app->get_templateroot('site').'/media/square_w'.$width.'_h'.$height;
        
        $file = $root.'/'.$this->get_key();    
        if (!is_dir($file))
        {
            $thumb = new image($file);
        //    création du thumbnail
            if (!$thumb->exists() || $thumb->get_created() < $this->get_created())
            {
                $this->copy($root);
                $thumb = new image($root.'/'.$this->get_key());
                
                if($this->get_width()>$this->get_height())
                    $thumb->resize(0,$height, true);
                else
                    $thumb->resize($width,0, true);
                
                
                $thumb->_crop($width,$height,$width,$height);
                $thumb->save(true);
                
            }
        //    Return
            return $thumb;
        }
    }

	public function square($width)
    {
        $app = app('cache');
        $root = $app->get_templateroot('site').'/media/square_w'.$width;
        
        $file = $root.'/'.$this->get_key();    
        if (!is_dir($file))
        {
            $thumb = new image($file);
        //    création du thumbnail
            if (!$thumb->exists() || $thumb->get_created() < $this->get_created())
            {
                $this->copy($root);
                $thumb = new image($root.'/'.$this->get_key());
                
                if($this->get_width()>$this->get_height())
                    $thumb->resize(0,$width, true);
                else
                    $thumb->resize($width,0, true);
                
                
                $thumb->_crop($width,$width,$width,$width);
                $thumb->save(true);
                
            }
        //    Return
            return $thumb;
        }
    }
	
    private function _crop($src_w,$src_h,$dst_w,$dst_h,$src_x=false,$src_y=false)
    {
        
        $format = $this->get_width()/$this->get_height();
        if($src_x===FALSE && $src_y===FALSE){
            if($format >= 1 ){
               
                $dims = $this->calculate_dimensions(0,$dst_h);
                $src_x = round(($dims['width'] - $src_w) / 2);
                $src_y = 0;
            }
            else
            {
                $dims = $this->calculate_dimensions($dst_w,0);
                $src_y = round(( $dims['height'] - $src_h ) / 2);
                $src_x = 0;
            }    
        }
        
        
        $new_image = $this->make_image( 0,0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
        
        $this->data = $new_image;
        unset($new_image);
        return $this;    
    }
    
    private function calculate_dimensions($width,$height,$keep_proportions = true){
    //    si on ne reçoit que la largeur
        if (empty($height))
        {
            $ratio = $width / $this->get_width();
            $height = $this->get_height() * $ratio;
        }
    //    si on ne reçoit que la hauteur
        if (empty($width))
        {
            $ratio = $height / $this->get_height();
            $width = $this->get_width() * $ratio;
        }    
    //    si on souhaite garder les proportions de l'image
        if ($keep_proportions === true)
        {
            // print '<pre>original ratio : ';print_r($this->get_width()/$this->get_height());print'</pre>';
            // print '<pre>new ratio : ';print_r($width/$height);print'</pre>';
            if ($this->get_width() / $this->get_height() >= $width/$height) $height = 0;
            else $width = 0;
            
            if ($width == 0) $width = $height / $this->get_height() * $this->get_width();
            if ($height == 0) $height = $width / $this->get_width() * $this->get_height();
        }
        return array('width'=>$width,'height'=>$height);
    }
/**
 * Redimensionne une image
 * 
 * http://www.white-hat-web-design.co.uk/blog/retaining-transparency-with-php-image-resizing/
 *
 * @access	public
 */
	public function resize($width, $height, $keep_proportions = true)
	{
		set_time_limit(10);
		
		if (!$this->exists() || (empty($width) && empty($height))) return $this;
		$this->get();
	    
        $dimensions = $this->calculate_dimensions($width, $height, $keep_proportions);
        $width = $dimensions['width'];
        $height = $dimensions['height'];
        
		// print '<pre>width / original : '.$this->get_width().' / new : ';print_r($width);print'</pre>';
		// print '<pre>height / original : '.$this->get_height().' / new : ';print_r($height);print'</pre>';
		
		$new_image = $this->make_image( 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
		//var_dump('here',$new_image);die;
		$this->data = $new_image;
		unset($new_image);
		return $this;
	}

    private function make_image($dst_x,$dst_y,$src_x,$src_y,$dst_w,$dst_h,$src_w,$src_h){
        $new_image = imagecreatetruecolor($dst_w, $dst_h);
        
        if ($this->mime == IMAGETYPE_GIF || $this->mime == IMAGETYPE_PNG)
        {
            $current_transparent = imagecolortransparent($this->data);
            if($current_transparent != -1)
            {
                $transparent_color = imagecolorsforindex($this->data, $current_transparent);
                $current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($new_image, 0, 0, $current_transparent);
                imagecolortransparent($new_image, $current_transparent);
            }
            elseif( $this->mime == IMAGETYPE_PNG)
            {
                imagealphablending($new_image, false);
                $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagefill($new_image, 0, 0, $color);
                imagesavealpha($new_image, true);
            }
        }
        
        imagecopyresampled($new_image, $this->data, $dst_x,$dst_y,$src_x,$src_y,$dst_w,$dst_h,$src_w,$src_h);
        
        return $new_image; 
    }
	/**
	 * Prints the image in a <img tag>
	 *
	 * @access	public
	 */
		public function __tostring()
		{
			return '<img src="'.$this->get_url().'" />';
		}
}
?>