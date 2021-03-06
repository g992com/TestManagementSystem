<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:105:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\base_testcase_management\index.html";i:1535709640;}*/ ?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta content="webkit|ie-comp|ie-stand" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
          name="viewport"/>
    <meta content="no-siteapp" http-equiv="Cache-Control"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
    <![endif]-->
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/default/skin.css" id="skin" rel="stylesheet"
          type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap.min.css" rel="stylesheet">
    <link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap-table.css" rel="stylesheet">
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>
        基线用例
    </title>
    </meta>
    </meta>
    </meta>
</head>

<body>

<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">
                    <span class="l">
                        <table>
                             <tr>
                                <td>
                                    <span class="select-box">
                                        <select class="select" id="testModuleId" name="testModuleId">
                                            <option value="0" selected>==请选择测试模块==</option>
                                            <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?> </option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                     </span>
                                </td>
                                 <td style="padding-left:5px">
                                     <a class="btn btn-primary radius" href="javascript:;" onclick="openCreatePage()"><i
                                             class="Hui-iconfont">&#xe600;</i> 添加基线用例</a>
                                     <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()"><i
                                             class="Hui-iconfont">&#xe647;</i> 编辑基线用例</a>
                                     <a class="btn btn-danger radius" href="javascript:;" onclick="deleteTestCase()"><i
                                             class="Hui-iconfont">&#xe6e2;</i> 删除基线用例</a>
                                     <a class="btn btn-success radius" href="javascript:;"
                                        onclick="$table.bootstrapTable('refresh');"><i
                                             class="Hui-iconfont">&#xe68f;</i> 刷新</a>
                                     <a class="btn btn-primary radius" href="javascript:;" onclick='openBase2TcDialog()'><i
                                             class="Hui-iconfont">&#xe603;</i> 转普通用例</a>
                                     <a class="btn btn-warning radius" href="javascript:;" onclick="cloneTestCase()"><i
                                             class="Hui-iconfont">&#xe636;</i> 克隆用例</a>
                                     <input type="text" name="quickSearch" id="quickSearch" placeholder=" 按关键字查询"
                                            title="包括标签、用例标题、前置条件、操作步骤、预期结果等" style="width:100px"
                                            class="input-text radius">
                                 </td>
                             </tr>
                        </table>
                    </span>
    </div>
    <table id="table"></table>
    <div id="base2TcDialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="Hui-iconfont">&#xe603;</i> 选择基线用例的目标属性</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">目标测试计划：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testPlanId" name="testPlanId">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testPlans) || $testPlans instanceof \think\Collection || $testPlans instanceof \think\Paginator): $i = 0; $__LIST__ = $testPlans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['test_plan_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">目标测试模块：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testModuleId2" name="testModuleId2">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">目标测试类型：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testTypeId" name="testTypeId">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testTypes) || $testTypes instanceof \think\Collection || $testTypes instanceof \think\Paginator): $i = 0; $__LIST__ = $testTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">目标测试环境：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testEnvId" name="testEnvId">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testEnvs) || $testEnvs instanceof \think\Collection || $testEnvs instanceof \think\Paginator): $i = 0; $__LIST__ = $testEnvs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['env_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">目标优先级：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testLevel" name="testLevel">
                                    <option value="0">==请选择==</option>
                                    <option value="P0">P0</option>
                                    <option value="P1">P1</option>
                                    <option value="P2">P2</option>
                                    <option value="P3">P3</option>
                                    <option value="P4">P4</option>
                                    <option value="P5">P5</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success radius" onclick="base2TC()"><i class="Hui-iconfont">&#xe603;</i> 发送到普通用例库
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript">
</script>
<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript">
</script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript">
</script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript">
</script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap.js">
</script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js">
</script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js">
</script>
<script type="text/javascript">
    var testModuleId = 0;
    var reqDataURL = '__ListTestCaseURL__/base_testcase_management/getTestcaseList?testModuleId=' + testModuleId + '&userId=<?php echo $userID; ?>&keys='
    $(function () {
        init();
        $("#testModuleId").change(function () {
            testModuleId = $('#testModuleId').val();
            reqDataURL = '__ListTestCaseURL__/base_testcase_management/getTestcaseList?testModuleId=' + testModuleId + '&userId=<?php echo $userID; ?>&keys=';
            init();
        });

        $('#quickSearch').bind('input onchange', function () {
            keys = $('#quickSearch').val().trim();
            if (keys == '') {
                reqDataURL = '__ListTestCaseURL__/base_testcase_management/getTestcaseList?testModuleId=' + testModuleId + '&userId=<?php echo $userID; ?>&keys='
            } else {
                reqDataURL ='__ListTestCaseURL__/base_testcase_management/getTestcaseList?testModuleId=' + testModuleId + '&userId=<?php echo $userID; ?>&keys=' + keys;
            }
            init();
        })
    });


    function openCreatePage() {
        testModuleId = $('#testModuleId').val();
        if (testModuleId == 0) {
            layer.msg("请选择测试模块后再为其添加基线用例!");
            return;
        }
        var index = layer.open({
            title: false,
            type: 2,
            content: '__ListTestCaseURL__/base_testcase_management/add_testcase_page?testModuleId=' + testModuleId,
            area: ['600px', '450px'],
            end: function () {
                $table.bootstrapTable('refresh');
            }
        });
        layer.full(index);
    }

    /**
     * 打开编辑测试用例页面
     */
    function openEditPage() {
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要编辑的基线用例！", function () {
            });
            return;
        }
        var index = layer.open({
            title: false,
            type: 2,
            content: '__ListTestCaseURL__/base_testcase_management/edit_page?tcId=' + id,
            area: ['600px', '450px'],
            end: function () {
                $table.bootstrapTable('refresh');
            }
        });
        layer.full(index);
    }

    /**
     * 加载用例数据列表
     */
    function init() {
        $table = $('#table').bootstrapTable('destroy').bootstrapTable({
            url: reqDataURL,
            method: 'get',
            cache: false,
            height: document.body.clientHeight - 80,
            striped: true,
            pagination: true,
            singleSelect: true,
            pageSize: 20,
            pageNumber: 1,
            pageList: [20, 40, 80, 120, 'All'],
            search: false,
            sidePagination: 'server',
            clickToSelect: true,
            detailView: true,
            columns: [{
                checkbox: true,
                align: 'center',
                width: 5
            }, {
                field: 'id',
                title: 'ID',
                align: 'center',
                width: 60
            }, {
                field: 'tc_name',
                title: '基线用例标题'
            }, {
                field: 'creator_name',
                title: '创建/修改人',
                width: 100,
                align: 'center'
            }, {
                field: 'tag',
                title: '标签',
                width: 100,
                align: 'center'
            }, {
                field: 'create_date',
                title: '创建/修改时间',
                width: 150,
                align: 'center'
            }],
            onExpandRow: function (indexb, rowb, $detailb) {
                var perDescript = rowb.per_descript;
                var stepDescript = rowb.step_descript;
                var expectDescript = rowb.expect_descript;

                $detailb.html('<table border="0"><tr>' +
                    '<td width="50%"><a style="font-size: 14px;text-decoration:none;">前置条件：</a><br><pre>' + perDescript + '</pre></td>' +
                    '<td><a style="font-size: 14px;text-decoration:none;">创建时间：</a>' + rowb.create_date + '</td></tr>' +
                    '<tr><td width="50%"><a style="font-size: 14px;text-decoration:none;">操作步骤：</a><br><pre>' + stepDescript + '</pre></td>' +
                    '<td><a style="font-size: 14px;text-decoration:none;" >预期结果：</a><br><pre>' + expectDescript + '</pre></td></tr>' +
                    '<tr></table>');
                $detailb.hide();
                $detailb.show(200);
            }
        });
    }

    /**
     * 删除测试计划
     */
    function deleteTestCase() {
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要删除的基线用例！", function () {
            });
            return;
        }
        layer.confirm('基线用例删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'tcId': id.toString()
            };
            $.ajax({
                data: usrData,
                url: "__ListTestCaseURL__/base_testcase_management/deleteTesCase",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        $table.bootstrapTable('refresh');
                        layer.closeAll();
                        layer.msg('已删除!', {
                            icon: 1,
                            time: 1000
                        });
                    } else {
                        layer.msg(data.info, function () {
                        });
                    }
                }
            });
        });
    }


    //显示测试用例状态
    function showStatus(value, row, index) {
        if (row.status == 1) {
            return '<a style="color: #9B7536;text-decoration:none">未评审</a>';
        } else if (row.status == 2) {
            return '<a style="color:green;text-decoration:none">评审通过</a>';
        }
        else if (row.status == 3) {
            return '<a style="color:red;text-decoration:none">评审不通过</a>';
        } else if (row.status == 4) {
            return '<a style="color:red;text-decoration:none">测试失败</a>';
        }
        else if (row.status == 5) {
            return '<a style="color:green;text-decoration:none">测试通过</a>';
        }

    }

    //执行通过触发
    $(document).on("click", ".btn-pass", function () {
        var tcId = $(this).attr("data-id");
        var tcIndex = $(this).attr("data-index");
        runTC(tcIndex, tcId, 5);
    });

    //执行失败触发
    $(document).on("click", ".btn-fail", function () {
        var tcId = $(this).attr("data-id");
        var tcIndex = $(this).attr("data-index");
        runTC(tcIndex, tcId, 4);
    });

    //执行用例
    function runTC(tcIndex, tcId, status) {
        var usrData = {
            'tcId': tcId,
            'status': status,
            'operatorNname': "<?php echo $realName; ?>"
        };
        $.ajax({
            data: usrData,
            async: false,
            url: "__ListTestCaseURL__/base_testcase_management/runTC",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    layer.msg('测试用例执行成功!', {
                        icon: 1,
                        time: 1000
                    });
                    layer_close();
                    $("#table").bootstrapTable('updateRow', {
                        index: tcIndex,
                        row: {
                            operator_name: "<?php echo $realName; ?>",
                            status: status
                        }
                    });
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    /**
     * @type {number}
     * 打开转普通用例的对话框
     */
    var sendTestCaseId = 0;
    function openBase2TcDialog(){
        sendTestCaseId = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((sendTestCaseId == 0) || (sendTestCaseId == null)) {
            layer.msg("请勾选基线用例！", function () {
            });
            return;
        }
        $("#base2TcDialog").modal("show");
    }

    /**
     * 基线用例转普通用例
     */
    function base2TC(){

        var testPlanId = $('#testPlanId').val();
        if (testPlanId == 0) {
            layer.msg("请选择目标测试计划！", function () {
            });
            return;
        }
        var testModuleId2 = $('#testModuleId2').val();
        if (testModuleId2 == 0) {
            layer.msg("请选择目标测试模块！", function () {
            });
            return;
        }
        var testTypeId = $('#testTypeId').val();
        if (testTypeId == 0) {
            layer.msg("请选择目标测试类型！", function () {
            });
            return;
        }
        var testEnvId = $('#testEnvId').val();
        if (testEnvId == 0) {
            layer.msg("请选择目标测试环境！", function () {
            });
            return;
        }
        var testLevel = $('#testLevel').val();
        if (testLevel == 0) {
            layer.msg("请选择目标优先级！", function () {
            });
            return;
        }
        var usrData = {
            'sendTestCaseId': sendTestCaseId.toString(),
            'testPlanId': testPlanId,
            'testModuleId': testModuleId2,
            'testTypeId': testTypeId,
            'testEnvId': testEnvId,
            'testLevel': testLevel
        };
        $.ajax({
            data: usrData,
            url: "__ListTestCaseURL__/base_testcase_management/send2TC",
            type: "post",
            success: function (data) {
                $("#base2TcDialog").modal("hide");
                if (data.status == 1) {
                    layer.msg('已成功发送到普通用例库!', {
                        icon: 1,
                        time: 1000
                    });
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    /**
     * 克隆测试用例
     */
    function cloneTestCase() {
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要克隆的基线用例！", function () {
            });
            return;
        }
        var usrData = {
            'tcId': id.toString(),
            'operatorNname': "<?php echo $realName; ?>"
        };
        $.ajax({
            data: usrData,
            url: "__ListTestCaseURL__/base_testcase_management/cloneTestCase",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    $table.bootstrapTable('refresh');
                    layer.msg('克隆成功!', {
                        icon: 1,
                        time: 1000
                    });
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }
</script>
</body>

</html>