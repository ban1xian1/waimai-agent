<?php

return [
    'TMPL_PARSE_STRING' => ['__UPLOAD__' => __ROOT__ . '/Upload', '__PUBLIC__' => __ROOT__ . '/Public',
	'__IMG__' => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
	'__CSS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
	'__JS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
	'__WEBTITLE__' => "管理中心 -ADMIN EX"],
	
// 	'TMPL_ACTION_ERROR' => './Public/admin_error.html', //默认错误跳转对应的模板文件
// 	'TMPL_ACTION_SUCCESS' => './Public/admin_success.html', //默认成功跳转对应的模板文件
    'TMPL_ACTION_ERROR' => THINK_PATH . 'Tpl/dispatch_jump.tpl',
    'TMPL_ACTION_SUCCESS' => THINK_PATH . 'Tpl/dispatch_jump.tpl',
    'order_state' => array('wpay'=>'等待付款', 'wtuan'=>'待成团', 'wsend'=>'等待发货',  'wget'=>'已发货', 'success'=>'交易完成', 'close'=>'交易关闭','apply_close'=>'取消待审'),
    'refund_type' =>  array(1=>'仅退款', 2=>'退货+退款'),
    'refund_state' =>array('wcheck'=>'退款待审', 'wsend'=>'待买家寄回', 'wget'=>'待卖家收货', 'success'=>'退款成功', 'refuse'=>'退款拒绝', 'close'=>'退款关闭'),
];
?>