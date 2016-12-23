<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from $g4[com_list_gy] ";

$is_admin = "super";
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
$g4[title] = $sub_title." : 사업장관리 : ".$easynomu_name;

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
<script language="javascript" src="js/jquery-1.8.0.min.js"></script>
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
	frm.action = "com_update_admin.php";
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
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	var v5 = document.getElementById(div_id+'5');
	var v6 = document.getElementById(div_id+'6');
	var v7 = document.getElementById(div_id+'7');
	var v8 = document.getElementById(div_id+'8');
	var v9 = document.getElementById(div_id+'9');
	var v10 = document.getElementById(div_id+'10');
	var v11 = document.getElementById(div_id+'11');
	var v12 = document.getElementById(div_id+'12');

	if(v4.style.display == "none") {
		v4.style.display = "";
	} else {
		if(v7.style.display == "none") {
			v7.style.display = "";
		} else {
			if(v10.style.display == "none") {
				v10.style.display = "";
			} else {
				alert("최대 12개까지 추가 가능합니다.");
			}
		}
	}
}
function field_del(div_id) {
	var v4 = document.getElementById(div_id+'4');
	var v7 = document.getElementById(div_id+'7');
	var v10 = document.getElementById(div_id+'10');

	if(v10.style.display == "") {
		v10.style.display = "none";
	} else {
		if(v7.style.display == "") {
			v7.style.display = "none";
		} else {
			if(v4.style.display == "") {
				v4.style.display = "none";
			} else {
				alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
			}
		}
	}
}
function field_add6(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	var v5 = document.getElementById(div_id+'5');
	var v6 = document.getElementById(div_id+'6');
	if(v4.style.display == "none") {
		v4.style.display = "";
	} else {
		alert("최대 6개까지 추가 가능합니다.");
	}
}
function field_del6(div_id) {
	var v4 = document.getElementById(div_id+'4');
	if(v4.style.display == "") {
		v4.style.display = "none";
	} else {
		alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");

	}
}
//정년 변경내용 반영
//상여금 변경내용 반영
function retirement_age_rule_change() {
	var f = document.dataForm;
	var retirement_age = f.retirement_age.value;
	f.retirement_age_rule.value = "만 "+retirement_age+"세가 되는 날이 속하는 달의 말일";
	//alert(f.retirement_age_rule.value);
}
//상여금 수동입력
function checkBonus_MoneyYn() {
	var f = document.dataForm;
	var className = "textfm5";
	var readOnly = true;
	if( f.check_bonus_money_yn.checked ) {
		className = "textfm";
		readOnly = false;
		document.getElementById('bonus_money').style.display="inline";
		document.getElementById('bonus_standard').style.display="none";
	}else{
		className = "textfm5";
		readOnly = true;
		document.getElementById('bonus_money').style.display="none";
		document.getElementById('bonus_standard').style.display="inline";
	}
	var obj = f.check_bonus_money_yn;
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
}
//상여금 변경내용 반영
function bonus_change() {
	var f = document.dataForm;
	var bonus_standard_value = f.bonus_standard.value;
	var bonus_standard_array = new Array();
	var bonus = new Array();
	var bonus_p = new Array();
	var bonus_s = new Array();
	bonus_standard_array = ["","기본급","결정임금","통상임금","총급여"];
	//alert(bonus_standard_array[1]);
	var bonus_percent = f.bonus_percent.value;
	bonus[0] = f.bonus_0.value;
	bonus[1] = f.bonus_1.value;
	bonus[2] = f.bonus_2.value;
	bonus[3] = f.bonus_3.value;
	bonus[4] = f.bonus_4.value;
	bonus[5] = f.bonus_5.value;
	bonus_p[0] = f.bonus_p_0.value;
	bonus_p[1] = f.bonus_p_1.value;
	bonus_p[2] = f.bonus_p_2.value;
	bonus_p[3] = f.bonus_p_3.value;
	bonus_p[4] = f.bonus_p_4.value;
	bonus_p[5] = f.bonus_p_5.value;
	//alert(bonus[4]);
	if(bonus[0] != "" && bonus_p[0] != "") bonus_s[0] = bonus[0]+"("+bonus_p[0]+"%) ";
	else bonus_s[0] = "";
	if(bonus[1] != "" && bonus_p[1] != "") bonus_s[1] = bonus[1]+"("+bonus_p[1]+"%) ";
	else bonus_s[1] = "";
	if(bonus[2] != "" && bonus_p[2] != "") bonus_s[2] = bonus[2]+"("+bonus_p[2]+"%) ";
	else bonus_s[2] = "";
	if(bonus[3] != "" && bonus_p[3] != "") bonus_s[3] = bonus[3]+"("+bonus_p[3]+"%) ";
	else bonus_s[3] = "";
	if(bonus[4] != "" && bonus_p[4] != "") bonus_s[4] = bonus[4]+"("+bonus_p[4]+"%) ";
	else bonus_s[4] = "";
	if(bonus[5] != "" && bonus_p[5] != "") bonus_s[5] = bonus[5]+"("+bonus_p[5]+"%) ";
	else bonus_s[5] = "";
	if(f.check_bonus_money_yn.checked) {
		bonus_standard = f.bonus_money.value+"원";
	} else {
		bonus_standard = bonus_standard_array[bonus_standard_value];
	}
	f.bonus.value = "재직기간이 1년 이상 근속한 자에게 "+bonus_standard+"의 "+bonus_percent+"%를 지급하며, 지급시기 및 금액은 "+bonus_s[0]+""+bonus_s[1]+""+bonus_s[2]+""+bonus_s[3]+""+bonus_s[4]+""+bonus_s[5]+"지급하도록 한다.";
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
</script>
<? include "./inc/top_admin.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<div style="width:908px">
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="12%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업장명<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="21%">
										<input name="firm_name" type="text" class="textfm" style="width:190px;ime-mode:active;" value="<?=$row[com_name]?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk" width="10%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자구분<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="23%">
<?
if($row[upche_div] == "1") $chk_comp_type1 = "checked";
else if($row[upche_div] == "2") $chk_comp_type2 = "checked";
?>
										<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>개인
										<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>법인
									</td>
									<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">법인등록번호<font color="red"></font></td>
									<td nowrap  class="tdrow" width="23%">
										<input name="bupin_no" type="text" class="textfm" style="width:150px;" value="<?=$row[bupin_no]?>" maxlength="14" onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '1','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row[biz_no]?>" maxlength="12" onkeypress="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')">
										<input name="user_id" type="hidden" value="<?=$row[biz_no]?>">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:checkID();" target="">중복검색</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>  
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">비밀번호<font color="red">*</font></td>
									<td nowrap  class="tdrow">
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
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민번호</td>
									<td nowrap  class="tdrow">
										<input name="cust_ssnb" type="text" class="textfm" style="width:150;ime-mode:disabled;" value="<?=$row[jumin_no]?>" maxlength="14"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
									</td>
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
/*
$com_tel1 = str_replace("(","",$row[com_tel]);
$com_tel1 = str_replace(")","",$com_tel1);
//echo $com_tel1;
$com_tel = explode(" ",$com_tel1);
$com_tel1 = $com_tel[0];
//echo $com_tel1;

$sel_cust_tel1 = array();
//$sel_cust_tel1['051'] = "";
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel = explode("-",$com_tel[1]);
$com_tel2 = $com_tel[0];
$com_tel3 = $com_tel[1];
*/
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
/*
$com_fax1 = str_replace("(","",$row[com_fax]);
$com_fax1 = str_replace(")","",$com_fax1);
$com_fax = explode(" ",$com_fax1);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax = explode("-",$com_fax[1]);
$com_fax2 = $com_fax[0];
$com_fax3 = $com_fax[1];
*/
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
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주소</td>
									<td nowrap  class="tdrow" colspan="3">
<?
$adr_zip = explode("-",$row[com_postno]);
?>
										<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" readonly>
										-
										<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" readonly>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:checkAddress('cust');" target="">주소찾기</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[com_juso]?>" readonly>
										<br>
										<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row[com_juso2]?>" maxlength="150">
									</td>
									<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">사업자도장</td>
									<td nowrap class="tdrow"  rowspan="3">
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
									<td nowrap class="tdrowk">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">급여지급일
									</td>
									<td nowrap class="tdrow">
<?
if($row1[pay_day] == "" || $row1[pay_day] == 0) $pay_day = "";
else $pay_day = $row1[pay_day];
?>
										<input name="pay_day" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$pay_day?>" onkeypress="only_number()" maxlength="2">
<?
if($row1[pay_day_last] == 1) $pay_day_last_checked = "checked";
?>
										<input type="checkbox" name="pay_day_last" value="1" <?=$pay_day_last_checked?> onclick="pay_day_last_chk(this)"> 말일
										<input type="hidden" name="pay_day_old" value="<?=$pay_day?>">
									</td>
								</tr>
								<tr>
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
							</table>
<?
//지사 전용 ID 취업규칙 숨김
if($member['mb_level'] != 5) {
	//echo $member['mb_level'];
	//사업장 로그인시 숨김
	if($member['mb_level'] != 3) {
		//지사 관리 ID 로그인 시 사업장 추가정보 숨김
		//if($member['mb_level'] != 6) {
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
if($member['mb_level'] >= 7) {
	//echo count($man_cust_name_arry);
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
	echo "<input type='hidden' name='man_cust_name' value='".$row1[man_cust_name]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">담당매니저</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
if($member['mb_level'] >= 7) {
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
<?
$alphabet = "A";
$comp_print_type = $row1[comp_print_type];
if($member['mb_level'] >= 7) {
?>
										<select name="comp_print_type" class="selectfm">
<?
	for($i=1;$i<=26;$i++) {
?>
											<option value="<?=$alphabet?>" <? if($comp_print_type == $alphabet) echo "selected"; ?> ><?=$alphabet?></option>
<?
		$alphabet = ++$alphabet;
	}
?>
										</select>
<?
} else {
	echo $comp_print_type;
	echo "<input type='hidden' name='comp_print_type' value='".$comp_print_type."'>";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">세팅비</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 7) {
	if($row1[setting_pay]) {
		$setting_pay = number_format($row1[setting_pay]);
	} else {
		$setting_pay = "";
	}
?>
										<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$setting_pay?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkThousand(this.value, this,'Y')">
<?
} else {
	if(!$row1[setting_pay]) echo "미정";
	else echo number_format($row1[setting_pay]);
	echo "<input type='hidden' name='setting_pay' value='".$row1[setting_pay]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">월정액</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 7) {
	if($row1[month_pay]) {
		$month_pay = number_format($row1[month_pay]);
	} else {
		$month_pay = "";
	}
?>
										<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$month_pay?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkThousand(this.value, this,'Y')">
<?
} else {
	if(!$row1[month_pay]) echo "미정";
	else echo number_format($row1[month_pay]);
	echo "<input type='hidden' name='month_pay' value='".$row1[month_pay]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">해지일</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 5) {
	if($row1[leave_day]) {
		$leave_day = number_format($row1[leave_day]);
	} else {
		$leave_day = "";
	}
?>
										<input name="leave_day" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[leave_day]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '3','Y')">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.leave_day);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	if(!$row1[leave_day]) echo "미정";
	else echo number_format($row1[leave_day]);
	echo "<input type='hidden' name='leave_day' value='".$row1[leave_day]."'>";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">취업규칙승인</td>
									<td nowrap  class="tdrow">
<?
if($member['mb_level'] >= 7) {
?>
										<input type="checkbox" name="fee_amt" value="1" <? if($row[fee_amt]) echo "checked"; ?> > 승인
<?
} else {
	if($row[fee_amt]) echo "승인";
	echo "<input type='hidden' name='fee_amt' value='".$row[fee_amt]."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이지노무버전</td>
									<td nowrap  class="tdrow">
<?
if($row[lawwiz_code] == "1") {
	$sel_lawwiz_code1 = "selected";
	$lawwiz_code = "1";
} else if($row[lawwiz_code] == "2" || $row[lawwiz_code] == "") {
	$sel_lawwiz_code2 = "selected";
	$lawwiz_code = "2";
}
if($member['mb_level'] >= 7) {
?>
										<select name="lawwiz_code" class="selectfm">
											<option value=""></option>
											<option value="1" <?=$sel_lawwiz_code1?>>v1.0</option>
											<option value="2" <?=$sel_lawwiz_code2?>>v2.0</option>
										</select>
<?
} else {
	echo $lawwiz_code;
	echo "<input type='hidden' name='lawwiz_code' value='".$lawwiz_code."'>";
}
?>
									</td>
									<td nowrap class="tdrowk"></td>
									<td nowrap  class="tdrow">

									</td>
								</tr>
							</table>
<?
/*
		} else {
			//지사 관리 ID 히든 데이터
			echo "<input type='hidden' name='man_cust_name' value='".$row1[man_cust_name]."'>";
			echo "<input type='hidden' name='manage_cust_numb' value='".$row1[manage_cust_numb]."'>";
			echo "<input type='hidden' name='manage_cust_name' value='".$row1[manage_cust_name]."'>";
			echo "<input type='hidden' name='samu_cust_numb' value='".$row1[samu_cust_numb]."'>";
			echo "<input type='hidden' name='samu_cust_name' value='".$row1[samu_cust_name]."'>";
			echo "<input type='hidden' name='settlement_day'      value='".$row1[settlement_day]."'>";
			echo "<input type='hidden' name='settlement_day_last' value='".$row1[settlement_day_last]."'>";
			echo "<input type='hidden' name='samu_req_yn' value='".$row1[samu_req_yn]."'>";
			echo "<input type='hidden' name='samu_state'  value='".$row1[samu_state]."'>";
			echo "<input type='hidden' name='service_day_start' value='".$row1[service_day_start]."'>";
			echo "<input type='hidden' name='service_day_end'   value='".$row1[service_day_end]."'>";
			echo "<input type='hidden' name='setting_pay' value='".$row1[setting_pay]."'>";
			echo "<input type='hidden' name='month_pay' value='".$row1[month_pay]."'>";
		}
*/
	}
	//사업장 로그인 숨김
?>
							<div style="height:20px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/sb_tab_on_lt.gif"></td> 
												<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													<a href="javascript:tab_view('work_rule');">취업규칙 정보</a>
												</td> 
												<td><img src="images/sb_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=6></td> 
									<td valign="middle"><img src="./images/question_img.gif" onclick="clientxy();" style="cursor:pointer"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bbtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

<script language="javascript">
function clientxy(e) {
	var browser = navigator.appName
	if(browser=="Microsoft Internet Explorer") {   //브라우저가 IE일때 돌아간다. 크롬에서 써도 잘 된다.
		//alert("현재 좌표는 " + event.x + "/" + event.y);
		x = event.x;
		y = event.y+document.body.scrollTop;
	} else {   //그외(파이어폭스)일 때 돌아간다.
		//alert("현재 좌표는 " + e.clientX + "/" + e.clientY);
		x = e.clientX;
		y = e.clientY;
	}
	//이거는 그냥 덤으로 현재 브라우저의 가운데 좌표 표시
	//alert("가운데 좌표는" + screen.width/2 + "/" + screen.height/2 )
	div_id = document.getElementById('couponHelpDiv');
	div_id.style.display = 'block';
	div_id.style.top = y+"px";
	div_id.style.left = x+"px";
}
</script>
<style type="text/css">
#wrapper02 .CPWalletArea {
	background: rgb(255, 255, 255); margin: auto; border: 1px solid rgb(226, 1, 102); width:500px; display: block;
}
#wrapper02 .CPWalletArea .CPImg {
	top: -5px; right: 22px; display: block; position: absolute;
}
*:first-child + html #wrapper02 .CPWalletArea .CPImg {
	top: -9px; right: 22px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea .nwapClsBtn01 {
	top: 15px; right: 15px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea h3 {
	margin: 0px; padding: 20px 0px 10px 20px; color: rgb(226, 1, 102); font-size: 12px;
}
#wrapper02 .CPWalletArea ol {
	list-style: none; margin: 0px; padding: 0px 20px 20px; text-align: left; color: rgb(102, 102, 102); font-size: 11px;
}
#wrapper02 .CPWalletArea ol li {
	margin: 0px; padding: 0px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc {
	line-height: 15px; padding-top: 5px;
}
#wrapper02 .CPWalletArea ol .nwapCPStit {
	padding-top: 25px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 {
	
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 img {
	vertical-align: middle;
}
#wrapper02 .CPWalletArea .nwapCPDisc a {
	color: rgb(51, 51, 51); text-decoration: underline !important;
}
#wrapper02 .CPWalletArea .nwapCPDisc span {
	color: rgb(226, 1, 102);
}
</style>
<!-- 도움말 :: start -->
<div id="couponHelpDiv" style="display:none; position:absolute; top:0; left:0;">
	<div id="wrapper02">
		<div class="CPWalletArea">
			<!--<div class="CPImg"><img src="./images/pay_img01.gif" width="8" height="6" alt="" /></div>-->
			<h3>취업규칙 서식 자동 입력 기능</h3>
			<ol>
				<li><strong>1. 휴게시간 설정</strong>
					<ul>
						<li class="nwapCPDisc">휴게시간(오전), 휴게(중식)시간, 휴게시간(오후) 시간 설정이 가능합니다.</li>
					</ul>
				</li>
				<li class="nwapCPStit"><strong>2.휴일 설정</strong>
					<ul class="nwapCPDisc">
						<li>총 8가지의 휴일을 설정할 수 있습니다.</li>
						<li>설날, 추석, 신정 설정
							<ul class="nwapCPDisc01">
								<li>설날 : 관공서 공휴일</li>
								<li>추석 : 관공서 공휴일</li>
								<li>신정 : 1일</li>
							</ul>
						</li>
						<li>휴가 설정</li>
							<ul class="nwapCPDisc01">
								<li>하기휴가 : 3일(공휴일제외)</li>
								<li>경조휴가 : 14가지 설정 가능</li>
								<li>신정 : 1일</li>
							</ul>
						</li>
						<li>임금계산기간 : 당월 초일부터 말일까지로 하며, 다음달 10일</li>
						<li>정기상여금 : 재직기간이 1년 이상 근속한 자에게 기본급의 200%를 지급하며, 지급시기 및 금액은 구정 100%, 추석 100% 지급하도록 한다.</li>
					</ul>
				</li>
			</ol>
			<div style="position:absolute; right:15px; top:15px;">
				<img src="images/pay_cls_btn02.gif" alt="닫기" onclick="$('#couponHelpDiv').css('display','none')" style="cursor:pointer" />
			</div>
		</div>
	</div>
</div>
<!-- 도움말 :: end -->
<?
$persons = $row1[persons];
$man = $row1[man];
$woman = $row1[woman];
$stime = $row1[stime];
$etime = $row1[etime];
$rest1 = $row1[rest1];
$rest1e = $row1[rest1e];
$rest2 = $row1[rest2];
$rest2e = $row1[rest2e];
$rest3 = $row1[rest3];
$rest3e = $row1[rest3e];
$hday = $row1[hday];
//토요일 유급휴일
$saturday_paid = $row1[saturday_paid];
//명절
$fday1 = $row1[fday1];
$fday2 = $row1[fday2];
$fday3 = $row1[fday3];
//유급휴일
$hday1 = $row1[hday1];
$hday2 = $row1[hday2];
$hday3 = $row1[hday3];
$hday4 = $row1[hday4];
$hday5 = $row1[hday5];
$hday6 = $row1[hday6];
$hday7 = $row1[hday7];
$hday8 = $row1[hday8];
$hday9 = $row1[hday9];
$hday10 = $row1[hday10];
$hday11 = $row1[hday11];
$hday12 = $row1[hday12];
$holiday1 = $row1[holiday1];
$holiday2 = $row1[holiday2];
$holiday3 = $row1[holiday3];
$holiday4 = $row1[holiday4];
$holiday5 = $row1[holiday5];
$holiday6 = $row1[holiday6];
$summer_vacation = $row1[summer_vacation];
//경조사(유급)
$affair1 = $row1[affair1];
$affair2 = $row1[affair2];
$affair3 = $row1[affair3];
$affair4 = $row1[affair4];
$affair5 = $row1[affair5];
$affair6 = $row1[affair6];
$affair7 = $row1[affair7];
$affair8 = $row1[affair8];
$affair9 = $row1[affair9];
$affair10 = $row1[affair10];
$affair11 = $row1[affair11];
$affair12 = $row1[affair12];
//유급휴가
$vacation1 = $row1[vacation1];
$vacation2 = $row1[vacation2];
$vacation3 = $row1[vacation3];
$vacation4 = $row1[vacation4];
$vacation5 = $row1[vacation5];
$vacation6 = $row1[vacation6];
$vacation7 = $row1[vacation7];
$vacation8 = $row1[vacation8];
$vacation9 = $row1[vacation9];
$vacation10 = $row1[vacation10];
$vacation11 = $row1[vacation11];
$vacation12 = $row1[vacation12];
$celebrate_mourn1 = $row1[celebrate_mourn1];
$celebrate_mourn2 = $row1[celebrate_mourn2];
$celebrate_mourn3 = $row1[celebrate_mourn3];
$celebrate_mourn4 = $row1[celebrate_mourn4];
$celebrate_mourn5 = $row1[celebrate_mourn5];
$celebrate_mourn6 = $row1[celebrate_mourn6];
$pay_calculate_day_period = $row1[pay_calculate_day_period];
$pay_calculate_day_period1 = $row1[pay_calculate_day_period1];
$pay_calculate_day_period2 = $row1[pay_calculate_day_period2];
$pay_calculate_day_period3 = $row1[pay_calculate_day_period3];
$pay_calculate_day1 = $row1[pay_calculate_day1];
$pay_calculate_day2 = $row1[pay_calculate_day2];
$pay_calculate_day3 = $row1[pay_calculate_day3];
$retirement_age_rule = $row1[retirement_age_rule];
$retirement_age_rule1 = $row1[retirement_age_rule1];
$retirement_age_rule2 = $row1[retirement_age_rule2];
$retirement_gbn_array = explode(",",$row1[retirement_gbn]);
if($retirement_gbn_array[0] == "1") $retirement_gbn1_chk = "checked";
if($retirement_gbn_array[1] == "1") $retirement_gbn2_chk = "checked";
if($retirement_gbn_array[2] == "1") $retirement_gbn3_chk = "checked";
$bonus = $row1[bonus];
//채용서류
$document_before1 = $row1[document_before1];
$document_before2 = $row1[document_before2];
$document_before3 = $row1[document_before3];
$document_before4 = $row1[document_before4];
$document_before5 = $row1[document_before5];
$document_before6 = $row1[document_before6];
$document_after1 = $row1[document_after1];
$document_after2 = $row1[document_after2];
$document_after3 = $row1[document_after3];
$document_after4 = $row1[document_after4];
$document_after5 = $row1[document_after5];
$document_after6 = $row1[document_after6];
//임금체계
$pay_system = $row1[pay_system];
$pay_structure = $row1[pay_structure];
$pay_payment = $row1[pay_payment];
//시행일
$conduct_day = $row1[conduct_day];
//취업규칙 데이터값
if(!$persons) {
	if(!$stime) $stime = "9:00";
	if(!$etime) $etime = "18:00";
	if(!$rest1) $rest1 = "";
	if(!$rest1e) $rest1e = "";
	if(!$rest2) $rest2 = "12:00";
	if(!$rest2e) $rest2e = "13:00";
	if(!$rest3) $rest3 = "";
	if(!$rest3e) $rest3e = "";

	if(!$fday1) $fday1 = "신정";
	if(!$fday2) $fday2 = "구정";
	if(!$fday3) $fday3 = "추석";

	if(!$hday) $hday = "일요일";
	if(!$hday1) $hday1 = "근로자의날";
	if(!$hday2) $hday2 = "삼일절";
	if(!$hday3) $hday3 = "어린이날";
	if(!$hday4) $hday4 = "석가탄신일";
	if(!$hday5) $hday5 = "현충일";
	if(!$hday6) $hday6 = "광복절";
	if(!$hday7) $hday7 = "개천절";
	if(!$hday8) $hday8 = "한글날";
	if(!$hday9) $hday9 = "성탄절";
	if(!$hday10) $hday10 = "";
	if(!$hday11) $hday11 = "";
	if(!$hday12) $hday12 = "";

	if(!$affair1) $affair1 = "본인 결혼 1일";
	if(!$affair2) $affair2 = "자녀 결혼 1일";
	if(!$affair3) $affair3 = "형제자매 결혼 1일";
	if(!$affair4) $affair4 = "자녀 출산 1일";
	if(!$affair5) $affair5 = "본인 부모 수연 1일";
	if(!$affair6) $affair6 = "배우자 부모 수연 1일";
	if(!$affair7) $affair7 = "배우자 사망 1일";
	if(!$affair8) $affair8 = "자녀 사망 1일";
	if(!$affair9) $affair9 = "본인 부모 사망 1일";
	if(!$affair10) $affair10 = "본인 조부모 사망 사망 1일";
	if(!$affair11) $affair11 = "배우자 부모 사망 1일";
	if(!$affair12) $affair12 = "배우자 조부모 사망 1일";

	if(!$pay_calculate_day1) $pay_calculate_day1 = "당월";
	if(!$pay_calculate_day_period1) $pay_calculate_day_period1 = "1";
	if(!$pay_calculate_day2) $pay_calculate_day2 = "당월";
	if(!$pay_calculate_day_period2) $pay_calculate_day_period4 = "말";
	if(!$pay_calculate_day3) $pay_calculate_day3 = "익월";
	if(!$pay_calculate_day_period3) $pay_calculate_day_period3 = "10";

	if(!$document_before1) $document_before1 = "자필이력서(사진첨부) 1통";
	if(!$document_before2) $document_before2 = "자기소개서 1통";
	if(!$document_before3) $document_before3 = "주민등록등본 1통";
	if(!$document_before4) $document_before4 = "자격 또는 면허증(해당자에 한함) 사본 1통";
	if(!$document_before5) $document_before5 = "기타 회사가 요구하는 서류";
	if(!$document_before6) $document_before6 = "";

	if(!$document_after1) $document_after1 = "주민등록등본 2통";
	if(!$document_after2) $document_after2 = "근로계약서 및 서약서 1통";
	if(!$document_after3) $document_after3 = "건강진단서 1통";
	if(!$document_after4) $document_after4 = "사진 2매(3x4)";
	if(!$document_after5) $document_after5 = "기타 회사가 필요로 하는 서류";
	if(!$document_after6) $document_after6 = "";

	if(!$pay_system) $pay_system = "월급제";
	if(!$pay_structure) $pay_structure = "포괄임금제";
	if(!$pay_payment) $pay_payment = "2";
}
//상여금 초기화
if(!$retirement_age_rule) {
	echo "<script language='javascript'>addLoadEvent(retirement_age_rule_change);</script>";
}
if($member['mb_level'] != 3) $work_rule_display = "display:none";
?>
							<div id="work_rule" style="<?=$work_rule_display?>">
								<!--댑메뉴-->
								<div style="height:1px;font-size:0px;line-height:0px;"></div>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														채용서류
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3" width="11%">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">채용전서류
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add6('document_before');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del6('document_before');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow">
											<div style="">
												<input name="document_before1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before1?>" maxlength="70">
												<input name="document_before2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before2?>" maxlength="70">
												<input name="document_before3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before3?>" maxlength="70">
											</div>
											<div id="document_before4" style="<? if($document_before4 == "") echo "display:none"; ?>">
												<input name="document_before4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before4?>" maxlength="70">
												<input name="document_before5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before5?>" maxlength="70">
												<input name="document_before6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_before6?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3" width="11%">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">채용후서류
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add6('document_after');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del6('document_after');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow">
											<div style="">
												<input name="document_after1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after1?>" maxlength="70">
												<input name="document_after2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after2?>" maxlength="70">
												<input name="document_after3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after3?>" maxlength="70">
											</div>
											<div id="document_after4" style="<? if($document_after4 == "") echo "display:none"; ?>">
												<input name="document_after4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after4?>" maxlength="70">
												<input name="document_after5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after5?>" maxlength="70">
												<input name="document_after6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$document_after6?>" maxlength="70">
											</div>
										</td>
									</tr>
								</table>
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<div style="float:left;">
									<table border=0 cellspacing=0 cellpadding=0 style="">
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:130px;text-align:center'> 
															근로자수/근무시간
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
								</div>
								<div style="margin:0 0 0 455px">
									<table border=0 cellspacing=0 cellpadding=0 style="">
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															휴게시간
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
								</div>
								<div style="height:2px;font-size:0px;line-height:0px;" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">근로자수</td>
										<td nowrap  class="tdrow" width="39%">
											총<input name="persons" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$persons?>" maxlength="3">명,
											남자 <input name="man" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$man?>" maxlength="3">명,
											여자 <input name="woman" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$woman?>" maxlength="3">명
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">오전</td>
										<td nowrap  class="tdrow">
											<input name="rest1" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest1?>" maxlength="5"> ~ <input name="rest1e" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest1e?>" maxlength="5"> 예) 10:30~11:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">시업시간</td>
										<td nowrap  class="tdrow">
											<input name="stime" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stime?>" maxlength="5"> 예) 9:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">점심</td>
										<td nowrap  class="tdrow">
											<input name="rest2" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest2?>" maxlength="5"> ~ <input name="rest2e" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest2e?>" maxlength="5"> 예) 12:00~13:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">종업시간</td>
										<td nowrap  class="tdrow">
											<input name="etime" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$etime?>" maxlength="5"> 예) 18:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">저녁</td>
										<td nowrap  class="tdrow">
											<input name="rest3" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest3?>" maxlength="5"> ~ <input name="rest3e" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$rest3e?>" maxlength="5"> 예) 14:30~15:00
										</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														휴일
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주휴일</td>
										<td class="tdrow" width="39%">
											<input name="hday" type="text" class="textfm" style="width:190px;ime-mode:active;" value="<?=$hday?>" maxlength="10"> 예) 일요일
										</td>
										<td class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">토요일 유급</td>
										<td class="tdrow" width="39%">
											<input type="checkbox" name="saturday_paid" value="1" <? if($saturday_paid == "1") echo "checked"; ?>> 토요일 유급휴일
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">명절
										</td>
										<td  class="tdrow" colspan="3">
											<div style="">
												<input name="fday1" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$fday1?>" maxlength="70">
												<input name="fday2" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$fday2?>" maxlength="70">
												<input name="fday3" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$fday3?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">유급휴일
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add('hday');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del('hday');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td  class="tdrow" colspan="3">
											<div style="">
												<input name="hday1" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday1?>" maxlength="70">
												<input name="hday2" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday2?>" maxlength="70">
												<input name="hday3" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday3?>" maxlength="70">
											</div>
											<div id="hday4" style="<? if($hday4 == "") echo "display:none"; ?>">
												<input name="hday4" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday4?>" maxlength="70">
												<input name="hday5" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday5?>" maxlength="70">
												<input name="hday6" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday6?>" maxlength="70">
											</div>
											<div id="hday7" style="<? if($hday7 == "") echo "display:none"; ?>">
												<input name="hday7" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday7?>" maxlength="70">
												<input name="hday8" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday8?>" maxlength="70">
												<input name="hday9" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday9?>" maxlength="70">
											</div>
											<div id="hday10" style="<? if($hday10 == "") echo "display:none"; ?>">
												<input name="hday10" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday10?>" maxlength="70">
												<input name="hday11" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday11?>" maxlength="70">
												<input name="hday12" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$hday12?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">무급휴일
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add6('holiday');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del6('holiday');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td  class="tdrow" colspan="3">
											<div style="">
												<input name="holiday1" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday1?>" maxlength="70">
												<input name="holiday2" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday2?>" maxlength="70">
												<input name="holiday3" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday3?>" maxlength="70">
											</div>
											<div id="holiday4" style="<? if($holiday4 == "") echo "display:none"; ?>">
												<input name="holiday4" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday4?>" maxlength="70">
												<input name="holiday5" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday5?>" maxlength="70">
												<input name="holiday6" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$holiday6?>" maxlength="70">
											</div>
										</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														휴가
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap width="11%" style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">경조사(유급)
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add('affair');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del('affair');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow">
											<div style="">
												<input name="affair1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair1?>" maxlength="70">
												<input name="affair2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair2?>" maxlength="70">
												<input name="affair3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair3?>" maxlength="70">
											</div>
											<div id="affair4" style="<? if(!$affair4) echo "display:none"; ?>">
												<input name="affair4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair4?>" maxlength="70">
												<input name="affair5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair5?>" maxlength="70">
												<input name="affair6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair6?>" maxlength="70">
											</div>
											<div id="affair7" style="<? if(!$affair7) echo "display:none"; ?>">
												<input name="affair7" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair7?>" maxlength="70">
												<input name="affair8" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair8?>" maxlength="70">
												<input name="affair9" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair9?>" maxlength="70">
											</div>
											<div id="affair10" style="<? if(!$affair10) echo "display:none"; ?>">
												<input name="affair10" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair10?>" maxlength="70">
												<input name="affair11" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair11?>" maxlength="70">
												<input name="affair12" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$affair12?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap width="11%" style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">유급휴가
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add('vacation');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del('vacation');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow">
											<div style="">
												<input name="vacation1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation1?>" maxlength="70">
												<input name="vacation2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation2?>" maxlength="70">
												<input name="vacation3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation3?>" maxlength="70">
											</div>
											<div id="vacation4" style="<? if(!$vacation4) echo "display:none"; ?>">
												<input name="vacation4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation4?>" maxlength="70">
												<input name="vacation5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation5?>" maxlength="70">
												<input name="vacation6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation6?>" maxlength="70">
											</div>
											<div id="vacation7" style="<? if(!$vacation7) echo "display:none"; ?>">
												<input name="vacation7" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation7?>" maxlength="70">
												<input name="vacation8" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation8?>" maxlength="70">
												<input name="vacation9" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation9?>" maxlength="70">
											</div>
											<div id="vacation10" style="<? if(!$vacation10) echo "display:none"; ?>">
												<input name="vacation10" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation10?>" maxlength="70">
												<input name="vacation11" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation11?>" maxlength="70">
												<input name="vacation12" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$vacation12?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">무급휴가
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add6('celebrate_mourn');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del6('celebrate_mourn');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow">
											<div style="">
												<input name="celebrate_mourn1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn1?>" maxlength="70">
												<input name="celebrate_mourn2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn2?>" maxlength="70">
												<input name="celebrate_mourn3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn3?>" maxlength="70">
											</div>
											<div id="celebrate_mourn4" style="<? if(!$celebrate_mourn4) echo "display:none"; ?>">
												<input name="celebrate_mourn4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn4?>" maxlength="70">
												<input name="celebrate_mourn5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn5?>" maxlength="70">
												<input name="celebrate_mourn6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$celebrate_mourn6?>" maxlength="70">
											</div>
										</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														임금체계
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금체계</td>
										<td nowrap  class="tdrow" width="39%">
											<input name="pay_system" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$pay_system?>" maxlength="10"> 예) 월급제
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금구성</td>
										<td nowrap  class="tdrow" width="">
											<input name="pay_structure" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$pay_structure?>" maxlength="10"> 예) 포괄입금제
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금계산기간</td>
										<td nowrap  class="tdrow" colspan="2">
											<input type="text" name="pay_calculate_day1" class="textfm" value="<?=$pay_calculate_day1?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period1" class="textfm" value="<?=$pay_calculate_day_period1?>" style="width:30px;ime-mode:active;">
											일부터
											<input type="text" name="pay_calculate_day2" class="textfm" value="<?=$pay_calculate_day2?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period2" class="textfm" value="<?=$pay_calculate_day_period2?>" style="width:30px;ime-mode:active;">
											일까지로 하며,
											<input type="text" name="pay_calculate_day3" class="textfm" value="<?=$pay_calculate_day3?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period3" class="textfm" value="<?=$pay_calculate_day_period3?>" style="width:30px;ime-mode:active;">
											일
										</td>
										<td nowrap  class="tdrow" width="">
											예) 당월 1일부터 당월 말일까지로 하며, 익월 10일
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지급방법</td>
										<td nowrap  class="tdrow" width="">
<?
if($pay_payment == "1") $pay_payment_type1 = "checked";
else if($pay_payment == "2") $pay_payment_type2 = "checked";
?>
											<input type="radio" name="pay_payment" value="1" <?=$pay_payment_type1?>>직접지급
											<input type="radio" name="pay_payment" value="2" <?=$pay_payment_type2?>>통장임금
										</td>
										<td nowrap class="tdrowk" width=""></td>
										<td nowrap  class="tdrow" width="">
										</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<div style="float:left;">
									<table border=0 cellspacing=0 cellpadding=0 style="">
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															정년연령
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
										</tr> 
									</table>
								</div>
								<div style="margin:0 0 0 455px">
									<table border=0 cellspacing=0 cellpadding=0 style="">
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															퇴직금
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
										</tr> 
									</table>
								</div>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">정년연령</td>
										<td nowrap  class="tdrow" width="39%">
											<input type="text" name="retirement_age_rule" class="textfm" value="<?=$retirement_age_rule?>" style="width:264px;ime-mode:active;">
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직금</td>
										<td nowrap  class="tdrow">
											<input type="checkbox" name="retirement_gbn1" value="1" <?=$retirement_gbn1_chk?>> 퇴직시정산
											<input type="checkbox" name="retirement_gbn2" value="1" <?=$retirement_gbn2_chk?>> 퇴직연금
											<input type="checkbox" name="retirement_gbn3" value="1" <?=$retirement_gbn3_chk?>> 퇴직금중간정산
										</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														정기상여금
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="middle"><img src="./images/question_img.gif" onclick="//clientxy();" style="cursor:pointer"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
<?
$bonus_array = explode(",",$row1[bonus_time]);
if($bonus_array[0] == "") $bonus_time1 = "설";
else $bonus_time1 = $bonus_array[0];
if($bonus_array[1] == "") $bonus_time2 = "추석";
else $bonus_time2 = $bonus_array[1];
if($bonus_array[2] == "") $bonus_time3 = "하기휴가";
else $bonus_time3 = $bonus_array[2];
if($bonus_array[3] == "") $bonus_time4 = "연말";
else $bonus_time4 = $bonus_array[3];
if($bonus_array[4] == "") $bonus_time5 = "";
else $bonus_time5 = $bonus_array[4];
if($bonus_array[5] == "") $bonus_time6 = "";
else $bonus_time6 = $bonus_array[5];
$bonus_p = explode(",",$row1[bonus_p]);
//상여금 수동입력
$check_bonus_money_yn = $row1[check_bonus_money_yn];
$bonus_money = $row1[bonus_money];
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk_center">구 분</td>
										<td class="tdrowk">산정기준</td>
										<td class="tdrowk">지급시기1</td>
										<td class="tdrowk">지급시기2</td>
										<td class="tdrowk">지급시기3</td>
										<td class="tdrowk">지급시기4</td>
										<td class="tdrowk">지급시기5</td>
										<td class="tdrowk">지급시기6</td>
									</tr>
									<tr>
										<td class="tdrowk" style="padding:5px">명칭</td>
										<td class="tdrow" width="140">
											<select name="bonus_standard" id="bonus_standard" onchange="bonus_change()" class="selectfm" style="width:74px;<? if($check_bonus_money_yn == "Y") echo "display:none"; else echo "display:inline"; ?>">
												<option value="1" <? if($row1[bonus_standard] == "1") echo "selected"; ?> >기본급</option>
												<option value="2" <? if($row1[bonus_standard] == "2") echo "selected"; ?> >결정임금</option>
												<option value="3" <? if($row1[bonus_standard] == "3") echo "selected"; ?> >통상임금</option>
												<option value="4" <? if($row1[bonus_standard] == "4") echo "selected"; ?> >총급여</option>
											</select>
											<input name="bonus_money" id="bonus_money" type="text" class="textfm" style="width:76px;ime-mode:disabled;<? if($check_bonus_money_yn != "Y") echo "display:none"; else echo "display:inline"; ?>" value="<?=number_format($bonus_money)?>" maxlength="10" onblur="" onkeyup="only_number();checkThousand(this.value, this,'Y');bonus_change();">
											<input type="checkbox" name="check_bonus_money_yn" id="check_bonus_money_yn" value="<?=$check_bonus_money_yn?>" <? if($check_bonus_money_yn == "Y") echo "checked"; ?> onClick="checkBonus_MoneyYn();bonus_change()">수동
										</td>
										<td class="tdrow"><input name="bonus_0" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time1?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus_1" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time2?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus_2" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time3?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus_3" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time4?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus_4" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time5?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus_5" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time6?>" maxlength="10"></td>
									</tr>
									<tr>
										<td class="tdrowk">상여비율</td>
										<td class="tdrow"><input name="bonus_percent" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$row1[bonus_percent]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_0" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[0]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_1" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[1]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_2" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[2]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_3" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[3]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_4" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[4]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p_5" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[5]?>" maxlength="3">%</td>
									</tr>
								</table>
								<!--댑메뉴-->
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">표시문구</td>
										<td nowrap  class="tdrow" width="821">
											<input name="bonus" type="text" class="textfm" style="width:817px;ime-mode:active;" value="<?=$bonus?>" maxlength="">
										</td>
									</tr>
								</table>
							</div>
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
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">이용약관<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="20%">
										<input name="agree_check1" type="checkbox" value="Y"/> 동의
									</td>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">개인정보취급방침<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="50%">
										<input name="agree_check2" type="checkbox" value="Y"/> 동의
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
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_no_right();";
	$url_rule1 = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
	$url_rule1 = "./form_labor_admin.php?labor=rule1&mb_id=$row[biz_no]";
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;"><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;"><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./com_list_admin.php?page=<?=$page?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;"><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_rule1?>" target="">취업규칙</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;"><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="com_view_admin.php" target="">신규등록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
									</td>
								</tr>
							</table>
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
							</div>
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