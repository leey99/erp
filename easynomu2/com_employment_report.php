<?
$sub_menu = "100500";
include_once("./_common.php");

$sql_common = " from $g4[com_list_gy] ";

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$id = "00002";
}
//com_code 검색
$sql_com_code = " select * from com_list_gy where biz_no='$member[mb_id]' ";
$result_com_code = sql_query($sql_com_code);
$row_com_code = sql_fetch_array($result_com_code);
$id = $row_com_code[com_code];
//강제 수정모드
$w = "u";
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

$sub_title = "취업규칙";
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
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.persons.value == "") {
		alert("근로자수를 입력하세요.");
		frm.persons.focus();
		return;
	}
	frm.action = "com_employment_report_update.php";
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
	f.retirement_age_rule.value = "만 "+retirement_age+"세가 되는 날이 속하는 달의 당일";
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
//상여금 수동입력
function checkBonus_Money12Yn(obj) {
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
	if(bonus_percent == "0" || bonus_percent == "") {
		f.bonus.value = "회사의 상황에 따라 지급할수도 있다";
	} else {
		if(f.check_bonus_money12_yn.checked) bonus_s_text = "매월 일정금액을";
		else bonus_s_text = bonus_s[0]+""+bonus_s[1]+""+bonus_s[2]+""+bonus_s[3]+""+bonus_s[4]+""+bonus_s[5];
		f.bonus.value = "회사는 재직기간이 1년 이상 근속한 자에게 "+bonus_standard+"의 "+bonus_percent+"%를 지급하며, 지급시기 및 금액은 "+bonus_s_text+" 지급하도록 한다.";
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
<?
$com_name = $row[com_name];
if($row[upche_div] == "1") $comp_type = "개인";
else if($row[upche_div] == "2") $comp_type = "법인";
$comp_bznb = $row[biz_no];
$boss_name = $row[boss_name];
?>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										사업장명 : <?=$com_name?> / 사업자구분 : <?=$comp_type?> / 사업자등록번호 : <?=$comp_bznb?> / 대표자명 : <?=$boss_name?>
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px;background:#226bd4;"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA" style="margin:0">
							<input type="hidden" name="w" value="<?=$w?>">
							<!-- 입력폼 -->

							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->

<script language="javascript">
function getInternetVersion(browser) {
	var rv = -1; // Return value assumes failure.     
	var ua = navigator.userAgent; 
	var re = null;
	if(browser=="MSIE") {
	 re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	 if(re.exec(ua) == null) { // IE11 above (Trident)
		re = new RegExp("rv:([0-9]{1,}[\.0-9]{0,})");
	 }
	}
	else if(browser=="Safari" || browser=="Opera") re = new RegExp("Version/([0-9]{1,}[\.0-9]{0,})");
	else re = new RegExp(browser+"/([0-9]{1,}[\.0-9]{0,})");
	if(re.exec(ua) != null) {
	 rv = parseInt(RegExp.$1);
	}
	return rv; 
}
//브라우저 종류 및 버전확인 
function getBroswserType() {
	var browser = "UnKnown";
	if(navigator.appName.charAt(0) == "N") { // Netscape
	 if(navigator.userAgent.indexOf("Chrome") != -1) browser = "Chrome";
	 else if(navigator.userAgent.indexOf("Firefox") != -1) browser = "Firefox";
	 else if(navigator.userAgent.indexOf("Safari") != -1) browser = "Safari";
	 else if(navigator.userAgent.indexOf("Opera") != -1) browser = "Opera";
	 else if(navigator.userAgent.indexOf("Trident") != -1) browser = "MSIE"; // IE11 above (Trident)
	}
	else if(navigator.appName.charAt(0) == "M") { // Microsoft Internet Explorer
	 browser = "MSIE";
	}
	else if(navigator.appName.indexOf("Opera") != -1) { // Opera
	 browser = "Opera";
	}
	return browser;
}
//좌표 설정
function clientxy(e) {
	var frm = document.dataForm;

	// InternetVersion
 var browser = getBroswserType();
 var ver = getInternetVersion(browser);

	//var browser = navigator.userAgent
	//frm.error_code.value = browser+" "+ver;
	if(browser=="MSIE") {   //브라우저가 IE일때 돌아간다. 크롬에서 써도 잘 된다.
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
				<img src="https://img.akmall.com/imgs/ak_wap/cart_box/pay_cls_btn02.gif" alt="닫기" onclick="$('#couponHelpDiv').css('display','none')" style="cursor:pointer" />
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
$stime_b = $row1[stime_b];
$etime_b = $row1[etime_b];
$rest1_b = $row1[rest1_b];
$rest1e_b = $row1[rest1e_b];
$rest2_b = $row1[rest2_b];
$rest2e_b = $row1[rest2e_b];
$rest3_b = $row1[rest3_b];
$rest3e_b = $row1[rest3e_b];
//연장/야간근무
$ext = $row1[ext];
$exte = $row1[exte];
$ext_b = $row1[ext_b];
$exte_b = $row1[exte_b];
$night = $row1[night];
$nighte = $row1[nighte];
$night_b = $row1[night_b];
$nighte_b = $row1[nighte_b];
//토/일요일근무
$saturday_work = $row1[saturday_work];
$saturday_work_b = $row1[saturday_work_b];
$sunday_work = $row1[sunday_work];
$sunday_work_b = $row1[sunday_work_b];
$saturday_time = $row1[saturday_time];
$saturday_time_b = $row1[saturday_time_b];
$sunday_time = $row1[sunday_time];
$sunday_time_b = $row1[sunday_time_b];
$saturday_timee = $row1[saturday_timee];
$saturday_timee_b = $row1[saturday_timee_b];
$sunday_timee = $row1[sunday_timee];
$sunday_timee_b = $row1[sunday_timee_b];
//주휴일
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
$pay_calculate_a = $row1[pay_calculate_a];
$pay_calculate_day_period = $row1[pay_calculate_day_period];
$pay_calculate_day_period1 = $row1[pay_calculate_day_period1];
$pay_calculate_day_period2 = $row1[pay_calculate_day_period2];
$pay_calculate_day_period3 = $row1[pay_calculate_day_period3];
$pay_calculate_day1 = $row1[pay_calculate_day1];
$pay_calculate_day2 = $row1[pay_calculate_day2];
$pay_calculate_day3 = $row1[pay_calculate_day3];
$pay_calculate_b = $row1[pay_calculate_b];
$pay_calculate_day_period_b = $row1[pay_calculate_day_period_b];
$pay_calculate_day_period1_b = $row1[pay_calculate_day_period1_b];
$pay_calculate_day_period2_b = $row1[pay_calculate_day_period2_b];
$pay_calculate_day_period3_b = $row1[pay_calculate_day_period3_b];
$pay_calculate_day1_b = $row1[pay_calculate_day1_b];
$pay_calculate_day2_b = $row1[pay_calculate_day2_b];
$pay_calculate_day3_b = $row1[pay_calculate_day3_b];
$retirement_age_rule = $row1[retirement_age_rule];
$retirement_age_rule1 = $row1[retirement_age_rule1];
$retirement_age_rule2 = $row1[retirement_age_rule2];
$retirement_gbn_array = explode(",",$row1[retirement_gbn]);
if($retirement_gbn_array[0] == "1") $retirement_gbn1_chk = "checked";
if($retirement_gbn_array[1] == "1") $retirement_gbn2_chk = "checked";
if($retirement_gbn_array[2] == "1") $retirement_gbn3_chk = "checked";
$retirement_annuity = $row1[retirement_annuity];
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
	if(!$rest1) $rest1 = "12:00";
	if(!$rest1e) $rest1e = "13:00";
	if(!$rest2) $rest2 = "";
	if(!$rest2e) $rest2e = "";
	if(!$rest3) $rest3 = "";
	if(!$rest3e) $rest3e = "";

	if(!$fday1) $fday1 = "신정";
	if(!$fday2) $fday2 = "구정";
	if(!$fday3) $fday3 = "추석";

	if(!$hday) $hday = "일요일";
	if(!$saturday_paid) $saturday_paid = 1;

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

	if(!$pay_calculate_a) $pay_calculate_a = "사무직";
	if(!$pay_calculate_day1) $pay_calculate_day1 = "당월";
	if(!$pay_calculate_day_period1) $pay_calculate_day_period1 = "1";
	if(!$pay_calculate_day2) $pay_calculate_day2 = "당월";
	if(!$pay_calculate_day_period2) $pay_calculate_day_period2 = "말";
	if(!$pay_calculate_day3) $pay_calculate_day3 = "익월";
	if(!$pay_calculate_day_period3) $pay_calculate_day_period3 = "10";

	if(!$pay_calculate_b) $pay_calculate_b = "사무직";
	if(!$pay_calculate_day1_b) $pay_calculate_day1_b = "당월";
	if(!$pay_calculate_day_period1_b) $pay_calculate_day_period1_b = "1";
	if(!$pay_calculate_day2_b) $pay_calculate_day2_b = "당월";
	if(!$pay_calculate_day_period2_b) $pay_calculate_day_period2_b = "말";
	if(!$pay_calculate_day3_b) $pay_calculate_day3_b = "익월";
	if(!$pay_calculate_day_period3_b) $pay_calculate_day_period3_b = "10";

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
?>
							<div id="work_rule" style="">
								<div style="height:1px;font-size:0px;line-height:0px;"></div>
<?
//청양지피엠
if($com_code == "20247") {
	echo "<div style='padding:10px'><a href='files/hwp/취업규칙_청양지피엠.hwp'><img src='images/arbeitsordnung_download.png' border='0'></a></div>";
} else {
?>
								<!--댑메뉴-->
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<div style="float:;">
									<table border=0 cellspacing=0 cellpadding=0 style="">
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															근로자수
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
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">근로자수<font color="red">*</font></td>
										<td nowrap  class="tdrow" width="">
											총<input name="persons" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$persons?>" maxlength="3">명,
											남자 <input name="man" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$man?>" maxlength="3">명,
											여자 <input name="woman" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$woman?>" maxlength="3">명
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
															근무시간 A형
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"><input name="work_gbn_text_a" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row1['work_gbn_text_a']?>" maxlength="10"></td> 
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
															근무시간 B형
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"><input name="work_gbn_text_b" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row1['work_gbn_text_b']?>" maxlength="10"></td> 
										</tr> 
									</table>
								</div>
								<div style="height:2px;font-size:0px;line-height:0px;" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">시업시간</td>
										<td nowrap  class="tdrow" width="39%">
											<input name="stime" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$stime?>" maxlength="5"> 예) 9:00
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">시업시간</td>
										<td nowrap  class="tdrow">
											<input name="stime_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$stime_b?>" maxlength="5"> 예) 9:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">종업시간</td>
										<td nowrap  class="tdrow">
											<input name="etime" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$etime?>" maxlength="5"> 예) 18:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">종업시간</td>
										<td nowrap  class="tdrow">
											<input name="etime_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$etime_b?>" maxlength="5"> 예) 18:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간1</td>
										<td nowrap  class="tdrow">
											<input name="rest1" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest1?>" maxlength="5"> ~ <input name="rest1e" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest1e?>" maxlength="5"> 예) 12:00~13:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간1</td>
										<td nowrap  class="tdrow">
											<input name="rest1_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest1_b?>" maxlength="5"> ~ <input name="rest1e_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest1e_b?>" maxlength="5"> 예) 12:00~13:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간2</td>
										<td nowrap  class="tdrow">
											<input name="rest2" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest2?>" maxlength="5"> ~ <input name="rest2e" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest2e?>" maxlength="5"> 예) 12:00~13:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간2</td>
										<td nowrap  class="tdrow">
											<input name="rest2_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest2_b?>" maxlength="5"> ~ <input name="rest2e_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest2e_b?>" maxlength="5"> 예) 12:00~13:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간3</td>
										<td nowrap  class="tdrow">
											<input name="rest3" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest3?>" maxlength="5"> ~ <input name="rest3e" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest3e?>" maxlength="5"> 예) 12:00~13:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">휴게시간3</td>
										<td nowrap  class="tdrow">
											<input name="rest3_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest3_b?>" maxlength="5"> ~ <input name="rest3e_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$rest3e_b?>" maxlength="5"> 예) 12:00~13:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연장근무</td>
										<td nowrap  class="tdrow">
											<input name="ext" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$ext?>" maxlength="5"> ~ <input name="exte" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$exte?>" maxlength="5"> 예) 19:00 ~ 21:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">연장근무</td>
										<td nowrap  class="tdrow">
											<input name="ext_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$ext_b?>" maxlength="5"> ~ <input name="exte_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$exte_b?>" maxlength="5"> 예) 19:00 ~ 21:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">야간근무</td>
										<td nowrap  class="tdrow">
											<input name="night" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$night?>" maxlength="5"> ~ <input name="nighte" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$nighte?>" maxlength="5"> 예) 22:00 ~ 01:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">야간근무</td>
										<td nowrap  class="tdrow">
											<input name="night_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$night_b?>" maxlength="5"> ~ <input name="nighte_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$nighte_b?>" maxlength="5"> 예) 22:00 ~ 01:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">토요일근무</td>
										<td nowrap  class="tdrow">
											<input type="checkbox" name="saturday_work" style="vertical-align:middle" value="Y" <? if($row1['saturday_work'] == "Y") echo "checked"; ?> onclick="">근무함
											<input name="saturday_time" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$saturday_time?>" maxlength="5"> ~ <input name="saturday_timee" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$saturday_timee?>" maxlength="5"> 예) 09:00 ~ 13:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">토요일근무</td>
										<td nowrap  class="tdrow">
											<input type="checkbox" name="saturday_work_b" style="vertical-align:middle" value="Y" <? if($row1['saturday_work_b'] == "Y") echo "checked"; ?> onclick="">근무함
											<input name="saturday_time_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$saturday_time_b?>" maxlength="5"> ~ <input name="saturday_timee_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$saturday_timee_b?>" maxlength="5"> 예) 09:00 ~ 13:00
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">일요일근무</td>
										<td nowrap  class="tdrow">
											<input type="checkbox" name="sunday_work" style="vertical-align:middle" value="Y" <? if($row1['sunday_work'] == "Y") echo "checked"; ?> onclick="">근무함
											<input name="sunday_time" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$sunday_time?>" maxlength="5"> ~ <input name="sunday_timee" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$sunday_timee?>" maxlength="5"> 예) 09:00 ~ 13:00
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">일요일근무</td>
										<td nowrap  class="tdrow">
											<input type="checkbox" name="sunday_work_b" style="vertical-align:middle" value="Y" <? if($row1['sunday_work_b'] == "Y") echo "checked"; ?> onclick="">근무함
											<input name="sunday_time_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$sunday_time_b?>" maxlength="5"> ~ <input name="sunday_timee_b" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$sunday_timee_b?>" maxlength="5"> 예) 09:00 ~ 13:00
										</td>
									</tr>
								</table>
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
										<td valign="middle"><input type="checkbox" name="check_bonus_money_payment" style="vertical-align:middle" value="Y" <? if($row1['check_bonus_money_payment'] == "Y") echo "checked"; ?> onclick="">미지급 시 체크</td> 
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
										<td class="tdrowk" style="padding:5px" width="70">명칭</td>
										<td class="tdrow" width="160">
											<select name="bonus_standard" id="bonus_standard" onchange="bonus_change()" class="selectfm" style="width:74px;<? if($check_bonus_money_yn == "Y") echo "display:none"; else echo "display:inline"; ?>">
												<option value="1" <? if($row1[bonus_standard] == "1") echo "selected"; ?> >기본급</option>
												<option value="2" <? if($row1[bonus_standard] == "2") echo "selected"; ?> >결정임금</option>
												<option value="3" <? if($row1[bonus_standard] == "3") echo "selected"; ?> >통상임금</option>
												<option value="4" <? if($row1[bonus_standard] == "4") echo "selected"; ?> >총급여</option>
											</select>
											<input name="bonus_money" id="bonus_money" type="text" class="textfm" style="width:76px;ime-mode:disabled;<? if($check_bonus_money_yn != "Y") echo "display:none"; else echo "display:inline"; ?>" value="<?=number_format($bonus_money)?>" maxlength="11" onblur="" onkeyup="only_number();checkThousand(this.value, this,'Y');bonus_change();">
											<input type="checkbox" name="check_bonus_money_yn" id="check_bonus_money_yn" style="vertical-align:middle" value="Y" <? if($check_bonus_money_yn == "Y") echo "checked"; ?> onClick="checkBonus_MoneyYn();bonus_change()">수동
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
										<td class="tdrow"><input name="bonus_percent" type="text" onkeyup="bonus_change()" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$row1[bonus_percent]?>" maxlength="3">%
											<input type="checkbox" name="check_bonus_money12_yn" id="check_bonus_money12_yn" style="vertical-align:middle" value="Y" <? if($check_bonus_money12_yn == "Y") echo "checked"; ?> onClick="checkBonus_Money12Yn(this);bonus_change()">매월지급
										</td>
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
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
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
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주휴일</td>
										<td nowrap  class="tdrow" width="39%">
											<input name="hday" type="text" class="textfm" style="width:190px;ime-mode:active;" value="<?=$hday?>" maxlength="10"> 예) 일요일
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">토요일 유급</td>
										<td nowrap  class="tdrow" width="">
											<input type="checkbox" name="saturday_paid" value="1" <? if($saturday_paid == "1") echo "checked"; ?>> 토요일 유급휴일
										</td>
									</tr>
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">명절
										</td>
										<td nowrap  class="tdrow" colspan="3">
											<div style="">
												<input name="fday1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$fday1?>" maxlength="70">
												<input name="fday2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$fday2?>" maxlength="70">
												<input name="fday3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$fday3?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">유급휴일
											<div style="padding:4px 0 0 15px">
												<a href="javascript:field_add('hday');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del('hday');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow" colspan="3">
											<div style="">
												<input name="hday1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday1?>" maxlength="70">
												<input name="hday2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday2?>" maxlength="70">
												<input name="hday3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday3?>" maxlength="70">
											</div>
											<div id="hday4" style="<? if($hday4 == "") echo "display:none"; ?>">
												<input name="hday4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday4?>" maxlength="70">
												<input name="hday5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday5?>" maxlength="70">
												<input name="hday6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday6?>" maxlength="70">
											</div>
											<div id="hday7" style="<? if($hday7 == "") echo "display:none"; ?>">
												<input name="hday7" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday7?>" maxlength="70">
												<input name="hday8" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday8?>" maxlength="70">
												<input name="hday9" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday9?>" maxlength="70">
											</div>
											<div id="hday10" style="<? if($hday10 == "") echo "display:none"; ?>">
												<input name="hday10" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday10?>" maxlength="70">
												<input name="hday11" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday11?>" maxlength="70">
												<input name="hday12" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$hday12?>" maxlength="70">
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">무급휴일
											<div style="padding:4px 0 0 15px ">
												<a href="javascript:field_add6('holiday');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del6('holiday');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap  class="tdrow" colspan="3">
											<div style="">
												<input name="holiday1" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday1?>" maxlength="70">
												<input name="holiday2" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday2?>" maxlength="70">
												<input name="holiday3" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday3?>" maxlength="70">
											</div>
											<div id="holiday4" style="<? if($holiday4 == "") echo "display:none"; ?>">
												<input name="holiday4" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday4?>" maxlength="70">
												<input name="holiday5" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday5?>" maxlength="70">
												<input name="holiday6" type="text" class="textfm" style="width:264px;ime-mode:active;" value="<?=$holiday6?>" maxlength="70">
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
										<td nowrap style="vertical-align:top;padding:6px;background:#eff3e3">
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
											<input name="pay_system" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$pay_system?>" maxlength="30"> 예) 월급제
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금구성</td>
										<td nowrap  class="tdrow" width="">
											<input name="pay_structure" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$pay_structure?>" maxlength="10"> 예) 포괄입금제
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금계산기간</td>
										<td nowrap  class="tdrow" colspan="2">
											<!--<input type="checkbox" name="check_pay_calculate_a" style="vertical-align:middle" value="Y" <? if($row1['check_pay_calculate_a'] == "Y") echo "checked"; ?> title="적용">-->
											기본
											<input type="text" name="pay_calculate_a" class="textfm" value="<?=$pay_calculate_a?>" style="width:55px;ime-mode:active;">
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
											예) 사무직: 당월 1일부터 당월 말일까지로 하며, 익월 10일
										</td>
									</tr>
									<tr>
										<td nowrap  class="tdrow" colspan="2">
											<input type="checkbox" name="check_pay_calculate_b" style="vertical-align:middle" value="Y" <? if($row1['check_pay_calculate_b'] == "Y") echo "checked"; ?> title="추가">&nbsp;
											<input type="text" name="pay_calculate_b" class="textfm" value="<?=$pay_calculate_b?>" style="width:55px;ime-mode:active;">
											<input type="text" name="pay_calculate_day1_b" class="textfm" value="<?=$pay_calculate_day1_b?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period1_b" class="textfm" value="<?=$pay_calculate_day_period1_b?>" style="width:30px;ime-mode:active;">
											일부터
											<input type="text" name="pay_calculate_day2_b" class="textfm" value="<?=$pay_calculate_day2_b?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period2_b" class="textfm" value="<?=$pay_calculate_day_period2_b?>" style="width:30px;ime-mode:active;">
											일까지로 하며,
											<input type="text" name="pay_calculate_day3_b" class="textfm" value="<?=$pay_calculate_day3_b?>" style="width:40px;ime-mode:active;">
											<input type="text" name="pay_calculate_day_period3_b" class="textfm" value="<?=$pay_calculate_day_period3_b?>" style="width:30px;ime-mode:active;">
											일
										</td>
										<td nowrap  class="tdrow" width="">
											예) 생산직: 당월 1일부터 당월 말일까지로 하며, 익월 10일
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
								<div style="float:;">
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
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--내용-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">정년연령</td>
										<td nowrap  class="tdrow" width="">
											<input type="text" name="retirement_age_rule" class="textfm" value="<?=$retirement_age_rule?>" style="width:264px;ime-mode:active;">
										</td>
									</tr>
								</table>
								<div style="height:4px;font-size:0px;line-height:0px;"></div>
								<div style="margin:0 0 0 0">
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
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직금</td>
										<td nowrap  class="tdrow" width="39%">
											<input type="checkbox" name="retirement_gbn1" value="1" <?=$retirement_gbn1_chk?>> 퇴직시정산
											<input type="checkbox" name="retirement_gbn2" value="1" <?=$retirement_gbn2_chk?>> 퇴직연금
											<input type="checkbox" name="retirement_gbn3" value="1" <?=$retirement_gbn3_chk?>> 퇴직금중간정산
										</td>
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">퇴직연금</td>
										<td nowrap  class="tdrow">
											가입상품
											<input type="text" name="retirement_annuity" class="textfm" value="<?=$retirement_annuity?>" style="width:264px;ime-mode:active;">
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
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														취업규칙 시행일
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
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">시행일</td>
										<td nowrap  class="tdrow" width="">
											<input name="conduct_day" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$conduct_day?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '5','Y')">
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.conduct_day);" target="">달력</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										예) 2014.01.01
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
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														부속규정
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
										<td nowrap class="tdrowk" width="11%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">첨부파일1</td>
										<td nowrap  class="tdrow" width="">
											<input name="employment_report_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" />
											<a href="files/employment/<?=$row1['employment_report_file_1']?>" target="_blank"><?=$row1['employment_report_file_1']?></a>
											<input type="hidden" name="e_file_1" value="<?=$row1['employment_report_file_1']?>" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">첨부파일2</td>
										<td nowrap  class="tdrow" width="">
											<input name="employment_report_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" />
											<a href="files/employment/<?=$row1['employment_report_file_2']?>" target="_blank"><?=$row1['employment_report_file_2']?></a>
											<input type="hidden" name="e_file_2" value="<?=$row1['employment_report_file_2']?>" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">첨부파일3</td>
										<td nowrap  class="tdrow" width="">
											<input name="employment_report_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" />
											<a href="files/employment/<?=$row1['employment_report_file_3']?>" target="_blank"><?=$row1['employment_report_file_3']?></a>
											<input type="hidden" name="e_file_3" value="<?=$row1['employment_report_file_3']?>" />
										</td>
									</tr>
								</table>
								<!--취업규칙 종료-->
							</div>

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
?>
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
										<a href="<?=$url_rule1?>" target=""><img src="images/btn_print_big.png" border="0"></a>
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
<?
}
?>
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