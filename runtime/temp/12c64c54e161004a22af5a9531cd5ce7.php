<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:109:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\list_testcase_management\edit_page.html";i:1533279290;}*/ ?>
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
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">所属模块：</span>
                <select class="form-control" id="testModule" name="testModule">
                    <option value="0">==请选择==</option>
                    <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">用例类型：</span>
                <select class="form-control" id="testType" name="testType">
                    <option value="0">==请选择==</option>
                    <?php if(is_array($testTypes) || $testTypes instanceof \think\Collection || $testTypes instanceof \think\Paginator): $i = 0; $__LIST__ = $testTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-addon">测试环境：</span>
                <select class="form-control" id="testEnv" name="testEnv">
                    <option value="0">==请选择==</option>
                    <?php if(is_array($testEnvs) || $testEnvs instanceof \think\Collection || $testEnvs instanceof \think\Paginator): $i = 0; $__LIST__ = $testEnvs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['env_name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-addon">用例标题：</span>
                <input type="text" class="form-control" id="tcName" name="tcName" value="<?php echo $tcName; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <span class="input-group-addon">优先级：</span>
                <select class="form-control" id="testLevel" name="testLevel">
                    <option value="P0">P0</option>
                    <option value="P1">P1</option>
                    <option value="P2">P2</option>
                    <option value="P3">P3</option>
                    <option value="P4">P4</option>
                    <option value="P5">P5</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <span class="input-group-addon">标签：</span>
                <input type="text" class="form-control" id="tag" name="tag" value="<?php echo $tag; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <span class="input-group-addon">冒烟：</span>
                <select class="form-control" id="isSmoke" name="isSmoke">
                    <option value="0">否</option>
                    <option value="1">是</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 8px;">
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-addon">前置条件：</span>
                <textarea class="form-control" rows="2" id="perDescript" name="perDescript"></textarea>
            </div>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    操作步骤：
                </div>
                <div class="panel-body">
                    <textarea class="form-control" rows="13" id="stepDescript" name="stepDescript"></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    预期结果：
                </div>
                <div class="panel-body">
                    <textarea class="form-control" rows="13" id="expectDescript" name="expectDescript"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div style="text-align:center">
        <button type="button" class="btn btn-success" onclick="review(2)" id="reviewPassBtn" style="display: none">评审通过
        </button>
        <button type="button" class="btn btn-danger" onclick="review(3)" id="reviewFailBtn" style="display: none">评审不通过
        </button>
        <button type="button" class="btn btn-success" onclick="save()">保 存</button>
        <button type="button" class="btn btn-danger" onClick="layer_close();">关 闭</button>
    </div>
</div>
<script src="__PUBLIC__/static/plugins/bootstrap/jquery.min.js"></script>
<script src="__PUBLIC__/static/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript">
    window.onload = function () {
        /*评审按钮显示逻辑*/
        if ("<?php echo $status; ?>" == 1) {
            $('#reviewPassBtn').show();
            $('#reviewFailBtn').show();
        } else if ("<?php echo $status; ?>" == 2) {
            $('#reviewPassBtn').hide();
            $('#reviewFailBtn').hide();
        } else if ("<?php echo $status; ?>" == 3) {
            $('#reviewPassBtn').show();
        }

        $('#testModule').val("<?php echo $testModuleId; ?>");
        $('#testType').val("<?php echo $testTypeId; ?>");
        $('#testEnv').val("<?php echo $testEnvId; ?>");
        $('#testLevel').val("<?php echo $tcLevel; ?>");
        $('#isSmoke').val("<?php echo $isSmoke; ?>");
        initTCInfo();
    }

    /**
     * 对多行文本框的内容进行单独填充
     * */
    function initTCInfo() {
        $.ajax({
            data: {'tcId':<?php echo $tcId; ?>},
            url: "__ListTestCaseURL__/list_testcase_management/getTCInfoById",
            type: "post",
            success: function(data) {
                var tcInfo = $.parseJSON(data);
                $('#perDescript').val(tcInfo['per_descript']);
                $('#stepDescript').val(tcInfo['step_descript']);
                $('#expectDescript').val(tcInfo['expect_descript']);
            }
        });
    }

    /**
     * 保存测试用例内容
     * */
    function save() {
        if (!checkInput()) {
            return;
        }
        var usrData = {
            'testModuleId': $('#testModule').val(),
            'testTypeId': $('#testType').val(),
            'testEnvId': $('#testEnv').val(),
            'tcName': $('#tcName').val().trim(),
            'testLevel': $('#testLevel').find("option:selected").text(),
            'tag': $('#tag').val().trim(),
            'perDescript': $('#perDescript').val().trim(),
            'stepDescript': $('#stepDescript').val().trim(),
            'expectDescript': $('#expectDescript').val().trim(),
            'isSmoke': $('#isSmoke').val().trim(),
            'creatorName': '<?php echo $realName; ?>'
        };
        $.ajax({
            data: usrData,
            async: false,
            url: "__ListTestCaseURL__/list_testcase_management/editListTestCase?tcId=<?php echo $tcId; ?>",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    layer.msg('测试用例编辑成功!', {
                        icon: 1,
                        time: 1000
                    });
                    layer_close();
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    /**
     * 设置评审状态
     * */
    function review(status) {
        var usrData = {
            'tcId': '<?php echo $tcId; ?>',
            'status': status
        };
        $.ajax({
            data: usrData,
            async: false,
            url: "__ListTestCaseURL__/list_testcase_management/modifyStatus",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    layer.msg('测试用例状态修改成功!', {
                        icon: 1,
                        time: 1000
                    });
                    layer_close();
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }


    /**
     * @returns {boolean}
     * 判断输入框必填项
     */
    function checkInput() {
        var testModuleId = $('#testModule').val();
        if (testModuleId == 0) {
            layer.msg("请选择用例所属模块!");
            return false;
        }
        var testTypeId = $('#testType').val();
        if (testTypeId == 0) {
            layer.msg("请选择用例类型!");
            return false;
        }
        var testEnvId = $('#testEnv').val();
        if (testEnvId == 0) {
            layer.msg("请选择测试环境!");
            return false;
        }
        var tcName = $('#tcName').val().trim();
        if (tcName == '') {
            layer.msg("请填写用例标题!");
            return false;
        }
        var stepDescript = $('#stepDescript').val().trim();
        if (stepDescript == '') {
            layer.msg("请填写操作步骤!");
            return false;
        }
        var expectDescript = $('#expectDescript').val().trim();
        if (expectDescript == '') {
            layer.msg("请填写预期结果!");
            return false;
        }
        return true;
    }
</script>

</body>
</html>