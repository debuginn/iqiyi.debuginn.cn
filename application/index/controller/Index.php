<?php
namespace app\index\controller;
use think\Controller;
use Util\data\Sysdb;

class Index extends Controller{
	/**
	 * 加载调用函数并引用数据库函数
	 */
	public function __construct(){
		parent::__construct();
		$this->db = new Sysdb;
	}
	/**
	 * 首页逻辑控制
	 */
	public function Index(){
		//首页首屏幻灯片加载
		$slide_list = $this->db->table('video_slide')->where(array('type'=>0))->lists();
		//首页子导航模块
		$channel_list = $this->db->table('video_labels')->where(array('flag'=>'channel'))->order('ord asc')->pages(8);
		// 今日焦点
        $today_hot_list = $this->db->table('video')->where(array('channel_id'=>7,'status'=>1))->pages(12);
		
		$this->assign('data',$slide_list);
		$this->assign('channel_list',$channel_list['lists']);
		$this->assign('today_hot_list',$today_hot_list['lists']);
		return $this->fetch();
	}

	public function cate(){
		$data['label_channel'] = (int)input('get.label_channel');
        $data['label_charge']  = (int)input('get.label_charge');
        $data['label_area']    = (int)input('get.label_area');
        $data['label_vtype']   = (int)input('get.label_vtype');
        $data['label_vnorm']   = (int)input('get.label_vnorm');
        $data['label_vdecade'] = (int)input('get.label_vdecade');

		$channel_list = $this->db->table('video_labels')->where(array('flag'=>'channel'))->cates('id');
		$charge_list  = $this->db->table('video_labels')->where(array('flag'=>'charge')) ->cates('id');
		$area_list    = $this->db->table('video_labels')->where(array('flag'=>'area'))->cates('id');
		$vtype_list   = $this->db->table('video_labels')->where(array('flag'=>'vtype'))->cates('id');
		$vnorm_list   = $this->db->table('video_labels')->where(array('flag'=>'vnorm'))->cates('id');
		$vdecade_list = $this->db->table('video_labels')->where(array('flag'=>'vdecade'))->cates('id');

		$data['pageSize'] = 12;
        $data['page'] = max(1,(int)input('get.page'));
        $where['status'] = 1;
        if($data['label_channel']){
            $where['channel_id'] = $data['label_channel'];
        }
        if($data['label_charge']){
            $where['charge_id'] = $data['label_charge'];
        }
        if($data['label_area']){
            $where['area_id'] = $data['label_area'];
        }
        if($data['label_vtype']){
        	$where['vtype_id'] = $data['label_vtype'];
        }
        if($data['label_vnorm']){
        	$where['vnorm_id'] = $data['label_vnorm'];
        }
        if($data['label_vdecade']){
        	$where['vdecade_id'] = $data['label_vdecade'];
        }

        $data['data'] = $this->db->table('video')->where($where)->pages($data['pageSize']);

        $this->assign('data',$data);
		$this->assign('channel_list',$channel_list);
		$this->assign('charge_list',$charge_list);
		$this->assign('area_list',$area_list);
		$this->assign('vtype_list',$vtype_list);
		$this->assign('vnorm_list',$vnorm_list);
		$this->assign('vdecade_list',$vdecade_list);
		return $this->fetch();
	}


	 public function video(){
        $id = (int)input('get.id');
        $video = $this->db->table('video')->where(array('id'=>$id))->item();
        $this->assign('video',$video);
        return $this->fetch();
    }
}