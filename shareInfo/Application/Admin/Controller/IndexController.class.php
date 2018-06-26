<?php
namespace Admin\Controller;
use Think\Controller;

class IndexController extends Controller {
	//插入数据
    public function inserart(){
    	$User=M("info");
    	header("Access-Control-Allow-Origin: *");
   		//header("Access-Control-Allow-Headers : Content-Type");
    	$raw_post_data = file_get_contents('php://input');  
		$arr = json_decode($raw_post_data,true);  	
  		$data['title'] = $arr['title'];
		$data['detail'] = $arr['content'];
		$data['createtime']=date("Y-m-d H:i:s");
		$data['autor']="Admin";
		$data['onegrade'] = $arr['oneleave'];
		$data['twograde'] = $arr['twoleave'];
		$data['arturl'] = $arr['urlpan'];
		$data['artpas'] = $arr['paspan'];
		$User->add($data);

    	$this->ajaxReturn($data,'JSON');
  	}
  	//查询数据
  	public function seachinfo(){
  		$User=M("info");
  		header("Access-Control-Allow-Origin: *");
//
		$title=$_GET['title'];
		$page=$_GET['page'];
		$limit=$_GET['limit'];
	
		$data['title']=array('like','%'.$title.'%');

//		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$list = $User->where($data)->order('createtime')->page($page,$limit)->select();

		$count= $User->where($data)->count();// 查询满足要求的总记录数
//		$Page= new \Think\Page($count,$limit);// 实例化分页类 传入总记录数和每页显示的记录数
//		$show = $Page->show();// 分页显示输出

		$pagedata['list']=$list;
		$pagedata['page']=$count;

    	$this->ajaxReturn($pagedata,'JSON');
  	}
  
}
// page: 1,
//      limit: 20,
////      importance: undefined,
//      title: undefined,