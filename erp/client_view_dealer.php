<?
$sub_menu = "100100";
include_once("./_common.php");

$now_date = date("Y.m.d");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_contract=".$stx_contract."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_scount=".$stx_scount."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
//상세검색
$stx_qstr  = "stx_rules_report_if=".$stx_rules_report_if."&stx_retirement_age=".$stx_retirement_age."&stx_new_fund_scale_site=".$stx_new_fund_scale_site."&stx_establish_type=".$stx_establish_type."&stx_refund_request=".$stx_refund_request."&stx_factory_split=".$stx_factory_split."&stx_extend_age=".$stx_extend_age."&stx_easynomu_request=".$stx_easynomu_request;
$stx_qstr .= "&stx_fund_type_industry=".$stx_fund_type_industry."&stx_employment_support=".$stx_employment_support."&stx_establish_proposal_if=".$stx_establish_proposal_if."&stx_multitude=".$stx_multitude."&stx_charge_progress=".$stx_charge_progress."&stx_establish_way=".$stx_establish_way."&stx_sj_if=".$stx_sj_if."&stx_handicapped_employment=".$stx_handicapped_employment;
$stx_qstr .= "&stx_disaster_if=".$stx_disaster_if."&stx_found_if=".$stx_found_if."&stx_subsidy_type_if=".$stx_found_if."&stx_factory_site_1000=".$stx_factory_site_1000."&stx_women_matriarch_if=".$stx_women_matriarch_if."&stx_found_tax=".$stx_found_tax."&stx_disaster_if=".$stx_disaster_if."&stx_job_creation_proposal=".$stx_job_creation_proposal."&stx_rule_pay=".$stx_rule_pay;
$stx_qstr .= "&stx_rural_areas=".$stx_rural_areas."&stx_pay_peak_if=".$stx_pay_peak_if."&stx_career_kind=".$stx_career_kind."&stx_fund_basic_check=".$stx_fund_basic_check."&stx_shift_system=".$stx_shift_system."&stx_local_tax_yn=".$stx_local_tax_yn."&stx_work_contract=".$stx_work_contract."&stx_fund_kind=".$stx_fund_kind."&stx_establish_request=".$stx_establish_request;

//echo $member[mb_profile];
if($is_admin != "super") {
	//echo $member['mb_profile'];
	$stx_man_cust_name = $member['mb_profile'];
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
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "거래처정보(뷰)";
$g4[title] = $sub_title." : 거래처 : ".$easynomu_name;

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
	$top_sub_title = "images/top01_01.gif";
} else {
	$top_sub_title = "images/top01_00.gif";
}
//메모
$memo = $row['memo'];
//사무위탁수임
$samu_req_yn = $row['samu_req_yn'];
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
	if (frm.comp_bznb.value == "") {
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
	if (frm.firm_name.value == "") {
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
	if (frm.comp_bznb.value == "") {
		alert("사업자번호를 입력하세요.");
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
/*
	if (frm.user_id.value == "") {
		alert("아이디를 입력하세요.");
		frm.user_id.focus();
		return;
	}
	if (frm.upjong_code.value == "") {
		alert("업종을 입력하세요.");
		frm.upjong_code.focus();
		return;
	}
	if (frm.upjong.value == "") {
		alert("업종을 입력하세요.");
		frm.upjong.focus();
		return;
	}
*/
	if (frm.cust_name.value == "") {
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
	if (frm.cust_tel3.value == "") {
		alert("전화번호(뒤)를 입력하세요.");
		frm.cust_tel3.focus();
		return;
	}
/*
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
	if (frm.new_zip.value == "") {
		alert("주소를 입력하세요.");
		return;
	}
	if (frm.cust_email.value == "") {
		alert("이메일를 입력하세요.");
		frm.cust_email.focus();
		return;
	}
<?
if($stx_man_cust_name < 100) {
?>
/*
	if(frm.job_request_if.checked) {
		if(frm.job_hrd_id.value == "") {
			alert("HRD아이디를 입력하세요.");
			frm.job_hrd_id.focus();
			return;
		}
		if(!frm.job_file_check1.checked) {
			alert("체크리스트를 등록하세요.");
			frm.job_file_check1.focus();
			return;
		}
	}
*/
<?
}
?>
	//한전 고객번호 중복 체크 160406
	if(frm.rst_chk_electric_no.value == "y") {
		alert("이미 등록된 고객번호입니다. 확인 후 등록 바랍니다.");
		frm.electric_charges_no.focus();
		return;
	}
	getId('btn_save').style.display = "none";
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
	if(count == 0){
		alert(t+" 선택해 주세요.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
//삭제 거래처 (관리자)
function del_com(page, id) {
	if(confirm("삭제 하시겠습니까?")) {
		location.href = "client_delete_com.php?page="+page+"&id="+id;
	}
}
//삭제요청
function del_request(page, id) {
	if(confirm("삭제요청 하시겠습니까?")) {
		location.href = "client_delete_request.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
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
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
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
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-') {		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
//숫자/영문만
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.preventDefault ? event.preventDefault() : event.returnValue = false;
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
				return total;
			}
		}
		return total;
	}
}
function delcomma(inputVal, count) {
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
			if(inputVal.length == 6) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
				else if ( type =='2' ) {
					main.cust_ssnb.value=total;					// type 에 따라 최종값을 넣어 준다.
				}
			}else if(keydown =='N') {
				return total;
			}
		}
		return total;
	}
}
//주민등록번호 입력 하이픈
function checkhyphen_ssnb(inputVal, type) {
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
		if(inputVal.length == 6) {
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		type.value = total;
	}
	return total;
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
			return total;
		}
		return total;
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
//출력
function pagePrint(Obj, orientation_var) {  
  var W = Obj.offsetWidth + 40;        //screen.availWidth;  
  var H = Obj.offsetHeight + 50;       //screen.availHeight; 
 
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
	// 인쇄미리보기
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
}
function Installed() {
	try { 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} catch (e) { 
		return false; 
	} 
} 
function PrintTest() {
	if(!Installed()) alert("컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.") 
	else alert("정상적으로 설치되었습니다."); 
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
//전기요금컨설팅 한전 고객번호 중복 확인 160406
function getCont_electric_no( id, code ) {
	var frm = document.dataForm;
	var xmlhttp = fncGetXMLHttpRequest();
	xmlhttp.open('POST', 'ajax_check_electric_no_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("페이지 오류 : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst_electric_no');
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "이미 등록된 고객번호입니다.(본사문의요망)";
					frm.rst_chk_electric_no.value = "y";
				} else {
					dp.innerHTML = "";
					frm.rst_chk_electric_no.value = "";
				}
			}
		}
	}
	xmlhttp.send();
}
</script>
<style type="text/css"> 
@media print{ 
	#noPrint1{display: none;} 
} 
</style>
<?
include include "inc/top_dealer.php";
$url_list = "./client_list_dealer.php?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width="130"><img src="<?=$top_sub_title?>" border="0" /></td>
						<td>
<?
$title_main_no = "01";
//include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>

				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->
			<!--인쇄영역-->
			<div id="print_div">
<?
$samu_list = "";
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
//권한별 링크값
//echo $member['mb_level'];
//지사 딜러 레벨 이상 권한
if($member['mb_level'] >= 4) {
	$url_save = "javascript:checkData('client_update_dealer.php');";
	$url_modify = $_SERVER['PHP_SELF']."?w=u&v=write&id=".$com_code."&page=".$page."&".$qstr."&".$stx_qstr;
	$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
	$url_print_request = "javascript:pagePrint(document.getElementById('print_div'), '0')";
} else {
	$url_save = "javascript:alert_no_right();";
}
//수정일 경우 표시
if($w) {
	//현재 탭 메뉴 번호
	$tab_onoff_this = 1;
	//프로그램 종류
	if($row['easynomu_yn'] == 1) {
		$tab_program_url = 1;
	} else if($row['easynomu_yn'] == 2) {
		$tab_program_url = 2;
	} else {
		$tab_program_url = 1;
		if($row['construction_yn'] == 1) $tab_program_url = 3;
	}
	//딜러 제외 모두 표시 160112
	if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
		include "inc/tab_menu.php";
		//본사처리현황
		include "inc/client_basic_admin.php";
	}
}
?>


				<div id="tab1">
					<a name="20001"><!--전기요금컨설팅--></a>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											<span>전기요금컨설팅</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">필수항목</b> 고객번호, 사업주주민번호(개인), 법인등록번호(법인)는 필수체크사항입니다.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="<? if($w && !$row['electric_charges_no']) echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고객번호<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="210">
<?
	if($report != "ok") {
?>
								<input name="electric_charges_no" type="text" class="textfm" style="width:94px;" value="<?=$row['electric_charges_no']?>" maxlength="10" onblur="getCont_electric_no(this.value, '<?=$id?>');" />
								예) 0912341234
								<div id='rst_electric_no' style="color:red;"></div>
								<input type="hidden" name="rst_chk_electric_no" value="" />
<?
	} else {
		if($row['electric_charges_no']) echo $row['electric_charges_no'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업주주민번호
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($report != "ok") {
?>
								<input name="electric_charges_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_ssnb']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
<?
	} else {
		if($row['electric_charges_ssnb']) echo $row['electric_charges_ssnb'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">법인등록번호<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($report != "ok") {
?>
								<input name="electric_charges_bupin" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row['electric_charges_bupin']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
<?
	} else {
		if($row['electric_charges_bupin']) echo $row['electric_charges_bupin'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
	if($report != "ok") {
?>
								<textarea name="electric_charges_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['electric_charges_memo']?></textarea>
<?
	} else {
		if($row['electric_charges_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo']."</pre>";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
$check_ok_id = $row['electric_charges_process'];
if($row['electric_charges_process']) echo $electric_charges_process_arry[$check_ok_id];
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리결과<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
if($row['electric_charges_etc']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_etc']."</pre>";
?>
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px"></div>
<?
//강제 뷰페이지 전환
if($w == "u" && $v != "write") $is_damdang = "";
if($w != "u" && $member['mb_level'] == 9) $is_damdang = "ok";
?>
									<!--첨부서류-->
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='filename_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif" /></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															첨부서류
														</td> 
														<td><img src="images/sb_tab_on_rt.gif" /></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="filename_div">
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
								<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
								<input type="hidden" name="file_1" value="<?=$row['filename_1']?>">
							</td>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
								<input type="hidden" name="file_2" value="<?=$row['filename_2']?>">
							</td>
						</tr>
						<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
								<input type="hidden" name="file_3" value="<?=$row['filename_3']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
								<input type="hidden" name="file_4" value="<?=$row['filename_4']?>">
							</td>
						</tr>
						<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
								<input type="hidden" name="file_5" value="<?=$row['filename_5']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
								<input type="hidden" name="file_6" value="<?=$row['filename_6']?>">
							</td>
						</tr>
						<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
								<input type="hidden" name="file_7" value="<?=$row['filename_7']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
								<input type="hidden" name="file_8" value="<?=$row['filename_8']?>">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기타 서류<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
if($is_damdang == "ok") {
?>
								<input name="file_etc" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['file_etc']?>" maxlength="100">
<?
} else {
	echo $row['file_etc'];
}
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

				</div><!--인쇄영역 종료-->
					<input type="hidden" name="prv_dojang_img" value="<?=$row['dojang_img']?>">
					<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>">
					<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>">
					<input type="hidden" name="url" value="./com_view.php">
					<input type="hidden" name="id" value="<?=$id?>">
					<input type="hidden" name="page" value="<?=$page?>">
					<input type="hidden" name="is_damdang" value="<?=$is_damdang?>">
					<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
					<input type="hidden" name="qstr" value="<?=$qstr?>">
					<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>">
				</div>
				<div id="tab2" style="display:none">
				</div>
				<div style="height:20px;font-size:0px"></div>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
					<tr>
						<td align="center">
<?
if($v == "write") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;" id="btn_save"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">저 장</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
} else {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_modify?>" target="">수 정</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_list_dealer.php?search_ok=branch&page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w) {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./electric_charges_view.php?w=<?=$w?>&id=<?=$id?>" target="">전기요금컨설팅</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<?
}
?>
						</td>
					</tr>
				</table>
<?
//신규 등록시 숨김
if($w == "u") {
	//거래처 탭No
	//$memo_type = 2;
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
