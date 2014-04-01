<?php

    class Routing {
    
        private static $headcomment = '
# ROUTING - DO NOT CHANGE!
';
        private static     $content     = '
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !/content/*
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
        
    }
    
?> 