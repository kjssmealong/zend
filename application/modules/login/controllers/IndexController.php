<?php

class Login_IndexController extends Mylib_Controller_Action
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
    }


    public function indexAction()
    {
        $db = Zend_Registry::get('connectDb');

        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->_redirect($this->_currentController . '/login');
        } else {
            $authAdapter = new Zend_Auth_Adapter_DbTable($db);

            $authAdapter->setTableName('user')
                ->setIdentityColumn('username')
                ->setCredentialColumn('password');

            $select = $authAdapter->getDbSelect();
            $select->where('status = 1');
            if ($this->_request->isPost()) {


                $encode = new Mylib_Encode();
                $username = $this->_arrParam['username'];
                $password = $encode->password($this->_arrParam['password']);

                $authAdapter->setIdentity($username);
                $authAdapter->setCredential($password);

                $result = $auth->authenticate($authAdapter);
                if (!$result->isValid()) {
                    $error = $result->getMessages();
                    echo '<br>' . current($error);
                } else {
                    echo "login thành công";

                    //lấy thông tin của tài khoản đưa vào ss
                    $omitColums = array('password');
                    $data = $authAdapter->getResultRowObject(null, $omitColums);
                    $auth->getStorage()->write($data);
                    $this->_redirect($this->_currentController . '/login');
                }
            }
        }
    }

    public function loginAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $info = $auth->getIdentity();
            if($info->access == 1){
                $this->_redirect('/admin');
            }
            else{
                $this->_redirect('/user');
            }

        }
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect($this->_actionMain);
    }
}
