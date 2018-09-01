var goolflow;
var flowData;

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
						shoaFlow(currentNodeId);
						$('#toolbar').show(500);
						$('#divtb').show();
						$('#divform').hide(500);
						getTableData(currentNodeId);
					} else {
						clearFlow(); //如果没有选择节点，则清空流程图区域数据
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

var isShow = true;
function switchTreePanel(){
	if(isShow){
		$('#swtchTxt').html('&#xe63d;');
		$('#tdTree').hide(300);
		isShow = false;
	}else{
		$('#swtchTxt').html('&#xe67d;');
		$('#tdTree').show(300);
		isShow = true;
	}
	
}

function shoaFlow(currentNodeId){
	
	 $('#iFrame1').attr('src',APP_URL + "/testcase_management/flow_page?nodeId="+currentNodeId);  
	//$('#iFrame1').attr('src',"http://127.0.0.1/tms/public/static/plugins/local-kitymind-master/index1.html");  
}
