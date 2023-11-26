<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_plugin_article extends discuz_table
{
    var $moderate_status = array();
    var $article_dateline = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->_pk = 'aid';
        $this->_table = 'portal_article_title';
        
        $this->moderate_status = array(
            0=>lib_base::lang('moderate_status0'),
            1=>lib_base::lang('moderate_status1'),
        );
        $this->article_dateline = array(
            0=>lib_base::lang('article_dateline0'),
            604800=>lib_base::lang('article_dateline1'),
            2592000=>lib_base::lang('article_dateline2'),
            7776000=>lib_base::lang('article_dateline3'),
        );
    }
    
    /**
     * 主题审核统计
     *
     * @access public
     * @param string
     * @return int
     */
    public function censor(& $subject, & $message)
    {
        $censor = & discuz_censor::instance();
        $censor->highlight = '#FF0000';
        $censor->check($subject);
        $censor->check($message);
        $censor_words = $censor->words_found;
        if(count($censor_words) > 3) {
            $censor_words = array_slice($censor_words, 0, 3);
        }
        
        return $censor_words?implode(', ', $censor_words):'';
    }

    /**
     * 审核主题
     *
     * @access public
     * @param array
     * @return array
     */
    public function moderate_article($moderate)
    {
        $moderation = array('validate' => array(), 'delete' => array(), 'ignore' => array());
    	$validates = $deletes = $ignores = 0;
    	if(is_array($moderate)) {
    		foreach($moderate as $aid => $act) {
    			$moderation[$act][] = $aid;
    		}
    	}
    
    	if($moderation['validate']){
    		$validates = C::t('portal_article_title')->update($moderation['validate'], array('status' => '0'));
    		updatemoderate('aid', $moderation['validate'], 2);
    	}
    	if($moderation['delete']){
    		require_once libfile('function/delete');
    		$articles = deletearticle($moderation['delete']);
    		$deletes = count($articles);
    		updatemoderate('aid', $moderation['delete'], 2);
    	}
    	if($moderation['ignore']){
    		$ignores = C::t('portal_article_title')->update($moderation['ignore'], array('status' => '2'));
    		updatemoderate('aid', $moderation['ignore'], 1);
    	}
        
        return array('validates'=>$validates,'ignores'=>$ignores,'deletes'=>$deletes);
    }
}