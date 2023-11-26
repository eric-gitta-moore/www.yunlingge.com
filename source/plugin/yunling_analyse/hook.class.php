<?php

if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_yunling_analyse
{
    public function global_header()
    {

        global $_G;
        $config = $_G['cache']['plugin']['yunling_analyse'];
        $arr = [];

        if (!empty($config['head1']))
            $arr[] = '<script>'.$config['head1'].'</script>';
        if (!empty($config['head2']))
            $arr[] = '<script>'.$config['head2'].'</script>';
        if (!empty($config['head3']))
            $arr[] = '<script>'.$config['head3'].'</script>';


        $return = implode('',$arr);
        if ($config['jquery'])
        {
            $return = '<script src="https://cdn.bootcss.com/jquery/1.7.2/jquery.min.js"></script><script>jQuery.noConflict();</script>' . $return;
        }
        return $return;
    }


    public function global_footer()
    {
        global $_G;
        $config = $_G['cache']['plugin']['yunling_analyse'];

        //        $return = 'setTimeout(function () {' . $foot . '}, '. intval($config['timeout']) . ');';

        $arr = [];
        if (intval(intval($config['timeout'])) > 0)
        {
            //延迟方式
            if (!empty($config['foot1']))
                $arr[] = '<script>setTimeout(function(){'. $config['foot1']. '},'. intval($config['timeout']) . ');' . '</script>';
            if (!empty($config['foot2']))
                $arr[] = '<script>setTimeout(function(){'. $config['foot2']. '},'. intval($config['timeout']) . ');' . '</script>';
            if (!empty($config['foot3']))
                $arr[] = '<script>setTimeout(function(){'. $config['foot3']. '},'. intval($config['timeout']) . ');' . '</script>';


            return implode('',$arr);
        }
        else
        {
            //自动方式
            if (!empty($config['foot1']))
                $arr[] = $this->_getScript($config['foot1']);
            if (!empty($config['foot2']))
                $arr[] = $this->_getScript($config['foot2']);
            if (!empty($config['foot3']))
                $arr[] = $this->_getScript($config['foot3']);

            return implode('',$arr);
        }


    }

    protected function _getScript($script)
    {
        return '<script>(function(){
    let interval = setInterval(function(){
            if(document.readyState=="complete"){
                ' . $script . '
                clearInterval(interval);
            }
    },100);
})();</script>';
    }
}