<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"D:\phpStudy\WWW/application/datadictionary\view\test_env_management\index.html";i:1530618847;}*/ ?>
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
        测试环境管理
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
                       onclick="layer_show('添加测试环境','__DataDictionaryURL__/test_env_management/create_page','800','320')">
                        <i class="Hui-iconfont">&#xe600;</i> 添加测试环境
                    </a>
                    <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()">
                        <i class="Hui-iconfont">&#xe647;</i>
                        编辑测试环境
                    </a>
                    <a class="btn btn-danger radius" href="javascript:;" onclick="deleteEnv()">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                        删除测试环境
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

    //加载测试环境数据列表
    function init(userId) {
        $table = $('#table').bootstrapTable({
            url: '__DataDictionaryURL__/test_env_management/getEnvList',
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
                field: 'id',
                title: 'id',
                visible: false
            }, {
                checkbox: true,
                align: 'center',
                width: 5
            }, {
                field: 'env_name',
                title: '测试环境名称'
            }, {
                field: 'creator_name',
                align: 'center',
                title: '创建人',
                width: 80
            }, {
                field: 'create_date',
                align: 'center',
                title: '创建时间',
                width: 160
            }, {
                field: 'do',
                align: 'center',
                title: '操作',
                width: 130,
                formatter: operate
            }]
        });
    }


    function openEditPage() {
        var creator = '';
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            creator = row.creator_name;
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要编辑的测试环境！", function () {
            });
            return;
        }
        if (creator != '<?php echo $realName; ?>') {
            layer.msg("只允许创建人和管理员有权限作修改操作！", function () {
            });
            return;
        }
        layer_show('编辑测试环境', '__DataDictionaryURL__/test_env_management/edit_page?envId=' + id, '800', '320');
    }

    function deleteEnv() {
        var creator = '';
        var id = $.map($table.bootstrapTable('getSelections'), function (row) {
            creator = row.creator_name;
            return row.id;
        });
        if ((id == 0) || (id == null)) {
            layer.msg("请勾选需要删除的测试环境！", function () {
            });
            return;
        }
        if (creator != '<?php echo $realName; ?>') {
            layer.msg("只允许创建人和管理员有权限作删除操作！", function () {
            });
            return;
        }

        layer.confirm('测试环境删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'envId': id.toString()
            };
            $.ajax({
                data: usrData,
                url: "__DataDictionaryURL__/test_env_management/deleteEnv",
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
     * @param value
     * @param row
     * @param index
     * @returns {string}
     * 操作超链接设置
     */
    function operate(value, row, index) {
        var envId = row.id.toString();
        var remarkTitle = "'查看备注'";
        var remarkUrl = "'__DataDictionaryURL__/test_env_management/view_remark_page?envId=" + envId + "'";
        var remarkWidth = "'800'";
        var remarkHeight = "'260'";
        return '<a onclick="layer_show(' + remarkTitle + ',' + remarkUrl + ',' + remarkWidth + ',' + remarkHeight + ')">查看备注</a>';
    }
</script>
</body>

</html>