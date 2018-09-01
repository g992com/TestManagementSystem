<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"D:\phpStudy\WWW/application/institutional\view\user_management\edit_pwd_page.html";i:1520262510;}*/ ?>
﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<link rel="Bookmark" href="/favicon.ico" >
	<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->
<title>修改用户登录密码</title>
</head>
<body>
	<div class="page-container">
			<form class="form form-horizontal" id="form-pwd-edit">
				<input type="text" id="id" name="id" value="<?php echo $userId; ?>" style="display: none;" />
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>登录名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" placeholder="" id="userName" name="userName" value="<?php echo $userName; ?>" readonly="readonly">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>原始密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" class="input-text" value="" placeholder="" id="oldPassword" name="oldPassword">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>新密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" class="input-text" value="" placeholder="" id="newPassword" name="newPassword">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>确认密码：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="password" class="input-text" value="" placeholder="" id="confirmPassword" name="confirmPassword">
					</div>
				</div>
				<div class="row cl" align="right">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button class="btn btn-success radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
						<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
			</form>
		</div>
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js"></script> 
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.min.js"></script> 
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
	<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/base64.js"></script>
	<script type="text/javascript" src="__PUBLIC__/js/jquery-form.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#form-pwd-edit").validate({
				rules: {
						oldPassword: {
							required: true
						},
						oldPassword: {
							required: true,
							minlength: 6
						},
						newPassword: {
							required: true,
							minlength: 6
						},
						confirmPassword: {
							required: true,
							minlength: 6,
							equalTo: "#newPassword"
						},
					},
				submitHandler:function(form){		
					submitInfo();
				}
			});
		});

		//提交form表单信息到后台
		function submitInfo() {
			var oldPwd = $('#oldPassword').val().trim();
			var newPwd = $('#newPassword').val().trim();
			
			var base64 = new Base64();
			var encOldPwd = base64.encode(oldPwd);
			var encNewPwd = base64.encode(newPwd);
			$('#oldPassword').val(encOldPwd);
			$('#newPassword').val(encNewPwd);
			$('#confirmPassword').val(encNewPwd); 
			var options= {
				url: '__InstitutionalURL__/User_Management/editUserPwd',
				type: 'POST',
				dataType: 'json',
				beforeSubmit: function() {
					
				},
				success: function(result) {
					if(result.status==1) {
						layer.msg(result.info, {
								icon: 1,
								time: 1000
							});
						setTimeout(function(){window.parent.location.reload(); },1000);
					} else {
						$('#oldPassword').val(oldPwd);
						$('#newPassword').val(newPwd);
						$('#confirmPassword').val(newPwd);
						layer.msg(result.info,function(){});
					}
				}
			};
			$('#form-pwd-edit').ajaxSubmit(options);
		}
	</script>
</body>
</html>