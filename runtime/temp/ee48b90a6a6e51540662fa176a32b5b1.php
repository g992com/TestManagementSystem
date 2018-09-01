<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW/application/listtestcase\view\test_plan_management\create_page.html";i:1532313330;}*/ ?>
﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="/favicon.ico">
    <link rel="Shortcut Icon" href="/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/default/skin.css"
          id="skin"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--/meta 作为公共模版分离出去-->
    <title>添加计划</title>
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-plan-add">
        <input type="text" id="realName" name="realName" value="<?php echo $realName; ?>" style="display: none;"/>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>测试计划名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="测试计划名称" id="testPlanName"
                       name="testPlanName">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>预计开始日期：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="预计开始日期" id="startDate"
                       name="startDate">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>预计开始日期：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="预计结束日期" id="endDate"
                       name="endDate">
            </div>
        </div>
        <div class="row cl" align="right">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-success radius"><i class="Hui-iconfont">&#xe632;</i> 确 定</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">
                    &nbsp;&nbsp;取消&nbsp;&nbsp;
                </button>
            </div>
        </div>
    </form>
</article>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript"
        src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript"
        src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src='__PUBLIC__/static/plugins/layDate-v5.0.9/laydate/laydate.js'></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery-form.js"></script>
<script type="text/javascript">
    $(function () {
        $("#testPlanName").focus();
        laydate.render({
            elem: '#startDate'
        });
        laydate.render({
            elem: '#endDate'
        });

        $("#form-plan-add").validate({
            rules: {
                testPlanName: {
                    required: true,
                },
                startDate: {
                    required: true,
                },
                endDate: {
                    required: true,
                }
            },
            submitHandler: function (form) {
                var startDate = new Date($('#startDate').val());
                var endDate = new Date($('#endDate').val());
                if (startDate > endDate) {
                    layer.msg("结束日期必须小于或等于开始日期!");
                } else {
                    submitInfo();
                }

            }
        });
    });

    //提交form表单信息到后台
    function submitInfo() {
        var options = {
            url: '__ListTestCaseURL__/test_plan_management/createTestPlan',
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function () {
            },
            success: function (result) {
                if (result.status == 1) {
                    layer.msg(result.info, {
                        icon: 1,
                        time: 1000
                    });
                    setTimeout(function () {
                        window.parent.location.reload();
                    }, 1000);
                } else {
                    layer.msg(result.info, function () {
                    });
                }
            }
        };
        $('#form-plan-add').ajaxSubmit(options);
    }
</script>
</body>
</html>