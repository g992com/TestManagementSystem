$(function(){
	//load user info
	loadCookie();
	//enter key events
	$(this).keydown(function(event) {
		if(event.keyCode === 13) {
			$('#btnLogin').click();
		}
	});

	//user click login button
	$('#btnLogin').click(function(){
		if(true == checkInput()){
			
			loginSystem();
		}
	})
});

//user login system
function loginSystem(){
	var userPwd = $('#userPwd').val().trim();
	var base64 = new Base64();
	var encPwd = base64.encode(userPwd);
	$('#userPwd').val(encPwd); 
	$.ajax({
		type: 'post',
		url: APP_URL + '/Login/verifyLogin',
		data: {
			'userName': $("#userName").val().trim(),
			'userPwd': $("#userPwd").val()
		},
		beforeSend: function() {
			showMsg("用户身份验证中，请稍后...");
		},
		success: function(data, response, status) {
			
			if(data.status == 1) {
				if(true === $("#rememberUser").is(':checked')) { //保存用户名到Cookie中
					$.cookie('userName', $("#userName").val().trim(), {
						expires: 1000
					});
					$.cookie("rememberUser", "true", {
						expires: 1000
					});
				}else{
					$.cookie("userName", 'null');
					$.cookie("rememberUser", 'null');
				}
				 $('#userPwd').val(userPwd);
				 window.location.href = APP_URL + "/index"; //登录到系统主页面
			} else {
				showMsg(data.info);
				$('#userPwd').val(userPwd); //密码文本框还原原始明文密码
			}
			
		}
	});


}

//load cookie info
function loadCookie() {
	//从cookie中取出用户名
	if("null" !== $.cookie("userName")) {
		$("#userName").val($.cookie("userName"));
	}else{
		$("#userName").val('');
		$("#userPwd").val('');
	}
	if("true" === $.cookie("rememberUser")) {
		$("#rememberUser").prop("checked", true);
	}
} 

//check user inpunt
function checkInput(){
	var userName = $('#userName').val().trim();
	var userPwd = $('#userPwd').val();
	if(userName.length<=0){
		showMsg("请填写用户名！");
		return false;
	}else if(userPwd.length<=0){
		showMsg("请填写用户登录密码！");
		return false;
	}else{
		return true;
	}
}

//show error message
function showMsg(text){
	$("#msg").text(text);
}