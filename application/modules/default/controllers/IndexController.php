<?php
class IndexController extends Mylib_Controller_Action{

    public function init(){
        parent::init();
    }

    public function indexAction(){
        $db = Zend_Registry::get('connectDb');
        //select
        $rows = $db->fetchAll('SELECT * FROM user');

        echo $mode = Zend_Db::FETCH_ASSOC;
        $db->setFetchMode($mode);
//        echo '<pre>';
//        print_r($db);
//        echo '</pre>';
    }

    public function viewAction(){
        echo '<br' . __METHOD__;
    }

}