<?php
/**
 * Created by PhpStorm.
 * User: roguefeathers
 * Date: 2018-10-16
 * Time: 20:10
 */
namespace app\admins\controller;
use think\Controller;
use Util\data\Sysdb;

class Test extends Controller
{
    public function index(){
        $this->db = new Sysdb;
        $res = $this->db->table('admin')->field('id,username')->lists();
        dump($res);

        echo "<hr>";
        $res2 = $this->db->table('admin')->field('id','username')->cates('id');
        dump($res2);

    }
}