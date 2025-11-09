<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>代理中心</title>
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/default_color.css" media="all">
	<script type="text/javascript" src="/Public/Admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/Public/layer/layer.js"></script>
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/flat-ui.css">
	<script src="/Public/Admin/js/flat-ui.min.js"></script>
	<script src="/Public/Admin/js/application.js"></script>
</head>
<body style="margin:0px;padding:0px; margin-top:100px;">
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header" style="background-color:#3c434d;">
		<a class="navbar-brand" style="width:200px;text-align:center;background-color:#3c434d;" href="<?php echo U('Agent/Index/index');?>">
		    <span>代理系统</span>	
		</a>
	</div>
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li> 
			    <a href="<?php echo U('Agent/Index/index');?>">会员列表</a>
			</li>
			
			<li> 
				<a href="<?php echo U('Agent/Index/jclist');?>">商品列表</a>
			</li>
			
			<li class="active">
			    <a href="<?php echo U('Agent/Index/pclist');?>">订单列表</a>
			</li>
			
			<li>
			    <a href="<?php echo U('Agent/Index/recharge');?>">退款列表</a>
			</li>
			
			<li>
			    <a href="<?php echo U('Agent/Index/withdraw');?>">提现列表</a>
			</li>
			
			<!--<li>-->
			<!--    <a href="<?php echo U('Agent/Index/property');?>">用户财产</a>-->
			<!--</li>-->
			  <li>
			    <a href="<?php echo U('Agent/Index/amountlog');?>">资金流水</a>
			</li>
			<li>
			    <a href="<?php echo U('Agent/Index/report');?>">平台报表</a>
			</li>
		</ul>
		
		
		<ul class="nav navbar-nav navbar-rights" style="margin-right:10px;">
			<li>
				<a class="dropdown-toggle" title="<?php echo L('退出');?>" href="<?php echo U('Agent/Login/loginout');?>" target="_blank">
					<span class="glyphicon glyphicon-share" aria-hidden="true"></span>
				</a>
			</li>
		</ul>
	</div>

</div>
<div id="main-content">
	<div id="top-alert" class="fixed alert alert-error" style="display: none;">
		<button class="close fixed" style="margin-top: 4px;">&times;</button>
		<div class="alert-content"><?php echo L('警告内容');?></div>
	</div>
	<div id="main" class="main">
		<div class="main-title-h">
			<span class="h1-title"><?php echo L('合约平仓订单列表');?></span>
			<a class="btn btn-warning" onClick="location.href='<?php echo U('Agent/Index/pclist');?>'"><?php echo L('初始化搜索');?></a>
		</div>
		<div class="cf">
			<div class="search-form fr cf" style="43px;float: none !important;">
				<div class="sleft">
					<form name="formSearch" id="formSearch" method="get" name="form1">
					    	<input type="text" name="search_name" class="search-input form-control  " value="<?php echo ($_GET['search_name']); ?>" placeholder="请输入会员账号" style="">
						<input type="text" name="orderid" class="search-input form-control" value="<?php echo ($_GET['orderid']); ?>" placeholder="<?php echo L('请输入订单号');?>" />
						<a class="sch-btn" href="javascript:;" id="search"> <i class="btn-search"></i> </a>
					</form>
					<script>
						//搜索功能
						$(function () {
							$('#search').click(function () {
								$('#formSearch').submit();
							});
						});
						//回车搜索
						$(".search-input").keyup(function (e) {
							if (e.keyCode === 13) {
								$("#search").click();
								return false;
							}
						});
					</script>
				</div>
			</div>
		</div>
		<div class="data-table table-striped">
			<table class="">
				<thead>
				<tr>
					<th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
					<th class="">用户名</th>
					<th class="">订单编号</th>
					<th class=""><?php echo L('下单时间');?></th>
					<th class=""><?php echo L('订单信息');?></th>
					<th class=""><?php echo L('实付款');?></th>
					<th class=""><?php echo L('收货信息');?></th>
					<th class=""><?php echo L('订单状态');?></th>
				</tr>
				</thead>
				<tbody>
                    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
							<td><?php echo ($vo["user_name"]); ?> </td>
						<td><?php echo ($vo["order_no"]); ?></td>
						<td><?php echo date("Y-m-d H:i:s",$vo['create_time']);?></td>
						<td>
						     <?php if(is_array($vo["product_list"])): $i = 0; $__LIST__ = $vo["product_list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pp): $mod = ($i % 2 );++$i;?><table class="">
						        <tr>
						            <td><img src="<?php echo ($apiurl); ?>/<?php echo ($pp["product_image"]); ?>" alt="" style="width:80px;"/></td>
						            <td><?php echo ($pp["product_name"]); ?></td>
						            <td>(<?php echo ($pp["price"]); ?>+ <?php echo ($pp["packing_fee"]); ?> )x <?php echo ($pp["num"]); ?></td>

						        </tr>
						        <?php echo refund_stateshow($vo['refund_status']);?>
						        <!--<?php echo ($pp["refund_state"]); ?>-->
						    </table><?php endforeach; endif; else: echo "" ;endif; ?>
						 </td>
					    
						<td>
						    <p><?php echo ($vo["pay_amount"]); ?></p>
						    <p>Balance</p>
						 </td>
						<td>
						    <p>用户名:<?php echo ($vo["user_name"]); ?></p>
						    <p>姓名:<?php echo ($vo["receiver_name"]); ?> (<?php echo ($vo["receiver_phone"]); ?>)</p>
						    <p>地址:<?php echo ($vo["receiver_address"]); ?></p>
						 </td>
						 
						<td>
						     <?php echo order_stateshow($vo['order_status']);?>
						    <!--<?php echo ($vo["order_state"]); ?>-->
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
					<td colspan="12" class="text-center empty-info">
					    <i class="glyphicon glyphicon-exclamation-sign"></i>暂无数据
					</td><?php endif; ?>
				</tbody>
			</table>
			<div class="page">
				<div><?php echo ($page); ?></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    // $(function(){
    //     setInterval("tzfc()",2000);
    // });
    
    function tzfc(){
        var st = 1;
        $.post("<?php echo U('Admin/Trade/gethyorder');?>",
        {'st':st},
        function(data){
            if(data.code == 1){
                layer.confirm('有新的合约订单', {
                  btn: ['知道了'] //按钮
                }, function(){
                    
                    $.post("<?php echo U('Admin/Trade/settzstatus');?>",
                    function(data){
                        if(data.code == 1){
                            window.location.reload();  
                        } 
                    });
                });
            }   
        });
    }
</script>