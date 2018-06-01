<?php
$server = new swoole_websocket_server("0.0.0.0", 9502);//必须是四个0

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) {

    echo "received message: {$frame->data}\n";
    $as = explode('&',$frame->data);
    
    //用户名&时间&内容 
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);  
    $redis->expire('message-list',300);//过期时间  
    
    $redis->set($frame->fd,$as[1]);//链接人数
    
	if($as[0]=='send')
    {#发
    	$redis->lpush("message-list", $frame->data.'&'.$frame->fd);
    	$arList = $redis->lrange("message-list",0,500);
    }
    else 
    {#查  
    	$arList = $redis->lrange("message-list",0,500);
    }
    
	//用户链接数
	$userArr = $redis->keys("*");
	$userc = array();
	foreach($userArr as $v){
		if( $v != 'message-list' )
		{
			$userc[]=$redis->get($v);
		}
	}
    
	if(!empty($arList))
	{			
		$arList2 = array_reverse($arList);
		$data_frame = json_encode(array('error'=>0,'txt'=>$arList2,'num'=>count($arList2),'connections'=>$userc));
	}
	else
	{
		$data_frame = json_encode(array('error'=>1,'txt'=>null,'connections'=>$userc));
	}
	
	$server->push($frame->fd, $data_frame);
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->delete($fd);
});

$server->start();