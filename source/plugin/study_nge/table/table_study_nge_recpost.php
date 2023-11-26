<?php

/*
 *Դ��磺www.ymg6.com
 *������ҵ���/ģ��������� ����Դ���
 *����Դ��Դ�������ռ�,��������ѧϰ����������������ҵ��;����������24Сʱ��ɾ��!
 *����ַ�������Ȩ��,�뼰ʱ��֪����,���Ǽ���ɾ��!
 */

if(defined('IN_DISCUZ')) {
exit('Access Denied');
}
class table_study_nge_recpost {

	public function __construct() {
		$this->_table = 'study_nge_recpost';
		$this->_pk = 'id';

		parent::__construct();
	}
	
	public function count_by_where($param = array()) {
		$count = (int) DB::result_first('SELECT count(*) FROM  %t %i', array($this->_table, $this->wheresql($param)));
		return $count;
	}
	
	public function delete_by_where($param, $unbuffered = false) {
		$ret = false;
		if(isset($param)) {
			$this->checkpk();
			$ret = DB::delete($this->_table, $this->wheresql($param, false), null, $unbuffered);
			if($param[$this->_pk]){
				$this->clear_cache($param[$this->_pk]);
			}
		}
		return $ret;
	}

	public function update_by_where($param, $data, $unbuffered = false, $low_priority = false) {
		if(isset($param) && !empty($data) && is_array($data)) {
			$this->checkpk();
			$ret = DB::update($this->_table, $data, $this->wheresql($param, false), $unbuffered, $low_priority);
			if($param[$this->_pk]){
				$this->update_cache($param[$this->_pk], $data);
			}
			return $ret;
		}
		return !$unbuffered ? 0 : false;
	}
	
	public function fetch_by_search($param, $order = array()) {
	  return DB::fetch_first('SELECT * FROM %t %i %i limit 1', array($this->_table, $this->wheresql($param), $this->ordersql($order)));
	}
	
	public function fetch_all_by_search($param = array(), $order = array(), $start = 0, $limit = 0) {
	  return DB::fetch_all('SELECT * FROM %t %i %i ' . DB::limit($start, $limit), array($this->_table, $this->wheresql($param), $this->ordersql($order)), $this->_pk);
	}
	
	public function wheresql($param, $havewhere = true) {
	  $return = '';
	  $wherearr = array();
	  if (is_array($param)) {
	      foreach ($param as $key => $value) {
	      		if(is_array($value)){
	      			/*
	      			array(
	      			'uid' => $uid, 
	      			'complete_percent' => array('60', '>='),
	      			'complete_percent' => array('complete_percent', '100', '<='),
	      			'keyword' => array('%'.addcslashes($keyword, '%_').'%', 'like'),
	      			)
	      			*/
	      			if(count($value) > 2){
	      				$wherearr[] = DB::field($value[0], $value[1], $value[2]);
	      			}else{
		      			$wherearr[] = DB::field($key, $value[0], $value[1]);
		      		}
	      		}else{
	              	$wherearr[] = DB::field($key, $value);
	            }
	      }
	      $return = $wherearr ? ($havewhere ? 'WHERE ' : '') . implode(' AND ', $wherearr) : '';
	  }
	  return $return;
	}
	
	public function ordersql($param, $haveorderby = true) {
	  $return = '';
	  $orderbyarr = array();
	  if (is_array($param)) {
	      foreach ($param as $key => $value) {
	      		$orderbyarr[] = DB::order($key, $value);
	      }
	      $return = $orderbyarr ? ($haveorderby ? ' ORDER BY ' : '') . implode(',', $orderbyarr) : '';
	  }else{
	  	  $return = ($haveorderby ? ' ORDER BY ' : '') . $this->_pk.' DESC';	
	  }
	  return $return;
	}
}                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               

//Copyright 2001-2099 1314ѧϰ��.
//This is NOT a freeware, use is subject to license terms
//$Id: table_study_nge_recpost.php 4809 2017-08-20 18:43:24Z zhuge $
//Ӧ���ۺ����⣺http://www.1314study.com/services.php?mod=issue
//Ӧ����ǰ��ѯ��QQ 15326940
//Ӧ�ö��ƿ�����QQ 643306797
//�����Ϊ 1314ѧϰ����www.1314study.com�� ����������ԭ�����, ����ӵ�а�Ȩ��
//δ�������ù������ۡ�������ʹ�á��޸ģ����蹺������ϵ���ǻ����Ȩ��