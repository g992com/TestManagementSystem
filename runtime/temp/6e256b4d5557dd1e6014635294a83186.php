<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW/application/listtestcase\view\test_plan_management\index.html";i:1530861321;}*/ ?>
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
    $(function () {
        var userId = "<?php echo $userID; ?>"
        init(userId);
    });


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
    function init(userId) {
        $table = $('#table').bootstrapTable({
            url: '__ListTestCaseURL__/test_plan_management/getTestPlanList',
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
            },{
                field: 'no_run_tc_totle',
                align: 'center',
                title: '未执行总数',
                width: 90
            },  {
                field: 'progress',
                align: 'center',
                title: '用例执行进度',
                width: 160,
                formatter: showProgress
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


    function showProgress(value, row, index) {
        return '<nobr><progress value="'+row.progress +'" max="100"></progress> '+row.progress +'%</nobr>';
    }

    /**
     * @param value
     * @param row
     * @param index
     * @returns {string}
     * 重新对表格中的计划名称进行显示，添加计划开始和结束时间
     */
    function showPlanName(value, row, index) {
        return row.test_plan_name+'（'+row.start_date+' 至 '+row.end_date+'）';
    }


</script>
</body>

</html>