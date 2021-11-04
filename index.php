<?php 
require_once'define.php';

//Gọi lớp zend application
require_once 'Zend/Application.php';

$enviroment = APPLICATION_ENV;
$option = APPLICATION_PATH . '/configs/application.ini';
$application = new Zend_Application($enviroment, $option);
$application->bootstrap()->run();

