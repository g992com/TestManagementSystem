//显示用例添加页面
function showAddForm() {
	$('#toolbar').hide(300);
	$('#divtb').hide(300);
	$('#divform').show();
	$('#tcName').focus();
	$('#addButton').show();
	$('#editButton').hide();
	$('#runButton').hide();
}

//关闭用例编辑页面
function closeForm() {
	$('#toolbar').show(300);
	$('#divtb').show();
	$('#divform').hide(300);
}

//显示用例编辑页面
var currentTCId = 0

function showEditForm() {
	var id = $.map($table.bootstrapTable('getSelections'), function(row) {
		return row.id;
	});
	if((id == 0) || (id == null)) {
		layer.msg("请勾选需要编辑的用例！", function() {});
	} else {
		currentTCId = id.toString();
		$('#toolbar').hide(300);
		$('#divtb').hide(300);
		$('#divform').show();
		$('#addButton').hide();
		$('#runButton').hide();
		$('#editButton').show();
		var usrData = {
			'tcId': currentTCId,
			'nodeId': currentNodeId
		};
		$.ajax({
			data: usrData,
			url: APP_URL + "/testcase_management/getTestCaseInfo",
			type: "post",
			success: function(data) {
				var tcData = $.parseJSON(data);
				$('#tcName').val(tcData['tc_name']);
				$('#perDescript').val(tcData['per_descript']);
				$('#stepDescript').val(tcData['step_descript']);
				$('#expectDescript').val(tcData['expect_descript']);
				$('#dataDescript').val(tcData['data_descript']);
			}
		});
	}
}

//显示执行用例页面
function runForm() {
	var id = $.map($table.bootstrapTable('getSelections'), function(row) {
		return row.id;
	});
	if((id == 0) || (id == null)) {
		layer.msg("请勾选需要执行的用例！", function() {});
	} else {
		currentTCId = id.toString();
		$('#toolbar').hide(300);
		$('#divtb').hide(300);
		$('#divform').show();
		$('#addButton').hide();
		$('#editButton').hide();
		$('#runButton').show();
		loadTCInfo4Runing();
	}
}

//加载测试用例信息(为用例执行提供的方法)
var upTCId = 0;
var nextTCId = 0;

function loadTCInfo4Runing() {
	var usrData = {
		'tcId': currentTCId,
		'nodeId': currentNodeId
	};
	$.ajax({
		data: usrData,
		url: APP_URL + "/testcase_management/getTestCaseInfo",
		type: "post",
		success: function(data) {
			var tcData = $.parseJSON(data);
			$('#tcName').val(tcData['tc_name']);
			$('#perDescript').val(tcData['per_descript']);
			$('#stepDescript').val(tcData['step_descript']);
			$('#expectDescript').val(tcData['expect_descript']);
			$('#dataDescript').val(tcData['data_descript']);
			$('#passButton').show();
			$('#failButton').show();
			upTCId = tcData['upTCId'];
			nextTCId = tcData['nextTCId'];
			if(tcData['test_result'] == '1') {
				$('#failButton').hide();
			}
			if(tcData['test_result'] == '2') {
				$('#passButton').hide();
			}
		}
	});
}

//获得用例表格数据
function getTableData(currentNodeId) {
	$table = $('#table').bootstrapTable("destroy").bootstrapTable({
		url: APP_URL + '/testcase_management/getTestCase?nodeId=' + currentNodeId,
		method: 'get',
		cache: false,
		height: document.body.clientHeight - 140,
		striped: true,
		pagination: true,
		singleSelect: true,
		pageSize: 20,
		pageNumber: 1,
		pageList: [20, 40, 80, 120, 'All'],
		search: false,
		sidePagination: 'server', //设置为服务器端分页
		clickToSelect: true,
		columns: [{
			checkbox: true,
			align: 'center',
			width: 5
		}, {
			field: 'id',
			title: '用例ID',
			width: 70
		}, {
			field: 'tc_name',
			title: '用例名称'
		}, {
			field: 'review_status',
			title: '评审状态',
			align: 'center',
			width: 80,
			formatter: showStatus,
			visible: false
		}, {
			field: 'creator_name',
			align: 'center',
			title: '创建人',
			width: 80
		}, {
			field: 'operator_name',
			align: 'center',
			title: '执行人',
			width: 80
		},{
			field: 'create_date',
			title: '创建时间',
			align: 'center',
			width: 160
		}, {
			field: 'test_result',
			title: '测试结果',
			align: 'center',
			formatter: showResult,
			width: 80
		}]
	});
}

//显示用例评审状态
function showStatus(value, row, index) {
	if(row.review_status == 0) {
		return '<a style="color:red;text-decoration:none">待评审</a>';
	} else if(row.review_status == 2) {
		return '<a style="color:green;text-decoration:none">已评审</a>';
	}
}

//显示用例评审状态
function showResult(value, row, index) {
	if(row.test_result == 0) {
		return '<a style="color:#996600;text-decoration:none">未测试</a>';
	} else if(row.test_result == 1) {
		return '<a style="color:red;text-decoration:none">测试失败</a>';
	} else if(row.test_result == 2) {
		return '<a style="color:green;text-decoration:none">测试通过</a>';
	}
}

//添加用例
function save(isClose) {
	//如果没有选中节点则不能保存用例
	if(selectedPrjId == 0 || currentNodeId == 0) {
		layer.msg("请先选择项目节点！", function() {});
		return;
	}

	//检查用例填写的完整性
	if(false == checkInput()) {
		return;
	}
	var tcName = $('#tcName').val();
	var perDescript = $('#perDescript').val();
	var stepDescript = $('#stepDescript').val();
	var expectDescript = $('#expectDescript').val();
	var dataDescript = $('#dataDescript').val();
	var usrData = {
		'prjId': selectedPrjId,
		'nodeId': currentNodeId,
		'creator': realName,
		'tcName': tcName,
		'perDescript': perDescript,
		'stepDescript': stepDescript,
		'expectDescript': expectDescript,
		'dataDescript': dataDescript
	};
	$.ajax({
		data: usrData,
		url: APP_URL + "/testcase_management/addTestCase",
		type: "post",
		success: function(data) {
			if(data.status == 1) {
				layer.msg(data.info, {
					icon: 1,
					time: 1000
				});
				refreshTableData();
				if(1 == isClose) {
					closeForm();
				}
				clearTCForm();
			} else {
				layer.msg(data.info, function() {});
			}
		}
	});
}

//保存编辑
function saveEdit() {
	//检查用例填写的完整性
	if(false == checkInput()) {
		return;
	}
	var tcName = $('#tcName').val();
	var perDescript = $('#perDescript').val();
	var stepDescript = $('#stepDescript').val();
	var expectDescript = $('#expectDescript').val();
	var dataDescript = $('#dataDescript').val();
	var usrData = {
		'tcId': currentTCId,
		'tcName': tcName,
		'perDescript': perDescript,
		'stepDescript': stepDescript,
		'expectDescript': expectDescript,
		'dataDescript': dataDescript
	};
	$.ajax({
		data: usrData,
		url: APP_URL + "/testcase_management/editTestCase",
		type: "post",
		success: function(data) {
			if(data.status == 1) {
				layer.msg(data.info, {
					icon: 1,
					time: 1000
				});
				refreshTableData();
				closeForm();
				clearTCForm();
			} else {
				layer.msg(data.info, function() {});
			}
		}
	});
}

//删除用例
function deleteTC() {
	var creator = '';
	var id = $.map($table.bootstrapTable('getSelections'), function(row) {
		creator = row.creator_name;
		return row.id;
	});
	if((id == 0) || (id == null)) {
		layer.msg("请勾选需要删除的用例！", function() {});
		return;
	}
	if(creator != realName) {
		layer.msg("只允许创建人和管理员有权限作删除操作！", function() {});
		return;
	}
	layer.confirm('用例删除须谨慎，确认要删除吗？', function(index) {
		var usrData = {
			'tcId': id.toString()
		};
		$.ajax({
			data: usrData,
			url: APP_URL + "/testcase_management/deleteTestCase",
			type: "post",
			success: function(data) {
				if(data.status == 1) {
					refreshTableData();
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

//执行用例
function runResult(flag) {
	var usrData = {
		'tcId': currentTCId,
		'resultFlag': flag
	};
	$.ajax({
		data: usrData,
		url: APP_URL + "/testcase_management/runTestCase",
		type: "post",
		success: function(data) {
			if(data.status == 1) {
				refreshTableData();
				layer.msg('已完成用例执行。', {
					icon: 1,
					time: 1000
				});

			} else {
				layer.msg(data.info, function() {});
			}
		}
	});
}

//上一条用例
function tcUp() {
	if(upTCId == null || upTCId == 'null' || upTCId == '') {
		layer.msg("已经到顶了！", function() {});
		$('#upButton').hide(500);
	} else {
		currentTCId = upTCId;
		loadTCInfo4Runing();
	}
}

//下一条用例
function tcNext() {
	if(nextTCId == null || nextTCId == 'null' || nextTCId == '') {
		layer.msg("已经到底了！", function() {});
		$('#nextButton').hide(500);
	} else {
		currentTCId = nextTCId;
		loadTCInfo4Runing();
	}
}

//清空测试用例表单控件文本
function clearTCForm() {
	$('#tcName').val('');
	$('#perDescript').val('');
	$('#stepDescript').val('');
	$('#expectDescript').val('');
	$('#dataDescript').val('');
}

//检查用例填写的完整性
function checkInput() {
	var tcName = $('#tcName').val();
	if(tcName.length <= 0) {
		layer.msg("请填写用例名称！", function() {});
		return false;
	}
	var stepDescript = $('#stepDescript').val();
	if(stepDescript.length <= 0) {
		layer.msg("请填写操作步骤！", function() {});
		return false;
	}
	var expectDescript = $('#expectDescript').val();
	if(expectDescript.length <= 0) {
		layer.msg("请填写预期结果！", function() {});
		return false;
	}
	return true;
}

//分享用例表格数据
function shareTCData(){
	$.ajax({
		data: {
			'prjId': selectedPrjId,
			'nodeId': currentNodeId,
			'creator': realName,
			'serverIp': serverIp,
			'prefixURL': APP_URL,
		},
		url: APP_URL + "/testcase_management/createTableShareInfo",
		type: "post",
		success: function(data) {
			if(data.status == 1) {
				layer.msg(data.info, {
					icon: 1,
					time: 3000
				});
			}else{
				layer.msg(data.info, function() {});
			}
		}
	});
}

//清空表格数据
function clearTableData() {
	$('#toolbar').hide(500);
	$table.bootstrapTable("removeAll");
}

//刷新表格数据
function refreshTableData() {
	$table.bootstrapTable('refresh');
}

//导出用例到excel表文件
function exportTCData(){
	top.window.location = APP_URL + "/testcase_management/exportTCData?nodeId=" + currentNodeId;
}
