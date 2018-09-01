<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\phpStudy\WWW/application/testcase\view\testcase_management\flow_page.html";i:1523526246;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>用例名称：<?php echo $nodeName; ?></title>

		<link href="__PUBLIC__/favicon.ico" type="image/x-icon" rel="shortcut icon">

		<!-- bower:css -->
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/bootstrap/dist/css/bootstrap.css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/hotbox/hotbox.css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/kityminder-core/dist/kityminder.core.css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/color-picker/dist/color-picker.min.css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/jquery-dialogBox/css/jquery.dialogbox.css" />
		<link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
		<!-- endbower -->

		<link rel="stylesheet" href="__PUBLIC__/static/plugins/local-kitymind-master/kityminder.editor.min.css">
		<style>
			html,
			body {
				margin: 0;
				padding: 0;
				height: 100%;
				overflow: hidden;
			}
			
			h1.editor-title {
				background: #C81623;
				color: white;
				margin: 0;
				height: 40px;
				font-size: 14px;
				line-height: 40px;
				font-family: 'Hiragino Sans GB', 'Arial', 'Microsoft Yahei';
				font-weight: normal;
				padding: 0 20px;
			}
			
			div.minder-editor-container {
				position: absolute;
				top: 40px;
				bottom: 0;
				left: 0;
				right: 0;
			}
		</style>
	</head>

	<body ng-app="kityminderDemo" ng-controller="MainController">
		<h1 class="editor-title"><a style="color: #fff; font-size: 16px;">用例名称：<?php echo $nodeName; ?></a></h1>
		<kityminder-editor on-init="initEditor(editor, minder)" data-theme="fresh-green"></kityminder-editor>
		<iframe name="frameFile" style="display:none;"></iframe>
		<div id="dialogBox"></div>
	</body>

	<!-- bower:js -->
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/jquery/dist/jquery.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/bootstrap/dist/js/bootstrap.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/angular/angular.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/lib/codemirror.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/xml/xml.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/javascript/javascript.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/css/css.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/markdown/markdown.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/addon/mode/overlay.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/codemirror/mode/gfm/gfm.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/angular-ui-codemirror/ui-codemirror.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/marked/lib/marked.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/kity/dist/kity.min.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/hotbox/hotbox.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/json-diff/json-diff.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/kityminder-core/dist/kityminder.core.min.js"></script>
	<script src="__PUBLIC__/static/plugins/local-kitymind-master/bower_components/color-picker/dist/color-picker.min.js"></script>
	<!-- endbower -->

	<script src="__PUBLIC__/static/plugins/local-kitymind-master/kityminder.editor.min.js"></script>
	<script src="__PUBLIC__/static/plugins/jquery-dialogBox/js/jquery.dialogBox.js"></script>
	<script type="text/javascript">
		var html = '';
		var editor;
		angular.module('kityminderDemo', ['kityminderEditor'])
			.controller('MainController', function($scope) {
				$scope.initEditor = function(editor, minder) {
					window.editor = editor;
					window.minder = minder;
				};
			});

		//添加头部按钮组
		html += '&nbsp;&nbsp;&nbsp;&nbsp;<button class="diy btn btn-danger radius refreshFlowData" data-type="json"><i class="Hui-iconfont">&#xe68f;</i> 刷新</button></div>';
		html += '<button class="diy btn btn-danger radius newWindow" data-type="json"><i class="Hui-iconfont">&#xe610;</i> 新窗口打开</button></div>';
		if("<?php echo $realName; ?>" == "<?php echo $creatorName; ?>") {
			html += '<button class="diy btn btn-danger radius shareFlowData" data-type="json"><i class="Hui-iconfont Hui-iconfont-share"></i> 分享用例</button></div>';
			html += '<div class="btn-group"><button class="btn btn-success saveFlowData" data-type="json"><i class="Hui-iconfont">&#xe632;</i> 保存</button>';
		}

		//html += '<button class="diy btn btn-danger save" data-type="json"><i class="Hui-iconfont">&#xe644;</i> 导入Json</button>',
		//html += '<button class="diy btn btn-danger save" data-type="json"><i class="Hui-iconfont">&#xe645;</i> 导出Json</button>',
		//html += '<div class="btn-group">',
		//html += '<button type="button" class="btn btn-danger saveFlowData"><i class="Hui-iconfont">&#xe632;</i> 保存</button>',
		//html += '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">',
		//html += '<span class="caret"></span>',
		//html += '<span class="sr-only">Toggle Dropdown</span>',
		//html += '</button>',
		//html += '<ul class="dropdown-menu">',
		//html += '<li class="exportFlowData"><a href="#"><i class="Hui-iconfont">&#xe644;</i> 导出Json</a></li>',
		//html += '<li role="separator" class="divider"></li>',
		//html += '<li><a href="#"><i class="Hui-iconfont ">&#xe645;</i> 导入Json</a></li>',
		//html += '</ul>',
		//html += '</div>',

		$('.editor-title').append(html);
		$(document).on('click', '.newWindow', function(event) {
			openNewWindow();
		});
		$(document).on('click', '.refreshFlowData', function(event) {
			refreshFlowData();
		});
		$(document).on('click', '.saveFlowData', function(event) {
			saveFlowData();
		});
		$(document).on('click', '.exportFlowData', function(event) {
			exportFlowData();
		});
		$(document).on('click', '.shareFlowData', function(event) {
			shareFlowData();
		});

		//初始化事件
		$(function() {
			refreshFlowData();

			$(window).keydown(function(e) {
				if(e.keyCode == 83 && e.ctrlKey) {
					e.preventDefault();
					saveFlowData();
				}
			});

		});

		//刷新Flow数据
		var st;

		function refreshFlowData() {
			$.ajax({
				data: {
					'nodeId': '<?php echo $nodeId; ?>'
				},
				url: "__TestCaseURL__/testcase_management/getFlowData",
				type: "post",
				success: function(data) {
					if(data.length <= 0) { //如果查询出来的数据为空，则将data设置为空的json
						data = "{}";
					}
					editor.minder.importData('json', data);
					showDialog('&#xe6a7;', '已完成数据加载！', 500)
				}
			});

			if("<?php echo $realName; ?>" == "<?php echo $creatorName; ?>") {
				$(".shareFlowData").show();
				$(".saveFlowData").show();
			} else {
				$(".shareFlowData").hide();
				$(".saveFlowData").hide();
			}
			$(".newWindow").show();
		}

		//保存Flow数据
		function saveFlowData() {
			editor.minder.exportData('json').then(function(data) {
				$.ajax({
					data: {
						'nodeId': '<?php echo $nodeId; ?>',
						'PrjId': '<?php echo $PrjId; ?>',
						'creator': '<?php echo $realName; ?>',
						'json': data,
					},
					url: "__TestCaseURL__/testcase_management/saveFlowData",
					type: "post",
					success: function(data) {
						showDialog('&#xe6a7;', data.info)
					}
				});
			});
		}

		//在新的窗口中打开Flow界面
		function openNewWindow() {
			$(".newWindow").hide();
			$(".saveFlowData").hide();
			$(".shareFlowData").hide();
			window.open("__TestCaseURL__/testcase_management/flow_page?nodeId=<?php echo $nodeId; ?>");
		}

		//分享Flow数据
		function shareFlowData() {
			$.ajax({
				data: {
					'nodeId': '<?php echo $nodeId; ?>',
					'creator': '<?php echo $realName; ?>',
					'serverIp': '<?php echo \think\Config::get('SERVER_IP'); ?>',
					'prefixURL': '__TestCaseURL__',
				},
				url: "__TestCaseURL__/testcase_management/createFlowShareInfo",
				type: "post",
				success: function(data) {
					if(data.status == 1) {
						showDialog('&#xe6a7;', data.info)
					} else {
						showDialog('&#xe6a6;', data.info)
					}

				}
			});
		}

		//显示提醒对话框
		function showDialog(code, info, time = 2000) {
			$('#dialogBox').dialogBox({
				autoHide: true,
				time: time,
				content: '<i class="Hui-iconfont" style="color:green">' + code + '</i> ' + info
			});
		}
	</script>

</html>