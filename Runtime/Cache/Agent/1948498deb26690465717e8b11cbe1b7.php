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
			  <li>
			    <a href="<?php echo U('Agent/Index/amountlog');?>">资金流水</a>
			</li>
			<li class="active">
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
<style type="text/css" media="all">

.col-lg-3 {
    width: 33%;
}
</style>
<div id="main-content">
    <div id="top-alert" class="fixed alert alert-error" style="display: none;">
        <button class="close fixed" style="margin-top: 4px;">&times;</button>
        <div class="alert-content">警告内容</div>
    </div>
    <section class="wrapper">
        <!--state overview start-->
        <!--state overview start-->
        <div class="row state-overview">
           <style>
			   .panel-heading{text-align: center;font-size: 18px;}
			   .symbol{width:30%!important;}
			   .state-overview .value {width:70%!important;}
			</style>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-user" style="color: #4acea1;"></i>
                    </div>
                    <div class="value">
                        <h1 class="count" style="font-size: 24px;"><?php echo ($alluser); ?> </h1>

                        <p>注册总人数（人）</p>
                    </div>
                </section>
            </div>
            
            
             <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-check" style="color: #4acea1;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4" style="font-size: 24px;"><?php echo ($allline); ?></h1>

                        <p>今日注册（人）</p>
                    </div>
                </section>
            </div>
            
             <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($allxedf); ?> </h1>

                        <p>总--阿三小额代付</p>
                    </div>
                </section>
            </div>
            
            
           
        </div>
            
        <div class="row state-overview">
           <style>
			   .panel-heading{text-align: center;font-size: 18px;}
			   .symbol{width:30%!important;}
			   .state-overview .value {width:70%!important;}
			</style>
			
        
           <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todayupcz); ?> </h1>

                        <p>今日通道卡接上分充值</p>
                    </div>
                </section>
            </div>

            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todaycjzc); ?> </h1>

                        <p>今日彩金赠送</p>
                    </div>
                </section>
            </div>
            
             <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todayxeds); ?> </h1>

                        <p>今日阿三小额代收</p>
                    </div>
                </section>
            </div>
            
            
 
        </div>
        
        <div class="row state-overview">
           <style>
			   .panel-heading{text-align: center;font-size: 18px;}
			</style>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3" style="font-size: 24px;"><?php echo ($allupcz); ?></h1>

                        <p>总--通道卡接上分充值</p>
                    </div>
                </section>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4" style="font-size: 24px;"><?php echo ($allcjzs); ?> </h1>

                        <p>总--彩金赠送</p>
                    </div>
                </section>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-open" style="color: #fa4b4c;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"> <?php echo ($allxeds); ?> </h1>

                        <p>总--阿三小额代收</p>
                    </div>
                </section>
            </div>
            
            
        </div>    

        <div class="row state-overview">
            <style>
			   .panel-heading{text-align: center;font-size: 18px;}
			   .symbol{width:30%!important;}
			   .state-overview .value {width:70%!important;}
			</style>
			

            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todayxedf); ?> </h1>
                        <p>今日阿三小额代付</p>
                    </div>
                </section>
            </div>

            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todaytx); ?> </h1>

                        <p>今日订单提现</p>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todayxfkc); ?> </h1>

                        <p>今日通道代付下分提现</p>
                    </div>
                </section>
            </div>

            
        </div>
        
            
        <div class="row state-overview">
        <style>
			   .panel-heading{text-align: center;font-size: 18px;}
			   .symbol{width:30%!important;}
			   .state-overview .value {width:70%!important;}
			</style>

            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count2" style="font-size: 24px;"><?php echo ($todaycjkc); ?> </h1>

                        <p>今日彩金扣除</p>
                    </div>
                </section>
            </div>
       
            
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3" style="font-size: 24px;"><?php echo ($alltx); ?></h1>

                        <p>总--订单提现</p>
                    </div>
                </section>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count3" style="font-size: 24px;"><?php echo ($allxfkc); ?></h1>

                        <p>总--通道代付下分提现</p>
                    </div>
                </section>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <section class="panel">
                    <div class="symbol">
                        <i class="glyphicon glyphicon-save" style="color: #4b9afa;"></i>
                    </div>
                    <div class="value">
                        <h1 class=" count4" style="font-size: 24px;"><?php echo ($allcjkc); ?> </h1>

                        <p>总--彩金扣除</p>
                    </div>
                </section>
            </div>
            
        </div>
    </section>
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