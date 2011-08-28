<?php

class Mustache_Application_Resource_Mustache extends Zend_Application_Resource_ResourceAbstract {

        /**
         * (non-PHPdoc)
         * @see Zend_Application_Resource_Resource::init()
         * @return Mustache_View
         */
        public function init() {
                $options = $this->mergeOptions(array(
                            'basePath' => APPLICATION_PATH . '/views',
                            'partialPath' => NULL,
                            'suffix' => 'mustache',
                            'enabled' => true),
                    $this->getOptions()
                );
                extract($options); // $basePath, $partialPath, $suffix, $enabled
                $view = new Mustache_View();
                $view->setBasePath($basePath);
                $engine = $view->getEngine();
                if ($partialPath !== NULL) {
                        if (is_array($partialPath)) {
                                foreach ($partialPath as $path) {
                                        $engine->addPartialDirectory($path);
                                }
                        }
                        else {
                                $engine->addPartialDirectory($partialPath);
                        }
                }
                if ($enabled) {
                        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
                        $viewRenderer->setView($view)->setViewSuffix($suffix);
                        $layout = Zend_Layout::getMvcInstance();
                        if ($layout !== NULL) {
                                $layout->setViewSuffix($suffix);
                        }
                }
                return $view;
        }

}