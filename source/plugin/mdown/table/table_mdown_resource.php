<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class table_mdown_resource extends discuz_table
{
    public function __construct() {
        $this->_table = 'mdown_resource';
        $this->_pk = 'id';
        parent::__construct();
    }
    public function query() {
        $return = array(
            "totalProperty" => 0,
            "root" => array(),
        );
        $cateid= mdown_validate::getNCParameter('cateid','cateid','integer');
        $key   = mdown_validate::getNCParameter('key','key','string');
        $sort  = mdown_validate::getOPParameter('sort','sort','string',1024,'id');
        $dir   = mdown_validate::getOPParameter('dir','dir','string',1024,'DESC');
        $start = mdown_validate::getOPParameter('start','start','integer',1024,0);
        $limit = mdown_validate::getOPParameter('limit','limit','integer',1024,20);
        $where = "a.status=1 AND a.isdel=0";
        if ($cateid>0) $where.=" AND a.cateid='$cateid'";
        if ($key!="") $where.=" AND (a.title like '%$key%')";
        $table = DB::table($this->_table);
        $table_category = DB::table('mdown_category');
        $sql = <<<EOF
SELECT SQL_CALC_FOUND_ROWS 
a.id,a.cateid,b.name as catename,a.title,a.info,a.size,a.icon,a.downnum,a.ctime
FROM $table as a
LEFT JOIN $table_category as b ON a.cateid=b.id
WHERE $where
ORDER BY $sort $dir
LIMIT $start,$limit
EOF;
        $return["root"] = DB::fetch_all($sql);
        $row = DB::fetch_first("SELECT FOUND_ROWS() AS total");
        $return["totalProperty"] = $row["total"];
        foreach ($return['root'] as &$row) {
            $tm = strtotime($row["ctime"]);
            $row["ctime"] = date("Y/m/d H:i",$tm);
            $row['actionUrl'] = $this->getActionUrl($row['id']);
            $row['info'] = $this->getInfoSummary($row['info']);
        }
        return $return;
    }
    public function fetchTop($sort) {
        $cateid  = mdown_validate::getOPParameter('cateid','cateid','integer',0,'0');
        $where = "status=1 AND isdel=0";
        if ($cateid>0) $where = "cateid='$cateid' AND ".$where;
        $table = DB::table($this->_table);
        $sql = <<<EOF
SELECT id,title,icon,downnum,url,urltype
FROM $table
WHERE $where
ORDER BY $sort DESC
LIMIT 10
EOF;
        $res = DB::fetch_all($sql);
        foreach ($res as &$row) {
            unset($row['url']);
            unset($row['urltype']);
            $row["actionUrl"] = $this->getActionUrl($row['id']);
        }
        return $res;
    }
    private function getActionUrl($id) {
        $rscode = C::m('#mdown#mdown_authcode')->encodeID($id);
        return "plugin.php?id=mdown:fetch&rscode=".$rscode;
    }
    private function parseInfo($info) {
        return mdown_parsedown::instance()->text($info);
    }
    private function getInfoSummary($info) {
        $str = $this->parseInfo($info);
        $data = strip_tags($str);
        if (mb_strlen($data, CHARSET)>100) {
            $data = mb_substr($data, 0, 100, CHARSET)."...";
        }
        return $data;
    }
    public function getById($id) {
        $sql = "select * from %t where id=%d AND isdel=0";
        return DB::fetch_first($sql,array($this->_table, $id));
    }
    public function statDownNum($rscId) {
        $sql = "select count(1) as num from ".DB::table('mdown_log')." where rscid='$rscId'";
        $row = DB::fetch_first($sql);
        $data = array (
            'downnum' => $row['num'],
        );
        return $this->update($rscId, $data);
    }
    public function queryByAdmin() {
        $return = array(
            "totalProperty" => 0,
            "root" => array(),
        );
        $state= mdown_validate::getNCParameter('state','state','integer');
        $cateid= mdown_validate::getNCParameter('cateid','cateid','integer');
        $key   = mdown_validate::getNCParameter('key','key','string');
        $sort  = mdown_validate::getOPParameter('sort','sort','string',1024,'id');
        $dir   = mdown_validate::getOPParameter('dir','dir','string',1024,'DESC');
        $start = mdown_validate::getOPParameter('start','start','integer',1024,0);
        $limit = mdown_validate::getOPParameter('limit','limit','integer',1024,20);
        $where = "a.isdel=0";
        if ($state>=0) $where.=" AND a.status='$state'";
        if ($cateid>0) $where.=" AND a.cateid='$cateid'";
        if ($key!="") $where.=" AND (a.title like '%$key%')";
        $table = DB::table($this->_table);
        $table_category = DB::table('mdown_category');
        $sql = <<<EOF
SELECT SQL_CALC_FOUND_ROWS 
a.*,b.name as catename
FROM $table as a
LEFT JOIN $table_category as b ON a.cateid=b.id
WHERE $where
ORDER BY $sort $dir
LIMIT $start,$limit
EOF;
        $return["root"] = DB::fetch_all($sql);
        $row = DB::fetch_first("SELECT FOUND_ROWS() AS total");
        $return["totalProperty"] = $row["total"];
        foreach ($return['root'] as &$row) {
            $tm = strtotime($row["ctime"]);
            $row["ctime"] = date("Y/m/d H:i",$tm);
            $row['actionUrl'] = $this->getActionUrl($row['id']);
            $row['info'] = $this->getInfoSummary($row['info']);
        }
        return $return;
    }
    public function save()
    {
        global $_G;
        $uid = $_G['uid'];
        $id = mdown_validate::getNCParameter('id','id','integer');
        $record = array (
            'cateid' => mdown_validate::getNCParameter('cateid','cateid','integer',1024),
            'title' => mdown_validate::getNCParameter('title','title','string',1024),
            'info' => mdown_validate::getNCParameter('info','info','string',1024),
            'size' => mdown_validate::getNCParameter('size','size','string',1024),
            'icon' => mdown_validate::getNCParameter('icon','icon','string',1024),
            'url' => mdown_validate::getNCParameter('url','url','string',1024),
            'urltype' => mdown_validate::getNCParameter('cateid','cateid','integer'),
            'muid' => $uid,
        );
        if ($id==0) {
            $record['status'] = 0;
            $record['cuid'] = $uid;
            $record['ctime'] = date('Y-m-d H:i:s');
            return $this->insert($record);
        } else {
            return $this->update($id,$record);
        }
    }
    public function remove()
    {
        $id = mdown_validate::getNCParameter('id','id','integer');
        return $this->update($id,array('isdel'=>1));
    }
    public function setStatus()
    {
        $id = mdown_validate::getNCParameter('id','id','integer');
        $status = mdown_validate::getNCParameter('status','status','integer');
        return $this->update($id,array('status'=>$status));
    }
}
?>