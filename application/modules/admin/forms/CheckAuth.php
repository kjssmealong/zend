<?php
class Admin_Form_CheckAuth{

    public function Auth(){
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $info = $auth->getIdentity();
            if ($info->access != 1) {
                echo $this->baseUrl();
                echo '&nbsp'. '<a href="./user">Chuyển đến trang chủ</a>';
                die();
            }
        } else {
            echo "Bạn chưa account";
            echo '&nbsp'. '<a href="./account">Login</a>';
            die();
        }
    }
}