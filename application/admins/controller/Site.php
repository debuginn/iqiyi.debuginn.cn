<?php
/**
 * Created by PhpStorm.
 * User: roguefeathers
 * Date: 2018-11-5
 * Time: 19:18
 */
namespace app\admins\controller;
use think\Controller;
use think\Request;
use Util\data\Sysdb;

class Site extends BaseAdmin{
    public function index(){
        $site = $this->db->table('admin_sites')->where(array('names'=>'site'))->item();
        $site && $site['values'] = json_decode($site['values']);
        $this->assign('site',$site);

        return $this->fetch();
    }

    public function save(){
        $title = trim(input('post.title'));
        $site = $this->db->table('admin_sites')->where(array('names'=>'site'))->item();
        if(!$site){
            $this->db->table('admin_sites')->insert(array('names'=>'site', 'values'=>json_encode($title)));
        }else{
            $value['values'] = json_encode($title);
            $this->db->table('admin_sites')->where(array('names'=>'site'))->update($value);
        }
        exit(json_encode(array('code'=>0, 'msg'=>'保存成功')));
    }
}
