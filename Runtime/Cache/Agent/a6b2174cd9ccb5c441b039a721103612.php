<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo L('代理中心');?></title>
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
			
			<li class="active"> 
				<a href="<?php echo U('Agent/Index/jclist');?>">商品列表</a>
			</li>
			
			<li>
			    <a href="<?php echo U('Agent/Index/pclist');?>">订单列表</a>
			</li>
			
			<li>
			    <a href="<?php echo U('Agent/Index/recharge');?>">充值列表</a>
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
			<span class="h1-title"><?php echo L('合约建仓订单列表');?></span>
			<a class="btn btn-warning" onClick="location.href='<?php echo U('Agent/Index/jclist');?>'"><?php echo L('初始化搜索');?></a>
			<!--<span class="h1-title" style="color:red;"><?php echo L('如果用户ID被指定盈亏,不受单控影响');?></span>-->
		</div>
		<div class="cf">
			<div class="search-form fr cf" style="43px;float: none !important;">
				<div class="sleft">
					<form name="formSearch" id="formSearch" method="get" name="form1">
						<input type="text" name="product_name" class="search-input form-control" value="<?php echo ($product_name); ?>" placeholder="<?php echo L('商品名称');?>" />
						<input type="number" name="min_money" class="search-input form-control" value="<?php echo ($min_money); ?>" placeholder="<?php echo L('最小价格');?>" />
            <input type="number" name="max_money" class="search-input form-control" value="<?php echo ($max_money); ?>" placeholder="<?php echo L('最大价格');?>" />
						<a class="sch-btn" href="javascript:;" id="search"> <i class="btn-search"></i> </a>
						
						<select name="category_id" class="form-control" style="width:220px;float:left;margin-right:10px;" onchange="$('#formSearch').submit()">
    			            <option value="" href="?mod=product">全部分类</option>
							<?php if(is_array($fenlei)): $i = 0; $__LIST__ = $fenlei;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option  data="<?php echo ($category_id); ?>" <?php if($category_id == $vo[id]): ?>selected="selected"<?php endif; ?>  value="<?php echo ($vo["id"]); ?>" href="/Agent/Index/jclist?category_id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["shop_name"]); ?>-<?php echo ($vo["name"]); ?>-<?php echo ($vo["c_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
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
					<th class="">ID</th>
					<th class=""><?php echo L('商品图片');?></th>
					<th class=""><?php echo L('商品名称');?>（鼠标左键单击绿色商品名称，会自动复制商品链接）</th>
					<th class=""><?php echo L('商品单价');?></th>
					<th class=""><?php echo L('回收价格');?></th>
					<th class=""><?php echo L('库存');?></th>
					<th class=""><?php echo L('销量/评价');?></th>
					<th class=""><?php echo L('上架');?></th>
					<th class="">最后修改人</th>
					<th>操作</th>
				</tr>
				</thead>
				<tbody>
                    <?php if(!empty($list)): if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td><input class="ids" type="checkbox" name="id[]" value="<?php echo ($vo["id"]); ?>"/></td>
						<td><?php echo ($vo["product_id"]); ?></td>
						<td><img src="<?php echo ($apiurl); ?>/<?php echo ($vo["image"]); ?>" alt="" width="40" height="40"> </td>
						<td ><a  onclick="copyToClipboard('<?php echo ($htmlUrl); ?>?id=<?php echo ($vo["id"]); ?>')"><?php echo ($vo["name"]); ?></a></td>
						<td><?php echo ($vo["real_price"]); ?></td>
						<td><?php echo ($vo["recycling_price"]); ?></td>
						<td><?php echo ($vo["inventory"]); ?></td>
						<td><?php echo ($vo["sales_num"]); ?>/<?php echo ($vo["score"]); ?></td>
						<td>
						    <?php if($vo["status"] == 1): ?>是
						    <?php else: ?>
						     否<?php endif; ?>
						 </td>
						  <td><?php echo ($vo["last_chang_user"]); ?></td>
				    	<td>
					    <a class="btn btn-primary btn-xs" href="<?php echo U('Index/edit');?>?id=<?php echo ($vo["id"]); ?>">编辑</a>
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
<script type="text/javascript">
    function setwinloss(id){
        var id  = id;
        var kongyk = $("#kongyk").val();
        $.post("<?php echo U('Agent/Index/setwinloss');?>",
        {'id':id,'kongyk':kongyk},
        function(data){
            if(data.code == 1){
                alert(data.info);
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }else{
                alert(data.info);
                setTimeout(function(){
                    window.location.reload();
                },2000);
            }
        });
    }
    
function copyToClipboard(text) {
  // 创建一个临时的textarea元素
  const textarea = document.createElement('textarea');
  textarea.value = text;

  // 将textarea元素添加到文档中
  document.body.appendChild(textarea);

  // 选中文本
  textarea.select();

  // 复制文本
  document.execCommand('copy');

  // 移除临时textarea元素
  document.body.removeChild(textarea);
  layer.msg('复制成功');
}

</script>