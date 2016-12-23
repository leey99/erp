<?
if(!isset($url)) $url = "%2Ferp%2Fmain.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>로그인 페이지 : 통합관리프로그램</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<?
include "inc/analyticstracking.php";
?>
<script language="javascript">
function next(e){
	var k= (document.all) ? e.keyCode : e.which
	if(k==13 && document.fhead.mb_id.value.length>0) 
		document.fhead.mb_password.focus()
}
function fhead_submit(f)
{
	if (!f.mb_id.value)
	{
		alert("회원아이디를 입력하십시오.");
		f.mb_id.focus();
		return;
	}
	setValue();
	if (!f.mb_password.value)
	{
		alert("패스워드를 입력하십시오.");
		f.mb_password.focus();
		return;
	}
	f.action = "./login_check.php";
	f.submit();
}
</script>
<div style="height:50px;background:url('images/top_bar.gif') repeat-x;padding:4px 0 0 16px">
	<div style="float:left"><img src="images/logo.png"></div>
	<div style="float:right"><img src="images/top_login_txt.png"></div>
</div>
<div style="margin:100px 0 0 0">
	<table width="" align="center" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td>
				<img src="images/title.gif">
			</td>
			<td>
				<img src="images/img01.gif">
			</td>
			<td>
				<img src="images/img02.gif">
			</td>
			<td>
				<img src="images/img03.gif">
			</td>
		</tr>
	</table>
	<table width="" align="center" border="0" cellspacing="0" cellpadding="2">
		<tr>
			<td rowspan="2">
				<div style="width:324px;height:276px;border:1px solid #c9cacc;background-color:#e7e7e7">
					<form name="fhead" action="javascript:fhead_submit(document.fhead);" method="post" autocomplete="off">
						<input name="url" type="hidden" value="<?=$url?>">
						<table border="0" cellspacing="0" cellpadding="0" style="margin:90px 0 0 20px">
							<tr>
								<td style="padding:0 7px 0 10px;"><img src="images/id.gif"></td>
								<td colspan="2" width="" align="right"><input type="text" name="mb_id" class="input1" style="ime-mode:disabled;width:204px" maxlength="14" tabindex="1"  onkeypress="" onkeyup="">
								</td>
							</tr>
							<tr>
								<td colspan="2" height="10"></td>
							</tr>
							<tr>
								<td style="padding:0 7px 0 10px;"><img src="images/pw.gif"></td>
								<td colspan="2" align="right"><input type="password" name="mb_password" id="login_mb_password" class="input1" style="width:204px" value="" maxlength="14" tabindex="2"></td>
							</tr>
							<tr>
								<td colspan="2" height="10"></td>
							</tr>
							<tr>
								<td></td>
								<td height="25" align="right" style="padding:0 6px 0 0"><input type="checkbox" name="id_save" value="Y" onclick="setValue()" style="border:0;margin: 0 10px 0 0; vertical-align: middle;"><img src="images/id_save.gif" style="margin: 6px 0; vertical-align: middle;"></td>
								<td align="right"><input name="image" type="image" src="images/login.gif" style="border:0;margin:0 0 0 0;"></td>
							</tr>
						</table>
					</form>
				</div>
			</td>
			<td rowspan="2">
				<img src="images/img04.gif">
			</td>
			<td>
				<img src="images/img05.gif">
			</td>
			<td>
				<img src="images/img06.gif">
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<img src="images/img07.gif">
			</td>
		</tr>
	</table>
	<table width="848" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="right" height="40">
				<img src="images/copyright.gif">
			</td>
		</tr>
	</table>
</div>
<script language="javascript">
var fm = document.fhead;
function setCookie (name, value, expiredays)
 {
  var todayDate = new Date();
  todayDate.setDate( todayDate.getDate() + expiredays );
  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";";
 }
function setValue()
 {
	if(fm.id_save.checked == true) setCookie ('id', fm.mb_id.value, 1);
 }
function getCookie(name) // 쿠키 기능을 정의하는 함수입니다. 
{
	var rose = name + "=" ; //쿠키네임=
	var rose2 = rose.length ;
	//쿠키의 길이
	var rose3 = document.cookie.length 
	var i = 0;
	while (i < rose3)
	{
		var j = i + rose2;
		if (document.cookie.substring(i,j) == rose) 
		{
			var rose4 = document.cookie.indexOf(";",j);
			if (rose4 == -1)
			{
				rose4 = document.cookie.length;
			}
			return unescape(document.cookie.substring(j,rose4));
		}
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) 
		{
			break;
		}
	}
	return "";
}
var ckid = getCookie("id");
if (ckid != "") {
	fm.mb_id.value = ckid;
	fm.id_save.checked = true;
}
</script>
</body>
</html>
