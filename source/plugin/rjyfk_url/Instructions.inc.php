
<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
showtips(lang('plugin/rjyfk_url', 'Prompt53'));
showtableheader(lang('plugin/rjyfk_url', 'Prompt53'));
showtablerow('','',lang('plugin/rjyfk_url', 'Prompt52'));
showtablefooter();
?>