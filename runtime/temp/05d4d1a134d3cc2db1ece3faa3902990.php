<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:103:"D:\phpStudy\TestManagementSystem\htdocs/application/schedule\view\person_schedule_management\index.html";i:1518405734;}*/ ?>
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
		<!--[if IE 6]>
            <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
            <script>DD_belatedPNG.fix('*');</script>
        <![endif]-->
		<title>
			个人排期
		</title>
		</meta>
		</meta>
		</meta>
	</head>

	<body>
		<div class="page-container">
			<div id='calendar'></div>
		</div>
		<div id="addEvent" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content radius">
					<div class="modal-header">
						<h3 class="modal-title"><i class="Hui-iconfont">&#xe600;</i> 新建排期项</h3>
						<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
					</div>
					<div class="modal-body">
						<form class="form form-horizontal">
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>任务名称：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" id="taskName1" placeholder="控制在30个字、60个字节以内" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>开始时间：</label>
								<div class="formControls col-xs-5 col-sm-6">
									<input type="text" id="startDate1" class="input-text" readonly="readonly">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>结束时间：</label>
								<div class="formControls col-xs-5 col-sm-6">
									<input type="text" id="endDate1" class="input-text" readonly="readonly">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>主题颜色：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" id="color1" class="input-text" readonly="readonly">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-success radius" onclick="addEvent()"><i class="Hui-iconfont">&#xe632;</i> 确定</button>
						<button class="btn btn-warning radius" data-dismiss="modal" aria-hidden="true"><i class="Hui-iconfont">&#xe6a6;</i> 关闭</button>
					</div>
				</div>
			</div>
		</div>
		<div id="editEvent" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content radius">
					<div class="modal-header">
						<h3 class="modal-title"><i class="Hui-iconfont">&#xe647;</i> 修改排期项</h3>
						<a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
					</div>
					<div class="modal-body">
						<form class="form form-horizontal">
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>任务名称：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" id="taskName2" placeholder="控制在30个字、60个字节以内" class="input-text">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>开始时间：</label>
								<div class="formControls col-xs-5 col-sm-6">
									<input type="text" id="startDate2" class="input-text" readonly="readonly">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>结束时间：</label>
								<div class="formControls col-xs-5 col-sm-6">
									<input type="text" id="endDate2" class="input-text" readonly="readonly">
								</div>
							</div>
							<div class="row cl">
								<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>主题颜色：</label>
								<div class="formControls col-xs-8 col-sm-9">
									<input type="text" id="color2" class="input-text" readonly="readonly">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger radius" onclick="delEvent()"><i class="Hui-iconfont">&#xe6a6;</i> 删除</button>
						<button class="btn btn-success radius" onclick="editEvent()"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
						<button class="btn btn-warning radius" data-dismiss="modal" aria-hidden="true"><i class="Hui-iconfont">&#xe6a6;</i> 关闭</button>
					</div>
				</div>
			</div>
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
		<script type="text/javascript">
			var currentEventId = 0;
			$(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					navLinks: true,
					editable: true,
					eventLimit: true,
					selectHelper: true,
					unselectAuto: true,
					events: function(start, end, timezone, callback) {
						var startDate = timestampToTime(start.unix() - 5212800); //当前时间的前2个月
						var events = [];
						$.ajax({
							url: "__ScheduleURL__/person_schedule_management/getScheduleData",
							dataType: 'json',
							type: 'post',
							data: {
								'start': startDate,
								'creatorId':"<?php echo $userID; ?>"
							},
							success: function(doc) {
								$(doc).each(function(i) {
									events.push({
										id: doc[i].id,
										title: doc[i].title,
										start: doc[i].start_time,
										end: doc[i].end_time,
										color: doc[i].color,
										creatorId: doc[i].creator_id,
										creator: doc[i].creator_name,
										status: doc[i].status
									});
								});
								callback(events);
							}
						});
					},
					dayClick: function(date) {
						var setDate = timestampToTime(date.unix());
						laydate.render({
							elem: '#startDate1',
							value: setDate
						});
						laydate.render({
							elem: '#endDate1',
							value: setDate
						});
						$("#color1").bigColorpicker(function(el, color) {
							$(el).css("backgroundColor", color);
							$(el).val(color);
						}, "L", 10);
						$("#addEvent").modal("show");
						$("#taskName1").val("【<?php echo $realName; ?>】:");
					},
					eventClick: function(event) {
						if(event.creator != '<?php echo $realName; ?>') {
							layer.msg("只允许创建人有权限作此操作！", function() {});
						} else {
							currentEventId = event.id; //获取事件id并将值进行保存
							$('#taskName2').val(event.title);

							var startDate = timestampToTime(event.start.unix());
							laydate.render({
								elem: '#startDate2',
								value: startDate
							});
							
							var endDate = event.end;
							if(endDate==''||endDate==null){
								endDate = event.start;
							}
							var endDate2 = timestampToTime(endDate.unix());
							laydate.render({
								elem: '#endDate2',
								value: endDate2
							});
							
							$("#color2").bigColorpicker(function(el, color) {
								$(el).css("backgroundColor", color);
								$(el).val(color);
							}, "L", 10);
							$("#color2").val(event.color);
							$("#color2").css("backgroundColor",event.color);
							$("#editEvent").modal("show");
						}
					},
					eventDrop: function(event, dayDelta, revertFunc) {
						if(event.creator != '<?php echo $realName; ?>') {
							revertFunc();
							layer.msg("只允许创建人有权限作此操作！", function() {});
						} else {
							reSaveEvent(event.id, timestampToTime(event.start.unix()), timestampToTime(event.end.unix()));
						}
					},
					eventResize: function(event, dayDelta, revertFunc) {
						if(event.creator != '<?php echo $realName; ?>') {
							revertFunc();
							layer.msg("只允许创建人有权限作此操作！", function() {});
						} else {
							reSaveEvent(event.id, timestampToTime(event.start.unix()), timestampToTime(event.end.unix()));
						}
					}
				});
			});

			//重新保存事件
			function reSaveEvent(id, startDate, endDate) {
				$.ajax({
					url: "__ScheduleURL__/person_schedule_management/reSaveEvent",
					dataType: 'json',
					type: 'post',
					data: {
						'id': id,
						'start': startDate,
						'end': endDate
					},
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

			//将时间戳转为日期格式
			function timestampToTime(timestamp) {
				var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
				Y = date.getFullYear() + '-';
				M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
				D = date.getDate();
				return Y + M + D;
			}

			//添加排期
			function addEvent() {
				var taskName = $("#taskName1").val().trim();
				var realName = "<?php echo $realName; ?>";
				if(taskName.indexOf(realName) <= 0) {
					layer.msg("名称中未包含您的姓名,请以【您的姓名】打头！", function() {});
					return;
				}
				var startDate = $("#startDate1").val();
				var endDate = $("#endDate1").val();
				var begin = new Date(startDate);
				var end = new Date(endDate);
				if(begin - end > 0) {
					layer.msg("任务开始时间必须在结束时间之前或当天！", function() {});
					return;
				}
				var color = $("#color1").val().trim();
				if(color.length <= 0) {
					layer.msg("请选择主题颜色！", function() {});
					return;
				}
				$.ajax({
					url: "__ScheduleURL__/person_schedule_management/addEvent",
					dataType: 'json',
					type: 'post',
					data: {
						'taskName': taskName,
						'creatorName': realName,
						'creatorId':"<?php echo $userID; ?>",
						'startDate': startDate,
						'endDate': endDate,
						'color': color
					},
					success: function(data) {
						if(data.status == 1) {
							layer.msg(data.info, {
								icon: 1,
								time: 1000
							});
							$("#addEvent").modal("hide")
							$('#calendar').fullCalendar('refetchEvents');
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}
			
			//编辑排期项目
			function editEvent(){
				var taskName = $("#taskName2").val().trim();
				var realName = "<?php echo $realName; ?>";
				if(taskName.indexOf(realName) <= 0) {
					layer.msg("名称中未包含您的姓名,请以【您的姓名】打头！", function() {});
					return;
				}
				var startDate = $("#startDate2").val();
				var endDate = $("#endDate2").val();
				var begin = new Date(startDate);
				var end = new Date(endDate);
				if(begin - end > 0) {
					layer.msg("任务开始时间必须在结束时间之前或当天！", function() {});
					return;
				}
				var color = $("#color2").val().trim();
				if(color.length <= 0) {
					layer.msg("请选择主题颜色！", function() {});
					return;
				}
				$.ajax({
					url: "__ScheduleURL__/person_schedule_management/editEvent",
					dataType: 'json',
					type: 'post',
					data: {
						'id':currentEventId,
						'taskName': taskName,
						'creator': realName,
						'startDate': startDate,
						'endDate': endDate,
						'color': color
					},
					success: function(data) {
						if(data.status == 1) {
							layer.msg(data.info, {
								icon: 1,
								time: 1000
							});
							$("#editEvent").modal("hide")
							$('#calendar').fullCalendar('refetchEvents');
						} else {
							layer.msg(data.info, function() {});
						}
					}
				});
			}
			
			//删除排期项目
			function delEvent() {
				if((currentEventId == 0) || (currentEventId == null)) {
					layer.msg("请选择需要删除的排期项！", function() {});
					return;
				}
				$("#editEvent").modal("hide");
				layer.confirm('排期项删除须谨慎，确认要删除吗？', function(index) {
					$.ajax({
						data: {
							'id': currentEventId
						},
						url: "__ScheduleURL__/person_schedule_management/delEvent",
						type: "post",
						success: function(data) {
							if(data.status == 1) {
								layer.msg('已删除!', {
									icon: 1,
									time: 1000
								});

								$('#calendar').fullCalendar('refetchEvents');
							} else {
								layer.msg(data.info, function() {});
							}
						}
					});
				});
			}
		</script>
	</body>

</html>