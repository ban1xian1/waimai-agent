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


<script type="text/javascript" src="/Public/layer/laydate/laydate.js"></script>
<div id="main-content">
	<div id="top-alert" class="fixed alert alert-error" style="display: none;">
		<button class="close fixed" style="margin-top: 4px;">&times;</button>
		<div class="alert-content">警告内容</div>
	</div>
	<div id="main" class="main">
		<div class="main-title-h">
			<span class="h1-title"><a href="<?php echo U('Index/index');?>">用户管理</a> &gt;&gt;</span>
			<span class="h1-title"><?php if(empty($data)): ?>充值<?php else: ?>充值<?php endif; ?></span>
		</div>
		<div class="tab-wrap">
			<div class="tab-content">
				<form id="form" action="<?php echo U('Index/uprecharge');?>" method="post" class="form-horizontal">
					<div id="tab" class="tab-pane in tab">
						<div class="form-item cf">
							<table>

								<tr class="controls">
									<td class="item-label">用户名 :</td>
									<td>
										<input type="text" class="form-control input-10x" name="user_name" value="<?php echo ($info["user_name"]); ?>">
									</td>
									<td class="item-note"></td>
								</tr>
								<tr class="controls">
									<td class="item-label">账户余额 :</td>
									<td>
										<input type="text" class="form-control input-10x" name="user_money" value="<?php echo ($info["user_money"]); ?>">
									</td>
									<td class="item-note"></td>
								</tr>
								<tr class="controls">
									<td class="item-label">充值金额 :</td>
									<td>
										<input type="text" class="form-control input-10x" name="money">
									</td>
									<td class="item-note"></td>
								</tr>
								<tr class="controls">
									<td class="item-label">余额选择 :</td>
									<td>
									    <select name="recharge_type" class="form-control input-10x">
                                	        <option value="2">阿三小额代收</option>
                                	        <option value="3">彩金赠送</option>
                                	        <!--<option value="11">通道代付下分提现</option>-->
                                	        <option value="12">阿三小额代付</option>
                                	        <option value="13">彩金扣除</option>
                                	        <option value="20">退款</option>
                                	        <option value="30">其它</option>
									    </select>
									</td>
									<!--<td class="item-note" style="color:red;">*会员提币的状态</td>-->
								</tr>
								<tr class="controls">
									<td class="item-label">操作说明 :</td>
									<td>
										<input type="text" class="form-control input-10x" name="text">
									</td>
									<td class="item-note"></td>
								</tr>
								<tr class="controls">
									<td class="item-label"></td>
									<td>
										<div class="form-item cf">
											<button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">提交</button>
											<a class="btn btn-return" href="<?php echo ($_SERVER['HTTP_REFERER']); ?>">返 回</a>
											<input type="hidden" name="user_id" value="<?php echo ($info["user_id"]); ?>"/>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	//提交表单
	$('#submit').click(function () {
	   // return;
		$('#form').submit();
	});
</script>