<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
	//获取第一级导航
    public function index(){
    	$User=M("info");
    	$datas=$User->field("onegrade")->group("onegrade")->select();	
    	$databack=array();
    	foreach ($datas as $data) {
 			 array_push($databack,$data["onegrade"]);
		}
   		header("Access-Control-Allow-Origin: *");
    	$this->ajaxReturn($databack,'JSON');
  	}
  	//获取第一级单个所有数据
//	public function getInfof(){
//		$User=M("info");
//		//$leavekey=$_GET['da'];
//		$leavekey["onegrade"]=$_GET['all'];
//  	$data=$User->where($leavekey)->select();	
//  	header("Access-Control-Allow-Origin: *");		
//  	$this->ajaxReturn($data,'JSON');
//	}
  	//获取第二级导航
  	public function getsecondnav(){
  		$User=M("info");
  		$leavekey["onegrade"]=$_GET['onenav'];
  		$datas=$User->where($leavekey)->field("twograde,id")->group("twograde")->select();	
//		$databack=array();
//  	foreach ($datas as $data) {
// 			 array_push($databack,$data["twograde"]);
//		}
  		header("Access-Control-Allow-Origin: *");
    	$this->ajaxReturn($datas,'JSON');
  	}
  	//点击第二级时，获取第二级导航
//	public function getsecondnavs(){
//		$User=M("info");
//		$leavekey["twograde"]=$_GET['twonav'];
//		//$datas=$User->where($leavekey)->field("twograde,id")->group("twograde")->select();	
//		$childgrade=$User->where($leavekey)->field("onegrade")->find();
//		
//		$onegradekey["onegrade"]=$childgrade["onegrade"];
//		$datas=$User->where($onegradekey)->field("twograde,id")->group("twograde")->select();
//		$databack=array();
//  	foreach ($datas as $data) {
// 			 array_push($databack,$data["twograde"]);
//		}
//		header("Access-Control-Allow-Origin: *");
//  	$this->ajaxReturn($datas,'JSON');
//	}
  	//获取列表
  	public function getInfot(){
  		$User=M("info");
		
		if($_GET['lea']==0){
			$leavekey["onegrade"]=$_GET['all'];
			$data=$User->where($leavekey)->select();	
		}
		if($_GET['lea']==1){
			$leavekey["twograde"]=$_GET['all'];
			$data=$User->where($leavekey)->select();	
		}
//		if($_GET['all']=="all"){
//			$data=$User->select();	
//		}else{
//			$data=$User->where($leavekey)->select();	
//		}
    	
    	header("Access-Control-Allow-Origin: *");		
    	$this->ajaxReturn($data,'JSON');
  	}
  	//获取实际详情内容
  	public function getdetail(){
  		$User=M("info");
  		$leavekey["id"]=$_GET['infoid'];
  		$datas=$User->where($leavekey)->field("detail,id")->find();
  		header("Access-Control-Allow-Origin: *");	
  		$this->ajaxReturn($datas,'JSON');	
  	}
	//	获取百度云盘及密码
	public function geturlpas(){
		$User=M("info");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers : Content-Type");
		$raw_post_data = file_get_contents('php://input');  
		$arr = json_decode($raw_post_data,true);  	
		$data['id'] = $arr['id'];
		
		//$data['id'] = $_POST['id'];
		$datas=$User->where($data)->field("arturl as url,artpas as pas,id as u_id")->find();

    	$this->ajaxReturn($datas,'JSON');
	}

}