<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"D:\phpStudy\WWW/application/note\view\note_management\index.html";i:1530524851;}*/ ?>
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
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/jquery-dialogBox/css/jquery.dialogbox.css" />
		<!--[if IE 6]>
      		<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
      		<script>DD_belatedPNG.fix('*');</script>
    		<![endif]-->
		<title>
			我的笔记
		</title>
	</head>

	<body>
		<div class="page-container">
			<table border="1" id="table1" style="table-layout: fixed;" bordercolor="#C0C0C0">
				<tr>
					<td width="220px">
						<table id="table2" height="100%" align="top" border="1" bordercolor="F0F8FF" style="table-layout: fixed;">
							<tr height="45%">
								<td style="vertical-align: top;" id="topTD">
									<div class="cl pd-5 bg-1 bk-gray">
										<span style="text-align: center;display:block;">
                   							 <a class="btn btn-primary radius" href="javascript:;" onclick="createNote()" data-toggle="tooltip"  data-placement="right" title="" >
                        							<i class="Hui-iconfont">&#xe600;</i> 新建笔记
                   							 </a>
						                </span>
									</div>
									<input type="text" class="input-text" value="" placeholder="搜索笔记" id="noteNameSearch" name="noteNameSearch">
									<div id="treeDiv" style="overflow:scroll;overflow-x:hidden">
										<div id="noteTreeView" style="font-size:12px;"></div>
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td style="vertical-align: top;">
						<div class="cl pd-5 bg-1 bk-gray">
							<table border="0">
								<tr>
									<td align="left">
										<input type="text" style="width:100%" class="input-text" value="" placeholder="笔记名称" id="noteName" name="noteName">
									</td>
									<td align="right" width="170px">
										<a class="btn btn-danger radius" href="javascript:;" onclick="deleteNoteBook()" data-toggle="tooltip" data-placement="right" title="删除笔记本">
											<i class="Hui-iconfont">&#xe6e2;</i> 删除
										</a>
										<a class="btn btn-success radius" href="javascript:;" onclick="saveNoteBook()" data-toggle="tooltip" data-placement="right" title="">
											<i class="Hui-iconfont">&#xe6a7;</i> 保存
										</a>
									</td>
								</tr>
							</table>
						</div>
						<textarea id="textArea" cols="20" rows="2" class="ckeditor"></textarea>
					</td>
				</tr>
			</table>
		</div>
		<div id="dialogBox"></div>
		<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-treeview/js/bootstrap-treeview.js"></script>
		<script src="__PUBLIC__/static/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/plugins/jquery-dialogBox/js/jquery.dialogBox.js" type="text/javascript"></script>
		<script type="text/javascript">
			var currentNoteBookId = 0;
			var currentNoteBookName = '';
			var editorHeight = $(window).height() - 40;
			$('#table1').css("height", editorHeight);
			$('#table2').css("height", editorHeight - 5);
			var h = $('#topTD').height();
			$('#treeDiv').css("height", h - 70);
			initNoteTree();

			//创建笔记
			function createNote() {
				var usrData = {
					'noteBookName': '无标题笔记',
					'creatorName': "<?php echo $realName; ?>",
					'creatorId': "<?php echo $userID; ?>"
				};
				$.ajax({
					data: usrData,
					url: "__NoteURL__/note_management/addNoteBookName",
					type: "post",
					success: function(data) {
						if(data.status == 1) {
							initNoteTree();
							var nodeObj = getNoteFirstNode();
							$('#noteName').val(nodeObj.note_book_name);
							$('#noteName').focus();
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}

			//获取最新一条日记节点对象信息
			function getNoteFirstNode() {
				var obj = null;
				$.ajax({
					data: {
						creatorId: "<?php echo $userID; ?>"
					},
					url: "__NoteURL__/note_management/getNoteFirstNode",
					type: "post",
					async: false,
					success: function(data) {
						obj = eval('(' + data.info + ')');
					}
				});
				return obj;
			}

			function saveNoteBook() {
				var noteTile = $("#noteName").val().trim();
				if(noteTile.length == 0) {
					layer.msg("请填写笔记名称！", function() {});
					return;
				}
				var noeteContent = $ckeditor.getData();
				var usrData = {
					'noteTile': noteTile,
					'noeteContent': noeteContent,
					'currentNoteBookId': currentNoteBookId
				};
				$.ajax({
					data: usrData,
					url: "__NoteURL__/note_management/saveNoteBook",
					type: "post",
					success: function(data) {
						if(data.status == 1) {
							showDialog('&#xe6a7;', data.info)
							initNoteTree();
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}

			//打开添加笔记本对话框
			function openNoteBookAddDialog() {
				layer.open({
					title: '<i class="Hui-iconfont">&#xe600;</i> 新建笔记',
					type: 1,
					area: ['316px', '160px'],
					shadeClose: true,
					content: $("#addNoteBookDialog"),
					shift: 3,
					btn: ['确定', '取消'],
					yes: function(index) {
						var noteBookName = $("#noteBookName").val().trim();
						if(noteBookName.length == 0) {
							layer.msg("请填写笔记本名称！", function() {});
							return;
						}
						addNoteBookName(noteBookName);

					},
					cancel: function() {
						layer.closeAll();
					}
				});
				$("#noteName").val('');
				$("#noteName").focus();
			}

			//删除笔记本
			function deleteNoteBook() {
				layer.confirm('笔记删除须谨慎，确认要删除吗？', function(index) {
					var usrData = {
						'id': currentNoteBookId
					};
					$.ajax({
						data: usrData,
						url: "__NoteURL__/note_management/deleteNoteBook",
						type: "post",
						success: function(data) {
							if(data.status == 1) {
								initNoteTree();
								layer.closeAll();
								layer.msg(data.info, {
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

			//初始化笔记本节点
			function initNoteTree() {
				$.ajax({
					data: {
						'userId': "<?php echo $userID; ?>"
					},
					url: "__NoteURL__/note_management/getNoteBookNode",
					type: "post",
					success: function(data) {
						$('#noteTreeView').treeview({
							color: "#428bca",
							collapseIcon: 'Hui-iconfont Hui-iconfont-arrow2-bottom',
							expandIcon: 'Hui-iconfont Hui-iconfont-arrow2-right',
							data: [{
								text: '我的笔记本',
								id: 0,
								nodes: $.parseJSON(data)
							}],
							onNodeSelected: function(event, node) {
								currentNoteBookId = node.id;
								currentNoteBookName = node.text;
								$('#noteName').val(currentNoteBookName);
								showNoteContent(currentNoteBookId);
							}
						});
						$('#noteTreeView').treeview('selectNode', 1);
					}
				});

			}

			//显示笔记内容到富文本框中
			function showNoteContent(currentNoteBookId) {
				var usrData = {
					'noteBookId': currentNoteBookId
				};
				$.ajax({
					data: usrData,
					url: "__NoteURL__/note_management/getNoteContent",
					type: "post",
					success: function(data) {
						$ckeditor.setData(data);
					}
				});
			}

			//初始化富文本编辑器
			$(function() {
				$(window).keydown(function(e) {
					if(e.keyCode == 83 && e.ctrlKey) {
						e.preventDefault();
						saveNoteBook();
					}
				});

				$ckeditor = CKEDITOR.replace('textArea', {
					toolbar: [
						['Font', 'FontSize'],
						['Bold', 'Italic', 'Underline', 'Strike'],
						['TextColor', 'BGColor'],
						['Undo', 'Redo'],
						['NumberedList', 'BulletedList'],
						['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
						['Link', 'Unlink'],
						['Table', 'Maximize']
					],
					height: editorHeight - 110,
					//language: "zh-cn",
				});

				$('#noteNameSearch').keyup(function(event) {
					searchNote();
				});
			});

			//搜索笔记本
			function searchNote() {
				$('#noteName').val('');
				$ckeditor.setData('');
				var searchText = $('#noteNameSearch').val().trim();
				if(searchText.length == 0) {
					initNoteTree();
				} else {
					$.ajax({
						data: {
							'userId': "<?php echo $userID; ?>",
							'searchText': searchText
						},
						url: "__NoteURL__/note_management/searchNoteByText",
						type: "post",
						success: function(data) {
							$('#noteTreeView').treeview({
								color: "#428bca",
								collapseIcon: 'Hui-iconfont Hui-iconfont-arrow2-bottom',
								expandIcon: 'Hui-iconfont Hui-iconfont-arrow2-right',
								data: [{
									text: '我的笔记本',
									id: 0,
									nodes: $.parseJSON(data)
								}],
								onNodeSelected: function(event, node) {
									currentNoteBookId = node.id;
									currentNoteBookName = node.text;
									$('#noteName').val(currentNoteBookName);
									showNoteContent(currentNoteBookId);
								}
							});
							$('#noteTreeView').treeview('selectNode', 1);
						}
					});
				}
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
	</body>

</html>