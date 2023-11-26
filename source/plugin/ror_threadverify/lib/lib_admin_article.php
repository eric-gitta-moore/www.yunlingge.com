<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * lib_admin_article Class
 * @package plugin
 * @subpackage ror
 * @category threadverify
 * @author ror
 * @link
 */
class lib_admin_article
{
    protected static $table = 'plugin_article';
    
    protected static $limit = 10;
    protected static $limit_max = 90;
    
    public static function article_moderate_list()
    {
        global $_G;

        $escape['author'] = $_GET['author'] ? lib_base::escape($_GET['author']) : '';

        $page = $_GET['page'] ? intval($_GET['page']) : 1;
        $limit = $_GET['limit'] ? ($_GET['limit'] > self::$limit_max ? self::$limit_max : intval($_GET['limit'])) : self::$limit;
        $status = $_GET['status'] ? intval($_GET['status']) : 0;
        $catid = $_GET['catid'] ? intval($_GET['catid']) : 0;
        $dateline = $_GET['dateline'] ? intval($_GET['dateline']) : 'all';

        $submit = lib_base::admin_url('article_moderate_list');
        $submit .= '&status='.$status.'&limit='.$limit.'&catid='.$catid.'&dateline='.$dateline.'&author='.$escape['author'];
        
        $pagetmp = $page;
        $moderatestatus = $status;
    	$modcount = C::t('common_moderate')->fetch_all_for_article($moderatestatus, $catid, $escape['author'], $dateline, 1);
    	do {
    		$start_limit = ($pagetmp - 1) * $limit;
    		$articlelist = C::t('common_moderate')->fetch_all_for_article($moderatestatus, $catid, $escape['author'], $dateline, 0, $start_limit, $limit);
    		$pagetmp = $pagetmp - 1;
    	} while($pagetmp > 0 && count($articlelist) == 0);
    	$page = $pagetmp + 1;
    	
//         require_once libfile('function/forumlist');
//         require_once libfile('function/discuzcode');
//         require_once libfile('function/attachment');
        require_once libfile('function/misc');
        
        
        $host = $_G['siteurl'];
        $url_hotlinking = lib_base::url('pic').'&url=';

        foreach($articlelist as $key => & $article)
        {
            $article['censorwords'] = lib_base::table(self::$table)->censor($article['title'], $article['summary']);
            $article['modarticlekey'] = modauthkey($article['aid']);
            
            //$article['pic'] = array('title'=>'图片预览','id'=>$article['tid'],'start'=>0,'data'=>array());
            
            $article['dateline'] = dgmdate($article['dateline']);
            
//             $thread['message'] .= '<div class="layui-row layui-col-space10">';
//             if($thread['attachment'])
//             {
//                 $i = 0;
//                 foreach(C::t('forum_attachment_n')->fetch_all_by_id('tid:'.$thread['tid'], 'tid', $thread['tid']) as $attach)
//                 {
//                     $_G['setting']['attachurl'] = $attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
                    
//                     $title = '附件: '.($attach['isimage']?'':attachtype(fileext($attach['filename'])."\t")).$attach['filename'].'('.sizecount($attach['filesize']).')';
//                     $url = $_G['setting']['attachurl'].'forum/'.$attach['attachment'];
                    
//                     $attach['url'] = $attach['isimage'] ? '<img onclick=\'pic_show('.$thread['tid'].', '.$i.')\' src="'.$url.'" title="'.$title.'">' : $title.'<br><a href="'.$url.'" target="_blank">'.$attach['filename'].'</a>';
                    
//                     $thread['message'] .= '<div class="layui-col-sm4 layui-col-md3 layui-col-lg2"><div class="layui-card">'.$attach['url'].'</div></div>';
                    
//                     if($attach['isimage']){
//                         $thread['pic'][] = array(
//                             'alt'=>$attach['filename'],
//                             'pid'=>$attach['aid'],
//                             'src'=>'/'.$url,
//                             //'thumb'=>'/'.$url,
//                         );
//                     }
                    
//                     $i++;
//                 }
//             }
//             $thread['message'] .= '</div>';
        }
 
        $count = $modcount;
        $page_count = ceil($count / $limit);
        $paging = lib_func::paging($page_count, $page, $submit.'&page=', $limit, $count);

        $author = $escape['author'];

        $moderate_status_select = lib_func::select_option(lib_base::table(self::$table)->moderate_status, $status);
        $article_dateline_select = lib_func::select_option(lib_base::table(self::$table)->article_dateline, $dateline);
        
        $cat_select = '<option value="0">'.lib_base::lang('cat_select0').'</option>';
        loadcache('portalcategory');
        foreach($_G['cache']['portalcategory'] as $cat) {
            $selected = $cat['catid'] == $catid ? ' selected' : '';
            $cat_select .= '<option value="'.$cat['catid'].'"'.$selected.'>'.$cat['catname'].'</option>';
        }

        $thread_moderate_url = lib_base::admin_url('thread_moderate_list');
        $post_moderate_url = lib_base::admin_url('post_moderate_list');
        $article_moderate_url = lib_base::admin_url('article_moderate_list');
        
        $lang_thread_moderate = lib_base::lang('thread_moderate');
        $lang_post_moderate = lib_base::lang('post_moderate');
        $lang_article_moderate = lib_base::lang('article_moderate');
        $lang_content_show = lib_base::lang('content_show');
        $lang_content_hide = lib_base::lang('content_hide');
        $lang_author = lib_base::lang('author');
        $lang_moderate_range = lib_base::lang('moderate_range');
        $lang_search = lib_base::lang('search');
        $lang_article_moderate_nodata = lib_base::lang('article_moderate_nodata');
        $lang_censorwords = lib_base::lang('censorwords');
        $lang_in = lib_base::lang('in');
        $lang_publish = lib_base::lang('publish');
        $lang_article_detail = lib_base::lang('article_detail');
        $lang_look = lib_base::lang('look');
        $lang_article_edit = lib_base::lang('article_edit');
        $lang_edit = lib_base::lang('edit');
        $lang_validate = lib_base::lang('validate');
        $lang_delete = lib_base::lang('delete');
        $lang_ignore = lib_base::lang('ignore');
        $lang_button = lib_base::lang('button');
        $lang_validate_all = lib_base::lang('validate_all');
        $lang_delete_all = lib_base::lang('delete_all');
        $lang_ignore_all = lib_base::lang('ignore_all');
        $lang_cancel_all = lib_base::lang('cancel_all');

        $content = '';
        $content .= <<<EOT
<div class="layui-card" style="padding:5px 15px 0 15px;">
<div class="layui-box layui-laypage layui-laypage-default">
<a href="{$thread_moderate_url}">{$lang_thread_moderate}</a>
<a href="{$post_moderate_url}">{$lang_post_moderate}</a>
<a href="{$article_moderate_url}" style="color:#009688;">{$lang_article_moderate}</a>
<a href="javascript:;" onclick="$('.layui-card-body').show()">{$lang_content_show}</a>
<a href="javascript:;" onclick="$('.layui-card-body').hide()">{$lang_content_hide}</a>
<span class="layui-laypage-limits" style="margin:0;"><input name="author" type="text" placeholder="{$lang_author}" style="width:100px;margin:0;" value="{$author}"></span>
<a>{$lang_moderate_range}</a>
<span class="layui-laypage-limits" style="margin:0;"><select name="status" lay-ignore>{$moderate_status_select}</select></span>
<span class="layui-laypage-limits" style="margin:0;"><select name="catid" lay-ignore>{$cat_select}</select></span>
<span class="layui-laypage-limits" style="margin:0;"><select name="dateline" lay-ignore>{$article_dateline_select}</select></span>  
</div>
<button class="layui-btn layui-btn-sm" onclick="$('body').find('form').submit();" style="margin-top:-5px;">{$lang_search}</button>
</div>
EOT;
        if(! $articlelist){
            $content .= '<div class="layui-card"><div class="layui-card-body" style="text-align:center;">'.$lang_article_moderate_nodata.'</div></div>';
        }
        
        foreach($articlelist as $value)
        {
            $censorwords = $value['censorwords'] ? ' '.$lang_censorwords.'<span style="color: #FF0000;">'.$value['censorwords'].'</span>' : '';
            //$pic_json = json_encode($value['pic']);
            
            $content .= <<<EOT
            
<div class="layui-card">
    <div class="layui-card-header"><h3 onclick="show_content($(this))"><a href="javascript:;">{$value['title']}</a></h3></div>
    <div class="layui-card-body">
        <p>
        <a href="admin.php?frames=yes&action=members&operation=search&uid={$value['uid']}&submit=yes" target="_blank">{$value['username']}</a>
        {$lang_in} {$value['dateline']} {$lang_publish}
       <a href="portal.php?mod=list&catid={$value['catid']}" target="_blank">{$value['catname']}</a>
       {$censorwords}&nbsp;
       <a href="javascript:detail_show('{$lang_article_detail}', 'portal.php?mod=view&aid={$value['aid']}&modarticlekey={$value['modthreadkey']}');">{$lang_look}</a>
       &nbsp;<a href="javascript:detail_show('{$lang_article_edit}', 'portal.php?mod=portalcp&ac=article&op=edit&aid={$value['aid']}&modarticlekey={$value['modthreadkey']}');">{$lang_edit}</a>
       </p>
        {$value['summary']}
    </div>
            
    <div class="layui-card-header" style="border-top:1px solid #f6f6f6;position:relative;">
    <input onclick="bg_show($(this), 'validate')" class="radio" type="radio" name="moderate[{$value['aid']}]" value="validate" lay-ignore> <label>{$lang_validate}</label>&nbsp;&nbsp;
    <input onclick="bg_show($(this), 'delete')" class="radio" type="radio" name="moderate[{$value['aid']}]" value="delete" lay-ignore> <label>{$lang_delete}</label>&nbsp;&nbsp;
    <input onclick="bg_show($(this), 'ignore')" class="radio" type="radio" name="moderate[{$value['aid']}]" value="ignore" lay-ignore> <label>{$lang_ignore}</label>
    &nbsp;&nbsp;&nbsp;    
    <a href="javascript:;" onclick="verify($(this), 'validate', {$value['aid']})">{$lang_validate}</a> -
    <a href="javascript:;" onclick="verify($(this), 'delete', {$value['aid']})">{$lang_delete}</a> -
    <a href="javascript:;" onclick="verify($(this), 'ignore', {$value['aid']})">{$lang_ignore}</a>
    </div>
</div>
EOT;
        }
        
        $content .= <<<EOT
<div class="layui-card footer" style="padding:5px 15px 0 15px;">
<button class="layui-btn layui-btn-sm" onclick="verify_bath();return false;" style="margin-top:-5px;">{$lang_button}</button>
<div class="layui-box layui-laypage layui-laypage-default">
<a href="javascript:;" onclick="op_all('validate')">{$lang_validate_all}</a>
<a href="javascript:;" onclick="op_all('delete')">{$lang_delete_all}</a>
<a href="javascript:;" onclick="op_all('ignore')">{$lang_ignore_all}</a>
<a href="javascript:;" onclick="op_cancel()">{$lang_cancel_all}</a>
</div>
{$paging}
<ul class="layui-fixbar" style="right:4px;bottom:4px;">
    <li class="layui-icon layui-fixbar-top layui-icon-top" lay-type="top" style="display: list-item;" onclick="$('html,body').animate({scrollTop: 0});"></li></ul>
</div>
EOT;
        
        $moderate_article_url = lib_base::admin_url('moderate_article');
        
        $hidden = <<<EOT
<style type="text/css">
.layui-fluid{padding-bottom:60px;}
.layui-form input[type=radio]{
    display: inline-block;
}
.op_input{
    display: inline-block;
    width: 100px;
    padding: 0 3px;
    text-align: center;
    height: 22px;
    line-height: 22px;
    border-radius: 2px;
    background-color: #fff;
    box-sizing: border-box;
    border: 1px solid #e2e2e2;
}
.op_select{
    height: 22px;
    border-radius: 2px;
    cursor: pointer;
    border: 1px solid #e2e2e2;
    margin-bottom:-5px;
    position:absolute;
    top:10px;
}
.radio{vertical-align:middle;margin-top:-3px;}
.footer{position:fixed;left:0;bottom:0;width:100%;}
</style>
<script type="text/javascript">
var color = {"validate":"layui-bg-green","delete":"layui-bg-red","ignore":"layui-bg-gray"};

function pic_show(tid, start){ 
    photos[tid].start = start;
    layer.photos({
        photos: photos[tid],
        anim: 5
    });
}
function detail_show(title, url){ 
    index = layer.open({
      type: 2
      ,title: title
      ,content: url
      ,maxmin: true
      ,area: ['1024px', '768px']
    }); 

	$(window).resize(function(){
		layer.full(index);
	});
    layer.full(index);
}
function show_content(e){ 
    e.parent().parent().find('.layui-card-body').toggle();
}
function bg_show(e, type){
    e = e.parent().parent();
    for(var i in color){
        e.removeClass(color[i]);
    }
    
    e.addClass(color[type]);
}
            
function verify(e, type, aid){
    var url = '{$moderate_article_url}&moderate['+aid+']='+type;
    $.ajax({
		dataType: 'json',
		type    : 'post',
		url     : url,
		success : function(data){
            e.parent().parent().remove();
        }
	});
}
        
function verify_bath(){
    var url = '{$moderate_article_url}';
    $.ajax({
        data    : $('#form').serialize(), 
		dataType: 'json',
		type    : 'post',
		url     : url,
		success : function(data){
            layer.msg(data.result);
            setTimeout(function(){location.reload();}, 2000);
        }
	});
}
        
function op_all(type){
    $('.layui-card').each(function(){
    
        $(this).find('.radio').each(function(){
            if($(this).val() == type){
                $(this).prop('checked', true);
            }else{
                $(this).prop('checked', false);
            }
        });
        
        if($(this).find('.layui-card-header').length){
            for(var i in color){
                $(this).removeClass(color[i]);
            }
            $(this).addClass(color[type]);
        }
    });
}
function op_cancel(){
    $('.layui-card').each(function(){
    
        $(this).find('.radio').each(function(){
            $(this).prop('checked', false);
        });
        
        if($(this).find('.layui-card-header').length){
            for(var i in color){
                $(this).removeClass(color[i]);
            }
        }
    });
}
</script>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function moderate_article()
    {
        $moderate = $_GET['moderate'];
        
        $result = lib_base::table(self::$table)->moderate_article($moderate);
        
        $msg = sprintf(lib_base::lang('article_moderate_success'), $result['validates'], $result['ignores'], $result['deletes']);
        
        lib_base::back_text($msg, 0);
    }
}