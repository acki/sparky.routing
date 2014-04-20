<?php

    class Routing {
    
        private static $headcomment = '
# ROUTING - DO NOT CHANGE!
';
        private static     $content     = '
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !_style*
RewriteRule .? index.php

';
        private static $footcomment = '# ENDROUTING
'; 
    
        public static function enableRouting() {
        
            if(is_file(dire . '.htaccess')) {
            
                $htaccess = file_get_contents(dire . '.htaccess');
                
                if(stristr($htaccess, '# ROUTING - DO NOT CHANGE!')) {
                
                    return false;
                    
                } else {
                
                    $cont = Routing::$headcomment . Routing::$content . Routing::$footcomment;
                
                    $htaccess = file_get_contents(dire . '.htaccess');
                    
                    if(!@file_put_contents(dire . '.htaccess', $htaccess . $cont)) {
                        
                        panic('File access denied. Please give write access to .htaccess file.');
                        
                    }
                
                    return true;
                
                }
                
            }
        
        }
        
        public static function disableRouting() {
        
        }
        
        public static function getRoute() {
	        
	        $rawRoute 	= str_replace(Routing::getBasePath(), '', $_SERVER['REQUEST_URI']);
			$variables	= explode('?', $rawRoute);
			$data		= array();
			
			if(isset($variables[1])) {
				$row = explode('&', $variables[1]);
				foreach($row as $r) {
					$tmp_data = explode('=', $r);
					$data = '';
					if(isset($tmp_data[1]))
						$data = vGET($tmp_data[0]);
					$_SESSION['_spky_data_' . $tmp_data[0]] = $data;
					var_dump($data);
				}
			} 
			
	        $routes 	= explode('/', $variables[0]);
			var_dump($_SESSION);
	        return array_diff( $routes, array( '' ) );
	        
        }
        
        public static function showRoute() {
	        
	        var_dump(Routing::getRoute());
	        
        }
        
        public static function getBasePath() {
	        
	        $baseFolder = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
			return $baseFolder;	        
	        
        }
        
    }
    
?> 