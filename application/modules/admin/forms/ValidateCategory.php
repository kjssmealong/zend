<?php
class Admin_Form_ValidateCategory{

    //Thuộc tính chứa thông báo lỗi
    protected $_messagesError = null;

    //Mảng chứa dữ liệu chưa validate
    protected $_arrData;

    public function __construct($arrParam = array(), $option = null){

        //kiểm tra name

        $validator = new Zend_Validate();
        $validator->addValidator(new Zend_Validate_NotEmpty(), true)->addValidator(new Zend_Validate_StringLength(3,32), true);

        if(!$validator->isValid($arrParam['name'])){
            $message = $validator->getMessages();
            $this->_messagesError['name']  = 'Name ' . current($message);
            $arrParam['name'] = ' ';
        }
        //truyền giá trị vào arrayData
        $this->_arrData = $arrParam;
    }

    //Kiểm tra Error
    public function isError(){
        if($this->_messagesError != null){
            return true;
        }else{
            return false;
        }
    }

    //Trả về mảng các lỗi
    public function getMessagesError(){
        return $this->_messagesError;
    }

    //Trả về mảng dữ liệu sau khi validate
    public function getData($option = null){
        if($option['upload'] == true){
            $this->_arrData['img'] =  $this->uploadFile();
        }
        return $this->_arrData;
    }

    public function uploadFile(){
        $upload_dir = FILE_PATH;
        $upload = new Mylib_File_Upload();
        $fileInfo = $upload->getFileInfo('img');
        $fileName = $fileInfo['img']['name'];
        if(!empty($fileName)){
            $fileName = $upload->upload('img', $upload_dir, array('task' => 'rename'), 'product_');
            if($this->_arrData['action'] == 'edit'){
                $upload->removeFile($upload_dir . '/' . $this->_arrData['current_product_img']);
            }
        }else{
            if($this->_arrData['action'] == 'edit'){
                $fileName = $this->_arrData['current_product_img'];
            }
        }
        return $fileName;
    }
}