<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:96:"D:\phpStudy\TestManagementSystem\htdocs/application/testcase\view\testcase_management\index.html";i:1532934686;}*/ ?>
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
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/plugins/gooflow0.8/css/GooFlow2.css" />
		<!--<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/plugins/gooflow0.8/css/default.css"/>-->
		<!--[if IE 6]>
    			<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    			<script>DD_belatedPNG.fix('*');</script>
  		<![endif]-->
		<title>
			用例管理
		</title>
	</head>

	<body>
		<div class="page-container">
			<table>
				<tr>
					<td width="220" class="va-t" id="tdTree">
						<select class="select" id="prjName" name="prjName" style="height: 33px">
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
					<td class="va-t" id="areaTD">
						<form class="form form-horizontal">
							<div id="tab-system" class="HuiTab">
								<div class="tabBar cl">
									<span id='tab1'>
										<a class="btn btn-danger radius" data-toggle="tooltip"  data-placement="right" title="左侧面板(显示/隐藏)" href="javascript:;" onclick="switchTreePanel()">
                        						<i class="Hui-iconfont" id="swtchTxt">&#xe67d;</i>
                    						</a> 导图用例</span>
									<span> 冒烟用例</span>
								</div>
								<div class="tabCon">
									<iframe id="iFrame1" name="iFrame1" src="" width='100%' onload="this.height=$(window).height()-55" frameborder="0"></iframe>
								</div>
								<div class="tabCon" >
									<div class="cl pd-5 bg-1 bk-gray" id="toolbar" style="display: none;" >
										<span class="l">
                    							<a class="btn btn-primary radius" href="javascript:;" onclick="showAddForm()">
                        						<i class="Hui-iconfont">&#xe600;</i> 新增用例</a>
                        						<a class="btn btn-warning radius" href="javascript:;" onclick="showEditForm()">
                        							<i class="Hui-iconfont">&#xe647;</i> 编辑用例</a>
                    							<a class="btn btn-danger radius" href="javascript:;" onclick="deleteTC()">
                        						<i class="Hui-iconfont">&#xe6e2;</i> 删除用例</a>
                        						<a class="btn btn-success radius" href="javascript:;" onclick="runForm()">
                        						<i class="Hui-iconfont">&#xe6a7;</i> 执行用例</a>
                        						<a class="btn btn-primary radius" href="javascript:;" onclick="shareTCData()" data-toggle="tooltip"  data-placement="right" title="必须冒烟用例通过后才能执行测试">
                        						<i class="Hui-iconfont">&#xe6aa;</i> 分享给研发人员作执行</a>
                        						<!--
                        						<a class="btn btn-warning radius" href="javascript:;" onclick="exportTCData()">
                        						<i class="Hui-iconfont">&#xe644;</i> 导出用例列表</a>
                        						-->
                							</span>
									</div>
									<div id="divtb">
										<table id="table"></table>
									</div>

									<div id="divform" style="display: none;">
										<form class="form form-horizontal" id="form-tc">
											<div class="row cl">
												<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>用例名称：</label>
												<div class="formControls col-xs-8 col-sm-9">
													<input type="text" id="tcName" name="tcName" placeholder="控制在30个字、60个字节以内" value="" class="input-text">
												</div>
											</div>
											<div class="row cl">
												<label class="form-label col-xs-4 col-sm-2">前提条件：</label>
												<div class="formControls col-xs-8 col-sm-9">
													<textarea id="perDescript" name="perDescript" class="textarea"></textarea>
												</div>
											</div>
											<div class="row cl">
												<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>操作步骤：</label>
												<div class="formControls col-xs-8 col-sm-9">
													<textarea id="stepDescript" name="stepDescript" class="textarea"></textarea>
												</div>
											</div>
											<div class="row cl">
												<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>预期结果：</label>
												<div class="formControls col-xs-8 col-sm-9">
													<textarea id="expectDescript" name="expectDescript" class="textarea"></textarea>
												</div>
											</div>
											<div class="row cl">
												<label class="form-label col-xs-4 col-sm-2">测试数据：</label>
												<div class="formControls col-xs-8 col-sm-9">
													<textarea id="dataDescript" name="dataDescript" class="textarea"></textarea>
												</div>
											</div>
										</form>
										<div class="row cl">
											<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2" align="right" id="addButton">
												<button onClick="save(0);" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并继续添加</button>
												<button onClick="save(1);" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并关闭</button>
												<button onClick="closeForm();" class="btn btn-warning radius" type="button"><i class="Hui-iconfont">&#xe678;</i> 返回</button>
											</div>
											<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2" align="right" style="display: none;" id="editButton">
												<button onClick="saveEdit();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
												<button onClick="closeForm();" class="btn btn-warning radius" type="button"><i class="Hui-iconfont">&#xe678;</i> 返回</button>
											</div>
											<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2" align="right" style="display: none;" id="runButton">
												<button id="failButton" onClick="runResult(1);" class="btn btn-danger radius" type="button"><i class="Hui-iconfont">&#xe6a6;</i> 执 行 失 败</button>
												<button id="passButton" onClick="runResult(2);" class="btn btn-success radius" type="button"><i class="Hui-iconfont">&#xe6a7;</i> 执 行 通 过</button>
												<button onClick="tcUp();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe679;</i> 上一条</button>
												<button onClick="tcNext();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe674;</i> 下一条</button>
												<button onClick="closeForm();" class="btn btn-warning radius" type="button"><i class="Hui-iconfont">&#xe678;</i> 返回</button>
											</div>
										</div>
									</div>
						</form>
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
			<script type="text/javascript" src="__PUBLIC__/static/plugins/gooflow0.8/js/data.js"></script>
			<script type="text/javascript" src="__PUBLIC__/static/plugins/gooflow0.8/js/GooFunc.js"></script>
			<script type="text/javascript" src="__PUBLIC__/static/plugins/gooflow0.8/js/GooFlow.js"></script>
			<script type="text/javascript" src="__PUBLIC__/static/plugins/content-menu/js/BootstrapMenu.min.js"></script>
			<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap.js"></script>

			<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
			<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
			<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/jquery-form.js"></script>
			<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
			<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/flow.js"></script>
			<script type="text/javascript" src="__PUBLIC__/js/tc_table.js"></script>

			<script type="text/javascript">
				var APP_URL = '__TestCaseURL__';
				var realName = '<?php echo $realName; ?>';
				var serverIp = '<?php echo \think\Config::get('SERVER_IP'); ?>';
			</script>
	</body>

</html>