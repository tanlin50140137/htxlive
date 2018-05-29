/**
 * js
 */
$(function(){
	var h = $(window).height();
	$(".live_box,.mote_box").css({"height":h+"px"});
});
var videoObject = {
		container: '#video_main_url',//“#”代表容器的ID，“.”或“”代表容器的class
		variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
		loaded: 'loadedHandler', //当播放器加载后执行的函数
		//poster: 'http://127.0.0.1/thiscmssystem/subject/htx/images/help_banner.png', //封面图片
		drag: 'start', //拖动的属性
		seek: 0, //默认跳转的时间
		//广告部分开始
		//adpause: '/ueditor/php/upload/image/20171107/htx_5a014ef8ae2199.79253397.jpg',
		//adpausetime: '5,5',
		//adpauselink: '<?php echo apth_url();?>',
		//广告部分结束
		flashplayer:false,//如果强制使用flashplayer则设置成true
		mobileCkControls:true,//是否在移动端（包括ios）环境中显示控制栏
		video:{
			file:'http://120.76.72.28:81/hls/test.m3u8',//视频地址
			type:'video/m3u8'
		}
	};
var player = new ckplayer(videoObject);