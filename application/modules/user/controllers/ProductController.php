<?php

class ProductController extends Mylib_Controller_Action
{

    public function init()
    {
        $template_path = TEMPLATE_PATH . "/user/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }

    public function indexAction()
    {
        echo '<br' . __METHOD__;
    }
}