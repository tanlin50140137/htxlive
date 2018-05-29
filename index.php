<?php
/*
 * 入口文件
 * */
require 'tem_mobile.php';

$act = $_REQUEST['act']==''?'index':$_REQUEST['act'];
if( $act!=null && function_exists( $act ) )
{
	$act();
}
else 
{
	echo json_encode(array('error'=>$act.' - Interface does not exist'));
}