<?php
class Default_Model_Index extends Zend_Db_Table
{

    public function getUser()
    {
        $result = $this->select()
            ->from('user');
        return $result;
    }
}
