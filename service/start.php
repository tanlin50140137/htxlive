<?php
function SetOpen()
{#打开服务器
	$a = exec("sh ./open.sh &>./log/error.log");
	print_r($a);
}
$act = $_REQUEST['act']==''?'':$_REQUEST['act'];
if( $act!=null && function_exists( $act ) )
{
	$act();
}
else 
{
	echo json_encode(array('error'=>$act.' - Interface does not exist'));
}