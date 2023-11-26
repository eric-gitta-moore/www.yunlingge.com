<?php

/**
 * 	[外部链接本地打开(laoyang_wailian.{modulename})] (C)2012-2099 Powered by 吉他社(www.jitashe.net).
 * 	Version: 1.0
 * 	Date: 2012-11-22 13:47
 */
if (!defined('IN_DISCUZ'))
{
    exit('Access Denied');
}

class plugin_laoyang_wailian
{
    public function viewthread_postbottom_output()
    {
        global $postlist,$threadsortshow;        
        foreach ($postlist as $id => &$post)
        {
            $post['message'] = $this->wailian_replace($post['message']);
            $post['signature'] = $this->wailian_replace($post['signature']);
        }
        
        foreach ($threadsortshow["optionlist"] as $k => &$v)
        {            
            $v['value'] = $this->wailian_replace($v['value']);
        }  
        unset($post);
        return array();
    }

    function wailian_replace($content)
    {
        $preg_searchs = "/\<a href\=\"http\:\/\/(.+?)\"/ie";
        $preg_replaces = '$this->iframe_url(\'\\1\')';   
        $content = preg_replace($preg_searchs, $preg_replaces, $content);
        return $content;
    }

    function iframe_url($url)
    {       
        global $_G;
        $config=$_G['cache']['plugin']['laoyang_wailian'];
        $wlist = $config['baimingdan'];
        $wlist=explode("\r\n", $wlist);
        $currentdomain=  str_replace('http://', '', $_G['siteurl']);
        $currentdomain=trim($currentdomain,'/');
        $wlist[]=$currentdomain;
        $domain=  explode('/', $url);
        $domain=$domain[0];
        if(in_array($domain, $wlist))
        {
            return "<a href=\"http://$url\"";
        }
        else{
            $url = strtr(base64_encode('http://'.$url), '+/=', '-_,');
            if($config['url_rewrite']&&!empty($config['url_rewrite_code']))
            {
                $url=  str_replace('{url}', $url, $config['url_rewrite_code']);
            }
            else
            {
                $url="plugin.php?id=laoyang_wailian&url=".$url;
            }
            if($config['login_check']&&!$_G['uid'])
            {
                return "<a title=\"登陆后查看\" onclick=\"showWindow('login', 'member.php?mod=logging&action=login')\" rel=\"nofollow\" href=\"".$url."\"";
            }
            else
            {
                return "<a rel=\"nofollow\" href=\"".$url."\"";
            }
            
        }
        
    }
    
}

class plugin_laoyang_wailian_group extends plugin_laoyang_wailian{}

class plugin_laoyang_wailian_forum extends plugin_laoyang_wailian{}

class plugin_laoyang_wailian_portal extends plugin_laoyang_wailian
{
        function view_article_content_output()
    {
        global $content;
        $content['content'] = $this->wailian_replace($content['content']);
        return array();
    }
}

class plugin_laoyang_wailian_home extends plugin_laoyang_wailian
{
    function space_blog_op_extra_output()
    {
        global $blog;
        $blog['message'] = $this->wailian_replace($blog['message']);
        return array();
    }
    
    function space_blog_comment_bottom_output()
    {
        global $list;
        foreach ($list as &$post)
        {
            $post['message'] = $this->wailian_replace($post['message']);
        }
        unset($post);
        return array();        
    }
    function space_album_pic_bottom_output()
    {
        $this->space_blog_comment_bottom_output();
    }    
     function space_wall_face_extra_output()
    {
         $this->space_blog_comment_bottom_output();
    }       
    
    function follow_top_output()
    {
        global $list;
          foreach ($list['content'] as &$post)
        {
            $post['content'] = $this->wailian_replace($post['content']);
        }
        unset($post);
        return array();  
    }
}

?>