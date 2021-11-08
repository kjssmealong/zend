<?php
class ProductController extends Mylib_Controller_Action
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
        $tblProduct = new Default_Model_Product();
        $this->view->Items = $tblProduct->getListItem(null, array('task' => 'product-list'));
    }

    public function trashAction()
    {
        $tblProduct = new Default_Model_Product();
        $this->view->Items = $tblProduct->getListTrash(null, array('task' => 'product-trash'));
    }

    public function addAction()
    {
        $tblCat = new Default_Model_Category();
        $this->view->CatItems = $tblCat->getListItem(null, array('task' => 'category-list'));

        if ($this->_request->isPost()) {
            $validator = new Default_Form_ValidateProduct($this->_arrParam);
            if($validator->isError() == true){
                $this->view->messagesError = $validator->getMessagesError();
                $this->view->Item = $validator->getData();

            }else
            {
                $tblProduct = new Default_Model_Product();
                $arrParam = $validator->getData(array('upload' => true));
                $tblProduct->saveItem($arrParam, array('task' => 'product-add'));
                $this->_redirect($this->_actionMain);
            }
            
        }
    }

    public function uploadAction()
    {
        if ($this->_request->isPost()) {
            $upload = new Mylib_File_Upload();
            $upload->upload('picture',FILE_PATH);
        }
    }

    public function editAction()
    {
        $tblCat = new Default_Model_Category();
        $this->view->CatItems = $tblCat->getListItem(null, array('task' => 'category-list'));

        $tblProduct = new Default_Model_Product();
        $this->view->Item = $tblProduct->editIem($this->_arrParam, array('task' => 'product-edit'));

        if ($this->_request->isPost()) {
            $validator = new Default_Form_ValidateProduct($this->_arrParam);
            if($validator->isError() == true){
                $this->view->messagesError = $validator->getMessagesError();
                $this->view->Item = $validator->getData();

            }else
            {
                $tblProduct = new Default_Model_Product();
                $arrParam = $validator->getData(array('upload' => true));
                $tblProduct->saveItem($arrParam, array('task' => 'product-edit'));
                $this->_redirect($this->_actionMain);
            }

        }
    }

    public function deleteAction()
    {
        $tblProduct = new Default_Model_Product();
        $this->view->Item = $tblProduct->editIem($this->_arrParam, array('task' => 'product-delete'));

        if ($this->_request->isPost()) {
            $tblProduct = new Default_Model_Product();
            $tblProduct->saveItem($this->_arrParam, array('task' => 'product-delete'));
            $this->_redirect($this->_actionMain);
        }
    }

    public function restoreAction()
    {
        $tblProduct = new Default_Model_Product();
        $this->view->Item = $tblProduct->editIem($this->_arrParam, array('task' => 'product-restore'));

        if ($this->_request->isPost()) {
            $tblProduct = new Default_Model_Product();
            $tblProduct->saveItem($this->_arrParam, array('task' => 'product-restore'));
            $this->_redirect($this->_actionMain);
        }
    }

    public function deltrashAction()
    {
        $tblProduct = new Default_Model_Product();
        $this->view->Item = $tblProduct->editIem($this->_arrParam, array('task' => 'product-deltrash'));

        if ($this->_request->isPost()) {
            $tblProduct = new Default_Model_Product();
            $tblProduct->deleteItem($this->_arrParam, array('task' => 'product-deltrash'));
            $this->_redirect($this->_currentController . '/trash');
        }
    }
}
