<?
$sub_menu = "1901000";
include_once("./_common.php");

$now_date = date("Y.m.d");
$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//검색 파라미터 전송
$qstr  = "stx_process=".$stx_process;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_contract=".$stx_contract."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_electric_charges_no=".$stx_electric_charges_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind."&stx_payments=".$stx_payments."&stx_cost=".$stx_cost."&stx_electric_charges_watt1=".$stx_electric_charges_watt1."&stx_electric_charges_watt2=".$stx_electric_charges_watt2."&stx_reduce_ask=".$stx_reduce_ask."&stx_search_ask=".$stx_search_ask."&stx_construct_chk=".$stx_construct_chk."&stx_electric_charges_power_kind=".$stx_electric_charges_power_kind."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_installment=".$stx_installment;

//echo $member[mb_profile];
if($is_admin != "super") {
	//echo $member['mb_profile'];
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code=c.com_code and a.com_code='$id' ";

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
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_10.png";
$sub_title = "4대보험절감";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

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
	if(!$row['com_code']) alert("해당 거래처는 삭제 되었거나 존재하지 않습니다.","main.php");
	//master 로그인시 com_code 오류
	if(!$com_code) $com_code = $id;
	//사업장DB 옵션2
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//4대보험절감 DB
	$sql_si4n = " select * from si4n_nhis where com_code='$com_code' ";
	$result_si4n = sql_query($sql_si4n);
	$row_si4n=mysql_fetch_array($result_si4n);
}
//메모
$memo = $row['memo'];
//사무위탁수임
$samu_req_yn = $row['samu_req_yn'];
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
function checkData() {
	var frm = document.dataForm;
	frm.action = "si4n_nhis_update.php";
	frm.submit();
	return;
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
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
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
//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
//첨부서류 추가 버튼
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
//스케줄 등록 160121
function new_schedule(url, com_code) {
	var ret = window.open(url+"?com_code="+com_code, "pop_new_schedule", "top=100, left=100, width=800,height=440, scrollbars=no, resizable=no");
	return;
}
//절감계산기 161013
function si4n_nhis_calculate2(id, cnt) {
	var cnt_val = cnt.value;
	var ret = window.open("pop_si4n_nhis_calculate2.php?id="+id+"&cnt="+cnt_val, "pop_si4n_nhis_calculate2", "width=1636,height=470,scrollbars=yes");
	return;
}
//4대보험절감계산기(시급) 161011
function si4n_nhis_calculate3(id, cnt) {
	var cnt_val = cnt.value;
	var ret = window.open("pop_si4n_nhis_calculate3.php?id="+id+"&cnt="+cnt_val, "pop_si4n_nhis_calculate3", "width=1724,height=470,scrollbars=yes");
	return;
}
//처리결과 팝업 160317
function pop_si4n_process_memo() {
	var ret = window.open("./popup/pop_si4n_process_memo.php", "pop_si4n_process_memo", "width=540,height=706,scrollbars=no");
	return;
}
//수수료 계산
function si4n_fee_cal() {
	var frm = document.dataForm;
	si4n_pay_year = toInt(frm['si4n_pay_year'].value);
	if(si4n_pay_year == "") {
		alert("절감금액(년)을 입력하세요.");
		frm['si4n_pay_year'].focus();
		return;
	}
	si4n_fee = si4n_pay_year * 0.5;
	frm['si4n_fee'].value = number_format(si4n_fee);
	select_selected(1);
}
function si4n_fee_cal2() {
	var frm = document.dataForm;
	si4n_pay_year = toInt(frm['si4n_pay_year2'].value);
	if(si4n_pay_year == "") {
		alert("절감금액(년)을 입력하세요.");
		frm['si4n_pay_year2'].focus();
		return;
	}
	si4n_fee = si4n_pay_year * 0.5;
	frm['si4n_fee'].value = number_format(si4n_fee);
	select_selected(2);
}
//컨설팅 1안 2안 선택
function select_selected(no){ 
	var frm = document.dataForm;
	var selectObj = frm.si4n_fee_choice; 
	for(var i=0; i<selectObj.options.length;i++ ){ 
		if( selectObj.options[i].value == no){ 
			selectObj.options[i].selected = "selected"; 
			break; 
		} 
	} 
}
//이력
function si4n_history(id) {
	var ret = window.open("./si4n_history_popup.php?id="+id, "window_si4n_history", "scrollbars=yes,width=950,height=240");
	return;
}
//]]>
</script>
<?
//딜러 권한
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";

//회원 레벨 변경 : 김근호 -> 이경훈 사원 9레벨
if($member['mb_profile'] == 1 && $member['mb_level'] == 4) $member['mb_level'] = 9;

//권한별 링크값 : 전체 권한
$url_save = "javascript:checkData();";
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$php_self_list = "si4n_nhis_list.php";
$url_list = "./".$php_self_list."?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
<?
//$samu_list = "ok";
if($v != "write") {
	$report = "ok";
}
if($w != "u") {
	$report = "";
	$v = "write";
}
include "inc/client_basic_info.php";
?>
								<div style="height:10px;font-size:0px"></div>
							</div>
<?
$mb_profile_code = $member['mb_profile'];
//echo $row['damdang_code']." == ".$mb_profile_code." ".$member['mb_level'];
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $is_damdang = "ok";
//본사 권한 설정, 첨부서류(컨설팅 전) 161201
if($member['mb_profile'] == 1) $is_damdang = "ok";
//권한별 링크값
//echo $member['mb_level'];
//지사 딜러 이상 권한 160411
if($member['mb_level'] >= 4) {
	$url_modify = $_SERVER['PHP_SELF']."?w=u&v=write&id=".$com_code."&page=".$page."&".$qstr."&".$stx_qstr;
	$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
	$url_print_request = "javascript:pagePrint(document.getElementById('tab1'), '0')";
} else {
	$url_save = "javascript:alert_no_right();";
}
//수정일 경우 표시
if($w) {
	//현재 탭 메뉴 번호
	$tab_onoff_this = 16;
	//프로그램 종류
	if($row['easynomu_yn'] == 1) {
		$tab_program_url = 1;
	} else if($row['easynomu_yn'] == 2) {
		$tab_program_url = 2;
	} else {
		$tab_program_url = 1;
		if($row['construction_yn'] == 1) $tab_program_url = 3;
	}
	//딜러 제외 모두 표시
	if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
		include "inc/tab_menu.php";
		//본사처리현황 숨김(전기요금컨설팅) 160322
		$client_basic_admin_hide = 1;
		//본사처리현황
		include "inc/client_basic_admin.php";
	}
}
$txt_20001 = "기본정보";
$txt_20002 = "처리현황";
$txt_20003 = "컨설팅 1안";
$txt_20004 = "컨설팅 2안";
$txt_20005 = "컨설팅 메모";
//인원
if($row_si4n['si4n_staff_cnt']) $si4n_staff_cnt = $row_si4n['si4n_staff_cnt'];
else $si4n_staff_cnt = 10;
if($row_si4n['si4n_cnt']) $si4n_cnt = $row_si4n['si4n_cnt'];
else $si4n_cnt = 10;
?>
							<div id="tab1">
								<a name="20001"><!--<?=$txt_20001?>--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<?=$txt_20001?>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
<?
if($member['mb_level'] > 6) {
	//산재요율 161021
	$industrial_disaster_rate = $row['industrial_disaster_rate'];
?>
									<tr>
										<td class="tdrowk" width="120"><?if($member['mb_level'] > 6) {?><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감계산기1<?}?></td>
										<td class="tdrow" width="240">
											<input name="si4n_staff_cnt" type="text" class="textfm" style="width:30px;ime-mode:disabled;float:left;" value="<?=$si4n_staff_cnt?>" maxlength="3" onKeyPress="only_number();"><div style="float:left;">명</div>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn3_lt.gif" alt="[" /></td><td style="background:url('./images/btn3_bg.gif')"><a href="#pop_electric_calculate2" onclick="si4n_nhis_calculate2('<?=$id?>',document.dataForm.si4n_staff_cnt);return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">4대보험절감계산기(1안)</a></td><td><img src="./images/btn3_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감금액(월)</td>
										<td class="tdrow" width="180">
											<input name="si4n_pay_month" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_pay_month']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감금액(년)</td>
										<td class="tdrow">
											<input name="si4n_pay_year" type="text" class="textfm" style="float:left;width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_pay_year']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn4_lt.gif"></td><td background="./images/btn4_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:si4n_fee_cal('');" target=""><span style="font-size:11px">수수료</span></a></td><td><img src="./images/btn4_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><?if($member['mb_level'] > 6) {?><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감계산기2<?}?></td>
										<td class="tdrow">
											<input name="si4n_cnt" type="text" class="textfm" style="width:30px;ime-mode:disabled;float:left;" value="<?=$si4n_cnt?>" maxlength="3" onKeyPress="only_number();"><div style="float:left;">명</div>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn4_lt.gif" alt="[" /></td><td style="background:url('./images/btn4_bg.gif')"><a href="#pop_electric_calculate3" onclick="si4n_nhis_calculate3('<?=$id?>',document.dataForm.si4n_cnt);return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">4대보험절감계산기(2안)</a></td><td><img src="./images/btn4_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감금액2(월)</td>
										<td class="tdrow">
											<input name="si4n_pay_month2" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_pay_month2']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감금액2(년)</td>
										<td class="tdrow">
											<input name="si4n_pay_year2" type="text" class="textfm" style="float:left;width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_pay_year2']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn4_lt.gif"></td><td background="./images/btn4_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:si4n_fee_cal2('');" target=""><span style="font-size:11px">수수료</span></a></td><td><img src="./images/btn4_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">산재요율
										</td>
										<td nowrap class="tdrow" colspan="5">
<?
//산재요율 기본 0.025 설정 김국진 과장 의견 161025
if(!$industrial_disaster_rate) $industrial_disaster_rate = "0.025";
?>
											<input name="industrial_disaster_rate" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$industrial_disaster_rate?>" maxlength="7" onKeyPress="only_number();"> 예) 금속재료품 제조업 0.033 / 전자제품 제조업 0.007 / 화학제품(플라스틱) 제조업 0.017 / 식료품/기계기구 제조업 0.019
										</td>
									</tr>
<?
}
?>
									<tr>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모
										</td>
										<td nowrap class="tdrow" colspan="5">
											<textarea name="si4n_memo" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<!--첨부서류-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:120px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														첨부서류(컨설팅 전)
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="si4n_file_div">
									<tr>
										<td class="tdrowk" width="120"><div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />급여대장(샘플)<br /> <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_attach_hidden_del_1" value="1" style="vertical-align:middle" />삭제<? } ?></div>
<?
if($row_si4n['si4n_attach_1']) $si4n_attach_1 = mb_substr($row_si4n['si4n_attach_1'],16,99,'euc-kr');
if($row_si4n['si4n_attach_2']) $si4n_attach_2 = mb_substr($row_si4n['si4n_attach_2'],16,99,'euc-kr');
if($row_si4n['si4n_attach_3']) $si4n_attach_3 = mb_substr($row_si4n['si4n_attach_3'],16,99,'euc-kr');
?>
										</td>
										<td class="tdrow" width="373">
											<? if($is_damdang == "ok") { ?><input name="si4n_attach_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_attach_1']?>" target="_blank"><?=$si4n_attach_1?></a>
											<input type="hidden" name="si4n_attach_hidden_1" value="<?=$row_si4n['si4n_attach_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />상여금대장(샘플)<br /> <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_attach_hidden_del_2" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_attach_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_attach_2']?>" target="_blank"><?=$si4n_attach_2?></a>
											<input type="hidden" name="si4n_attach_hidden_2" value="<?=$row_si4n['si4n_attach_2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />체크리스트<br /> <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_attach_hidden_del_3" value="1" style="vertical-align:middle" />삭제<? } ?></div>
										</td>
										<td class="tdrow">
											<? if($is_damdang == "ok") { ?><input name="si4n_attach_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_attach_3']?>" target="_blank"><?=$si4n_attach_3?></a>
											<input type="hidden" name="si4n_attach_hidden_3" value="<?=$row_si4n['si4n_attach_3']?>" />
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow" >
										</td>
									</tr>
								</table>
<?
//컨설팅 메모 기본값 161026
//if(!$row_si4n['si4n_memo1']) $row_si4n['si4n_memo1'] = "※ 기존 지급되는 과세수당을 비과세로 전환 시, 환산된 금액\n※ 실제 컨설팅 진행 시, 업체와의 논의과정에서 금액은 변동 될 수 있음.";
//컨설팅 1, 2안 본사만 오픈 161019
//지사 오픈 김국진 과장 의견 161115
//if($member['mb_level'] > 6) {
	//if($row_si4n['si4n_fee_choice'] == 1) {
	//컨설팅 1안/2안 선택 시 표시 161115
	$si4n_part1_div_hide = "style='display:none;'";
	$si4n_part2_div_hide = "style='display:none;'";
	if($row_si4n['si4n_fee_choice'] == 1) $si4n_part1_div_hide = "";
	if($row_si4n['si4n_fee_choice'] == 2) $si4n_part2_div_hide = "";
?>
								<div style="height:10px;font-size:0px"></div>
								<a name="20003"><!--<?=$txt_20003?>--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_part1_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<?=$txt_20003?>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="si4n_part1_div" <?=$si4n_part1_div_hide?>>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;">
										<tr>
											<td class="tdrowk" style="text-align:center;" colspan="2">변경 전</td>
											<td class="tdrowk" style="text-align:center;" colspan="2">변경 후</td>
											<td class="tdrowk" style="text-align:center;" rowspan="2">월 절감액</td>
											<td class="tdrowk" style="text-align:center;" rowspan="2">연간 절감액</td>
										</tr>
										<tr>
											<td class="tdrowk_h50" style="text-align:center;">월 보수총액</td>
											<td class="tdrowk_h50" style="text-align:center;">4대보험료 월납부액<br />(사업주부담 포함)</td>
											<td class="tdrowk_h50" style="text-align:center;">월 보수총액</td>
											<td class="tdrowk_h50" style="text-align:center;">4대보험료 월납부액<br />(사업주부담 포함)</td>
										</tr>
<?
	$sql_pay = " select sum(money_for_tax) as money_for_tax_sum, sum(money2_for_tax) as money2_for_tax_sum,
						sum(money_gongje) as money_gongje, sum(money2_gongje) as money2_gongje,
						sum(money_result) as money_result
						from si4n_nhis_pay where com_code = '$id' ";
	$row_pay = sql_fetch($sql_pay);
	$money_result_year = $row_pay['money_result'] * 12;
?>
										<tr>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_for_tax_sum'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_gongje'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money2_for_tax_sum'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money2_gongje'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_result'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($money_result_year)?></td>
										</tr>
									</table>
									<div style="height:2px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td class="tdrowk" width="120">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감결과표</div>
											</td>
											<td  class="tdrow" >
<?
$si4n_nhis_excel2_result = "절감결과1_".$row['com_name'].".xls";
echo "<a href='pop_si4n_nhis_excel2_result.php?id=".$id."'>".$si4n_nhis_excel2_result."</a>";
?>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width="120">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />현황</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo1_condition" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo1_condition']?></textarea>
											</td>
										</tr>
										<tr>
											<td class="tdrowk">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />문제점</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo1_problem" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo1_problem']?></textarea>
											</td>
										</tr>
										<tr>
											<td class="tdrowk">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />컨설팅 방향</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo1" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo1']?></textarea>
											</td>
										</tr>
									</table>
									<!--<textarea name="si4n_memo2" style="display:none;"><?=$row_si4n['si4n_memo2']?></textarea>-->
								</div>
<?
	//} else if($row_si4n['si4n_fee_choice'] == 2) {
?>
								<div style="height:10px;font-size:0px"></div>
								<a name="20004"><!--<?=$txt_20004?>--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_part2_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<?=$txt_20004?>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="si4n_part2_div" <?=$si4n_part2_div_hide?>>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="table-layout:fixed;">
										<tr>
											<td class="tdrowk" style="text-align:center;" colspan="2">변경 전</td>
											<td class="tdrowk" style="text-align:center;" colspan="2">변경 후</td>
											<td class="tdrowk" style="text-align:center;" rowspan="2">월 절감액</td>
											<td class="tdrowk" style="text-align:center;" rowspan="2">연간 절감액</td>
										</tr>
										<tr>
											<td class="tdrowk_h50" style="text-align:center;">월 보수총액</td>
											<td class="tdrowk_h50" style="text-align:center;">4대보험료 월납부액<br />(사업주부담 포함)</td>
											<td class="tdrowk_h50" style="text-align:center;">월 보수총액</td>
											<td class="tdrowk_h50" style="text-align:center;">4대보험료 월납부액<br />(사업주부담 포함)</td>
										</tr>
<?
	$sql_pay = " select sum(money_for_tax) as money_for_tax_sum, sum(money2_for_tax) as money2_for_tax_sum,
						sum(money_gongje) as money_gongje, sum(money2_gongje) as money2_gongje,
						sum(money_result) as money_result
						from si4n_nhis_pay_time where com_code = '$id' ";
	$row_pay = sql_fetch($sql_pay);
	$money_result_year = $row_pay['money_result'] * 12;
?>
										<tr>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_for_tax_sum'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_gongje'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money2_for_tax_sum'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money2_gongje'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($row_pay['money_result'])?></td>
											<td class="tdrow" style="text-align:center;"><?=number_format($money_result_year)?></td>
										</tr>
									</table>
									<div style="height:2px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td class="tdrowk" width="120">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />절감결과표</div>
											</td>
											<td  class="tdrow" >
<?
$si4n_nhis_excel3_result = "절감결과2_".$row['com_name'].".xls";
echo "<a href='pop_si4n_nhis_excel3_result.php?id=".$id."'>".$si4n_nhis_excel3_result."</a>";

/*
//현황, 문제점 통합 김국진 과장 의견 161115
if(!$row_si4n['si4n_memo2_condition']) $row_si4n['si4n_memo2_condition'] = $row_si4n['si4n_memo1_condition'];
if(!$row_si4n['si4n_memo2_problem']) $row_si4n['si4n_memo2_problem'] = $row_si4n['si4n_memo1_problem'];
*/
?>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width="120">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />현황</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo2_condition" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo2_condition']?></textarea>
											</td>
										</tr>
										<tr>
											<td class="tdrowk">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />문제점</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo2_problem" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo2_problem']?></textarea>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width="120">
												<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />컨설팅 방향</div>
											</td>
											<td  class="tdrow" >
												<textarea name="si4n_memo2" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo2']?></textarea>
											</td>
										</tr>
									</table>
									<!--<textarea name="si4n_memo1" style="display:none;"><?=$row_si4n['si4n_memo1']?></textarea>-->
								</div>
<?
	//} else {
?>
								<div style="height:10px;font-size:0px"></div>
								<a name="20003"><!--<?=$txt_20005?>--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<?=$txt_20005?>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120">
											<div style="margin:6px 0 6px 0;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />컨설팅 메모</div>
										</td>
										<td  class="tdrow" >
											<textarea name="si4n_memo3" class="textfm" style="width:100%;height:76px;word-break:break-all;" required><?=$row_si4n['si4n_memo3']?></textarea>
										</td>
									</tr>
								</table>
								<!--<textarea name="si4n_memo2" style="display:none;"><?=$row_si4n['si4n_memo2']?></textarea>-->
<?
	//}
//}
?>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif"></td> 
													<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														급여대장 등록
													</td> 
													<td><img src="images/sb_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

<?
//담당 지사, 열람 지사, 본사 권한
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] > 6) $is_damdang = "ok";
else $is_damdang = "";
//엑셀 파일 존재 여부
if($row_si4n['pay_ledger']) $excel = $row_si4n['pay_ledger'];
//급여대장 리스트 숨기기 161017
$si4n_pay_div_display = "display:none;";
?>
								<!-- 입력폼 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">급여대장 <? if($is_damdang) { ?><input type="checkbox" name="pay_ledger_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
										<td   class="tdrow">
											<? if($is_damdang) { ?><input name="pay_ledger" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['pay_ledger']?>" target="_blank"><?=$row_si4n['pay_ledger']?></a>
											<input type="hidden" name="pay_file_1" value="<?=$row_si4n['pay_ledger']?>">
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellspacing="0" cellpadding="0" onclick="var div_display='si4n_pay_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														급여정보 리스트
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="si4n_pay_div" style="<?=$si4n_pay_div_display?>">
									<!-- 입력폼 -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
										<tr>
											<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
											<td class="tdhead_center" width="34">No</td>
											<td class="tdhead_center" width="70">성명</td>
											<td class="tdhead_center" width="70">직위</td>
											<td class="tdhead_center" width="70">입사일</td>
											<td class="tdhead_center" width="80">기본급</td>
											<td class="tdhead_center" width="80">과세수당</td>
											<td class="tdhead_center" width="80">비과세</td>
											<td class="tdhead_center" width="60">국민연금</td>
											<td class="tdhead_center" width="60">건강보험</td>
											<td class="tdhead_center" width="60">장기요양</td>
											<td class="tdhead_center" width="60">고용보험</td>
											<td class="tdhead_center" width="60">소득세</td>
											<td class="tdhead_center" width="60">주민세</td>
											<td class="tdhead_center" width="60">기타공제</td>
											<td class="tdhead_center" width="80">실지급액</td>
										</tr>
<?
//변수 초기화
$row_month['sum_money_month'] = 0;
$sum_court = 0;
$sum_b = 0;
$sum_g = 0;
$sum_e = 0;
$row_month['sum_total'] = 0;
$row_month['sum_money_for_tax'] = 0;
$row_month['sum_si4n'] = 0;
$row_month['sum_tax'] = 0;
$row_month['sum_minus'] = 0;
$row_month['sum_result'] = 0;
//엑셀 파일 존재 여부
if($row_si4n['pay_ledger']) $excel = $row_si4n['pay_ledger'];
//엑셀 리더
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
if($excel) {
	$UpFileExt = "xlsx";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/erp/files/si4n_nhis";
	$upfile_path = $upload_path."/".$excel;
	//echo $upfile_path;
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		//echo $inputFileType;
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		$m = 0;
		$count_page = 0;

		//서식 비교 (3.17 서식 변경됨)
		$excel_new_form = $objWorksheet->getCell('A' . 2)->getValue();
		$new_form = iconv("UTF-8", "EUC-KR", $excel_new_form);
		$new_form_chk = substr($new_form,0,2);
		//echo $excel_new_form;

		//연번
		$start_line = 6;
		//echo $excel_count;
		//echo $excel_type;
		$p = 0;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$excel_code[$i] = $objWorksheet->getCell('A' . $k)->getValue(); 
			$excel_name[$i] = $objWorksheet->getCell('E' . $k)->getValue();
			$excel_ssnb[$i] = $objWorksheet->getCell('F' . $k)->getValue();
			$excel_join_date[$i] = $objWorksheet->getCell('C' . $k)->getValue();
			$excel_memo[$i] = $objWorksheet->getCell('I' . $k)->getValue();
			$excel_age_in[$i] = trim($objWorksheet->getCell('J' . $k)->getValue()); 
			$excel_dept[$i] = $objWorksheet->getCell('G' . $k)->getValue();
			$excel_position[$i] = $objWorksheet->getCell('H' . $k)->getValue();
			//수당
			$money_month[$i] = $objWorksheet->getCell('R' . $k)->getValue();
			$ext[$i] = $objWorksheet->getCell('S' . $k)->getValue();
			$night[$i] = $objWorksheet->getCell('T' . $k)->getValue();
			$hday[$i] = $objWorksheet->getCell('U' . $k)->getValue();
			$b1[$i] = $objWorksheet->getCell('V' . $k)->getValue();
			$b2[$i] = $objWorksheet->getCell('W' . $k)->getValue();
			$b3[$i] = $objWorksheet->getCell('X' . $k)->getValue();
			$b4[$i] = $objWorksheet->getCell('Y' . $k)->getValue();
			$b5[$i] = $objWorksheet->getCell('Z' . $k)->getValue();
			$b6[$i] = $objWorksheet->getCell('AA' . $k)->getValue();
			$b7[$i] = $objWorksheet->getCell('AB' . $k)->getValue();
			$b8[$i] = $objWorksheet->getCell('AC' . $k)->getValue();
			$g1[$i] = $objWorksheet->getCell('AD' . $k)->getValue();
			$g2[$i] = $objWorksheet->getCell('AE' . $k)->getValue();
			$g3[$i] = $objWorksheet->getCell('AF' . $k)->getValue();
			$e1[$i] = $objWorksheet->getCell('AG' . $k)->getValue();
			$e2[$i] = $objWorksheet->getCell('AH' . $k)->getValue();
			$e3[$i] = $objWorksheet->getCell('AI' . $k)->getValue();
			$e4[$i] = $objWorksheet->getCell('AJ' . $k)->getValue();
			$money_yun[$i] = $objWorksheet->getCell('AP' . $k)->getValue();
			$money_health[$i] = $objWorksheet->getCell('AR' . $k)->getValue();
			$money_yoyang[$i] = $objWorksheet->getCell('AT' . $k)->getValue();
			$money_goyong[$i] = $objWorksheet->getCell('AV' . $k)->getValue();
			$tax_so[$i] = $objWorksheet->getCell('AN' . $k)->getValue();
			$tax_jumin[$i] = $objWorksheet->getCell('AO' . $k)->getValue();
			$minus[$i] = $objWorksheet->getCell('AX' . $k)->getValue();
			$minus2[$i] = $objWorksheet->getCell('AY' . $k)->getValue();
			//$money_result[$i] = $objWorksheet->getCell('AZ' . $k)->getValue();
			//과세 합계
			$sum_allowance[$i] = $ext[$i]+$night[$i]+$hday[$i]+$b1[$i]+$b2[$i]+$b3[$i]+$b4[$i]+$b5[$i]+$b6[$i]+$b7[$i]+$b8[$i]+$g1[$i]+$g2[$i]+$g3[$i];
			//비과세 합계
			$sum_exempt[$i] = $e1[$i]+$e2[$i]+$e3[$i]+$e4[$i];
			//기타공제 합계
			$sum_minus[$i] = $minus[$i]+$minus2[$i];
			//실지급액
			$money_result[$i] = ($money_month[$i]+$sum_allowance[$i]+$sum_exempt[$i]) - ($money_yun[$i]+$money_health[$i]+$money_yoyang[$i]+$money_goyong[$i]+$tax_so[$i]+$tax_jumin[$i]+$sum_minus[$i]);
			//총합계
			$row_month['sum_money_month'] += $money_month[$i];
			$sum_court += $ext[$i]+$night[$i]+$hday[$i];
			$sum_b += $b1[$i]+$b2[$i]+$b3[$i]+$b4[$i]+$b5[$i]+$b6[$i]+$b7[$i]+$b8[$i];
			$sum_g += $g1[$i]+$g2[$i]+$g3[$i];
			$sum_e += $e1[$i]+$e2[$i]+$e3[$i]+$e4[$i];
			$row_month['sum_total'] += $money_month[$i]+$sum_allowance[$i]+$sum_exempt[$i];
			$row_month['sum_money_for_tax'] += $money_month[$i]+$sum_allowance[$i];
			$row_month['sum_si4n'] += $money_yun[$i]+$money_health[$i]+$money_yoyang[$i]+$money_goyong[$i];
			$row_month['sum_tax'] += $tax_so[$i]+$tax_jumin[$i];
			$row_month['sum_minus'] += $sum_minus[$i];
			$row_month['sum_result'] += $money_result[$i];
			//통화 서식
			$money_month[$i] = number_format($money_month[$i]);
			$sum_allowance[$i] = number_format($sum_allowance[$i]);
			$sum_exempt[$i] = number_format($sum_exempt[$i]);
			$money_yun[$i] = number_format($money_yun[$i]);
			$money_health[$i] = number_format($money_health[$i]);
			$money_yoyang[$i] = number_format($money_yoyang[$i]);
			$money_goyong[$i] = number_format($money_goyong[$i]);
			$tax_so[$i] = number_format($tax_so[$i]);
			$tax_jumin[$i] = number_format($tax_jumin[$i]);
			$sum_minus[$i] = number_format($sum_minus[$i]);
			$money_result[$i] = number_format($money_result[$i]);
			//수당 명칭
			$excel_g1 = $objWorksheet->getCell('S' . 5)->getValue();
			$text_g1 = iconv("UTF-8", "EUC-KR", $excel_g1);
			//한글 인코딩
			$name_in[$i] = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			$excel_dept[$i] = iconv("UTF-8", "EUC-KR", $excel_dept[$i]);
			$excel_position[$i] = iconv("UTF-8", "EUC-KR", $excel_position[$i]);
			$excel_memo[$i] = iconv("UTF-8", "EUC-KR", $excel_memo[$i]);
			//데이터가 있을 경우
			if($excel_code[$i]) {
				$p++;
?>
										<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
											<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
											<td class="ltrow1_center_h22"><?=$excel_code[$i]?></td>
											<td class="ltrow1_center_h22"><?=$name_in[$i]?></td>
											<td class="ltrow1_center_h22"><?=$excel_position[$i]?></td>
											<td class="ltrow1_center_h22"><?=$excel_join_date[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_month[$i]?></td>
											<td class="ltrow1_center_h22"><?=$sum_allowance[$i]?></td>
											<td class="ltrow1_center_h22"><?=$sum_exempt[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_yun[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_health[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_yoyang[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_goyong[$i]?></td>
											<td class="ltrow1_center_h22"><?=$tax_so[$i]?></td>
											<td class="ltrow1_center_h22"><?=$tax_jumin[$i]?></td>
											<td class="ltrow1_center_h22"><?=$sum_minus[$i]?></td>
											<td class="ltrow1_center_h22"><?=$money_result[$i]?></td>
										</tr>
<?
			}
		}
		//취득자 카운트
		$in_cnt = $p;
	}
}
//echo $m;
//대상자 없을 경우 메세지 표시
if($in_cnt == 0) {
	$colspan = 16;
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
}
?>
									</table>
									<div style="height:10px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
										<tr>
											<td class="tdhead_center" width="90">기본급</td>
											<td class="tdhead_center" width="90">법정수당</td>
											<td class="tdhead_center" width="90">통상임금수당</td>
											<td class="tdhead_center" width="90">기타수당</td>
											<td class="tdhead_center" width="90">비과세수당</td>
											<td class="tdhead_center" width="90">임금계</td>
											<td class="tdhead_center" width="90">과세소득</td>
											<td class="tdhead_center" width="90">4대보험</td>
											<td class="tdhead_center" width="90">세금</td>
											<td class="tdhead_center" width="90">기타공제</td>
											<td class="tdhead_center" width="">총지급액</td>
										</tr>
										<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_money_month'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($sum_court)?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($sum_b)?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($sum_g)?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($sum_e)?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_total'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_money_for_tax'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_si4n'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_tax'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_minus'])?></td>
											<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_result'])?></td>
										</tr>
									</table>
								</div>

								<div style="height:10px;font-size:0px"></div>
								<a name="20002"><!--<?=$txt_20002?>--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<?=$txt_20002?>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">절감금액(월)</td>
										<td nowrap class="tdrow" width="180">
<?
if($row_si4n['si4n_fee_choice'] == 1) {
	$si4n_pay_month = $row_si4n['si4n_pay_month'];
	$si4n_pay_year = $row_si4n['si4n_pay_year'];
} else if($row_si4n['si4n_fee_choice'] == 2) {
	$si4n_pay_month = $row_si4n['si4n_pay_month2'];
	$si4n_pay_year = $row_si4n['si4n_pay_year2'];
} else {
	$si4n_pay_month = "";
	$si4n_pay_year = "";
}
echo $si4n_pay_month;
?>
										</td>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">절감금액(년)
										</td>
										<td nowrap class="tdrow" width="180">
											<?=$si4n_pay_year?>
										</td>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">수수료<font color="red"></font>
										</td>
										<td nowrap class="tdrow">
											<input name="si4n_fee" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" value="<?=$row_si4n['si4n_fee']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
											<select name="si4n_fee_choice" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="1" <? if($row_si4n['si4n_fee_choice'] == 1) echo "selected"; ?>>1안</option>
												<option value="2" <? if($row_si4n['si4n_fee_choice'] == 2) echo "selected"; ?>>2안</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />처리현황</td>
										<td class="tdrow">
<?
$sel_check_ok = array();
$check_ok_id = $row2['si4n_nhis_process'];
$sel_check_ok[$check_ok_id] = "selected";
if($member['mb_level'] > 6) {
?>
											<select name="si4n_nhis_process" class="selectfm" style="float:left;">
												<option value="">선택</option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$si4n_nhis_process_arry[10]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$si4n_nhis_process_arry[9]?></option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$si4n_nhis_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$si4n_nhis_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$si4n_nhis_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$si4n_nhis_process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$si4n_nhis_process_arry[5]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$si4n_nhis_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$si4n_nhis_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$si4n_nhis_process_arry[8]?></option>
											</select>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;margin-left:10px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:si4n_history('<?=$id?>');" target="">이력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
} else {
	echo $si4n_nhis_process_arry[$check_ok_id];
}
?>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">셋팅비</td>
										<td nowrap class="tdrow" width="180">
<?
//셋팅비 기본 500,000원 설정 김국진 과장 의견 161025
if(!$row_si4n['si4n_setting']) $row_si4n['si4n_setting'] = "500,000";
?>
											<input name="si4n_setting" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_setting']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
										</td>
										<td nowrap class="tdrowk" width="120">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">셋팅비입금일
										</td>
										<td nowrap class="tdrow">
											<input name="si4n_setting_date" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;float:left;" value="<?=$row_si4n['si4n_setting_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.si4n_setting_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif" /></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />최종수정</td>
										<td class="tdrow">
											<?=$row_si4n['si4n_user']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />분납</td>
										<td class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<select name="si4n_installment" class="selectfm">
												<option value="">선택</option>
<?
	for($k=1;$k<=24;$k++) {
		if($k == $row2['si4n_installment']) $installment_selected = "selected";
		else $installment_selected = "";
		echo "<option value='".$k."' ".$installment_selected.">".$k."</option>";
	}
	$k = 36;
	if($k == $row2['si4n_installment']) $installment_selected = "selected";
	else $installment_selected = "";
	echo "<option value='".$k."' ".$installment_selected.">".$k."</option>";
	$k = 48;
	if($k == $row2['si4n_installment']) $installment_selected = "selected";
	else $installment_selected = "";
	echo "<option value='".$k."' ".$installment_selected.">".$k."</option>";
?>
											</select>
<?
} else {
	echo $row2['si4n_installment'];
}
?>
										</td>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보수변경신청일
										</td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="si4n_change_date" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;float:left;" value="<?=$row_si4n['si4n_change_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.si4n_change_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif" /></td> <td width="2"></td></tr></table>
<?
} else {
	echo $row_si4n['si4n_change_date'];
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />최종수정일</td>
										<td class="tdrow">
											<?=$row2['si4n_nhis_editdt']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />잔금</td>
										<td class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="si4n_remainder" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row_si4n['si4n_remainder']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	echo $row_si4n['si4n_remainder'];
}
?>
										</td>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">잔금입금일
										</td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="si4n_remainder_date" type="text" class="textfm5" readonly style="width:70px;ime-mode:disabled;background:#f0f0f0;float:left;" value="<?=$row_si4n['si4n_remainder_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.si4n_remainder_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif" /></td> <td width="2"></td></tr></table>
<?
} else {
	echo $row_si4n['si4n_remainder_date'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리결과
<?
//김국진 과장, 관리자 권한 161017
if($member['mb_id'] == "kcmc1009" || $member['mb_id'] == "master") {
?>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:5px;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="#pop_si4n_process_memo" onclick="pop_si4n_process_memo();return false;" onkeypress="this.onclick;">팝업</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
}
?>
										</td>
										<td nowrap class="tdrow" colspan="5">
<?
if($member['mb_level'] > 6) {
?>
											<textarea name="si4n_etc" id="si4n_etc" class="textfm" style='width:99%;height:76px;word-break:break-all;' required><?=$row_si4n['si4n_etc']?></textarea>
<?
} else {
	echo "<pre>".$row_si4n['si4n_etc']."</pre>";
?>
											<textarea name="si4n_etc" class="textfm" style='width:99%;height:56px;word-break:break-all;display:none;'><?=$row_si4n['si4n_etc']?></textarea>
<?
}
?>
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px"></div>
								<!--첨부서류-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:120px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														첨부서류(컨설팅 후)
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_1" value="1" style="vertical-align:middle" />삭제<? } ?>
<?
if($is_damdang == "ok") {
?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('si4n_file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">추가</span></a>
											</div>
<?
}
if($row_si4n['si4n_file_1']) $si4n_file_1 = mb_substr($row_si4n['si4n_file_1'],16,99,'euc-kr');
if($row_si4n['si4n_file_2']) $si4n_file_2 = mb_substr($row_si4n['si4n_file_2'],16,99,'euc-kr');
if($row_si4n['si4n_file_3']) $si4n_file_3 = mb_substr($row_si4n['si4n_file_3'],16,99,'euc-kr');
if($row_si4n['si4n_file_4']) $si4n_file_4 = mb_substr($row_si4n['si4n_file_4'],16,99,'euc-kr');
if($row_si4n['si4n_file_5']) $si4n_file_5 = mb_substr($row_si4n['si4n_file_5'],16,99,'euc-kr');
if($row_si4n['si4n_file_6']) $si4n_file_6 = mb_substr($row_si4n['si4n_file_6'],16,99,'euc-kr');
if($row_si4n['si4n_file_7']) $si4n_file_7 = mb_substr($row_si4n['si4n_file_7'],16,99,'euc-kr');
if($row_si4n['si4n_file_8']) $si4n_file_8 = mb_substr($row_si4n['si4n_file_8'],16,99,'euc-kr');
?>
										</td>
										<td   class="tdrow" width="373">
											<? if($is_damdang == "ok") { ?><input name="si4n_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_1']?>" target="_blank"><?=$si4n_file_1?></a>
											<input type="hidden" name="si4n_file_hidden_1" value="<?=$row_si4n['si4n_file_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_2" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_2']?>" target="_blank"><?=$si4n_file_2?></a>
											<input type="hidden" name="si4n_file_hidden_2" value="<?=$row_si4n['si4n_file_2']?>" />
										</td>
									</tr>
									<tr id="si4n_file_tr2" style="<? if(!$row_si4n['si4n_file_3'] && !$row_si4n['si4n_file_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_3" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_3']?>" target="_blank"><?=$si4n_file_3?></a>
											<input type="hidden" name="si4n_file_hidden_3" value="<?=$row_si4n['si4n_file_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_4" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_4']?>" target="_blank"><?=$si4n_file_4?></a>
											<input type="hidden" name="si4n_file_hidden_4" value="<?=$row_si4n['si4n_file_4']?>" />
										</td>
									</tr>
									<tr id="si4n_file_tr3" style="<? if(!$row_si4n['si4n_file_5'] && !$row_si4n['si4n_file_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_5" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_5']?>" target="_blank"><?=$si4n_file_5?></a>
											<input type="hidden" name="si4n_file_hidden_5" value="<?=$row_si4n['si4n_file_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_6" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_6']?>" target="_blank"><?=$si4n_file_6?></a>
											<input type="hidden" name="si4n_file_hidden_6" value="<?=$row_si4n['si4n_file_6']?>" />
										</td>
									</tr>
									<tr id="si4n_file_tr4" style="<? if(!$row_si4n['si4n_file_7'] && !$row_si4n['si4n_file_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_7" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_7']?>" target="_blank"><?=$si4n_file_7?></a>
											<input type="hidden" name="si4n_file_hidden_7" value="<?=$row_si4n['si4n_file_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />파일8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="si4n_file_hidden_del_8" value="1" style="vertical-align:middle" />삭제<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="si4n_file_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/si4n_nhis/<?=$row_si4n['si4n_file_8']?>" target="_blank"><?=$si4n_file_8?></a>
											<input type="hidden" name="si4n_file_hidden_8" value="<?=$row_si4n['si4n_file_8']?>" />
										</td>
									</tr>
								</table>

								<input type="hidden" name="prv_dojang_img" value="<?=$row['dojang_img']?>" />
								<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
								<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
								<input type="hidden" name="url" value="./com_view.php" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="com_name_si4n" value="<?=$row['com_name']?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<input type="hidden" name="is_damdang" value="<?=$is_damdang?>" />
								<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>" />
								<input type="hidden" name="qstr" value="<?=$qstr?>" />
								<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>" />
							</div>
							<div id="tab2" style="display:none">
							</div>
							<div style="height:20px;font-size:0px"></div>
							<div style="height:20px;padding-left:478px;">
								<table border="0" cellpadding="0" cellspacing="0" style="float:left;" id="btn_save"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
								<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_list?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
							</div>
							<div style="clean:both;width:100%;height:1px;font-size:0px"></div>

<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
	//alert(getId('manage_div').id);
<?
//본사만 표시 160324
if($member['mb_level'] > 6) {
?>
	getId('manage_div').style.display = "none";
<?
}
?>
}
//]]>
</script>
<?
//신규 등록시 숨김
if($w == "u") {
	//거래처 탭No
	$memo_type = 9;
	//딜러 권한
	if($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) include "inc/client_comment_dealer.php";
	else include "inc/client_comment_only.php";
}
?>
							<div style="height:20px;font-size:0px"></div>
						</form>
						<!--댑메뉴 -->
						<!-- 입력폼 -->
						</div>
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
