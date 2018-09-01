<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW/application/testtool\view\test_tool_management\sendpay.html";i:1529325793;}*/ ?>
<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="utf-8">
		<meta content="webkit|ie-comp|ie-stand" name="renderer">
		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<meta content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport" />
		<meta content="no-siteapp" http-equiv="Cache-Control" />
		<link href="__PUBLIC__/static/H-ui.admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/mmgrid/examples/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="__PUBLIC__/static/plugins/mmgrid/src/mmGrid.css">

		<title>
			SendPay快速检查
		</title>
		</meta>
		</meta>
		</meta>
	</head>

	<body style="padding: 20px;">
		<div class="page-container">
			<div class="cl pd-5 bg-1 bk-gray">
				<span class="l">
                    <div style="margin-bottom: 5px;">
                			<input id="str" placeholder="输入SendPay待解析字符串，如0001" style="margin-left: 20px; width:500px"> 
            				<a class="btn btn-danger radius" href="javascript:;" onclick="requestURL()"><i class="Hui-iconfont">&#xe665;</i> 开始解析 </a>
            				<a class="btn btn-success radius" href="javascript:;" onclick="location.reload();"><i class="Hui-iconfont">&#xe68f;</i> 再来一次 </a>
                    </div>
                </span>
			</div>
			<table id="mmg" class="mmg">
				<tr>
					<th rowspan="" colspan=""></th>
				</tr>
			</table>
		</div>
		<script src="__PUBLIC__/static/H-ui.admin/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="__PUBLIC__/static/H-ui.admin/lib/layer/2.4/layer.js"></script>
		<script src="__PUBLIC__/static/plugins/mmgrid/src/mmGrid.js">
		</script>
		</script>
		<script type="text/javascript">
			function requestURL(){
				var reqURL = "http://jarvis.jd.com/sendpay/decodesendpay?sendpayString=";
				var str = $('#str').val();
				if(str.length<=0){
					layer.msg("请输入带解析字符串！");
				}else{
					paintData(reqURL+str);
				}
			}

			var highliht = function(val) {
				if(val > 0) {
					return '<span style="color: #b00"><h5>' + val + '</h5></span>';
				} else {
					return '<span style="color: #0b0">' + val + '</span>';
				}
			};

			function paintData(reqURL) {
				$.ajax({
					data: {
						'reqURL': reqURL
					},
					url: '__TestToolURL__/test_tool_management/getSendPayData',
					type: "get",
					async: false,
					success: function(data) {

						var items = eval("(" + data + ")");
						var cols = [{
								title: 'sid',
								name: 'sid',
								width: 30,
								align: 'center'
							},
							{
								title: '值',
								name: 'value',
								width: 50,
								align: 'center',
								renderer: highliht
							},
							{
								title: '描述',
								name: 'description',
								width: 600,
								align: 'left'
							}
						];
						
					    var mmg = $('.mmg').mmGrid({
							height: $(window).height() - 70,
							cols: cols,
							method: 'get',
							remoteSort: true,
							items: items
							// , multiSelect: true
							// , fullWidthRows: true
						});
					}
				});
			}
		</script>
	</body>

</html>