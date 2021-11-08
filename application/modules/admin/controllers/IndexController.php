<?php

class Admin_IndexController extends Mylib_Controller_Action
{


    public function init()
    {
        $auth = new Admin_Form_CheckAuth();
        $auth->auth();
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }

    public function indexAction()
    {

    }


}