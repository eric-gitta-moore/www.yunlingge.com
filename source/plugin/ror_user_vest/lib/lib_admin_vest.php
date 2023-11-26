<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

/**
 * lib_admin_vest Class
 * @package plugin
 * @subpackage ror
 * @category grab
 * @author ror
 * @link
 */
class lib_admin_vest
{
    protected static $table = 'admin_vest';
    
    protected static $limit = 10;
    protected static $limit_max = 90;
    
    public static function index()
    {
        lib_base::header(lib_base::admin_url('local_vest_list'));
    }
    
    public static function local_vest_list()
    {
        $escape['search'] = lib_base::escape($_GET['search']);
        $escape['field'] = lib_base::escape($_GET['field']);
    
        $page = $_GET['page']?intval($_GET['page']):1;
        $limit = $_GET['limit']?($_GET['limit'] > self::$limit_max ? self::$limit_max : intval($_GET['limit'])):self::$limit;
    
        $fields = array('v.uid'=>'uid','v.weight'=>lib_base::lang('weight'),'username'=>lib_base::lang('vest_username'),'gender'=>lib_base::lang('gender'),'password'=>lib_base::lang('vest_password'),'source'=>lib_base::lang('vest_source'),'dateline'=>lib_base::lang('vest_dateline'));
        $tool = array(
            '<a class="layui-btn" onclick="Func.open({url:\''.lib_base::admin_url('local_vest_add').'\'})">'.lib_base::lang('add').'</a>',
            '<a class="layui-btn" onclick="Func.post({url:\''.lib_base::admin_url('local_vest_del').'\'})">'.lib_base::lang('delete').'</a>',
            '<a class="layui-btn" onclick="Func.open({url:\''.lib_base::admin_url('local_vest_import').'\'})">'.lib_base::lang('local_vest_import').'</a>',
            '<a class="layui-btn" onclick="get_uid()">'.lib_base::lang('vest_get_uid').'</a>',
            '<a class="layui-btn" onclick="Func.window({url:\''.lib_base::admin_url('share_vest_list').'\'})">'.lib_base::lang('share_vest').'</a>',
            '<a class="layui-btn" href="'.lib_base::admin_url('local_vest_export').'" target="_blank">'.lib_base::lang('local_vest_export').'</a>',
//             '<a class="layui-btn" onclick="Func.open({url:\''.lib_base::admin_url('grab_auth').'\'})">'.lib_base::lang('grab_auth').'</a>',
        );
        $submit = lib_base::admin_url('local_vest_list').'&limit='.$limit;
    
        $fields_str = lib_func::field_str($fields);
        $offset = ($page - 1) * $limit;
    
        $where = '';
        if($escape['search'] && $escape['field'] && array_key_exists($escape['field'], $fields)){
            $where .= "WHERE ".$escape['field']."='".$escape['search']."'";
            $submit .= '&search='.$escape['search'].'&field='.$escape['field'];
        }

        $list = lib_base::table(self::$table)->local_vest_list($fields_str, $offset, $limit, $where);
        foreach($list as & $value){
            $avatar = avatar($value['uid'], 'small', TRUE);
            $value['username'] = '<img width="30" src="'.$avatar.'"/> '.$value['username'];
            $value['source'] = '<a href="'.$value['source'].'" target="_blank">'.$value['source'].'</a>';
            $value['gender'] = lib_base::lang('gender'.$value['gender']);
        }
    
        $count = lib_base::table(self::$table)->local_vest_count($where);
        $page_count = ceil($count / $limit);
        $paging = lib_func::paging($page_count, $page, $submit.'&page=', $limit, $count);
        $search = lib_func::field_option(array('v.uid'=>'uid','username'=>lib_base::lang('vest_username')), $escape['field']);
    
        $formate['op'] = array(
            array('url'=>lib_base::admin_url('local_vest_del'),'name'=>lib_base::lang('delete'),type=>3,'confirm'=>FALSE),
            array('url'=>lib_base::admin_url('local_vest_weight').'&vest_id=','name'=>lib_base::lang('weight')),
        );
    
        $formate['batch'] = 1;
        $formate['time'] = array('dateline');
        $fields = lib_func::create_table($list, $fields, $formate);
        
        $url_uids = lib_base::admin_url('local_vest_uid');
        
        $lang_vest_uid_noselect = lib_base::lang('vest_uid_noselect');
        $vest_uid_get_title = lib_base::lang('vest_uid_get_title');
        
        $hidden = <<<EOT
<script type="text/javascript"/>
function get_uid()
{
    if($('input:checkbox:checked').length == 0)
    {
        $.ajax({
			dataType: 'html',
			type    : 'get',
			url     : '{$url_uids}',
			success : function(data){
			
				var rule = /\{(.*?)\}/;
				data = data.match(rule);
				data = JSON.parse(data[0]);
				
                if(data.state != 0){
                    layer.msg(data.result);
                    return;
                }
                
                layer.open({
                    title : '{$vest_uid_get_title}',
            		type : 1,
            		content : '<textarea class="layui-textarea" style="height:100%;">'+data.uids+'</textarea>',
            		maxmin: true,
            		area: ['900px', '600px']
                });
            }
		});
				
        return;
    }
    
    var uid = '';
    $.each($('input:checkbox:checked'), function(){
        if(/^\d+$/.test($(this).val())){
            uid += $(this).val()+',';
        }
    });
    uid = uid.substring(0, uid.length - 1);
            
    layer.open({
        title : '{$vest_uid_get_title}',
		type : 1,
		content : '<textarea class="layui-textarea" style="height:100%;">'+uid+'</textarea>',
		maxmin: true,
		area: ['900px', '600px']
    });
}
</script>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function local_vest_add()
    {
        $submit  = lib_base::admin_url('local_vest_added');

        $formhash = FORMHASH;
        
        $lang_header = lib_base::lang('local_vest_add_header');
        $lang_keyword_placeholder = lib_base::lang('local_vest_add_placeholder');
        $lang_submit = lib_base::lang('submit');
        $lang_reset = lib_base::lang('reset');
        
        $content = <<<EOT
<div class="layui-card">
    <div class="layui-card-header">{$lang_header}</div>
    <div class="layui-card-body">
    
        <div class="layui-form-item">
        	<div class="layui-input-block1">
                <textarea name="vest" class="layui-textarea" lay-verify="required" placeholder="{$lang_keyword_placeholder}" style="height:410px;"></textarea>
        	</div>
        </div>
      
        <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block1">
                <div class="layui-footer" style="left:0;">
                    <button type="button" class="layui-btn" lay-submit onclick="Func.post({})">{$lang_submit}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{$lang_reset}</button>
                </div>
            </div>
        </div>
        		    
    </div>
</div>
<input type="hidden" name="formhash" value="{$formhash}"/>
EOT;
        
        include lib_base::template('admin');
    }
    
    public static function local_vest_added()
    {
        $vest = $_GET['vest'];
        
        if(! $vest){
            lib_base::back_text(lib_base::lang('noparam'));
        }
    
        $vests = array();
        if(strpos($vest, ',') !== FALSE){
            $vests = explode(',', $vest);
        }else{
            $vests = explode("\n", $vest);
        }
        
        loaducenter();
        
        $html = '';
        foreach($vests as $username)
        {
            $username = trim($username);
            
            if(uc_get_user($username)){
                $html .= '<p>'.$username.":<span style='color:#FF5722;'>".lib_base::lang('vest_is_registered').'</span><p>';
                continue;
            }

            $result = lib_base::table(self::$table)->user_register($username);
            if($result['state'] != 0){
                $html .= '<p>'.$username.":<span style='color:#FF5722;'>".$result['result'].'</span><p>';
                continue;
            }
            
            $html .= '<p>'.$username.":<span style='color:#009688;'>".$result['result'].'</span><p>';
        }
    
        lib_base::back_text($html, 0);
    }
    
    public static function local_vest_import()
    {
        $submit  = lib_base::admin_url('local_vest_imported');
    
        $formhash = FORMHASH;
    
        $lang_header = lib_base::lang('local_vest_import_header');
        $lang_keyword_placeholder = lib_base::lang('local_vest_import_placeholder');
        $lang_submit = lib_base::lang('submit');
        $lang_reset = lib_base::lang('reset');
    
        $content = <<<EOT
<div class="layui-card">
    <div class="layui-card-header">{$lang_header}</div>
    <div class="layui-card-body">
    
        <div class="layui-form-item">
        	<div class="layui-input-block1">
                <textarea name="uid" class="layui-textarea" lay-verify="required" placeholder="{$lang_keyword_placeholder}" style="height:410px;"></textarea>
        	</div>
        </div>
    
        <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block1">
                <div class="layui-footer" style="left:0;">
                    <button type="button" class="layui-btn" lay-submit onclick="Func.post({})">{$lang_submit}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{$lang_reset}</button>
                </div>
            </div>
        </div>
    
    </div>
</div>
<input type="hidden" name="formhash" value="{$formhash}"/>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function local_vest_imported()
    {
        global $_G;
        
        $uid = $_GET['uid'];
    
        if(! $uid){
            lib_base::back_text(lib_base::lang('noparam'));
        }
    
        $host = $_G['siteurl'];
        $uids = array();
        if(strpos($uid, ',') !== FALSE){
            $uids = explode(',', $uid);
        }else{
            $uids = explode("\n", $uid);
        }
    
        $html = '';
        foreach($uids as $uid_str)
        {
            if(strpos($uid_str, '-') !== FALSE)
            {
                list($uid_min, $uid_max) = explode('-', $uid_str);
                for($i = $uid_min; $i <= $uid_max; $i++)
                {
                    $uid = intval($i);
                    
                    if(lib_base::table(self::$table)->vest_is_exist_by_uid($uid)){
                        $html .= '<p>'.$uid.":<span style='color:#FF5722;'>".lib_base::lang('vest_is_registered').'</span><p>';
                        continue;
                    }
                    
                    $user = getuserbyuid($uid, 1);
                    if(! $user){
                        $html .= '<p>'.$uid.":<span style='color:#FF5722;'>".lib_base::lang('user_is_noexist').'</span><p>';
                        continue;
                    }
                    
                    //记录马甲数据
                    $add = array(
                        'uid'=>$uid,
                        'username'=>$user['username'],
                        'password'=>'',
                        'source'=>$host,
                        'dateline'=>TIMESTAMP
                    );
                    lib_base::table(self::$table)->insert($add);
                    
                    $html .= '<p>'.$uid.":<span style='color:#009688;'>".lib_base::lang('import_success').'</span><p>';
                }
            }
            else 
            {
                $uid = intval($uid_str);
                if(lib_base::table(self::$table)->vest_is_exist_by_uid($uid)){
                    $html .= '<p>'.$uid.":<span style='color:#FF5722;'>".lib_base::lang('vest_is_registered').'</span><p>';
                    continue;
                }
                    
                $user = getuserbyuid($uid, 1);
                if(! $user){
                    $html .= '<p>'.$uid.":<span style='color:#FF5722;'>".lib_base::lang('user_is_noexist').'</span><p>';
                    continue;
                }
                
                //记录马甲数据
                $add = array(
                    'uid'=>$uid,
                    'username'=>$user['username'],
                    'password'=>'',
                    'source'=>$host,
                    'dateline'=>TIMESTAMP
                );
                lib_base::table(self::$table)->insert($add);
                
                $html .= '<p>'.$uid.":<span style='color:#009688;'>".lib_base::lang('import_success').'</span><p>';
            }

        }
    
        lib_base::back_text($html, 0);
    }
    
    public static function local_vest_del()
    {
        $id = $_GET['batch'] ? $_GET['batch'] : intval($_GET['ids']);
    
        if(! $id){
            lib_base::back_text(lib_base::lang('noselect'));
        }
    
        if(! lib_base::table(self::$table)->delete($id)){
            lib_base::back_text(lib_base::lang('nodelete'));
        }
    
        lib_base::back_json(array('reload'=>1));
    }
    
    public static function share_vest_list()
    {
        $escape['search'] = lib_base::escape($_GET['search']);
        $escape['field'] = lib_base::escape($_GET['field']);
    
        $page = $_GET['page'] ? intval($_GET['page']) : 1;
        $limit = $_GET['limit'] ? ($_GET['limit'] > self::$limit_max ? self::$limit_max : intval($_GET['limit'])) : self::$limit;
  
        $tool = array(
            '<div class="layui-inline"><a class="layui-btn" onclick="Func.post({url:\''.lib_base::admin_url('share_vest_register').'\'})">'.lib_base::lang('share_vest_register').'</a></div>',
            '<div class="layui-inline"><a class="layui-btn" onclick="Func.open({url:\''.lib_base::admin_url('share_vest_register_batch').'\'})">'.lib_base::lang('share_vest_register_batch').'</a></div>',
            //'<div class="layui-inline"><a class="layui-btn" href="'.lib_base::admin_url('share_vest_add').'">'.lib_base::lang('share_vest_add').'</a></div>',
        );
        $submit = lib_base::admin_url('share_vest_list').'&limit='.$limit;
    
        //gbk转码
        $search = $escape['search'];
        if(CHARSET == 'gbk'){
            $search = lib_base::string_gbk_to_utf8($search);
        }
        
        $post = array(
            'search'=>$search,
            'field'=>$escape['field'],
            'page'=>$page,
            'limit'=>$limit
        );

        $result = lib_func::curl(lib_base::$grab_host.lib_base::$grab_vest_list, $post);

        $result = json_decode($result, TRUE);
        
        //gbk转码
        if(CHARSET == 'gbk'){
            $result = lib_base::convert_utf8_to_gbk($result);
        }

        $list = $result['list'];
        foreach($list as & $value){
            $value['gender'] = lib_base::lang('gender'.$value['gender']);
        }

        $page_count = $result['page_count'];
        $paging = lib_func::paging($page_count, $page, $submit.'&'.$result['param'].'&page=', $limit, $result['count']);
        $search = lib_func::field_option($result['search'], $escape['field']);

        $formate['batch'] = 1;
        $fields = lib_func::create_table($list, $result['fields'], $formate);

        include lib_base::template('admin');
    }
    
    public static function share_vest_register()
    {
        $id = $_GET['batch'];

        if(! $id){
            lib_base::back_text(lib_base::lang('noparam'));
        }

        $post = array(
            'ids'=>implode(',', $id)
        );
        $result = lib_func::curl(lib_base::$grab_host.lib_base::$grab_vest_detail, $post);

        $result = json_decode($result, TRUE);

        //gbk转码
        if(CHARSET == 'gbk'){
            $result = lib_base::convert_utf8_to_gbk($result);
        }

        $vest_list = $result['list'];

        loaducenter();
        
        $html = '';
        foreach($vest_list as $vest)
        {
            $username = trim($vest['username']);
            if(uc_get_user($username)){
                $html .= '<p>'.$username.":<span style='color:#FF5722;'>".lib_base::lang('vest_is_registered').'</span><p>';
                continue;
            }
    
            $result = lib_base::table(self::$table)->user_register($username, $vest['gender'], $vest['avatar'], $vest['source']);
            if($result['state'] != 0){
                $html .= '<p>'.$username.":<span style='color:#FF5722;'>".$result['result'].'</span><p>';
                continue;
            }

            $html .= '<p>'.$username.":<span style='color:#009688;'>".$result['result'].'</span><p>';
        }
    
        lib_base::back_text($html, 0);
    }
    
    public static function share_vest_add()
    {
        $submit  = lib_base::admin_url('share_vest_added');
    
        $formhash = FORMHASH;
    
        $lang_header = lib_base::lang('share_vest_add');
        $lang_notice = lib_base::lang('share_vest_add_notice');
        $lang_keyword_placeholder = lib_base::lang('local_vest_add_placeholder');
        $lang_submit = lib_base::lang('submit');
        $lang_reset = lib_base::lang('reset');
    
        $content = <<<EOT
<div class="layui-card">
    <div class="layui-card-header">{$lang_header}</div>
    <div class="layui-card-body">
    
        <div class="layui-form-item">
        	<div class="layui-input-block1">
                {$lang_notice}
                <textarea style="height:335px;" name="vest" class="layui-textarea" lay-verify="required" placeholder="{$lang_keyword_placeholder}"></textarea>
        	</div>
        </div>
    
        <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block1">
                <div class="layui-footer" style="left:0;">
                    <button type="button" class="layui-btn" lay-submit onclick="Func.post({})">{$lang_submit}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{$lang_reset}</button>
                </div>
            </div>
        </div>
    
    </div>
</div>
<input type="hidden" name="formhash" value="{$formhash}"/>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function share_vest_added()
    {
        global $_G;
        
        $vest = $_GET['vest'];
    
        if(! $vest){
            lib_base::back_text(lib_base::lang('noparam'));
        }
    
        if(strpos($vest, ',') !== FALSE){
            $vests = explode(',', $vest);
        }else{
            $vests = explode("\n", $vest);
        }

        //禁止其它插件修改路径
        $_G['setting']['plugins']['func'][HOOKTYPE]['avatar'] = '';
        
        $host = $_G['siteurl'];
        $post_username = array();
        $post_avatar = array();
        foreach($vests as $key => $username){
            $user = C::t('common_member')->fetch_by_username($username);
            if($user){
                $avatar_path = avatar($user['uid'], 'big', TRUE, FALSE, TRUE);
                $avatar_path_a = DISCUZ_ROOT.str_replace($host, '', $avatar_path);
                if(file_exists($avatar_path_a)){
                    //gbk转码
                    if(CHARSET == 'gbk'){
                        $user['username'] = lib_base::string_gbk_to_utf8($user['username']);
                    }
                    $post_username[$key] = $user['username'];
                    $post_avatar[$key] = $avatar_path;
                }
            }
        }
        
        if(! $post_username){
            lib_base::back_text(lib_base::lang('nodata'));
        }
        
        $post = array(
            'username'=>implode(',', $post_username),
            'avatar'=>implode(',', $post_avatar),
            'source'=>$host
        );
        
        $result = lib_func::curl(lib_base::$grab_host.lib_base::$grab_vest_add, $post);

        $result = json_decode($result, TRUE);
       
        //gbk转码
        if(CHARSET == 'gbk'){
            $result = lib_base::convert_utf8_to_gbk($result);
        }
        
        lib_base::back_text($result['result'], $result['state']);
    }
    
    public static function local_vest_uid()
    {
        $list = lib_base::table(self::$table)->local_vest_all();
        if(! $list){
            lib_base::back_text(lib_base::lang('nodata'));
        }
        
        $uids = array();
        foreach($list as $value){
            $uids[] = $value['uid'];
        }
        
        lib_base::back_json(array('uids'=>implode(',', $uids)));
    }
    
    public static function share_vest_register_batch()
    {
        $submit  = lib_base::admin_url('share_vest_register_batched');
    
        $lang_header = lib_base::lang('share_vest_register_batch');
        $lang_batch_number = lib_base::lang('share_vest_register_batch_number');
        $lang_submit = lib_base::lang('submit');
        $lang_reset = lib_base::lang('reset');
    
        $content = <<<EOT
<div class="layui-card">
    <div class="layui-card-header">{$lang_header}</div>
    <div class="layui-card-body">
    
        <div class="layui-form-item">
        	<label class="layui-form-label">{$lang_batch_number}</label>
        	<div class="layui-input-block">
                <input type="text" name="number" lay-verify="required" class="layui-input" value="100">
        	</div>
        </div>
    
        <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block1">
                <div class="layui-footer" style="left:0;">
                    <button type="submit" class="layui-btn" lay-submit>{$lang_submit}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{$lang_reset}</button>
                </div>
            </div>
        </div>
    
    </div>
</div>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function share_vest_register_batched()
    {
        $number = intval($_GET['number']);
        $count = $_GET['count'] ? intval($_GET['count']) : 0;
        $page = $_GET['page'] ? intval($_GET['page']) : 1;
        
        if($count >= $number){
            lib_base::js_back_show(lib_base::lang('share_vest_register_batch_end'));
        }
        
        $limit = 10;
        $post = array(
            'search'=>'',
            'field'=>'',
            'page'=>$page,
            'limit'=>$limit
        );
        
        $result = lib_func::curl(lib_base::$grab_host.lib_base::$grab_vest_list, $post);
        
        $result = json_decode($result, TRUE);

        //gbk转码
        if(CHARSET == 'gbk'){
            $result = lib_base::convert_utf8_to_gbk($result);
        }
        
        $vest_list = $result['list'];

        loaducenter();
        
        $html = '';
        foreach($vest_list as $vest)
        {
            $username = trim($vest['username']);

            if(uc_get_user($username)){
                $html .= '<span> '.$username.":<span style='color:#FF5722;'>".lib_base::lang('vest_is_registered').'</span><span>';
                continue;
            }

            preg_match('/src="(.*?)"/', $vest['have_avatar'], $result);
            $vest['avatar'] = (isset($result[1]) && $result[1]) ? $result[1] : '';
            
            preg_match('/href="(.*?)"/', $vest['source'], $result);
            $vest['source'] = (isset($result[1]) && $result[1]) ? $result[1] : '';

            $result = lib_base::table(self::$table)->user_register($username, $vest['gender'], $vest['avatar'], $vest['source']);
            if($result['state'] != 0){
                $html .= '<span> '.$username.":<span style='color:#FF5722;'>".$result['result'].'</span><span>';
                continue;
            }
            
            $count++;
        
            $html .= '<span> '.$username.":<span style='color:#009688;'>".$result['result'].'</span><span>';
        }
        
        $html .= '<p>'.lib_base::lang('share_vest_register_batch_header').'<p>';
        
        $page++;
        $url = lib_base::admin_url('share_vest_register_batched').'&number='.$number.'&count='.$count.'&page='.$page;
        
        lib_base::back_url($html, $url);
    }
    
//     public static function grab_auth()
//     {
//         global $_G;
    
//         $post = array(
//             'host'=>$_SERVER['HTTP_HOST'],
//             'plugin'=>PLUGIN_NAME
//         );
    
//         $result = lib_func::curl(lib_base::$grab_api_host.lib_base::$grab_api_auth, $post);
    
//         $result = json_decode($result, TRUE);
    
//         //转码兼容
//         if(CHARSET == 'gbk'){
//             $result = lib_base::convert_utf8_to_gbk($result);
//         }
    
//         if(! isset($result['state']) || $result['state'] != 0){
//             lib_base::js_back_show($result['result']);
//         }

//         loadcache(PLUGIN_NAME);
//         $cache = $_G['cache'][PLUGIN_NAME];
//         $cache['auth'] = $result['result'];
//         savecache(PLUGIN_NAME, $cache);
    
//         lib_base::js_back_show(lib_base::lang('grab_auth_success'));
//     }

    public static function local_vest_weight()
    {
        $vest_id = intval($_GET['vest_id']);
        
        $submit  = lib_base::admin_url('local_vest_weighted').'&vest_id='.$vest_id;
    
        $detail = lib_base::table(self::$table)->vest_detail($vest_id);
        !$detail['weight'] && $detail['weight'] = '';
    
        $lang_header = lib_base::lang('local_vest_weight_header');
        $lang_weight_placeholder = lib_base::lang('weight_placeholder');
        $lang_submit = lib_base::lang('submit');
        $lang_reset = lib_base::lang('reset');
    
        $content = <<<EOT
<div class="layui-card">
    <div class="layui-card-header">{$lang_header}</div>
    <div class="layui-card-body">
    
        <div class="layui-form-item">
        	<input type="text" name="weight" class="layui-input" placeholder="{$lang_weight_placeholder}" value="{$detail['weight']}">
        </div>
    
        <div class="layui-form-item layui-layout-admin">
            <div class="layui-input-block1">
                <div class="layui-footer" style="left:0;">
                    <button type="button" class="layui-btn" lay-submit onclick="Func.post({})">{$lang_submit}</button>
                    <button type="reset" class="layui-btn layui-btn-primary">{$lang_reset}</button>
                </div>
            </div>
        </div>
    
    </div>
</div>
EOT;
    
        include lib_base::template('admin');
    }
    
    public static function local_vest_weighted()
    {
        $vest_id = intval($_GET['vest_id']);
        $weight = intval($_GET['weight']);

        if(! $vest_id){
            lib_base::back_text(lib_base::lang('noparam'));
        }
    
        lib_base::table(self::$table)->update($vest_id, array('weight'=>$weight));
    
        lib_base::back_json(array('callreload'=>1));
    }
    
    public static function local_vest_export()
    {
        $list = lib_base::table(self::$table)->local_vest_all();
        
        $html = '';
        foreach($list as $value){
            $value['password'] && $html .= $value['username'].' '.$value['password'].'<br/>';
        }
        
        lib_base::back_echo($html);
    }
}