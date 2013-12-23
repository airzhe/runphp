<?php
/**
 * 公共类
 */
class Controller{
	//模板调用函数
	public function display($tpl,$data=null){
		if(is_array($data))
			extract($data);
		if(is_file(TEMPLATE_PATH.$tpl)){
			include(TEMPLATE_PATH.$tpl);
		}else{
			$this->error('模板文件不存在');
		}
	}
	//success
	public function success($msg){
		echo ':) '.$msg;
	}
	//error
	public function error($msg){
		die(':( '.$msg);
	}
}