<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class table_mdown_category extends discuz_table
{
    public function __construct() {
        $this->_table = 'mdown_category';
        $this->_pk = 'id';
        parent::__construct();
    }
    public function fetchAllByParentyId($parentId) {
        $sql = "SELECT id,name FROM %t WHERE parent_id=%d AND isdel=0 ORDER BY displayorder ASC";
        return DB::fetch_all($sql, array($this->_table, $parentId));
    }
    public function query()
    {
        $return = array(
            "totalProperty" => 0,
            "root" => array(),
        );
        $key   = mdown_validate::getOPParameter('key','key','string',1024,'');
        $sort  = mdown_validate::getOPParameter('sort','sort','string',1024,'displayorder');
        $dir   = mdown_validate::getOPParameter('dir','dir','string',1024,'ASC');
        $start = mdown_validate::getOPParameter('start','start','integer',1024,0);
        $limit = mdown_validate::getOPParameter('limit','limit','integer',1024,20);
        $where = "isdel=0";
        if ($key!="") $where.=" AND (name like '%$key%')";
        $table = DB::table($this->_table);
        $sql = <<<EOF
SELECT SQL_CALC_FOUND_ROWS a.*
FROM $table as a
WHERE $where
ORDER BY $sort $dir
LIMIT $start,$limit
EOF;
        $return["root"] = DB::fetch_all($sql);
        $row = DB::fetch_first("SELECT FOUND_ROWS() AS total");
        $return["totalProperty"] = $row["total"];
        return $return;
    }
    public function save()
    {
        global $_G;
        $uid = $_G['uid'];
        $id = mdown_validate::getNCParameter('id','id','integer');
        $record = array (
            'parent_id' => 0, 
            'name' => mdown_validate::getNCParameter('name','name','string',1024),
            'displayorder' => 0, 
        ); 
        if ($id==0) {
            return $this->insert($record);
        } else {
            return $this->update($id,$record);
        }
    }
    public function remove()
    {
        $id = mdown_validate::getNCParameter('id','id','integer');
		$sql = "select count(1) as num from %t where cateid=%d and isdel=0";
		$row = DB::fetch_first($sql, array('mdown_resource',$id));
		if (!empty($row) && intval($row['num'])>0) {
			throw new Exception("\u8be5\u5206\u7c7b\u4e0b\u6709\u8d44\u6e90\uff0c\u4e0d\u80fd\u5220\u9664");
		}
        return $this->update($id,array('isdel'=>1));
    }
    public function setDisplayorder()
    {
        $id = mdown_validate::getNCParameter('id','id','integer');
        $displayorder = mdown_validate::getNCParameter('displayorder','displayorder','integer');
        return $this->update($id,array('displayorder'=>$displayorder));
    }
    public function getOptions() {
        $sql = "SELECT id as value,name as text FROM %t WHERE parent_id=0 AND isdel=0 ORDER BY displayorder ASC";
        return DB::fetch_all($sql, array($this->_table));
    }
}
?>