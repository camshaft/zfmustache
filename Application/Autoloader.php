<?php

/**
 * Implements a global autoloader for loading the Mustache and MustacheException class,
 * so that the original engine files don't need to be modified.
 * 
 * @author David Luecke (daff@neyeon.de)
 * @author Cameron Bytheway (bytheway.cameron@gmail.com)
 */
class Mustache_Application_Autoloader implements Zend_Loader_Autoloader_Interface {

        public function autoload($class) {
                if ($class == 'Mustache' || $class == 'MustacheException') {
                        require dirname(__FILE__) . '/../vendor/mustache/Mustache.php';
                }
        }

}