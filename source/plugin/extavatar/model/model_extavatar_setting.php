<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class model_extavatar_setting
{
    public function getDefault()
    {
		$setting = array (
			'scope' => 1,     
			'strategy' => 1,  
		);
		return $setting;
    }
	public function get()
	{
		$setting = $this->getDefault();
		global $_G;
		if (isset($_G['setting']['extavatar_config'])){
			$config = unserialize($_G['setting']['extavatar_config']);
			foreach ($setting as $key => &$item) {
				if (isset($config[$key])) $item = $config[$key];
			}
		}
		return $setting;
	}
}
?>