<?
if(!isset($url)) $url = "";
if(!$url) $url = "%2Feasynomu2%2Fmain.php";
?>
<html>
<head>
<title>:::로그인페이지:::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
</head>
<body onLoad="document.fhead.mb_id.focus();">
<script language="JavaScript">
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
	if (!f.mb_password.value)
	{
		alert("패스워드를 입력하십시오.");
		f.mb_password.focus();
		return;
	}
	f.action = "./login_check_easynomu.php";
	f.submit();
}
function privacy_information(url) {
	var f = document.fhead;
	if (!f.mb_id.value) {
		alert("회원아이디를 입력하십시오.");
		f.mb_id.focus();
		return;
	}
	window.open(url+'?mb_id='+f.mb_id.value, 'privacy_information', 'height=760,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');
}
//아이디 (사업자등록번호 자동 하이픈 입력)
function checkThousand(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.fhead;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(input.substring(0,1) == "m" || input.substring(0,1) == "u" || input.substring(0,1) == "g" || input.substring(0,1) == "s" || input.substring(0,1) == "y" || input.substring(0,1) == "b" || input.substring(0,1) == "d" || input.substring(0,1) == "i" || input.substring(0,1) == "c") {
		//master
	} else {
		//백스페이스키 적용
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.mb_id.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
}
function total_pay_popup(url) {
	window.open(url, 'total_pay_popup', 'height=860,width=1260,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=yes');
}
</script>
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td height="80" align="center">
		&nbsp;
	</td>
</tr>
<tr>
  <td background="images/login_bg.png" style="background-repeat:no-repeat;" height="608" valign="top">
		<table border="0" cellspacing="0" cellpadding="0" width="936">
			<tr>
			  <td>
					<div style="padding:71px 0 0 193px">
						<img src="images/login_title.gif">
					</div>
					<div style="padding:20px 0 0 148px">
						<div style="float:left"><img src="images/login_stitle.gif"></div><div style="float:left">v2.0</div>
					</div>
				</td>
			</tr>
			<tr>
			  <td valign="top">
					<div style="margin:12px 0 0 148px;width:616px;height:240px;border:1px solid #f2cf08;background:#f0f0f0;">
						<table border="0" cellspacing="0" cellpadding="0" align="center">
							<tr>
								<td height="50"></td>
							</tr>
							<tr>
								<td style="padding-left:10px;" valign="top">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<form name="fhead" action="javascript:fhead_submit(document.fhead);" method="post" autocomplete="off">
													<input name="url" type="hidden" value="<?=$url?>">
													<table border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td style="padding-left:10px;"><img src="images/id.gif"></td>
															<td><input type="text" name="mb_id" class="input1" style="ime-mode:disabled" size="20" maxlength="12" tabindex="1"  onkeypress="only_number_english()" onkeyup="checkThousand(this.value, '1','Y')">
															</td>
															<td rowspan="2">
																<input name="image" type="image" src="images/login_bt.gif" style="border:0;margin:0 10px;">
																<a href="4insure_popup.php" onclick="window.open(this.href, '4insure_popup', 'height=780,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');return false;" onfocus='this.blur();'><img src="images/btn_01.gif" border="0"></a>
															</td>
														</tr>
														<tr>
															<td style="padding-left:10px;"><img src="images/pw.gif"></td>
															<td><input type="password" name="mb_password" id="login_mb_password" class="input1" value="" size="20" maxlength="25" tabindex="2"></td>
														</tr>
														<tr>
															<td></td>
															<td height="25" align="right" style="padding:0 6px 0 0"><input type="checkbox" name="id_save" value="Y" onclick="setValue()" style="border:0;margin: 0 0; vertical-align: middle;"><img src="images/id_save.gif" style="margin: 6px 0; vertical-align: middle;"></td>
															<td align="right"><label onclick="privacy_information('./privacy_information/');" style="cursor:pointer"><img src="images/btn_agree.gif" border="0"></label></td>
															</tr>
														<tr>
															<td></td>
															<td height="36" align="right"></td>
															<td align="right"></td>
														</tr>
													</table>
												</form>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					<div style="margin:10px 0 0 148px;width:616px;text-align:right"><img src="images/login_tel.gif"></div>
				</td>
			</tr>
		</table>
	</td>
</tr>
</table>
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