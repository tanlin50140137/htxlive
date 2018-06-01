<?php
header('Access-Control-Allow-Origin:*');
function GetClientInfo()
{
	$redis = new Redis();
	$redis->connect('127.0.0.1', 6379);	
	$arList = $redis->lrange("message-list",0,50);	
	$redis->delete("message-list");
	$userArr = $redis->keys("*");
	$userc = array();
	foreach($userArr as $v){
		if( $v != 'message-list' )
		{
			$redis->delete($v);
		}
	}
	print_r($userArr);
	/*
	if(!empty($arList))
	{
		$arList2 = array_reverse($arList);
		echo json_encode(array('error'=>0,'txt'=>$arList2,'num'=>count($arList2)));
	}
	else
	{
		echo json_encode(array('error'=>1,'txt'=>null));
	}
	$redis->expire('message-list',300);//过期时间
	*/
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