<?php 
class Admin_Form_ValidateProduct{

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

        //kiểm tra số lượng
        $validator = new Zend_Validate();
        $validator->addValidator(new Zend_Validate_NotEmpty(), true);

        if(!$validator->isValid($arrParam['number'])){
            $message = $validator->getMessages();
            $this->_messagesError['number']  = 'number ' . current($message);
            $arrParam['number'] = ' ';
        }

        //kiểm tra image
        $upload = new Zend_File_Transfer_Adapter_Http();
        $fileInfo = $upload->getFileInfo('img');
        $fileName = $fileInfo['img']['name'];
        if(!empty($fileName)){            
            $upload->addValidator('Extension', true, array('jpg', 'gif', 'png', 'img'));
            $upload->addValidator('Size', true, array('min'=> '2KB', 'max'=> '1000KB'), 'img');
            if(!$upload->isValid('img')){
                $message = $upload->getMessages();
                $this->_messagesError['img']  = current($message);
            }

        }

        //kiểm tra tye
        $validator = new Zend_Validate();
        $validator->addValidator(new Zend_Validate_NotEmpty(), true);

        if(!$validator->isValid($arrParam['catid'])){
            $message = $validator->getMessages();
            $this->_messagesError['catid']  = 'Category ' . current($message);
            $arrParam['catid'] = '';
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
            print_r($upload_dir . '/' . $this->_arrData['current_product_img']);
        }
        }else{
            if($this->_arrData['action'] == 'edit'){
                $fileName = $this->_arrData['current_product_img'];
            }
        }
        return $fileName;
    }
}