<?
$sub_menu = "100100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_comp_gubun10=".$stx_comp_gubun10."&stx_comp_gubun11=".$stx_comp_gubun11."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&agent_elect_public_yn=".$agent_elect_public_yn."&agent_elect_center_yn=".$agent_elect_center_yn."&easynomu_process=".$easynomu_process."&review_process=".$review_process."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_emp5_gbn=".$stx_emp5_gbn."&stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_manage_name=".$stx_manage_name."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_manage_name_input_not=".$stx_manage_name_input_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
//상세검색
$stx_qstr  = "stx_rules_report_if=".$stx_rules_report_if."&stx_retirement_age=".$stx_retirement_age."&stx_new_fund_scale_site=".$stx_new_fund_scale_site."&stx_establish_type=".$stx_establish_type."&stx_refund_request=".$stx_refund_request."&stx_factory_split=".$stx_factory_split."&stx_extend_age=".$stx_extend_age."&stx_easynomu_request=".$stx_easynomu_request;
$stx_qstr .= "&stx_fund_type_industry=".$stx_fund_type_industry."&stx_employment_support=".$stx_employment_support."&stx_establish_proposal_if=".$stx_establish_proposal_if."&stx_multitude=".$stx_multitude."&stx_charge_progress=".$stx_charge_progress."&stx_establish_way=".$stx_establish_way."&stx_sj_if=".$stx_sj_if."&stx_handicapped_employment=".$stx_handicapped_employment;
$stx_qstr .= "&stx_disaster_if=".$stx_disaster_if."&stx_found_if=".$stx_found_if."&stx_subsidy_type_if=".$stx_found_if."&stx_factory_site_1000=".$stx_factory_site_1000."&stx_women_matriarch_if=".$stx_women_matriarch_if."&stx_found_tax=".$stx_found_tax."&stx_disaster_if=".$stx_disaster_if."&stx_job_creation_proposal=".$stx_job_creation_proposal."&stx_rule_pay=".$stx_rule_pay;
$stx_qstr .= "&stx_rural_areas=".$stx_rural_areas."&stx_pay_peak_if=".$stx_pay_peak_if."&stx_career_kind=".$stx_career_kind."&stx_fund_basic_check=".$stx_fund_basic_check."&stx_shift_system=".$stx_shift_system."&stx_local_tax_yn=".$stx_local_tax_yn."&stx_work_contract=".$stx_work_contract."&stx_fund_kind=".$stx_fund_kind."&stx_establish_request=".$stx_establish_request;

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
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

$sub_title = "접수처리현황(뷰)";
$g4['title'] = $sub_title." : 거래처 : ".$easynomu_name;

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
}
//메모
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
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
	if (frm.comp_bznb.value == "") {
		alert("사업자등록번호를 입력하세요.");
		frm.comp_bznb.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("이미 등록된 사업자번호입니다. 확인 후 등록 바랍니다.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.uptae.value == "") {
		alert("업태를 입력하세요.");
		frm.uptae.focus();
		return;
	}
	if (frm.cust_name.value == "")
	{
		alert("대표자를 입력하세요.");
		frm.cust_name.focus();
		return;
	}
	if (frm.cust_tel1.value == "") {
		alert("전화번호(앞)를 입력하세요.");
		frm.cust_tel1.focus();
		return;
	}
	if (frm.cust_tel2.value == "") {
		alert("전화번호(중앙)를 입력하세요.");
		frm.cust_tel2.focus();
		return;
	}
/*
	if (frm.cust_tel3.value == "") {
		alert("전화번호(뒤)를 입력하세요.");
		frm.cust_tel3.focus();
		return;
	}
	if (frm.cust_fax1.value == "") {
		alert("팩스번호(앞)를 입력하세요.");
		frm.cust_fax1.focus();
		return;
	}
	if (frm.cust_fax2.value == "") {
		alert("팩스번호(중앙)를 입력하세요.");
		frm.cust_fax2.focus();
		return;
	}
	if (frm.cust_fax3.value == "") {
		alert("팩스번호(뒤)를 입력하세요.");
		frm.cust_fax3.focus();
		return;
	}
*/
	if (frm.damdang_name.value == "") {
		alert("담당자명을 입력하세요.");
		frm.damdang_name.focus();
		return;
	}
/*
	if (frm.new_zip.value == "") {
		alert("주소를 입력하세요.");
		return;
	}
*/
	if (frm.cust_email.value == "") {
		alert("이메일를 입력하세요.");
		frm.cust_email.focus();
		return;
	}
	frm.action = action_file;
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
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
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
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				main.t_insureno.value=total;
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
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
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
		if(keydown =='Y'){
			type.value = total;
		}else if(keydown =='N'){
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
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_on.gif";
		document.getElementById('tab_img2').src="./images/tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_off.gif";
		document.getElementById('tab_img2').src="./images/tab02_on.gif";
	}
}
//신청가능(예상) 추가 삭제 151014 (동일 함수 사용, tr 갯수 3개, 5개까지 가능)
function possible_add(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	if(v2.style.display == "none") {
		v2.style.display = "";
		v2b.style.display = "";
		v2c.style.display = "";
		frm[count_input].value = 2;
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
			v3c.style.display = "";
			frm[count_input].value = 3;
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
				v4c.style.display = "";
				frm[count_input].value = 4;
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
					v5c.style.display = "";
					frm[count_input].value = 5;
				} else {
					alert("최대 5개까지 추가 가능합니다.");
				}
			}
		}
	}
}
function possible_del(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	if(v5.style.display == "") {
		v5.style.display = "none";
		v5b.style.display = "none";
		v5c.style.display = "none";
		frm[count_input].value = 4;
	} else {
		if(v4.style.display == "") {
			v4.style.display = "none";
			v4b.style.display = "none";
			v4c.style.display = "none";
			frm[count_input].value = 3;
		} else {
			if(v3.style.display == "") {
				v3.style.display = "none";
				v3b.style.display = "none";
				v3c.style.display = "none";
				frm[count_input].value = 2;
			} else {
				if(v2.style.display == "") {
					v2.style.display = "none";
					v2b.style.display = "none";
					v2c.style.display = "none";
					frm[count_input].value = 1;
				} else {
					alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
				}
			}
		}
	}
}
//지원금 신청 추가 삭제
function field_add(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v2d = document.getElementById(div_id+'2d');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v3d = document.getElementById(div_id+'3d');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v4d = document.getElementById(div_id+'4d');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	var v5d = document.getElementById(div_id+'5d');
	var v6 = document.getElementById(div_id+'6');
	var v6b = document.getElementById(div_id+'6b');
	var v6c = document.getElementById(div_id+'6c');
	var v6d = document.getElementById(div_id+'6d');
	var v7 = document.getElementById(div_id+'7');
	var v7b = document.getElementById(div_id+'7b');
	var v7c = document.getElementById(div_id+'7c');
	var v7d = document.getElementById(div_id+'7d');
	var v8 = document.getElementById(div_id+'8');
	var v8b = document.getElementById(div_id+'8b');
	var v8c = document.getElementById(div_id+'8c');
	var v8d = document.getElementById(div_id+'8d');
	var v9 = document.getElementById(div_id+'9');
	var v9b = document.getElementById(div_id+'9b');
	var v9c = document.getElementById(div_id+'9c');
	var v9d = document.getElementById(div_id+'9d');
	var v10 = document.getElementById(div_id+'10');
	var v10b = document.getElementById(div_id+'10b');
	var v10c = document.getElementById(div_id+'10c');
	var v10d = document.getElementById(div_id+'10d');
	var v11 = document.getElementById(div_id+'11');
	var v11b = document.getElementById(div_id+'11b');
	var v11c = document.getElementById(div_id+'11c');
	var v11d = document.getElementById(div_id+'11d');
	var v12 = document.getElementById(div_id+'12');
	var v12b = document.getElementById(div_id+'12b');
	var v12c = document.getElementById(div_id+'12c');
	var v12d = document.getElementById(div_id+'12d');
	var v13 = document.getElementById(div_id+'13');
	var v13b = document.getElementById(div_id+'13b');
	var v13c = document.getElementById(div_id+'13c');
	var v13d = document.getElementById(div_id+'13d');
	var v14 = document.getElementById(div_id+'14');
	var v14b = document.getElementById(div_id+'14b');
	var v14c = document.getElementById(div_id+'14c');
	var v14d = document.getElementById(div_id+'14d');
	var v15 = document.getElementById(div_id+'15');
	var v15b = document.getElementById(div_id+'15b');
	var v15c = document.getElementById(div_id+'15c');
	var v15d = document.getElementById(div_id+'15d');
	var v16 = document.getElementById(div_id+'16');
	var v16b = document.getElementById(div_id+'16b');
	var v16c = document.getElementById(div_id+'16c');
	var v16d = document.getElementById(div_id+'16d');
	var v17 = document.getElementById(div_id+'17');
	var v17b = document.getElementById(div_id+'17b');
	var v17c = document.getElementById(div_id+'17c');
	var v17d = document.getElementById(div_id+'17d');
	var v18 = document.getElementById(div_id+'18');
	var v18b = document.getElementById(div_id+'18b');
	var v18c = document.getElementById(div_id+'18c');
	var v18d = document.getElementById(div_id+'18d');
	var v19 = document.getElementById(div_id+'19');
	var v19b = document.getElementById(div_id+'19b');
	var v19c = document.getElementById(div_id+'19c');
	var v19d = document.getElementById(div_id+'19d');
	var v20 = document.getElementById(div_id+'20');
	var v20b = document.getElementById(div_id+'20b');
	var v20c = document.getElementById(div_id+'20c');
	var v20d = document.getElementById(div_id+'20d');
	if(v2.style.display == "none") {
		v2.style.display = "";
		v2b.style.display = "";
		v2c.style.display = "";
		if(div_id == "tr_education") v2d.style.display = "";
		frm[count_input].value = 2;
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
			v3c.style.display = "";
			if(div_id == "tr_education") v3d.style.display = "";
			frm[count_input].value = 3;
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
				v4c.style.display = "";
				if(div_id == "tr_education") v4d.style.display = "";
				frm[count_input].value = 4;
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
					v5c.style.display = "";
					if(div_id == "tr_education") v5d.style.display = "";
					frm[count_input].value = 5;
				} else {
					if(v6.style.display == "none") {
						v6.style.display = "";
						v6b.style.display = "";
						v6c.style.display = "";
						if(div_id == "tr_education") v6d.style.display = "";
						frm[count_input].value = 6;
					} else {
						if(v7.style.display == "none") {
							v7.style.display = "";
							v7b.style.display = "";
							v7c.style.display = "";
							if(div_id == "tr_education") v7d.style.display = "";
							frm[count_input].value = 7;
						} else {
							if(v8.style.display == "none") {
								v8.style.display = "";
								v8b.style.display = "";
								v8c.style.display = "";
								if(div_id == "tr_education") v8d.style.display = "";
								frm[count_input].value = 8;
							} else {
								if(v9.style.display == "none") {
									v9.style.display = "";
									v9b.style.display = "";
									v9c.style.display = "";
									if(div_id == "tr_education") v9d.style.display = "";
									frm[count_input].value = 9;
								} else {
									if(v10.style.display == "none") {
										v10.style.display = "";
										v10b.style.display = "";
										v10c.style.display = "";
										if(div_id == "tr_education") v10d.style.display = "";
										frm[count_input].value = 10;
									} else {
										if(v11.style.display == "none") {
											v11.style.display = "";
											v11b.style.display = "";
											v11c.style.display = "";
											if(div_id == "tr_education") v11d.style.display = "";
											frm[count_input].value = 11;
										} else {
											if(v12.style.display == "none") {
												v12.style.display = "";
												v12b.style.display = "";
												v12c.style.display = "";
												if(div_id == "tr_education") v12d.style.display = "";
												frm[count_input].value = 12;
											} else {
												if(v13.style.display == "none") {
													v13.style.display = "";
													v13b.style.display = "";
													v13c.style.display = "";
													if(div_id == "tr_education") v13d.style.display = "";
													frm[count_input].value = 13;
												} else {
													if(v14.style.display == "none") {
														v14.style.display = "";
														v14b.style.display = "";
														v14c.style.display = "";
														if(div_id == "tr_education") v14d.style.display = "";
														frm[count_input].value = 14;
													} else {
														if(v15.style.display == "none") {
															v15.style.display = "";
															v15b.style.display = "";
															v15c.style.display = "";
															if(div_id == "tr_education") v15d.style.display = "";
															frm[count_input].value = 15;
														} else {
															if(v16.style.display == "none") {
																v16.style.display = "";
																v16b.style.display = "";
																v16c.style.display = "";
																if(div_id == "tr_education") v16d.style.display = "";
																frm[count_input].value = 16;
															} else {
																if(v17.style.display == "none") {
																	v17.style.display = "";
																	v17b.style.display = "";
																	v17c.style.display = "";
																	if(div_id == "tr_education") v17d.style.display = "";
																	frm[count_input].value = 17;
																} else {
																	if(v18.style.display == "none") {
																		v18.style.display = "";
																		v18b.style.display = "";
																		v18c.style.display = "";
																		if(div_id == "tr_education") v18d.style.display = "";
																		frm[count_input].value = 18;
																	} else {
																		if(v19.style.display == "none") {
																			v19.style.display = "";
																			v19b.style.display = "";
																			v19c.style.display = "";
																			if(div_id == "tr_education") v19d.style.display = "";
																			frm[count_input].value = 19;
																		} else {
																			if(v20.style.display == "none") {
																				v20.style.display = "";
																				v20b.style.display = "";
																				v20c.style.display = "";
																				if(div_id == "tr_education") v20d.style.display = "";
																				frm[count_input].value = 20;
																			} else {
																				alert("최대 20개까지 추가 가능합니다.");
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
function field_del(div_id, count_input) {
	var frm = document.dataForm;
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v2c = document.getElementById(div_id+'2c');
	var v2d = document.getElementById(div_id+'2d');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v3c = document.getElementById(div_id+'3c');
	var v3d = document.getElementById(div_id+'3d');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v4c = document.getElementById(div_id+'4c');
	var v4d = document.getElementById(div_id+'4d');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	var v5c = document.getElementById(div_id+'5c');
	var v5d = document.getElementById(div_id+'5d');
	var v6 = document.getElementById(div_id+'6');
	var v6b = document.getElementById(div_id+'6b');
	var v6c = document.getElementById(div_id+'6c');
	var v6d = document.getElementById(div_id+'6d');
	var v7 = document.getElementById(div_id+'7');
	var v7b = document.getElementById(div_id+'7b');
	var v7c = document.getElementById(div_id+'7c');
	var v7d = document.getElementById(div_id+'7d');
	var v8 = document.getElementById(div_id+'8');
	var v8b = document.getElementById(div_id+'8b');
	var v8c = document.getElementById(div_id+'8c');
	var v8d = document.getElementById(div_id+'8d');
	var v9 = document.getElementById(div_id+'9');
	var v9b = document.getElementById(div_id+'9b');
	var v9c = document.getElementById(div_id+'9c');
	var v9d = document.getElementById(div_id+'9d');
	var v10 = document.getElementById(div_id+'10');
	var v10b = document.getElementById(div_id+'10b');
	var v10c = document.getElementById(div_id+'10c');
	var v10d = document.getElementById(div_id+'10d');
	var v11 = document.getElementById(div_id+'11');
	var v11b = document.getElementById(div_id+'11b');
	var v11c = document.getElementById(div_id+'11c');
	var v11d = document.getElementById(div_id+'11d');
	var v12 = document.getElementById(div_id+'12');
	var v12b = document.getElementById(div_id+'12b');
	var v12c = document.getElementById(div_id+'12c');
	var v12d = document.getElementById(div_id+'12d');
	var v13 = document.getElementById(div_id+'13');
	var v13b = document.getElementById(div_id+'13b');
	var v13c = document.getElementById(div_id+'13c');
	var v13d = document.getElementById(div_id+'13d');
	var v14 = document.getElementById(div_id+'14');
	var v14b = document.getElementById(div_id+'14b');
	var v14c = document.getElementById(div_id+'14c');
	var v14d = document.getElementById(div_id+'14d');
	var v15 = document.getElementById(div_id+'15');
	var v15b = document.getElementById(div_id+'15b');
	var v15c = document.getElementById(div_id+'15c');
	var v15d = document.getElementById(div_id+'15d');
	var v16 = document.getElementById(div_id+'16');
	var v16b = document.getElementById(div_id+'16b');
	var v16c = document.getElementById(div_id+'16c');
	var v16d = document.getElementById(div_id+'16d');
	var v17 = document.getElementById(div_id+'17');
	var v17b = document.getElementById(div_id+'17b');
	var v17c = document.getElementById(div_id+'17c');
	var v17d = document.getElementById(div_id+'17d');
	var v18 = document.getElementById(div_id+'18');
	var v18b = document.getElementById(div_id+'18b');
	var v18c = document.getElementById(div_id+'18c');
	var v18d = document.getElementById(div_id+'18d');
	var v19 = document.getElementById(div_id+'19');
	var v19b = document.getElementById(div_id+'19b');
	var v19c = document.getElementById(div_id+'19c');
	var v19d = document.getElementById(div_id+'19d');
	var v20 = document.getElementById(div_id+'20');
	var v20b = document.getElementById(div_id+'20b');
	var v20c = document.getElementById(div_id+'20c');
	var v20d = document.getElementById(div_id+'20d');
	//10개 => 20개로 증가 전정애 주임 요청 160308
	if(v20.style.display == "") {
		v20.style.display = "none";
		v20b.style.display = "none";
		v20c.style.display = "none";
		if(div_id == "tr_education") v20d.style.display = "none";
		frm[count_input].value = 19;
	} else {
		if(v19.style.display == "") {
			v19.style.display = "none";
			v19b.style.display = "none";
			v19c.style.display = "none";
			if(div_id == "tr_education") v19d.style.display = "none";
			frm[count_input].value = 18;
		} else {
			if(v18.style.display == "") {
				v18.style.display = "none";
				v18b.style.display = "none";
				v18c.style.display = "none";
				if(div_id == "tr_education") v18d.style.display = "none";
				frm[count_input].value = 17;
			} else {
				if(v17.style.display == "") {
					v17.style.display = "none";
					v17b.style.display = "none";
					v17c.style.display = "none";
					if(div_id == "tr_education") v17d.style.display = "none";
					frm[count_input].value = 16;
				} else {
					if(v16.style.display == "") {
						v16.style.display = "none";
						v16b.style.display = "none";
						v16c.style.display = "none";
						if(div_id == "tr_education") v16d.style.display = "none";
						frm[count_input].value = 15;
					} else {
						if(v15.style.display == "") {
							v15.style.display = "none";
							v15b.style.display = "none";
							v15c.style.display = "none";
							if(div_id == "tr_education") v15d.style.display = "none";
							frm[count_input].value = 14;
						} else {
							if(v14.style.display == "") {
								v14.style.display = "none";
								v14b.style.display = "none";
								v14c.style.display = "none";
								if(div_id == "tr_education") v14d.style.display = "none";
								frm[count_input].value = 13;
							} else {
								if(v13.style.display == "") {
									v13.style.display = "none";
									v13b.style.display = "none";
									v13c.style.display = "none";
									if(div_id == "tr_education") v13d.style.display = "none";
									frm[count_input].value = 12;
								} else {
									if(v12.style.display == "") {
										v12.style.display = "none";
										v12b.style.display = "none";
										v12c.style.display = "none";
										if(div_id == "tr_education") v12d.style.display = "none";
										frm[count_input].value = 11;
									} else {
										if(v11.style.display == "") {
											v11.style.display = "none";
											v11b.style.display = "none";
											v11c.style.display = "none";
											if(div_id == "tr_education") v11d.style.display = "none";
											frm[count_input].value = 10;
										} else {
											if(v10.style.display == "") {
												v10.style.display = "none";
												v10b.style.display = "none";
												v10c.style.display = "none";
												if(div_id == "tr_education") v10d.style.display = "none";
												frm[count_input].value = 9;
											} else {
												if(v9.style.display == "") {
													v9.style.display = "none";
													v9b.style.display = "none";
													v9c.style.display = "none";
													if(div_id == "tr_education") v9d.style.display = "none";
													frm[count_input].value = 8;
												} else {
													if(v8.style.display == "") {
														v8.style.display = "none";
														v8b.style.display = "none";
														v8c.style.display = "none";
														if(div_id == "tr_education") v8d.style.display = "none";
														frm[count_input].value = 7;
													} else {
														if(v7.style.display == "") {
															v7.style.display = "none";
															v7b.style.display = "none";
															v7c.style.display = "none";
															if(div_id == "tr_education") v7d.style.display = "none";
															frm[count_input].value = 6;
														} else {
															if(v6.style.display == "") {
																v6.style.display = "none";
																v6b.style.display = "none";
																v6c.style.display = "none";
																if(div_id == "tr_education") v6d.style.display = "none";
																frm[count_input].value = 5;
															} else {
																if(v5.style.display == "") {
																	v5.style.display = "none";
																	v5b.style.display = "none";
																	v5c.style.display = "none";
																	if(div_id == "tr_education") v5d.style.display = "none";
																	frm[count_input].value = 4;
																} else {
																	if(v4.style.display == "") {
																		v4.style.display = "none";
																		v4b.style.display = "none";
																		v4c.style.display = "none";
																		if(div_id == "tr_education") v4d.style.display = "none";
																		frm[count_input].value = 3;
																	} else {
																		if(v3.style.display == "") {
																			v3.style.display = "none";
																			v3b.style.display = "none";
																			v3c.style.display = "none";
																			if(div_id == "tr_education") v3d.style.display = "none";
																			frm[count_input].value = 2;
																		} else {
																			if(v2.style.display == "") {
																				v2.style.display = "none";
																				v2b.style.display = "none";
																				v2c.style.display = "none";
																				if(div_id == "tr_education") v2d.style.display = "none";
																				frm[count_input].value = 1;
																			} else {
																				alert("최소 1줄은 존재해야 합니다. 해당 사항이 없을시 내용을 삭제하세요.");
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
function view_application_date_chk(obj) {
	if(obj.name == "application_date_chk") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_1');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_1');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_1');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_1');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk2") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_2');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_2');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_2');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_2');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk3") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_3');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_3');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_3');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_3');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk4") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_4');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_4');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_4');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_4');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk5") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_5');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_5');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_5');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_5');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk6") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_6');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_6');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_6');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_6');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk7") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_7');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_7');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_7');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_7');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk8") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_8');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_8');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_8');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_8');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk9") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_9');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_9');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_9');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_9');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk10") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_10');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_10');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_10');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_10');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk11") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_11');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_11');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_11');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_11');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk12") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_12');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_12');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_12');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_12');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk13") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_13');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_13');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_13');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_13');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk14") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_14');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_14');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_14');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_14');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk15") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_15');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_15');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_15');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_15');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk16") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_16');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_16');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_16');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_16');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk17") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_17');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_17');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_17');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_17');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk18") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_18');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_18');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_18');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_18');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk19") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_19');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_19');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_19');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_19');
			obj3.style.display = "";
		}
	} else if(obj.name == "application_date_chk20") {
		if(!obj.value) {
			obj2 = document.getElementById('application_date_a_20');
			obj2.style.display = "";
			obj3 = document.getElementById('application_date_b_20');
			obj3.style.display = "none";
		} else {
			obj2 = document.getElementById('application_date_a_20');
			obj2.style.display = "none";
			obj3 = document.getElementById('application_date_b_20');
			obj3.style.display = "";
		}
	}
}
function view_close_kind(obj, obj_no) {
	if(!obj.value) {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "none";
	} else {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "none";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "";
	}
}
</script>
<?
include "inc/top.php";
$url_list = "./client_process_list.php?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width="130"><a href="<?=$url_list?>"><img src="images/top01_02.gif" border="0" /></a></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->
<?
$samu_list = "";
$report = "";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div>
<?
//권한별 링크값
//echo $member['mb_level'];
if($member['mb_level'] >= 8) {
	$url_save = "javascript:checkData('client_process_update.php');";
//지사 영업사원 권한 추가 160408
} else if($member['mb_level'] == 6 || $member['mb_level'] == 5) {
	$url_save = "javascript:checkData('client_process_update_branch.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
//현재 탭 메뉴 번호
$tab_onoff_this = 2;
//프로그램 종류
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
include "inc/tab_menu.php";
//본사처리현황
include "inc/client_basic_admin.php";
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
if($member['mb_level'] >= 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_list.php?page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./reduction_prevention_view.php?w=<?=$w?>&id=<?=$id?>" target="">감원방지기간조회</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										</td>
									</tr>
								</table>
								<div id="tab1" style="display:none">
								</div>

								<div id="tab2" >
<?
//인력관리 160913
include "inc/emp_agency.php";
?>
									<!--댑메뉴 -->
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='proxy_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															최종 완료
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
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $proxy_div_display = "display:none;";
else $proxy_div_display = "";
?>
									<div id="proxy_div" style="<?=$proxy_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최종완료일</td>
											<td nowrap class="tdrow" width="">
<?
$proxy = $row['proxy'];
$proxy_array = array("","접수","처리중","완료","진행취소","반려");
if($member['mb_level'] != 6) {
?>
												<select name="proxy" class="selectfm" onchange="input_today(this,'proxy_date','3')">
													<option value=""  <? if($proxy == "")  echo "selected"; ?>>선택</option>
													<option value="1" <? if($proxy == "1") echo "selected"; ?>>접수</option>
													<option value="2" <? if($proxy == "2") echo "selected"; ?>>처리중</option>
													<option value="3" <? if($proxy == "3") echo "selected"; ?>>완료</option>
													<option value="4" <? if($proxy == "4") echo "selected"; ?>>진행취소</option>
													<option value="5" <? if($proxy == "5") echo "selected"; ?>>반려</option>
												</select>
												완료
												<input name="proxy_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['proxy_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $proxy_array[$proxy];
	echo $row2['proxy_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">최종완료 메모</td>
											<td nowrap class="tdrow" width="">
<?
if($member['mb_level'] != 6) {
?>
												<input name="proxy_memo" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row2['proxy_memo']?>" onkeydown="">
<?
} else {
	echo $row2['proxy_memo'];
}
?>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<!--첨부서류-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='filename_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
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
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $filename_div_display = "display:none;";
else $filename_div_display = "";
?>
									<div id="filename_div" style="<?=$filename_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>기본서류</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
/*
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
if($file_check[10]) echo "육아휴직장려금. ";
if($file_check[11]) echo "대체인력지원금. ";
*/
for($fc=0;$fc<=count($file_check_array);$fc++) {
	if($file_check[$fc]) echo $file_check_array[$fc].". ";
}
//파일명 날짜 시간 제거 표시 160201
if($row['filename_1']) $filename_1 = mb_substr($row['filename_1'],16,99,'euc-kr');
if($row['filename_2']) $filename_2 = mb_substr($row['filename_2'],16,99,'euc-kr');
if($row['filename_3']) $filename_3 = mb_substr($row['filename_3'],16,99,'euc-kr');
if($row['filename_4']) $filename_4 = mb_substr($row['filename_4'],16,99,'euc-kr');
if($row['filename_5']) $filename_5 = mb_substr($row['filename_5'],16,99,'euc-kr');
if($row['filename_6']) $filename_6 = mb_substr($row['filename_6'],16,99,'euc-kr');
if($row['filename_7']) $filename_7 = mb_substr($row['filename_7'],16,99,'euc-kr');
if($row['filename_8']) $filename_8 = mb_substr($row['filename_8'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$filename_1?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$filename_2?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$filename_3?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$filename_4?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$filename_5?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$filename_6?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일7</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$filename_7?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일8</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$filename_8?></a>
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
?>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="80002"><!--첨부서류 (본사 → 지사)--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='convey_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															첨부서류 (본사 → 지사)
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $convey_div_display = "display:none;";
else $convey_div_display = "";
?>
									<div id="convey_div" style="<?=$convey_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전달서류 메모<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
												<input name="convey_name" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row2['convey_name']?>" maxlength="100">
<?
} else {
	echo $row2['convey_name'];
}
//파일명 날짜 시간 제거 표시 160201
if($row2['convey_file_1']) $convey_file_1 = mb_substr($row2['convey_file_1'],16,99,'euc-kr');
if($row2['convey_file_2']) $convey_file_2 = mb_substr($row2['convey_file_2'],16,99,'euc-kr');
if($row2['convey_file_3']) $convey_file_3 = mb_substr($row2['convey_file_3'],16,99,'euc-kr');
if($row2['convey_file_4']) $convey_file_4 = mb_substr($row2['convey_file_4'],16,99,'euc-kr');
if($row2['convey_file_5']) $convey_file_5 = mb_substr($row2['convey_file_5'],16,99,'euc-kr');
if($row2['convey_file_6']) $convey_file_6 = mb_substr($row2['convey_file_6'],16,99,'euc-kr');
//if($row2['convey_file_7']) $convey_file_7 = mb_substr($row2['convey_file_7'],16,99,'euc-kr');
//if($row2['convey_file_8']) $convey_file_8 = mb_substr($row2['convey_file_8'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_1" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" width="373">
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_1']?>" target="_blank"><?=$convey_file_1?></a>
												<input type="hidden" name="c_file_1" value="<?=$row2['convey_file_1']?>">
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" >
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_2']?>" target="_blank"><?=$convey_file_2?></a>
												<input type="hidden" name="c_file_2" value="<?=$row2['convey_file_2']?>">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" width="">
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_3']?>" target="_blank"><?=$convey_file_3?></a>
												<input type="hidden" name="c_file_3" value="<?=$row2['convey_file_3']?>">
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" >
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_4']?>" target="_blank"><?=$convey_file_4?></a>
												<input type="hidden" name="c_file_4" value="<?=$row2['convey_file_4']?>">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_5" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" width="373">
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_5']?>" target="_blank"><?=$convey_file_5?></a>
												<input type="hidden" name="c_file_5" value="<?=$row2['convey_file_5']?>">
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6 <? if($member['mb_level'] != 6) { ?><input type="checkbox" name="convey_file_del_6" value="1" style="vertical-align:middle">삭제<? } ?></td>
											<td   class="tdrow" >
												<? if($member['mb_level'] != 6) { ?><input name="convey_file_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
												<a href="files/convey_file/<?=$row2['convey_file_6']?>" target="_blank"><?=$convey_file_6?></a>
												<input type="hidden" name="c_file_6" value="<?=$row2['convey_file_6']?>">
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="17001"><!--직무교육--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/so_tab_on_lt.gif"></td> 
														<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															사업주훈련
														</td> 
														<td><img src="images/so_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="botr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $job_file_div_display = "display:none;";
else $job_file_div_display = "";
?>
									<div id="job_file_div" style="<?=$job_file_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부서류목록
											</td>
											<td nowrap  class="tdrow" width="" colspan="2">
<?
$job_file_check = explode(',',$row['job_file_check']);

if($is_damdang == "ok") {
	for($i=0;$i<=7;$i++) {
		$k = $i + 1;
?>
												<input type="checkbox" name="job_file_check<?=$k?>" value="1" <? if($job_file_check[$i] == 1) echo "checked"; ?> style="vertical-align:middle"><? if($i == 0) echo "<span style='color:red;font-weight:bold;'>"; ?><?=$job_file_check_array[$i]?><? if($i == 0) echo "</span>"; ?>
<?
	}
} else {
	if($job_file_check[0]) echo $job_file_check_array[0].". ";
	if($job_file_check[1]) echo $job_file_check_array[1].". ";
	if($job_file_check[2]) echo $job_file_check_array[2].". ";
	if($job_file_check[3]) echo $job_file_check_array[3].". ";
	if($job_file_check[4]) echo $job_file_check_array[4].". ";
	if($job_file_check[5]) echo $job_file_check_array[5].". ";
	if($job_file_check[6]) echo $job_file_check_array[6].". ";
	if($job_file_check[7]) echo $job_file_check_array[7];
}
//파일명 날짜 시간 제거 표시 160201
if($row['job_file_1']) $job_file_1 = mb_substr($row['job_file_1'],16,99,'euc-kr');
if($row['job_file_2']) $job_file_2 = mb_substr($row['job_file_2'],16,99,'euc-kr');
if($row['job_file_3']) $job_file_3 = mb_substr($row['job_file_3'],16,99,'euc-kr');
if($row['job_file_4']) $job_file_4 = mb_substr($row['job_file_4'],16,99,'euc-kr');
if($row['job_file_5']) $job_file_5 = mb_substr($row['job_file_5'],16,99,'euc-kr');
if($row['job_file_6']) $job_file_6 = mb_substr($row['job_file_6'],16,99,'euc-kr');
if($row['job_file_7']) $job_file_7 = mb_substr($row['job_file_7'],16,99,'euc-kr');
if($row['job_file_8']) $job_file_8 = mb_substr($row['job_file_8'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width="" rowspan="4">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부파일
											</td>
											<td   class="tdrow" width="430">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일1</b> <input type="checkbox" name="job_file_del_1" value="1" style="vertical-align:middle">삭제
													<input name="job_file_1" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_1']?>" target="_blank"><?=$job_file_1?></a>
													<input type="hidden" name="p_file_1" value="<?=$row['job_file_1']?>">
												</div>
											</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일2</b> <input type="checkbox" name="job_file_del_2" value="1" style="vertical-align:middle">삭제
													<input name="job_file_2" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_2']?>" target="_blank"><?=$job_file_2?></a>
													<input type="hidden" name="p_file_2" value="<?=$row['job_file_2']?>">
												</div>
											</td>
										</tr>
										<tr>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일3</b> <input type="checkbox" name="job_file_del_3" value="1" style="vertical-align:middle">삭제
													<input name="job_file_3" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_3']?>" target="_blank"><?=$job_file_3?></a>
													<input type="hidden" name="p_file_3" value="<?=$row['job_file_3']?>">
												</div>
											</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일4</b> <input type="checkbox" name="job_file_del_4" value="1" style="vertical-align:middle">삭제
													<input name="job_file_4" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_4']?>" target="_blank"><?=$job_file_4?></a>
													<input type="hidden" name="p_file_4" value="<?=$row['job_file_4']?>">
												</div>
											</td>
										</tr>
										<tr>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일5</b> <input type="checkbox" name="job_file_del_5" value="1" style="vertical-align:middle">삭제
													<input name="job_file_5" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_5']?>" target="_blank"><?=$job_file_5?></a>
													<input type="hidden" name="p_file_5" value="<?=$row['job_file_5']?>">
												</div>
											</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일6</b> <input type="checkbox" name="job_file_del_6" value="1" style="vertical-align:middle">삭제
													<input name="job_file_6" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_6']?>" target="_blank"><?=$job_file_6?></a>
													<input type="hidden" name="p_file_6" value="<?=$row['job_file_6']?>">
												</div>
											</td>
										</tr>
										<tr>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일7</b> <input type="checkbox" name="job_file_del_7" value="1" style="vertical-align:middle">삭제
													<input name="job_file_7" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_7']?>" target="_blank"><?=$job_file_7?></a>
													<input type="hidden" name="p_file_7" value="<?=$row['job_file_7']?>">
												</div>
											</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<? if($is_damdang == "ok") { ?><b>파일8</b> <input type="checkbox" name="job_file_del_8" value="1" style="vertical-align:middle">삭제
													<input name="job_file_8" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
													<a href="files/job_file/<?=$row['job_file_8']?>" target="_blank"><?=$job_file_8?></a>
													<input type="hidden" name="p_file_8" value="<?=$row['job_file_8']?>">
												</div>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<!--댑메뉴 -->
									<a name="50001"><!--노무관리프로그램--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='easynomu_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
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
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $easynomu_div_display = "display:none;";
else $easynomu_div_display = "";
?>
									<div id="easynomu_div" style="<?=$easynomu_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황</td>
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
											<td nowrap  class="tdrow" width="100">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_finish_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_finish_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $row2['easynomu_finish_date'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="70"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">시작일</td>
											<td nowrap  class="tdrow" width="100">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_start']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $row['service_day_start'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="70"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료일</td>
											<td nowrap class="tdrow" width="100">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_end']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
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
												<input name="easynomu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_close_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
<?
} else {
	echo $row2['easynomu_close_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">세팅비</td>
											<td nowrap  class="tdrow">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
if($member['mb_level'] != 6) {
?>
												<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$setting_pay?>" maxlength="20">
<?
} else {
	echo $setting_pay;
}
?>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">월정액</td>
											<td nowrap  class="tdrow" colspan="">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
else $setting_pay = "";
if($row['month_pay']) $month_pay = number_format($row['month_pay']);
else $month_pay = "";
if($member['mb_level'] != 6) {
?>
												<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$month_pay?>" maxlength="20">
<?
} else {
	echo $month_pay;
}
?>
											</td>
											<td nowrap class="tdrowk" width="70"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">결제일</td>
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
											<td nowrap class="tdrowk" width="70"></td>
											<td nowrap  class="tdrow">
											</td>
											<td nowrap class="tdrowk" width="70"></td>
											<td nowrap  class="tdrow">
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
									</div>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<a name="10005"><!--가족보험환급--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='family_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														가족보험환급
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
<?
//대표님 숨김
if($member['mb_id'] == "kcmc1001") $family_div_display = "display:none;";
else $family_div_display = "";
?>
								<div id="family_div" style="<?=$family_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">가족보험관계</td>
										<td nowrap  class="tdrow" colspan="">
<?
//직계가족 근무여부
if($row['family_work_if'] == "1") $family_work_if = "YES";
else if($row['family_work_if'] == "2") $family_work_if = "NO";
else $family_work_if = "";
$insurance_holder = $row['insurance_holder']; //보험가입자
//환급신청의뢰
if($row['refund_request'] == "1") $refund_request = "YES";
else if($row['refund_request'] == "2") $refund_request = "NO";
else $refund_request = "";
$family_refund_wrong = $row['family_refund_wrong']; //불가사유
if($family_work_if) echo "<b>직계가족 근무여부</b> : ".$family_work_if."<br>";
if($insurance_holder) echo "<b>보험가입자</b> : ".$insurance_holder."";
?>
										</td>
										<td nowrap  class="tdrow" width="480">
<?
if($refund_request) echo "<b>환급신청의뢰</b> : ".$refund_request."<br>";
if($family_refund_wrong) echo "<b>불가사유</b> : ".$family_refund_wrong."";
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
										<td nowrap  class="tdrow" colspan="3">
											<pre style='white-space:pre-wrap;word-wrap:break-word;'><?=$row['memo1']?></pre>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
										<td nowrap  class="tdrow" colspan="3">
<?
$check_ok_id = $row['family_process'];
echo $family_process_arry[$check_ok_id];
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="60001"><!--의뢰서 검토현황--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														의뢰서 검토현황
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
										<td nowrap class="tdrowk" width="140"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검토현황</td>
										<td nowrap class="tdrow" width="120">
<?
$review_process = $row2['review_process'];
if($member['mb_level'] != 6) {
?>
											<select name="review_process" class="selectfm" onchange="input_today_double(this,'review_finish_date','2','3')">
												<option value=""  <? if($review_process == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($review_process == "1") echo "selected"; ?>>검토중</option>
												<option value="2" <? if($review_process == "2") echo "selected"; ?>>완료</option>
												<option value="3" <? if($review_process == "3") echo "selected"; ?>>해당없음</option>
											</select>
<?
} else {
	$review_process_array = array("","검토중","해당없음");
	echo $review_process_array[$review_process];
}
?>
										</td>
										<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검토완료일</td>
										<td nowrap  class="tdrow" width="">
<?
if($member['mb_level'] != 6) {
?>
											<input name="review_finish_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['review_finish_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('review_finish_date', '1');" target="">완료</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	echo $row2['review_finish_date'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검토사항</td>
										<td class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="first_review_item" class="textfm" style='width:100%;height:64px; word-break:break-all;' itemname="first_review_item" required><?=$row2['first_review_item']?></textarea>
<?
} else {
	echo $row2['first_review_item'];
}
?>
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														신청가능(예상)
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
										<td nowrap class="tdrowk" width="140"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금1
<?
if($member['mb_level'] != 6) {
?>
											<span style="padding:4px 0 0 15px">
												<a href="javascript:possible_add('tr_process', 'process_count');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:possible_del('tr_process', 'process_count');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</span>
<?
}
?>
										</td>
										<td nowrap class="tdrow" width="150">
<?
$support_kind[1] = $row2['support_kind'];
if($member['mb_level'] != 6) {
?>
											<select name="support_kind" class="selectfm">
												<option value="0" >선택</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($support_kind[1] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
											</select>
<?
} else {
	echo $support_kind_array[$support_kind[1]];
}
?>
										</td>
										<td nowrap class="tdrowk" width="94"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재연락일</td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
											<input name="re_call_date" type="text" class="textfm" style="width:74px;ime-mode:disabled;" value="<?=$row2['re_call_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.re_call_date);">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											<input name="re_call_memo" type="text" class="textfm" style="width:476px;ime-mode:active;" value="<?=$row2['re_call_memo']?>" onkeydown="" />
<?
} else {
	echo $row2['re_call_date'];
	echo $row2['re_call_memo'];
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청서류안내</td>
										<td class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document" class="textfm" style='width:100%;height:64px; word-break:break-all;' itemname="support_document" required><?=$row2['support_document']?></textarea>
<?
} else {
	echo "<pre style='white-space:pre-wrap;word-wrap:break-word;'>".$row2['support_document']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보완(미비)서류안내</td>
										<td nowrap class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document_lack" class="textfm" style='width:100%;height:32px; word-break:break-all;' itemname="support_document_lack" required><?=$row2['support_document_lack']?></textarea>
<?
} else {
	echo $row2['support_document_lack'];
}
?>
										</td>
									</tr>
<?
//신청가능 추가 tr 총 5개 151014
for($k=2;$k<=5;$k++) {
	$support_kind[$k] = $row2['support_kind'.$k];
	if(!$row2['support_kind'.$k] && !$row2['support_document'.$k]) $support_kind_display[$k] = "none";
	else $support_kind_display[$k] = "";
?>
									<tr id="tr_process<?=$k?>" style="<? if($support_kind_display[$k] == "none") echo "display:none"; ?>">
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금<?=$k?>
										</td>
										<td nowrap class="tdrow" colspan="3">
<?
	if($member['mb_level'] != 6) {
?>
											<select name="support_kind<?=$k?>" class="selectfm">
												<option value="0" >선택</option>
<?
		for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($support_kind[$k] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
		}
?>
											</select>
<?
} else {
	echo $support_kind_array[$support_kind[$k]];
}
?>
										</td>
									</tr>
									<tr id="tr_process<?=$k?>b" style="<? if($support_kind_display[$k] == "none") echo "display:none"; ?>">
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청서류안내</td>
										<td class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document<?=$k?>" class="textfm" style='width:100%;height:64px; word-break:break-all;' itemname="support_document" required><?=$row2['support_document'.$k]?></textarea>
<?
} else {
	echo $row2['support_document'.$k];
}
?>
										</td>
									</tr>
									<tr id="tr_process<?=$k?>c" style="<? if($support_kind_display[$k] == "none") echo "display:none"; ?>">
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보완(미비)서류안내</td>
										<td nowrap class="tdrow" colspan="3">
<?
if($member['mb_level'] != 6) {
?>
											<textarea name="support_document_lack<?=$k?>" class="textfm" style='width:100%;height:32px; word-break:break-all;' itemname="support_document_lack" required><?=$row2['support_document_lack'.$k]?></textarea>
<?
} else {
	echo $row2['support_document_lack'.$k];
}
?>
										</td>
									</tr>
<?
}
?>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<a name="10004"><!--고용창출--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														고용창출
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
									<tr style="">
										<td nowrap rowspan="" class="tdrowk" width="112">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용구분
										</td>
										<td nowrap class="tdrow" width="">
<?
$employment_kind = explode(',',$row2['employment_kind']);
$time_choice_work_date = $row2['time_choice_work_date'];
$youth_intern_date = $row2['youth_intern_date'];
$middle_age_intern_date = $row2['middle_age_intern_date'];
$professional_date = $row2['professional_date'];
?>
											<input type="checkbox" name="employment_kind1" value="1" <? if($employment_kind[0] == "1") echo "checked"; ?> style="vertical-align:middle">시간선택제
											<input name="time_choice_work_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$time_choice_work_date?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')"><table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.time_choice_work_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											<input type="checkbox" name="employment_kind2" value="1" <? if($employment_kind[1] == "1") echo "checked"; ?> style="vertical-align:middle">청년인턴
											<input name="youth_intern_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$youth_intern_date?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')"><table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.youth_intern_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>											
											<input type="checkbox" name="employment_kind3" value="1" <? if($employment_kind[2] == "1") echo "checked"; ?> style="vertical-align:middle">장년인턴
											<input name="middle_age_intern_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$middle_age_intern_date?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')"><table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.middle_age_intern_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>											
											<input type="checkbox" name="employment_kind4" value="1" <? if($employment_kind[3] == "1") echo "checked"; ?> style="vertical-align:middle">전문인력
											<input name="professional_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$professional_date?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')"><table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.professional_date);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>											
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
//지원금 최대 갯수 10 => 20 160308
//$app_limit = 10;
$app_limit = 20;
//지원금 DB
$sql_app = " select count(*) as cnt from erp_application where com_code='$com_code' ";
//echo $sql;
$row_app = sql_fetch($sql_app);
$count_app = $row_app['cnt'];
if(!$count_app) $count_app = 1;
//echo $count_app;
$sql_app = " select * from erp_application where com_code='$com_code' order by idx asc ";
//echo $sql_app;
$result_app = sql_query($sql_app);
for($i=0; $row_app=sql_fetch_array($result_app); $i++) {
	$app_idx[$i] = $row_app['idx'];
	//echo $row_app['idx'];
	$application_kind[$i] = $row_app['application_kind'];
	$application_review[$i] = $row_app['application_review'];
	$application_recognize[$i] = $row_app['application_recognize'];
	$application_send[$i] = $row_app['application_send'];
	$application_send_no[$i] = $row_app['application_send_no'];
	$application_accept[$i] = $row_app['application_accept'];
	$application_date_chk[$i] = $row_app['application_date_chk'];
	$application_date_start[$i] = $row_app['application_date_start'];
	$application_date_end[$i] = $row_app['application_date_end'];
	$application_quarter_year[$i] = $row_app['application_quarter_year'];
	$application_quarter[$i] = $row_app['application_quarter'];
	$application_fee_sum[$i] = $row_app['application_fee_sum'];

	$close_kind[$i] = $row_app['close_kind'];
	$close_date[$i] = $row_app['close_date'];
	$close_year[$i] = $row_app['close_year'];
	$close_quarter[$i] = $row_app['close_quarter'];
	$application_cycle[$i] = $row_app['application_cycle'];

	$reapplication_date[$i] = $row_app['reapplication_date'];
	$reapplication_done[$i] = $row_app['reapplication_done'];
}
?>
								<!--댑메뉴 -->
								<a name="40001"><!--신청서 작성--></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														지원금 신청
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
<?
//지원금 반복문 시작
for($app_no=1; $app_no <= $app_limit; $app_no++) {
	$k = $app_no;
	if($k == 1) $k = "";
	$m = $app_no-1;
?>
									<!--지원금 반복문-->
									<tr id="tr_application<?=$k?>" style="<? if($count_app < $app_no) echo "display:none"; ?>">
										<td nowrap rowspan="3" class="tdrowk" width="112">
											<input type="hidden" name="idx<?=$k?>" value="<? if($count_app >= $app_no) echo $app_idx[$m]; ?>">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금<?=$app_no?>
<?
//echo $app_idx[0];
//지원금1 에서만 표시
if($app_no == 1) {
?>
											<span style="padding:4px 0 0 5px">
												<a href="javascript:field_add('tr_application','app_count');"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
												<a href="javascript:field_del('tr_application','app_count');"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
											</span>
<?
}
?>
										</td>
										<td nowrap class="tdrow" width="136">
											<select name="application_kind<?=$k?>" class="selectfm">
												<option value="0" >선택</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
												<option value="<?=$i?>" <? if($application_kind[$m] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">우편물발송</td>
										<td nowrap  class="tdrow" width="130">
											<input name="application_send<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$application_send[$m]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('application_send<?=$k?>', '1');" target="">완료</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">운송장번호</td>
										<td nowrap  class="tdrow" width="160">
											<input name="application_send_no<?=$k?>" type="text" class="textfm" style="width:150px;ime-mode:disabled;" value="<?=$application_send_no[$m]?>" maxlength="30" onKeyPress="only_number_comma();" onkeyup="">
										</td>
										<td nowrap class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">접수일자</td>
										<td nowrap  class="tdrow">
											<input name="application_accept<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$application_accept[$m]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('application_accept<?=$k?>', '1');" target="">완료</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
										</td>
									</tr>
									<tr id="tr_application<?=$k?>b" style="<? if($count_app < $app_no) echo "display:none"; ?>">
										<td nowrap class="tdrowk" style="background-color:#ffffff;padding:4px"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청기간
<?
if($application_date_chk[$m] == 1) $application_date_chk_selected = "selected";
else $application_date_chk_selected = "";
?>
											<select name="application_date_chk<?=$k?>" class="selectfm" onChange="view_application_date_chk(this)">
												<option value="">기간</option>
												<option value="1" <?=$application_date_chk_selected?>>분기</option>
											</select>
										</td>
										<td nowrap  class="tdrow" colspan="3">
<?
//신청분기
$application_quarter_year[$m] = explode(',',$application_quarter_year[$m]);
$application_quarter[$m] = explode('_',$application_quarter[$m]);
$application_quarter_1 = explode(',',$application_quarter[$m][0]);
$application_quarter_2 = explode(',',$application_quarter[$m][1]);
$application_quarter_3 = explode(',',$application_quarter[$m][2]);
?>
<div id="application_date_a_<?=$app_no?>" style="<? if($application_date_chk[$m] == 1) echo "display:none"; ?>">
	<input name="application_date_start<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$application_date_start[$m]?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
	<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.application_date_start<?=$k?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
	~
	<input name="application_date_end<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$application_date_end[$m]?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
	<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.application_date_end<?=$k?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
</div>
<div id="application_date_b_<?=$app_no?>" style="<? if($application_date_chk[$m] != 1) echo "display:none"; ?>">
											<select name="application_quarter_year<?=$k?>_1" class="selectfm" onChange="">
												<option value="">선택</option>
<?
for($i=2016;$i>1989;$i--) {
?>
												<option value="<?=$i?>" <? if($i == $application_quarter_year[$m][0]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select>년
											<input type="checkbox" name="application_quarter<?=$k?>_1_1" value="1" <? if($application_quarter_1[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1분기
											<input type="checkbox" name="application_quarter<?=$k?>_1_2" value="1" <? if($application_quarter_1[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2분기
											<input type="checkbox" name="application_quarter<?=$k?>_1_3" value="1" <? if($application_quarter_1[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3분기
											<input type="checkbox" name="application_quarter<?=$k?>_1_4" value="1" <? if($application_quarter_1[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4분기
											<br>
											<select name="application_quarter_year<?=$k?>_2" class="selectfm" onChange="">
												<option value="">선택</option>
<?
for($i=2016;$i>1989;$i--) {
?>
												<option value="<?=$i?>" <? if($i == $application_quarter_year[$m][1]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select>년
											<input type="checkbox" name="application_quarter<?=$k?>_2_1" value="1" <? if($application_quarter_2[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1분기
											<input type="checkbox" name="application_quarter<?=$k?>_2_2" value="1" <? if($application_quarter_2[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2분기
											<input type="checkbox" name="application_quarter<?=$k?>_2_3" value="1" <? if($application_quarter_2[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3분기
											<input type="checkbox" name="application_quarter<?=$k?>_2_4" value="1" <? if($application_quarter_2[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4분기
											<br>
											<select name="application_quarter_year<?=$k?>_3" class="selectfm" onChange="">
												<option value="">선택</option>
<?
for($i=2016;$i>1989;$i--) {
?>
												<option value="<?=$i?>" <? if($i == $application_quarter_year[$m][2]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select>년
											<input type="checkbox" name="application_quarter<?=$k?>_3_1" value="1" <? if($application_quarter_3[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1분기
											<input type="checkbox" name="application_quarter<?=$k?>_3_2" value="1" <? if($application_quarter_3[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2분기
											<input type="checkbox" name="application_quarter<?=$k?>_3_3" value="1" <? if($application_quarter_3[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3분기
											<input type="checkbox" name="application_quarter<?=$k?>_3_4" value="1" <? if($application_quarter_3[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4분기
</div>
										</td>
										<td nowrap class="tdrowk" style="background-color:#ffffff"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청금액
<?
//신청금액
if($application_fee_sum[$m]) $application_fee_sum[$m] = number_format($application_fee_sum[$m]);
else $application_fee_sum[$m] = "";
?>
											<input name="application_fee_sum<?=$k?>" type="text" class="textfm" style="width:88px;ime-mode:disabled;" value="<?=$application_fee_sum[$m]?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" onblur="checkThousand(this.value, this,'Y');">
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재접수일자</td>
										<td nowrap  class="tdrow">
											<input name="reapplication_date<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$reapplication_date[$m]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.reapplication_date<?=$k?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr id="tr_application<?=$k?>c" style="<? if($count_app < $app_no) echo "display:none"; ?>">
										<td nowrap class="tdrowk" style="background-color:#ffffff;padding:4px"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료구분
											<?//=$count_app." < ".$app_no?>
											<select name="close_kind<?=$k?>" class="selectfm" onChange="view_close_kind(this,'<?=$app_no?>')">
												<option value="" <? if($close_kind[$m] == "") echo "selected"; ?>>기간</option>
												<option value="1" <? if($close_kind[$m] == 1) echo "selected"; ?>>분기</option>
											</select>
										</td>
										<td nowrap  class="tdrow" colspan="3">
											<div id="close_date_a_<?=$app_no?>" style="<? if($close_kind[$m] == 1) echo "display:none"; ?>">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료일자
												<input name="close_date<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$close_date[$m]?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.close_date<?=$k?>);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											</div>
											<div id="close_date_b_<?=$app_no?>" style="<? if($close_kind[$m] != 1) echo "display:none"; ?>">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">종료분기
												<select name="close_year<?=$k?>" class="selectfm" onChange="">
													<option value="">선택</option>
<?
for($i=2020;$i>2000;$i--) {
?>
													<option value="<?=$i?>" <? if($i == $close_year[$m]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select> 년
												<select name="close_quarter<?=$k?>" class="selectfm" onChange="">
													<option value="">선택</option>
<?
for($i=1;$i<=4;$i++) {
?>
													<option value="<?=$i?>" <? if($i == $close_quarter[$m]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select> 분기
											</div>
										</td>
										<td nowrap class="tdrowk" style="background-color:#ffffff"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신청주기
											<select name="application_cycle<?=$k?>" class="selectfm" onChange="view_close_kind(this)">
												<option value="">선택</option>
												<option value="1" <? if($application_cycle[$m] == 1) echo "selected"; ?>>매월</option>
												<option value="2" <? if($application_cycle[$m] == 2) echo "selected"; ?>>분기</option>
											</select>
										</td>
										<td nowrap class="tdrowk" width="80"></td>
										<td nowrap  class="tdrow">
										</td>
									</tr>
<?
}
//지원금 반복문 종료
?>
								</table>
								<input type="hidden" name="process_count" value="<?=$process_count?>">
								<input type="hidden" name="app_count_old" value="<?=$count_app?>">
								<input type="hidden" name="app_count" value="<?=$count_app?>">
								<input type="hidden" name="job_count_old" value="<?=$count_job?>">
								<input type="hidden" name="job_count" value="<?=$count_job?>">
								<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>">
								<input type="hidden" name="url" value="./com_process_view.php">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" name="page" value="<?=$page?>">
								<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
								<input type="hidden" name="qstr" value="<?=$qstr?>">
								<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>">
								<div style="height:20px;font-size:0px"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
if($member['mb_level'] >= 6) {
?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<? } ?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./client_process_list.php?page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">목 록</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
//수정 상태 시작
if($w == "u") {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$id?>" target="">거래처정보</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
	//지원금 신청 여부 시작
	if($row2['application_kind']) {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_application_view.php?w=<?=$w?>&id=<?=$id?>" target="">지원금현황</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
	//지원금 신청 여부 끝
	//직무교육 의뢰 여부 시작
	if($row['job_request_if']) {
		$sql_job = " select idx from job_education where com_code='$id' ";
		$result_job = sql_query($sql_job);
		$row_job=mysql_fetch_array($result_job);
		$job_idx = $row_job['idx'];
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./job_education_view.php?w=<?=$w?>&id=<?=$job_idx?>" target="">직무교육</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
}
//수정 상태 끝
?>
										</td>
									</tr>
								</table>
<?
//거래처 탭No
//$memo_type = 2;
include "inc/client_comment_only.php";
?>
								</form>
							</div>
							<div style="height:20px;font-size:0px"></div>
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
