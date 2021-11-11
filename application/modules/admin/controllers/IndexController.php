<?php

class Admin_IndexController extends Mylib_Controller_Action
{

    //Mảng tham số nhận được ở mỗi action;
    protected $_arrParam;

    //đường dẫn của controller
    protected $_currentController;


    //đường dẫn action
    protected $_actionMain;

    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $info = $auth->getIdentity();

            if ($info->access != 1) {
                echo "Bạn không có quyền truy cập";
                echo '&nbsp'. '<a href="/zend/user">Chuyển đến trang chủ</a>';
                die();
            }
        } else {
            $this->_redirect($this->_currentController . 'admin/login');
        }

        //Mảng tham số nhận được ở mỗi action
        $this->_arrParam = $this->_request->getParams();
        //Đường dẫn controller
        $this->_currentController = '/' . $this->_arrParam['module'] . '/' . $this->_arrParam['controller'];
        //Đường dẫn của action chính
        $this->_actionMain = '/' . $this->_arrParam['module'] . '/' . $this->_arrParam['controller'] . '/index';
        //Truyền ra view
        $this->view->arrParam = $this->_arrParam;
        $this->view->currentController = $this->_currentController;
        $this->view->actionMain = $this->_actionMain;

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');

    }

    public function indexAction()
    {

    }

    public function infoAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
        $login = Zend_Auth::getInstance();
        if ($login->hasIdentity()) {
            $info = $login->getIdentity();
            $this->view->login = $info;
        }
    }


}