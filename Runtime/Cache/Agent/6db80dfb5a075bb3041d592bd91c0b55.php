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
<script type="text/javascript" src="/Public/Admin/js/common.js"></script>
<div id="main-content">
	<div id="top-alert" class="fixed alert alert-error" style="display: none;">
		<button class="close fixed" style="margin-top: 4px;">&times;</button>
		<div class="alert-content">警告内容</div>
	</div>
	<div id="main" class="main">
		<div class="main-title-h">
			<span class="h1-title"><a href="<?php echo U('Index/index');?>">用户管理</a> &gt;&gt;</span>
			<span class="h1-title"><?php if(empty($data)): ?>用户列表<?php else: ?>编辑用户<?php endif; ?></span>
		</div>
		<div class="tab-wrap">
			<div class="tab-content">
				<form id="form" action="<?php echo U('Index/editUserPwd');?>" method="post" class="form-horizontal">
					<div id="tab" class="tab-pane in tab">
						<div class="form-item cf">
							<table>
			    				<tr>
                					<td align="right">登录密码：</td>
                					<td><input type="text" name="user_pw" class="form-control input-10x" /><span class="c999 mal10">（不修改请留空）</span></td>
                				</tr>
			    				<tr>
                					<td align="right">支付密码：</td>
                					<td><input type="text" name="user_paypw" class="form-control input-10x" /><span class="c999 mal10">（不修改请留空）</span></td>
                				</tr>
								<tr class="controls">
									<td class="item-label"></td>
									<td>
										<div class="form-item cf">
											<button class="btn submit-btn" id="submit" type="submit" target-form="form-horizontal">提交</button>
											<a class="btn btn-return" href="<?php echo U('Index/index');?>">返 回</a>
											<?php if(!empty($data["user_id"])): ?><input type="hidden" name="id" value="<?php echo ($data["user_id"]); ?>"/><?php endif; ?>
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