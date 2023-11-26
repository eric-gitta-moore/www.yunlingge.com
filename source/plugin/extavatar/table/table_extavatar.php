<?php
if (!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class table_extavatar extends discuz_table
{
    public function __construct() {
		$this->_table = 'extavatar';
		$this->_pk = 'id';
		parent::__construct();
	}
    public function getMaxId() {
        $res = DB::fetch_first("SELECT max(id) as maxid FROM %t", array($this->_table));
        return empty($res) ? 0 : intval($res['maxid']);
    }
    public function getAvatarByUid($uid)
    {
        $maxid = $this->getMaxId();
        $maxv = ($uid % $maxid)+1;
        $sql = <<<EOF
SELECT id, imgurl_small as small, imgurl_middle as middle, imgurl_big as big
FROM %t
WHERE id<=%d AND enable=1 AND isdel=0
ORDER BY id DESC
LIMIT 1;
EOF;
        return DB::fetch_first($sql, array($this->_table, $maxv));
    }
}
?>