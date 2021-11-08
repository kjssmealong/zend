<?php
class Admin_CategoryController extends Mylib_Controller_Action{

    //Mảng tham số nhận được ở mỗi action;
    protected $_arrParam;

    //đường dẫn của controller
    protected $_currentController;


    //đường dẫn action
    protected $_actionMain;


    public function init(){
        $auth = new Admin_Form_CheckAuth();
        $auth->auth();
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

    public function indexAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Items = $tblCategory->getListItem(null , array('task'=>'category-list'));
    }

    public function trashAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Items = $tblCategory->getListTrash(null , array('task'=>'category-trash'));
    }

    public function addAction(){
        if($this->_request->isPost()){
            $tblCategory = new Admin_Model_Category();
            $tblCategory->saveItem($this->_arrParam, array('task'=>'category-add'));

            $this->_redirect($this->_actionMain);
        }
    }

    public function editAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Item = $tblCategory->editIem($this->_arrParam , array('task'=>'category-edit'));

        if($this->_request->isPost()){
            $tblCategory = new Admin_Model_Category();
            $tblCategory->saveItem($this->_arrParam, array('task'=>'category-edit'));
            $this->_redirect($this->_actionMain);
        }
    }

    public function deleteAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Item = $tblCategory->editIem($this->_arrParam , array('task'=>'category-delete'));

        if($this->_request->isPost()){
            $tblCategory = new Admin_Model_Category();
            $tblCategory->saveItem($this->_arrParam, array('task'=>'category-delete'));
            $this->_redirect($this->_actionMain);
        }
    }

    public function restoreAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Item = $tblCategory->editIem($this->_arrParam , array('task'=>'category-restore'));

        if($this->_request->isPost()){
            $tblCategory = new Admin_Model_Category();
            $tblCategory->saveItem($this->_arrParam, array('task'=>'category-restore'));
            $this->_redirect($this->_actionMain);

        }
    }

    public function deltrashAction(){
        $tblCategory = new Admin_Model_Category();
        $this->view->Item = $tblCategory->editIem($this->_arrParam , array('task'=>'category-deltrash'));

        if($this->_request->isPost()){
            $tblCategory = new Admin_Model_Category();
            $tblCategory->deleteItem($this->_arrParam, array('task'=>'category-deltrash'));
            $this->_redirect($this->_currentController . '/trash');
        }
    }

}