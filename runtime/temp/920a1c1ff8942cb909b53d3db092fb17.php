<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:105:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\list_testcase_management\index.html";i:1533869490;}*/ ?>
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
        测试用例
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
                                        <select class="select radius" id="testPlanId" name="testPlanId"
                                                style="width: 160px">
                                            <option value="0" selected>==请选择测试计划==</option>
                                            <?php if(is_array($testPlans) || $testPlans instanceof \think\Collection || $testPlans instanceof \think\Paginator): $i = 0; $__LIST__ = $testPlans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['test_plan_name']; ?> </option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                     </span>
                                </td>
                                 <td style="padding-left:5px">
                                     <a class="btn btn-primary radius" href="javascript:;" onclick="openCreatePage()"><i
                                             class="Hui-iconfont">&#xe600;</i> 添加用例</a>
                                     <!--
                                     <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()"><i
                                             class="Hui-iconfont">&#xe647;</i> 编辑用例</a>
                                     <a class="btn btn-danger radius" href="javascript:;" onclick="deleteTestCase()"><i
                                             class="Hui-iconfont">&#xe6e2;</i> 删除用例</a>
                                             -->
                                     <a class="btn btn-success radius" href="javascript:;"
                                        onclick="$table.bootstrapTable('refresh');"><i
                                             class="Hui-iconfont">&#xe68f;</i> 刷新</a>
                                     <a class="btn btn-primary radius" href="javascript:;"
                                        onclick="cloneTestCase()"><i
                                             class="Hui-iconfont">&#xe636;</i> 克隆用例</a>
                                     <a class="btn btn-warning radius" href="javascript:;"
                                        onclick="openAdvSearchPage()"><i
                                             class="Hui-iconfont">&#xe709;</i> 高级查询</a>
                                     <a class="btn btn-success radius" href="javascript:;"
                                        onclick="exportTestCase()"><i
                                             class="Hui-iconfont">&#xe6ab;</i> 导出</a>
                                     <a class="btn btn-primary radius" href="javascript:;"
                                        onclick="openSharePage()"><i
                                             class="Hui-iconfont">&#xe6aa;</i> 分享</a>
                                    <a class="btn btn-warning radius" href="javascript:;" onclick="open2BaseTCPage()"><i
                                            class="Hui-iconfont">&#xe603;</i> 转基线</a>
                                     <input type="text" name="quickSearch" id="quickSearch" placeholder=" 按关键字查询"
                                            title="包括标签、用例标题、前置条件、操作步骤、预期结果、创建/修改人、优先级、执行人等" style="width:100px"
                                            class="input-text radius">
                                 </td>
                             </tr>
                        </table>
                    </span>
    </div>
    <table id="table" data-unique-id="id"></table>
    <div id="advSearchDialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="Hui-iconfont">&#xe709;</i> 高级查询</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">测试计划：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testPlanId4Search" name="testPlanId4Search">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testPlans) || $testPlans instanceof \think\Collection || $testPlans instanceof \think\Paginator): $i = 0; $__LIST__ = $testPlans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['test_plan_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">所属模块：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testModuleId4Search" name="testModuleId4Search">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">测试类型：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testTypeId4Search" name="testTypeId4Search">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testTypes) || $testTypes instanceof \think\Collection || $testTypes instanceof \think\Paginator): $i = 0; $__LIST__ = $testTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['type_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">测试环境：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testEnvId4Search" name="testEnvId4Search">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testEnvs) || $testEnvs instanceof \think\Collection || $testEnvs instanceof \think\Paginator): $i = 0; $__LIST__ = $testEnvs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['env_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success radius" onclick="advSearch()"><i class="Hui-iconfont">&#xe709;</i> 查
                        询
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="tc2BaseDialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title"><i class="Hui-iconfont">&#xe603;</i> 普通用例转为基线用例</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <form class="form form-horizontal">
                        <div class="row cl">
                            <label class="form-label col-xs-5 col-sm-3">发送目标模块：</label>
                            <div class="formControls col-xs-12 col-sm-8">
                                <select class="form-control" id="testModuleId2Base" name="testModuleId2Base">
                                    <option value="0">==请选择==</option>
                                    <?php if(is_array($testModules) || $testModules instanceof \think\Collection || $testModules instanceof \think\Paginator): $i = 0; $__LIST__ = $testModules;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['module_name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success radius" onclick="send2BaseTC()"><i class="Hui-iconfont">&#xe603;</i>
                        发送到基线库
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
    var testPlanId = 0;
    var keys = "";
    var reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>&keys=';
    $(function () {
        init();
        $("#testPlanId").change(function () {
            testPlanId = $('#testPlanId').val();
            reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>&keys=' + keys;
            init();
        });

        $('#quickSearch').bind('input onchange', function () {
            keys = $('#quickSearch').val().trim();
            if (keys == '') {
                reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>&keys=';
            } else {
                reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>&keys=' + keys;
            }
            init();
        })
    });

    /**
     *打开新建用例页面
     * */
    function openCreatePage() {
        testPlanId = $('#testPlanId').val();
        if (testPlanId == 0) {
            layer.msg("请选择测试计划后再为其添加测试用例!");
            return;
        }
        var index = layer.open({
            title: false,
            type: 2,
            content: '__ListTestCaseURL__/list_testcase_management/add_testcase_page?testPlanId=' + testPlanId,
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
            layer.msg("请勾选需要编辑的测试用例！", function () {
            });
            return;
        }
        var index = layer.open({
            title: false,
            type: 2,
            content: '__ListTestCaseURL__/list_testcase_management/edit_page?tcId=' + id,
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
            pageSize: 40,
            pageNumber: 1,
            pageList: [40,80,120,'All'],
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
                title: '测试用例标题',
                formatter: showTitle
            }, {
                field: 'test_module',
                title: '测试模块',
                width: 100,
                align: 'center'
            }, {
                field: 'test_type',
                title: '测试类型',
                width: 100,
                align: 'center'
            }, {
                field: 'test_env',
                title: '测试环境',
                width: 100,
                align: 'center'
            }, {
                field: 'tc_level',
                title: '优先级',
                width: 100,
                align: 'center'
            }, {
                field: 'status',
                title: '状态',
                align: 'center',
                width: 80,
                formatter: showStatus
            }, {
                field: 'creator_name',
                title: '创建/修改人',
                width: 100,
                align: 'center'
            }, {
                field: 'operator_name',
                title: '执行人',
                width: 100,
                align: 'center'
            }, {
                field: 'tag',
                title: '标签',
                width: 100,
                align: 'center'
            }, {
                field: 'is_smoke',
                title: '是否冒烟',
                width: 100,
                align: 'center',
                visible: false
            }],
            onExpandRow: function (indexb, rowb, $detailb) {
                var perDescript = rowb.per_descript;
                var stepDescript = rowb.step_descript;
                var expectDescript = rowb.expect_descript;
                var tcId = rowb.id;

                $detailb.html('<table border="0"><tr>' +
                    '<td width="50%"><a style="font-size: 14px;text-decoration:none;">前置条件：</a><br><pre>' + perDescript + '</pre></td>' +
                    '<td><a style="font-size: 14px;text-decoration:none;">创建时间：</a>' + rowb.create_date + '<br>' +
                    '<a style="font-size: 14px;text-decoration:none;">执行时间：</a>' + rowb.run_date + '</td></tr>' +
                    '<tr><td width="50%"><a style="font-size: 14px;text-decoration:none;">操作步骤：</a><br><pre>' + stepDescript + '</pre></td>' +
                    '<td><a style="font-size: 14px;text-decoration:none;" >预期结果：</a><br><pre>' + expectDescript + '</pre></td></tr>' +
                    '<tr><td style="text-align: right">' +
                    '<a class="btn btn-success radius btn-sm btn-pass" data-index="' + indexb + '"  data-id="' + tcId + '" href="javascript:;"><i class="Hui-iconfont">&#xe6a7;</i> 执 行 通 过</a>' +
                    '</td><td>' +
                    '<a class="btn btn-danger radius btn-sm btn-fail"  data-index="' + indexb + '" data-id="' + tcId + '" href="javascript:;"><i class="Hui-iconfont">&#xe6a6;</i> 执 行 失 败</a>&nbsp;' +
                    '<a class="btn btn-warning radius btn-sm btn-edit" data-index="' + indexb + '"  data-id="' + tcId + '" href="javascript:;" title="编辑用例"><i class="Hui-iconfont">&#xe647;</i> </a>&nbsp;'+
                    '<a class="btn btn-danger radius btn-sm btn-delete"  data-index="' + indexb + '" data-id="' + tcId + '" href="javascript:;" title="删除用例"><i class="Hui-iconfont">&#xe6e2;</i> </a>' +
                    '</td></tr></table>');
                $detailb.hide();
                $detailb.show(200);
            }
        });
    }

    /**
     * 删除测试用例
     */
    function deleteTestCase() {
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要删除的测试用例！", function () {
            });
            return;
        }
        layer.confirm('测试用例删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'tcId': id.toString()
            };
            $.ajax({
                data: usrData,
                url: "__ListTestCaseURL__/list_testcase_management/deleteTesCase",
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
            return '<a style="color:#2b542c;text-decoration:none">评审通过</a>';
        }
        else if (row.status == 3) {
            return '<a style="color:red;text-decoration:none">评审不通过</a>';
        } else if (row.status == 4) {
            return '<a style="color:red;text-decoration:none"><strong>测试失败</strong></a>';
        }
        else if (row.status == 5) {
            return '<a style="color:green;text-decoration:none;"><strong>测试通过</strong></a>';
        }

    }

    /**
     * 对测试用例标题进行内容格式化
     * */
    function showTitle(value, row, index){
        if (row.is_smoke == 1) {
            return '<a style="color:darkred"><strong>[冒烟]</strong></a> '+value;
        }else{
            return value;
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

    //编辑用例触发
    $(document).on("click", ".btn-edit", function () {
        var tcId = $(this).attr("data-id");
        var index = layer.open({
            title: false,
            type: 2,
            content: '__ListTestCaseURL__/list_testcase_management/edit_page?tcId=' + tcId,
            area: ['600px', '450px'],
            end: function () {
                $table.bootstrapTable('refresh');
            }
        });
        layer.full(index);
    });

    //删除用例触发
    $(document).on("click", ".btn-delete", function () {
        var tcId = $(this).attr("data-id");
      //  var tcIndex = $(this).attr("data-index");
        layer.confirm('测试用例删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'tcId': tcId.toString()
            };
            $.ajax({
                data: usrData,
                url: "__ListTestCaseURL__/list_testcase_management/deleteTesCase",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        $('#table').bootstrapTable('removeByUniqueId', tcId.toString());
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
            url: "__ListTestCaseURL__/list_testcase_management/runTC",
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
     * 克隆测试用例
     */
    function cloneTestCase() {
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要克隆的测试用例！", function () {
            });
            return;
        }
        var usrData = {
            'tcId': id.toString(),
            'operatorNname': "<?php echo $realName; ?>"
        };
        $.ajax({
            data: usrData,
            url: "__ListTestCaseURL__/list_testcase_management/cloneTestCase",
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

    /**
     * 导出测试用例
     * Excel文件格式
     */
    function exportTestCase() {
        if (testPlanId == 0) {
            layer.msg("请选择测试计划，导出其下的所有测试用例！", function () {
            });
            return;
        } else {
            top.window.location = "__ListTestCaseURL__/list_testcase_management/exportListTestCase?testPlanId=" + testPlanId;
        }
    }

    /**
     * 打开分享对话框
     */
    function openSharePage() {
        if (testPlanId == 0) {
            layer.msg("请先选择测试计划！", function () {
            });
            return;
        } else {
            var index = layer.open({
                title: '<i class="Hui-iconfont">&#xe6aa;</i> 分享测试用例',
                type: 2,
                content: '__ListTestCaseURL__/list_testcase_management/share_testcase_page?testPlanId=' + testPlanId,
                area: ['820px', '235px'],
                shift: 1,
                end: function () {

                }
            });
        }
    }

    /**
     * 打开高级查询对话框
     */
    function openAdvSearchPage() {
        $("#advSearchDialog").modal("show");
        if (testPlanId != 0) {
            $('#testPlanId4Search').val(testPlanId);
            $('#testPlanId4Search').attr('disabled', 'disabled');
        } else {
            $('#testPlanId4Search').val(0);
            $('#testPlanId4Search').removeAttr('disabled');
        }
    }

    /**
     * 执行高级查询操作
     */
    function advSearch() {
        var testPlanId = $('#testPlanId4Search').val();
        var testModuleId = $('#testModuleId4Search').val();
        var testTypeId = $('#testTypeId4Search').val();
        var testEnvId = $('#testEnvId4Search').val();
        reqDataURL = '__ListTestCaseURL__/list_testcase_management/advSearchTC?testPlanId=' + testPlanId + '&testModuleId=' + testModuleId + '&testTypeId=' + testTypeId + '&testEnvId=' + testEnvId;
        init();
        // $('#testPlanId4Search').val(0);
        //  $('#testModuleId4Search').val(0);
        //$('#testTypeId4Search').val(0);
        //$('#testEnvId4Search').val(0);
        $("#advSearchDialog").modal("hide");
    }

    /**
     * 打开转基线对话框
     */
    var sendTestCaseId = 0;
    function open2BaseTCPage() {
        sendTestCaseId = $.map($table.bootstrapTable('getSelections'), function (row) {
            return row.id;
        });
        if ((sendTestCaseId == 0) || (sendTestCaseId == null)) {
            layer.msg("请勾选测试用例！", function () {
            });
            return;
        }
        $("#tc2BaseDialog").modal("show");
    }

    /**
     * 将用例发送到基线库
     */
    function send2BaseTC() {
        var testModuleId = $('#testModuleId2Base').val();
        if (testModuleId == 0) {
            layer.msg("请选择需要发送到的目标模块！", function () {
            });
            return;
        }
        var usrData = {
            'sendTestCaseId': sendTestCaseId.toString(),
            'testModuleId': testModuleId
        };
        $.ajax({
            data: usrData,
            url: "__ListTestCaseURL__/list_testcase_management/send2BaseTC",
            type: "post",
            success: function (data) {
                $("#tc2BaseDialog").modal("hide");
                if (data.status == 1) {
                    layer.msg('已成功发送到基线库!', {
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