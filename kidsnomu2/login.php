<?
if(empty($url)) $url = "%2Fkidsnomu%2Fmain.php";
?>
<html>
<head>
<title>:::로그인페이지:::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
</head>
<body onLoad="document.fhead.mb_id.focus();" style="background:url('./images/bg_tree.gif') right bottom no-repeat">
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
	if(input.substring(0,1) == "m" || input.substring(0,1) == "u" || input.substring(0,1) == "g" || input.substring(0,1) == "s" || input.substring(0,1) == "y" || input.substring(0,1) == "b" || input.substring(0,1) == "d" || input.substring(0,1) == "i" || input.substring(0,1) == "k" || input.substring(0,1) == "j" || input.substring(0,1) == "t") {
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
	window.open(url, 'total_pay_popup', 'height=760,width=1260,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=yes');
}
</script>
<div style="height:100%;background:url('./images/bg_cloud.gif') left top no-repeat">
	<table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td height="40">
				</td>
		</tr>
		<tr>
		<td background="images/login_bg.png" style="background-repeat:no-repeat;" height="691" valign="top">
			<table border="0" cellspacing="0" cellpadding="0" width="936">
				<tr>
					<td>
						<div style="padding:140px 0 0 104px">
							<img src="images/login_title.gif">
						</div>


					</td>
				</tr>
				<tr>
					<td valign="top">
						<div style="margin:50px 0 0 148px;width:616px;height:220px;border:0px solid #f2cf08;background:;">
							<table border="0" cellspacing="0" cellpadding="0" align="center">
								<tr>
									<td height="5"></td>
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
															<td style="padding:0 7px 0 10px;"><img src="images/id.gif"></td>
															<td width="154"><input type="text" name="mb_id" class="input1" style="ime-mode:disabled" size="20" maxlength="12" tabindex="1"  onkeypress="only_number_english()" onkeyup="checkThousand(this.value, '1','Y')">
															</td>
															<td rowspan="2">
																<input name="image" type="image" src="images/login_bt.gif" style="border:0;margin:0 8px 0 0;">
																<a href="4insure_popup.php" onclick="window.open(this.href, '4insure_popup', 'height=780,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');return false;" onfocus='this.blur();'><img src="images/btn_01.gif" border="0"></a>
															</td>
														</tr>
														<tr>
															<td style="padding:0 7px 0 10px;"><img src="images/pw.gif"></td>
															<td><input type="password" name="mb_password" id="login_mb_password" class="input1" value="" size="20" maxlength="25" tabindex="2"></td>
														</tr>
														<tr>
															<td></td>
															<td height="25" align="right" style="padding:0 6px 0 0"><input type="checkbox" name="id_save" value="Y" onclick="setValue()" style="border:0;margin: 0 0; vertical-align: middle;"><img src="images/id_save.gif" style="margin: 6px 0; vertical-align: middle;"></td>
															<td align="right"><label onclick="privacy_information('./privacy_information/');" style="cursor:pointer"><img src="images/btn_agree.gif" border="0"></label></td>
														</tr>
														<tr>
															<td></td>
															<td height="36"></td>
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
						<div style="margin:5px 0 0 148px;width:616px;text-align:right"><img src="images/login_tel.gif" style="margin:0 60px 0 0"></div>
					</td>
				</tr>
			</table></td>
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
<?
$rs['po_id'] = 1;
if(isset($_COOKIE["it_ck_pop_".$rs['po_id']])) {
	if (trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
		//팝업1 좌표
		$pop_left = 50;
		$pop_top = 129;
?>
<style type="text/css">
#pop1 {
	position:absolute;
	z-index:100;
	left:<?=$pop_left?>px;
	top:<?=$pop_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:440px;
}
.clsDrag {
	position:relative;
}
</style>
<!--강제 팝업 숨김 display:none-->
<div id="pop1" class="clsDrag" style="display:none">
	<table width="440" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td style="">
				<!--<img src="popup/images/system_check_kidsnomu.gif">-->
				<!--<a href="javascript:total_pay_popup('total_pay_popup.php');"><img src="popup/images/total_pay_popup.gif" align="top" alt="" border="0" align="absmiddle"></a>-->
				<img src="popup/images/home_open_popup.jpg" align="top" alt="" border="0" align="absmiddle" usemap="#home_open_popup.jpg" style="border: 0;" />
				<map name="home_open_popup.jpg">
					<area shape="rect" coords="102,455,335,480" href="/kidsnomu_home/" target="_blank" alt="" />
				</map>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours1" name="expirehours1" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(1)">24시간 동안 이 창을 다시 열지 않음</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop1').style.display='none';return false;">닫기</a></div>
		</div>
	</div>
</div>
<script type="text/JavaScript">
var x, y;
var objDoc;
var objIE = document.all;
var objOtherBrowsers = document.getElementById && !document.all;
var blIsDrag = false;
function fnMoveMouse(e) {
	if (blIsDrag)
	{
		objDoc.style.left = objOtherBrowsers ? intLeftX + e.clientX - x : intLeftX + event.clientX - x;
		objDoc.style.top  = objOtherBrowsers ? intTopY  + e.clientY - y : intTopY  + event.clientY - y;

		return false;
	}
}
function fnSelectMouse(e) {
	var objF = document.getElementById('pop1');
	blIsDrag = true;
	objDoc = objF;
	intLeftX = parseInt(objDoc.style.left + <?=$pop_left?>, 10);
	intTopY = parseInt(objDoc.style.top + <?=$pop_top?>, 10);
	x = objOtherBrowsers ? e.clientX : event.clientX;
	y = objOtherBrowsers ? e.clientY : event.clientY;
	document.onmousemove = fnMoveMouse;
	return false;
}

// 쿠키 입력
function set_cookie(name, value, expirehours, domain) 
{
		var today = new Date();
		today.setTime(today.getTime() + (60*60*1000*expirehours));
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
		if (domain) {
				document.cookie += "domain=" + domain + ";";
		}
}
// 쿠키 얻음
function get_cookie(name) 
{
		var find_sw = false;
		var start, end;
		var i = 0;
		for (i=0; i<= document.cookie.length; i++)
		{
				start = i;
				end = start + name.length;
				if(document.cookie.substring(start, end) == name) 
				{
						find_sw = true
						break
				}
		}
		if (find_sw == true) 
		{
				start = end + 1;
				end = document.cookie.indexOf(";", start);
				if(end < start)
						end = document.cookie.length;
				return document.cookie.substring(start, end);
		}
		return "";
}
// 쿠키 지움
function delete_cookie(name) 
{
		var today = new Date();
		today.setTime(today.getTime() - 1);
		var value = get_cookie(name);
		if(value != "")
				document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

function layer_close(id) {
	var obj = document.getElementById("expirehours"+ id);
	if (obj.checked == true) {
		set_cookie("it_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	document.getElementById("pop"+id).style.display = "none";
	selectbox_visible();
}

function selectbox_hidden(layer_id) 
{ 
		var ly = eval(layer_id); 
		// 레이어 좌표 
		var ly_left  = ly.offsetLeft; 
		var ly_top    = ly.offsetTop; 
		var ly_right  = ly.offsetLeft + ly.offsetWidth; 
		var ly_bottom = ly.offsetTop + ly.offsetHeight; 
		// 셀렉트박스의 좌표 
		var el; 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one") { 
								var el_left = el_top = 0; 
								var obj = el; 
								if (obj.offsetParent) { 
										while (obj.offsetParent) { 
												el_left += obj.offsetLeft; 
												el_top  += obj.offsetTop; 
												obj = obj.offsetParent; 
										} 
								} 
								el_left  += el.clientLeft; 
								el_top    += el.clientTop; 
								el_right  = el_left + el.clientWidth; 
								el_bottom = el_top + el.clientHeight; 
								// 좌표를 따져 레이어가 셀렉트 박스를 침범했으면 셀렉트 박스를 hidden 시킴 
								if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
										(el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || 
										(el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || 
										(el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ) 
										el.style.visibility = 'hidden'; 
						} 
				} 
		} 
} 
// 감추어진 셀렉트 박스를 모두 보이게 함 
function selectbox_visible() 
{ 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one" && el.style.visibility == 'hidden') 
								el.style.visibility = 'visible'; 
				} 
		} 
}
//팝업셋팅
//document.getElementById('pop1').style.display = "none";
//document.getElementById('pop1').style.display = "block";
//fnSelectMouse();
//selectbox_hidden("pop1");
//selectbox_visible("pop1");
//팝업드래그
function fnSelectMouse_drag() {
	document.onmousedown = fnSelectMouse;
	document.onmouseup = new Function("blIsDrag = false");
}
// onload 2개 이상 선언 가능 함수
function addLoadEvent(func) {
    var oldonload = window.onload;
        if(typeof window.onload != 'function') {
            window.onload = func;
        } else {
            window.onload = function() {
                oldonload();
                func();
        }
    }
}
//addLoadEvent(fnSelectMouse);
//addLoadEvent(fnSelectMouse_drag);
</script>
<?
	}
}
?>

</body>
</html>