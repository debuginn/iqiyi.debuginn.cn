<?php
/**
 * Created by PhpStorm.
 * User: roguefeathers
 * Date: 2018-10-19
 * Time: 15:15
 */
namespace app\admins\controller;
use think\Controller;
use think\Request;
use Util\data\Sysdb;

/***
 * Class Admin
 * @package app\admins\controller
 * 管理员管理
 */
class Admin extends BaseAdmin{
    //管理员列表
    public function index(){
        //调用封装数据库，取出数据
        $data['lists'] = $this->db->table('admin')->lists();
        //调用封装数据库，取出角色数据
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');

        $this->assign('data',$data);

        return $this->fetch();
    }

    //添加/编辑用户操作
    public function add(){
        //接收用户id
        $id = (int)input('get.id');
        //加载管理员
        $data['item'] = $this->db->table('admin')->where(array('id'=>$id))->item();


        //调用封装数据库，取出角色数据
        $data['groups'] = $this->db->table('admin_groups')->cates('gid');
        $this->assign('data',$data);
        return $this->fetch();
    }

    //保存用户操作
    public function save(){
        //接收前台传来的数据
        $id = (int)input('post.id');
        $data['username'] = trim(input('post.username'));
        $data['gid'] = (int)(input('post.usergid'));
        $password = trim(input('post.password'));
        $data['truename'] = trim(input('post.truename'));
        $data['status'] = (int)(input('post.userstatus'));


        //对密码加密
        if($password){
            $data['password'] = md5($password);
        }

        //判断数据是否存在
        if(!$data['username']){
            exit(json_encode(array('code'=>1, 'msg'=>'用户名不能为空')));
        }
        if(!$data['gid']){
            exit(json_encode(array('code'=>1, 'msg'=>'角色不能为空')));
        }
        if(($id ==0 )&& (!$data['password'])){
            exit(json_encode(array('code'=>1, 'msg'=>'密码不能为空')));
        }
        if(!$data['truename']){
            exit(json_encode(array('code'=>1, 'msg'=>'真实姓名不能为空')));
        }

        $res = true;
        if($id==0){
            //查询用户是否被使用
            $item = $this->db->table('admin')->where(array('username'=>$data['username']))->item();
            if($item){
                exit(json_encode(array('code'=>1, 'msg'=>'此用户已经存在')));
            }
            $data['add_time'] = time();
            //将用户数据保存到数据库
            $res = $this->db->table('admin')->insert($data);
        }else{
            $this->db->table('admin')->where(array('id'=>$id))->update($data);
        }

        if(!$res){
            exit(json_encode(array('code'=>1, 'msg'=>'用户保存失败')));
        }
        exit(json_encode(array('code'=>0, 'msg'=>'用户保存成功')));
    }

    //删除管理员
    public function delete(){
        $id = (int)input('post.id');
        $res = $this->db->table('admin')->where(array('id'=>$id))->delete();
        if(!$res){
            exit(json_encode(array('code'=>1,'msg'=>'删除失败')));
        }
        exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
    }
}
