<?php

class User_Model_Product extends Zend_Db_Table
{

    protected $_name = 'product';
    protected $_primary = 'id';

    public function getListItem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'product-list') {
            $where = "status = 1";
            $result = $this->fetchAll($where)->toArray();
        }
        return $result;
    }

    public function getListCatItem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'product-cat') {
            $where = "catid = " . $arrParam['id'];
            $result = $this->fetchAll($where)->toArray();
        }
        return $result;
    }

    public function getInfo($arrParam = null, $option = null)
    {
        if ($option['task'] == 'product-detail') {
            $where = "id = " . $arrParam['id'];
            $row = $this->fetchRow($where);
        }
        return $row;
    }
}
