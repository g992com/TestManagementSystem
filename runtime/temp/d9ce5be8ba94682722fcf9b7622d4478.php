<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:119:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\list_testcase_management\share_testcase_page.html";i:1532505770;}*/ ?>
﻿<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加测试用例</title>
    <!-- Bootstrap -->
    <link href="__PUBLIC__/static/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="__PUBLIC__/static/plugins/bootstrap/html5shiv.min.js"></script>
    <script src="__PUBLIC__/static/plugins/bootstrap/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div style="margin:15px">
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">测试计划：</span>
                <select class="form-control radius" id="testPlan" name="testPlan">
                    <option value="0">==请选择==</option>
                    <?php if(is_array($testPlans) || $testPlans instanceof \think\Collection || $testPlans instanceof \think\Paginator): $i = 0; $__LIST__ = $testPlans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['test_plan_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">所属模块：</span>
                <select class="form-control radius" id="testModule" name="testModule">
                    <option value="0">==请选择==</option>
                    <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">预览链接：</span>
                <input type="text" class="form-control radius" id="shareURL" name="shareURL" readonly="readonly">
            </div>
        </div>
    </div>


    <p align="right">
        <button type="button" class="btn btn-success" onclick="saveShareURL()">生 成</button>
        <button type="button" class="btn btn-danger" onclick="layer_close()">关 闭</button>
    </p>
</div>
<script src="__PUBLIC__/static/plugins/bootstrap/jquery.min.js"></script>
<script src="__PUBLIC__/static/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript">
    $('#testPlan').val("<?php echo $testPlanId; ?>");
    window.onload = function () {
        $("#testPlan").change(function () {
            showShareURL();
        });
        $("#testModule").change(function () {
            showShareURL();
        });
    };

    /**
     * 在文本框中显示URL
     * */
    function showShareURL() {
        var testPlanId = $('#testPlan').val();
        var testModuleId = $('#testModule').val();
        if ((testPlanId == 0) || (testModuleId == 0)) {
            $('#shareURL').val('');
        } else {
            var APP_URL = '__ListTestCaseURL__';
            var serverIp = '<?php echo \think\Config::get('SERVER_IP'); ?>';
            var URL = 'http://' + serverIp + APP_URL + '/share_management/list_tc_page?testPlanId=' + testPlanId + '&testModuleId=' + testModuleId;
            $('#shareURL').val(URL);
        }
    }

    /**
     *生成用例分享信息
     * */
    function saveShareURL() {
        if (!checkInput()) {
            return;
        } else {
            var usrData = {
                'testPlanId': $('#testPlan').val(),
                'testModuleId': $('#testModule').val(),
                'shareURL': $('#shareURL').val(),
                'creatorName': '<?php echo $realName; ?>'
            };
            $.ajax({
                data: usrData,
                async: false,
                url: "__ListTestCaseURL__/list_testcase_management/addShareTCInfo",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        layer.msg('生成用例分享信息成功!', {
                            icon: 1,
                            time: 1000
                        }, function () {
                            layer_close();
                        });

                    } else {
                        layer.msg(data.info, function () {
                        });
                    }
                }
            });
        }
    }


    /**
     * @returns {boolean}
     * 判断输入框必填项
     */
    function checkInput() {
        var testPlanId = $('#testPlan').val();
        if (testPlanId == 0) {
            layer.msg("请选择测试计划!");
            return false;
        }

        var testModuleId = $('#testModule').val();
        if (testModuleId == 0) {
            layer.msg("请选择所属模块!");
            return false;
        }
        var shareURL = $('#shareURL').val();
        if (shareURL == '') {
            layer.msg("未找到生成的分享链接地址!");
            return false;
        }
        return true;
    }
</script>

</body>
</html>