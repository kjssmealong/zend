<?php

class Login_Model_User extends Zend_Db_Table
{

    protected $_name = 'user';

    public function checklogin($arrParam = null, $option = null)
    {




    }

    public function saveItem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'category-add') {
            $row = $this->fetchNew();
            $row->name = $arrParam['name'];
            $row->status = $arrParam['status'];
            $row->save();
        }

        if ($option['task'] == 'category-edit') {
            $where = 'id = ' . $arrParam['id'];
            $row = $this->fetchRow($where);
            $row->name = $arrParam['name'];
            $row->status = $arrParam['status'];
            $row->save();
        }

        if ($option['task'] == 'category-delete') {
            $where = 'id = ' . $arrParam['id'];
            $row = $this->fetchRow($where);
            $row->updated_at = date('Y-m-d H:i:s');
            $row->status = 0;
            $row->save();
        }

        if ($option['task'] == 'category-restore') {
            $where = 'id = ' . $arrParam['id'];
            $row = $this->fetchRow($where);
            $row->updated_at = date('Y-m-d H:i:s');
            $row->status = 1;
            $row->save();
        }
    }

    public function editIem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'category-edit' || $option['task'] == 'category-delete' || $option['task'] == 'category-restore' || $option['task'] == 'category-deltrash') {
            $where = 'id = ' . $arrParam['id'];
            $result = $this->fetchRow($where)->toArray();
        }
        return $result;
    }

    public function deleteItem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'category-deltrash') {
            $where = 'id = ' . $arrParam['id'];
            $this->delete($where);
        }
    }
}
