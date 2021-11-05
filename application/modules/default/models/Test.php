<?php
class Default_Model_Test extends Zend_Db_Table
{

    public function getUser()
    {
        $result = $this->select()
            ->from('user');
        return $result;
    }
}
