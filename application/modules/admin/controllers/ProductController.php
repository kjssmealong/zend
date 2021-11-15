<?php
class Admin_ProductController extends Mylib_Controller_Action
{

    //Mảng tham số nhận được ở mỗi action;
    protected $_arrParam;

    //đường dẫn của controller
    protected $_currentController;


    //đường dẫn action
    protected $_actionMain;

    protected $tblCat;
    protected $tblProduct;

    public function init()
    {
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

        $this->tblCat = new Admin_Model_Category();
        $this->tblProduct = new Admin_Model_Product();
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }

    public function indexAction()
    {
        $this->view->Items = $this->tblProduct->getListItem(null, array('task' => 'product-list'));
    }

    public function trashAction()
    {
        $tblProduct = new Admin_Model_Product();
        $this->view->Items = $tblProduct->getListTrash(null, array('task' => 'product-trash'));
    }

    public function addAction()
    {

        $this->view->CatItems = $this->tblCat->getListItem(null, array('task' => 'category-list'));

        if ($this->_request->isPost()) {
            $validator = new Admin_Form_ValidateProduct($this->_arrParam);
            if($validator->isError() == true){
                $this->view->messagesError = $validator->getMessagesError();
                $this->view->Item = $validator->getData();

            }else
            {
                $tblProduct = new Admin_Model_Product();
                $arrParam = $validator->getData(array('upload' => true));
                $tblProduct->saveItem($arrParam, array('task' => 'product-add'));
                $this->_redirect($this->_actionMain);
            }
            
        }
        else{
            echo "error";
        }
    }

    public function uploadAction()
    {
        if ($this->_request->isPost()) {
            $upload = new Mylib_File_Upload();
            $upload->upload('picture',FILE_PATH);
        }
        else{
            echo "error";
        }
    }

    public function editAction()
    {
        $this->view->CatItems = $this->tblCat->getListItem(null, array('task' => 'category-list'));
        $this->view->Item = $this->tblProduct->editIem($this->_arrParam, array('task' => 'product-edit'));

        if ($this->_request->isPost()) {
            $validator = new Admin_Form_ValidateProduct($this->_arrParam);
            if($validator->isError() == true){
                $this->view->messagesError = $validator->getMessagesError();
                $this->view->Item = $validator->getData();

            }else
            {
                $arrParam = $validator->getData(array('upload' => true));
                $this->tblProduct->saveItem($arrParam, array('task' => 'product-edit'));
                $this->_redirect($this->_actionMain);
            }

        }
        else{
            echo "error";
        }
    }

    public function deleteAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if ($this->_request->isPost()) {
            $this->tblProduct->saveItem($this->_arrParam, array('task' => 'product-delete'));
            echo json_encode($this->_arrParam);
        }
        else{
            echo "error";
        }
    }

    public function restoreAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        if ($this->_request->isPost()) {
            $this->tblProduct->saveItem($this->_arrParam, array('task' => 'product-restore'));
            echo json_encode($this->_arrParam);
        }
        else{
            echo "error";
        }
    }

    public function restoretrashAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        if ($this->_request->isPost()) {
            $this->tblProduct->saveItem($this->_arrParam, array('task' => 'product-restore-trash'));
            echo json_encode($this->_arrParam);
        }
        else{
            echo "error";
            die();
        }
    }

    public function deltrashAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        if ($this->_request->isPost()) {
            $this->tblProduct->deleteItem($this->_arrParam, array('task' => 'product-deltrash'));
            echo json_encode($this->_arrParam);
        }
        else{
            echo "error";
        }
    }
}
