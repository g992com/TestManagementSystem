<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:101:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\test_plan_management\index.html";i:1533715919;}*/ ?>
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
        测试计划
    </title>
    </meta>
    </meta>
    </meta>
</head>

<body>

<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">

				<span class="l">
                    <a class="btn btn-primary radius" href="javascript:;"
                       onclick="openCreatePage()">
                        <i class="Hui-iconfont">&#xe600;</i> 添加计划
                    </a>
                    <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()">
                        <i class="Hui-iconfont">&#xe647;</i>
                        编辑计划
                    </a>
                    <a class="btn btn-danger radius" href="javascript:;" onclick="deleteTestPlan()">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                        删除计划
                    </a>
                     <a class="btn btn-success radius" href="javascript:;"
                        onclick="$table.bootstrapTable('refresh');"><i
                             class="Hui-iconfont">&#xe68f;</i> 刷新</a>
                    <input type="text" name="quickSearch" id="quickSearch" placeholder=" 按测试计划名称、测试PO、创建人快速查询"
                           style="width:290px"
                           class="input-text radius">
                    <select class="select radius" id="statusSearch" name="statusSearch"
                            style="width: 130px;height: 31px">
                        <option value="1" selected>==按状态筛选==</option>
                        <option value="3">未开始</option>
                        <option value="4">进行中</option>
                        <option value="5">已结束</option>
                    </select>
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
    var reqDataURL = '__ListTestCaseURL__/test_plan_management/getTestPlanList?keys=&statusId=1';
    var keys = '';
    $(function () {
        init();
        $('#quickSearch').bind('input onchange', function () {
            keys = $('#quickSearch').val().trim();
            if (keys === '') {
                reqDataURL = '__ListTestCaseURL__/test_plan_management/getTestPlanList?keys=&statusId=1';
            } else {
                reqDataURL = '__ListTestCaseURL__/test_plan_management/getTestPlanList?keys=' + keys+'&statusId=1';
            }
            init();
        });
        $("#statusSearch").change(function () {
            var statusId = $('#statusSearch').val();
            reqDataURL = '__ListTestCaseURL__/test_plan_management/getTestPlanList?keys=' + keys+'&statusId='+statusId;
            init();
        });

    });

    /**
     *打开测试计划创建页面
     * */
    function openCreatePage() {
        var index = layer.open({
            title: "<i class='Hui-iconfont'>&#xe600;</i> 添加测试计划",
            type: 2,
            content: '__ListTestCaseURL__/test_plan_management/create_page',
            area: ['600px', '450px']
        });
        layer.full(index);
    }

    /**
     * @param userId
     * 加载计划数据列表
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
            pageList: [40, 80, 120, 'All'],
            search: false,
            sidePagination: 'server', //设置为服务器端分页
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
                field: 'test_plan_name',
                title: '测试计划名称',
                formatter: showPlanName
            }, {
                field: 'test_po',
                title: '测试PO',
                align: 'center',
                width: 80
            }, {
                field: 'tc_totle',
                align: 'center',
                title: '用例总数',
                width: 80
            }, {
                field: 'pass_tc_totle',
                align: 'center',
                title: '通过数',
                width: 80
            }, {
                field: 'fail_tc_totle',
                align: 'center',
                title: '失败数',
                width: 80
            }, {
                field: 'no_run_tc_totle',
                align: 'center',
                title: '未执行总数',
                width: 90
            }, {
                field: 'progress',
                align: 'center',
                title: '用例执行进度',
                width: 160,
                formatter: showProgress
            }, {
                field: 'status',
                align: 'center',
                title: '状态',
                width: 70,
                formatter: showStatus
            }, {
                field: 'creator_name',
                align: 'center',
                title: '创建人',
                width: 80
            }]
        });
    }

    /**
     * 打开编辑测试计划页面
     */
    function openEditPage() {
        var creator = '';
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            creator = row.creator_name;
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要编辑的测试计划！", function () {
            });
            return;
        }
        if (creator != '<?php echo $realName; ?>') {
            layer.msg("只允许创建人和管理员有权限作修改操作！", function () {
            });
            return;
        }

        var index = layer.open({
            title: "<i class='Hui-iconfont'>&#xe647;</i> 编辑测试计划",
            type: 2,
            content: '__ListTestCaseURL__/test_plan_management/edit_page?testPlanId=' + id,
            area: ['600px', '450px']
        });
        layer.full(index);
    }

    /**
     * 删除测试计划
     */
    function deleteTestPlan() {
        var creator = '';
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            creator = row.creator_name;
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要删除的测试计划！", function () {
            });
            return;
        }
        if (creator != '<?php echo $realName; ?>') {
            layer.msg("只允许创建人和管理员有权限作删除操作！", function () {
            });
            return;
        }

        layer.confirm('计划删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'testPlanId': id.toString()
            };
            $.ajax({
                data: usrData,
                url: "__ListTestCaseURL__/test_plan_management/deleteTestPlan",
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

    /**
     *进度条显示
     * */
    function showProgress(value, row, index) {
        return '<nobr><progress value="' + row.progress + '" max="100"></progress> ' + row.progress + '%</nobr>';
    }

    /**
     * 状态显示
     * */
    function showStatus(value, row, index) {
        if (value === 3) {
            return '<a style="color:red;text-decoration:none">未开始</a>';
        } else if (value === 4) {
            return '<a style="color:orange;text-decoration:none">进行中</a>';
        } else if (value === 5) {
            return '<a style="color:green;text-decoration:none">已结束</a>';
        } else {
            return "未知";
        }
    }


    /**
     * @param value
     * @param row
     * @param index
     * @returns {string}
     * 重新对表格中的计划名称进行显示，添加计划开始和结束时间
     */
    function showPlanName(value, row, index) {
        return row.test_plan_name + '（' + row.start_date + ' 至 ' + row.end_date + '）';
    }


</script>
</body>

</html>