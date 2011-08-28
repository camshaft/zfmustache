<?php

/**
 * Zend view engine for Mustache views.
 * 
 * @see {@link http://defunkt.github.com/mustache}
 * @see {@link https://github.com/bobthecow/mustache.php}
 * 
 * @author David Luecke (daff@neyeon.de)
 * @author Cameron Bytheway (bytheway.cameron@gmail.com)
 */
class Mustache_View extends Zend_View_Abstract {

        /**
         * The Mustache engine
         * @var Mustache
         */
        protected $_mustache;

        /**
         * Initialize the Mustache engine
         */
        public function init() {
                $this->_mustache = new Mustache(null, null, null, array('charset' => $this->getEncoding()));
        }

        /**
         * Return the template engine object
         *
         * @return Mustache
         */
        public function getEngine() {
                return $this->_mustache;
        }

        /**
         * Defaults to calling a helper.  If the helper called doesn't exist, 
         * the function will return false
         * 
         * @param string $key
         * @return mixed|false
         */
        public function __get($key) {
                $additionalData = $this->_getAdditionalData($key);
                if ($additionalData !== NULL) {
                        // cache the result
                        $this->$key = $additionalData;
                        return $additionalData;
                }
                else {
                        return $this->__call($key, array());
                }
        }
        
        protected function _getAdditionalData($key) {
                switch ($key) {
                        case 'module':
                                return Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
                                
                                break;
                        case 'controller':
                                return Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
                                
                                break;
                        case 'action':
                                return Zend_Controller_Front::getInstance()->getRequest()->getActionName();
                                
                                break;

                        default:
                                return NULL;
                                break;
                }
        }


        public function __isset($key) {
                $isset = parent::__isset($key);
                if (!$isset) {
                        // Try looking at the dynamic vars / helpers
                        try {
                                return ($this->__get($key) !== FALSE)?TRUE:FALSE;
                        } catch (Exception $exc) {
                                return FALSE;
                        }
                }
                return $isset;
        }
        
        protected function _run() {
                echo $this->_mustache->renderFile(func_get_arg(0), $this);
        }

}
