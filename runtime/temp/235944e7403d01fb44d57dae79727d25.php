<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\phpStudy\WWW/application/mindmap\view\map_management\index.html";i:1523323004;}*/ ?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="utf-8">
		<meta content="webkit|ie-comp|ie-stand" name="renderer">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />
		<meta content="no-siteapp" http-equiv="Cache-Control" />
		<!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
    <![endif]-->
		<link href="__PUBLIC__/favicon.ico" type="image/x-icon" rel="shortcut icon">
		<link href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/default/skin.css" id="skin" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap.min.css" rel="stylesheet">
		<link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap-table.css" rel="stylesheet">
		<!--[if IE 6]>
      <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
      <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
		<title>
			我的导图
		</title>
	</head>

	<body>
		<div class="page-container">
			<table>
				<tr>
					<td width="25%" class="va-t">
						<div class="cl pd-5 bg-1 bk-gray" >
							<span style="text-align: center;display:block;">
                    <a class="btn btn-primary radius" href="javascript:;" onclick="openAddDialog()" data-toggle="tooltip"  data-placement="right" title="添加导图名称" >
                        <i class="Hui-iconfont">&#xe600;</i> 添加
                    </a>
                    <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()" data-toggle="tooltip"  data-placement="right" title="修改导图名称">
                        <i class="Hui-iconfont">&#xe647;</i> 修改
                    </a>
                    <a class="btn btn-danger radius" href="javascript:;" onclick="deleteMap()" data-toggle="tooltip"  data-placement="right" title="删除导图名称">
                        <i class="Hui-iconfont">&#xe6e2;</i> 删除
                  
                    </a>
                </span>
						</div>
						<div id="nodeTreeView" style="font-size:12px;"></div>
					</td>
					<td class="va-t">
						<iframe id="iFrame1" name="iFrame1" src="" width='100%' onload="this.height=$(window).height()-55" frameborder="0"></iframe>
					</td>
				</tr>
			</table>
		</div>

		<div id="addDialog" style="display: none;">
			<table class="table table-bg">
				<tbody>
					<tr>
						<td><input type="text" style="width:300px" class="input-text" value="" placeholder="导图名称" id="mapName" name="mapName"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="editDialog" style="display: none;">
			<table class="table table-bg">
				<tbody>
					<tr>
						<td><input type="text" style="width:300px" class="input-text" value="" placeholder="导图名称" id="mapNameEdit" name="mapNameEdit"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript">
		</script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-treeview/js/bootstrap-treeview.js"></script>
		</script>
		<script type="text/javascript">
			var currentMapId = 0;
			var currentMapName = '';
			var nodeCreator = '';
			initNodeTree();

			//初始化节点内容
			function initNodeTree() {
				$.ajax({
					data: {
						'userId': "<?php echo $userID; ?>"
					},
					url: "__MindMapURL__/map_management/getMapNode",
					type: "post",
					success: function(data) {
						$('#nodeTreeView').treeview({
							color: "#428bca",
							collapseIcon: 'Hui-iconfont Hui-iconfont-arrow2-bottom',
							expandIcon: 'Hui-iconfont Hui-iconfont-arrow2-right',
							data: [{
								text: '我的导图',
								id: 0,
								nodes: $.parseJSON(data)
							}],
							onNodeSelected: function(event, node) {
								currentMapId = node.id;
								currentMapName = node.text;
								if(currentMapId != '0') {
									$('#iFrame1').attr('src',"__MindMapURL__/map_management/map_page?mapId="+currentMapId);  
								} else {
									$('#iFrame1').attr('src',"__MindMapURL__/map_management/tip_page");  
								}
							}
						});
					}
				});
			}

			function openAddDialog() {
				layer.open({
					title: '<i class="Hui-iconfont">&#xe600;</i> 添加导图名称',
					type: 1,
					area: ['316px', '160px'],
					shadeClose: true,
					content: $("#addDialog"),
					shift: 3,
					btn: ['确定', '取消'],
					yes: function(index) {
						var mapName = $("#mapName").val().trim();
						if(mapName.length == 0) {
							layer.msg("请填写导图名称！", function() {});
							return;
						}
						addMapName(mapName);
					},
					cancel: function() {
						layer.closeAll();
					}
				});
				$("#mapName").val('');
				$("#mapName").focus();
			}

			//添加导图名称
			function addMapName(mapName) {
				var usrData = {
					'mapName': mapName,
					'creatorName': "<?php echo $realName; ?>",
					'creatorId': "<?php echo $userID; ?>"
				};
				$.ajax({
					data: usrData,
					url: "__MindMapURL__/map_management/addMapName",
					type: "post",
					success: function(data) {
						if(data.status == 1) {
							initNodeTree();
							layer.closeAll();
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}

			//打开修改导图名称页面
			function openEditPage() {
				if(currentMapId == 0) {
					layer.msg("请选择需要修改的导图名称", function() {});
					return;
				} else {
					layer.open({
						title: '<i class="Hui-iconfont">&#xe647;</i> 修改导图名称',
						type: 1,
						area: ['316px', '160px'],
						shadeClose: true,
						content: $("#editDialog"),
						shift: 3,
						btn: ['确定', '取消'],
						yes: function(index) {
							var mapName = $("#mapNameEdit").val().trim();
							if(mapName.length == 0) {
								layer.msg("请填写导图名称！", function() {});
								return;
							}
							editMapName(mapName);
						},
						cancel: function() {
							layer.closeAll();
						}
					});
				}
				$("#mapNameEdit").val(currentMapName);
				$("#mapNameEdit").focus();
			}

			//编辑导图名称
			function editMapName(mapName) {
				var usrData = {
					'mapName': mapName,
					'mapId': currentMapId,
				};
				$.ajax({
					data: usrData,
					url: "__MindMapURL__/map_management/editMapName",
					type: "post",
					success: function(data) {
						if(data.status == 1) {
							initNodeTree();
							layer.closeAll();
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}

			//删除导图
			function deleteMap(){
				layer.confirm('导图删除须谨慎，确认要删除吗？', function(index) {
					var usrData = {
						'id': currentMapId
					};
					$.ajax({
						data: usrData,
						url: "__MindMapURL__/map_management/deleteMap",
						type: "post",
						success: function(data) {
							if(data.status == 1) {
								initNodeTree();
								layer.closeAll();
								layer.msg(data.info,{icon:1,time:1000});
							} else {
								layer.msg(data.info, function() {});
							}
						}
					});
				});
			}
		</script>
	</body>

</html>