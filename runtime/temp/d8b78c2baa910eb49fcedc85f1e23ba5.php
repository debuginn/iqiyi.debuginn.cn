<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/iqiyi.debuginn.cn/public/../application/admins/view/admin/add.html";i:1558342469;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加用户</title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <style type="text/css">
        body{padding: 10px;}
    </style>
</head>
<body>
    <form class="layui-form">
        <input type="hidden" name="id" value="<?php echo $data['item']['id']; ?>">
        <div class="layui-form-item">
            <lable class="layui-form-label">用户名</lable>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="username" value="<?php echo $data['item']['username']; ?>" <?php echo $data['item']['id']>0?'readonly':''; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <lable class="layui-form-label">角&nbsp;&nbsp;&nbsp;&nbsp;色</lable>
            <div class="layui-input-inline">
                <select name="usergid" id="">
                    <option value=0></option>
                    <?php if(is_array($data['groups']) || $data['groups'] instanceof \think\Collection || $data['groups'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['groups'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['gid']; ?>" <?php echo $vo['gid']==$data['item']['gid']?'selected' : ''; ?>><?php echo $vo['title']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <lable class="layui-form-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</lable>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="password">
            </div>
        </div>
        <div class="layui-form-item">
            <lable class="layui-form-label">姓&nbsp;&nbsp;&nbsp;&nbsp;名</lable>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" name="truename" value="<?php echo $data['item']['truename']; ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <lable class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</lable>
            <div class="layui-input-inline">
                <input type="checkbox" lay-skin="primary" title="禁用" value="1" <?php echo !empty($data['item']['status'])?'checked':''; ?> name="userstatus">
            </div>
        </div>

    </form>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" onclick="save();">保存</button>
        </div>
    </div>

    <script type="text/javascript">
        var $;
        var layer;
        layui.use(['layer','form'],function () {
            $ = layui.jquery;
            form = layui.form;
            layer = layui.layer;
        });

        //保存管理员
        function save(){
            var id = parseInt($('input[name="id"]').val());
            var username = $.trim($('input[name="username"]').val());
            var password = $.trim($('input[name="password"]').val());
            var truename = $.trim($('input[name="truename"]').val());
            var usergid = $('select[name="usergid"]').val();
            if(username == ""){
                layer.alert('请输入用户名',{icon:2});
                return;
            }
            if(isNaN(id) && (password == "")){
                layer.alert('请输入密码',{icon:2});
                return;
            }
            if(usergid == 0){
                layer.alert('请选择用户角色',{icon:2});
                return;
            }
            if(truename == ""){
                layer.alert('请输入真实姓名',{icon:2});
                return;
            }
            $.post('/admins.php/admins/Admin/save',$('form').serialize(),function(res){
                if(res.code>0){
                    layer.alert(res.msg,{icon:2});
                }else{
                    layer.alert(res.msg,{icon:1});
                    setTimeout(function(){parent.window.location.reload();},1000)
                }
            },'json');
        }
    </script>
</body>
</html>