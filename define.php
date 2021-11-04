<?php
//đường dẫn đến thư mục chưa ứng dụng
defined('APPLICATION_PATH') 
    || define('APPLICATION_PATH', 
        realpath(dirname(__FILE__).'/application'));

//khai báo phân đoạn sử dụng cho ứng dụng
defined('APPLICATION_ENV') 
    || define('APPLICATION_ENV', 
        (getenv("APPLICATION_ENV") ? getenv("APPLICATION_ENV") : 'developer'));

//nạp đường dẫn sử dụng trong ứng dựng
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(__FILE__) . '/library',
    get_include_path(),
)));

//Đường dẫn đến thư mục public
define('PUBLIC_BATH', realpath(dirname(__FILE__) . '/public'));

//Đường dẫn đến thư mực template
define('TEMPLATE_PATH', PUBLIC_BATH . '/templates');
define('TEMPLATE_URL', '/public/templates');