<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\phpStudy\WWW/application/institutional\view\user_management\index.html";i:1520385312;}*/ ?>
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
			用户管理
		</title>
		</meta>
		</meta>
		</meta>
	</head>
	<body>
		<div class="page-container">
			<div class="cl pd-5 bg-1 bk-gray">
				<span class="l">
                    <a class="btn btn-primary radius" href="javascript:;" onclick="userAdd('添加用户','__InstitutionalURL__/user_management/create_page')">
                        <i class="Hui-iconfont">&#xe600;</i> 添加用户
                    </a>
                    <a class="btn btn-success radius" href="javascript:;" onclick="openEditPage()">
                        <i class="Hui-iconfont">&#xe647;</i>
                        编辑用户
                    </a>
                     <a class="btn btn-danger radius" href="javascript:;" onclick="deleteUser()">
                        <i class="Hui-iconfont">&#xe6e2;</i>
                        删除用户
                    </a>
                    <a class="btn btn-warning radius" href="javascript:;" onclick="openPwdPage()">
                        <i class="Hui-iconfont">&#xe63f;</i>
                        修改登录密码
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
					url: '__InstitutionalURL__/user_management/getUserList',
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
						field: 'user_name',
						title: '登录名称'
					}, {
						field: 'real_name',
						align: 'center',
						title: '真实姓名'
					}, {
						field: 'email',
						title: '电子邮箱',
						align: 'center'
					}, {
						field: 'user_sex',
						align: 'center',
						title: '性别',
						formatter: showSex,
						width: 100
					}, {
						field: 'login_time',
						align: 'center',
						title: '上次登录时间'
					}, {
						field: 'loginCount',
						align: 'center',
						title: '登录次数'
					}]
				});
			}

			function userAdd(title, url) {
				var index = layer.open({
					type: 2,
					title: '<i class="Hui-iconfont">&#xe600;</i> '+title,
					content: url
				});
				layer.full(index);
			}

			//显示项目状态
			function showSex(value, row, index) {
				if(row.user_sex == 0) {
					return '<a style="color:green;text-decoration:none">男</a>';
				} else if(row.user_sex == 1) {
					return '<a style="color:red;text-decoration:none">女</a>';
				}
			}

			function openEditPage() {
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					return row.id;
				});
				if((id == 0) || (id == null)) {
					layer.msg("请勾选需要编辑的用户！", function() {});
					return;
				}
				var index = layer.open({
					type: 2,
					title: '<i class="Hui-iconfont">&#xe647;</i> 编辑用户',
					content: '__InstitutionalURL__/user_management/edit_page?userId=' + id
				});
				layer.full(index);
			}
			
			function openPwdPage() {
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					return row.id;
				});
				if((id == 0) || (id == null)) {
					layer.msg("请勾选需要修改密码的用户！", function() {});
					return;
				}
				var index = layer.open({
					type: 2,
					title: '<i class="Hui-iconfont">&#xe63f;</i> 编辑登录密码',
					content: '__InstitutionalURL__/user_management/edit_pwd_page?userId=' + id
				});
				layer.full(index);
			}

			function deleteUser() {
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					return row.id;
				});
				if((id == 0) || (id == null)) {
					layer.msg("请勾选需要删除的用户！", function() {});
					return;
				}
				layer.confirm('用户删除须谨慎，确认要删除吗？', function(index) {
					var usrData = {
						'userId': id.toString()
					};
					$.ajax({
						data: usrData,
						url: "__InstitutionalURL__/user_management/deleteUser",
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