
<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
echo '<script type="text/javascript" src="static/js/calendar.js"></script>';
showtips(lang('plugin/rjyfk_in', 'Prompt53'));
showtableheader(lang('plugin/rjyfk_in', 'Prompt53'));
showtablerow('','',lang('plugin/rjyfk_in', 'Prompt52'));
showtablefooter();
?>