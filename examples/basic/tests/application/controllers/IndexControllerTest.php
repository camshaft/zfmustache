<?php

class IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase {

        public function setUp() {
                $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
                parent::setUp();
        }

        public function testIndexAction() {
                $params = array('action' => 'index', 'controller' => 'index', 'module' => 'default');
                $urlParams = $this->urlizeOptions($params);
                $url = $this->url($urlParams);
                $this->dispatch($url);

                // assertions
                $this->assertModule($urlParams['module']);
                $this->assertController($urlParams['controller']);
                $this->assertAction($urlParams['action']);
                $this->assertQueryContentContains("section#url", $urlParams['module'] . '/' . $urlParams['controller'] . '/' . $urlParams['action']);
                $this->assertQueryContentContains('section h1', 'This is the title');
                $this->assertQueryContentContains('section p', 'This is the description');
                $this->assertQueryContentContains('section div p', 'First content');
        }

}
