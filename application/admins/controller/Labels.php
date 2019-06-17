<?php
namespace app\admins\controller;
use think\Controller;
use think\Request;
use Util\data\Sysdb;

/**
 * Class Labels
 * @package app\admins\controller
 * 标签管理
 */
class Labels extends BaseAdmin{

    //频道管理
    public function channel(){
        $channel = $this->db->table('video_labels')->where(array('flag'=>'channel'))->lists();
        $this->assign('data',$channel);
        return $this->fetch();
    }

    //资费
    public function charge(){
        $charge = $this->db->table('video_labels')->where(array('flag'=>'charge'))->lists();
        $this->assign('data',$charge);
        return $this->fetch();
    }

    //地区
    public function area(){
        $area = $this->db->table('video_labels')->where(array('flag'=>'area'))->lists();
        $this->assign('data',$area);
        return $this->fetch();
    }

    //类型
    public function vtype(){
        $vtype = $this->db->table('video_labels')->where(array('flag'=>'vtype'))->lists();
        $this->assign('data',$vtype);
        return $this->fetch();
    }
    //规格 norm
    public function vnorm(){
        $vnorm = $this->db->table('video_labels')->where(array('flag'=>'vnorm'))->lists();
        $this->assign('data',$vnorm);
        return $this->fetch();
    }
    //年代 decade
    public function vdecade(){
        $vdecade = $this->db->table('video_labels')->where(array('flag'=>'vdecade'))->lists();
        $this->assign('data',$vdecade);
        return $this->fetch();
    }

    //对标签的增删查改
    public function save(){

        $flag = trim(input('post.flag'));
        $ords = input('post.ords/a');
        $titles = input('post.titles/a');
        $status = input('post.status/a');

        foreach ($ords as $key => $value){
            //新增
            $data['flag'] = $flag;
            $data['ord']  = $value;
            $data['title']= $titles[$key];
            $data['status']=isset($status[$key]) ?1:0;

            if($key==0 && $data['title']){
                $this->db->table('video_labels')->insert($data);
            }
            if($key > 0){
                if($data['title']==''){
                    //删除
                    $this->db->table('video_labels')->where(array('id'=>$key))->delete();
                }else{
                    //修改
                    $this->db->table('video_labels')->where(array('id'=>$key))->update($data);
                }
            }
        }
        exit(json_encode(array('code'=>0, 'msg'=>'保存成功')));

    }

}