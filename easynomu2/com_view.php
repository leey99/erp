<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from $g4[com_list_gy] ";

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$id = "00002";
}
//echo $member[mb_profile];
if($member[mb_profile] > 40) {
	$member['mb_level'] = 5;
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where com_code='$id' ";
} else {
	$sql_search = " where t_insureno='$member[mb_id]' ";
}
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sub_title = "기본정보";
//$g4[title] = $sub_title." : 사업장관리 : ".$easynomu_name;
//문서 타이틀 변경 : 이지노무 -> 사업장명 160804
$g4[title] = $sub_title." : 사업장관리 : ".$member['mb_nick'];

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
	$sql1 = " select * from com_list_gy_opt where com_code='$com_code' ";
	//echo $sql1;
	$result1 = sql_query($sql1);
	$row1=mysql_fetch_array($result1);
}
//echo $row[com_code];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
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
function member_form() {
	var frm = document.dataForm;
	if (frm.firm_name.value == "")
	{
		alert("사업장명을 입력하세요.");
		frm.firm_name.focus();
		return;
	}
	if(radio_chk(frm.comp_type, "사업자구분을") == 0) {
		frm.comp_type[0].focus();
		return;
	}
	if (frm.comp_bznb.value == "")
	{
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
/*
	if (frm.user_id.value == "")
	{
		alert("아이디를 입력하세요.");
		frm.user_id.focus();
		return;
	}
*/
	if (frm.user_pass.value == "")
	{
		alert("비밀번호를 입력하세요.");
		frm.user_pass.focus();
		return;
	}
	window.open("/admin/member_form_easynomu.php?mb_id="+frm.user_id.value+"&mb_password="+frm.user_pass.value+"&mb_name="+frm.firm_name.value);
}
function checkAddress(strgbn)
{
	var ret;
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	ret = window.open("../road_address/search.php?id="+strgbn, "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.firm_name.value == "")
	{
		alert("사업장명을 입력하세요.");
		frm.firm_name.focus();
		return;
	}
	//alert(frm.comp_type.value);
	//alert(radio_chk(frm.comp_type, '사업자구분을'));
	if(radio_chk(frm.comp_type, "사업자구분을") == 0) {
		frm.comp_type[0].focus();
		return;
	}
	if (frm.comp_bznb.value == "")
	{
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
/*
	if (frm.user_id.value == "")
	{
		alert("아이디를 입력하세요.");
		frm.user_id.focus();
		return;
	}
*/
	if (frm.user_pass.value == "")
	{
		alert("비밀번호를 입력하세요.");
		frm.user_pass.focus();
		return;
	}
/*
	if (frm.upjong_code.value == "")
	{
		alert("업종을 입력하세요.");
		frm.upjong_code.focus();
		return;
	}
	if (frm.upjong.value == "")
	{
		alert("업종을 입력하세요.");
		frm.upjong.focus();
		return;
	}
*/
	if (frm.cust_name.value == "")
	{
		alert("대표자를 입력하세요.");
		frm.cust_name.focus();
		return;
	}
<?
//지사 전용 ID 이용약관 동의 적용
if($member['mb_level'] == 5) {
?>
	if(frm.agree_check1.checked == true && frm.agree_check2.checked == true) {
		//alert('이용약관과 개인정보처리방침에 동의하여 주셔서 감사합니다.');
	} else {
		alert('이용약관과 개인정보처리방침에 동의하여 주십시오.');
		frm.agree_check1.focus();
		return;
	}
<?
}
?>
	frm.user_id.value = frm.comp_bznb.value;
	frm.action = "com_update.php";
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
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
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
				if ( type =='1' ) {
					main.cntr_sdate.value=total;					// type 에 따라 최종값을 넣어 준다.
				} else if ( type =='2' ) {
					main.service_day_start.value=total;
				} else if ( type =='3' ) {
					main.service_day_end.value=total;
				} else if ( type =='4' ) {
					main.employment_report_date.value=total;
				} else if ( type =='5' ) {
					main.conduct_day.value=total;
				}
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
function pay_day_last_chk() {
	//급여지급일 말일 체크
}
function pay_day_last_time_chk() {
	//급여지급일 말일 체크
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
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($member['mb_level'] != 5) {
	include "./inc/left_menu1.php";
} else {
	//지사/영업사원 전용 ID 접속시 표시안함
?>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname01.gif" /></td>
								</tr>
							</table>
<?
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
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
							<!-- 입력폼 -->
<?
if($row[com_name]) {
	$class_var = "textfm5";
	$comp_name_readonly = "readonly";
	$comp_bznb_readonly = "readonly";
	$comp_bznb_check = "display:none";
} else {
	$class_var = "textfm";
	$comp_name_readonly = "";
	$comp_bznb_readonly = "";
	$comp_bznb_check = "display:inline";
}
?>
							<table width="100%" height="240" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:">
								<col width="12%">
								<col width="21%">
								<col width="10%">
								<col width="23%">
								<col width="11%">
								<col width="23%">
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="firm_name" type="text" class="<?=$class_var?>" <?=$comp_name_readonly?> style="width:190px;ime-mode:active;" value="<?=$row[com_name]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자구분<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
if($row[upche_div] == "1") $chk_comp_type1 = "checked";
else if($row[upche_div] == "2") $chk_comp_type2 = "checked";
?>
										<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>개인
										<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>법인
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">법인등록번호<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input name="bupin_no" type="text" class="textfm" style="width:150px;" value="<?=$row[bupin_no]?>" maxlength="14" onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '1','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="comp_bznb" type="text" class="<?=$class_var?>" <?=$comp_name_readonly?> style="width:120px;ime-mode:disabled;" value="<?=$row[biz_no]?>" maxlength="12" onkeypress="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')">
										<input name="user_id" type="hidden" value="<?=$row[biz_no]?>">
										<table border=0 cellpadding=0 cellspacing=0 style="<?=$comp_bznb_check?>"><tr><td width=2></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class=ftbutton3_white nowrap><a href="javascript:checkID();" target="">중복검색</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>  
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">비밀번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="user_pass_old" type="hidden" value="<?=$row[biz_no]?>">
										<input name="user_pass" type="text" class="textfm" style="width:150px;" value="<?=$row1[password]?>" maxlength="15">
<!--
<?
if($member['mb_level'] >= 5) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:member_form();" target="">회원등록</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
}
?>
-->
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주간 근로일</td>
									<td nowrap  class="tdrow">
<?
if($row1[workday_month] == "20") $sel_workday_month1 = "selected";
else if($row1[workday_month] == "24") $sel_workday_month2 = "selected";
?>
										<select name="workday_month" class="selectfm">
											<option value="20" <?=$sel_workday_month1?>>5일근로</option>
											<option value="24" <?=$sel_workday_month2?>>6일근로</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">대표자명<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="cust_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row[boss_name]?>" maxlength="25">
									</td>

									<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장<br><img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5 3 0">소재지</td>
									<td nowrap class="tdrow"  rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row[com_postno]);
?>
										<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" readonly>
										-
										<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" readonly>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[com_juso]?>" readonly>
										<br>
										<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[com_juso2]?>" maxlength="150">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민번호</td>
									<td nowrap  class="tdrow">
										<input name="cust_ssnb" type="text" class="textfm" style="width:150;ime-mode:disabled;" value="<?=$row[jumin_no]?>" maxlength="14"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">대표자핸드폰</td>
									<td nowrap class="tdrow">
<?
$cust_cel = explode("-",$row[boss_hp]);
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
										<input name="cust_cel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="cust_cel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">업종<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<input name="upjong_code" id="upjong_code_undefined" type="text" class="textfm" style="width:40px;" value="<?=$row[upjong_code]?>" maxlength="5" readonly>
										<input name="upjong" id="upjong_undefined" type="text" class="textfm" style="width:120px;" value="<?=$row[upjong]?>" maxlength="25" readonly>
										<label onclick="open_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">업태</td>
									<td nowrap  class="tdrow">
										<input name="uptae" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row[uptae]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">종목</td>
									<td nowrap  class="tdrow">
										<input name="jongmok" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row1[jongmok]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">전화번호</td>
									<td nowrap  class="tdrow">
<?
$com_tel = explode("-",$row[com_tel]);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
									<select name="cust_tel1" class="selectfm">
									<option value="">선택</option>
										<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
										<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
										<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
										<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
										<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
										<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
										<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
										<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
										<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
										<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
										<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
										<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
										<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
										<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
										<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
										<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
										<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
									</select>
									-
									<input name="cust_tel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
									-
									<input name="cust_tel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">팩스번호</td>
									<td nowrap  class="tdrow">
<?
$com_fax = explode("-",$row[com_fax]);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
?>
									<select name="cust_fax1" class="selectfm">
									<option value="">선택</option>
										<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
										<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
										<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
										<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
										<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
										<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
										<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
										<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
										<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
										<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
										<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
										<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
										<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
										<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
										<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
										<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
										<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
									</select>
									-
									<input name="cust_fax2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
									-
									<input name="cust_fax3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업개시일</td>
									<td nowrap  class="tdrow">
									<input name="cntr_sdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[cntr_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '1','Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.cntr_sdate);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										예)2012.01.01
									</td>
								</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">특이사항</td>
										<td nowrap class="tdrow" colspan="5">
											<input type="text" class="textfm" name="remark" value="<?=$row2[remark]?>" style="width:100%" />
										</td>
									</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												사업장 추가정보
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
							<table width="100%" height="200" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<col width="12%">
								<col width="21%">
								<col width="10%">
								<col width="23%">
								<col width="11%">
								<col width="23%">
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">담당자명</td>
									<td nowrap  class="tdrow">
									<input name="damdang_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row[com_damdang]?>" maxlength="25" >
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">담당자전화</td>
									<td nowrap class="tdrow">
<?
$damdang_cel = explode("-",$row1[com_damdang_tel]);
$damdang_cel1 = $damdang_cel[0];
$sel_damdang_cel1 = array();
$sel_damdang_cel1[$damdang_cel1] = "selected";
$damdang_cel2 = $damdang_cel[1];
$damdang_cel3 = $damdang_cel[2];
?>
									<select name="damdang_cel1" class="selectfm">
										<option value="">선택</option>
										<option value="02"  <?=$sel_damdang_cel1['02']?> >02</option>
										<option value="032" <?=$sel_damdang_cel1['032']?>>032</option>
										<option value="042" <?=$sel_damdang_cel1['042']?>>042</option>
										<option value="051" <?=$sel_damdang_cel1['051']?>>051</option>
										<option value="052" <?=$sel_damdang_cel1['052']?>>052</option>
										<option value="053" <?=$sel_damdang_cel1['053']?>>053</option>
										<option value="062" <?=$sel_damdang_cel1['062']?>>062</option>
										<option value="064" <?=$sel_damdang_cel1['064']?>>064</option>
										<option value="031" <?=$sel_damdang_cel1['031']?>>031</option>
										<option value="033" <?=$sel_damdang_cel1['033']?>>033</option>
										<option value="041" <?=$sel_damdang_cel1['041']?>>041</option>
										<option value="043" <?=$sel_damdang_cel1['043']?>>043</option>
										<option value="054" <?=$sel_damdang_cel1['054']?>>054</option>
										<option value="055" <?=$sel_damdang_cel1['055']?>>055</option>
										<option value="061" <?=$sel_damdang_cel1['061']?>>061</option>
										<option value="063" <?=$sel_damdang_cel1['063']?>>063</option>
										<option value="010" <?=$sel_damdang_cel1['010']?>>010</option>
										<option value="011" <?=$sel_damdang_cel1['011']?>>011</option>
										<option value="016" <?=$sel_damdang_cel1['016']?>>016</option>
										<option value="017" <?=$sel_damdang_cel1['017']?>>017</option>
										<option value="018" <?=$sel_damdang_cel1['018']?>>018</option>
										<option value="019" <?=$sel_damdang_cel1['019']?>>019</option>
										<option value="070" <?=$sel_damdang_cel1['070']?>>070</option>
									</select>
									-
									<input name="damdang_cel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$damdang_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
									-
									<input name="damdang_cel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$damdang_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장 규모</td>
									<td nowrap class="tdrow">
<?
//echo $row1[emp5_gbn];
if($row1[emp5_gbn] == 1) $emp5_gbn = "checked";
?>
										<input type="checkbox" name="emp5_gbn" value="1" <?=$emp5_gbn?>> 5인 미만
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">대표자주소</td>
									<td nowrap  class="tdrow" colspan="3">
<?
$boss_adr_zip = explode("-",$row[boss_postno]);
?>
										<input name="boss_adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$boss_adr_zip[0]?>" readonly>
										-
										<input name="boss_adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$boss_adr_zip[1]?>" readonly>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('boss_adr_zip1','boss_adr_zip2','boss_adr_adr1','boss_adr_adr2');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="boss_adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[boss_juso]?>" readonly>
										<br>
										<input name="boss_adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[boss_juso2]?>" maxlength="150">
									</td>
									<td nowrap class="tdrowk" rowspan=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자도장</td>
									<td nowrap class="tdrow"  rowspan="">
										<input name="filename" type="file" class="textfm_search" style="width:170px;">
											<?
												//증명사진
												//echo $row1[pic];
												if($row1[pic]) {
													$pic = "./files/seal/$id.jpg";
												} else {
													$pic = "./images/seal.gif";
												}
											?>
										<br><img src="<?=$pic?>" height="84">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이메일</td>
									<td nowrap  class="tdrow">
										<input name="cust_email" type="text" class="textfm" style="width:182px;ime-mode:disabled;" value="<?=$row[com_mail]?>" maxlength="100">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">취업규칙신고</td>
									<td nowrap class="tdrow">
<?
if($row1[employment_report] == "") $sel_employment_report1 = "selected";
else if($row1[employment_report] == "1") $sel_employment_report2 = "selected";
?>
										<select name="employment_report" class="selectfm">
											<option value="" <?=$sel_employment_report1?>>무</option>
											<option value="1" <?=$sel_employment_report2?>>유</option>
										</select>
										<input name="employment_report_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[employment_report_date]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '4','Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.employment_report_date);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">정년연령</td>
									<td nowrap  class="tdrow">
										<input name="retirement_age" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$row1[retirement_age]?>" onkeypress="only_number()" maxlength="100"> 예) 50
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여지급일
									</td>
									<td nowrap class="tdrow" style="padding:4px 0 4px 0">
										월급제 :
<?
if($row1[pay_day] == "" || $row1[pay_day] == 0) $pay_day = "";
else $pay_day = $row1[pay_day];
?>
										<input name="pay_day" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$pay_day?>" onkeypress="only_number()" maxlength="2">일
<?
if($row1[pay_day_last] == 1) $pay_day_last_checked = "checked";
if($row1[pay_day_now_month] == 1) $pay_day_now_month_checked = "checked";
?>
										<input type="checkbox" name="pay_day_last" value="1" <?=$pay_day_last_checked?> onclick="pay_day_last_chk(this)" style="vertical-align:middle">말일
										<input type="checkbox" name="pay_day_now_month" value="1" <?=$pay_day_now_month_checked?> style="vertical-align:middle">당월
										<input type="hidden" name="pay_day_old" value="<?=$pay_day?>">
										<br>시급제 :
<?
if($row1[pay_day_time] == "" || $row1[pay_day_time] == 0) $pay_day_time = "";
else $pay_day_time = $row1[pay_day_time];
?>
										<input name="pay_day_time" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$pay_day_time?>" onkeypress="only_number()" maxlength="2">일
<?
if($row1[pay_day_last_time] == 1) $pay_day_last_time_checked = "checked";
if($row1[pay_day_now_month_time] == 1) $pay_day_now_month_time_checked = "checked";
?>
										<input type="checkbox" name="pay_day_last_time" value="1" <?=$pay_day_last_time_checked?> onclick="pay_day_last_time_chk(this)" style="vertical-align:middle">말일
										<input type="checkbox" name="pay_day_now_month_time" value="1" <?=$pay_day_now_month_time_checked?> style="vertical-align:middle">당월
										<input type="hidden" name="pay_day_old_time" value="<?=$pay_day_time?>">
<?
//(주)디웍스 : 시급제 항목 2개 표시
if($id == "20284") {
?>
										<br>시급제2 :
<?
if($row1['pay_day_time2'] == "" || $row1['pay_day_time2'] == 0) $pay_day_time2 = "";
else $pay_day_time2 = $row1['pay_day_time2'];
?>
										<input name="pay_day_time2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$pay_day_time2?>" onkeypress="only_number()" maxlength="2">일
<?
if($row1['pay_day_last_time2'] == 1) $pay_day_last_time2_checked = "checked";
if($row1['pay_day_now_month_time2'] == 1) $pay_day_now_month_time2_checked = "checked";
?>
										<input type="checkbox" name="pay_day_last_time2" value="1" <?=$pay_day_last_time2_checked?> onclick="pay_day_last_time_chk(this)" style="vertical-align:middle">말일
										<input type="checkbox" name="pay_day_now_month_time2" value="1" <?=$pay_day_now_month_time2_checked?> style="vertical-align:middle">당월
										<input type="hidden" name="pay_day_old_time2" value="<?=$pay_day_time2?>">
<?
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금산출기간</td>
									<td nowrap  class="tdrow" colspan="3">
										<div style="float:left;">
										월급제
<?
$pay_calculate_day1 = $row1[pay_calculate_day1];
$pay_calculate_day_period1 = $row1[pay_calculate_day_period1];
$pay_calculate_day2 = $row1[pay_calculate_day2];
$pay_calculate_day_period2 = $row1[pay_calculate_day_period2];
if($pay_calculate_day1 == "" || $pay_calculate_day1 == "당월") $sel_pay_calculate_day1_1 = "selected";
else if($pay_calculate_day1 == "전월") $sel_pay_calculate_day1_2 = "selected";
if(!$pay_calculate_day_period1) $pay_calculate_day_period1 = "1";
?>
										<select name="pay_calculate_day1" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day1_1?>>당월</option>
											<option value="전월" <?=$sel_pay_calculate_day1_2?>>전월</option>
										</select>
										<input type="text" name="pay_calculate_day_period1" class="textfm" value="<?=$pay_calculate_day_period1?>" style="width:30px;ime-mode:active;">
										~
<?
if($pay_calculate_day2 == "" || $pay_calculate_day2 == "당월") $sel_pay_calculate_day2_1 = "selected";
else if($pay_calculate_day2 == "익월") $sel_pay_calculate_day2_2 = "selected";
?>
										<select name="pay_calculate_day2" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day2_1?>>당월</option>
											<option value="익월" <?=$sel_pay_calculate_day2_2?>>익월</option>
										</select>
										<select name="pay_calculate_day_period2" class="selectfm">
<?
for($i=1;$i<32;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $pay_calculate_day_period2) echo "selected"; ?> ><?=$i?></option>
<?
}
$end_day = "말";
if(!$pay_calculate_day_period2) $pay_calculate_day_period2 = "말";
?>
											<option value="<?=$end_day?>" <? if($end_day == $pay_calculate_day_period2) echo "selected"; ?> ><?=$end_day?></option>
										</select>
										<br />시급제
<?
$pay_calculate_day1_time = $row1[pay_calculate_day1_time];
$pay_calculate_day_period1_time = $row1[pay_calculate_day_period1_time];
$pay_calculate_day2_time = $row1[pay_calculate_day2_time];
$pay_calculate_day_period2_time = $row1[pay_calculate_day_period2_time];
if($pay_calculate_day1_time == "" || $pay_calculate_day1_time == "당월") $sel_pay_calculate_day1_1_time = "selected";
else if($pay_calculate_day1_time == "전월") $sel_pay_calculate_day1_2_time = "selected";
if(!$pay_calculate_day_period1_time) $pay_calculate_day_period1_time = "1";
?>
										<select name="pay_calculate_day1_time" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day1_1_time?>>당월</option>
											<option value="전월" <?=$sel_pay_calculate_day1_2_time?>>전월</option>
										</select>
										<input type="text" name="pay_calculate_day_period1_time" class="textfm" value="<?=$pay_calculate_day_period1_time?>" style="width:30px;ime-mode:active;">
										~
<?
if($pay_calculate_day2_time == "" || $pay_calculate_day2_time == "당월") $sel_pay_calculate_day2_1_time = "selected";
else if($pay_calculate_day2_time == "익월") $sel_pay_calculate_day2_2_time = "selected";
?>
										<select name="pay_calculate_day2_time" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day2_1_time?>>당월</option>
											<option value="익월" <?=$sel_pay_calculate_day2_2_time?>>익월</option>
										</select>
										<select name="pay_calculate_day_period2_time" class="selectfm">
<?
for($i=1;$i<32;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $pay_calculate_day_period2_time) echo "selected"; ?> ><?=$i?></option>
<?
}
$end_day = "말";
if(!$pay_calculate_day_period2_time) $pay_calculate_day_period2_time = "말";
?>
											<option value="<?=$end_day?>" <? if($end_day == $pay_calculate_day_period2_time) echo "selected"; ?> ><?=$end_day?></option>
										</select>
<?
//(주)디웍스 : 시급제 항목 2개 표시
if($id == "20284") {
?>
										<br />시급제2
<?
$pay_calculate_day1_time2 = $row1[pay_calculate_day1_time2];
$pay_calculate_day_period1_time2 = $row1[pay_calculate_day_period1_time2];
$pay_calculate_day2_time2 = $row1[pay_calculate_day2_time2];
$pay_calculate_day_period2_time2 = $row1[pay_calculate_day_period2_time2];
if($pay_calculate_day1_time2 == "" || $pay_calculate_day1_time2 == "당월") $sel_pay_calculate_day1_1_time2 = "selected";
else if($pay_calculate_day1_time2 == "전월") $sel_pay_calculate_day1_2_time2 = "selected";
if(!$pay_calculate_day_period1_time2) $pay_calculate_day_period1_time2 = "1";
?>
										<select name="pay_calculate_day1_time2" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day1_1_time2?>>당월</option>
											<option value="전월" <?=$sel_pay_calculate_day1_2_time2?>>전월</option>
										</select>
										<input type="text" name="pay_calculate_day_period1_time2" class="textfm" value="<?=$pay_calculate_day_period1_time2?>" style="width:30px;ime-mode:active;">
										~
<?
if($pay_calculate_day2_time2 == "" || $pay_calculate_day2_time2 == "당월") $sel_pay_calculate_day2_1_time2 = "selected";
else if($pay_calculate_day2_time2 == "익월") $sel_pay_calculate_day2_2_time2 = "selected";
?>
										<select name="pay_calculate_day2_time2" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day2_1_time2?>>당월</option>
											<option value="익월" <?=$sel_pay_calculate_day2_2_time2?>>익월</option>
										</select>
										<select name="pay_calculate_day_period2_time2" class="selectfm">
<?
for($i=1;$i<32;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $pay_calculate_day_period2_time2) echo "selected"; ?> ><?=$i?></option>
<?
}
$end_day = "말";
if(!$pay_calculate_day_period2_time2) $pay_calculate_day_period2_time2 = "말";
?>
											<option value="<?=$end_day?>" <? if($end_day == $pay_calculate_day_period2_time2) echo "selected"; ?> ><?=$end_day?></option>
										</select>
<?
}
?>
										</div>
										<div style="float:left;margin-left:8px;">
											휴일근로
<?
$pay_calculate_day1_hday = $row1['pay_calculate_day1_hday'];
$pay_calculate_day_period1_hday = $row1['pay_calculate_day_period1_hday'];
$pay_calculate_day2_hday = $row1['pay_calculate_day2_hday'];
$pay_calculate_day_period2_hday = $row1['pay_calculate_day_period2_hday'];
if($pay_calculate_day1_hday == "" || $pay_calculate_day1_hday == "당월") $sel_pay_calculate_day1_1_hday = "selected";
else if($pay_calculate_day1_hday == "전월") $sel_pay_calculate_day1_2_hday = "selected";
if(!$pay_calculate_day_period1_hday) $pay_calculate_day_period1_hday = "1";
?>
										<select name="pay_calculate_day1_hday" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day1_1_hday?>>당월</option>
											<option value="전월" <?=$sel_pay_calculate_day1_2_hday?>>전월</option>
										</select>
										<input type="text" name="pay_calculate_day_period1_hday" class="textfm" value="<?=$pay_calculate_day_period1_hday?>" style="width:30px;ime-mode:active;">
										~
<?
if($pay_calculate_day2_hday == "" || $pay_calculate_day2_hday == "당월") $sel_pay_calculate_day2_1_hday = "selected";
else if($pay_calculate_day2_hday == "익월") $sel_pay_calculate_day2_2_hday = "selected";
?>
										<select name="pay_calculate_day2_hday" class="selectfm">
											<option value="당월" <?=$sel_pay_calculate_day2_1_hday?>>당월</option>
											<option value="익월" <?=$sel_pay_calculate_day2_2_hday?>>익월</option>
										</select>
										<select name="pay_calculate_day_period2_hday" class="selectfm">
<?
for($i=1;$i<32;$i++) {
?>
											<option value="<?=$i?>" <? if($i == $pay_calculate_day_period2_hday) echo "selected"; ?> ><?=$i?></option>
<?
}
$end_day = "말";
if(!$pay_calculate_day_period2_hday) $pay_calculate_day_period2_hday = "말";
?>
											<option value="<?=$end_day?>" <? if($end_day == $pay_calculate_day_period2_hday) echo "selected"; ?> ><?=$end_day?></option>
										</select>
										</div>
									</td>
								</tr>
							</table>
<?
//지사 전용 ID 취업규칙 숨김
if($member['mb_level'] != 5) {
	//echo $member['mb_level'];
	//사업장 로그인시 숨김
	if($member['mb_level'] != 3) {
?>
							<div style="height:20px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												사업장 추가정보
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">관리지사</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
?>
										<select name="man_cust_name" class="selectfm">
<?
for($i=1;$i<count($man_cust_name_arry);$i++) {
	if($row1[man_cust_name] == $i) $sel_man_cust_name[$i] = "selected";
?>
											<option value="<?=$i?>" <?=$sel_man_cust_name[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
}
?>
										</select>
<?
} else {
	echo $man_cust_name_arry[$row1[man_cust_name]];
	echo "<input type='hidden' name='man_cust_name' value='".$row1[manage_cust_numb]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">담당매니저</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
?>
										<input type="text" name="manage_cust_numb" class="textfm" style="width:34px" readonly value="<?=$row1[manage_cust_numb]?>">
										<input name="manage_cust_name" type="text" class="textfm" style="width:58px" readonly value="<?=$row1[manage_cust_name]?>">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:findNomu();" target="">검색</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	//담당 매니저
	$sql_manage = " select * from a4_manage where code='$row1[manage_cust_numb]' ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	$row_manage=mysql_fetch_array($result_manage);
	if($row1[manage_cust_name]) {
		echo $row1[manage_cust_name]."(".$row_manage[tel].")";
		echo "<input type='hidden' name='manage_cust_numb' value='".$row1[manage_cust_numb]."'>";
		echo "<input type='hidden' name='manage_cust_name' value='".$row1[manage_cust_name]."'>";
	} else {
		echo "미지정";
	}
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사무대행담당</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
?>
										<input type="text" name="samu_cust_numb" class="textfm" style="width:34px" readonly value="<?=$row1[samu_cust_numb]?>">
										<input name="samu_cust_name" type="text" class="textfm" style="width:58px" readonly value="<?=$row1[samu_cust_name]?>">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:findNomu();" target="">검색</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	//사무대행담당
	$sql_samu = " select * from a4_manage where code='$row1[samu_cust_numb]' ";
	//echo $sql_samu;
	$result_samu = sql_query($sql_samu);
	$row_samu=mysql_fetch_array($result_samu);
	if($row1[samu_cust_name]) {
		echo $row1[samu_cust_name]."(".$row_samu[tel].")";
		echo "<input type='hidden' name='samu_cust_numb' value='".$row1[samu_cust_numb]."'>";
		echo "<input type='hidden' name='samu_cust_name' value='".$row1[samu_cust_name]."'>";
	} else {
		echo "미지정";
	}
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">월정액결제일</td>
									<td nowrap  class="tdrow" width="23%">
<?
if($member['mb_level'] >= 5) {
	if($row1[settlement_day] == "" || $row1[settlement_day] == 0) $settlement_day = "";
	else $settlement_day = $row1[settlement_day];
?>
										<input name="settlement_day" type="text" class="textfm" style="width:50px;ime-mode:active;" value="<?=$settlement_day?>" maxlength="2">
<?
	if($row1[settlement_day_last] == 1) $settlement_day_last_checked = "checked";
?>
										<input type="checkbox" name="settlement_day_last" value="1" <?=$settlement_day_last_checked?>> 말일
<?
} else {
	if($row1[settlement_day] == "" || $row1[settlement_day] == 0) $settlement_day = "미정";
	else $settlement_day = $row1[settlement_day]."일";
	if($row1[settlement_day_last] != 1)	{
?>
										<?=$settlement_day?>
<?
	} else {
		echo "말일";
	}
?>
										<input type='hidden' name='settlement_day' value='<?=$row1[settlement_day]?>'>
										<input type='hidden' name='settlement_day_last' value='<?=$row1[settlement_day_last]?>'>
<?
}
?>
									</td>
									<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사무위탁신청</td>
									<td nowrap  class="tdrow" width="22%">
<?
if($row1[samu_req_yn] == "0" || $row1[samu_req_yn] == "") {
	$sel_samu_req_yn1 = "selected";
	$samu_req = "미신청";
} else if($row1[samu_req_yn] == "1") {
	$sel_samu_req_yn2 = "selected";
	$samu_req = "신청";
}
if($member['mb_level'] >= 5) {
?>
										<select name="samu_req_yn" class="selectfm">
											<option value=""></option>
											<option value="0" <?=$sel_samu_req_yn1?>>미신청</option>
											<option value="1" <?=$sel_samu_req_yn2?>>신청</option>
										</select>
<?
} else {
	echo $samu_req;
	echo "<input type='hidden' name='samu_req_yn' value='".$row1[samu_req_yn]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사무수임조회</td>
									<td nowrap  class="tdrow" width="22%">
<?
if($row1[samu_state] == "0" || $row1[samu_state] == "") {
	$sel_samu_state1 = "selected";
	$samu_suim = "미조회";
} else if($row1[samu_state] == "1") {
	$sel_samu_state2 = "selected";
	$samu_suim = "조회";
}
if($member['mb_level'] >= 5) {
?>
										<select name="samu_state" class="selectfm">
											<option value=""></option>
											<option value="0" <?=$sel_samu_state1?>>미조회</option>
											<option value="1" <?=$sel_samu_state2?>>조회</option>
										</select>
<?
} else {
	echo $samu_suim;
	echo "<input type='hidden' name='samu_state' value='".$row1[samu_state]."'>";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">서비스시작일</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
?>
										<input name="service_day_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[service_day_start]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '2','Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.service_day_start);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	if($row1[service_day_start] == "") echo "미정";
	else echo $row1[service_day_start];
	echo "<input type='hidden' name='service_day_start' value='".$row1[service_day_start]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">서비스종료일</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
?>
										<input name="service_day_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[service_day_end]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '3','Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.service_day_end);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	if($row1[service_day_end] == "") echo "미정";
	else echo $row1[service_day_end];
	echo "<input type='hidden' name='service_day_end' value='".$row1[service_day_end]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장타입</td>
									<td nowrap  class="tdrow">
										<select name="comp_print_type" class="selectfm">
<?
$alphabet = "A";
$comp_print_type = $row1[comp_print_type];
for($i=1;$i<=26;$i++) {
?>
											<option value="<?=$alphabet?>" <? if($comp_print_type == $alphabet) echo "selected"; ?> ><?=$alphabet?></option>
<?
	$alphabet = ++$alphabet;
}
?>
										</select>
									</td>
								</tr>
							</table>
<?
	}
	//사업장 로그인 숨김
?>
								<!--취업규칙 제거 140520-->
<?
//지사/영업사원 전용 ID 접속시 표시안함
} else {
//약관 동의
?>
							<div style="height:20px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:200;text-align:center'> 
												이용약관/개인정보취급방침 동의
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=6></td> 
									<td valign="middle"><!--<img src="./images/question_img.gif" onclick="clientxy();" style="cursor:pointer">--></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							<!-- 입력폼 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="12%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이용약관<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="20%">
										<input name="agree_check1" type="checkbox" value="Y"/> 동의
									</td>
									<td nowrap class="tdrowk" width="18%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">개인정보취급방침<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="20%">
										<input name="agree_check2" type="checkbox" value="Y"/> 동의
									</td>
									<td nowrap class="tdrowk" width="15%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이지노무버전</td>
									<td nowrap  class="tdrow">
<?
if($row[lawwiz_code] == "1") {
	$sel_lawwiz_code1 = "selected";
	$lawwiz_code = "1";
} else if($row[lawwiz_code] == "2" || $row[lawwiz_code] == "") {
	$sel_lawwiz_code2 = "selected";
	$lawwiz_code = "2";
}
?>
										<select name="lawwiz_code" class="selectfm">
											<option value=""></option>
											<option value="1" <?=$sel_lawwiz_code1?>>v1.0</option>
											<option value="2" <?=$sel_lawwiz_code2?>>v2.0</option>
										</select>
									</td>
								</tr>
							</table>
<?
	include "inc/com_agree.php";
}
?>
							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_rule1 = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_rule1 = "./form_labor.php?labor=rule1";
}

if($member['mb_level'] != 5) {
?>
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
<?
if($member['mb_level'] >= 7) {
?>
										<a href="./com_list.php?page=<?=$page?>" target=""><img src="images/btn_list_big.png" border="0"></a>
<?
} else {
?>
										<a href="./main.php" target=""><img src="images/btn_cancel_big.png" border="0"></a>
<?
}
?>
<?
//지사/영업사원 전용 ID 접속시 표시안함
} else {
?>
										<div style="height:10px;font-size:0px"></div>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">저장 후 사업장 로그인</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
									</td>
								</tr>
							</table>
							<input type="hidden" name="error_code" style="width:100%" value="">
							<div style="height:20px;font-size:0px"></div>
							<input type="hidden" name="prv_dojang_img" value="<?$row1[dojang_img]?>">
							<input type="hidden" name="prv_cust_tell"  value="<?=$row[com_tel]?>">
							<input type="hidden" name="prv_user_id" value="<?=$row[t_insureno]?>">
							<input type="hidden" name="url" value="./com_view.php">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="page" value="<?=$page?>">
							</form>
							<!--댑메뉴 -->
							<!-- 입력폼 -->

						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>