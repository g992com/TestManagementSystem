<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:99:"D:\phpStudy\TestManagementSystem\htdocs/application/schedule\view\hr_schedule_management\index.html";i:1533277641;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta content="webkit|ie-comp|ie-stand" name="renderer">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
          name="viewport"/>
    <meta content="no-siteapp" http-equiv="Cache-Control"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
    <![endif]-->
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/default/skin.css" id="skin" rel="stylesheet"
          type="text/css"/>
    <link href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css"/>
    <link href='__PUBLIC__/static/plugins/fullcalendar-3.8.2/fullcalendar.min.css' rel='stylesheet'/>
    <link href='__PUBLIC__/static/plugins/fullcalendar-3.8.2/fullcalendar.print.min.css' rel='stylesheet'
          media='print'/>
    <link href='__PUBLIC__/static/plugins/bigcolorpicker/css/jquery.bigcolorpicker.css' rel='stylesheet'/>
    <link href="__PUBLIC__/static/plugins/bootstrap-table/css/bootstrap-table.css" rel="stylesheet">
    <link href="__PUBLIC__/static/plugins/mult-select/select.css" rel="stylesheet">
    <link href="__PUBLIC__/static/plugins/mult-select/fonticon.css" rel="stylesheet">
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>
        人资排期
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

<div id="addEvent" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <div class="modal-header">
                <h3 class="modal-title"><i class="Hui-iconfont">&#xe600;</i> 新建任务</h3>
                <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
            </div>
            <div class="modal-body">
                <form class="form form-horizontal">
                    <div class="row cl">
                        <label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>任务名称：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <select class="select radius" id="taskName" name="taskName" style="height: 30px">
                            </select>
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
                    <div class="row cl">
                        <label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>参与人员：</label>
                        <div class="formControls col-xs-8 col-sm-9">
                            <div id="mySelect" class="mySelect" style="width: 100%;float: left"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success radius" onclick="addEvent()"><i class="Hui-iconfont">&#xe632;</i> 确定
                </button>
                <button class="btn btn-warning radius" data-dismiss="modal" aria-hidden="true"><i class="Hui-iconfont">&#xe6a6;</i>
                    关闭
                </button>
            </div>
        </div>
    </div>
</div>
<div id="editEvent" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content radius">
            <div class="modal-header">
                <h3 class="modal-title"><i class="Hui-iconfont">&#xe647;</i> 修改任务</h3>
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
                <button class="btn btn-danger radius" onclick="delEvent()"><i class="Hui-iconfont">&#xe6a6;</i> 删除
                </button>
                <button class="btn btn-success radius" onclick="editEvent()"><i class="Hui-iconfont">&#xe632;</i> 保存
                </button>
                <button class="btn btn-warning radius" data-dismiss="modal" aria-hidden="true"><i class="Hui-iconfont">&#xe6a6;</i>
                    关闭
                </button>
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
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table.min.js"></script>
<script src="__PUBLIC__/static/plugins/bootstrap-table/js/bootstrap-table-zh-CN.js"></script>
<script src="__PUBLIC__/static/plugins/mult-select/select.js"></script>
<script type="text/javascript">
    var getRange = 'All';
    var currentEventId = 0;
    $(function () {
        $("#taskName").change(function () {
            loadTaskDate();
        });
        init();
    });

    /**
     * 初始化数据
     * */
    function init() {
        $('#calendar').fullCalendar({
            customButtons: {
                reload: {
                    text: '查看指定人员任务情况',
                    click: function () {
                        showTestersPage();
                    }
                }
            },
            header: {
                left: 'prev,next today reload',
                center: 'title',
                right: 'listWeek,month,agendaWeek,agendaDay'
            },
            navLinks: true,
            editable: true,
            eventLimit: true,
            selectHelper: true,
            unselectAuto: true,
            events: function (start, end, timezone, callback) {
                var startDate = timestampToTime(start.unix() - 5212800); //当前时间的前2个月
                var events = [];
                $.ajax({
                    url: "__ScheduleURL__/hr_schedule_management/getScheduleData",
                    dataType: 'json',
                    type: 'post',
                    data: {
                        'start': startDate,
                        'getRange': getRange
                    },
                    success: function (doc) {
                        $(doc).each(function (i) {

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
            dayClick: function (date) {
                $('#startDate1').val('');
                $('#endDate1').val('');
                laydate.render({
                    elem: '#startDate1'
                });
                laydate.render({
                    elem: '#endDate1'
                });
                $("#color1").bigColorpicker(function (el, color) {
                    $(el).css("backgroundColor", color);
                    $(el).val(color);
                }, "L", 10);
                paintTaskList();
                paintTesterList();
                $("#addEvent").modal("show");
            }, eventClick: function (event) {
                currentEventId = event.id; //获取事件id并将值进行保存
                $('#taskName2').val(event.title);

                var startDate = timestampToTime(event.start.unix());
                laydate.render({
                    elem: '#startDate2',
                    value: startDate
                });

                var endDate = event.end;
                if (endDate == '' || endDate == null) {
                    endDate = event.start;
                }
                var endDate2 = timestampToTime(endDate.unix() - 86400); //减去86400即为减去1天，控件特性决定的
                laydate.render({
                    elem: '#endDate2',
                    value: endDate2
                });

                $("#color2").bigColorpicker(function (el, color) {
                    $(el).css("backgroundColor", color);
                    $(el).val(color);
                }, "L", 10);
                $("#color2").val(event.color);
                $("#color2").css("backgroundColor", event.color);
                $("#editEvent").modal("show");

            }, eventDrop: function (event, dayDelta, revertFunc) {
                reSaveEvent(event.id, timestampToTime(event.start.unix()), timestampToTime(event.end.unix()));
            },
            eventResize: function (event, dayDelta, revertFunc) {
                reSaveEvent(event.id, timestampToTime(event.start.unix()), timestampToTime(event.end.unix()));
            }
        });
    }

    /**
     * 加载测试计划下拉框内容
     */
    function paintTaskList() {
        $("#taskName").empty();
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/getTaskList",
            dataType: 'json',
            type: 'post',
            data: {},
            async: false,
            success: function (data) {

                $("#taskName").append("<option value='0'>==请选择测试计划==</option>");
                for (var p in data) {
                    $("#taskName").append("<option value='" + data[p].id + "'>" + data[p].test_plan_name + "</option>");
                }
            }
        });
    }

    /**
     *加载测试人员下拉框内容
     * */
    var selectTester = '';

    function paintTesterList() {
        var testers = [];
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/getTesterList",
            dataType: 'json',
            type: 'post',
            data: {},
            async: false,
            success: function (data) {
                for (var i in data) {
                    var arr = {"label": data[i].real_name, "value": data[i].real_name};
                    testers.push(arr);
                }
            }
        });
        $("#mySelect").empty();
        $("#mySelect").mySelect({
            mult: true,//true为多选,false为单选
            option: testers,
            onChange: function (res) {
                selectTester = res;
            }
        });
    }

    /**
     * 加载指定计划的进程日期
     */
    function loadTaskDate() {
        var taskId = $('#taskName').val();
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/getTaskDate",
            dataType: 'json',
            type: 'post',
            data: {'taskId': taskId},
            success: function (data) {
                $('#startDate1').val('');
                $('#endDate1').val('');
                $('#startDate1').val(data[0].start_date);
                $('#endDate1').val(data[0].end_date);
            }
        });
    }


    /**
     * 添加任务
     * */
    function addEvent() {
        if (!checkNewInput()) {
            return;
        }
        var planId = $('#taskName').val();
        var taskName = $('#taskName').find("option:selected").text();
        var startDate = $('#startDate1').val();
        var endDate = $('#endDate1').val();
        var color = $('#color1').val();
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/addEvent",
            dataType: 'json',
            type: 'post',
            data: {
                'planId': planId,
                'taskName': taskName,
                'creatorName': "<?php echo $realName; ?>",
                'creatorId': "<?php echo $userID; ?>",
                'startDate': startDate,
                'endDate': endDate,
                'color': color,
                'selectTester': selectTester
            },
            success: function (data) {
                if (data.status == 1) {
                    layer.msg(data.info, {
                        icon: 1,
                        time: 1000
                    });
                    $("#addEvent").modal("hide")
                    $('#calendar').fullCalendar('refetchEvents');
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });

    }

    /**
     * 编辑任务
     * */
    function editEvent() {
        var taskName = $("#taskName2").val().trim();
        var realName = "<?php echo $realName; ?>";
        var startDate = $("#startDate2").val();
        var endDate = $("#endDate2").val();
        var begin = new Date(startDate);
        var end = new Date(endDate);
        if (begin - end > 0) {
            layer.msg("任务开始时间必须在结束时间之前或当天！", function () {
            });
            return;
        }
        var color = $("#color2").val().trim();
        if (color.length <= 0) {
            layer.msg("请选择主题颜色！", function () {
            });
            return;
        }
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/editEvent",
            dataType: 'json',
            type: 'post',
            data: {
                'id': currentEventId,
                'taskName': taskName,
                'creator': realName,
                'startDate': startDate,
                'endDate': endDate,
                'color': color
            },
            success: function (data) {
                if (data.status == 1) {
                    layer.msg(data.info, {
                        icon: 1,
                        time: 1000
                    });
                    $("#editEvent").modal("hide")
                    $('#calendar').fullCalendar('refetchEvents');
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    /**
     * 重新保存任务信息
     * */
    function reSaveEvent(id, startDate, endDate) {
        $.ajax({
            url: "__ScheduleURL__/hr_schedule_management/reSaveEvent",
            dataType: 'json',
            type: 'post',
            data: {
                'id': id,
                'start': startDate,
                'end': endDate
            },
            success: function (data) {
                if (data.status == 1) {
                    layer.msg(data.info, {
                        icon: 1,
                        time: 1000
                    });
                } else {
                    layer.msg(data.info, function () {
                    });
                }
            }
        });
    }

    /**
     * 删除任务
     * */
    function delEvent() {
        if ((currentEventId == 0) || (currentEventId == null)) {
            layer.msg("请选择需要删除的任务！", function () {
            });
            return;
        }
        $("#editEvent").modal("hide");
        layer.confirm('任务删除须谨慎，确认要删除吗？', function (index) {
            $.ajax({
                data: {
                    'id': currentEventId
                },
                url: "__ScheduleURL__/hr_schedule_management/delEvent",
                type: "post",
                success: function (data) {
                    if (data.status == 1) {
                        layer.msg('已删除!', {
                            icon: 1,
                            time: 1000
                        });

                        $('#calendar').fullCalendar('refetchEvents');
                    } else {
                        layer.msg(data.info, function () {
                        });
                    }
                }
            });
        });
    }

    /**
     * 显示测试人员选择对话框
     * */
    function showTestersPage() {
        layer.open({
            title: '<i class="Hui-iconfont">&#xe62b;</i> 选择人员【支持多选】',
            type: 1,
            area: ['300px', '520px'],
            shadeClose: true,
            content: $("#selectDialog"),
            shift: 3,
            btn: ['确定', '取消'],
            yes: function (index) {
                showMemberSchedule();
                layer.closeAll();
            },
            cancel: function () {
                layer.closeAll();
            }
        });
        initTesters();
    }


    /**
     * 显示待选测试人员数据
     * */
    function initTesters() {
        $table = $('#table').bootstrapTable("destroy").bootstrapTable({
            url: '__ScheduleURL__/hr_schedule_management/getTesters',
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
                field: 'real_name',
                title: '姓名'
            }]
        });

    }

    /**
     * 按选择的测试人员显示其任务情况
     * */
    function showMemberSchedule() {
        var selectedData = $table.bootstrapTable('getSelections');
        if (selectedData.length <= 0) {
            getRange = 'All';
        } else {
            getRange = selectedData;
        }
        $('#calendar').fullCalendar('refetchEvents');
    }

    /**
     * 检查新建任务填写内容完整性
     * */
    function checkNewInput() {
        var taskId = $('#taskName').val();
        if (taskId == 0) {
            layer.msg("请选择任务名称!");
            return false;
        }
        var startDate1 = $('#startDate1').val();
        if (startDate1 == '') {
            layer.msg("请设置开始时间!");
            return false;
        }
        var endDate1 = $('#endDate1').val();
        if (endDate1 == '') {
            layer.msg("请设置结束时间!");
            return false;
        }
        var color1 = $('#color1').val();
        if (color1 == '') {
            layer.msg("请选择主题颜色!");
            return false;
        }
        if (selectTester == '') {
            layer.msg("请选择参与人员!");
            return false;
        }
        return true;
    }

    /**
     * @param timestamp
     * @returns {string}
     * 将时间戳转为日期格式
     */
    function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
        var Y = date.getFullYear() + '-';
        var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
        var D = date.getDate();
        return Y + M + D;
    }
</script>
</body>

</html>