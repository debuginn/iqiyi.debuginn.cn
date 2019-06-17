<?php
/**
 * Created by PhpStorm.
 * User: roguefeathers
 * Date: 2018-10-18
 * Time: 20:23
 */
namespace app\admins\controller;
use think\Controller;
use think\Request;
use Util\data\Sysdb;

/**
 * Class BaseAdmin
 * @package app\admins\controller
 * 判断当前登陆用户，防止恶意登录
 */
class BaseAdmin extends Controller{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //判断用户是否登陆上
        $this->_admin = session('admin');
        if(!$this->_admin){
            header('Location:/public/admins.php/admins/Account/login');
            exit;
        }
        $this->assign('admin',$this->_admin);
        //根据要求查看每个人对应的权限
        $this->db = new Sysdb();
    }
}
