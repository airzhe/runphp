<?php
class ArticleController extends Controller{
	public $db;
	public function __construct(){
		$this->db=new Model('article');
	}
	public function show(){
		$data=$this->db->select();
		$this->display('Article/show.php',$data);
	}
	public function add(){
		if(!empty($_POST)){
			if($this->db->add()){
				// p(get_class_methods('Model'));
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
		}else{
			$this->display('Article/add.php');
		}	
	}
	public function edit(){
		$id=isset($_GET['id'])?(int)$_GET['id']:null;
		if(!$id) return;
		if(!empty($_POST)){
			if($this->db->where("id=$id")->save()){
				$this->success('编辑成功');
			}else{
				$this->error('编辑失败');
			}
		}else{
			$data=$this->db->where("id=$id")->find();
			$this->display('Article/edit.php',$data);
		}

	}
	public function del(){
		$id=isset($_GET['id'])?(int)$_GET['id']:null;
		if(!$id) return;
		$this->db->where("id=$id");
		if($this->db->del()){
			$this->success('删除成功');
		}else{
			$this->error("删除失败");
		}
	}
}