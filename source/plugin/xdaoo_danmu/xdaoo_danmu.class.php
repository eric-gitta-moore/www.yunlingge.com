<?php
/**
 * created by xdaoo.com
 * create_time :2020-02-23 1:20
 * description :
 */
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_xdaoo_danmu_base{


    public  function gbk_to_utf8($pram){
        if (strtolower(CHARSET) == 'gbk') {
            return diconv($pram, 'gbk', 'utf-8');
        }else{
            return $pram;
        }
    }
    public  function  get_post_data(){
        global  $_G;
        include_once DISCUZ_ROOT.'./source/function/function_discuzcode.php';
        $data_num = isset($_G['cache']['plugin']['xdaoo_danmu']['data_num'])?trim($_G['cache']['plugin']['xdaoo_danmu']['data_num']):10;
        $fids = (array)dunserialize($_G['cache']['plugin']['xdaoo_danmu']['fid']);

        if (empty($fids)){

            $fidsql = is_array($fids) ? 'fid IN(%n)' : 'fid=%d';

            $query =  DB::fetch_all("SELECT tid,authorid,subject,message FROM %t WHERE $fidsql ORDER BY dateline DESC %i",array('forum_post',$fids,DB::limit(0, $data_num)));

        }else{
            $query =  DB::fetch_all("SELECT tid,authorid,subject,message FROM %t ORDER BY dateline DESC %i",array('forum_post',DB::limit(0, $data_num)));
        }
        foreach($query as $k=>$v){
            if ($v['first']){
                $data[$k]['info'] = $v['subject'];
            }else{
                $data[$k]['info'] = discuzcode(cutstr($v['message'],80));
            }
            $data[$k]['img'] ="uc_server/avatar.php?uid=$v[authorid]&size=middle";
            $data[$k]['href'] = "forum.php?mod=viewthread&tid=".$v['tid'];

            $data[$k]['bottom']= isset($_G['cache']['plugin']['xdaoo_danmu']['bottom'])?trim($_G['cache']['plugin']['xdaoo_danmu']['bottom']):0;//距离底部高度,单位px,默认随机

        }
        return $data;
    }
    public  function xdaoo_array_map($filter,$data) {
        $result = array();
        foreach ($data as $k =>$val) {
            $result[$k] = is_array($val) ? $this->xdaoo_array_map($filter, $val) : $this->$filter($val);
        }
        return $result;
    }
    public function xdaoo_json_encode($data, $json_option=0){
        $ret = array();
        $ret = $this->xdaoo_array_map('gbk_to_utf8',$data);
        return json_encode($ret, $json_option);
    }
    public  function   hex_to_rgba($color,$opacity = 0.5) {
            $hexColor = str_replace('#', '', $color);
            $lens = strlen($hexColor);
            if ($lens != 3 && $lens != 6) { return false;}
            $newcolor = '';
            if ($lens == 3) {
                for ($i = 0; $i < $lens; $i++) {
                    $newcolor .= $hexColor[$i] . $hexColor[$i];
                }
            } else {
                $newcolor = $hexColor;
            }
            $hex = str_split($newcolor, 2);
            $rgb = [];
            foreach ($hex as $key => $vls) {
                $rgb[] = hexdec($vls);
            }
            $rbga = 'rgba('.implode(',',$rgb).','.$opacity.')';
            return $rbga;
        }

}
class  plugin_xdaoo_danmu extends  plugin_xdaoo_danmu_base {

    var $my_plugin_var = array();
    public  function plugin_xdaoo_danmu(){

    }
    public  function  global_footer(){
        global $_G;
        $my_plugin_var = $_G['cache']['plugin']['xdaoo_danmu'];
        $open_page = isset($my_plugin_var['open_page'])?(array)dunserialize($my_plugin_var['open_page']):'forum_index';
        $looper_time = isset($my_plugin_var['looper_time'])?$my_plugin_var['looper_time']:3;
        $isloop = isset($my_plugin_var['isloop'])?$my_plugin_var['isloop']:0;
        $text_color = isset($my_plugin_var['text_color'])?$my_plugin_var['text_color']:'#FFFFFF';

        $bg_color = isset($my_plugin_var['bg_color'])?$my_plugin_var['bg_color']:'#000000';
        $bg_rgba = $this->hex_to_rgba($bg_color);

        $cur_page = $_G[basescript].'_'.CURMODULE;
        if(in_array($cur_page,$open_page)){
            $data = $this->get_post_data();
            $arr =  $this->xdaoo_json_encode($data);
            include_once template('xdaoo_danmu:xdaoo_danmu');
            return tpl_global_footer($arr,$looper_time,$text_color,$bg_rgba,$isloop);
        };
    }
}

