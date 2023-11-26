<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
class table_mdown_log extends discuz_table
{
    public function __construct() {
        $this->_table = 'mdown_log';
        $this->_pk = 'id';
        parent::__construct();
    }
    public function write($rscid, $rsctitle, $credits=0, $extinfo="") {
        global $_G;
        $uid = $_G['uid'];
        $clientip = $_G['clientip'];
        $downtime = date("Y-m-d H:i:s");
        $table = DB::table($this->_table);
        $sql = <<<EOF
insert into $table (`rscid`,`rsctitle`,`uid`,`credits`,`clientip`,`downtime`,`extinfo`) VALUES 
('$rscid','$rsctitle','$uid','$credits','$clientip','$downtime','$extinfo')
EOF;
        return DB::query($sql);
    }
    public function getByUK($rscid, $uid) {
        $sql = "select * from %t where rscid=%d and uid=%d";
        return DB::fetch_first($sql, array($this->_table, $rscid, $uid));
    }
    public function query() {
        $return = array(
            "totalProperty" => 0,
            "root" => array(),
        );
        $sday  = mdown_validate::getNCParameter('sday','sday','string');
        $eday  = mdown_validate::getNCParameter('eday','eday','string');
        $key   = mdown_validate::getNCParameter('key','key','string');
        $sort  = mdown_validate::getOPParameter('sort','sort','string',1024,'downtime');
        $dir   = mdown_validate::getOPParameter('dir','dir','string',1024,'DESC');
        $start = mdown_validate::getOPParameter('start','start','integer',1024,0);
        $limit = mdown_validate::getOPParameter('limit','limit','integer',1024,20);
        $where = "date(downtime) BETWEEN date('$sday') AND date('$eday')";
        if ($key!="") $where.=" AND (rsctitle like '%$key%' OR b.username='$key')";
        $table_mdown_log = DB::table($this->_table);
        $table_common_member = DB::table('common_member');
        $sql = <<<EOF
SELECT SQL_CALC_FOUND_ROWS a.*,b.username,b.email
FROM $table_mdown_log as a LEFT JOIN $table_common_member as b ON a.uid=b.uid
WHERE $where ORDER BY $sort $dir LIMIT $start,$limit
EOF;
        $return["root"] = DB::fetch_all($sql);
        $row = DB::fetch_first("SELECT FOUND_ROWS() AS total");
        $return["totalProperty"] = $row["total"];
        return $return;
    }
}
?>