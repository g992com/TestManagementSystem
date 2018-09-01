<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"D:\phpStudy\WWW/application/testcase\view\share_management\index.html";i:1530512851;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/plugins/gooflow0.8/css/GooFlow2.css"/>
    <!--<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/plugins/gooflow0.8/css/default.css"/>-->
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>
        用例分享
    </title>
</head>

<body>
<div class="page-container">

    <div class="cl pd-5 bg-1 bk-gray">
        <table>
            <tr>
                <td style="padding-left:5px">
                    <input type="text" class="input-text" placeholder="按分享人姓名、用例类型快速搜索" id="keyWords" name="keyWords">
                </td>
            </tr>
        </table>
    </div>
    <table id="table"></table>
</div>
<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap.js"></script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>

<script type="text/javascript">
    var sql = '__TestCaseURL__/share_management/getShareList?key=|ALL|';
    $(function () {
        $("#keyWords").keyup(function(){
            searchShare();
        });
        init();
    });

    //加载项目数据列表
    function init() {
        $table = $('#table').bootstrapTable('destroy').bootstrapTable({
            url: sql,
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
                field: 'number',
                title: '序号',
                width: 5,
                align: 'center',
                switchable: false,
                formatter: function (value, row, index) {
                    var pageSize = $('#table').bootstrapTable('getOptions').pageSize; //通过表的#id 可以得到每页多少条
                    var pageNumber = $('#table').bootstrapTable('getOptions').pageNumber; //通过表的#id 可以得到当前第几页
                    return pageSize * (pageNumber - 1) + index + 1; //返回每条的序号： 每页条数 * （当前页 - 1 ）+ 序号
                }
            }, {
                field: 'id',
                title: 'id',
                visible: false
            }, {
                field: 'node_name',
                title: '节点名称'
            }, {
                field: 'type',
                align: 'center',
                title: '类型',
                formatter: showType
            }, {
                field: 'share_url',
                title: '访问地址',
                formatter: openUrl
            }, {
                field: 'creator_name',
                align: 'center',
                title: '分享人'
            }, {
                field: 'create_date',
                align: 'center',
                title: '分享时间',
                width: 150
            }]
        });
    }


    function searchShare() {
        var keyWords = $('#keyWords').val().trim();
        if(keyWords==""){
            sql = '__TestCaseURL__/share_management/getShareList?key=|ALL|';
        }else{
            sql = '__TestCaseURL__/share_management/getShareList?key='+keyWords;
        }
        init();
    }

    function showType(value, row, index) {
        var color = 'green';
        var icon = '&#xe681;';
        if (row.type == "导图用例") {
            color = 'red';
            icon = '&#xe6aa;';
        }
        return '<p style="color:' + color + '"><i class="Hui-iconfont">' + icon + '</i> ' + row.type + '</p>';
    }

    function openUrl(value, row, index) {
        return '<a href="' + row.share_url + '" target="_blank">' + row.share_url + '</a>';
    }
</script>
</body>

</html>