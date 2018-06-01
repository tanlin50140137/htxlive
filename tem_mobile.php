<?php
header("conent-type:text/html;charset=utf-8");
/*
 * 模板和序
 * */
function index()
{
	session_start();
	if(!isset($_SESSION['luren_name']))
	{		
		$a = array("甲","乙","丙","丁","戊","己","庚","辛","壬","癸");
		$name1 = $a[mt_rand(0,count($a)-1)];		
		$str1 = str_shuffle('abcdefghijklmnopqrstuvwsyz123456789ABCDEFGHIJKLMNOPQRSTUVWSYZ');
		$str = mb_substr($str1, 0,2,'utf-8');
		if(getIP()=='127.0.0.1' || getIP()=='113.17.35.211')
		{
			$_SESSION['luren_name'] = '房主';
		}
		else
		{
			$_SESSION['luren_name'] = '路人'.$name1.$str;
		}
	} 
	
	$luren_name = $_SESSION['luren_name'];
	
	require_once 'template/index.html';
}
#获取IP
function getIP()
{
	static $realip;
	if (isset($_SERVER)){
	      if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	          $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	 	  } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
	         $realip = $_SERVER["HTTP_CLIENT_IP"];
	 	  } else {
	         $realip = $_SERVER["REMOTE_ADDR"];
	 	  }
	 } else {
	        if (getenv("HTTP_X_FORWARDED_FOR")){
	            $realip = getenv("HTTP_X_FORWARDED_FOR");
	        } else if (getenv("HTTP_CLIENT_IP")) {
	            $realip = getenv("HTTP_CLIENT_IP");
	        } else {
	            $realip = getenv("REMOTE_ADDR");
	        }
	 }
	 return $realip;
}