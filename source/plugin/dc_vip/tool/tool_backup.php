<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class tool_backup{
	var $title='[DC]VIP&#25968;&#25454;&#22791;&#20221;&#47;&#36824;&#21407;';
	var $des='&#22791;&#20221;&#47;&#36824;&#21407;';
	public function run(){
		global $_G;
		if(!$_GET['import']){
			if(preg_match('/[^A-Za-z0-9_]/', $_GET['filename'])) cpmsg('&#25991;&#20214;&#21517;&#31216;&#21547;&#26377;&#38750;&#27861;&#23383;&#31526;&#65281;');
			$file = DISCUZ_ROOT."./data/dcvip_backup/{$_GET[filename]}.bak";
			@touch($file);
			if(!is_writeable($file)) cpmsg('&#25991;&#20214;&#19981;&#21487;&#20889;&#65292;&#35831;&#26816;&#26597;&#30446;&#24405;&#26435;&#38480;');
			$out_arr = array('group' => array(), 'main' => array());

			$out_arr['group'] = DB::fetch_all('SELECT * FROM '.DB::table('dc_vip_group'));
			$out_arr['main'] = DB::fetch_all('SELECT * FROM '.DB::table('dc_vip'));
			$output = serialize($out_arr);
			file_put_contents($file, $output);
			cpmsg('&#22791;&#20221;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&identifier=dc_vip&pmod=tool&f=backup', 'succeed');
			dexit();
		}else{
			if(!preg_match("/^[a-z0-9_\-]+$/i", $_GET['import']))cpmsg('&#22791;&#20221;&#25991;&#20214;&#19981;&#23384;&#22312;&#65281;');
			$file = DISCUZ_ROOT.'./data/dcvip_backup/'.$_GET['import'].'.bak';
			if(!file_exists($file)) cpmsg('&#22791;&#20221;&#25991;&#20214;&#19981;&#23384;&#22312;&#65281;');
			$data_str = file_get_contents($file);
			$data = unserialize($data_str);
			$main = $data['main'];
			$group = $data['group'];
			C::t('#dc_vip#dc_vip_group')->truncate();
			C::t('#dc_vip#dc_vip')->truncate();
			foreach ($group as $g){
				C::t('#dc_vip#dc_vip_group')->insert($g);
			}
			foreach ($main as $v){
				C::t('#dc_vip#dc_vip')->insert($v);
			}
			cpmsg('&#36824;&#21407;&#25104;&#21151;&#65281;', 'action=plugins&operation=config&identifier=dc_vip&pmod=tool&f=backup', 'succeed');
			dexit();
			
			
			
		}
	}
	public function setting(){
		showtableheader('VIP&#25968;&#25454;&#22791;&#20221;');
		showformheader('plugins&operation=config&identifier=dc_vip&pmod=tool&f=backup');
		showsetting('&#22791;&#20221;&#25991;&#20214;&#21517;&#31216;', 'filename', random(10), 'text', '', '', '&#20648;&#23384;&#22312; /data/dcvip_backup/ &#19979;&#30340;&#25991;&#20214;&#21517;');
		showsubmit('submit', '&#24320;&#22987;&#22791;&#20221;');
		showformfooter();
		showtablefooter();
		showtableheader('VIP&#25968;&#25454;&#36824;&#21407;');
		if(!is_dir(DISCUZ_ROOT.'./data/dcvip_backup/')) {
			@mkdir(DISCUZ_ROOT.'./data/dcvip_backup/', 0777);
			@touch(DISCUZ_ROOT."./data/dcvip_backup/index.htm");
		}
		$backup_dir = @dir(DISCUZ_ROOT.'./data/dcvip_backup/');
		while(false !== ($entry = $backup_dir->read())) {
			$file = pathinfo($entry);
			if($file['extension'] == 'bak' && $file['basename']) {
				showtablerow('', '', array(
					'&#22791;&#20221;: '.$file['filename'],
					dgmdate(filemtime(DISCUZ_ROOT.'./data/dcvip_backup/'.$file['basename']), 'u'),
					'<a href="?action=plugins&operation=config&identifier=dc_vip&pmod=tool&f=backup&submit=yes&import='.$file['filename'].'&formhash='.FORMHASH.'">&#24320;&#22987;&#36824;&#21407;</a>',
				));
				$flag = true;
			}
		}
		if(!$flag) showtablerow('', '', array('<font color="red">&#26408;&#26377;&#22791;&#20221;&#20063;~</font>'));
		showtablefooter();
		}
}
?>