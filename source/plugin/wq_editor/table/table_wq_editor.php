<?php

/**
 * ά�� [ Discuz!Ӧ��ר�ң�������ά�廥���Ƽ����޹�˾����Discuz!�����Ŷ� ]
 *
 * Copyright (c) 2011-2099 http://www.wikin.cn All rights reserved.
 *
 * Author: wikin <wikin@wikin.cn>
 *
 * $Id: table_wq_editor_sample.php 2015-5-29 20:38:48Z $
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class table_wq_editor extends discuz_table {

    public function __construct() {
        $this->_table = 'wq_editor';
        $this->_pk = 'aid';
        parent::__construct();
    }

}
