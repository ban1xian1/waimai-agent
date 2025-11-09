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
		    <li class="active">
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
			<span class="h1-title">资金变更日志</span>
			<div class="fr">
				<button class="btn btn-warning" onClick="location.href='<?php echo U('Index/amountlog');?>'">初始化搜索</button>
			</div>
		</div>
		<div>
			<div class="cf">
			    <div class="fl">
				<!--<button class="btn ajax-post confirm btn-danger " url="<?php echo U('User/billdel',array('type'=>'1'));?>" target-form="ids">删 除</button>-->
		
			
				<!--<button class="btn ajax-post confirm btn-danger " url="<?php echo U('User/amountlog',array('export'=>'1'));?>" >导出</button>-->
		
				<div class="search-form fr cf" style="float: none !important;">
					<div class="sleft">
						<form name="formSearch" id="formSearch" method="get" name="form1">
							<!-- 类型 -->
							<!--<select style="width: 80px; float: left; margin-right: 10px;" name="st" class="form-control">-->
							<!--	<option value="all"-->
							<!--	<?php if(($_GET['st']) == ""): ?>selected<?php endif; ?>-->
							<!--	>加/减</option>-->
							<!--	<option value="1"-->
							<!--	<?php if(($_GET['st']) == "1"): ?>selected<?php endif; ?>-->
							<!--	>增加</option>-->
							<!--	<option value="2"-->
							<!--	<?php if(($_GET['st']) == "2"): ?>selected<?php endif; ?>-->
							<!--	>减少</option>-->
							<!--</select>-->
							<!-- 全部资金类型 -->
							<!--<select style="width: 120px; float: left; margin-right: 10px;" name="coinname" class="form-control">-->
							<!--	<option value=""-->
							<!--	>全部币种</option>-->
							<!--	<?php if(is_array($coinlist)): $i = 0; $__LIST__ = $coinlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>-->
							<!--		<option value="<?php echo ($vos["name"]); ?>"-->
							<!--		<?php if($_GET['cointype']==$vos['name']){ echo "selected";}?>-->
							<!--		><?php echo (strtoupper($vos["name"])); ?></option>-->
							<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
							<!--</select>-->
       <!--                     <select style="width: 220px; float: left; margin-right: 10px;" name="type" class="form-control">-->
							<!--	<option value=""-->
							<!--	>全部类型</option>-->
							<!--	<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>-->
							<!--		<option value="<?php echo ($key); ?>"-->
							<!--		<?php if($_GET['type']==$key){ echo "selected";}?>-->
							<!--		><?php echo ($vos); ?></option>-->
							<!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
							<!--</select>-->
                            
							<input type="text" name="username" class="search-input form-control  " value="<?php echo ($_GET['username']); ?>" placeholder="请输入用户名" style="">
							<!--<input type="text" name="starttime" class="search-input form-control  " value="<?php echo (urldecode($_GET['starttime'])); ?>" placeholder="开始时间" id="test1" style="width:400px;">-->
							<!--<input type="text" name="endtime" class="search-input form-control  " value="<?php echo ($_GET['starttime']); ?>" placeholder="结束时间" id="test2">-->
								<!--<button class="btn btn-warning" name="export" value="1">导出</button>-->
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
			</div>
		</div>
		<div class="data-table table-striped">
			<table class="">
				<thead>
				<tr>
				    <th class="row-selected row-selected"><input class="check-all" type="checkbox"/></th>
					<th class="">交易日期</th>
					<th class="">用户名</th>
					<th class="">交易类型</th>
					<th class="">增加(元)</th>
					<th class="">减少(元)</th>
					<th class="">变动后金额</th>
					<th class="">操作类型</th>
					<th class="">备注</th>
					
				</tr>
				</thead>
				<tbody>
				<?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						    <td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
							<td><?php echo date("Y-m-d H:i:s",$vo['moneylog_atime']);?></td>
							<td><?php echo ($vo['user_name']); ?></td>
							<td><?php echo ($type['moneylog_type'][$vo['moneylog_type']]); ?></td>
                            <td> <?php echo ($vo['moneylog_in']); ?></td>
                            <td> <?php echo ($vo['moneylog_out']); ?></td>
                            <td><?php echo ($vo["moneylog_now"]); ?></td>
                            <td>
                                <?php if($vo["recharge_type"] == 1): ?>通道卡接上分充值    
        						 <?php elseif($vo["recharge_type"] == 2): ?>
        						 阿三小额代收
        						 <?php elseif($vo["recharge_type"] == 3): ?>
        						 彩金赠送
        						 <?php elseif($vo["recharge_type"] == 11): ?>
        						 通道代付下分提现
        						 <?php elseif($vo["recharge_type"] == 12): ?>
        						 阿三小额代付
        						 <?php elseif($vo["recharge_type"] == 13): ?>
        						 彩金扣除
        						 <?php elseif($vo["recharge_type"] == 20): ?>
        						 退款
        						 <?php elseif($vo["recharge_type"] == 30): ?>
        						 其它
        						 <?php else: endif; ?>
                                
                            </td>
                            <td><?php echo ($vo["moneylog_text"]); ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php else: ?>
					<td colspan="12" class="text-center empty-info"><i class="glyphicon glyphicon-exclamation-sign"></i>暂无数据</td><?php endif; ?>
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
<script type="text/javascript" src="/Public/layui/layui.js"></script>

<script type="text/javascript" charset="utf-8">
    //执行一个laydate实例
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //执行一个laydate实例
  laydate.render({
    elem: '#test1' //指定元素
    ,type: 'datetime'
  ,range: '~'
  });
});
</script>