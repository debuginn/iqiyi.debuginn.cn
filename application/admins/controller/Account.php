<?php
namespace app\admins\controller;
use think\Controller;
use think\Request;
use Util\data\Sysdb;

class Account extends Controller{
    //登陆界面调用方法
    public function login(){
        return $this->fetch();
    }

    //管理员登陆调用方法
    public function dologin(){
        //接收来自前台的信息
        $username = trim(input('post.username'));
        $password = trim(input('post.password'));
        $verifycode = trim(input('post.verifycode'));

        //判断接收值
        if($username == ''){
            exit(json_encode(array('code'=>1, 'msg'=>'用户名信息不能为空')));
        }
        if($password == ''){
            exit(json_encode(array('code'=>1, 'msg'=>'密码信息不能为空')));
        }
        if($verifycode == ''){
            exit(json_encode(array('code'=>1, 'msg'=>'请输入验证码')));
        }

        //验证验证码
        if(!captcha_check($verifycode)){
            exit(json_encode(array('code'=>1,'msg'=>'验证码错误')));
        }
        //验证用户
        $this->db =new Sysdb;
        $admin = $this->db->table('admin')->where(array('username'=>$username))->item();
        if(!$admin){
            exit(json_encode(array('code'=>1, 'msg'=>'用户名不存在')));
        }
        if(md5($password) != $admin['password']){
            exit(json_encode(array('code'=>1, 'msg'=>'密码错误')));
        }
        if($admin['status'] == 1){
            exit(json_encode(array('code'=>1, 'msg'=>'用户已经被禁用')));
        }
        //满足上述条件，登陆成功，设置用户session
        session('admin',$admin);
        exit(json_encode(array('code'=>0, 'msg'=>'登陆成功')));
    }

    //退出登录操作
    public function logout(){
        session('admin',null);
        exit(json_encode(array('code'=>0,'msg'=>'退出成功')));
    }
}