<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW/application/testcase\view\project_management\create_page.html";i:1520388536;}*/ ?>
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
<title>添加项目</title>
</head>
<body>
	<article class="page-container">
		<form class="form form-horizontal" id="form-prj-add">
			<input type="text" id="realName" name="realName" value="<?php echo $realName; ?>" style="display: none;" />
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>项目名称：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="" id="prjName" name="prjName">
				</div>
			</div>
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3">备注：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<textarea name="remark" id="remark" cols="" rows="" class="textarea"  placeholder="项目描述...最多输入200个字符" onKeyUp=""></textarea>

				</div>
			</div>
			<div class="row cl" align="right">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="Hui-iconfont">&#xe632;</i> 确 定</button>
					<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
				</div>
			</div>
		</form>
	</article>
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
			$("#prjName").focus();
			$('#remark').Huitextarealength({maxlength:200,exceed:false});//设置备注文本框最大输入字符串数量显示内容
			$("#form-prj-add").validate({
				rules:{
					prjName:{
						required:true,
					}
				},
				submitHandler:function(form){			
					submitInfo();
				}
			});
		});

		//提交form表单信息到后台
		function submitInfo() {
			var options = {
				url: '__TestCaseURL__/Project_Management/createPrj',
				type: 'POST',
				dataType: 'json',
				beforeSubmit: function() {
					var remarkSize = $("#remark").val().length;
					if(remarkSize > 200){
						layer.msg("项目描述内容不能超过200个字符！", function(){});
						return false;
					}
				},
				success: function(result) {
					if(result.status==1) {
						layer.msg(result.info, {
								icon: 1,
								time: 1000
							});
						setTimeout(function(){window.parent.location.reload(); },1000);
					} else {
						layer.msg(result.info,function(){});
					}
				}
			};
			$('#form-prj-add').ajaxSubmit(options);
		}
	</script>
</body>
</html>