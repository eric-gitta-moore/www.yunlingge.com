<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_ror_pace {
    
    public function global_footer()
    {
        global $_G;

        $config = array('color'=>'blue','type'=>'minimal','mobile_open'=>0);

        $config = array_merge($config, $_G['cache']['plugin']['ror_pace']);

        $html = '
            <link href="source/plugin/ror_pace/public/css/pace-theme-%s-%s.min.css" rel="stylesheet">
            <script src="source/plugin/ror_pace/public/js/pace.min.js"></script>
        ';
        
        $html = sprintf($html, $config['color'], $config['type']);

        return $html;
    }

}