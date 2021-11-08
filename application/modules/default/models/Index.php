<?php
class Default_Model_Index extends Zend_Db_Table_Abstract
{

    public function getUser()
    {
        $result = $this->select()
            ->from('user');
        return $result;
    }
}
