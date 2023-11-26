<?php
if ( !defined( 'IN_DISCUZ' ) ) {
	exit( 'Access Denied' );
}
//全局嵌入点类（必须存在）
class plugin_saya_watermark {
	function common() {
		global $_G;
			foreach ( $_G[ 'setting' ][ 'watermarktext' ][ 'text' ] as $key => $value ) {
				if(!$value) continue;
				$temp = pack( "H*", $value );
				$temp .= iconv(strtoupper($_G['charset']),"UTF-8//IGNORE",$_G[ 'username' ]);
				$temp = unpack( "H*", $temp );
				$_G[ 'setting' ][ 'watermarktext' ][ 'text' ][ $key ] = $temp[ 1 ];
			}
	}
}

class mobileplugin_saya_watermark extends plugin_saya_watermark {}

?>