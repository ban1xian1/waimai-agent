<?php
namespace Agent\Controller;

class IndexController extends AgentController
{
	protected function _initialize()
	{
		parent::_initialize();
	}


	//代理中心会员管理
	public function index($name=NULL){
        if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}
		$uid = session('agent_id');
		$where = "";

		if ($name != '') {

            $map_3 = "user_name like '%{$name}%' and agent_id = $uid";
 
		}else{
		    $map_3 = "agent_id = $uid";
		}
		

		$count = M('user')->where($map_3)->count();

		$Page = new \Think\Page($count, 10);
		$show = $Page->show();

		$list = M('user')->where($map_3)->order('user_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        
		$this->assign('list', $list);
		$this->assign('page', $show);
       
	    $this->display();
	}
	
	//编辑商品价格
	public function edit($id = NULL)
	{
	    $uid = session('agent_id');
		$uinfo = M('user')->where(array('user_id' => $uid))->find();

		if (empty($_POST)) {
			if (empty($id)) {
				$this->data = '';
			} else {
				$this->data = M('product')->where(array('product_id' => trim($id)))->find();
			}
			$this->display();
		}else {
		   $product_id = $_POST['id'];
		   if (empty($product_id)) {
		       $this->error("product_id为空");
		   }
		   $product_smomney = $_POST['product_smoney'];
		   $product_rmomney = $_POST['product_rmoney'];
		   $result = M('product')->where(array('product_id' => $product_id))->save(['product_money' => $product_smomney,'product_smoney' => $product_smomney,'product_rmoney' => $product_rmomney, 'edit_managet'=>$uinfo['user_name']]);
		   
		   {
		       //修改 prodata
		       $result2 = M('prodata')->where(array('product_id' => $product_id))->save(['product_money' => $product_smomney,'product_smoney' => $product_smomney,'product_rmoney' => $product_rmomney]);
		   }
		   
		   if ($result && $result2) {
		      // $this->success("操作成功");
		        $this->redirect('Index/jclist');
		   }else {
		       $this->error("操作失败:".$result);
		   }
		   
		}  
	}
	
	//编辑商品价格
	public function editUser($id = NULL)
	{
	    $uid = session('agent_id');
		if (empty($_POST)) {
			if (empty($id)) {
				$this->data = '';
			} else {
				$this->data = M('user')->where(array('user_id' => trim($id)))->find();
			}
			$this->display();
		}else {
		   $user_id = intval($_POST['id']);
		   if (empty($user_id)) {
		       $this->error("user_id为空");
		   }
		   $frozen_money = floatval($_POST['user_money_frozen']);
		   $user=M('user')->where(array('user_id' => $user_id))->find();
            
            if($frozen_money<0){
                //解冻
                $sql_frozen_money = $user['user_money_frozen'] + $frozen_money;
                if($sql_frozen_money < 0 ) $this->error("用户可冻结余额不足");
                $sql_user_money = $user['user_money'] - $frozen_money;
                if($sql_user_money < 0 ) $this->error("用户剩余余额不足");
    		
    		    $result = M('user')->where(array('user_id' => $user_id))->save(['user_money' => $sql_user_money, 'user_money_frozen' => $sql_frozen_money]);
            }else{
                $sql_frozen_money = $user['user_money_frozen'] + $frozen_money;
                if($sql_frozen_money < 0 ) $this->error("用户冻结余额不足");
                $sql_user_money = $user['user_money'] - $frozen_money;
                if($sql_user_money < 0 ) $this->error("用户剩余余额不足");
    		
    		    $result = M('user')->where(array('user_id' => $user_id))->save(['user_money' => $sql_user_money, 'user_money_frozen' => $sql_frozen_money]);
            }
		   
		   if ($result) {
		      // $this->success("操作成功");
		        $this->redirect('Index/index');
		   }else {
		       $this->error("操作失败:".$result);
		   }
		   
		} 
	}
	
    //实名认证页面
	public function authrz($id){
	    
	    $klist = M("kuangji")->where(array('rtype'=>2))->field("id,title")->select();
	    $this->assign("klist",$klist);
	    $info = M("user")->where(array('id'=>$id))->field("id,username,phone,cardzm,cardfm,rztime")->find();
	    $this->assign('info',$info);
	    $this->display();
	}
	
	//实名认证处理
	public function upanthrz(){
	    $rzstatus = $_POST['rzstatus'];
	    $uid = $_POST['uid'];
	    if($uid <= 0 || $uid == ''){
	        $this->error("参数得要参数");
	    }
	    if($rzstatus== 2){//表示认证成功
	    
	        $result = M("user")->where(array('id'=>$uid))->save(array('rzstatus'=>2,'rzuptime'=>time()));
	        if($result){
	           // $kjid = $_POST['kjid'];
	        
	           // $minfo = M("kuangji")->where(array('id'=>$kjid))->find();
	        
	           // //建仓矿机订单数据
	           // $odate['kid'] = $minfo['id'];
	           // $odate['type'] = 1;
	           // $odate['sharebl'] = '';
	           // $odate['uid'] = $uid;
	           // $odate['username'] = $_POST['username'];
	           // $odate['kjtitle'] = $minfo['title'];
	           // $odate['imgs'] = $minfo['imgs'];
	           // $odate['status'] = 1;
	           // $odate['cycle'] = $minfo['cycle'];
	           // $odate['synum'] = $minfo['cycle'];
	           // $odate['outtype'] = $minfo['outtype'];
	           // $odate['outcoin'] = $minfo['outcoin'];
	           // if($minfo['outtype'] == 1){//按产值收益
	           //    $odate['outnum'] = '';
	           //    $odate['outusdt'] = $minfo['dayoutnum'];
	           // }elseif($minfo['outtype'] == 2){//按币量收益
	           //    $odate['outnum'] = $minfo['dayoutnum']; 
	           //    $odate['outusdt'] = '';
	           // }
	           // $odate['djout'] = $minfo['djout'];
	           // if($minfo['djout'] == 2){
	           //    $odate['djnum'] = $minfo['djday']; 
	           // }else{
	           //    $odate['djnum'] = $minfo['djday']; 
	           // }
	           // $odate['addtime'] = date("Y-m-d H:i:s",time());
	           // $odate['endtime'] = date("Y-m-d H:i:s",(time() + 86400 * $minfo['cycle']));
	           // $odate['intaddtime'] = time();
	           // $odate['intendtime'] = time() + 86400 * $minfo['cycle'];
	            
            //     $adre = M("kjorder")->add($odate);
	             
	            $notice['uid'] = $uid;
		        $notice['account'] = $_POST['username'];
		        $notice['title'] = L('Certification audit successful');
		        $notice['content'] = L('Your certification application has been reviewed successfully');
		        $notice['addtime'] = date("Y-m-d H:i:s",time());
		        $notice['status'] = 1;
		        M("notice")->add($notice);
		    
	            $this->success("认证成功");
	        }else{
	            $this->error("操作失败");
	        }

	    }elseif($rzstatus == 3){//表示驳回认证
            $result = M("user")->where(array('id'=>$uid))->save(array('rzstatus'=>3,'rzuptime'=>time()));
            if($result){
                $notice['uid'] = $uid;
		        $notice['account'] = $_POST['username'];
		        $notice['title'] = L('Certification rejected');
		        $notice['content'] = L('Your certification application was rejected by the administrator, please contact the administrator');
		        $notice['addtime'] = date("Y-m-d H:i:s",time());
		        $notice['status'] = 1;
		        M("notice")->add($notice);
                $this->success("操作成功");
                
            }else{
                $this->error("操作失败");
            }
	    }

	}	
	
	//代理中心建仓订单
	public function jclist($product_name=NULL,$category_id=NULL){
        if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}

		$uid = session('agent_id');

		if ($product_name != '') {
            $map_3 = "product_name like '%{$product_name}%'";
		}else{
		    $map_3 = "";
		}
		
		if ($category_id != '') {
		    if($map_3!=""){
		        $map_3.=" and ";
		    }
            $map_3 .= "category_id = {$category_id}";
		}
		
		$count = M('product')->where($map_3)->count();
		$Page = new \Think\Page($count, 10);
		$show = $Page->show();
		
		$ulist = M('product')->where($map_3)->order('product_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

       
        $this->assign('list', $ulist);
		$this->assign('page', $show);
       
       
	    $this->display();
	}
	
	
	//单控盈亏
	public function setwinloss(){
	    if($_POST){
	        $id = trim(I('post.id'));
	        $kongyk = trim(I('post.kongyk'));
	        $info = M("hyorder")->where(array('id'=>$id))->find();
	        if(empty($info)){
	            $this->ajaxReturn(['code'=>0,'info'=>"参少重要参数"]);
	        }
	        
	        $result = M("hyorder")->where(array('id'=>$id))->save(array('kongyk'=>$kongyk));
	        if($result){
	            $this->ajaxReturn(['code'=>1,'info'=>"操作成功"]); 
	        }else{
	            $this->ajaxReturn(['code'=>0,'info'=>"操作失败"]);
	        }
	    }else{
	        $this->ajaxReturn(['code'=>0,'info'=>"网络错误"]);
	    }
	}
	
	
	//代理中心平仓订单
	public function pclist($orderid=NULL){
        if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}
		
		$uid = session('agent_id'); 
        $map_3 = '';
		if ($orderid != '') {

            $map_3 = "order_id like '%{$orderid}%' and agent_id = $uid";
 
		}else{
		    $map_3 = "agent_id = $uid";
		} 
		
		
		$count = M('order')->where($map_3)->count();
		$Page = new \Think\Page($count, 5);
		$show = $Page->show();
		
		$ulist = M('order')->where($map_3)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
     
       if (!empty($ulist)) {
           foreach ($ulist as $key => $val) {
               $ulist[$key]['product_list'] = M('orderdata')->where(['order_id' => $val['order_id']])->select();
           }
       }
        //   var_dump($ulist);die;
       
        $this->assign('list', $ulist);
		$this->assign('page', $show);
       
       
		
       
	    $this->display();
	}
	
	
	
	
	/**
	 * 代理中心充币列表
	 */ 
	 public function recharge($refundid=null){
	   if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}
		
		$uid = session('agent_id');
	     
	    if($refundid != ''){
		    $where['refund_id'] = $refundid;
		}
		
        $where['agent_id'] = $uid;
// 		$map_3 = "invit_1 = $uid or invit_2 = $uid or invit_3 = $uid";
// 		$ulist = M('User')->where($map_3)->order('id desc')->getField('id',true);
// 		$where = [];
// 		if (!empty($ulist)) {
// 		   $where['uid'] = ['in',$ulist]; 
// 		}
		

		$count = M('refund')->where($where)->count();
		$Page = new \Think\Page($count, 5);
		$show = $Page->show();
		$list = M('refund')->where($where)->order('refund_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
	     $this->display();
	 }
	 
	 
	 	/**
	 * 代理中心提币列表
	 */ 
	 public function withdraw($name=null){
	   if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}
		
		$uid = session('agent_id');
	     
	    if($name != ''){
		    $where['user_name'] = $name;
		}
		$where['agent_id'] = $uid;

// 		$map_3 = "invit_1 = $uid or invit_2 = $uid or invit_3 = $uid";
// 		$ulist = M('User')->where($map_3)->order('id desc')->getField('id',true);
		
// 	    $where = [];
// 		if (!empty($ulist)) {
// 		   $where['userid'] = ['in',$ulist]; 
// 		}

		$count = M('cashout')->where($where)->count();
		$Page = new \Think\Page($count, 5);
		$show = $Page->show();
		$list = M('cashout')->where($where)->order('cashout_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
	    $this->display();
	 }
	 
    //审核提现
    public  function shenhe_withdraw($act=null,$id=null)
    {
        if ($act && $id) {
            $url = 'http://127.0.0.1:8183/shenhe_withdraw.php?act='.$act.'&id='.$id.'&pesubmit='.'1';
            $result = file_get_contents($url);
            $res = json_decode($result,true);
            if ($res['result'] == true) {
                $this->success("操作成功");
            } else {
                $this->error("操作失败");
            }
        }
    }

	 
	 /**
	  * 用户财产
	  */
	  public function property(){
	     if (!session('agent_id')) {
			$this->redirect('Agent/Login/index');
		}
		
		$uid = session('agent_id');
	     
	    if($name != ''){
		    $where['username'] = $name;
		}
	    $where['agent_id'] = $uid;  
	    
    //   	$map_3 = "invit_1 = $uid or invit_2 = $uid or invit_3 = $uid";
    //   	$ulist = M('User')->where($map_3)->order('id desc')->getField('id',true);
    //   	$where['userid'] = ['in',$ulist];

		$count = M('UserCoin')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('UserCoin')->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();

		foreach ($list as $k => $v) {
			$list[$k]['username'] = M('User')->where(array('id' => $v['userid']))->getField('username');
		}

		$this->assign('list', $list);
		$this->assign('page', $show);
		
		$coinlist = M("coin")->where("type = 1")->order("id asc")->field("name,title")->select();
        $this->assign("coinlist",$coinlist);
	      $this->display();
	  }
	  
	  
	  public function amountlog($st=null,$coinname=null,$username=null,$type =null,$starttime=null,$export=null)
	  {
	    $uid = session('agent_id');
	    
        // if($st > 0){
        //     $where['st'] = $st;
        // }
        
        // if($coinname != ''){
        //     $where['coinname'] = $coinname;
        // }
        
        if($username != ''){
            $where['user_name'] = $username;
        }
        $where['agent_id'] = $uid;
        
    //     $map_3 = "invit_1 = $uid or invit_2 = $uid or invit_3 = $uid";
    //   	$ulist = M('User')->where($map_3)->order('id desc')->getField('id',true);
    //   	$where['uid'] = ['in',$ulist];
        
        // if($type != ''){
        //     $where['type'] = $type;
        // }
        
        // if($starttime){
        //     $arr = explode('~',urldecode($starttime));
        //     $where['addtime'] = ['between',[$arr[0],$arr[1]]];
        // }
        // if ($export > 0) {
        //     $data = M('moneylog')->where($where)->select();
        //     $this->us_exportExcel($data);
        // }
        
        
        
        $count = M('moneylog')->where($where)->count();
		$Page = new \Think\Page($count, 15);
		$show = $Page->show();
		$list = M('moneylog')->where($where)->order('moneylog_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('list', $list);
		$this->assign('page', $show);
	      
	      
	   $ini['moneylog_type'] = array('recharge'=>'Recharge', 'add'=>'System Recharge', 'back'=>'System return', 'tg'=>'Referral income', 'order_pay'=>'Order payment', 'cashout'=>'Balance withdrawal', 'del'=>'System deduction');
        $this->assign('type', $ini);   
	      
	      
	    $this->display(); 
	}
	  
    //给用户充值页面
    public  function recharge1($id)
    {
        $uid = $id;
        if($uid <= 0 || $uid == ''){
            $this->error("参数错误");
        }
        $uinfo = M("user")->where(array('user_id'=>$uid))->find();
        
        if(empty($uinfo)){
            $this->error("参数错误");
        }
        $this->assign('info',$uinfo);
        $this->display();
    }
	
	public  function uprecharge()
	{
        // $username = trim(I('post.username'));
        $recharge_type = trim(I('post.recharge_type'));
        $money = trim(I('post.money'));
        $user_id = trim(I('post.user_id'));
        $text = trim(I('post.text'));
	   
        if ($money==NULL||$money==""||$money==0) {
            $this->error("请输入正确的金额!");exit();
        }
        if ($recharge_type==NULL||$recharge_type=="") {
            $this->error("请填写充值类型!");exit();
        }
	   
	    $uinfo = M("user")->where(array('user_id'=>$user_id))->find();
	   	if(empty($uinfo)){
	        $this->error("参数错误!");
	    }
	    
	    if($recharge_type == '2' || $recharge_type == '3'){
	        //充值
    // 		$sql_user = "`user_money` = `user_money` + '{$money}'";
    		$sql_user['user_money']=$uinfo['user_money']+$money;
    		$sql_set['moneylog_in'] = $money;
    		$sql_set['moneylog_type'] = "add";
	    }elseif($recharge_type == '12' || $recharge_type == '13' || $recharge_type == '20'){
	        //扣款
	        if ($money>$uinfo['user_money']) {
                $this->error("余额不足!");exit();
            }
    // 		$sql_user = "`user_money` = `user_money` - '{$user_money}'";
    		$sql_user['user_money']=$uinfo['user_money']-$money;
    		$sql_set['moneylog_out'] = $money;
    		$sql_set['moneylog_type'] = "del";
	    }
	  
	    $result = M('user')->where(array('user_id' => $user_id))->save($sql_user);
	    if($result){
    	    $user = M("user")->where(array('user_id'=>$user_id))->find();
    		$sql_set['moneylog_text'] = $text;
    		$sql_set['moneylog_now'] = $user['user_money'];
    		$sql_set['moneylog_atime'] = time();
    		
    		$sql_set['user_id'] = $user['user_id'];
    		$sql_set['user_name'] = $user['user_name'];
    		$sql_set['recharge_type'] = $recharge_type;
    		$sql_set['agent_id'] = $user['agent_id'];
    		M('moneylog')->add($sql_set);
	    }
	    $this->redirect('Index/index');
        // $this->display();
	}
	
	//审核退款
	public  function refund($act=null,$refundid=null)
	{
	    if ($act && $refundid) {
	        $url = 'http://127.0.0.1:8183/shenhe.php?act='.$act.'&id='.$refundid.'&pesubmit='.'1';
	        $result = file_get_contents($url);
	        $res = json_decode($result,true);
	        if ($res['result'] == true) {
	           // $this->error($res['show']);
                $this->success("操作成功");
	        } else {
	            $this->error($res['show']);
	        }
	    }
	}
	
	public  function report()
	{
	    $uid = session('agent_id');
	    
	     //全网总人数
        $alluser = M("user")->where(['agent_id' => $uid])->count();
        $this->assign("alluser",$alluser);

        //总提现
        $alltx = M("cashout")->where(array('cashout_state'=>1,'agent_id' => $uid))->sum("cashout_money");
        $this->assign("alltx",sprintf("%.2f",$alltx));
       
        $s_time=strtotime(date("Y-m-d 00:00:01"));
		$o_time=strtotime(date("Y-m-d 23:59:59"));
       
       
        //今日注册
        $linewhere['user_atime'] = array('between',array($s_time,$o_time));
        $linewhere['agent_id'] = $uid;
        $allline = M("user")->where($linewhere)->count();
        $this->assign("allline",$allline);
     
        //总上分充值
        $allupcz = M("moneylog")->where(['recharge_type' => '1','agent_id' => $uid])->sum("moneylog_in");
        $this->assign("allupcz",sprintf("%.2f",$allupcz));
       
        
        //总下分扣除
        $allxfkc = M("moneylog")->where(['recharge_type' => '11','agent_id' => $uid])->sum("moneylog_out");
        $this->assign("allxfkc",sprintf("%.2f",$allxfkc));
        
        //总彩金赠送
        $allcjzs = M("moneylog")->where(['recharge_type' => '3','agent_id' => $uid])->sum("moneylog_in");
        $this->assign("allcjzs",sprintf("%.2f",$allcjzs));
        
        
        //总彩金扣除
        $allcjkc = M("moneylog")->where(['recharge_type' => '13','agent_id' => $uid])->sum("moneylog_out");
        $this->assign("allcjkc",sprintf("%.2f",$allcjkc));
        
        //总阿三小额代收
        $allxeds = M("moneylog")->where(['recharge_type' => '2','agent_id' => $uid])->sum("moneylog_in");
        $this->assign("allxeds",sprintf("%.2f",$allxeds));
        
        //总阿三小额代付
        $allxedf = M("moneylog")->where(['recharge_type' => '12','agent_id' => $uid])->sum("moneylog_out");
        $this->assign("allxedf",sprintf("%.2f",$allxedf));
        

        //今日上分充值
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 1;
        $upwhere['agent_id']  = $uid;
        $todayupcz = M("moneylog")->where($upwhere)->sum("moneylog_in");
        $this->assign("todayupcz",sprintf("%.2f",$todayupcz));
        
        //今日下分扣除
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 11;
        $upwhere['agent_id']  = $uid;
        $todayxfkc = M("moneylog")->where($upwhere)->sum("moneylog_out");
        $this->assign("todayxfkc",sprintf("%.2f",$todayxfkc));
        
        //今日三小额代收
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 2;
        $todayxeds = M("moneylog")->where($upwhere)->sum("moneylog_in");
        $this->assign("todayxeds",sprintf("%.2f",$todayxeds));
        
        //今日三小额代付
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 12;
        $todayxedf = M("moneylog")->where($upwhere)->sum("moneylog_out");
        $this->assign("todayxedf",sprintf("%.2f",$todayxedf));
        
        //今日彩金赠送
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 3;
        $upwhere['agent_id']  = $uid;
        $todaycjzc = M("moneylog")->where($upwhere)->sum("moneylog_in");
        $this->assign("todaycjzc",sprintf("%.2f",$todaycjzc));
        
        //今日彩金扣除
        $upwhere['moneylog_atime'] = array('between',array($s_time,$o_time));
        $upwhere['recharge_type']  = 13;
        $upwhere['agent_id']  = $uid;
        $todaycjkc = M("moneylog")->where($upwhere)->sum("moneylog_out");
        $this->assign("todaycjkc",sprintf("%.2f",$todaycjkc));
        
        
        //今日提现
        $txmap['cashout_ptime']  = array('between',array($s_time,$o_time));
        $txmap['cashout_state']  = 1;
        $txmap['agent_id']  = $uid;
        $todaytx = M("cashout")->where($txmap)->sum("cashout_money");
        $this->assign("todaytx",sprintf("%.2f",$todaytx));
        
//         $data = array();
// 		$time = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - (29 * 24 * 60 * 60);
// 		$i = 0;

// 		for (; $i < 30; $i++) {
// 			$a = $time;
// 			$time = $time + (60 * 60 * 24);
// 			$date = addtime($time - (60 * 60), 'Y-m-d');
// 			$mycz = M('recharge')->where(array(
// 				'status'  => array('neq', 1),
// 				'addtime' => array(
// 					array('gt', $a),
// 					array('lt', $time)
// 					)
// 				))->sum('num');
// 			$mytx = M('myzc')->where(array(
// 				'status'  => 1,
// 				'addtime' => array(
// 					array('gt', $a),
// 					array('lt', $time)
// 					)
// 				))->sum('num');

// 			if ($mycz || $mytx) {
// 				$data['cztx'][] = array('date' => $date, 'charge' => $mycz, 'withdraw' => $mytx);
// 			}
// 		}

// 		$time = time() - (30 * 24 * 60 * 60);
// 		$i = 0;

// 		for (; $i < 60; $i++) {
// 			$a = $time;
// 			$time = $time + (60 * 60 * 24);
// 			$date = addtime($time, 'Y-m-d');
// 			$user = M('User')->where(array(
// 				'addtime' => array(
// 					array('gt', $a),
// 					array('lt', $time)
// 					)
// 				))->count();

// 			if ($user) {
// 				$data['reg'][] = array('date' => $date, 'sum' => $user);
// 			}
// 		}

// 		$this->assign('cztx', json_encode($data['cztx']));
// 		$this->assign('reg', json_encode($data['reg']));
	    
	    
	    
	      $this->display();
	}
	
	
	
	// 用户明细导出处理
    public function us_exportExcel($list=null)
    {
        import('Org.Util.PHPExcel');
        import('Org.Util.PHPExcel.Writer.Excel5');
        import('Org.Util.PHPExcel.IOFactory.php');
   	    $xlsTitle = iconv('utf-8', 'gb2312', '资金明细');
        $fileName = '资金明细'. date('_YmdHis');
   
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');
		
	    // set width    
    	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);  
    	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);  
    	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);  
    	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);  
    	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);  
    	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);  	
		
		
		// 表头  
		$objPHPExcel->setActiveSheetIndex(0)  
				->setCellValue('A1', '资金明细')  
				->setCellValue('A2', '用户名')
				->setCellValue('B2', '金额')  
				->setCellValue('C2', '变动后余额')  
				->setCellValue('D2', '操作类型')  
				->setCellValue('E2', '操作说明')
				->setCellValue('F2', '时间');
        
        			// 内容  
		for ($i = 0, $len = count($list); $i < $len; $i++) {  
			$objPHPExcel->getActiveSheet(0)->setCellValue('A' . ($i + 3), $list[$i]['username']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('B' . ($i + 3), $list[$i]['num']);  
//             if($list[$i]['adds']>0){
// 				$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '+'.$list[$i]['adds']);  
// 			}else{
// 				$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), '-'.$list[$i]['reduce']);  
// 			}				
			$objPHPExcel->getActiveSheet(0)->setCellValue('C' . ($i + 3), $list[$i]['afternum']);  
			$objPHPExcel->getActiveSheet(0)->setCellValue('D' . ($i + 3), gettype_info($list[$i]['type'])); 
            $objPHPExcel->getActiveSheet(0)->setCellValue('E' . ($i + 3), $list[$i]['remark']);
            $objPHPExcel->getActiveSheet(0)->setCellValue('F' . ($i + 3), $list[$i]['addtime']);
		}  
        $objPHPExcel->getActiveSheet()->setTitle('资金明细');  
        
     
        ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header('Content-Disposition:attachment;filename=' . $fileName . '.xls');
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
}

?>
