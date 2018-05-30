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
		
		$_SESSION['luren_name'] = $name1.$str;
	} 
	
	$luren_name = $_SESSION['luren_name'];
	
	require_once 'template/index.html';
}