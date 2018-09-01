<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:104:"D:\phpStudy\TestManagementSystem\htdocs/application/listtestcase\view\share_management\list_tc_page.html";i:1533181980;}*/ ?>
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
    <link rel="Shortcut Icon" href="__PUBLIC__/favicon.ico"/>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        h1.editor-title {
            background: #C81623;
            color: white;
            margin: 0;
            height: 40px;
            font-size: 14px;
            line-height: 40px;
            font-family: 'Hiragino Sans GB', 'Arial', 'Microsoft Yahei';
            font-weight: normal;
            padding: 0 20px;
        }

        div.minder-editor-container {
            position: absolute;
            top: 40px;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>
        测试用例分享：<?php echo $shareName; ?>
    </title>
    </meta>
    </meta>
    </meta>
</head>

<body>
<h1 class="editor-title"><a class="logo navbar-logo f-l mr-10 hidden-xs" href="#"><img
        src="__PUBLIC__/static/images/atl.site.logo.png" alt="JD_LOGO"/></a><a style="color: #fff; font-size: 16px;">预览列表用例：<?php echo $shareName; ?></a>
    <a class="btn btn-primary radius" href="javascript:;" onclick="batchReviewPass()"><i
            class="Hui-iconfont">&#xe676;</i> 批量评审通过</a>
    <a class="btn btn-primary radius" href="javascript:;" onclick="exportTestCase()"><i
            class="Hui-iconfont">&#xe6ab;</i> 导出</a>
</h1>
<div class="page-container">

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
    init();

    /**
     * 加载用例数据列表
     */
    function init() {
        $table = $('#table').bootstrapTable('destroy').bootstrapTable({
            url: '__ListTestCaseURL__/share_management/getTestCaseList?testPlanId=<?php echo $testPlanId; ?>&testModuleId=<?php echo $testModuleId; ?>',
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
                    '<td><a style="font-size: 14px;text-decoration:none;" >预期结果：</a><br><pre>' + expectDescript + '</pre></td></tr></table>');
                $detailb.hide();
                $detailb.show(200);
            }
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
            return '<a style="color:green;text-decoration:none"><strong>测试通过</strong></a>';
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

    /**
     * 导出测试用例
     * Excel文件格式
     */
    function exportTestCase() {
        top.window.location = "__ListTestCaseURL__/share_management/exportListTestCase?testPlanId=<?php echo $testPlanId; ?>&testModuleId=<?php echo $testModuleId; ?>";
    }


    function batchReviewPass() {
        layer.confirm('您确认将用例都设置为评审通过状态吗？', function (index) {
            var usrData = {
                'testPlanId': '<?php echo $testPlanId; ?>',
                'testModuleId': '<?php echo $testModuleId; ?>'
            };
            $.ajax({
                data: usrData,
                url: "__ListTestCaseURL__/share_management/batchReviewPass",
                type: "post",
                success: function (data) {
                    $table.bootstrapTable('refresh');
                    if (data.status == 1) {
                        layer.msg('已批量设置评审状态为通过!', {
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
</script>
</body>

</html>