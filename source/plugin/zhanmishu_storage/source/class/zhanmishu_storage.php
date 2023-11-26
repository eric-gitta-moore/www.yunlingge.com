<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc && plugin by zhanmishu.
 *      Dz盒子www.idzbox.com, use is subject to license terms
 *
 *      Author: zhanmishu.com $
 *    	qq:87883395 $
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}



class zhanmishu_storage{
	
	public $config=array();

	public function __construct()
	{
		global $_G;
		if (empty($config)) {
			if (!function_exists('zms_storage_getconfig')) {
				include DISCUZ_ROOT.'./source/plugin/zhanmishu_storage/source/function/common_function.php';
			}
			$config = zms_storage_getconfig();
		}
		$this->config = $config;

	}

	public function get_target_dir($type, $extid = '', $check_exists = true) {

		$subdir = $subdir1 = $subdir2 = '';
		if($type == 'album' || $type == 'forum' || $type == 'portal' || $type == 'category' || $type == 'profile') {
			$subdir1 = date('Ym');
			$subdir2 = date('d');
			$subdir = $subdir1.'/'.$subdir2.'/';
		} elseif($type == 'group' || $type == 'common') {
			$subdir = $subdir1 = substr(md5($extid), 0, 2).'/';
		}

		$check_exists && $this->check_dir_exists($type, $subdir1, $subdir2);

		return $subdir;
	}//F rom ww w.ymg 6.com
	public function check_dir_exists($type = '', $sub1 = '', $sub2 = '') {

		$type = $this->check_dir_type($type);

		$basedir = !getglobal('setting/attachdir') ? (DISCUZ_ROOT.'./data/attachment') : getglobal('setting/attachdir');

		$typedir = $type ? ($basedir.'/'.$type) : '';
		$subdir1  = $type && $sub1 !== '' ?  ($typedir.'/'.$sub1) : '';
		$subdir2  = $sub1 && $sub2 !== '' ?  ($subdir1.'/'.$sub2) : '';

		$res = $subdir2 ? is_dir($subdir2) : ($subdir1 ? is_dir($subdir1) : is_dir($typedir));
		if(!$res) {
			$res = $typedir && $this->make_dir($typedir);
			$res && $subdir1 && ($res = $this->make_dir($subdir1));
			$res && $subdir1 && $subdir2 && ($res = $this->make_dir($subdir2));
		}

		return $res;
	}

	function make_dir($dir, $index = true) {
		$res = true;
		if(!is_dir($dir)) {
			$res = @mkdir($dir, 0777);
			$index && @touch($dir.'/index.html');
		}
		return $res;
	}
	public	function check_dir_type($type) {
		return !in_array($type, array('forum', 'group', 'album', 'portal', 'common', 'temp', 'category', 'profile')) ? 'temp' : $type;
	}
	public function get_target_filename($type, $extid = 0, $forcename = '') {
		if($type == 'group' || ($type == 'common' && $forcename != '')) {
			$filename = $type.'_'.intval($extid).($forcename != '' ? "_$forcename" : '');
		} else {
			$filename = date('His').strtolower(random(16));
		}
		return $this->config['oss_filename_head'].$filename;
	}


    private function stringToSignSorted($string_to_sign)
    {
        $queryStringSorted = '';
        $explodeResult = explode('?', $string_to_sign);
        $index = count($explodeResult);
        if ($index === 1)
            return $string_to_sign;

        $queryStringParams = explode('&', $explodeResult[$index - 1]);
        sort($queryStringParams);

        foreach($queryStringParams as $params)
        {
             $queryStringSorted .= $params . '&';    
        }

        $queryStringSorted = substr($queryStringSorted, 0, -1);

        return $explodeResult[0] . '?' . $queryStringSorted;
    }//From ww w.mo q u8.com
   	public static function Curl($url,$isJsonDecode=false){
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
		$resultj = curl_exec($ch);
		curl_close($ch); 

		if ($isJsonDecode) {
			return json_decode($resultj,true);
		}else{
			return $resultj;
		}
		
	}

	public function Oss_Signatureurl($filename){
		
		$expire=TIMESTAMP + 1800;
		$bucketname=$this->config['bucketname'];
		
		$StringToSign="GET\n\n\n$expire\n/$bucketname$filename";
		$Sign=base64_encode(hash_hmac("sha1",$StringToSign,$this->config['AccessKeySecret'],true));

		return $filename."?OSSAccessKeyId=".rawurlencode($this->config['OSSAccessKeyId'])."&Expires=".$expire."&Signature=".rawurlencode($Sign);

	}

	public $files_list = array();

	public function get_all_files($prefix='',$nextMarker=''){
		$list = $this->get_file_lists($prefix,$nextMarker);
		$nextMarker = $list['nextMarker'];
		for ($i=0; $i < 10; $i++) { 
		}
		$this->files_list = array($this->files_list,$list);
		return $this->files_list;
	}


    public function get_type_attachment_num($tableid,$field=array()){
        if (!empty($field) && is_array($field)) {
            $where = ' where ';
            $tmp = array();
            foreach ($field as $key => $value) {
                if (is_string($value)) {
                    $tmp[] = ' '.$key.' = \''.$value.'\' ';
                }else if($value['relation']){
                    switch ($value['relation']) {
                        case 'like':
                            $tmp[] = ' '.$value['key'].' '.$value['relation'].' \'%'.$value['value'].'%\' ';
                            break;
                        case 'sql':
                            $tmp[] = $value['sql'];
                            break;
                        default:
                            $tmp[] = ' '.$value['key'].' '.$value['relation'].' \''.$value['value'].'\' ';
                            break;
                    }
                }
            }
            $where .= implode(' and ', $tmp);

        }else{
            $where = '';
        }

        $count = DB::fetch_first('SELECT count(*) as num FROM %t '.$where,array('forum_attachment_'.$tableid));
        return $count['num'];
    }
    public function get_type_attachment($tableid,$start=0, $limit=20, $sort = '',$type = '',$field=array()) {

        if (is_array($sort)) {
            $tmp = array();
            foreach ($sort as $key => $value) {
                $tmp[] = DB::order($key, $value);
            }
            $tmp = implode(' , ', $tmp);

            $order = ' ORDER BY '.$tmp;
        }else{
            $order = $sort ? ' ORDER BY '.DB::order('aid', $sort) : '';
        }

        if (!empty($field)) {
            $where = ' where ';

            $tmp = array();
            foreach ($field as $key => $value) {
                if (is_string($value)) {
                    $tmp[] = ' '.$key.' = \''.$value.'\' ';
                }else if($value['relation']){

                    switch ($value['relation']) {
                        case 'like':
                            $tmp[] = ' '.$value['key'].' '.$value['relation'].' \'%'.$value['value'].'%\' ';
                            break;
                        case 'sql':
                            $tmp[] = $value['sql'];
                            break;
                        default:
                            $tmp[] = ' '.$value['key'].' '.$value['relation'].' \''.$value['value'].'\' ';
                            break;
                    }
                }
            }
            $where .= implode(' and ', $tmp);

        }else{
            $where = '';
        }
        return  DB::fetch_all('SELECT * FROM %t '.$where.$order.DB::limit($start, $limit), array('forum_attachment_'.$tableid));

    }

    public function set_remote_file_acl($key){
		$oss_config = $this->config;
		if ($oss_config['use_intranet']) {
			$endpoint = $oss_config['intranet_EndPoint'];
		}else{
			$endpoint = substr($oss_config['host'], strpos($oss_config['host'],'.')+1);
		}
		$OssClient  = new OssClient($oss_config['OSSAccessKeyId'],$oss_config['AccessKeySecret'],$endpoint);

		return $OssClient->putObjectAcl($oss_config['bucketname'], $key, 'public-read');
	}

	public function get_file_lists($prefix='',$marker=''){
		global $_G;

		$oss_config = $this->config;
		$OssClient  = new OssClient($oss_config['OSSAccessKeyId'],$oss_config['AccessKeySecret'],substr($oss_config['host'], strpos($oss_config['host'],'.')+1));

		$listObjectInfo = $OssClient->listObjects($oss_config['bucketname'],array('max-keys'=>'3','prefix'=>$prefix,'marker'=>$marker));

		$nextMarker = $listObjectInfo->getNextMarker();
		$listObject = $listObjectInfo->getObjectList();
		$listPrefix = $listObjectInfo->getPrefixList();

		$list = array();
		$list['nextMarker'] = $nextMarker;
		foreach($listObject as $info){
		    $list['file'][] = array(
		            'name' => $info->getKey(),
		            'lastModified' => $info->getLastModified()
		        );
		}
		foreach($listPrefix as $info){
		    $list['dir'][] = array('name' => $info->getPrefix());
		}
		
		return $list;
	}

}