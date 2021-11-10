<?php

class IndexController extends Mylib_Controller_Action
{

    //Mảng tham số nhận được ở mỗi action;
    protected $_arrParam;

    //đường dẫn của controller
    protected $_currentController;


    //đường dẫn action
    protected $_actionMain;

    public function init()
    {
        //Mảng tham số nhận được ở mỗi action
        $this->_arrParam = $this->_request->getParams();
        //Đường dẫn controller
        $this->_currentController = '/' . $this->_arrParam['module'] . '/product/';
        //Đường dẫn của action chính
        $this->_actionMain = '/' . $this->_arrParam['module'] . '/' . $this->_arrParam['controller'] . '/index';
        //Truyền ra view
        $this->view->arrParam = $this->_arrParam;
        $this->view->currentController = $this->_currentController;
        $this->view->actionMain = $this->_actionMain;
        $template_path = TEMPLATE_PATH . "/user/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }

    public function indexAction()
    {
        $tblProduct = new User_Model_Product();
        $this->view->Items = $tblProduct->getListItem(null, array('task' => 'product-list'));
    }
}