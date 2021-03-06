<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"D:\phpStudy\WWW/application/index\view\index\index.html";i:1532350013;}*/ ?>
﻿<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="Bookmark" href="__PUBLIC__/favicon.ico">
    <link rel="Shortcut Icon" href="__PUBLIC__/favicon.ico"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/skin/red/skin.css"
          id="skin"/>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo \think\Config::get('SITE_NAME'); ?></title>
    <meta name="keywords" content="测试用例管理系统(TCMS)">
    <meta name="description" content="测试用例管理系统(TCMS)">
</head>

<body>
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl">
            <a class="logo navbar-logo f-l mr-10 hidden-xs" href="#"><img
                    src="__PUBLIC__/static/images/atl.site.logo.png" alt="JD_LOGO"/><?php echo \think\Config::get('SITE_NAME'); ?></a>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">

                    <li class="navbar-levelone current">
                        <a href="javascript:;"><i class="Hui-iconfont">&#xe68c;</i> 平台主功能</a>
                    </li>
                    <li class="navbar-levelone">
                        <a href="javascript:;"><i class="Hui-iconfont">&#xe6c6;</i> 测试数据准备</a>
                    </li>
                    <li class="navbar-levelone">
                        <a href="javascript:;"><i class="Hui-iconfont">&#xe61d;</i> 系统管理</a>
                    </li>
                    <!--
                    <li class="navbar-levelone">
                        <a href="javascript:;"><i class="Hui-iconfont">&#xe61d;</i> 外围系统</a>
                    </li>
                    -->
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li class="dropDown dropDown_hover">
                        <a href="#" class="dropDown_A"><?php echo $realName; ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <!--
                            <li>
                                <a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 关于</a>
                            </li>
                            <li>
                                <a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 帮助</a>
                            </li>
                            <li>
                                <a href="javascript:;" onClick="myselfinfo()">个人信息</a>
                            </li>
                            -->
                            <li>
                                <a href="#" onClick="showMdfPwdDialog()">修改登录密码</a>
                            </li>
                            <li>
                                <a href="#" onClick="exitSystem()">退出系统</a>
                            </li>
                        </ul>
                    </li>
                    <li id="Hui-msg">
                        <!--	<a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> -->
                    </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover">
                        <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont"
                                                                                style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li>
                                <a href="javascript:;" data-val="red" title="红色">默认（红色）</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-val="green" title="绿色">绿色</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-val="blue" title="蓝色">蓝色</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-val="yellow" title="黄色">黄色</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-val="orange" title="橙色">橙色</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <div class="menu_dropdown bk_2">

        <dl>
            <dt class="selected"><i class="Hui-iconfont">&#xe681;</i> 列表用例管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__ListTestCaseURL__/test_plan_management" data-title="测试计划"
                           href="javascript:void(0)"> 测试计划</a>
                    </li>
                    <li>
                        <a data-href="__ListTestCaseURL__/list_testcase_management" data-title="测试用例"
                           href="javascript:void(0)"> 测试用例</a>
                    </li>
                    <li>
                        <a data-href="__ListTestCaseURL__/list_testcase_management" data-title="测试用例"
                           href="javascript:void(0)"> 基线用例管理</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl>
            <dt class="selected"><i class="Hui-iconfont">&#xe6be;</i> 导图用例管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__TestCaseURL__/project_management" data-title="项目管理" href="javascript:void(0)">
                            项目管理</a>
                    </li>
                    <li>
                        <a data-href="__TestCaseURL__/node_management" data-title="节点管理" href="javascript:void(0)">
                            节点管理</a>
                    </li>
                    <li>
                        <a data-href="__TestCaseURL__/testcase_management" data-title="用例管理" href="javascript:void(0)">
                            用例管理</a>
                    </li>
                    <li>
                        <a data-href="__TestCaseURL__/share_management" data-title="用例分享" href="javascript:void(0)">
                            用例分享</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl id="">
            <dt class="selected"><i class="Hui-iconfont">&#xe6aa;</i> 思维导图管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__MindMapURL__/map_management" data-title="我的导图" href="javascript:void(0)">
                            我的导图</a>
                    </li>
                    <li>
                        <a data-href="__MindMapURL__/share_management" data-title="导图分享" href="javascript:void(0)">
                            导图分享</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl id="menu-article">
            <dt class="selected"><i class="Hui-iconfont">&#xe690;</i> 团队排期管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__ScheduleURL__/plan_schedule_management?planId=0" data-title="排期规划"
                           href="javascript:void(0)"> 排期规划</a>
                    </li>
                    <li>
                        <a data-href="__ScheduleURL__/person_schedule_management" data-title="我的排期"
                           href="javascript:void(0)"> 我的排期</a>
                    </li>
                    <li>
                        <a data-href="__ScheduleURL__/team_schedule_management" data-title="团队排期"
                           href="javascript:void(0)"> 团队排期</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl id="">
            <dt class="selected"><i class="Hui-iconfont">&#xe70c;</i> 云笔记管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__NoteURL__/note_management" data-title="我的笔记" href="javascript:void(0)"> 我的笔记</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <dl id="">
            <dt class="selected"><i class="Hui-iconfont">&#xe63c;</i> 测试工具<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
            </dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__TestToolURL__/test_tool_management/hosts" data-title="Hosts管理"
                           href="javascript:void(0)"> Hosts 管理</a>
                    </li>
                    <li>
                        <a data-href="__TestToolURL__/test_tool_management/sendpay" data-title="SendPay快速检查"
                           href="javascript:void(0)"> SendPay快速检查</a>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
    <div class="menu_dropdown bk_2" style="display:none">
        <dl id="">
            <dt><i class="Hui-iconfont">&#xe616;</i> 常用站点<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="http://oper.jd.id" data-title="Oper" href="javascript:void(0)"> Oper</a>
                    </li>
                    <li>
                        <a data-href="http://www.jd.id" data-title="JD.ID" href="javascript:void(0)"> JD.ID</a>
                    </li>
                    <li>
                        <a data-href="http://stock.oper.jd.id/wareStock/changeStock" data-title="Stock"
                           href="javascript:void(0)"> Stock</a>
                    </li>

                </ul>
            </dd>
        </dl>
        <dl id="menu-aaaaa">
            <dt><i class="Hui-iconfont">&#xe616;</i> 库存系统<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__DataMachineURL__/Stock_Sys/add_stock_page" data-title="添加库存"
                           href="javascript:void(0)"> 添加库存</a>
                    </li>
                </ul>
            </dd>
        </dl>
    </div>
    <div class="menu_dropdown bk_2" style="display:none">
        <dl>
            <dt><i class="Hui-iconfont">&#xe616;</i> 机构管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__InstitutionalURL__/user_management" data-title="用户管理" href="javascript:void(0)">
                            用户管理</a>
                    </li>
                    <li>
                        <a data-href="__InstitutionalURL__/role_management" data-title="角色管理" href="javascript:void(0)">
                            角色管理</a>
                    </li>
                </ul>
            </dd>
        </dl>
        <dl>
            <dt><i class="Hui-iconfont">&#xe6c0;</i> 数据字典<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li>
                        <a data-href="__DataDictionaryURL__/test_module_management" data-title="模块管理"
                           href="javascript:void(0)"> 模块管理</a>
                    </li>
                    <li>
                        <a data-href="__DataDictionaryURL__/test_type_management" data-title="测试类型"
                           href="javascript:void(0)"> 测试类型</a>
                    </li>
                    <li>
                        <a data-href="__DataDictionaryURL__/test_env_management" data-title="测试环境"
                           href="javascript:void(0)"> 测试环境</a>
                    </li>
                </ul>
            </dd>
        </dl>

        <div class="menu_dropdown bk_2" style="display:none">
            <dl id="">
                <dt><i class="Hui-iconfont">&#xe616;</i> 外围系统<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i>
                </dt>
                <dd>
                    <ul>
                        <li>
                            <a data-href="http://jira.jd.com" data-title="Jira" href="javascript:void(0)"> Jira</a>
                        </li>
                        <li>
                            <a data-href="http://erp.jd.com" data-title="ERP" href="javascript:void(0)"> ERP</a>
                        </li>
                        <li>
                            <a data-href="http://cf.jd.com" data-title="知识管理(CF)" href="javascript:void(0)">
                                知识管理(CF)</a>
                        </li>
                        <li>
                            <a data-href="article-list3.html" data-title="用户管理" href="javascript:void(0)"> 用户管理</a>
                        </li>
                        <li>
                            <a data-href="article-list4.html" data-title="权限管理" href="javascript:void(0)"> 权限管理</a>
                        </li>
                    </ul>
                </dd>
            </dl>
        </div>
</aside>
<div class="dislpayArrow hidden-xs">
    <a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active">
                    <span title="我的桌面" data-href="#">我的桌面</span>
                    <em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group">
            <a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
            <a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
        </div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="__APP__/index/update_log_page"></iframe>
        </div>
    </div>
</section>

<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前</li>
        <li id="closeall">关闭全部</li>
    </ul>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript"
        src="__PUBLIC__/static/H-ui.admin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script type="text/javascript">
    $(function () {
        $("#min_title_list li").contextMenu('Huiadminmenu', {
            bindings: {
                'closethis': function (t) {
                    console.log(t);
                    if (t.find("i")) {
                        t.find("i").trigger("click");
                    }
                },
                'closeall': function (t) {
                    alert('Trigger was ' + t.id + '\nAction was Email');
                },
            }
        });

        $("body").Huitab({
            tabBar: ".navbar-wrapper .navbar-levelone",
            tabCon: ".Hui-aside .menu_dropdown",
            className: "current",
            index: 0,
        });
    });

    //打开修改密码对话框
    function showMdfPwdDialog() {
        var index = layer.open({
            type: 2,
            shift: 3,
            area: ['780px', '320px'],
            title: '<i class="Hui-iconfont">&#xe63f;</i> 修改登录密码',
            content: '__InstitutionalURL__/user_management/edit_pwd_page?userId=<?php echo $userId; ?>'
        });
    }

    //退出系统
    function exitSystem() {
        layer.confirm('您确定要退出系统吗？', function (index) {
            $.ajax({
                url: "__APP__/Index/setSessionNull",
                type: "post",
                success: function (data) {
                    window.location.href = "__APP__/Login/index";

                }
            });
        });
    }

</script>
</body>

</html>