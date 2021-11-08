<?php
class Mylib_System_Auth{

    public function login($arrParam, $option = null){

        $db = Zend_Registry::get('connectDb');

        $auth = Zend_Auth::getInstance();
        $authAdapter = new Zend_Auth_Adapter_DbTable($db);

        $authAdapter->setTableName('user')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password');

        $select = $authAdapter->getDbSelect();
        $select->where('status = 1');

        $encode = new Mylib_Encode();
        $username = $arrParam['username'];
        $password = $encode->password($arrParam['password']);

        $authAdapter->setIdentity($username);
        $authAdapter->setCredential($password);

        $result = $auth->authenticate($authAdapter);

        if (!$result->isValid()) {
            $error = $result->getMessages();
            $messageError = current($error);
        } else {
            //lấy thông tin của tài khoản đưa vào ss
            $omitColums = array('password');
            $data = $authAdapter->getResultRowObject(null, $omitColums);
            $auth->getStorage()->write($data);
        }

        return $messageError;
    }

    public function logout($arrParam = null, $option = null){
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
    }
}