<?php

class Admin_Model_Category extends Zend_Db_Table
{

    protected $_name = 'category';
    protected $_primary = 'id';

    public function getListItem($arrParam = null, $option = null)
    {
        if ($option['task'] == 'category-list') {
            $where = 'is_delete = 0';
            $result = $this->fetchAll($where)->toArray();
        }
        return $result;
    }

    public function getListTrash($arrParam = null, $option = null)
    {
        if ($option['task'] == 'category-trash') {
            $where = 'is_delete = 1';
            $result = $this->fetchAll($where)->toArray();
        }
        return $result;
    }

    public function saveItem($arrParam = null, $option = null)
    {
        $where = 'id = ' . $arrParam['id'];
        if ($option['task'] == 'category-add') {
            $row = $this->fetchNew();
            $row->name = $arrParam['name'];
            $row->status = $arrParam['status'];
            $row->save();
        }

        if ($option['task'] == 'category-edit') {
            $row = $this->fetchRow($where);
            $row->name = $arrParam['name'];
            $row->status = $arrParam['status'];
            $row->save();
        }

        if ($option['task'] == 'category-delete') {
            $row = $this->fetchRow($where);
            $row->updated_at = date('Y-m-d H:i:s');
            $row->is_delete = 1;
            $row->save();
        }

        if ($option['task'] == 'category-restore') {
            $row = $this->fetchRow($where);
            $row->updated_at = date('Y-m-d H:i:s');
            $row->status = (!$arrParam['status']);
            $row->save();
        }
        if ($option['task'] == 'category-restore-trash') {
            $row = $this->fetchRow($where);
            $row->updated_at = date('Y-m-d H:i:s');
            $row->is_delete = 0;
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
