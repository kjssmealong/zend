<?php 
class Mylib_File_Upload extends Zend_File_Transfer{

    public function upload($file_name, $upload_dir, $option = null, $prefix = 'file_'){

        if($option == null){
            $this->setDestination($upload_dir, $file_name);
           
            $info = $this->getFileInfo($file_name);
            $newFileName = $info[$file_name]['name'];
            $this->receive($file_name);
        }

        if($option['task'] == 'rename'){
            $info = $this->getFileName($file_name);
            preg_match('#\.([^\.]+)$#', $info, $matches);
            $fileExtension = $matches[1];
            $newFileName = $prefix . time() . '.' . $fileExtension;

            $option = array('target' => $upload_dir . '/' . $newFileName, 'overwite' => true);
            $this->addFilter('Rename', $option, $file_name);
            $this->receive($file_name);
        }

        return $newFileName;
    }
    public function removeFile($fileName){
        @unlink($fileName);
    }
}