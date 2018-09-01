<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\phpStudy\WWW/application/index\view\login\login.html";i:1516164348;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<!--[if lt IE 9]>
		<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
		<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
	<![endif]-->
	<link href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
	<link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
	<link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
	<!--[if IE 6]>
		<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
		<script>DD_belatedPNG.fix('*');</script>
	<![endif]-->
	<title><?php echo \think\Config::get('SITE_NAME'); ?> - 登录</title>
	<meta name="keywords" content="">
	<meta name="description" content="测试用例管理系统(TCMS)">
</head>
<body>
	<input type="hidden" id="TenantId" name="TenantId" value="" />
	<div class="header"><?php echo \think\Config::get('SITE_NAME'); ?> - 登录</div>
	<div class="loginWraper">
		<div id="loginform" class="loginBox">
			<form class="form form-horizontal">
				<div class="row cl">
					<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
					<div class="formControls col-xs-8">
						<input id="userName" type="text" placeholder="用户名" class="input-text size-L">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
					<div class="formControls col-xs-8">
						<input id="userPwd" type="password" placeholder="密码" class="input-text size-L">
					</div>
				</div>

				<div class="row cl">
					<div class="formControls col-xs-8 col-xs-offset-3">
						<label for="online">
							<input type="checkbox" id="rememberUser" value="">
						记住用户名</label>
					</div>
				</div>
				<div class="row cl">
					<div class="formControls col-xs-8 col-xs-offset-3" align="center">
						<input id="btnLogin" type="button" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="btnReset" type="reset" class="btn btn-default radius size-L" value="&nbsp;重&nbsp;&nbsp;&nbsp;&nbsp;置&nbsp;">
					</div>
				</div>
				<div class="row cl">
					<div class="formControls col-xs-8 col-xs-offset-3">
						<p id="msg" class="f-20 c-red" id="errorMsg"></p>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="footer"><?php echo \think\Config::get('COMPANY_NAME'); ?></div>
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js"></script> 
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/base64.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/login.js"></script>
	<script type="text/javascript">
		var APP_URL = '__APP__';
		var PUBLIC_URL = '__PUBLIC__';
	</script>
</body>
</html>