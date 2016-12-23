<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from shipbuilding_gy a, shipbuilding_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";

if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top14_01.gif";
$sub_title = "조선인력관리";
$g4[title] = $sub_title." : 조선인력 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//사업장DB 옵션
	$sql1 = " select * from shipbuilding_gy_opt where com_code='$com_code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
}
//echo $row[com_code];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_attend=".$stx_attend;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function checkID()
{
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
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
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.regdt.value == "")
	{
		alert("등록일자를 입력하세요.");
		frm.regdt.focus();
		return;
	}
	if (frm.com_name.value == "")
	{
		alert("이름을 입력하세요.");
		frm.com_name.focus();
		return;
	}
/*
	if (frm.age.value == "")
	{
		alert("나이를 입력하세요.");
		frm.age.focus();
		return;
	}
*/
	if (frm.com_tel1.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel1.focus();
		return;
	}
	if (frm.com_tel2.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel2.focus();
		return;
	}
	if (frm.com_tel3.value == "")
	{
		alert("전화번호를 입력하세요.");
		frm.com_tel3.focus();
		return;
	}
	frm.action = "shipbuilding_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
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
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
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
					main.comp_bznb.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
				else if ( type =='2' ) {
					main.user_id.value=total;					// type 에 따라 최종값을 넣어 준다.
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
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { // 모두 포함
		//백스페이스키 적용
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
		return total
	}
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
					main.cust_ssnb.value=total;					// type 에 따라 최종값을 넣어 준다.
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
function writer_onchange(obj) {
	var main = document.dataForm;
	if(obj.value == 1) main.writer_tel.value = "070-4680-7040";
	else if(obj.value == 2) main.writer_tel.value = "070-4680-0498";
	else if(obj.value == 3) main.writer_tel.value = "070-4680-7041";
	else if(obj.value == 4) main.writer_tel.value = "070-4680-1289";
}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top14.gif" border="0"></td>
									<td width="130"><img src="<?=$top_sub_title?>" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>
							<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--타이틀 -->	

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0 style=""> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												인력 기본정보
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
							<input type="hidden" name="w" value="<?=$w?>">
							<!-- 입력폼 -->
							<table width="100%" height="200" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<tr>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최초통화자<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="250">
										<select name="writer" class="selectfm" onchange="writer_onchange(this)">
											<option value="">선택</option>
											<option value="1" <? if($row['writer'] == 1) echo "selected"; ?>><?=$writer_arry[1]?></option>
											<option value="2" <? if($row['writer'] == 2) echo "selected"; ?>><?=$writer_arry[2]?></option>
											<option value="3" <? if($row['writer'] == 3) echo "selected"; ?>><?=$writer_arry[3]?></option>
											<option value="4" <? if($row['writer'] == 4) echo "selected"; ?>><?=$writer_arry[4]?></option>
										</select>
										<input name="writer_tel" type="text" class="textfm5" style="width:100px;ime-mode:disabled;" value="<?=$row['writer_tel']?>" maxlength="10" onKeyPress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk" width="96"><? if($member['mb_id'] == "master" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1289") echo "<img src='./images/icon_02.gif' width='2' height='2' style='margin:0 5px 3px 0'>열람제한"; ?></td>
									<td nowrap  class="tdrow" width="">
<?
if($member['mb_id'] == "master" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1289") {
?>
										<input type="checkbox" name="view_restrict" value="1" class="textfm" <? if($row['view_restrict'] == "1") echo "checked"; ?> onclick="" style="vertical-align:middle">열람제한
<?
} else {
?>
										<input type="hidden" name="view_restrict" value="<?$row['view_restrict']?>">
<?
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">등록일자<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="250">
										<input name="regdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['regdt']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border='0' cellpadding='0' cellspacing='0' style="vertical-align:middle;display:inline;"><tr><td width='2'></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.regdt);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이름<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="">
										<input name="com_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">나이<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input name="age" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['age']?>" maxlength="12" onkeypress="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
$com_tel = explode("-",$row[com_tel]);
$com_tel1 = $com_tel[0];
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
										<input name="com_tel1" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel1?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="com_tel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="com_tel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역</td>
									<td nowrap  class="tdrow">
										<input name="area" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[area]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재통화</td>
									<td nowrap  class="tdrow">
										<input name="teldt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row[teldt]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.teldt);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">내용</td>
									<td nowrap  class="tdrow" colspan="3">
										<textarea name="memo" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="내용" required><?=$row[memo]?></textarea>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">건강검진</td>
									<td nowrap  class="tdrow">
										<input name="check" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[check_health]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">희망직종</td>
									<td nowrap  class="tdrow">
										<input name="type" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[type]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">경력유무</td>
									<td nowrap  class="tdrow">
										<input name="career" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[career]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이동수단</td>
									<td nowrap class="tdrow">
										<input name="vehicle" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[vehicle]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">출발일시</td>
									<td nowrap  class="tdrow">
										<input name="start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row[start_date]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.start);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<select name="start_hour" class="selectfm">
											<option value=""></option>
											<?
											$start_time = explode(":",$row[start_time]);
											for($i=0;$i<24;$i++) {
												if($i<10) $k = "0".$i;
												else $k = $i;
												if($i==$start_time[0]) $selected_start_hour[$i] = "selected";
												else $selected_start_hour[$i] = "";
											?>
											<option value="<?=$k?>" <?=$selected_start_hour[$i]?> ><?=$i?></option>
											<?
											}
											?>
										</select> :
										<select name="start_min" class="selectfm">
											<option value=""></option>
											<?
											for($i=0;$i<=50;$i+=10) {
												if($i<10) $k = "0".$i;
												else $k = $i;
												if($i==$start_time[1]) $selected_start_min[$i] = "selected";
												else $selected_start_min[$i] = "";
											?>
											<option value="<?=$k?>" <?=$selected_start_min[$i]?> ><?=$i?></option>
											<?
											}
											?>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">도착일시</td>
									<td nowrap class="tdrow">
										<input name="arrival" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row[arrival]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.arrival);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<select name="arrival_hour" class="selectfm">
											<?
											$arrival_time = explode(":",$row[arrival_time]);
											for($i=0;$i<24;$i++) {
												if($i<10) $k = "0".$i;
												else $k = $i;
												if($i==$arrival_time[0]) $selected_arrival_hour[$i] = "selected";
												else $selected_arrival_hour[$i] = "";
											?>
											<option value="<?=$k?>" <?=$selected_arrival_hour[$i]?> ><?=$i?></option>
											<?
											}
											?>
										</select> :
										<select name="arrival_min" class="selectfm">
											<?
											for($i=0;$i<=50;$i+=10) {
												if($i<10) $k = "0".$i;
												else $k = $i;
												if($i==$arrival_time[1]) $selected_arrival_min[$i] = "selected";
												else $selected_arrival_min[$i] = "";
											?>
											<option value="<?=$k?>" <?=$selected_arrival_min[$i]?> ><?=$i?></option>
											<?
											}
											?>
										</select>
									</td>
								</tr>
							</table>

							<div style="height:10px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													인력 추가정보
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

							<!-- 입력폼 -->
							<table width="100%" height="100" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">확인체크<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
$sel_check_ok = array();
$check_ok_id = $row['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
										<select name="check_ok" class="selectfm">
											<option value="">미확인</option>
											<option value="1" <?=$sel_check_ok['1']?>>긴급통화</option>
											<option value="2" <?=$sel_check_ok['2']?>>2시간이내</option>
											<option value="3" <?=$sel_check_ok['3']?>>금일통화</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">안전교육일정<font color="red"></font></td>
									<td nowrap  class="tdrow" width="250">
										<input name="safe" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[safe]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.safe);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">출근여부<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
$sel_attend = array();
$attend_id = $row['attend'];
$sel_attend[$attend_id] = "selected";
?>
										<select name="attend" class="selectfm">
											<option value="">선택</option>
											<option value="1" <?=$sel_attend['1']?>>출근</option>
											<option value="2" <?=$sel_attend['2']?>>미출근</option>
											<option value="3" <?=$sel_attend['3']?>>보류</option>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">출근일자</td>
									<td nowrap  class="tdrow">
										<input name="attend_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[attend_date]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.attend_date);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">퇴사일자</td>
									<td nowrap  class="tdrow">
										<input name="retire" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[retire]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.retire);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사유<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input name="reason" type="text" class="textfm" style="width:350px;ime-mode:active;" value="<?=$row1[reason]?>" maxlength="100">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기타</td>
									<td nowrap  class="tdrow" colspan="3">
										<input name="etc" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row1[etc]?>" maxlength="100">
									</td>
								</tr>
							</table>


							<div style="height:20px;font-size:0px"></div>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
//권한별 링크값
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./shipbuilding_list.php?page=<?=$page?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							<input type="hidden" name="url" value="./shipbilding_view.php">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="page" value="<?=$page?>">
							</form>
							<!--댑메뉴 -->
							<!-- 입력폼 -->
						</div>
					</td>
				</tr>
			</table>


									</td>
								</tr>
							</table>
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
