<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/iqiyi.debuginn.cn/public/../application/admins/view/home/index.html";i:1558342469;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $site['values']; ?>-后台管理</title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <style type="text/css">
        .header{width: 100%;height: 50px;line-height: 50px;background: #2e6da4;color: #ffffff;}
        .title{margin-left: 20px;font-size: 20px;}
        .userinfo{float: right;padding-right: 20px}
        .userinfo a{color: #ffffff;}
        .menus{width: 200px;background: #333744;position: absolute;}
        .main{position: absolute;left:200px;right:0px;}
        .iframeC1{width:100%;height: 100%;}

        .layui-collapse{border: none;}
        .layui-colla-item{border-top:none;}
        .layui-colla-title{background: #42485b;color: #ffffff;}
        .layui-colla-content{border-top:none;padding: 0px;}
    </style>
</head>
<body>
    <!--header-->
    <div class="header">
        <span class="title"><span style="font-size:16px;"><?php echo $site['values']; ?></span> - 后台管理系统</span>
        <span class="userinfo"><?php echo $admin['username']; ?>【<?php echo $role['title']; ?>】<a href="javascript:;" onclick="logout();">退出</a></span>
    </div>
    <!--left-menu-->
    <div class="menus" id="menus">
        <div class="layui-collapse" lay-accordion>
            <?php if(is_array($menus) || $menus instanceof \think\Collection || $menus instanceof \think\Paginator): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="layui-colla-item">
                <h2 class="layui-colla-title"><?php echo $vo['title']; ?></h2>
                <div class="layui-colla-content<?php echo $i==1?' layui-show':''; ?>">
                    <?php if(isset($vo['children']) && $vo['children']){?>
                    <ul class="layui-nav layui-nav-tree" lay-filter="test">
                        <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection || $vo['children'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['children'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?>
                        <li class="layui-nav-item"><a href="javascript:;" onclick="menuFire(this)" src="/admins.php/admins/<?php echo $cvo['controller']; ?>/<?php echo $cvo['method']; ?>"><?php echo $cvo['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                    <?php }?>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!--主操作页面-->
    <div class="main">
        <iframe src="/admins.php/admins/Home/welcome" class="iframeC1" frameborder="0" scrolling="0" onload="resetMainHeight(this)"></iframe>
    </div>

</body>
</html>
<script type="text/javascript">
    //注意：折叠面板 依赖 element 模块，否则无法进行功能性操作
    layui.use(['jquery', 'element','layer'], function(){
        $ = layui.jquery;
        var element = layui.element;
        var layer = layui.layer;
        resetMenuHeight();
    });

    //从新设置菜单高度
    function resetMenuHeight(){
        var height = document.documentElement.clientHeight -50;
        $('#menus').height(height);
    }
    //从新设置主内容高度
    function resetMainHeight(obj){
        var height = parent.document.documentElement.clientHeight -53;
        $(obj).parent('div').height(height);
    }

    //菜单点击事件
    function menuFire(obj){
        //获取url
        var src = $(obj).attr('src');
        //设置当前iframe的src
        $('iframe').attr('src',src);
    }

    //用户推出
    function logout(){
        layer.confirm('确定要退出么？', {
            btn: ['确定','取消']
        }, function(){
            $.get('/admins.php/admins/account/logout',function(res){
                if(res.code>0){
                    layer.msg(res.msg,{'icon':2});
                }else{
                    layer.msg(res.msg,{'icon':1});
                    setTimeout(function(){window.location.href="/admins.php/admins/account/login";},1000);
                }
            },'json');
        });
    }
</script>