var goolflow;
var flowData;
//初始化流程图
function initGooFlow(jsondata) {
	var areaHeight = $(window).height() - 60;
	var areaWidth = $('#areaTD').height(areaHeight);
	var property = {
		width: $('#areaTD').width(),
		height: areaHeight,
		toolBtns: ["start round", "end round", "task round", "chat", "join", "fork"],
		haveHead: true,
		headBtns: ["save", "undo", "redo"], //如果haveHead=true，则定义HEAD区的按钮
		haveTool: true,
		haveGroup: true,
		useOperStack: true
	};
	var remark = {
		cursor: "选择指针",
		direct: "节点连线",
		start: "开始",
		end: "结束",
		task: "执行人",
		chat: "用例节点",
		fork: "用例分散",
		join: "用例汇总",
		group: "特别提示/划分区域"
	};

	goolflow = $.createGooFlow($("#goolflow"), property);
	goolflow.setNodeRemarks(remark);
	goolflow.loadData(jsondata);
	goolflow.onBtnSaveClick = function() {
		saveFlowData(goolflow.exportData(), 1);
	}
}
//页面加载时执行事件
$(function() {
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#tab-system").Huitab({
		index: 0
	});
	initGooFlow("{}");
	initMenu();
});

var selectedPrjId = 0;
var currentNodeId = 0;
var nodeCreator = '';
//设置项目下拉框选择事件，初始化节点
$('#prjName').change(function() {
	selectedPrjId = $(this).children('option:selected').val();
	if(selectedPrjId == 0) {
		return;
	}
	initNodeTree(selectedPrjId);
});

//初始化节点内容
function initNodeTree(selectedPrjId) {
	$.ajax({
		data: {
			'prjId': selectedPrjId
		},
		url: APP_URL + "/node_management/getPrjNode",
		type: "post",
		success: function(data) {
			var selectedPrjName = $('#prjName').children('option:selected').text();
			$('#nodeTreeView').treeview({
				color: "#428bca",
				nodeIcon: 'Hui-iconfont Hui-iconfont-file',
				collapseIcon: 'Hui-iconfont Hui-iconfont-arrow2-bottom',
				expandIcon: 'Hui-iconfont Hui-iconfont-arrow2-right',
				data: [{
					text: selectedPrjName,
					id: 0,
					nodes: $.parseJSON(data)
				}],
				onNodeSelected: function(event, node) {
					currentNodeId = node.id;
					nodeCreator = node.creator;
					if(currentNodeId != '0') {
						getFlowData(currentNodeId);
						$('#toolbar').show(500);
						$('#divtb').show();
						$('#divform').hide(500);
						getTableData(currentNodeId);
					} else {
						goolflow.clearData(); //如果没有选择节点，则清空流程图区域数据
						clearTableData();//如果没有选择节点，则清空表格内的数据
						$('#toolbar').hide(500);
						$('#divtb').hide(500);
						$('#divform').hide(500);
					}
				}
			});
		}
	});
}

//填充Flow数据
function getFlowData(nodeId) {
	$.ajax({
		data: {
			'nodeId': nodeId
		},
		url: APP_URL + "/testcase_management/getFlowData",
		type: "post",
		success: function(data) {
			if(data.length<=0){//如果查询出来的数据为空，则将data设置为空的json
				data="{}";
			}
			goolflow.destrory();
			initGooFlow($.parseJSON(data));
		}
	});
}

//保存当前节点的Flow数据
function saveFlowData(flowData, isTip) {
	if(currentNodeId == 0) {
		layer.msg("请先选择项目节点！", function() {});
		return;
	}
	$.ajax({
		data: {
			'nodeId': currentNodeId,
			'PrjId': selectedPrjId.toString(),
			'creator': realName,
			'json': JSON.stringify(flowData),
		},
		url: APP_URL + "/testcase_management/saveFlowData",
		type: "post",
		success: function(data) {
			if(isTip == 1) {
				layer.msg(data.info, {
					icon: 1,
					time: 1000
				});
			}
		}
	});
}

//分享导图
function shareFlowData(){
	if(currentNodeId == 0) {
		layer.msg("请先选择项目节点！", function() {});
		return;
	}
	$.ajax({
		data: {
			'nodeId': currentNodeId,
			'creator': realName,
			'serverIp': serverIp,
			'prefixURL': APP_URL,
		},
		url: APP_URL + "/testcase_management/createFlowShareInfo",
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

//初始化右键菜单
function initMenu() {
	var menu = new BootstrapMenu('#goolflow', {
		actions: [{
			name: '选择指针',
			iconClass: 'Hui-iconfont Hui-iconfont-arrow1-top',
			onClick: function() {
				goolflow.switchToolBtn('cursor');
			}
		}, {
			name: '节点连线',
			iconClass: 'Hui-iconfont Hui-iconfont-jiangjia',
			onClick: function() {
				goolflow.switchToolBtn('direct');
			}
		}, {
			name: '用例节点',
			iconClass: 'Hui-iconfont Hui-iconfont-new',
			onClick: function() {
				goolflow.switchToolBtn('chat');
			}
		}, {
			name: '特别提示/划分区域',
			iconClass: 'Hui-iconfont Hui-iconfont-comment',
			onClick: function() {
				goolflow.switchToolBtn('group');
			}
		}, {
			name: '保存导图',
			iconClass: 'Hui-iconfont Hui-iconfont-save',
			onClick: function() {
				saveFlowData(goolflow.exportData(), 1);
			}
		}, {
			name: '分享导图',
			iconClass: 'Hui-iconfont Hui-iconfont-share',
			onClick: function() {
				shareFlowData();
			}
		}]
	});
}

//键盘Esc键事件触发Flow的选择指针状态
$(document).keyup(function(event) {
	switch(event.keyCode) {
		case 27:
			goolflow.switchToolBtn('cursor');
		case 96:
			goolflow.switchToolBtn('cursor');
	}
});

//设置定时保存
var isEnterFlow = 0;
function setEnterFlag(flag) {
	isEnterFlow = flag;
}
var leftSec = 360;
setInterval(function() {
	if(currentNodeId != 0 && isEnterFlow == 1) {
		$('#tab1').text("导图模式[ " + leftSec + " 秒后自动保存]");
		if(leftSec < 1) {
			saveFlowData(goolflow.exportData(), 0);
			leftSec = 360;
			$('#tab1').text("导图模式[ 保存中... ]");
		}
		leftSec--;
	} else {
		$('#tab1').text("导图模式");
	}
}, 1000);