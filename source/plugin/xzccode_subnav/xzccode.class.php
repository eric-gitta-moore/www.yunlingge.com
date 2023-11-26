<?php


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_xzccode_subnav {

	function global_nav_extra(){
		global $_G;
		$config = $_G['cache']['plugin']['xzccode_subnav'];
		$width = $config['width'];
		$height = 60;
		$margin_bottom = 0;
		$img_height = 55;
		$img_width = 55;
		$leftimg_width = $img_width;
		$num = 0;
		$max_nun = 4;
		for ($i=1; $i <= $max_nun ; $i++) { 
			$img_key = 'mod_img'.$i;
			$data_key = 'mod_data'.$i;
			$data_list = explode('
', $config[$data_key]);
			$option_html = '';
			foreach ($data_list as $k => $v) {
				if ($v && $k < 6) {
					$t_v = explode('|', $v);
					$option_html .= '<a href="'.$t_v[1].'" title="">'.$t_v[0].'</a>';
				}
				
			}
			if ($config[$img_key] && $data_list) {
				$list_html .= <<<EOF
				<div class="mbox">
					<div class="leftimg">
						<img src="{$config[$img_key]}" width="{$img_width}" height="{$img_height}">
					</div>
					<div class="list{$i}">
						{$option_html}
					</div>
				</div>
EOF;
				$num++;
			}
			$count = count($data_list) > 6?6:count($data_list);
			$lines[$i] = ceil($count/2);
		}
		$mwidth = ($width/$num)-10;
		$img_padding = ($height-$img_width)/2;
		$list_Width = $mwidth-$leftimg_width;
		$list_a_width = $list_Width/3;
		$list_a_height = $height/2;
		foreach ($lines as $i => $line) {
			$list_a_width = $list_Width/$line;
			$style .= ".list{$i}{width:{$list_Width}px;height:{$height}px;float:left;}.list{$i} a{display:block;width:{$list_a_width}px;height:{$list_a_height}px;line-height:{$list_a_height}px;float:left;text-align:center;}";
		}
		$script = <<<EOF
		</div>
		<style>
			#subnav{width:{$width}px;height:{$height}px;margin:0px auto {$margin_bottom}px auto;background:#f6f6f6;}
			.mbox{width:{$mwidth}px;height:{$height}px;padding:0px 5px;float:left;}
			.leftimg{width:{$leftimg_width}px;padding-top:{$img_padding}px;float:left;}
			.list{width:{$list_Width}px;height:{$height}px;float:left;}
			.list a{display:block;width:{$list_a_width}px;height:{$list_a_height}px;line-height:{$list_a_height}px;float:left;}
			{$style}
		</style>
		<div id="subnav">{$list_html}
EOF;
		return $script;
	}
}

