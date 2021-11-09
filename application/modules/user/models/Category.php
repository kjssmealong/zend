<?php
class User_Model_Category extends Zend_Db_Table
{

  protected $_name = 'category';
  protected $_primary = 'id';

  public function getListItem($arrParam = null, $option = null)
  {
    if ($option['task'] == 'category-list') {
        $where = "status = 1";
      $result = $this->fetchAll($where)->toArray();
    }
    return $result;
  }

}
