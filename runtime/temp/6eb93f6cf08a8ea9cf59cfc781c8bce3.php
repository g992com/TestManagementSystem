<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:109:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\base_testcase_management\edit_page.html";i:1533715299;}*/ ?>
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
        <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon">用例标题：</span>
                    <input type="text" class="form-control" id="tcName" name="tcName">
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-addon">标签：</span>
                    <input type="text" class="form-control" id="tag" name="tag">
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">前置条件：</span>
                    <textarea class="form-control" rows="3" id="perDescript" name="perDescript"></textarea>
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
            <button type="button" class="btn btn-success" onclick="save()">保 存</button>
            <button type="button" class="btn btn-danger" onClick="layer_close();">关 闭</button>
        </div>
    </div>
    <script src="__PUBLIC__/static/plugins/bootstrap/jquery.min.js"></script>
    <script src="__PUBLIC__/static/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript">
        initTCInfo();
        function initTCInfo() {
            $.ajax({
                data: {'tcId': <?php echo $tcId; ?>},
                url: "__ListTestCaseURL__/base_testcase_management/getBaseTCInfoById",
                type: "post",
                success: function (data) {
                    var tcInfo = $.parseJSON(data);
                    $('#tcName').val(tcInfo['tc_name']);
                    $('#tag').val(tcInfo['tag']);
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
                'tcName': $('#tcName').val().trim(),
                'tag': $('#tag').val().trim(),
                'perDescript': $('#perDescript').val().trim(),
                'stepDescript': $('#stepDescript').val().trim(),
                'expectDescript': $('#expectDescript').val().trim(),
                'creatorName': '<?php echo $realName; ?>'
            };
            $.ajax({
                data: usrData,
                async: false,
                url: "__ListTestCaseURL__/base_testcase_management/editBaseTestCase?tcId=<?php echo $tcId; ?>",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        layer.msg('基线用例编辑成功!', {
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