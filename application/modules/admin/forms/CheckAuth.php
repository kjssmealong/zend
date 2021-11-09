<?php
class Admin_Form_CheckAuth{

    public function Auth(){
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $info = $auth->getIdentity();
            if ($info->access != 1) {
                echo "bạn không đủ quyền truy cập";
                echo '&nbsp'. '<a href="/zend/user">Chuyển đến trang chủ</a>';
                die();
            }
        } else {
            echo "Bạn chưa account";
            echo '&nbsp'. '<a href="/zend/account">Login</a>';
            die();
        }
    }
}