<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\phpStudy\WWW/application/index\view\index\update_log_page.html";i:1523700808;}*/ ?>
﻿<!DOCTYPE html>
<!--[if IE 7]><html class="ie7" lang="zh"><![endif]-->
<!--[if gt IE 7]><!-->
<html lang="zh">
<!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统更新历程</title>
<link href="__PUBLIC__/static/plugins/time-line/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content">
  <div class="wrapper">
    <div class="light"><i></i></div>
    <hr class="line-left">
    <hr class="line-right">
    <div class="main">
      <h1 class="title">系统更新历程</h1>
      <div class="year">
        <h2><a href="#">2018年<i></i></a></h2>
        <div class="list">
          <ul>
          	<li class="cls highlight">
              <p class="date">4月14日</p>
              <p class="intro">新增功能升级</p>
              <p class="version">&nbsp;</p>
              <div class="more">
                <p>1、新增笔记功能，可以将工作中用到的笔记数据记录到系统了；</p>
                <p>2、新增冒烟测试用例功能，建议研发人员执行通过后再执行测试流程；</p>
                <p>3、其他若干功能优化。</p>
              </div>
            </li>
          	<li class="cls">
              <p class="date">3月23日</p>
              <p class="intro">优化体验升级</p>
              <p class="version">&nbsp;</p>
              <div class="more">
                <p>1、提供导图管理功能，能够将自己的想法转化为思维导图，并分享出去；</p>
                <p>2、提供退出系统，切换到登录页面功能；</p>
                <p>3、排期规格的选择对话框提供“我的”和“所有人的”选项，分类查看更科学。</p>
              </div>
            </li>
            <li class="cls highlight">
              <p class="date">3月15日</p>
              <p class="intro">思维导图改造升级</p>
              <p class="version">&nbsp;</p>
              <div class="more">
                <p>1、将原有思维导图推翻重新改造，使用当前版本编写导图用例效率极大提升；</p>
                <p>2、在页面头部添加用户密码修改功能；</p>
                <p>3、删除未实现的功能菜单。</p>
              </div>
            </li>
            <li class="cls">
              <p class="date">3月2日</p>
              <p class="intro">试用版本上线！</p>
              <p class="version">&nbsp;</p>
              <div class="more">
                <p>1、在测试容器中部署系统，试用版本上线。</p>
               
              </div>
            </li>
          </ul>
        </div>
      </div>
	  </div>
  </div>
</div>
<script type="text/javascript" src="__PUBLIC__/static/plugins/time-line/js/jquery.min.js"></script>
<script>
	$(".main .year .list").each(function (e, target) {
	    var $target=  $(target),
	        $ul = $target.find("ul");
	    $target.height($ul.outerHeight()), $ul.css("position", "absolute");
	}); 
	$(".main .year>h2>a").click(function (e) {
	    e.preventDefault();
	    $(this).parents(".year").toggleClass("close");
	});
	</script>
</body>
</html>
