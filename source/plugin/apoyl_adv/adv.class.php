<?php
/**
 *      [liyuanchao] (C)2019-2019 http://www.apoyl.com
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: adv.class.php  2019-06  liyuanchao（凹凸曼） $
 */
if(!defined('IN_DISCUZ')){
    exit('Access Denied');
}
class plugin_apoyl_adv{
    private $purl='plugin.php?id=apoyl_adv:index';
    
    public function ad_article($arr){
        return $this->toadv($arr);
    }
    public function ad_articlelist($arr){
        return $this->toadv($arr);
    }
    public function ad_blog($arr){
        return $this->toadv($arr);
    }
    public function ad_cornerbanner($arr){
        return $this->toadv($arr);
    }
    public function ad_couplebanner($arr){
        return $this->toadv($arr);
    
    }
    public function ad_custom($arr){
        return $this->toadv($arr);
    }
    public function ad_feed($arr){
        return $this->toadv($arr);
    
    }
    public function ad_float($arr){
        return $this->toadv($arr);
    }
    public function ad_footerbanner($arr){
        return $this->toadv($arr);
    }
    public function ad_headerbanner($arr){
        return $this->toadv($arr);
    }
    public function ad_intercat($arr){
        return $this->toadv($arr);
    }
    public function ad_search($arr){
        return $this->toadv($arr);
    }
    public function ad_subnavbanner($arr){
        return $this->toadv($arr);
    }
    public function ad_text($arr){
        return $this->toadv($arr);
    }
    public function ad_thread($arr){
        return $this->toadv($arr);
    }
    public function ad_threadlist($arr){
        return $this->toadv($arr);
    }

    private function toadv($arr){
        $content=$arr['content'];
        
        if($content){
            $adv=$this->get_adv_fetch($content);
            if(!$adv) return $content;
            if(!$this->isflash($content)){
                $param['advid']=$adv['advid'];
                $param['subject']=$adv['title'];
                $content=$this->rpurl($content, $this->purl,$param);
            }
        }
        
        return $content;        
    }
    private function isflash($content){
        $re=false;
        if(preg_match('/<embed/i',$content)) $re=true;
        return $re;
    }

    private function rpurl($content,$url,$param){
        $content=preg_replace("/href=[\"|\'](.*?)[\"|\']/ies","\$this->rpsetUrl(\$url,'\\1',\$param)",$content);
        return $content;
        
    }
    private function rpsetUrl($url,$u,$param){
        $param['url']=$u;
        $id=$this->showC($param);
        return 'href="'.$url.'&ctid='.$id.'"';
    }
    private function get_code($content){
        $code=preg_replace("/<div .*?>(.*)<\/div>/is","\\1",$content);
        return $code;
    }
    private function get_adv_fetch($content){
    
        $code=$this->get_code($content);
        $re=DB::fetch_first('select advid,title from '.DB::table('common_advertisement').' where code=%s',array($code),'code');
        return $re;
    }
    private function showC($arr){
        $id=0;
        $a=C::t('#apoyl_adv#adv_count')->fetch_adv($arr['advid'],$arr['url']);
        if($a){
            $data=array(
                'subject'=>$arr['subject'],
                'showcount'=>$a['showcount']+1,
                'modtime'=>TIMESTAMP
            );
            C::t('#apoyl_adv#adv_count')->update_idurl($data,$arr['advid'],$arr['url']);
            $id=$a['id'];
        }else{
            $data=array(
                'advid'=>$arr['advid'],
                'url'=>$arr['url'],
                'subject'=>$arr['subject'],
                'showcount'=>1,
                'modtime'=>TIMESTAMP,
                'addtime'=>TIMESTAMP
            );
            $id=C::t('#apoyl_adv#adv_count')->insert($data);
        }
        return $id;
    }
}

?>