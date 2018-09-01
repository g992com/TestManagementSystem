<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:101:"D:\phpStudy\TestManagementSystem\htdocs/application/schedule\view\team_schedule_management\index.html";i:1518510124;}*/ ?>
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
		<link href='__PUBLIC__/static/plugins/fullcalendar-3.8.2/fullcalendar.min.css' rel='stylesheet' />
		<link href='__PUBLIC__/static/plugins/fullcalendar-3.8.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
		<link href='__PUBLIC__/static/plugins/bigcolorpicker/css/jquery.bigcolorpicker.css' rel='stylesheet' />
		<link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap-table.css" rel="stylesheet">
		<!--[if IE 6]>
            <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
            <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
		<title>
			团队排期
		</title>
		</meta>
		</meta>
		</meta>
	</head>

	<body>
		<div class="page-container">
			<div id='calendar'></div>
		</div>
		<div id="selectDialog">
			<table id="table"></table>
		</div>

		<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.js" type="text/javascript"></script>
		<script src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js" type="text/javascript"></script>
		<script src='__PUBLIC__/static/plugins/fullcalendar-3.8.2/lib/moment.min.js'></script>
		<script src='__PUBLIC__/static/plugins/fullcalendar-3.8.2/fullcalendar.min.js'></script>
		<script src='__PUBLIC__/static/plugins/fullcalendar-3.8.2/locale/zh-cn.js'></script>
		<script src='__PUBLIC__/static/plugins/bigcolorpicker/js/jquery.bigcolorpicker.js'></script>
		<script src='__PUBLIC__/static/plugins/layDate-v5.0.9/laydate/laydate.js'></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
		<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>
		<script type="text/javascript">
			var getRange = 'All';
			$(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					navLinks: true,
					editable: false,
					weekNumbers: true,
					eventLimit: true,
					selectHelper: true,
					unselectAuto: true,
					events: function(start, end, timezone, callback) {
						var startDate = timestampToTime(start.unix() - 5212800); //当前时间的前2个月
						var events = [];
						$.ajax({
							url: "__ScheduleURL__/team_schedule_management/getScheduleData",
							dataType: 'json',
							type: 'post',
							data: {
								'start': startDate,
								'getRange': getRange
							},
							success: function(doc) {
								$(doc).each(function(i) {
									events.push({
										id: doc[i].id,
										title: doc[i].title,
										start: doc[i].start_time,
										end: doc[i].end_time,
										color: doc[i].color,
										creator: doc[i].creator_name,
										status: doc[i].status
									});
								});
								callback(events);
							}
						});
					},
					dayClick: function(date) {
						//打开选择对话框
						layer.open({
							title:'<i class="Hui-iconfont">&#xe62b;</i> 选择人员',
							type: 1,
							area: ['300px', '520px'],
							shadeClose: true,
							content: $("#selectDialog"),
							shift: 3,
							btn: ['确定', '取消'],
							yes: function(index) {
								showMemberSchedule();
								layer.closeAll();
							},
							cancel: function() {
								layer.closeAll();
							}
						});
						initMembers();
					},
				});
			});

			//初始化待选成员
			function initMembers() {
				$table = $('#table').bootstrapTable("destroy").bootstrapTable({
					url: '__ScheduleURL__/team_schedule_management/getMembers',
					method: 'get',
					cache: false,
					height: 380,
					striped: true,
					singleSelect: false,
					search: false,
					clickToSelect: true,

					columns: [{
						checkbox: true,
						align: 'center',
						width: 5
					}, {
						field: 'creator_id',
						title: 'creator_id',
						visible: false
					}, {
						field: 'creator_name',
						title: '姓名'
					}]
				});

			}
			
			//展示选择用户的排期
			function showMemberSchedule(){
				var selectedData= $table.bootstrapTable('getSelections');
				if(selectedData.length <=0){
					getRange = 'All';
				}else{
					getRange = selectedData;
				}
				$('#calendar').fullCalendar('refetchEvents');
			}
			
			//将时间戳转为日期格式
			function timestampToTime(timestamp) {
				var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
				Y = date.getFullYear() + '-';
				M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
				D = date.getDate();
				return Y + M + D;
			}
		</script>
	</body>

</html>