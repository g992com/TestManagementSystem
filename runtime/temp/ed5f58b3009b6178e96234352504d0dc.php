<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\phpStudy\TestManagementSystem\htdocs/application/testcase\view\node_management\index.html";i:1532936064;}*/ ?>
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
        节点管理
    </title>
</head>
<body>
<div class="page-container">
    <table>
        <tr>
            <td width="220" class="va-t">
                <select class="select" id="prjName" name="prjName">
                    <option value="0">--请选择项目名称--</option>
                    <?php if(is_array($prjLst) || $prjLst instanceof \think\Collection || $prjLst instanceof \think\Paginator): $i = 0; $__LIST__ = $prjLst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $vo['id']; ?>">
                        <?php echo $vo['prj_name']; ?>
                    </option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <div id="treeDiv" style="overflow:scroll;overflow-x:hidden">
                    <div id="nodeTreeView" style="font-size:12px;"></div>
                </div>
            </td>
            <td class="va-t">
                <form class="form form-horizontal">
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">
                            <span class="c-red">*</span>
                            节点名称：</label>
                        <div class="formControls col-xs-6 col-sm-6">
                            <input type="text" class="input-text" value="" placeholder="" id="nodName" name="nodName">
                        </div>
                    </div>
                    <div class="row cl">
                        <label class="form-label col-xs-4 col-sm-2">备注：</label>
                        <div class="formControls col-xs-6 col-sm-6">
                            <textarea id="remark" name="remark" class="textarea"></textarea>
                        </div>
                    </div>
                    <div class="row cl">
                        <div class="col-9 col-offset-2">
                                 <span class="l">
                                  <a class="btn btn-primary radius" onclick="addNode()" id="btnAdd"
                                     style="display: none;"><i class="Hui-iconfont">&#xe632;</i> 添加子节点</a>
                                  <a id="btnDel" onclick="delNode()" class="btn btn-danger radius"
                                     style="display: none;"><i class="Hui-iconfont">&#xe6e2;</i> 删除节点</a>
                                  <a id="btnSave" onclick="saveNode()" class="btn btn-success radius"
                                     style="display: none;"><i class="Hui-iconfont">&#xe632;</i> 保存节点</a> </span>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </table>
</div>
<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
<script src="__PUBLIC__/static/plugins/bootstrap-treeview/js/bootstrap-treeview.js"></script>

<script type="text/javascript">

    var height = $(window).height() - 40;
    $('#treeDiv').css("height", height - 40);


    var selectedPrjId = 0;
    var currentNodeId = 0;
    var nodeCreator = '';

    //设置项目下拉框选择事件，初始化节点
    $('#prjName').change(function () {
        selectedPrjId = $(this).children('option:selected').val();
        if (selectedPrjId == 0) {
            return
        }
        initNodeTree(selectedPrjId);
        $("#btnAdd").hide(500);
        $("#btnDel").hide(500);
        $("#btnSave").hide(500);
        $("#nodName").val('');
        $("#remark").val('');
    });

    //保存节点
    function saveNode() {
        var nodeName = $('#nodName').val().trim();
        if (nodeName.length <= 0) {
            layer.msg("请填写节点名称！", function () {
            });
            return;
        }
        var remark = $('#remark').val().trim();
        var usrData = {
            'nodeId': currentNodeId,
            'nodeName': nodeName,
            'remark': remark
        };
        $.ajax({
            data: usrData,
            url: "__TestCaseURL__/node_management/savePrjNode",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    initNodeTree(selectedPrjId);
                    layer.msg(data.info, {icon: 1, time: 1000});
                    $("#btnDel").hide();
                    $("#btnSave").hide();
                    $("#remark").val('');
                    $("#nodName").val('');
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    //保存节点
    function addNode() {
        var nodeName = $('#nodName').val().trim();
        if (nodeName.length <= 0) {
            layer.msg("请填写节点名称！", function () {
            });
            return;
        }
        var remark = $('#remark').val().trim();
        var usrData = {
            'prjId': selectedPrjId,
            'nodeName': nodeName,
            'remark': remark,
            'creator': '<?php echo $realName; ?>'
        };
        $.ajax({
            data: usrData,
            url: "__TestCaseURL__/node_management/addPrjNode",
            type: "post",
            success: function (data) {
                if (data.status == 1) {
                    initNodeTree(selectedPrjId);
                    $("#nodName").val('');
                    $("#remark").val('');
                } else {
                    layer.msg(data.info, function () {
                    });
                }

            }
        });
    }

    //删除节点
    function delNode() {
        layer.confirm('节点删除须谨慎，确认要删除吗？', function (index) {
            var usrData = {
                'id': currentNodeId
            };
            $.ajax({
                data: usrData,
                url: "__TestCaseURL__/node_management/deletePrjNode",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        initNodeTree(selectedPrjId);
                        layer.msg(data.info, {icon: 1, time: 1000});
                        $("#btnDel").hide();
                        $("#btnSave").hide();
                        $("#remark").val('');
                        $("#nodName").val('');
                    } else {
                        layer.msg(data.info, function () {
                        });
                    }
                }
            });
        });
    }

    //初始化节点内容
    function initNodeTree(selectedPrjId) {
        $.ajax({
            data: {'prjId': selectedPrjId},
            url: "__TestCaseURL__/node_management/getPrjNode",
            type: "post",
            success: function (data) {
                var selectedPrjName = $('#prjName').children('option:selected').text();
                $('#nodeTreeView').treeview({
                    color: "#428bca",
                    nodeIcon: 'Hui-iconfont Hui-iconfont-file',
                    collapseIcon: 'Hui-iconfont Hui-iconfont-arrow2-bottom',
                    expandIcon: 'Hui-iconfont Hui-iconfont-arrow2-right',
                    //showTags: true,
                    data: [{text: selectedPrjName, id: 0, nodes: $.parseJSON(data)}],
                    onNodeSelected: function (event, node) {
                        currentNodeId = node.id;
                        nodeCreator = node.creator;
                        if (currentNodeId != '0') {
                            $("#btnDel").show(500);
                            $("#btnAdd").hide(500);
                            $("#btnSave").show(500);
                            getNodeInfo(currentNodeId);
                        } else {
                            $("#btnAdd").show(500);
                            $("#btnSave").hide(500);
                            $("#btnDel").hide(500);
                            $("#nodName").val('');
                            $("#remark").val('');
                            $("#nodName").focus();
                        }
                    }
                });
            }
        });
    }

    //获得单个节点的信息
    function getNodeInfo(nodeId) {
        $.ajax({
            data: {'nodeId': nodeId},
            url: "__TestCaseURL__/node_management/getNodeInfo",
            type: "post",
            success: function (data) {
                var nodeInfo = $.parseJSON(data);
                $('#nodName').val(nodeInfo['nodeName']);
                $('#remark').val(nodeInfo['remark']);
            }
        });
    }
</script>
</body>
</html>