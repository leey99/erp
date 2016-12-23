<?
$sub_menu = "1500100";
include_once("./_common.php");

$sql_common = " from policy_fund a, policy_fund_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.id=b.id and a.id='$id' ";

if (!$sst) {
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
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top15_01.gif";
$sub_title = "정책자금의뢰";
$g4[title] = $sub_title." : 정책자금 : ".$easynomu_name;

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
	//사업장DB 옵션
	$sql_opt = " select * from policy_fund_opt where id='$id' ";
	//echo $sql1;
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
}
//echo $row[id];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_attend=".$stx_attend;
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
	if (frm.writer.value == "")
	{
		alert("최초통화자를 입력하세요.");
		frm.writer.focus();
		return;
	}
	if (frm.com_name.value == "")
	{
		alert("상호를 입력하세요.");
		frm.com_name.focus();
		return;
	}
	if (frm.regdt.value == "")
	{
		alert("등록일자를 입력하세요.");
		frm.regdt.focus();
		return;
	}
	if (frm.boss_name.value == "")
	{
		alert("대표자명을 입력하세요.");
		frm.boss_name.focus();
		return;
	}
	if (frm.upjong.value == "")
	{
		alert("업종을 입력하세요.");
		frm.upjong.focus();
		return;
	}
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
/*
	if (frm.cust_cel1.value == "")
	{
		alert("핸드폰을 입력하세요.");
		frm.cust_cel1.focus();
		return;
	}
	if (frm.cust_cel2.value == "")
	{
		alert("핸드폰을 입력하세요.");
		frm.cust_cel2.focus();
		return;
	}
	if (frm.cust_cel3.value == "")
	{
		alert("핸드폰을 입력하세요.");
		frm.cust_cel3.focus();
		return;
	}
*/
	if (frm.adr_zip1.value == "") {
		alert("주소를 입력하세요.");
		return;
	}
	frm.action = "policy_fund_update.php";
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
function writer_onchange(obj) {
	var main = document.dataForm;
	if(obj.value == 1) main.writer_tel.value = "070-4680-7041";
	else if(obj.value == 2) main.writer_tel.value = "070-4680-0331";
	else if(obj.value == 3) main.writer_tel.value = "051-921-5255";
	else if(obj.value == 4) main.writer_tel.value = "055-388-8805";
	else if(obj.value == 5) main.writer_tel.value = "063-461-4747";
	else if(obj.value == 6) main.writer_tel.value = "053-292-4117";
	//정경용
	else if(obj.value == 110) main.writer_tel.value = "070-4680-7041";
	//임영진
	else if(obj.value == 122) main.writer_tel.value = "070-4808-0331";
	//최동환
	else if(obj.value == 2001) main.writer_tel.value = "051-921-5255";
	//황희경
	else if(obj.value == 2002) main.writer_tel.value = "051-921-5255";
	//양국일
	else if(obj.value == 3501) main.writer_tel.value = "055-388-8805";
	//박정민
	else if(obj.value == 3601) main.writer_tel.value = "063-461-4747";
	//엄희철
	else if(obj.value == 1001) main.writer_tel.value = "053-292-4117";
	//노우석
	else if(obj.value == 25) main.writer_tel.value = "070-7405-2661";
	//이민주
	else if(obj.value == 1602) main.writer_tel.value = "010-3116-3124";
	//김관수
	else if(obj.value == 2301) main.writer_tel.value = "055-245-0337";
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
</script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script>
	function openDaumPostcode(zip1,zip2,addr1,addr2) {
    new daum.Postcode({
        oncomplete: function(data) {
            frm = document.dataForm;
						frm[zip1].value = data.postcode1;
						frm[zip2].value = data.postcode2;
						frm[addr1].value = data.address;
						frm[addr2].focus();
        }
    }).open();
	}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top15.gif" border="0"></td>
									<td width=""><img src="<?=$top_sub_title?>" border="0"></td>
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
												사업장 기본정보
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
							<input type="hidden" name="com_code" value="<?=$row['com_code']?>">
							<!-- 입력폼 -->
							<table width="100%" height="200" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<tr>
									<td nowrap class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최초통화자<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="176">
										<select name="writer" class="selectfm" onchange="writer_onchange(this)">
											<option value="">선택</option>
											<option value="110" <? if($row['writer'] == 110) echo "selected"; ?>><?=$writer_arry_policy[110]?></option>
											<option value="122" <? if($row['writer'] == 122) echo "selected"; ?>><?=$writer_arry_policy[122]?></option>
											<option value="2002" <? if($row['writer'] == 2002) echo "selected"; ?>><?=$writer_arry_policy[2002]?></option>
											<option value="3501" <? if($row['writer'] == 3501) echo "selected"; ?>><?=$writer_arry_policy[3501]?></option>
											<option value="3601" <? if($row['writer'] == 3601) echo "selected"; ?>><?=$writer_arry_policy[3601]?></option>
											<option value="1001" <? if($row['writer'] == 1001) echo "selected"; ?>><?=$writer_arry_policy[1001]?></option>
											<option value="25" <? if($row['writer'] == 25) echo "selected"; ?>><?=$writer_arry_policy[25]?></option>
											<option value="1602" <? if($row['writer'] == 1602) echo "selected"; ?>><?=$writer_arry_policy[1602]?></option>
											<option value="2301" <? if($row['writer'] == 2301) echo "selected"; ?>><?=$writer_arry_policy[2301]?></option>
										</select>
										<input name="writer_tel" type="text" class="textfm5" style="width:94px;ime-mode:disabled;" value="<?=$row['writer_tel']?>" maxlength="10" onKeyPress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="210">
										<input name="com_name" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기업형태<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
if($row['upche_div'] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "개인";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "법인";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "유한";
}
?>
										<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>개인
										<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>법인
										<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?>>유한
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">등록일자<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="">
										<input name="regdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['regdt']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border='0' cellpadding='0' cellspacing='0' style="vertical-align:middle;display:inline;"><tr><td width='2'></td><td><img src=./images/btn2_lt.gif></td><td background="./images/btn2_bg.gif" class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.regdt);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="boss_name" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주민등록번호</td>
									<td nowrap class="tdrow">
										<input name="jumin_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['jumin_no']?>" maxlength="14"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="upjong" type="text" class="textfm" style="width:100%;" value="<?=$row['upjong']?>" maxlength="12" onkeypress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
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
										<input name="com_tel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="com_tel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">핸드폰<font color="red"></font></td>
									<td nowrap  class="tdrow">
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
										<input name="cust_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="cust_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소<font color="red">*</font></td>
									<td nowrap  class="tdrow" rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
?>
										<input name="adr_zip1" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[0]?>" >
										-
										<input name="adr_zip2" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[1]?>" >
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="adr_adr1" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso']?>" >
										<br>
										<input name="adr_adr2" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso2']?>" maxlength="150">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역</td>
									<td nowrap  class="tdrow">
										<input name="area" type="text" class="textfm" style="width:120px;" value="<?=$row[area]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장등록증</td>
									<td nowrap  class="tdrow">
										<select name="reg_factory" class="selectfm" onchange="">
											<option value="">선택</option>
											<option value="1" <? if($row['reg_factory'] == 1) echo "selected"; ?>>유</option>
											<option value="2" <? if($row['reg_factory'] == 2) echo "selected"; ?>>무</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신용등급</td>
									<td nowrap  class="tdrow">
										기업등급
										<input name="credit_com" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row['credit_com']?>" maxlength="12">
										개인등급
										<input name="credit_per" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row['credit_per']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">물건현황<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<select name="property" class="selectfm" onchange="" style="width:60px">
											<option value="">선택</option>
											<option value="1" <? if($row['property'] == 1) echo "selected"; ?>>자가</option>
											<option value="2" <? if($row['property'] == 2) echo "selected"; ?>>임대</option>
											<option value="3" <? if($row['property'] == 3) echo "selected"; ?>>전대</option>
											<option value="4" <? if($row['property'] == 4) echo "selected"; ?>>기타</option>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">임대내용<font color="red"></font></td>
									<td nowrap  class="tdrow">
										전세
										<input name="charter" type="text" class="textfm" style="width:70px;" value="<?=$row['charter']?>" maxlength="12">
										월세
										<input name="rent_month" type="text" class="textfm" style="width:70px;" value="<?=$row['rent_month']?>" maxlength="12">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">평수<font color="red"></font></td>
									<td nowrap  class="tdrow">
										부지
										<input name="area_site" type="text" class="textfm" style="width:35px;" value="<?=$row['area_site']?>" maxlength="6">
										건축물
										<input name="area_building" type="text" class="textfm" style="width:35px;" value="<?=$row['area_building']?>" maxlength="6">
										설비
										<input name="area_facility" type="text" class="textfm" style="width:35px;" value="<?=$row['area_facility']?>" maxlength="6">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모</td>
									<td nowrap  class="tdrow" colspan="5">
										<textarea name="memo" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="내용" required><?=$row[memo]?></textarea>
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
													사업장 대출내역
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
									<td nowrap class="tdrowk_center" width="96" rowspan="4">기관<br>대출내역</td>
									<td nowrap class="tdrowk_center" width="">주관</td>
									<td nowrap class="tdrowk_center" width="108">기보</td>
									<td nowrap class="tdrowk_center" width="108">신보</td>
									<td nowrap class="tdrowk_center" width="108">보증재단</td>
									<td nowrap class="tdrowk_center" width="108">중진공</td>
									<td nowrap class="tdrowk_center" width="108">시자금</td>
									<td nowrap class="tdrowk_center" width="108">도자금</td>
									<td nowrap class="tdrowk_center" width="108">중기청</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">은행</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_7']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">금액</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_7']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">금리</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_7']?>" maxlength="12">
									</td>
								</tr>
							</table>

							<div style="height:4px;font-size:0px"></div>

							<!-- 입력폼 -->
							<table width="100%" height="100" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk_center" width="96" rowspan="6">금융권<br>대출내역</td>
									<td nowrap class="tdrowk_center">은행</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">대출구분</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_1" class="selectfm" onchange="" style="width:100%">
											<option value="">선택</option>
											<option value="1" <? if($row_opt['lend_kind_1'] == 1) echo "selected"; ?>>시설</option>
											<option value="2" <? if($row_opt['lend_kind_1'] == 2) echo "selected"; ?>>운전</option>
											<option value="3" <? if($row_opt['lend_kind_1'] == 3) echo "selected"; ?>>어음</option>
											<option value="4" <? if($row_opt['lend_kind_1'] == 4) echo "selected"; ?>>매출</option>
											<option value="5" <? if($row_opt['lend_kind_1'] == 5) echo "selected"; ?>>구매자금</option>
											<option value="6" <? if($row_opt['lend_kind_1'] == 6) echo "selected"; ?>>기타</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_2" class="selectfm" onchange="" style="width:100%">
											<option value="">선택</option>
											<option value="1" <? if($row_opt['lend_kind_2'] == 1) echo "selected"; ?>>시설</option>
											<option value="2" <? if($row_opt['lend_kind_2'] == 2) echo "selected"; ?>>운전</option>
											<option value="3" <? if($row_opt['lend_kind_2'] == 3) echo "selected"; ?>>어음</option>
											<option value="4" <? if($row_opt['lend_kind_2'] == 4) echo "selected"; ?>>매출</option>
											<option value="5" <? if($row_opt['lend_kind_2'] == 5) echo "selected"; ?>>구매자금</option>
											<option value="6" <? if($row_opt['lend_kind_2'] == 6) echo "selected"; ?>>기타</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_3" class="selectfm" onchange="" style="width:100%">
											<option value="">선택</option>
											<option value="1" <? if($row_opt['lend_kind_3'] == 1) echo "selected"; ?>>시설</option>
											<option value="2" <? if($row_opt['lend_kind_3'] == 2) echo "selected"; ?>>운전</option>
											<option value="3" <? if($row_opt['lend_kind_3'] == 3) echo "selected"; ?>>어음</option>
											<option value="4" <? if($row_opt['lend_kind_3'] == 4) echo "selected"; ?>>매출</option>
											<option value="5" <? if($row_opt['lend_kind_3'] == 5) echo "selected"; ?>>구매자금</option>
											<option value="6" <? if($row_opt['lend_kind_3'] == 6) echo "selected"; ?>>기타</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_4" class="selectfm" onchange="" style="width:100%">
											<option value="">선택</option>
											<option value="1" <? if($row_opt['lend_kind_4'] == 1) echo "selected"; ?>>시설</option>
											<option value="2" <? if($row_opt['lend_kind_4'] == 2) echo "selected"; ?>>운전</option>
											<option value="3" <? if($row_opt['lend_kind_4'] == 3) echo "selected"; ?>>어음</option>
											<option value="4" <? if($row_opt['lend_kind_4'] == 4) echo "selected"; ?>>매출</option>
											<option value="5" <? if($row_opt['lend_kind_4'] == 5) echo "selected"; ?>>구매자금</option>
											<option value="6" <? if($row_opt['lend_kind_4'] == 6) echo "selected"; ?>>기타</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">금액</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">금리</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">담보내용</td>
									<td nowrap class="tdrow_center" width="" colspan="4">
										<input name="security" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['security']?>" maxlength="90">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">주거래은행</td>
									<td nowrap class="tdrow_center" width="" colspan="4">
										<input name="primary_bank" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['primary_bank']?>" maxlength="90">
									</td>
								</tr>
							</table>
							<div style="height:4px;font-size:0px"></div>

							<!-- 입력폼 -->
							<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk_center" width="96" rowspan="">대출의뢰금액</td>
									<td nowrap  class="tdrow" width="" colspan="">
										정책자금
										<input name="loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_policy']?>" maxlength="12" onKeyPress="">
										금융자금
										<input name="loan_finance" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_finance']?>" maxlength="12" onKeyPress="">
										기타
										<input name="loan_etc" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_etc']?>" maxlength="12" onKeyPress="">
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
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													정책자금 처리현황
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
							<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
$sel_check_ok = array();
$check_ok_id = $row_opt['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
										<select name="check_ok" class="selectfm">
											<option value="">선택</option>
											<option value="9" <?=$sel_check_ok['9']?>>상담중</option>
											<option value="1" <?=$sel_check_ok['1']?>>상담완료</option>
											<option value="2" <?=$sel_check_ok['2']?>>서류진행</option>
											<option value="3" <?=$sel_check_ok['3']?>>1차지급완료</option>
											<option value="6" <?=$sel_check_ok['6']?>>2차지급완료</option>
											<option value="4" <?=$sel_check_ok['4']?>>진행불가</option>
											<option value="5" <?=$sel_check_ok['5']?>>보류</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재통화</td>
									<td nowrap  class="tdrow" width="160">
										<input name="teldt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['teldt']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.teldt);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대출금액<font color="red"></font></td>
									<td nowrap  class="tdrow" width="" colspan="">
										대출기관
										<select name="ok_loan_facility">
											<option value="">선택</option>
											<option value="중진공" <? if($row['ok_loan_facility'] == "중진공") echo "selected"; ?>>중진공</option>
											<option value="보증서" <? if($row['ok_loan_facility'] == "보증서") echo "selected"; ?>>보증서</option>
											<option value="경남은행" <? if($row['ok_loan_facility'] == "경남은행") echo "selected"; ?>>경남은행</option>
											<option value="광주은행" <? if($row['ok_loan_facility'] == "광주은행") echo "selected"; ?>>광주은행</option>
											<option value="국민은행" <? if($row['ok_loan_facility'] == "국민은행") echo "selected"; ?>>국민은행</option>
											<option value="기업은행" <? if($row['ok_loan_facility'] == "기업은행") echo "selected"; ?>>기업은행</option>
											<option value="농협은행" <? if($row['ok_loan_facility'] == "농협은행") echo "selected"; ?>>농협은행</option>
											<option value="대구은행" <? if($row['ok_loan_facility'] == "대구은행") echo "selected"; ?>>대구은행</option>
											<option value="부산은행" <? if($row['ok_loan_facility'] == "부산은행") echo "selected"; ?>>부산은행</option>
											<option value="새마을금고" <? if($row['ok_loan_facility'] == "새마을금고") echo "selected"; ?>>새마을금고</option>
											<option value="신용협동조합" <? if($row['ok_loan_facility'] == "신용협동조합") echo "selected"; ?>>신용협동조합</option>
											<option value="신한은행" <? if($row['ok_loan_facility'] == "신한은행") echo "selected"; ?>>신한은행</option>
											<option value="스탠다드차타드은행" <? if($row['ok_loan_facility'] == "스탠다드차타드은행") echo "selected"; ?>>스탠다드차타드은행</option>
											<option value="외환은행" <? if($row['ok_loan_facility'] == "외환은행") echo "selected"; ?>>외환은행</option>
											<option value="우리은행" <? if($row['ok_loan_facility'] == "우리은행") echo "selected"; ?>>우리은행</option>
											<option value="우체국"   <? if($row['ok_loan_facility'] == "우체국")   echo "selected"; ?>>우체국</option>
											<option value="전북은행" <? if($row['ok_loan_facility'] == "전북은행") echo "selected"; ?>>전북은행</option>
											<option value="제주은행" <? if($row['ok_loan_facility'] == "제주은행") echo "selected"; ?>>제주은행</option>
											<option value="하나은행" <? if($row['ok_loan_facility'] == "하나은행") echo "selected"; ?>>하나은행</option>
											<option value="한국씨티은행" <? if($row['ok_loan_facility'] == "한국씨티은행") echo "selected"; ?>>한국씨티은행</option>
										</select>
										지급금액
										<input name="ok_loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row['ok_loan_policy']?>" maxlength="12" onKeyPress="">
										수수료
										<input name="ok_loan_fee" type="text" class="textfm" style="width:40px;" value="<?=$row['ok_loan_fee']?>" maxlength="2" onKeyPress="">%
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">관리점<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
if($row['damdang_code']) {
	$man_cust_name_code = $row['damdang_code'];
} else {
	$man_cust_name_code = $stx_man_cust_name;
}
if($report != "ok") {
	if($member['mb_level'] >= 7) {
?>
										<select name="damdang_code" class="selectfm">
<?
	for($i=1;$i<count($man_cust_name_arry)-1;$i++) {
		if($row['damdang_code'] == $i) $sel_damdang_code[$i] = "selected";
?>
											<option value="<?=$i?>" <?=$sel_damdang_code[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
	}
?>
											<option value="101" <? if($man_cust_name_code == 101) echo "selected"; ?>>협력사1</option>
										</select>
<?
	} else {
		echo $man_cust_name_arry[$man_cust_name_code];
		echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
	}
} else {
	if($row['damdang_code']) echo $man_cust_name_arry[$man_cust_name_code];
		echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리결과</td>
									<td nowrap  class="tdrow" colspan="3">
										<textarea name="etc" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="내용" required><?=$row_opt[etc]?></textarea>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
<?
$is_damdang = "ok";
?>
							<!--첨부서류-->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/sb_tab_on_lt.gif"></td> 
												<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													첨부서류
												</td> 
												<td><img src="images/sb_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=6></td> 
									<td valign="middle"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bbtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_1" value="1" style="vertical-align:middle">삭제<? } ?>
<?
if($is_damdang == "ok") {
?>
										<div style="margin:4px 0 0 0">
											<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0"><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle"> <span  style="">추가</span></a>
										</div>
<?
}
?>
									</td>
									<td   class="tdrow" width="373">
										<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_1']?>" target="_blank"><?=$row_opt['filename_1']?></a>
										<input type="hidden" name="file_1" value="<?=$row_opt['filename_1']?>">
									</td>
									<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_2']?>" target="_blank"><?=$row_opt['filename_2']?></a>
										<input type="hidden" name="file_2" value="<?=$row_opt['filename_2']?>">
									</td>
								</tr>
								<tr id="file_tr2" style="<? if(!$row_opt['filename_3'] && !$row_opt['filename_4']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_3']?>" target="_blank"><?=$row_opt['filename_3']?></a>
										<input type="hidden" name="file_3" value="<?=$row_opt['filename_3']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_4']?>" target="_blank"><?=$row_opt['filename_4']?></a>
										<input type="hidden" name="file_4" value="<?=$row_opt['filename_4']?>">
									</td>
								</tr>
								<tr id="file_tr3" style="<? if(!$row_opt['filename_5'] && !$row_opt['filename_6']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_5']?>" target="_blank"><?=$row_opt['filename_5']?></a>
										<input type="hidden" name="file_5" value="<?=$row_opt['filename_5']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_6']?>" target="_blank"><?=$row_opt['filename_6']?></a>
										<input type="hidden" name="file_6" value="<?=$row_opt['filename_6']?>">
									</td>
								</tr>
								<tr id="file_tr4" style="<? if(!$row_opt['filename_7'] && !$row_opt['filename_8']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><? } ?>
										<br><a href="files/policy_fund/<?=$row_opt['filename_7']?>" target="_blank"><?=$row_opt['filename_7']?></a>
										<input type="hidden" name="file_7" value="<?=$row_opt['filename_7']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle">삭제<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><? } ?>
										<br><a href="files/policy_fund/<?=$row_opt['filename_8']?>" target="_blank"><?=$row_opt['filename_8']?></a>
										<input type="hidden" name="file_8" value="<?=$row_opt['filename_8']?>">
									</td>
								</tr>
							</table>
<?
//수정일 경우 표시
if($w) {
?>
								<!--전달사항-->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="80001"><!--전달사항--></a>
								<table border="0" cellspacing="0" cellpadding="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														전달사항
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrow" width="">
											<script type="text/javascript">
											function resizeFrame(frm) {
											 frm.style.height = "auto";
											 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
											 frm.style.height = contentHeight + 0 + "px";
											}
											</script>
											<iframe src="policy_fund_memo.php?id=<?=$id?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
<?
}
?>
							</div>


							<div style="height:20px;font-size:0px"></div>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
//권한별 링크값 : 전체 권한
if($member['mb_level'] == 0) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
$url_list = "./policy_fund_list.php?page=".$page;
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_list?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							<!--공통 변수-->
							<input type="hidden" name="url" value="./policy_fund_view.php" />
							<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
							<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
							<input type="hidden" name="w" value="<?=$w?>" />
							<input type="hidden" name="id" value="<?=$id?>" />
							<input type="hidden" name="page" value="<?=$page?>" />
						</form>
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
