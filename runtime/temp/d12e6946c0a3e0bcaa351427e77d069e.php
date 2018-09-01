<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\phpStudy\WWW/application/schedule\view\plan_schedule_management\index.html";i:1521740290;}*/ ?>
﻿<!DOCTYPE HTML>
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
		<link href='__PUBLIC__/static/plugins/handsontable-master/dist/handsontable.full.css' rel='stylesheet' />
		<link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap-table.css" rel="stylesheet">
		<!--[if IE 6]>
            <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
            <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
		<title>
			排期规划
		</title>
		</meta>
		</meta>
		</meta>
	</head>

	<body>
		<div class="page-container">
			<div class="cl pd-5 bg-1 bk-gray">
				<table>
					<tr>
						<td>
							<span class="badge badge-danger radius" id="planNameDes">排期表名称：</span>
						</td>
						<td>
							<span class="r">
			                     <a class="btn btn-warning radius" href="javascript:;" onclick="showSelectPlanDialog()">
			                        <i class="Hui-iconfont">&#xe676;</i> 选择排期表
			                    </a>
			                    <a class="btn btn-primary radius" href="javascript:;" onclick='$("#addPlanDialog").modal("show")'>
                        				<i class="Hui-iconfont">&#xe600;</i> 添加排期表
                    				</a>
			                    <a class="btn btn-danger radius" href="javascript:;" onclick="deletePlan()">
			                        <i class="Hui-iconfont">&#xe6e2;</i>
			                        删除当前排期表
			                    </a>
			                    <a class="btn btn-warning radius" href="javascript:;" onclick="exportHot()" style="display: none;">
			                        <i class="Hui-iconfont">&#xe644;</i>
			                        导出排期表
			                    </a>
			                     <a class="btn btn-success radius" href="javascript:;" onclick="saveHot()">
			                        <i class="Hui-iconfont">&#xe632;</i>
			                        保存排期表
			                    </a>
                				</span>
						</td>
					</tr>
				</table>

			</div>
			<div id="addPlanDialog" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content radius">
						<div class="modal-header">
							<h3 class="modal-title"><i class="Hui-iconfont">&#xe600;</i> 新建排期表</h3>
							<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
						</div>
						<div class="modal-body">
							<form class="form form-horizontal">
								<div class="row cl">
									<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>排期表名称：</label>
									<div class="formControls col-xs-8 col-sm-9">
										<input type="text" id="planName" placeholder="控制在30个字、60个字节以内" class="input-text">
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn btn-success radius" onclick="addPlan()"><i class="Hui-iconfont">&#xe632;</i> 确定</button>
							<button class="btn btn-warning radius" data-dismiss="modal" aria-hidden="true"><i class="Hui-iconfont">&#xe6a6;</i> 关闭</button>
						</div>
					</div>
				</div>
			</div>
			<div id="hot"></div>
			<div id="selectDialog" style="display: none;">
				<table>
					<tr>
						<td>
							<span  style="text-align: center;display:block;">
			                     <a class="btn btn-warning radius" href="javascript:;" onclick="queryMyPlanSheet()">
			                                               自己的
			                    </a>
			                    <a class="btn btn-primary radius" href="javascript:;" onclick="queryAllPlanSheet()">
                        			 所有人的
                    			</a>
                			</span>
						</td>
					</tr>
					<tr>
						<td>
							<div id="table"></div>
						</td>
					</tr>
				</table>
			</div>

			<div id="selectTesterDialog" style="display: none;">
				<table border="0">
					<tr>
						<td width="150" style="padding-left:0.2cm;">
							<input type="text" id="searchInput" placeholder="按关键字搜索人员" class="input-text">
							<div id="table1"></div>
						</td>
						<td width="90" align="center">
							<a class="btn btn-success radius" href="javascript:;" onclick="addTester2Tb()"> <i class="Hui-iconfont">&#xe6d7;</i></a>
						</td>
						<td style="padding-right:0.2cm;">
							<div id="table2" data-unique-id="index"></div>
						</td>
					</tr>
				</table>
			</div>

		</div>
		</div>
		</div>
		</div>
		<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
		<script src='__PUBLIC__/static/plugins/handsontable-master/dist/handsontable1.full.js'></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>
		<script type="text/javascript">
			var planId = 0; //定义排期表Id，默认为0
			var planName = ''; //定义排期表名称，默认为空
			//var htdata = '';//定义表格数据装载变量，默认为空
			var emptyData = [
				['', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '']
			];

			//初始化页面数据
			$(function() {
				planId = "<?php echo $planId; ?>";
				if(planId == 0) {
					paintHot(emptyData);
				} else {
					getContentData("<?php echo $planId; ?>");
				}
				$('#planNameDes').text('排期表名称：<?php echo $planName; ?>');
				$('#searchInput').bind('input propertychange', function() {
					searchTester()
				});
			});

			//渲染计划表格
			var headers = [
				'优先级',
				'任务名称',
				'测试人员',
				'状态',
				'预计开始时间',
				'预计完成时间',
				'预计工期(天)',
				'实际开始时间',
				'实际完成时间',
				'实际工期(天)',
				'完成进度(%)',
				'工期偏差(天)',
				'项目经理',
				'产品经理',
				'研发人员',
				'备注'
			];

			function paintHot(redata) {
				var rowsCount = redata.length;
				$hot = Handsontable(document.getElementById('hot'), {
					data: redata,
					height: 856,
					colWidths: [65, 195, 125, 65, 100, 100, 80, 100, 100, 80, 105, 105, 100, 100, 100, 400],
					minCols: 16,
					minRows: 200,
					rowHeaders: true,
					colHeaders: headers,
					columnSorting: true,
					filters: true,
					dropdownMenu: true,
					contextMenu: true,
					autoRowSize: true,
					manualColumnMove: true,
					manualRowMove: true,
					fillHandle: {
						autoInsertRow: true,
					},
					contextMenu: {
						items: {
							"row_above": {
								name: '添加排期项',
								disabled: function() {
									//限制只能在第一行才能添加排期项
									var selectedRowIndex = $hot.getSelected()[0];
									if(selectedRowIndex != 0) {
										//return $hot.getSelected()[0] === selectedRowIndex;
									}
								}
							},
							"remove_row": {
								name: '删除排期项',
								disabled: function() {
									return $hot.getSelected()[0] === 0;

								}
							},
							"hsep1": "---------",
							"undo": {
								name: '撤销'
							},
							"redo": {
								name: '重做'
							},

						}
					},
					cells: function(row, column) {
						var cellMeta = {};
						if(row >= rowsCount) {
							return cellMeta;
						}

						if(column === 0) {
							cellMeta.type = 'dropdown';
							cellMeta.source = [
								'P0',
								'P1',
								'P2',
								'P3',
								'P4',
								'P5'
							];

						} else if(column === 3) {
							cellMeta.type = 'dropdown';
							cellMeta.source = [
								'新建',
								'接受',
								'拒绝',
								'进行中',
								'已完成',
							];

						} else if(column === 4 || column === 5 || column === 7 || column === 8) {
							cellMeta.type = 'date';
							cellMeta.dateFormat = 'YYYY-MM-DD';

						} else if(column === 10) {
							cellMeta.renderer = function(hotInstance, TD, row, col, prop, value, cellProperties) {
								var progressBar = document.createElement('progress');
								value = parseInt(value, 10);
								progressBar.max = 100;
								progressBar.value = isNaN(value) ? 0 : value;
								TD.textContent = '';
								TD.appendChild(progressBar);
							};
						}

						return cellMeta;
					},
					afterOnCellMouseDown: function(event, coords, td) {
						var row = coords.row;
						var col = coords.col;
						if(col == 6 || col == 9) { //如果鼠标点击工期列表
							var startDate = $hot.getDataAtCell(row, col - 2);
							var endDate = $hot.getDataAtCell(row, col - 1);
							if(startDate == '' || startDate == null || endDate == '' || endDate == null) {
								return;
							}
							var days = datedifference(startDate, endDate)
							$hot.setDataAtCell(row, col, days);
						} else if((col == 10)) {
							var status = $hot.getDataAtCell(row, col - 7);
							if(status == '已完成') {
								$hot.setDataAtCell(row, col, 100);
							}
						} else if((col == 11)) {
							var perWorkDays = $hot.getDataAtCell(row, col - 5);
							var WorkDays = $hot.getDataAtCell(row, col - 2);
							if(perWorkDays == '' || perWorkDays == null || WorkDays == '' || WorkDays == null) {
								return;
							}
							if(perWorkDays > WorkDays) {
								var days = perWorkDays - WorkDays;
								$hot.setDataAtCell(row, col, "节省" + days + "天");
							} else if(perWorkDays > WorkDays) {
								$hot.setDataAtCell(row, col, "按实际工期完成");
							} else if(perWorkDays < WorkDays) {
								var days = WorkDays - perWorkDays;
								$hot.setDataAtCell(row, col, "多用" + days + "天");
							}
						} else if(col == 2) {
							showSelectTesterDialog(row, col);
						}
					}
				});
			}

			//打开添加计划对话框
			function addPlan() {
				planName = $('#planName').val().trim();
				if(planName.length <= 0) {
					layer.msg("请填写排期表名称！", function() {});
					return;
				}
				$.ajax({
					url: "__ScheduleURL__/plan_schedule_management/addPlan",
					dataType: 'json',
					type: 'post',
					data: {
						'planName': planName,
						'creatorId': "<?php echo $userID; ?>",
						'creatorName': "<?php echo $realName; ?>"
					},
					success: function(data) {
						if(data.status >= 1) {
							$("#addPlanDialog").modal("hide");
							layer.msg(data.info, {
								icon: 1,
								time: 1000
							});
							planId = data.status;
							$('#planName').val('');
							$('#planNameDes').text("	排期表名称：" + planName);
							$hot.loadData(emptyData); //清空表格数据
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}
			
			//打开选择对话框
			var queryURL = '__ScheduleURL__/plan_schedule_management/getPlans?creatorId=<?php echo $userID; ?>'
			function queryMyPlanSheet(){
				queryURL = '__ScheduleURL__/plan_schedule_management/getPlans?creatorId=<?php echo $userID; ?>';
				initPlans();
			}
			function queryAllPlanSheet(){
				queryURL = '__ScheduleURL__/plan_schedule_management/getPlans?creatorId=0';
				initPlans();
			}
			function showSelectPlanDialog() {
				layer.open({
					title: '<i class="Hui-iconfont">&#xe681;</i> 选择排期表',
					type: 1,
					area: ['240px', '500px'],
					shadeClose: true,
					content: $("#selectDialog"),
					shift: 3,
					btn: ['确定', '取消'],
					yes: function(index) {
						refreshHotData();
						layer.closeAll();
					},
					cancel: function() {
						layer.closeAll();
					}
				});
				initPlans();
			}

			//初始化待选排期信息
			function initPlans() {
				$table = $('#table').bootstrapTable("destroy").bootstrapTable({
					url: queryURL,
					method: 'get',
					cache: false,
					height: 300,
					striped: true,
					singleSelect: true,
					search: false,
					clickToSelect: true,
					columns: [{
						checkbox: true,
						align: 'center',
						width: 5
					}, {
						field: 'id',
						title: 'id',
						visible: false
					}, {
						field: 'plan_name',
						title: '排期表名称'
					}, {
						field: 'creator_name',
						title: '创建人'
					}]
				});
			}

			//获得表格数据
			function getContentData(planId) {
				$.ajax({
					url: "__ScheduleURL__/plan_schedule_management/getPlanContent",
					dataType: 'json',
					type: 'post',
					async: true,
					data: {
						'planId': planId
					},
					success: function(data) {
						if(data == 'emptyData') {
							paintHot(emptyData);
						}else{
							paintHot(eval(data));
						}
					}
				});
			}

			//保存数据
			function saveHot() {
				if(planId == 0) {
					layer.msg("空排期表不能被保存！", function() {});
					return;
				}
				htdata = JSON.stringify($hot.getData());
				$.ajax({
					data: {
						'planId': planId,
						'htdata': htdata
					},
					url: "__ScheduleURL__/plan_schedule_management/saveHotData",
					type: "post",
					success: function(data) {
						if(data.status == 1) {
							layer.msg(data.info, {
								icon: 1,
								time: 1000
							});
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}

			//重新加载hot排期表数据
			function refreshHotData(planId) {
				var id = $.map($table.bootstrapTable('getSelections'), function(row) {
					return row.id;
				});
				window.location.href = "__ScheduleURL__/plan_schedule_management?planId=" + id;
			}

			//删除排期表
			function deletePlan() {
				if(planId == 0) {
					layer.msg("空排期表不能被删除！", function() {});
					return;
				}
				layer.confirm('排期表删除须谨慎，确认要删除吗？', function(index) {
					$.ajax({
						data: {
							'id': planId
						},
						url: "__ScheduleURL__/plan_schedule_management/delPlan",
						type: "post",
						success: function(data) {
							if(data.status == 1) {
								layer.msg('已删除!', {
									icon: 1,
									time: 1000
								});
								window.location.href = "__ScheduleURL__/plan_schedule_management?planId=0";
							} else {
								layer.msg(data.info, function() {});
							}
						}
					});
				});
			}

			function exportHot() {
				//var exportData = JSON.stringify($hot.getData());
				var data = [];
				data.push(headers);
				for(var i = 0; i < getRealDataRowNum() + 1; i++) {
					var exportData = JSON.stringify($hot.getDataAtRow(i));
					var arrParse = JSON.parse(exportData);
					//alert(arrParse);
					data.push(arrParse);

				}

				console.log(data);
				alert(data);
			}

			//获得表格中有效的行数，这里包括第0行，实际行数比返回至少1
			function getRealDataRowNum() {
				var firstCellData = '';
				var index = 0;
				for(var i = 0; i < 5000; i++) {
					var firstCellData = $hot.getDataAtCell(i, 0);
					if((firstCellData == '') || (firstCellData == 'null') || (firstCellData == null)) {
						break;
					}
					index = i;
				}
				return index;
			}

			function JSONToCSVConvertor(JSONData, colHeaders) {
				var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData,
					CSV = '',
					row = "",
					fileName = "handsontable.csv";

				// Put the header (based on the colHeaders of my table in my example)
				for(var index in colHeaders) {
					row += colHeaders[index] + ';';
				}
				row = row.slice(0, -1);
				CSV += row + '\r\n';

				// Adding each rows of the table
				for(var i = 0; i < arrData.length; i++) {
					var row = "";
					for(var index in arrData[i]) {
						row += arrData[i][index] + ';';
					}
					row = row.slice(0, -1);
					CSV += row + '\r\n';
				}

				if(CSV == '') {
					alert("Invalid data");
					return;
				}

				// Downloading the new generated csv.
				// For IE >= 9
				if(window.navigator.msSaveOrOpenBlob) {
					var fileData = [CSV];
					blobObject = new Blob(fileData);
					window.navigator.msSaveOrOpenBlob(blobObject, fileName);
				} else {
					// For Chome/Firefox/Opera
					var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);

					var link = document.createElement("a");
					link.href = uri;

					link.style = "visibility:hidden";
					link.download = fileName;

					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
				}
			}

			//计算两个日期的相隔天数
			function datedifference(sDate1, sDate2) { //sDate1和sDate2是2018-12-18格式  
				var dateSpan, tempDate, iDays;
				sDate1 = Date.parse(sDate1);
				sDate2 = Date.parse(sDate2);
				dateSpan = sDate2 - sDate1;
				iDays = Math.floor(dateSpan / (24 * 3600 * 1000));
				return iDays + 1;
			};

			//打开测试人员选择窗口
			function showSelectTesterDialog(row, col) {
				layer.open({
					title: '<i class="Hui-iconfont">&#xe611;</i> 添加测试人员',
					type: 1,
					area: ['450px', '550px'],
					shadeClose: true,
					content: $("#selectTesterDialog"),
					shift: 3,
					btn: ['确定', '取消'],
					yes: function(index) {

						var tableData = $table2.bootstrapTable('getData');
						var length = tableData.length;
						if(length == 0) {
							layer.msg("请添加人员到右侧列表中！", function() {});
							return;
						}
						var arrTester = new Array();
						for(var i = 0; i < length; i++) {
							arrTester.push(tableData[i]['real_name']);
						}

						$hot.setDataAtCell(row, col, arrTester.toString());
						layer.closeAll();
					},
					cancel: function() {
						layer.closeAll();
					}
				});

				showTesterTable('All');
				$table2 = $('#table2').bootstrapTable("destroy").bootstrapTable({
					cache: false,
					height: 370,
					striped: true,
					singleSelect: true,
					search: false,
					clickToSelect: true,
					columns: [{
						field: 'id',
						title: 'id',
						visible: false
					}, {
						field: 'real_name',
						title: '已选择人员'
					}, {
						field: 'do',
						title: '',
						width: 65,
						align: 'center',
						formatter: operate
					}]
				});
			}

			//操作
			function operate(value, row, index) {
				return '<a onclick="deleteItem(' + row.index + ')" class="btn btn-danger btn-ms"><i class="fa fa-trash-o"></i> 删除</a> ';
			}

			//删除购物车中的物品
			function deleteItem(index) {
				$('#table2').bootstrapTable('removeByUniqueId', index);
			}

			//将选择的人员添加到已选择表格中
			var index = 0;

			function addTester2Tb() {
				var data = $table1.bootstrapTable('getSelections');
				if(data == '') {
					layer.msg("请先选择人员！", function() {});
					return;
				}
				var insertRow = [];
				insertRow.push({
					index: index++,
					id: data[0]['id'],
					real_name: data[0]['real_name']
				});
				$('#table2').bootstrapTable('append', insertRow);
			}

			//显示测试人
			function showTesterTable(key) {
				$table1 = $('#table1').bootstrapTable("destroy").bootstrapTable({
					url: '__ScheduleURL__/plan_schedule_management/getTester?key=' + key,
					method: 'get',
					cache: false,
					height: 370,
					striped: true,
					singleSelect: true,
					search: false,
					clickToSelect: true,
					columns: [{
						checkbox: true,
						align: 'center',
						width: 5
					}, {
						field: 'id',
						title: 'id',
						visible: false
					}, {
						field: 'real_name',
						title: '待选择人员'
					}]
				});
			}

			//搜索测试人员
			function searchTester() {
				var schTxt = $('#searchInput').val().trim();
				if(schTxt.length > 0) {
					showTesterTable(schTxt);
				}
			}
		</script>
	</body>

</html>