<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW/application/testtool\view\test_tool_management\hosts.html";i:1532053358;}*/ ?>
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
			Hosts管理
		</title>
		</meta>
		</meta>
		</meta>
	</head>

	<body>
		<div class="page-container">
			<div class="cl pd-5 bg-1 bk-gray">
				<span class="l">
					<a style="color: red;font-size: 16px"> 提示：请配合switchHosts软件 V3.3以上版本使用。</a>
                    <a class="btn btn-primary radius" href="javascript:;" onclick="openCreatePage()">
                        <i class="Hui-iconfont">&#xe600;</i> 添加Host文本
                    </a>
                    <a class="btn btn-warning radius" href="javascript:;" onclick="openEditPage()">
                        <i class="Hui-iconfont">&#xe647;</i>
                        编辑Host文本
                    </a>
                    <a class="btn btn-danger radius" href="javascript:;" onclick="deleteHost()">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                        删除Host文本
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
			$(function() {
				var userId = "<?php echo $userID; ?>"
				init(userId);
			});

			//加载项目数据列表
			function init(userId) {
				$table = $('#table').bootstrapTable({
					url: '__TestToolURL__/test_tool_management/getHostsData',
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
						field: 'id',
						title: 'id',
						visible: false
					}, {
						checkbox: true,
						align: 'center',
						width: 5
					}, {
						field: 'host_name',
						title: 'Host名称',
                        width: 200
					}, {
						field: 'url',
						title: '请求URL（拷贝后，填入switchHosts软件的在线方案请求URL文本框内）',
					},{
                        field: 'operator',
                        title: '创建/修改人',
                        align: 'center',
                        width: 120
                    },{
                        field: 'operate_time',
                        title: '创建/修改时间',
                        align: 'center',
                        width: 145
                    },{
                        field: 'req_times',
                        title: '请求次数',
                        align: 'center',
                        width: 45
                    }]
				});
			}

            function openCreatePage() {
                var index = layer.open({
                    title: false,
                    type: 2,
                    content: '__TestToolURL__/test_tool_management/create_host_page',
                    area: ['600px', '450px']
                });
                layer.full(index);
            }

			function openEditPage() {
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					return row.id;
				});
				if((id == 0) || (id == null)) {
					layer.msg("请勾选需要编辑的Host！", function() {});
					return;
				}
                var index = layer.open({
                    title: false,
                    type: 2,
                    content: '__TestToolURL__/test_tool_management/edit_host_page?id='+id,
                    area: ['600px', '450px']
                });
                layer.full(index);
			}

			function deleteHost() {
				var creator = '';
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					creator = row.operator;
					return row.id;
				});
				if((id == 0) || (id == null)) {
					layer.msg("请勾选需要删除的Host！", function() {});
					return;
				}
				if(creator != '<?php echo $realName; ?>') {
					layer.msg("只允许创建人和管理员有权限作删除操作！", function() {});
					return;
				}

				layer.confirm('Host删除后无法再恢复，确认要删除吗？', function(index) {
					var usrData = {
						'id': id.toString()
					};
					$.ajax({
						data: usrData,
						url: "__TestToolURL__/test_tool_management/deleteHost",
						type: "post",
						success: function(data) {
							if(data.status == 1) {
								$table.bootstrapTable('refresh');
								layer.closeAll();
								layer.msg('已删除!', {
									icon: 1,
									time: 1000
								});
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