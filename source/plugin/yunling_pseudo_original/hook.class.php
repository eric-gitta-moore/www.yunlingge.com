<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_pseudo_original
{

    public function viewthread_top_output()
    {
        global $_G,$post,$postlist;

        if (!function_exists('mb_strlen'))return;

        $config = $_G['cache']['plugin']['yunling_pseudo_original'];
        $config['random_text'] = trim($config['random_text']);

        if (empty($config['random_text']))return;
        $config['random_text'] = str_replace("\r\n",'[换行]',$config['random_text']);
        $config['random_text'] = str_replace("\r",'[换行]',$config['random_text']);
        $config['random_text'] = str_replace("\n",'[换行]',$config['random_text']);
        $config['random_text'] = explode('[换行]',$config['random_text']);

        $config['open_fids'] = unserialize($config['open_fids']);

        $loop_count = explode(',',$config['operate_count']);
        if (!is_array($loop_count))return;
        if (count($loop_count) != 2)return;
        $loop_count_min = min($loop_count);
        $loop_count_max = max($loop_count);

        require_once DISCUZ_ROOT.'./source/plugin/yunling_pseudo_original/func.php';

        $open_flag = false;
        if ($config['is_whilelist'] && in_array($_G['fid'],$config['open_fids']))
            $open_flag = true;

        elseif (!$config['is_whilelist'] && !in_array($_G['fid'],$config['open_fids']))
            $open_flag = true;

        if ($open_flag)
        {
            foreach ($postlist as $k => $value) {
                if ($value['first'] == 1)
                {
                    $msg = & $postlist[$k]['message'];
                    break;
                }
            }
            if (empty($msg))
            {
                return;
            }

            $loop_times = rand($loop_count_min,$loop_count_max);
            $rand_arr = [];
            for ($i = 1;$i < $loop_times;++$i)
            {
                $rand_arr[] = $config['random_text'][rand(0,count($config['random_text'])-1)];
//                if (!in_array($rand_text,$rand_arr))
//                {
//                    $rand_arr[] = $rand_text;
//
//                }
            }

            $msg = rand_in_str($msg,$rand_arr);

        }




    }


}

class plugin_yunling_pseudo_original_forum extends plugin_yunling_pseudo_original
{

}