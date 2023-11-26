<?php

/*
 *源码哥：www.ymg6.com
 *更多商业插件/模版免费下载 就在源码哥
 *本资源来源于网络收集,仅供个人学习交流，请勿用于商业用途，并于下载24小时后删除!
 *如果侵犯了您的权益,请及时告知我们,我们即刻删除!
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
exit('http://www.ymg6.com/');
}
$pluginvars_array = array();//1314学习网
//模块
$pluginvars_array['modules'] = array(
		'left' => array(
array('&#x6700;&#x65B0;&#x56FE;&#x7247;', 'pic'),
		),
		'middle' => array(
array('&#x6700;&#x65B0;&#x5E16;&#x5B50;', 'newpost'),
array('&#x6700;&#x65B0;&#x56DE;&#x590D;', 'newreply'),
array('&#x63A8;&#x8350;&#x4E3B;&#x9898;', 'recpost'),
array('&#x7CBE;&#x534E;&#x4E3B;&#x9898;', 'goodreply'),
array('&#x70ED;&#x95E8;&#x4E3B;&#x9898;', 'hotpost'),
		),
		'right' => array(
array('&#x6700;&#x65B0;&#x4F1A;&#x5458;', 'newmember'),
array('&#x5E16;&#x5B50;&#x6392;&#x884C;', 'posts'),
array('&#x5728;&#x7EBF;&#x6392;&#x884C;', 'online'),
array('&#x79EF;&#x5206;&#x6392;&#x884C;', 'credits'),
		),
		'bottom' => array(
array('&#x6700;&#x65B0;&#x4F1A;&#x5458;', 'newmember'),
array('&#x5E16;&#x5B50;&#x6392;&#x884C;', 'posts'),
array('&#x5728;&#x7EBF;&#x6392;&#x884C;', 'online'),
array('&#x79EF;&#x5206;&#x6392;&#x884C;', 'credits'),
		),
);/*1.3.1.4.学.习.网*/
//公共设置
$pluginvars_array['common'] = array(
	'cache_radio',
	'template_default',
	'common_extstyle',
	'common_extstyle_zdy',
	'common_show',
	'common_gids',
	'middle_order',
	'right_order',
	'bottom_avatar',
	'nge_warmprompt',
	'common_icon_radio',
	'showusercard_radio',
	'threadcard_select2',
	'fids_show',
	'subject_length',
	'target_blank_radio',
	'data_num',
	'common_strip_tags_radio',
	'highlight_radio',
	'common_tiezi_right',
	'common_tiezi_right_reply',
	'common_hy_right_color',
	'common_tiezi_right_color',
	'common_font_css',
	'header_color',
	'border_color',
	'common_fid_radio',
	'common_clock_mode',
);
//最新图片
$pluginvars_array['mid']['pic'] = array(
	'pic_title',
	'pic_cache_time',
	'pic_select',
	'pic_way',
	'pic_select_way',
	'pic_fids',
	'pic_limit_day',
	'pic_thumb_h2',
	'pic_thumb_w',
	'pic_thumb_quality',
	'pic_thumb_radio',
	'pic_ad_first',
	'pic_ad_last',
	'pic_title_radio',
	'pic_title_length',
	'pic_transparent',
	'pic_color',
	'pic_cut',
	'pic_num',
	'pic_bgcolor',
	'pic_zdy_text',
	'pic_zdy_url',
	'pic_zdy_pic',
);
//最新帖子
$pluginvars_array['mid']['newpost'] = array(
	'newpost_title',
	'newpost_cache_time',
	'newpost_fids',
	'newpost_limit_day',
);
//最新回复
$pluginvars_array['mid']['newreply'] = array(
	'newreply_title',
	'newreply_cache_time',
	'newreply_fids',
	'newreply_limit_day',
	'newreply_thru',
	'newreply_gotolastpost',
);
//推荐主题
$pluginvars_array['mid']['recpost'] = array(
	'recpost_title',
	'recpost_cache_time',
	'recpost_fids',
	'recpost_admin_gids',
);
//精华主题
$pluginvars_array['mid']['goodreply'] = array(
	'goodreply_title',
	'goodreply_cache_time',
	'goodreply_fids',
	'goodreply_digest',
	'goodreply_order',
	'goodreply_day',
);/*13352*/
//热门主题
$pluginvars_array['mid']['hotpost'] = array(
	'hotpost_title',
	'hotpost_cache_time',
	'hotpost_fids',
	'hotpost_day',
	'hotpost_order',
);
//最新会员
$pluginvars_array['mid']['newmember'] = array(
	'newmember_title',
	'newmember_cache_time',
	'newmember_limit_day',
	'newmember_limit_gids_radio',
);#版权：1314学习网，未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权
//帖子排行
$pluginvars_array['mid']['posts'] = array(
	'posts_title',
	'posts_cache_time',
	'posts_gids',
	'posts_day',
	'posts_first_radio',
	'posts_way',
	'posts_show_name',
	'posts_zytitlecolor',
	'posts_zyinfocolor',
	'posts_byinfocolor',
	'posts_bytitlecolor',
	'posts_thtitlecolor',
	'posts_thinfocolor',
);
//在线排行
$pluginvars_array['mid']['online'] = array(
	'online_title',
	'online_cache_time',
);
//积分排行
$pluginvars_array['mid']['credits'] = array(
	'credits_title',
	'credits_cache_time',
	'credits_extcredit',
);//1314学习网


//Copyright 2001-2099 1314学习网.
//This is NOT a freeware, use is subject to license terms
//$Id: setting_default.php 4331 2017-08-20 18:43:24Z zhuge $
//应用售后问题：http://www.1314study.com/services.php?mod=issue
//应用售前咨询：QQ 15326940
//应用定制开发：QQ 643306797
//本插件为 1314学习网（www.1314study.com） 独立开发的原创插件, 依法拥有版权。
//未经允许不得公开出售、发布、使用、修改，如需购买请联系我们获得授权。