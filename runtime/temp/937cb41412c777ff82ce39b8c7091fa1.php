<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW/application/listtestcase\view\list_testcase_management\index.html";i:1532337626;}*/ ?>
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
                                        <select class="select" id="testPlanId" name="testPlanId">
                                            <option value="0" selected>==请选择测试计划==</option>
                                            <?php if(is_array($testPlans) || $testPlans instanceof \think\Collection || $testPlans instanceof \think\Paginator): $i = 0; $__LIST__ = $testPlans;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['test_plan_name']; ?> </option>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                     </span>
                                </td>
                                 <td style="padding-left:5px">
                                     <a class="btn btn-primary radius" href="javascript:;" onclick="openCreatePage()"><i
                                             class="Hui-iconfont">&#xe600;</i> 添加测试用例</a>
                                     <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()"><i
                                             class="Hui-iconfont">&#xe647;</i> 编辑测试用例</a>
                                     <a class="btn btn-danger radius" href="javascript:;" onclick="deleteTestCase()"><i
                                             class="Hui-iconfont">&#xe6e2;</i> 删除测试用例</a>
                                 </td>
                             </tr>
                        </table>
                    </span>
    </div>
    <table id="table"></table>
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
    var reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>'
    $(function () {
        init();
        $("#testPlanId").change(function () {
            testPlanId = $('#testPlanId').val();
            reqDataURL = '__ListTestCaseURL__/list_testcase_management/getTestcaseList?testPlanId=' + testPlanId + '&userId=<?php echo $userID; ?>';
            init();
        });
    });


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
     * 打开编辑测试计划页面
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
            pageSize: 20,
            pageNumber: 1,
            pageList: [20, 40, 80, 120, 'All'],
            search: false,
            sidePagination: 'server',
            clickToSelect: true,
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
                title: '测试用例标题'
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
            }]
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
</script>
</body>

</html>