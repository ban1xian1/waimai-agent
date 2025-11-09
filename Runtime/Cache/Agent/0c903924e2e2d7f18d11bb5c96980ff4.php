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
			<li class="active"> 
			    <a href="<?php echo U('Agent/Index/index');?>">会员列表</a>
			</li>
			
			<li> 
				<a href="<?php echo U('Agent/Index/jclist');?>">商品列表</a>
			</li>
			
			<li>
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
			<span class="h1-title"><?php echo L('会员管理');?></span>
			<a class="btn btn-warning" onClick="location.href='<?php echo U('Agent/Index/index');?>'"><?php echo L('初始化搜索');?></a>
		</div>
		
		<div class="cf">
		 <!--   <div class="fl">-->
			<!--	<a class="btn btn-success  " href="<?php echo U('Index/edit');?>">新 增</a>-->
			<!--</div>-->
		    
			<div class="search-form cf">
				<div class="sleft">
					<form name="formSearch" id="formSearch" method="get" name="form1">
						<select style="width:120px;float:left;margin-right:10px;" name="field" class="form-control">
							<option value="username"
							<?php if(empty($_GET['field'])): ?>selected<?php endif; ?>
							><?php echo L('用户名');?></option>
						</select>

						<script type="text/javascript" src="/Public/layer/laydate/laydate.js"></script>

						<input type="text" name="name" class="search-input form-control" value="<?php echo ($_GET['name']); ?>" placeholder="<?php echo L('请输入会员账号');?>" style="width: 380px;">
						
						<input type="text" name="user_ip" class="search-input form-control" value="<?php echo ($_GET['user_ip']); ?>" placeholder="<?php echo L('请输入ip');?>" style="width: 380px;">
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
					<th>ID</th>
					<th><?php echo L('会员账号');?></th>
					<th><?php echo L('用户姓名');?></th>
					<th><?php echo L('余额');?></th>
					<th><?php echo L('冻结金额');?></th>
					<th><?php echo L('总消费额');?></th>
					<th><?php echo L('用户上次登陆');?></th>
					<th><?php echo L('注册时间');?></th>
					<th><?php echo L('用户注册IP');?></th>
					<th><?php echo L('访问域名');?></th>
					<!--<th><?php echo L('地址');?></th>-->
					<!--<th><?php echo L('推荐人');?></th>-->
				<!--	<th><?php echo L('认证状态');?></th>-->
					<th><?php echo L('邀请码');?></th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
                    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td>
									<input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/>
								</td>
								<td><?php echo ($vo["user_id"]); ?></td>
								<td title="登录该用户"><?php echo ($vo["user_name"]); ?></td>
								<td title="登录该用户"><?php echo ($vo["user_tname"]); ?></td>
								<td><?php echo ($vo["user_money"]); ?></td>
								<td><?php echo ($vo["user_money_frozen"]); ?></td>
								<td><?php echo ($vo["user_money_cost"]); ?></td>
								<td><?php echo date("Y-m-d H:i:s",$vo['user_ltime']);?></td>
								<td>
								    <!--<span>IP：<?php echo ($vo["addip"]); ?></span><br />-->
								    <span><?php echo date("Y-m-d H:i:s",$vo['user_atime']);?></span>
								</td>
							<!--	<td><span><?php echo ($vo["addr"]); ?></span></td>-->
        <!--                        <td>-->
								<!--	<?php if(($vo["invit_1"]) != ""): ?>上级：<?php echo ($vo['invit_1']); ?><br/><?php endif; ?>-->
								<!--	<?php if(($vo["invit_2"]) != ""): ?>上上级：<?php echo ($vo['invit_2']); ?><br/><?php endif; ?>-->
								<!--	<?php if(($vo["invit_3"]) != ""): ?>上上上级：<?php echo ($vo['invit_3']); ?><br/><?php endif; ?>-->
								<!--</td>-->
								
								<!--<td>
								    <?php if(($vo["rzstatus"]) == "0"): ?>未提交<?php endif; ?>
								    <?php if(($vo["rzstatus"]) == "1"): ?><span style="color:blue;">待审核</span><?php endif; ?>
								    <?php if(($vo["rzstatus"]) == "2"): ?><span style="color:green;">认证成功</span><?php endif; ?>
								    <?php if(($vo["rzstatus"]) == "3"): ?><span style="color:red;">认证驳回</span><?php endif; ?>
								    
								    
								</td>-->
                                <td><?php echo ($vo["user_ip"]); ?></td>
                                <td><?php echo ($vo["user_from"]); ?></td>
                                <td><span><?php echo ($vo["invite_code"]); ?></span></td>
                                
                                <td>
						            <a class="btn btn-primary btn-xs" href="<?php echo U('Index/editUser');?>?id=<?php echo ($vo["user_id"]); ?>">冻结资金</a>
						            <!-- <?php if(($vo["rzstatus"]) == "1"): ?>-->
						            <!--<a class="btn btn-primary btn-xs" href="<?php echo U('Index/authrz');?>?id=<?php echo ($vo["user_id"]); ?>">审核认证</a>-->
						            <!--<?php endif; ?>-->
						            <a class="btn btn-primary btn-xs" href="<?php echo U('Index/recharge1');?>?id=<?php echo ($vo["user_id"]); ?>">上下分</a>
						            
    					            <a class="btn btn-primary btn-xs" href="<?php echo U('Index/editUserPwd');?>?id=<?php echo ($vo["user_id"]); ?>">修改密码</a>
						            
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
// <script type="text/javascript">
//     $(function(){
//         setInterval("tzfc()",2000);
//     });
    
//     function tzfc(){
//         var st = 1;
//         $.post("<?php echo U('Admin/Trade/gethyorder');?>",
//         {'st':st},
//         function(data){
//             if(data.code == 1){
//                 layer.confirm('有新的合约订单', {
//                   btn: ['知道了'] //按钮
//                 }, function(){
                    
//                     $.post("<?php echo U('Admin/Trade/settzstatus');?>",
//                     function(data){
//                         if(data.code == 1){
//                             window.location.reload();  
//                         } 
//                     });
//                 });
//             }   
//         });
//     }
// </script>