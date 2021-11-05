<?php
class IndexController extends Mylib_Controller_Action{

    public function init(){
        parent::init();
    }

    public function indexAction(){
       $tblUser = new Default_Model_Test();
       $rows = $tblUser->getUser();
    }

    public function viewAction(){

    }

}