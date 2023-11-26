<?php
/*
Author:讯幻网
Website:www.xhkj5.com
Qq:2444300667
*/
if (! defined ( 'IN_DISCUZ' )) {
	exit ( 'Access Denied' );
}

require_once DISCUZ_ROOT . './source/plugin/wechat/wechat.lib.class.php';

class jzsjiale_seo_alt_api {
    
    var $alt_isopen;
    var $alt_huifu;
    var $alt_alt;
    var $alt_title;
    var $alt_isoverridealt;
    var $alt_isoverridetitle;
    var $alt_istags;
    var $alt_starttime;
    var $alt_endtime;
    var $isok = false;
    
    var $wordtags = "";
    var $num = 0;
    var $cachekeywords = "";
    
	function viewthread_variables(&$variables) {
	    global $_G; 
	    loadcache('plugin');
	    
	    $_config = $_G['cache']['plugin']['jzsjiale_seo_alt'];
        $groupid = $_G['groupid'];

        if (! $_config['g_isopen']) {
            return;
        }
  
        $tid = $_GET['tid'];
        if (empty($tid)) {
            return;
        }
        
        $basescript = $_G['basescript'];
        $curm = CURMODULE;
        
        $altsettings = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_settings')->getall();
        
        
        
        if ($basescript == "forum" ) {
            $altsettingid = "";
            $altsettingvalue = array();
            $isok = false;
            
            if ($curm == "viewthread") {
        
                $tid = $_GET['tid'];
                
                $fid = $_G['fid'];
                $pid = $_G['forum_firstpid'];
                
                if(empty($tid)){
                    return;
                }
                
                if(!empty($fid)){
                    $isok = true;
                }else{
                    $isok = false;
                }
                
                
                foreach($altsettings as $key => $value) {
                
                    if (in_array('2',json_decode($value['targets'])) && (!empty($fid)?in_array($fid,json_decode($value['fids'])):false) && $value ['isopen'] == '1' && in_array ( $groupid, json_decode ( $value ['usergroup'] ) ))
                    {
                        $isok = true;
                        $altsettingid = $value['id'];
                        $altsettingvalue = $value;
                        break;
                         
                    }else{
                        $isok = false;
                    }
                }
                
                if($isok){
                    $alt_starttime = $altsettingvalue['starttime'];
                    $alt_endtime = $altsettingvalue['endtime'];
                    $isok = $this->gettimeisok($alt_starttime,$alt_endtime);
                    if($isok == 1){
                        $isok = true;
                    }else{
                        $isok = false;
                    }
                }
                
                if($isok){
                    $this->setvalues($altsettingvalue);
                
                    //$this->first_run($variables,$tid,$fid,$groupid,$pid);
                    
                    
                    
                    loadcache(array(
                    'forums',
                    'grouptype'
                        ));
                    
                    //20150505更新关键词过滤 开始
                    if(file_exists(DISCUZ_ROOT.'./data/sysdata/cache_jzsjiale_seo_alt_keywords.php')){
                        @include_once DISCUZ_ROOT.'./data/sysdata/cache_jzsjiale_seo_alt_keywords.php';
                    
                        $this->cachekeywords = $keywords;
                    
                    }else{
                        $allkeywords = C::t('#jzsjiale_seo_alt#jzsjiale_seo_alt_keywords')->getall();
                    
                        require_once libfile('function/cache');
                        writetocache('jzsjiale_seo_alt_keywords', getcachevars(array('keywords' => $allkeywords)));
                    
                        @include_once DISCUZ_ROOT.'./data/sysdata/cache_jzsjiale_seo_alt_keywords.php';
                        $this->cachekeywords = $keywords;
                    
                    }
                    
                    //20150505更新关键词过滤 结束
                    
                    if($variables['postlist'][0]['pid'] == $pid){
                         
                        $replacedcontent = $this->seo_images_featured($variables,0);
                        if(!empty($replacedcontent)){
                            $variables['postlist'][0]['message'] = $replacedcontent;
                        }
                        foreach ($variables['postlist'][0]['attachments'] as $key=>$value) {
                            $variables['postlist'][0]['attachments'][$key]['attachment'] = $value['attachment']."\"".$this->seo_images_process_attach($variables,0,$value['attachment']);
                        }
                    
                        //20150419 start
                        if ($this->alt_huifu) {
                            foreach ($variables['postlist'] as $key=>$value) {
                                if($variables['postlist'][$key]['pid'] != $pid) {
                                    $h_replacedcontent = $this->seo_images_featured_h($variables,$key);
                    
                                    if(!empty($h_replacedcontent)){
                                        $variables['postlist'][$key]['message'] = $h_replacedcontent;
                                    }
                                    foreach ($variables['postlist'][$key]['attachments'] as $key2=>$value2) {
                                        $variables['postlist'][$key]['attachments'][$key2]['attachment'] = $value2['attachment']."\"".$this->seo_images_process_attach($variables,0,$value2);
                                    }
                                }
                            }
                        }else{
                            foreach ($variables['postlist'] as $key=>$value) {
                                if($variables['postlist'][$key]['pid'] != $pid) {
                                    $h_replacedcontent = $this->seo_images_featured($variables,$key);
                    
                                    if(!empty($h_replacedcontent)){
                                        $variables['postlist'][$key]['message'] = $h_replacedcontent;
                                    }
                                    foreach ($variables['postlist'][$key]['attachments'] as $key2=>$value2) {
                                        $variables['postlist'][$key]['attachments'][$key2]['attachment'] = $value2['attachment']."\"".$this->seo_images_process_attach($variables,$key,$value2);
                                    }
                                }
                            }
                        }
                        //20150419 end
                    }else{
                        return;
                    }
                    
                    
                }else{
                    return;
                }
                
                
                
            }
        }

	}
	
	
	/*
	function first_run($variables,$tid,$fid,$groupid,$pid)
	{
	    global $_G;
	    loadcache('plugin');
	    
	    
	}
	*/
	
	
	function seo_images_process($matches)
	{
	    $alttext_rep = $this->process_parameters["alt"];
	    $titletext_rep = $this->process_parameters["title"];
	    $override_alt = $this->process_parameters["override_alt"];
	    $override_title = $this->process_parameters["override_title"];
	    $forumname = $this->process_parameters['forumname'];
	    $title = $this->process_parameters['tidtitle'];
	    $content = $this->process_parameters['contenthtml'];
	    //20150601
	    $istags = $this->process_parameters['istags'];
	    $tags = $this->process_parameters['tags'];
	    //20160215
	    $attachments = $this->process_parameters['attachments'];
	    //var_dump($attachments);
	    // take care of unusual endings
	    $matches[0] = preg_replace('|([\'"])[/ ]*$|', '\1 /', $matches[0]);
	
	    // ## Normalize spacing around attributes.
	    $matches[0] = preg_replace('/\s*=\s*/', '=', substr($matches[0], 0, strlen($matches[0]) - 2));
	    // ## Get source.
	     
	    if(strpos($matches[0],"static/image/common/none.gif")){
	        preg_match('/file\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $matches[0], $source);
	    }else{
	        preg_match('/src\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $matches[0], $source);
	    }
	    //preg_match('/src\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $matches[0], $source);
	
	
	    $saved = $source[2];
	
	    // ## Swap with file's base name.
	    preg_match('%[^/]+(?=\.[a-z]{3}(\z|(?=\?)))%', $source[2], $source);
	    // ## Separate URL by attributes.
	    $pieces = preg_split('/(\w+=)/', $matches[0], - 1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	    // ## Add missing pieces.
	
	    $tagsword = "";
	    //20150601 $istags
	    if($istags){
	        if (strrpos($alttext_rep, "%tags") !== false || strrpos($titletext_rep, "%tags") !== false) {
	            if(empty($this->wordtags)){
	                $tagsword = $this->get_discuz_tags($tags);
	                $this->wordtags = $tagsword;
	            }else{
	                $tagsword = $this->wordtags;
	            }
	
	
	        }
	    }else{
	        if (strrpos($alttext_rep, "%tags") !== false || strrpos($titletext_rep, "%tags") !== false) {
	            if(empty($this->wordtags)){
	                $tagsword = $this->keyWord($title,$content);
	                $this->wordtags = $tagsword;
	            }else{
	                $tagsword = $this->wordtags;
	            }
	
	
	        }
	    }
	
	
	    if (strrpos($alttext_rep, "%num") !== false || strrpos($titletext_rep, "%num") !== false) {
	        $this->num = $this->num + 1;
	
	    }
	
	    $description_tmp = "";
	    foreach ($attachments as $key=>$value) {
	        if(strpos($value['attachment'],$source[0])){
	            $description_tmp = $value['description'];
	            break;
	        }
	    }
	
	    if(empty($description_tmp)){
	        if(strpos(discuzcode($matches[0]),$source[0])){
	            preg_match('/alt\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/',discuzcode($matches[0]),$matchalttmp);
	            $arralt = explode('&quot;',$matchalttmp[0]);
	            $description_tmp = $arralt[1];
	        }
	    }
	
	
	    //echo "=====".$source[0];
	    if ($override_title || ! in_array('title=', $pieces)) {
	
	        $titletext_rep = str_replace("%title", $title, $titletext_rep);
	        $titletext_rep = str_replace("%forum", $forumname, $titletext_rep);
	        $titletext_rep = str_replace("%name", $source[0], $titletext_rep );
	        $titletext_rep = str_replace("%tags", $tagsword, $titletext_rep );
	        $titletext_rep = str_replace("%imgdesc", $description_tmp, $titletext_rep );
	
	        if (strrpos($titletext_rep, "%num") !== false) {
	            $titletext_rep = str_replace("%num", $this->num, $titletext_rep );
	        }
	
	        // $titletext_rep = ucwords( strtolower( $titletext_rep ) );
	        if (! in_array('title=', $pieces)) {
	            array_push($pieces, ' title="' . $titletext_rep . '"');
	        } else {
	            $index = array_search('title=', $pieces);
	            $pieces[$index + 1] = '"' . $titletext_rep . '" ';
	        }
	    }
	    if ($override_alt || ! in_array('alt=', $pieces)) {
	        $alttext_rep = str_replace("%title", $title, $alttext_rep);
	        $alttext_rep = str_replace("%forum", $forumname, $alttext_rep);
	        $alttext_rep = str_replace("%name", $source[0], $alttext_rep );
	        $alttext_rep = str_replace("%tags", $tagsword, $alttext_rep );
	        $alttext_rep = str_replace("%imgdesc", $description_tmp, $alttext_rep );
	
	        if (strrpos($alttext_rep, "%num") !== false) {
	            $alttext_rep = str_replace("%num", $this->num, $alttext_rep );
	        }
	
	        if (! in_array('alt=', $pieces)) {
	            array_push($pieces, ' alt="' . $alttext_rep . '"');
	        } else {
	            $index = array_search('alt=', $pieces);
	            $pieces[$index + 1] = '"' . $alttext_rep . '" ';
	        }
	    }
	    //echo "=======".$titletext_rep;
	    //var_dump($pieces);
	    return implode('', $pieces) . ' /';
	}
	
	 
	function seo_images_featured($variables,$pid)
	{
	    global $_G;
	    loadcache('plugin');
	    $_config = $_G['cache']['plugin']['jzsjiale_seo_alt'];
	
	    $fid = $_G['fid'];
	
	    $this->wordtags = "";
	    $forumname = "";
	    $tidtitle = $variables['postlist'][$pid]['subject'];
	    $content = $variables['postlist'][$pid]['message'];
	    //20150601
	    $tags = $variables['postlist'][$pid]['tags'];
	    
	    //20160215
	    $attachments = $variables['postlist'][$pid]['attachments'];
	    
	    $replacedcontent = "";
	
	    loadcache(array(
	    'forums',
	    'grouptype'
	        ));
	    
	    if (empty($_G['cache']['forums']))
	        $_G['cache']['forums'] = array();
	
	    foreach ($_G['cache']['forums'] as $fidcache => $forum) {
	        if ($fid == $fidcache) {
	            $forumname = $forum['name'];
	        }
	    }
	
	    $this->process_parameters['alt'] = $_config["g_alt"];
	    $this->process_parameters['title'] = $_config["g_title"];
	    $this->process_parameters['override_alt'] = $_config["g_isoverride_alt"];
	    $this->process_parameters['override_title'] = $_config["g_isoverride_title"];
	    $this->process_parameters['forumname'] = $forumname;
	    $this->process_parameters['tidtitle'] = $tidtitle;
	    $this->process_parameters['contenthtml'] = $content;
	    //20150601
	    $this->process_parameters['istags'] = $_config["g_istags"];
	    $this->process_parameters['tags'] = $tags;
	    //20160215
	    $this->process_parameters['attachments'] = $attachments;
	
	    $replaced = preg_replace_callback('/<img[^>]+/', array(
	        $this,
	        'seo_images_process'
	    ), $content);
	    

	    
	    
	    return $replaced;
	
	    return $html;
	}
	
	function seo_images_featured_h($variables,$pid)
	{
	    global $_G;
	    loadcache('plugin');
	    $_config = $_G['cache']['plugin']['jzsjiale_seo_alt'];
	
	    $fid = $_G['fid'];
	
	    $this->wordtags = "";
	    $forumname = "";
	    $tidtitle = $variables['postlist'][0]['subject'];
	    $firstcontent = $variables['postlist'][0]['message'];
	    $content = $variables['postlist'][$pid]['message'];
	    //20150601
	    $tags = $variables['postlist'][0]['tags'];
	    //20160215
	    $attachments = $variables['postlist'][$pid]['attachments'];
	    
	    $replacedcontent = "";
	
	    loadcache(array(
	    'forums',
	    'grouptype'
	        ));
	     
	    if (empty($_G['cache']['forums']))
	        $_G['cache']['forums'] = array();
	
	    foreach ($_G['cache']['forums'] as $fidcache => $forum) {
	        if ($fid == $fidcache) {
	            $forumname = $forum['name'];
	        }
	    }
	
	    $this->process_parameters['alt'] = $_config["g_alt"];
	    $this->process_parameters['title'] = $_config["g_title"];
	    $this->process_parameters['override_alt'] = $_config["g_isoverride_alt"];
	    $this->process_parameters['override_title'] = $_config["g_isoverride_title"];
	    $this->process_parameters['forumname'] = $forumname;
	    $this->process_parameters['tidtitle'] = $tidtitle;
	    $this->process_parameters['contenthtml'] = $firstcontent;
	    //20150601
	    $this->process_parameters['istags'] = $_config["g_istags"];
	    $this->process_parameters['tags'] = $tags;
	    //20160215
	    $this->process_parameters['attachments'] = $attachments;
	    
	    $replaced = preg_replace_callback('/<img[^>]+/', array(
	        $this,
	        'seo_images_process'
	    ), $content);
	     
	
	    return $replaced;
	
	    return $html;
	}
	
	function seo_images_process_attach($variables,$pid,$matches)
	{
	    global $_G;
	    loadcache('plugin');
	    $_config = $_G['cache']['plugin']['jzsjiale_seo_alt'];
	
	    $fid = $_G['fid'];
	
	    $this->wordtags = "";
	    $forumname = "";
	    $tidtitle = $variables['postlist'][$pid]['subject'];
	    $content = $variables['postlist'][$pid]['message'];
	    //20150601
	    $tags = $variables['postlist'][$pid]['tags'];
	    
	    $replacedcontent = "";
	
	    loadcache(array(
	    'forums',
	    'grouptype'
	        ));
	    
	    if (empty($_G['cache']['forums']))
	        $_G['cache']['forums'] = array();
	
	    foreach ($_G['cache']['forums'] as $fidcache => $forum) {
	        if ($fid == $fidcache) {
	            $forumname = $forum['name'];
	        }
	    }
	
	    
	    $alttext_rep = $this->alt_alt;
	    $titletext_rep = $this->alt_title;
	    $override_alt = $this->alt_isoverridealt;
	    $override_title = $this->alt_isoverridetitle;
	    $title = $tidtitle;
	    //20150601
	    $istags = $this->alt_istags;
	    
	
	    // ## Swap with file's base name.
	    preg_match('%[^/]+(?=\.[a-z]{3}(\z|(?=\?)))%', $matches['attachment'], $source);
	
	    $tagsword = "";
	    //20150601 $istags
	    if($istags){
	        if (strrpos($alttext_rep, "%tags") !== false || strrpos($titletext_rep, "%tags") !== false) {
	            if(empty($this->wordtags)){
	                $tagsword = $this->get_discuz_tags($tags);
	                $this->wordtags = $tagsword;
	            }else{
	                $tagsword = $this->wordtags;
	            }
	    
	    
	        }
	    }else{
	        if (strrpos($alttext_rep, "%tags") !== false || strrpos($titletext_rep, "%tags") !== false) {
	            if(empty($this->wordtags)){
	                $tagsword = $this->keyWord($title,$content);
	                $this->wordtags = $tagsword;
	            }else{
	                $tagsword = $this->wordtags;
	            }
	        
	        
	        } 
	    }
	    
	
	    if (strrpos($alttext_rep, "%num") !== false || strrpos($titletext_rep, "%num") !== false) {
	        $this->num = $this->num + 1;
	    }
	
	    
	    $titletext_rep = str_replace("%title", $title, $titletext_rep);
	    $titletext_rep = str_replace("%forum", $forumname, $titletext_rep);
	    $titletext_rep = str_replace("%name", $source[0], $titletext_rep );
	    $titletext_rep = str_replace("%tags", $tagsword, $titletext_rep );
	    $titletext_rep = str_replace("%imgdesc", $matches['description'], $titletext_rep );
	    if (strrpos($titletext_rep, "%num") !== false) {
	        $titletext_rep = str_replace("%num", $this->num, $titletext_rep );
	    }
	    
	    
	    $alttext_rep = str_replace("%title", $title, $alttext_rep);
	    $alttext_rep = str_replace("%forum", $forumname, $alttext_rep);
	    $alttext_rep = str_replace("%name", $source[0], $alttext_rep );
	    $alttext_rep = str_replace("%tags", $tagsword, $alttext_rep );
	    $alttext_rep = str_replace("%imgdesc", $matches['description'], $alttext_rep );
	    if (strrpos($alttext_rep, "%num") !== false) {
	        $alttext_rep = str_replace("%num", $this->num, $alttext_rep );
	    }
	    
	    $ret = "alt=\"".$alttext_rep."\" title=\"".$titletext_rep."\"";
	    //var_dump($pieces);
	    return $ret;
	}
	
	//20150601
	function get_discuz_tags($tags,$specialchars=true){
	    if(!$specialchars){
	        return $tags;
	    }else{
	        $return = '';
	        if($tags) {
	            foreach($tags as $kw) {
	                $kw = dhtmlspecialchars($kw[1]);
	                $return .= $kw.',';
	            }
	            $return = dhtmlspecialchars($return);
	        }
	        $return = substr($return, 0, strlen($return)-1);
	        return $return;
	    }
	}
	
	function keyWord($title,$content,$specialchars=true){
	    $subjectenc = rawurlencode(strip_tags($title));
	
	    if(strlen($content)>2400){
	        $content =  mb_substr($content, 0, 800, CHARSET);
	    }
	     
	    $messageenc = rawurlencode(strip_tags(preg_replace("/\[.+?\]/U", '', $content)));
	
	    $url = "http://keyword.discuz.com/related_kw.html?ics=".CHARSET."&ocs=".CHARSET."&title=".$subjectenc."&content=".$messageenc;
	    $xml_array=simplexml_load_file($url);
	    $result = $xml_array->keyword->result;
	
	    if($result) {
	
	        if(PHP_VERSION > '5' && CHARSET != 'utf-8') {
	            require_once libfile('class/chinese');
	            $chs = new Chinese('utf-8', CHARSET);
	        }
	
	
	
	        //20150505更新关键词过滤 开始
	         
	        //var_dump($this->cachekeywords);
	        $jzsjiale_seo_alt_utils = DISCUZ_ROOT.'./source/plugin/jzsjiale_seo_alt/utils.class.php';
	        require_once $jzsjiale_seo_alt_utils;
	        $utilsclass = 'utils';
	        $utilsclass = new $utilsclass();
	        
	        $kws = array();
	        foreach ($result->item as $key => $value) {
	            $kwtmp = !empty($chs) ? $chs->convert(trim($value->kw)) : trim($value->kw);
	            //echo "++++".$kwtmp.")))".$utilsclass->in_2array($kwtmp,$this->cachekeywords);
	            if(!$utilsclass->in_2array($kwtmp,$this->cachekeywords)){
	                $kws[] = $kwtmp;
	            }
	        }
	        
	        //20150505更新关键词过滤 结束
	        
	
	        if(!$specialchars){
	            return $kws;
	        }else{
	            $return = '';
	            if($kws) {
	                foreach($kws as $kw) {
	                    $kw = dhtmlspecialchars($kw);
	                    $return .= $kw.',';
	                }
	                $return = dhtmlspecialchars($return);
	            }
	            $return = substr($return, 0, strlen($return)-1);
	            return $return;
	        }
	
	    }
	}
	
	function setvalues($altsettingvalue) {
	     
	    //global $alt_isopen,$alt_huifu,$alt_alt,$alt_title,$alt_isoverridealt,$alt_isoverridetitle,$alt_istags,$alt_starttime,$alt_endtime;
	    $this->alt_isopen  = $altsettingvalue ['isopen'];
	    $this->alt_huifu  = $altsettingvalue ['huifu'];
	    $this->alt_alt  = $altsettingvalue ['alt'];
	    $this->alt_title  = $altsettingvalue ['title'];
	    $this->alt_isoverridealt  = $altsettingvalue ['isoverridealt'];
	    $this->alt_isoverridetitle  = $altsettingvalue ['isoverridetitle'];
	    $this->alt_istags = $altsettingvalue ['istags'];
	    $this->alt_starttime  = $altsettingvalue ['starttime'];
	    $this->alt_endtime = $altsettingvalue ['endtime'];
	
	    return;
	}
	
	function gettimeisok($starttime,$endtime){
	    $isok = false;
	    $nowtime = TIMESTAMP;
	    if(empty($starttime) && empty($endtime)){
	        $isok = true;
	    }elseif (!empty($starttime) && empty($endtime)){
	        if($starttime <= $nowtime){
	            $isok = true;
	        }else{
	            $isok = false;
	        }
	    }elseif (empty($starttime) && !empty($endtime)){
	        if($endtime >= $nowtime){
	            $isok = true;
	        }else{
	            $isok = false;
	        }
	    }elseif (!empty($starttime) && !empty($endtime)){
	        if($starttime <= $nowtime && $endtime >= $nowtime){
	            $isok = true;
	        }else{
	            $isok = false;
	        }
	    }else{
	        $isok = false;
	    }
	    return $isok;
	}
}
