<?
$sub_menu = "1800300";
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

$sql_common = " from job_time a ";

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//로그인 속성으로 목록으로 이동 시 해당 지사로 전환됨 기능 해지 150709
	//$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "건설월정액(뷰)";
$g4['title'] = $sub_title." : 프로그램 : ".$easynomu_name;

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
	//최종확인자 로그 저장 (관리자 제외)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//메모
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
//검색 파라미터 전송
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_proxy=".$stx_proxy."&amp;stx_comp_gubun1=".$stx_comp_gubun1."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_comp_gubun3=".$stx_comp_gubun3."&amp;stx_comp_gubun4=".$stx_comp_gubun4."&amp;stx_comp_gubun5=".$stx_comp_gubun5."&amp;stx_comp_gubun6=".$stx_comp_gubun6."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;easynomu_process=".$easynomu_process."&amp;stx_reg_day_chk=".$stx_reg_day_chk."&amp;search_year=".$search_year."&amp;search_month=".$search_month."&amp;search_year_end=".$search_year_end."&amp;search_month_end=".$search_month_end."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday."&amp;stx_emp5_gbn=".$stx_emp5_gbn."&amp;stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&amp;search_day_all=".$search_day_all."&amp;search_day1=".$search_day1."&amp;search_day2=".$search_day2."&amp;search_day3=".$search_day3."&amp;search_day4=".$search_day4."&amp;search_day5=".$search_day5."&amp;search_day6=".$search_day6."&amp;search_day7=".$search_day7."&amp;search_day8=".$search_day8."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_manage_name_input_not=".$stx_manage_name_input_not;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
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
function member_form() {
	var frm = document.dataForm;
	if (frm.firm_name.value == "") {
		alert("사업장명을 입력하세요.");
		frm.firm_name.focus();
		return;
	}
	if(radio_chk(frm.comp_type, "사업자구분을") == 0) {
		frm.comp_type[0].focus();
		return;
	}
	if (frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.user_pass.value == "") {
		alert("비밀번호를 입력하세요.");
		frm.user_pass.focus();
		return;
	}
	window.open("/admin/member_form_easynomu.php?mb_id="+frm.user_id.value+"&mb_password="+frm.user_pass.value+"&mb_name="+frm.firm_name.value);
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.easynomu_process.value == "")
	{
		alert("처리현황을 선택하세요.");
		frm.easynomu_process.focus();
		return;
	}
	frm.action = action_file;
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
	if(count == 0) {
		alert(t+" 선택해 주세요.");
		return rv = 0;
	} else {
		//alert(radio_name_val);
		return rv = 1;
	}
}
// 삭제 검사 확인
function del(page,id) {
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function only_number() {
	//alert(event.keyCode);
	//키보드 상단 숫자키
	if (event.keyCode < 48 || event.keyCode > 57) {
		//키보드 우측 숫자키
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.returnValue = false;
			}
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//결제일 말일 체크 함수
function settlement_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.settlement_day.value != "") main.old_settlement_day.value = main.settlement_day.value;
		main.settlement_day.value = "";
	} else {
		main.settlement_day.value = main.old_settlement_day.value;
	}
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj, k, i ) {
	main = document.dataForm;
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
		obj_name = obj.name.substring(0, 18);
		//alert(obj_name);
		if(obj_name == "approval_effective") {
			var y  = date.substring(0,4);
			var m = date.substring(5,7);
			var d = date.substring(8,10); 
			var date = new Date(m+'/'+d+'/'+y);
			//alert(d+'/'+m+'/'+y);
			var getDate = date.setYear(date.getFullYear() + 1);
			var getDate = date.setDate(date.getDate() - 1);
			var getDate = new Date(getDate);
			var yyyy = getDate.getFullYear();
			var mm = getDate.getMonth()+1;
			var dd = getDate.getDate();
			if(mm < 10) mm = "0"+mm;
			if(dd < 10) dd = "0"+dd;
			resultDate = yyyy+"."+mm+"."+dd;
			main['approval_expiration'+k].value = resultDate;
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
function findNomu(branch) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
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
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
					main.t_insureno.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//사업장관리번호 입력 하이픈
function checkhyphen_tno(inputVal, type, keydown) {
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
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6) {
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12) {
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				main.t_insureno.value=total;
			}else if(keydown =='N') {
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='-') {		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122))  event.preventDefault ? event.preventDefault() : event.returnValue = false;
}
//사업게시일 입력 콤마
function checkcomma(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	var main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;			// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//숫자 입력만
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//관리자 master 입력
	//alert(input);
	if(1 == 1) { // 모두 포함
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				type.value=total;
			}else if(keydown =='N') {
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='.') {		// 먼저 substring을 위해
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
		//탭 시프트+탭 좌 우 Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
//주민등록번호 입력 하이픈
function checkhyphen_jumin_no(inputVal, type, keydown) {
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
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 6){
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		if(keydown =='Y') {
			type.value = total;
		} else if(keydown =='N') {
			return total
		}
	}
	return total
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
	//탭 시프트+탭 좌 우 Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function(n, prec) {
		var k = Math.pow(10, prec);
		return '' + Math.round(n * k) / k;
	};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if(s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
//이지노무 키즈노무 로그인
function easynomu_login(action_file) {
	frm = document.dataForm;
	frm.mb_id.value = frm.easynomu_id.value;
	frm.mb_password.value = frm.easynomu_pw.value;
	//alert(frm.mb_id.value);
	frm.action = action_file;
	frm.target = "_blank";
	frm.submit();
	return;
}
//]]>
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top18.gif" border="0"></td>
						<td width="130"><a href="client_construction_list.php"><img src="images/top18_03.gif" border="0"></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
<?
$samu_list = "";
$report = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--프린트 영역 DIV 종료-->
								<!--탭메뉴 -->
<?
//현재 탭 메뉴 번호
$tab_onoff_this = 7;
//프로그램 종류
$tab_program_url = 3;
include "inc/tab_menu.php";
?>
								<div id="tab1" style="display:none">
									<!--탭 1페이지-->
								</div>
								<div id="tab2" >
									<!--탭 2페이지-->
									<a name="50001"><!--노무관리프로그램--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															노무관리프로그램
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
									<!-- 입력폼 -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red">*</font></td>
											<td nowrap class="tdrow" width="110">
<?
$easynomu_process = $row2['easynomu_process'];
$easynomu_process_array = array("","기초셋팅중","급여셋팅중","완료","보류","해지","보완서류요청");
if($member['mb_level'] != 6) {
?>
												<select name="easynomu_process" class="selectfm" onchange="input_today_easynomu(this,'easynomu_finish_date','easynomu_close_date')">
													<option value=""  <? if($easynomu_process == "")  echo "selected"; ?>>선택</option>
													<option value="1" <? if($easynomu_process == "1") echo "selected"; ?>>기초셋팅중</option>
													<option value="2" <? if($easynomu_process == "2") echo "selected"; ?>>급여셋팅중</option>
													<option value="3" <? if($easynomu_process == "3") echo "selected"; ?>>완료</option>
													<option value="4" <? if($easynomu_process == "4") echo "selected"; ?>>보류</option>
													<option value="5" <? if($easynomu_process == "5") echo "selected"; ?>>해지</option>
													<option value="6" <? if($easynomu_process == "6") echo "selected"; ?>>보완서류요청</option>
												</select>
<?
} else {
	echo $easynomu_process_array[$easynomu_process];
}
?>
											</td>
											<td nowrap class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">셋팅완료일</td>
											<td nowrap  class="tdrow" width="96">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_finish_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_finish_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row2['easynomu_finish_date'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="64"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">시작일</td>
											<td nowrap  class="tdrow" width="96">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_start']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row['service_day_start'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="64"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료일</td>
											<td nowrap  class="tdrow" width="104">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_end']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row['service_day_end'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="70"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">해지일</td>
											<td nowrap  class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_close_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row2['easynomu_close_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">세팅비</td>
											<td nowrap  class="tdrow">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
if($member['mb_level'] != 6) {
?>
												<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$setting_pay?>" maxlength="20" />
<?
} else {
	echo $setting_pay;
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">월정액</td>
											<td nowrap  class="tdrow" colspan="">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
else $setting_pay = "";
if($row['month_pay']) $month_pay = number_format($row['month_pay']);
else $month_pay = "";
if($member['mb_level'] != 6) {
?>
												<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$month_pay?>" maxlength="20" />
<?
} else {
	echo $month_pay;
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">결제일</td>
											<td nowrap  class="tdrow">
<?
if($member['mb_level'] != 6) {
	if($row['settlement_day_last'] == 1) $settlement_day_last_checked = "checked";
?>
												<input name="settlement_day" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$row['settlement_day']?>" maxlength="2" onkeypress="only_number()" />
												<input type="checkbox" name="settlement_day_last" value="1" <?=$settlement_day_last_checked?> style="vertical-align:middle;" onclick="settlement_day_last_chk(this)" />말일
<?
} else {
	if($row['settlement_day'] == "" || $row['settlement_day'] == 0) $settlement_day = "미정";
	else $settlement_day = $row['settlement_day']."일";
	if($row['settlement_day_last'] != 1)	{
?>
												<?=$settlement_day?>
<?
	} else {
		echo "말일";
	}
}
?>
												<input type='hidden' name='old_settlement_day' value='<?=$row['settlement_day']?>' />
												<input type='hidden' name='old_settlement_day_last' value='<?=$row['settlement_day_last']?>' />
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">아이디</td>
											<td nowrap  class="tdrow">
												<input name="easynomu_id" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$row['easynomu_id']?>" maxlength="16" />
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">비밀번호</td>
											<td nowrap  class="tdrow">
												<input name="easynomu_pw" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$row['easynomu_pw']?>" maxlength="16" />
												<input name="mb_id" type="hidden" /><input name="mb_password" type="hidden" />
												<a href="http://labor.easynomu.com/labor/login_check.php" onclick="easynomu_login(this.href);return false;" title="로그인"><img src="images/icon_login.png" border="0" style="vertical-align:middle;" /></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모</td>
											<td nowrap  class="tdrow" colspan="9">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_memo" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row2['easynomu_memo']?>" onkeydown="" />
<?
} else {
	echo $row2['easynomu_memo'];
}
?>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<!--첨부서류-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															첨부서류 (지사 → 본사)
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
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>기본서류</b></td>
											<td nowrap  class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
if($file_check[0]) echo "컨설팅의뢰서. ";
if($file_check[1]) echo "계약서. ";
if($file_check[2]) echo "사무위탁서. ";
if($file_check[3]) echo "대리인선임(공단). ";
if($file_check[4]) echo "전자민원(센터). ";
if($file_check[5]) echo "사업자등록증. ";
if($file_check[6]) echo "통장사본. ";
if($file_check[7]) echo "취득/상실리스트. ";
if($file_check[8]) echo "시간선택제. ";
if($file_check[9]) echo "정책자금의뢰서. ";
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일7</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일8</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>이지노무 서류</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
if($file_easynomu[0]) echo "이지노무 계약서. ";
if($file_easynomu[1]) echo "근로계약서. ";
if($file_easynomu[2]) echo "취업규칙 체크리스트. ";
if($file_easynomu[3]) echo "최근3개월 급여대장. ";
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/easynomu/<?=$row['file_easynomu_1']?>" target="_blank"><?=$row['file_easynomu_1']?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2</td>
											<td   class="tdrow" >
												<a href="files/easynomu/<?=$row['file_easynomu_2']?>" target="_blank"><?=$row['file_easynomu_2']?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기타 서류<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
echo $row['file_etc'];
//한글 파일명 인코딩
$filename_1 = iconv("UTF-8", "EUC-KR", $row['filename_1']);
$filename_2 = iconv("UTF-8", "EUC-KR", $row['filename_2']);
$filename_3 = iconv("UTF-8", "EUC-KR", $row['filename_3']);
$filename_4 = iconv("UTF-8", "EUC-KR", $row['filename_4']);
$filename_5 = iconv("UTF-8", "EUC-KR", $row['filename_5']);
$filename_6 = iconv("UTF-8", "EUC-KR", $row['filename_6']);
$filename_7 = iconv("UTF-8", "EUC-KR", $row['filename_7']);
$filename_8 = iconv("UTF-8", "EUC-KR", $row['filename_8']);
?>
											</td>
										</tr>
									</table>
									<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
									<input type="hidden" name="url" value="%2Flabor%2Fmain.php" />
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="page" value="<?=$page?>" />
									<input type="hidden" name="qstr" value="<?=$qstr?>" />
									<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>" />
									<div style="height:20px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
										<tr>
											<td align="center">
<?
//권한별 링크값
//echo $member['mb_level'];
if($member['mb_level'] != 6) {
	$url_save = "javascript:checkData('client_construction_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
//목록 링크
$list_url = "./client_construction_list.php?page=".$page."&amp;".$qstr."&amp;".$stx_qstr;
//본사 권한
if($member['mb_level'] >= 6) {
?>
												<a href="<?=$url_save?>"><img src="images/btn_save_big.png" border="0" alt="저장" /></a>
<? } ?>
												<a href="<?=$list_url?>"><img src="images/btn_list_big.png" border="0" alt="목록" /></a>
											</td>
										</tr>
									</table>
<?
include "inc/client_comment_only.php";
?>
									<div style="height:20px;font-size:0px"></div>
								</div>
							</form><!--dataForm 폼 종료-->
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
