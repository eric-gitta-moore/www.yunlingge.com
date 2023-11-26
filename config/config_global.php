<?php


$_config = array();

//$_config['debug'] = md5('zyq0823ZYQ'.date('i'));//debug调试模式
$_config['debug'] = 'zyq0823ZYQ';
//define('DISCUZ_DEBUG',true);

// ----------------------------  CONFIG DB  ----------------------------- //
$_config['db']['1']['dbhost'] = '127.0.0.1';
$_config['db']['1']['dbuser'] = 'sfodbe33';
$_config['db']['1']['dbpw'] = 'zyq0823zyq.';
$_config['db']['1']['dbcharset'] = 'utf8';
$_config['db']['1']['pconnect'] = '0';
$_config['db']['1']['dbname'] = 'sfodbe33';
$_config['db']['1']['tablepre'] = 'pre_';
$_config['db']['slave'] = '';
$_config['db']['common']['slave_except_table'] = '';

// --------------------------  CONFIG MEMORY  --------------------------- //
$_config['memory']['prefix'] = 'u1s86p_';
$_config['memory']['redis']['server'] = '127.0.0.1';
$_config['memory']['redis']['port'] = 6379;
$_config['memory']['redis']['pconnect'] = 1;
$_config['memory']['redis']['timeout'] = '0';
$_config['memory']['redis']['requirepass'] = '';
$_config['memory']['redis']['serializer'] = 1;

//$_config['memory']['memcached']['server'] = '127.0.0.1';
$_config['memory']['memcached']['port'] = 11211;
$_config['memory']['memcached']['pconnect'] = 1;
$_config['memory']['memcached']['timeout'] = 1;

#$_config['memory']['memcache']['server'] = '127.0.0.1';
$_config['memory']['memcache']['port'] = 11211;
$_config['memory']['memcache']['pconnect'] = 1;
$_config['memory']['memcache']['timeout'] = 1;

$_config['memory']['apc'] = '0';
$_config['memory']['apcu'] = '0';
$_config['memory']['xcache'] = '0';
$_config['memory']['eaccelerator'] = '0';
$_config['memory']['wincache'] = '0';
$_config['memory']['yac'] = '0';
$_config['memory']['file']['server'] = '';

// --------------------------  CONFIG SERVER  --------------------------- //
$_config['server']['id'] = 1;

// -------------------------  CONFIG DOWNLOAD  -------------------------- //
$_config['download']['readmod'] = 2;
$_config['download']['xsendfile']['type'] = '0';
$_config['download']['xsendfile']['dir'] = '/down/';

// --------------------------  CONFIG OUTPUT  --------------------------- //
$_config['output']['charset'] = 'utf-8';
$_config['output']['forceheader'] = 1;
$_config['output']['gzip'] = '0';
$_config['output']['tplrefresh'] = 3600;
$_config['output']['language'] = 'zh_cn';
$_config['output']['staticurl'] = '//r1.lcwz01.top/static/';
$_config['output']['ajaxvalidate'] = '0';
$_config['output']['iecompatible'] = '0';

// --------------------------  CONFIG COOKIE  --------------------------- //
$_config['cookie']['cookiepre'] = 'MOPA_';
$_config['cookie']['cookiedomain'] = 'www.yunlingge.com';
$_config['cookie']['cookiepath'] = '/';

// -------------------------  CONFIG SECURITY  -------------------------- //
$_config['security']['authkey'] = '1c37f6ec559a4b68a706398e165f7fb4n5xJDFLtQh2Jy1cXry';
$_config['security']['urlxssdefend'] = 0;
$_config['security']['attackevasive'] = '0';
$_config['security']['onlyremoteaddr'] = '0';
$_config['security']['querysafe']['status'] = 1;
$_config['security']['querysafe']['dfunction']['0'] = 'load_file';
$_config['security']['querysafe']['dfunction']['1'] = 'hex';
$_config['security']['querysafe']['dfunction']['2'] = 'substring';
$_config['security']['querysafe']['dfunction']['3'] = 'if';
$_config['security']['querysafe']['dfunction']['4'] = 'ord';
$_config['security']['querysafe']['dfunction']['5'] = 'char';
$_config['security']['querysafe']['daction']['0'] = '@';
$_config['security']['querysafe']['daction']['1'] = 'intooutfile';
$_config['security']['querysafe']['daction']['2'] = 'intodumpfile';
$_config['security']['querysafe']['daction']['3'] = 'unionselect';
$_config['security']['querysafe']['daction']['4'] = '(select';
$_config['security']['querysafe']['daction']['5'] = 'unionall';
$_config['security']['querysafe']['daction']['6'] = 'uniondistinct';
$_config['security']['querysafe']['dnote']['0'] = '/*';
$_config['security']['querysafe']['dnote']['1'] = '*/';
$_config['security']['querysafe']['dnote']['2'] = '#';
$_config['security']['querysafe']['dnote']['3'] = '--';
$_config['security']['querysafe']['dnote']['4'] = '"';
$_config['security']['querysafe']['dlikehex'] = 1;
$_config['security']['querysafe']['afullnote'] = '0';
$_config['security']['creditsafe']['second'] = '0';
$_config['security']['creditsafe']['times'] = 10;
$_config['security']['fsockopensafe']['port']['0'] = 80;

// --------------------------  CONFIG ADMINCP  -------------------------- //
// -------- Founders: $_config['admincp']['founder'] = '1,2,3'; --------- //
$_config['admincp']['founder'] = '1';
$_config['admincp']['forcesecques'] = '0';
$_config['admincp']['checkip'] = 1;
$_config['admincp']['runquery'] = '0';
$_config['admincp']['dbimport'] = 1;

// --------------------------  CONFIG REMOTE  --------------------------- //
$_config['remote']['on'] = '1';
$_config['remote']['dir'] = 'remote';
$_config['remote']['appkey'] = '62cf0b3c3e6a4c9468e7216839721d8e';
$_config['remote']['cron'] = '1';

// ---------------------------  CONFIG INPUT  --------------------------- //
$_config['input']['compatible'] = 1;


// -------------------  THE END  -------------------- //
$_config['plugindeveloper'] = 1;
?>