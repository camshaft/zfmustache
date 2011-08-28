<?php

class IndexController extends Zend_Controller_Action {

        public function init() {
                /* Initialize action controller here */
        }

        public function indexAction() {
                $model = new stdClass();
                $model->title = 'This is the title';
                $model->description = 'This is the description';
                $model->content = array('First content', 'Second content');
                
                $this->view->model = $model;
        }

}

