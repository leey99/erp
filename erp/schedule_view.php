<?
$sub_menu = "2000100";
/*
//W3C Markup 검사 서비스 로그인 상태
$mb['mb_id'] = "kcmc2006";
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common_erp.php");
set_session('erp_mb_id', $mb['mb_id']);
$member['mb_name'] = "이영래";
*/
//공통 변수 로딩
include_once("./_common.php");
$sql_common = " from erp_visit a ";
//로그인 지사 code
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.id='$id' ";

if(!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top20_00.gif";
$sub_title = "방문스케줄등록";
$g4['title'] = $sub_title." : 스케줄 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
}
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_man_cust_name=".$stx_man_cust_name;
$qstr .= "&stx_process=".$stx_process."&stx_joindt=".$stx_joindt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkID() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "") {
		alert("사업자번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function new_client_register() {
	var frm = document.dataForm;
	if(frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("이미 등록된 사업자번호입니다. 확인 후 등록 바랍니다.");
		frm.comp_bznb.focus();
		return;
	}
	getId('btn_new_client_register').style.display = "none";
	frm.action = "schedule_client_register.php";
	frm.submit();
	return;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.manage_cust_name.value == "") {
		alert("담당자를 입력하세요.");
		frm.manage_cust_name.focus();
		return;
	}
	if(frm.com_name.value == "") {
		alert("사업장명을 입력하세요.");
		frm.com_name.focus();
		return;
	}
	if(frm.regdt.value == "") {
		alert("등록일자를 입력하세요.");
		frm.regdt.focus();
		return;
	}
	if(frm.boss_name.value == "") {
		alert("대표자명을 입력하세요.");
		frm.boss_name.focus();
		return;
	}
	if(frm.upjong.value == "") {
		alert("업종을 입력하세요.");
		frm.upjong.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("이미 등록된 사업자번호입니다. 확인 후 등록 바랍니다.");
		frm.comp_bznb.focus();
		return;
	}
	if(frm.com_tel1.value == "") {
		alert("전화번호를 입력하세요.");
		frm.com_tel1.focus();
		return;
	}
	if(frm.com_tel2.value == "") {
		alert("전화번호를 입력하세요.");
		frm.com_tel2.focus();
		return;
	}
	if(frm.com_tel3.value == "") {
		alert("전화번호를 입력하세요.");
		frm.com_tel3.focus();
		return;
	}
	if(frm.visitdt.value == "") {
		alert("방문예정일자를 입력하세요.");
		frm.visitdt.focus();
		return;
	}
	if(frm.adr_adr1.value == "") {
		alert("주소를 입력하세요.");
		frm.adr_adr1.focus();
		return;
	}
	frm.action = "schedule_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t) {
	var count=0;
	for(i=0;i<x.length;i++) {
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" 선택해 주세요.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
function only_number() {
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//hyphen 109 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//comma 110 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 110 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delhyphen(inputVal, inputVal.length);
	if(event.keyCode != 8) {
		if(inputVal.length == 3){
			total += input.substring(0,3)+"-";
		} else if(inputVal.length == 6){
			total += inputVal.substring(0,8)+"-";
		} else if(inputVal.length == 12){
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y') {
			if(type =='1') {
				main.comp_bznb.value = total;
			}
			else if(type =='2') {
				main.user_id.value = total;
			}
		}else if(keydown =='N') {
			return total;
		}
	}
	return total;
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='-') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
}
//날짜 입력 콤마
function checkcomma(inputVal, type, keydown) {
	var main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple = 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delcomma(inputVal, inputVal.length);
	if(event.keyCode != 8) {
		//alert(inputVal.length);
		//alert(input);
		if(inputVal.length == 4){
			//input = delhyphen(inputVal, inputVal.length);
			total += input.substring(0,4)+".";
		} else if(inputVal.length == 7){
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12){
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			type.value=total;
		}else if(keydown =='N'){
			return total
		}
	}
	return total;
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function pay_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.pay_day.value != "") main.pay_day_old.value = main.pay_day.value;
		main.pay_day.value = "";
	} else {
		//alert(main.pay_day_old.value);
		main.pay_day.value = main.pay_day_old.value;
	}
}
//법인등록번호 입력 하이픈
function checkhyphen_bupin_no(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
	if(1 == 1) { //모두 포함
		//백스페이스키 적용
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
				else if ( type =='2' ) {
					main.jumin_no.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//천단위 콤바
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//탭 시프트+탭 좌 우 Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	if(v2.style.display == "none") {
		v2.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
			} else {
				alert("최대 8개까지 추가 가능합니다.");
			}
		}
	}
}
//iframe resize
function resizeFrame(frm) {
 frm.style.height = "auto";
 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
 frm.style.height = contentHeight + 0 + "px";
}
//]]>
</script>
<script type="text/javascript" src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2,zip) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					if(data.postcode1) {
						frm[zip1].value = data.postcode1;
						frm[zip2].value = data.postcode2;
					}
					if(data.userSelectedType === 'R') frm[addr1].value = data.address
					else frm[addr1].value = data.jibunAddress;;
					frm[zip].value = data.zonecode;
					frm[addr2].focus();
			}
	}).open();
}
function openDaumPostcode_new(zip,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip].value = data.zonecode;
					frm[addr1].value = data.roadAddress;
					frm[addr2].focus();
			}
	}).open();
}
//출력
function pagePrint(Obj, orientation_var) {  
  var W = 920;        //screen.availWidth;  
  var H = 600;       //screen.availHeight; 
 
  var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0";  
  var PrintPage = window.open("about:blank",Obj.id,features);  
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.') \nelse \nalert('정상적으로 설치되었습니다.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('에러 코드: ' + ErrCode + '\n에러 메시지: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '굴림', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  인쇄 여백제어 컨트롤이 설치되지 않았습니다.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:1004px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// 세로출력
	PrintPage.IEPageSetupX.Orientation = orientation_var;
	PrintPage.IEPageSetupX.PrintBackground = true;
	PrintPage.IEPageSetupX.ShrinkToFit = true;
	// 인쇄미리보기
	PrintPage.IEPageSetupX.Preview();
}
function Installed() {
	try 
	{ 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} 
	catch (e) 
	{ 
		return false; 
	} 
} 
function PrintTest() {
	if (!Installed()) 
		alert("컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.") 
	else 
		alert("정상적으로 설치되었습니다."); 
}
function printsetup() {
	IEPageSetupX.header = ""; // 헤더설정 
	IEPageSetupX.footer = ""; // 푸터설정 
	IEPageSetupX.leftMargin = 10; // 왼쪽여백설정 
	IEPageSetupX.rightMargin = 10; // 오른쪽여백 설정 
	IEPageSetupX.topMargin = 20; // 윗쪽여백 설정 
	IEPageSetupX.bottomMargin = 10; // 아랫쪽 여백설정 
	IEPageSetupX.PrintBackground = true; // 배경색 및 이미지 인쇄 
	IEPageSetupX.Orientation = 1; // 가로 출력을 원하시면 0을 넣으면 됩니다. 세로출력은 1입니다. 
	IEPageSetupX.PaperSize = 'A4'; // 용지설정입니다. 
}
//사업자등록번호 중복 확인
function getCont( id, code ) {
	var frm = document.dataForm;
	//alert(id);
	var xmlhttp = fncGetXMLHttpRequest();
	// 아이디를 체크할 php 페이지에 체크 하려하는 id 값을 파라미터로 넘겨 줍니다.
	xmlhttp.open('POST', 'ajax_check_bizno_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		//alert(xmlhttp.readyState);
		//alert(xmlhttp.status);
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("페이지 오류 : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst');
				//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "이미 등록된 사업장입니다.<br />(본사문의요망)";
					frm.rst_chk.value = "y";
				} else {
					dp.innerHTML = "";
					frm.rst_chk.value = "";
				}
			}
		}
	}
	xmlhttp.send();
}
//Ajax 함수
function fncGetXMLHttpRequest() {
	if(window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		}	catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) {
				return null;
			}
		}
		//IE 외 파이어폭스 오페라 같은 브라우저에서 XMLHttpRequest 객체 구하기
	} else if(window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}
//삭제
function del_schedule(page, id) {
	if(confirm("삭제 하시겠습니까?")) {
		location.href = "schedule_delete.php?page="+page+"&id="+id;
	}
}
//]]>
</script>
<?
include "inc/top.php";
//권한별 링크값 : 전체 권한
if($member['mb_level'] == 0) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$url_list = "./list_notice.php?bo_table=erp_visit";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top20.gif" border="0" alt="스케줄" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="방문스케줄등록" /></a></td>
						<td>
<?
$title_main_no = "20";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA" action="schedule_update.php">
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="com_code" value="<?=$row['com_code']?>" />
								<!--입력폼-->
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="background:url('images/g_tab_on_bg.gif');width:90px;text-align:center;"> 
														기본정보
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="2"></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;width:100%;height:200px;">
									<tr>
										<td class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />등록자<font color="red">*</font></td>
										<td class="tdrow" width="178">
<?
if($row['damdang_code']) {
	$damdang_code = $row['damdang_code'];
} else {
	$damdang_code = $stx_man_cust_name;
}
$damdang_code_no = $damdang_code;
if(!$w) {
	$mb_id = $member['mb_id'];
	$sql_manage = " select * from a4_manage where user_id='$mb_id' and state='1' ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	$row_manage = mysql_fetch_array($result_manage);
	$row['writer'] = $row_manage['code'];
	$row['writer_name'] = $row_manage['name'];
}
//관리자 본사 설정
if($member['mb_id'] == "master") $damdang_code_no = 1;
?>
											<input type="hidden" name="damdang_code" value="<?=$damdang_code?>" />
											<input type="text" name="manage_cust_numb" class="textfm" style="width:34px" readonly value="<?=$row['writer']?>">
											<input type="text" name="manage_cust_name" class="textfm" style="width:82px" readonly value="<?=$row['writer_name']?>">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,1);" target="">검색</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk" width="104"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />사업장명<font color="red">*</font></td>
										<td class="tdrow" width="202">
											<input name="com_name" type="text" class="textfm" style="width:97%;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50" />
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />전화번호<font color="red">*</font></td>
										<td class="tdrow">
<?
$com_tel = explode("-",$row['com_tel']);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
											<select name="com_tel1" class="selectfm">
												<option value="">선택</option>
												<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
												<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
												<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
												<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
												<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
												<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
												<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
												<option value="044" <?=$sel_cust_tel1['044']?>>044</option>
												<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
												<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
												<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
												<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
												<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
												<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
												<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
												<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
												<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
												<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
												<option value="000" <?=$sel_cust_tel1['000']?>>빈칸</option>
												<option value="010" <?=$sel_cust_tel1['010']?>>010</option>
												<option value="011" <?=$sel_cust_tel1['011']?>>011</option>
												<option value="016" <?=$sel_cust_tel1['016']?>>016</option>
												<option value="017" <?=$sel_cust_tel1['017']?>>017</option>
												<option value="018" <?=$sel_cust_tel1['018']?>>018</option>
												<option value="019" <?=$sel_cust_tel1['019']?>>019</option>
											</select>
											-
											<input name="com_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onkeypress="onlyNumber();" />
											-
											<input name="com_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onkeypress="onlyNumber();" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />등록일자<font color="red">*</font></td>
										<td class="tdrow" width="">
											<input name="regdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['regdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border='0' cellpadding='0' cellspacing='0' style="vertical-align:middle;display:inline;"><tr><td width='2'></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td class="ftbutton3_white" style="background:url('./images/btn2_bg.gif');"><a href="javascript:loadCalendar(document.dataForm.regdt);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />대표자명<font color="red">*</font></td>
										<td class="tdrow">
											<input name="boss_name" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />휴대전화<font color="red"></font></td>
										<td class="tdrow">
<?
$cust_cel = explode("-",$row['com_hp']);
$cust_cel1 = $cust_cel[0];
//echo $cust_cel1;
$sel_cust_cel1 = array();
$sel_cust_cel1[$cust_cel1] = "selected";
//echo $sel_cust_cel1[$cust_cel1];
$cust_cel2 = $cust_cel[1];
$cust_cel3 = $cust_cel[2];
?>
											<select name="cust_cel1" class="selectfm">
												<option value="">선택</option>
												<option value="010" <?=$sel_cust_cel1['010']?>>010</option>
												<option value="011" <?=$sel_cust_cel1['011']?>>011</option>
												<option value="016" <?=$sel_cust_cel1['016']?>>016</option>
												<option value="017" <?=$sel_cust_cel1['017']?>>017</option>
												<option value="018" <?=$sel_cust_cel1['018']?>>018</option>
												<option value="019" <?=$sel_cust_cel1['019']?>>019</option>
												<option value="070" <?=$sel_cust_cel1['070']?>>070</option>
											</select>
											-
											<input name="cust_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onkeypress="onlyNumber();" />
											-
											<input name="cust_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onkeypress="onlyNumber();" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />업종<font color="red">*</font></td>
										<td class="tdrow">
											<input name="upjong" type="text" class="textfm" style="width:97%;" value="<?=$row['upjong']?>" maxlength="12" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />사업자등록번호</td>
										<td class="tdrow">
											<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['comp_bznb']?>" maxlength="12"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')" onblur="getCont(this.value, '<?=$row['com_code']?>');" />
											<div id='rst' style="color:red;"></div>
											<input type="hidden" name="rst_chk" value="" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />팩스번호<font color="red"></font></td>
										<td class="tdrow">
<?
$com_fax = explode("-",$row['com_fax']);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
?>
											<select name="cust_fax1" class="selectfm">
												<option value="">선택</option>
												<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
												<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
												<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
												<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
												<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
												<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
												<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
												<option value="044" <?=$sel_cust_fax1['044']?>>044</option>
												<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
												<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
												<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
												<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
												<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
												<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
												<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
												<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
												<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
												<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
												<option value="0303" <?=$sel_cust_fax1['0303']?>>0303</option>
												<option value="0502" <?=$sel_cust_fax1['0502']?>>0502</option>
												<option value="0505" <?=$sel_cust_fax1['0505']?>>0505</option>
												<option value="0507" <?=$sel_cust_fax1['0507']?>>0507</option>
											</select>
											-
											<input name="cust_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
											-
											<input name="cust_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />방문일자<font color="red">*</font></td>
										<td class="tdrow">
											<input name="visitdt" type="text" class="textfm" style="width:78px;ime-mode:disabled;" value="<?=$row['visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;display:inline;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.visitdt);">달력</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
$visitdt_time = $row['visitdt_time'];
$sel_visitdt_time = array();
$sel_visitdt_time[$visitdt_time] = "selected";
?>
											<select name="visitdt_time" class="selectfm">
												<option value="">선택</option>
												<option value="오전" <?=$sel_visitdt_time['오전']?>>오전</option>
												<option value="오후" <?=$sel_visitdt_time['오후']?>>오후</option>
											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />처리현황<font color="red"></font></td>
										<td class="tdrow">
<?
$sel_check_ok = array();
$check_ok_id = $row['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
											<select name="check_ok" class="selectfm">
												<option value="">선택</option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$job_time_process_arry[9]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$job_time_process_arry[10]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$job_time_process_arry[8]?></option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$job_time_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$job_time_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$job_time_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$job_time_process_arry[4]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$job_time_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$job_time_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$job_time_process_arry[5]?></option>
											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />담당자</td>
										<td class="tdrow">
											<input type="text" name="manager_code" class="textfm" style="width:34px;float:left;" readonly value="<?=$row['manager']?>">
											<input type="text" name="manager_name" class="textfm" style="width:66px;float:left;" readonly value="<?=$row['manager_name']?>">
											<table border="0" cellpadding="0" cellspacing="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,2);" target="">검색</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />주소<font color="red">*</font></td>
										<td class="tdrow" colspan="5">
<?
$adr_zip = explode("-",$row['com_postno']);
$new_zip = $row['new_postno'];
?>
												<input name="new_zip" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$new_zip?>" maxlength="5" />
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2','new_zip');" target="">주소찾기</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												(구)우편번호
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$adr_zip[0]?>" maxlength="3" />
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$adr_zip[1]?>" maxlength="3" />
												<br>
												<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso']?>" maxlength="150" />
												<br>
												<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso2']?>" maxlength="150" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />상담메모</td>
										<td class="tdrow" colspan="5">
											<textarea name="memo" class="textfm" style='width:99%;height:200px;word-break:break-all;' rows="7" cols=""><?=$row[memo]?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:20px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0" align="center">
									<tr>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="<?=$url_save?>">저 장</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="#del_schedule" onclick="del_schedule('<?=$page?>', '<?=$id?>');" onkeypress="this.onclick();">삭 제</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="list_notice.php?bo_table=erp_visit">스케줄</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
<?
//거래처 정보 등록 여부
if($row['com_code']) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$row['com_code']?>" target="">거래처정보</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//거래처 정보 등록 여부 : 미등록 시 거래처 등록 버튼 표시 150729
if($w == "u" && !$row['com_code']) {
?>
								<div style="height:30px;font-size:0px;text-align:center;margin-top:10px;" id="btn_new_client_register">
									<span onclick="new_client_register();" style="cursor:pointer;"><img src="images/btn_new_client_register.png" width="111" height="30" border="0" /></span>
								</div>
<?
}
?>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
							</form>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
