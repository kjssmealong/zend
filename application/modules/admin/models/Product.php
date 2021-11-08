<?php
class Admin_Model_Product extends Zend_Db_Table
{

  protected $_name = 'product';
  protected $_primary = 'id';

  public function getListItem($arrParam = null, $option = null)
  {
    if ($option['task'] == 'product-list') {
      $result = $this->fetchAll()->toArray();
    }
    return $result;
  }

  public function getListTrash($arrParam = null, $option = null)
  {
    if ($option['task'] == 'product-trash') {
      $where = 'status = 0';
      $result = $this->fetchAll($where)->toArray();
    }
    return $result;
  }

  public function saveItem($arrParam = null, $option = null)
  {
    if ($option['task'] == 'product-add') {
      $row = $this->fetchNew();
      $row->name = $arrParam['name'];
      $row->detail = $arrParam['detail'];
      $row->metadesc = $arrParam['metadesc'];
      $row->metakey = $arrParam['metakey'];
      $row->catid = $arrParam['catid'];
      $row->number = $arrParam['number'];
      $row->price = $arrParam['price'];
      $row->pricesale = $arrParam['pricesale'];
      $row->img = $arrParam['img'];
      $row->status = $arrParam['status'];

      $row->save();
    }

    if ($option['task'] == 'product-edit') {
      $where = 'id = ' . $arrParam['id'];
      $row = $this->fetchRow($where);
      $row->name = $arrParam['name'];
      $row->detail = $arrParam['detail'];
      $row->metadesc = $arrParam['metadesc'];
      $row->metakey = $arrParam['metakey'];
      $row->catid = $arrParam['catid'];
      $row->number = $arrParam['number'];
      $row->price = $arrParam['price'];
      $row->pricesale = $arrParam['pricesale'];
      $row->updated_at = date('Y-m-d H:i:s');
      $row->img = $arrParam['img'];
      $row->status = $arrParam['status'];

      $row->save();
    }

    if ($option['task'] == 'product-delete') {
      $where = 'id = ' . $arrParam['id'];
      $row = $this->fetchRow($where);
      $row->updated_at = date('Y-m-d H:i:s');
      $row->status = 0;
      $row->save();
    }

    if ($option['task'] == 'product-restore') {
      $where = 'id = ' . $arrParam['id'];
      $row = $this->fetchRow($where);
      $row->updated_at = date('Y-m-d H:i:s');
      $row->status = 1;
      $row->save();
    }
  }

  public function editIem($arrParam = null, $option = null){
    if ($option['task'] == 'product-edit' || $option['task'] == 'product-delete' || $option['task'] == 'product-restore' || $option['task'] == 'product-deltrash') {
      $where = 'id = ' . $arrParam['id'];
      $result = $this->fetchRow($where)->toArray();
    }
    return $result;
  }

  public function deleteItem($arrParam = null, $option = null){
    if($option['task'] == 'product-deltrash'){
      $where = 'id = ' . $arrParam['id'];
      $this->delete($where);
    }
  }
}
