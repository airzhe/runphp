<?php 
/**
 * 格式化输出数组
 */
function p($arr){
	echo '<pre>'.print_r($arr,true).'</pre>';
}
/**
 * 自动加载类函数
 */
function __autoload($class){
	$classFile=$class.'.class.php';
	//引入类文件
	require_cache(array(RUN_PATH.'Core/'.$classFile,CONTROLLER_PATH.$classFile));
}
/**
 * 在多目录查找并加载文件函数
 */
function require_cache($file){
	//这一句是为了加载单文件而写
	$file=is_array($file)?$file:array($file);
	static $_file=array();
	foreach ($file as $f) {
		$name=md5($f);
		//如果文件已经加载过就返回
		if(isset($_file[$name])) return true;
		if(is_file($f)){
			require($f);
			$_file[$name]=$f;
			//文件加载成功就返回
			return true;
		}
	}
}
/**
 * C函数，读取配置文件，参数为空时，返回所有配置项
 */
function C($name=null,$value=null){
	static $_config=array();
	if(is_null($value)){
		if(is_null($name)){
			//返回所有配置项目
			return $_config;
		}else{
			if(is_string($name)){
				//返单条配置
				return $_config[$name];
			}elseif(is_array($name)){
				//合并配置项
				$_config=array_merge($_config,$name);
			}
		}
	}else{
		//更改配置项
		$_config[$name]=$value;
	}
}