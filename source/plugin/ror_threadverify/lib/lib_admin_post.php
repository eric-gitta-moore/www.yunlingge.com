<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

/**
 * lib_admin_post Class
 * @package plugin
 * @subpackage ror
 * @category threadverify
 * @author ror
 * @link
 */
class lib_admin_post
{
    protected static $table = 'plugin_post';
    
    protected static $limit = 10;
    protected static $limit_max = 90;
    
    public static function post_moderate_list()
    {
        global $_G;

        $escape['author'] = $_GET['author'] ? lib_base::escape($_GET['author']) : '';
        $escape['title'] = $_GET['subject'] ? lib_base::escape($_GET['subject']) : '';
    
        $page = $_GET['page'] ? intval($_GET['page']) : 1;
        $limit = $_GET['limit'] ? ($_GET['limit'] > self::$limit_max ? self::$limit_max : intval($_GET['limit'])) : self::$limit;
        $status = $_GET['status'] ? intval($_GET['status']) : 0;
        $modfid = $_GET['modfid'] ? intval($_GET['modfid']) : 0;
        $dateline = $_GET['dateline'] ? intval($_GET['dateline']) : 0;
        
        $srcdate = $dateline ? (TIMESTAMP - $dateline) : 0;
        
        loadcache('posttableids');
        $posttable = in_array($_GET['posttableid'], $_G['cache']['posttableids']) ? $_GET['posttableid'] : 0;

        $offset = ($page - 1) * $limit;
    
        $submit = lib_base::admin_url('post_moderate_list');
        $submit .= '&status='.$status.'&limit='.$limit.'&modfid='.$modfid.'&dateline='.$dateline.'&author='.$escape['author'].'&subject='.$escape['title'].'&posttableid='.$posttable;
        
    	$moderatestatus = $status;
    	$modcount = C::t('common_moderate')->count_by_search_for_post(getposttable($posttable), $moderatestatus, 0, $modfid, $escape['author'], $srcdate, $escape['title']);
    	$postarr = C::t('common_moderate')->fetch_all_by_search_for_post(getposttable($posttable), $moderatestatus, 0, $modfid, $escape['author'], $srcdate, $escape['title'], $offset, $limit);
    	if($postarr) {
    		$_tids = $_fids = array();
    		foreach($postarr as $_post) {
    			$_fids[$_post['fid']] = $_post['fid'];
    			$_tids[$_post['tid']] = $_post['tid'];
    		}
    		$_forums = C::t('forum_forum')->fetch_all($_fids);
    		$_threads = C::t('forum_thread')->fetch_all($_tids);
    	}
    	$checklength = C::t('common_moderate')->fetch_all_by_idtype('pid', $moderatestatus, null);
    	if($modcount != $checklength && ! $srcdate && ! $escape['author'] && ! $escape['title'] && ! $posttable) {
    		lib_base::table(self::$table)->moderateswipe('pid', array_keys($checklength));
    	}

        require_once libfile('function/forumlist');
        require_once libfile('function/discuzcode');
        require_once libfile('function/attachment');
        require_once libfile('function/misc');
        require_once libfile('function/admincp');

        $modreasonoptions = '<option>'.lib_base::lang('field_nodata').'</option><option>--------</option>'.modreasonselect(1);
        
        loadcache('forums');
        $forums = $_G['cache']['forums'];
        
        $host = $_G['siteurl'];
        $url_hotlinking = lib_base::url('pic').'&url=';

        foreach($postarr as $key => & $post)
        {
            $_forum = $_forums[$post['fid']];
            $_arr = array(
                'forumname' => $_forum['name'],
                'allowsmilies' => $_forum['allowsmilies'],
                'allowhtml' => $_forum['allowhtml'],
                'allowbbcode' => $_forum['allowbbcode'],
                'allowimgcode' => $_forum['allowimgcode'],
            );
            $post = array_merge($post, $_arr);
            
            if(getstatus($post['status'], 5)) {
                $post['authorid'] = 0;
                $post['author'] = cplang('moderate_t_comment');
            }
            
            $post['dateline'] = dgmdate($post['dateline']);
            $post['tsubject'] = $_threads[$post['tid']]['subject'];
            $post['isgroup'] = $_threads[$post['tid']]['isgroup'];
            $post['subject'] = $post['subject'] ? '<b>'.$post['subject'].'</b>' : '';
            $post['message'] = discuzcode($post['message'], $post['smileyoff'], $post['bbcodeoff'], sprintf('%00b', $post['htmlon']), $post['allowsmilies'], $post['allowbbcode'], $post['allowimgcode'], $post['allowhtml']);
            $post['message'] = str_replace(array('onmouseover','onload','onclick'), '', $post['message']);
            $post['censorwords'] = lib_base::table(self::$table)->censor($post['subject'], $post['message']);
            $post['modthreadkey'] = modauthkey($post['tid']);
            $post['useip'] = $post['useip'] . '-' . convertip($post['useip']);
            $post['pic'] = array('title'=>lib_base::lang('pic_view'),'id'=>$post['tid'],'start'=>0,'data'=>array());

            $post['message'] .= '<div class="layui-row layui-col-space10">';
            if($post['attachment'])
            {
                $i = 0;
                foreach(C::t('forum_attachment_n')->fetch_all_by_id('tid:'.$post['tid'], 'pid', $post['pid']) as $attach)
                {
                    $_G['setting']['attachurl'] = $attach['remote'] ? $_G['setting']['ftp']['attachurl'] : $_G['setting']['attachurl'];
                    
                    $image_title = lib_base::lang('attach').' '.($attach['isimage']?'':attachtype(fileext($attach['filename'])."\t")).$attach['filename'].'('.sizecount($attach['filesize']).')';
                    $url = $_G['setting']['attachurl'].'forum/'.$attach['attachment'];
                    
                    $attach['url'] = $attach['isimage'] ? '<img onclick=\'pic_show('.$post['pid'].', '.$i.')\' src="'.$url.'" title="'.$image_title.'">' : $image_title.'<br><a href="'.$url.'" target="_blank">'.$attach['filename'].'</a>';
                    
                    $post['message'] .= '<div class="layui-col-sm4 layui-col-md3 layui-col-lg2"><div class="layui-card attach-img">'.$attach['url'].'</div></div>';
                    
                    if($attach['isimage']){
                        $post['pic']['data'][] = array(
                            'alt'=>$attach['filename'],
                            'pid'=>$attach['aid'],
                            'src'=>'/'.$url,
                            //'thumb'=>'/'.$url,
                        );
                    }
                    
                    $i++;
                }
            }
            $post['message'] .= '</div>';
        }

        $count = $modcount;
        $page_count = ceil($count / $limit);
        $paging = lib_func::paging($page_count, $page, $submit.'&page=', $limit, $count);

        $author = $escape['author'];
        $subject = $escape['title'];
        $moderate_status_select = lib_func::select_option(lib_base::table(self::$table)->moderate_status, $status);
        $post_dateline_select = lib_func::select_option(lib_base::table(self::$table)->post_dateline, $dateline);
        
        $forum_select = '<option value="0"'.($modfid==0?'selected':'').'>'.lib_base::lang('thread_all').'</option>';
        $forum_select .= forumselect(FALSE, 0, $modfid);

        $thread_moderate_url = lib_base::admin_url('thread_moderate_list');
        $post_moderate_url = lib_base::admin_url('post_moderate_list');
        $article_moderate_url = lib_base::admin_url('article_moderate_list');
        
        $lang_thread_moderate = lib_base::lang('thread_moderate');
        $lang_post_moderate = lib_base::lang('post_moderate');
        $lang_article_moderate = lib_base::lang('article_moderate');
        $lang_content_show = lib_base::lang('content_show');
        $lang_content_hide = lib_base::lang('content_hide');
        $lang_author = lib_base::lang('author');
        $lang_content = lib_base::lang('content');
        $lang_moderate_range = lib_base::lang('moderate_range');
        $lang_search = lib_base::lang('search');
        $lang_post_moderate_nodata = lib_base::lang('post_moderate_nodata');
        $lang_censorwords = lib_base::lang('censorwords');
        $lang_group = lib_base::lang('group');
        $lang_forum = lib_base::lang('forum');
        $lang_in = lib_base::lang('in');
        $lang_publish = lib_base::lang('publish');
        $lang_from = lib_base::lang('from');
        $lang_thread_detail = lib_base::lang('thread_detail');
        $lang_thread_edit = lib_base::lang('thread_edit');
        $lang_look = lib_base::lang('look');
        $lang_edit = lib_base::lang('edit');
        $lang_validate = lib_base::lang('validate');
        $lang_delete = lib_base::lang('delete');
        $lang_ignore = lib_base::lang('ignore');
        $lang_button = lib_base::lang('button');
        $lang_validate_all = lib_base::lang('validate_all');
        $lang_delete_all = lib_base::lang('delete_all');
        $lang_ignore_all = lib_base::lang('ignore_all');
        $lang_cancel_all = lib_base::lang('cancel_all');
        $lang_op_reason = lib_base::lang('op_reason');
        
        $content = '<script>var photos = [];</script>';
        $content .= <<<EOT
<div class="layui-card" style="padding:5px 15px 0 15px;">
<div class="layui-box layui-laypage layui-laypage-default">
<a href="{$thread_moderate_url}">{$lang_thread_moderate}</a>
<a href="{$post_moderate_url}" style="color:#009688;">{$lang_post_moderate}</a>
<a href="{$article_moderate_url}">{$lang_article_moderate}</a>
<a href="javascript:;" onclick="$('.layui-card-body').show()">{$lang_content_show}</a>
<a href="javascript:;" onclick="$('.layui-card-body').hide()">{$lang_content_hide}</a>
<span class="layui-laypage-limits" style="margin:0;"><input name="author" type="text" placeholder="{$lang_author}" style="width:100px;margin:0;" value="{$author}"></span>
<span class="layui-laypage-limits" style="margin:0;"><input name="subject" type="text" placeholder="{$lang_content}" style="width:100px;margin:0;"value="{$subject}"}></span>
<a>{$lang_moderate_range}</a>
<span class="layui-laypage-limits" style="margin:0;"><select name="status" lay-ignore>{$moderate_status_select}</select></span>
<span class="layui-laypage-limits" style="margin:0;"><select name="modfid" lay-ignore>{$forum_select}</select></span>
<span class="layui-laypage-limits" style="margin:0;"><select name="dateline" lay-ignore>{$post_dateline_select}</select></span>  
</div>
<button class="layui-btn layui-btn-sm" onclick="$('body').find('form').submit();" style="margin-top:-5px;">{$lang_search}</button>
</div>
EOT;
        if(! $postarr){
            $content .= '<div class="layui-card"><div class="layui-card-body" style="text-align:center;">'.$lang_post_moderate_nodata.'</div></div>';
        }
        
        foreach($postarr as $value)
        {
            $censorwords = $value['censorwords']?' '.$lang_censorwords.'<span style="color: #FF0000;">'.$value['censorwords'].'</span>':'';
            $pic_json = json_encode($value['pic']);
            $source_type = $value['isgroup']?'<a href="forum.php?mod=group&fid='.$value['fid'].'" target="_blank">'.$lang_group.'</a>':'<a href="forum.php?mod=forumdisplay&fid='.$value['fid'].'" target="_blank">'.$lang_forum.'-'.$value['forumname'].'</a>';
            $value['subject'] && $value['tsubject'] .= ' &rsaquo; '.$value['subject'];
            
            $content .= <<<EOT
            
<div class="layui-card">
    <div class="layui-card-header"><h3 onclick="show_content($(this))"><a href="javascript:;">{$value['tsubject']}</a></h3></div>
    <div class="layui-card-body">
        <p>
        <a href="admin.php?frames=yes&action=members&operation=search&uid={$value['authorid']}&submit=yes" target="_blank">{$value['author']}</a>
       {$lang_in} {$value['dateline']} {$lang_publish}
       {$source_type}
       {$lang_from} {$value['useip']}
       {$censorwords}&nbsp;
       <a href="javascript:detail_show('{$lang_thread_detail}', 'forum.php?mod=redirect&goto=findpost&ptid={$value['tid']}&pid={$value['pid']}&modthreadkey={$value['modthreadkey']}');">{$lang_look}</a>
       &nbsp;<a href="javascript:detail_show('{$lang_thread_edit}', 'forum.php?mod=post&action=edit&fid={$value['fid']}&tid={$value['tid']}&pid={$value['pid']}&modthreadkey={$value['modthreadkey']}');">{$lang_edit}</a>
       </p>
       {$value['message']}
    </div>
            
    <div class="layui-card-header" style="border-top:1px solid #f6f6f6;position:relative;">
    <input onclick="bg_show($(this), 'validate')" class="radio" type="radio" name="moderate[{$value['pid']}]" value="validate" lay-ignore=""> <label>{$lang_validate}</label>&nbsp;&nbsp;
    <input onclick="bg_show($(this), 'delete')" class="radio" type="radio" name="moderate[{$value['pid']}]" value="delete" lay-ignore=""> <label>{$lang_delete}</label>&nbsp;&nbsp;
    <input onclick="bg_show($(this), 'ignore')" class="radio" type="radio" name="moderate[{$value['pid']}]" value="ignore" lay-ignore=""> <label>{$lang_ignore}</label>
    &nbsp;&nbsp;&nbsp;
    <a href="javascript:;" onclick="verify($(this), 'validate', {$value['pid']}, {$posttable})">{$lang_validate}</a> -
    <a href="javascript:;" onclick="verify($(this), 'delete', {$value['pid']}, {$posttable})">{$lang_delete}</a> -
    <a href="javascript:;" onclick="verify($(this), 'ignore', {$value['pid']}, {$posttable})">{$lang_ignore}</a>
    &nbsp;&nbsp;&nbsp;   
    {$lang_op_reason}
    <input type="text" name="pm_{$value['pid']}" id="pm_{$value['pid']}" class="op_input" style="width:100px;">
    <select onchange="$('#pm_{$value['pid']}').val(this.value)" class="op_select" lay-ignore>{$modreasonoptions}</select>
    </div>
</div>
<script>photos[{$value['pid']}] = {$pic_json};</script>
EOT;
        }
        
        $content .= <<<EOT
<div class="layui-card footer" style="padding:5px 15px 0 15px;">
<button class="layui-btn layui-btn-sm" onclick="verify_bath();return false;" style="margin-top:-5px;">提交</button>
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
        
        $moderate_post_url = lib_base::admin_url('moderate_post');
        
        $hidden = <<<EOT
<style type="text/css">
.layui-fluid{padding-bottom:60px;}
.layui-card-body{max-height:220px;overflow-y:auto;}
.attach-img img{max-width:300px;max-height:200px;cursor:pointer;}
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
            
function verify(e, type, pid, posttableid){
    var url = '{$moderate_post_url}&posttableid='+posttableid+'&moderate['+pid+']='+type;
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
    var url = '{$moderate_post_url}';
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
    
    public static function moderate_post()
    {
        $moderate = $_GET['moderate'];
        
        $result = lib_base::table(self::$table)->moderate_post($moderate);

        $msg = sprintf(lib_base::lang('post_moderate_success'), $result['validates'], $result['ignores'], $result['recycles'], $result['deletes']);
        
        lib_base::back_text($msg, 0);
    }
}