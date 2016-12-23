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
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
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
			//hyphen 109 , 하이픈(F9 하단) 189 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 189 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
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
include "inc/top.php";
$url_list = "./client_list.php?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width="130"><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" /></a></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
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
if($member['mb_level'] >= 5) {
	if($member['mb_level'] <= 6) $url_save = "javascript:checkData('client_update_branch.php');";
	else $url_save = "javascript:checkData('client_update.php');";
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
	include "inc/tab_menu.php";
	//본사처리현황
	include "inc/client_basic_admin.php";
}
?>
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
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_list.php?search_ok=branch&page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_print_request?>" target="">의뢰서출력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
	//삭제 권한 : 최고관리자, 임영진
	if($member['mb_level'] == 10 || $member['mb_id'] == "kcmc0331") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_com('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>삭제</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } else { ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_request('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>삭제요청</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">접수처리현황</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
<?
	//직무교육 의뢰 여부 시작
	if($row['job_request_if']) {
		$sql_job = " select idx from job_education where com_code='$id' ";
		$result_job = sql_query($sql_job);
		$row_job=mysql_fetch_array($result_job);
		$idx = $row_job['idx'];
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./job_education_view.php?w=<?=$w?>&id=<?=$idx?>" target="">사업주훈련</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
?>
						</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px"></div>
<?
//신규등록 시 표시
if(!$w) {
?>
								<!--탭메뉴-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr> 
										<td id="Tab_cust_tab_05"> 
											<a href="#17001"><img src="./images/tab05_on.gif" border="0" id="tab_img5" /></a>
										</td> 
										<td width="2"></td> 
										<td id="Tab_cust_tab_06"> 
											<a href="#19001"><img src="./images/tab06_on.gif" border="0" id="tab_img6" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_07"> 
											<a href="#20001"><img src="./images/tab07_on.gif" border="0" id="tab_img7" alt="전기요금컨설팅" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_03"> 
											<a href="#11001"><img src="./images/tab01_on.gif" border="0" id="tab_img1" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_04"> 
											<a href="#16001"><img src="./images/tab03_on.gif" border="0" id="tab_img3" /></a>
										</td>
										<td width="10"></td> 
										<td>
										</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<div style="margin-bottom:10px;width:100%;text-align:left;<? if(!$w) echo "display:none;"; ?>">
									◎ 사업장명 : <?=$row['com_name']?> &nbsp; ◎ 사업자등록번호 : <?=$row['biz_no']?> &nbsp; ◎ 대표자 : <?=$row['boss_name']?>
									&nbsp; ◎ 전화번호 : <?=$row['com_tel']?>
								</div>
<?
}
?>
								<div id="tab1">
<?
//강제 뷰페이지 전환
if($w == "u" && $v != "write") $is_damdang = "";
//본사, 관리자 수정 권한 161109
if($v == "write" && ($member['mb_profile'] == 1 || $member['mb_id'] == "master")) $is_damdang = "ok";
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
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="filename_div" style="<? if($w && ($row['file_check']==',,,,,,,,,,' || !$row['file_check']) && ($row['file_easynomu']==',,,,' || !$row['file_easynomu']) && !$row['filename_1'] && !$row['filename_2'] && !$row['filename_3'] && !$row['filename_4'] && !$row['filename_5'] && !$row['filename_6'] && !$row['filename_7'] && !$row['filename_8'] && !$row['file_easynomu_1'] && !$row['file_easynomu_2'] && !$row['file_etc']) echo "display:none"; ?>">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>기본서류</b><font color="red"></font></td>
											<td class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
if($is_damdang == "ok") {
?>
												<input type="checkbox" name="file_check1" value="1" <? if($file_check[0] == 1) echo "checked"; ?> style="vertical-align:middle">컨설팅의뢰서
												<input type="checkbox" name="file_check2" value="1" <? if($file_check[1] == 1) echo "checked"; ?> style="vertical-align:middle">계약서
												<input type="checkbox" name="file_check3" value="1" <? if($file_check[2] == 1) echo "checked"; ?> style="vertical-align:middle">사무위탁서
												<input type="checkbox" name="file_check4" value="1" <? if($file_check[3] == 1) echo "checked"; ?> style="vertical-align:middle">대리인선임
												<input type="checkbox" name="file_check5" value="1" <? if($file_check[4] == 1) echo "checked"; ?> style="vertical-align:middle">전자민원
												<input type="checkbox" name="file_check6" value="1" <? if($file_check[5] == 1) echo "checked"; ?> style="vertical-align:middle">사업자등록증
												<input type="checkbox" name="file_check7" value="1" <? if($file_check[6] == 1) echo "checked"; ?> style="vertical-align:middle">통장사본
												<input type="checkbox" name="file_check8" value="1" <? if($file_check[7] == 1) echo "checked"; ?> style="vertical-align:middle">취득/상실리스트
												<input type="checkbox" name="file_check9" value="1" <? if($file_check[8] == 1) echo "checked"; ?> style="vertical-align:middle">시간선택제
												<input type="checkbox" name="file_check10" value="1" <? if($file_check[9] == 1) echo "checked"; ?> style="vertical-align:middle">정책자금의뢰서
												<input type="checkbox" name="file_check11" value="1" <? if($file_check[10] == 1) echo "checked"; ?> style="vertical-align:middle">육아휴직장려금
												<input type="checkbox" name="file_check12" value="1" <? if($file_check[11] == 1) echo "checked"; ?> style="vertical-align:middle">대체인력지원금
<?
} else {
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
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_1" value="1" style="vertical-align:middle">삭제<? } ?>
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
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>이지노무 서류</b><font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
if($is_damdang == "ok") {
?>
								<input type="checkbox" name="file_easynomu1" value="1" <? if($file_easynomu[0] == 1) echo "checked"; ?> style="vertical-align:middle">이지노무 계약서
								<input type="checkbox" name="file_easynomu2" value="1" <? if($file_easynomu[1] == 1) echo "checked"; ?> style="vertical-align:middle">근로계약서
								<input type="checkbox" name="file_easynomu3" value="1" <? if($file_easynomu[2] == 1) echo "checked"; ?> style="vertical-align:middle">취업규칙 체크리스트
								<input type="checkbox" name="file_easynomu4" value="1" <? if($file_easynomu[3] == 1) echo "checked"; ?> style="vertical-align:middle">최근3개월 급여대장
<?
} else {
	if($file_easynomu[0]) echo "이지노무 계약서. ";
	if($file_easynomu[1]) echo "근로계약서. ";
	if($file_easynomu[2]) echo "취업규칙 체크리스트. ";
	if($file_easynomu[3]) echo "최근3개월 급여대장. ";
}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_easynomu_del_1" value="1" style="vertical-align:middle">삭제<? } ?>
							</td>
							<td   class="tdrow" width="373">
								<? if($is_damdang == "ok") { ?><input name="file_easynomu_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
								<a href="files/easynomu/<?=$row['file_easynomu_1']?>" target="_blank"><?=$row['file_easynomu_1']?></a>
								<input type="hidden" name="feasynomu_1" value="<?=$row['file_easynomu1']?>">
							</td>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">파일2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_easynomu_del_2" value="1" style="vertical-align:middle">삭제<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="file_easynomu_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
								<a href="files/easynomu/<?=$row['file_easynomu_2']?>" target="_blank"><?=$row['file_easynomu_2']?></a>
								<input type="hidden" name="feasynomu_2" value="<?=$row['file_easynomu_2']?>">
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
<?
//컨설팅 의뢰서 : 본사/지사 로그인 시 보임 / 협력사 로그인 시 숨김
if($stx_man_cust_name < 100) {
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="20001"><!--전기요금컨설팅--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
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
							<td nowrap  class="tdrow" width="250">
<?
	if($is_damdang == "ok") {
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
	if($is_damdang == "ok") {
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
	if($is_damdang == "ok") {
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
	if($is_damdang == "ok") {
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
					<a name="20002"><!--직무발명보상제도--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_invent_recompense_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>직무발명보상제도</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">필수항목</b> 출원인번호는 필수체크사항입니다.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_invent_recompense_div" style="<? if($w && !$row['job_invent_recompense_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">출원인번호</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input name="job_invent_no" type="text" class="textfm" style="width:104px;" value="<?=$row2['job_invent_no']?>" maxlength="12" onblur="getCont_electric_no(this.value, '<?=$id?>');" />
								예) 123456789012
<?
	} else {
		if($row2['job_invent_no']) echo $row2['job_invent_no'];
	}
?>
							</td>
						</tr>
					</table>
<?
$title_20003 = "전력수요관리";
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="20003"><!--<?=$title_20003?>--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='kepco_dsm_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span><?=$title_20003?></span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td>
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">의뢰여부</b> 의뢰 항목에 체크해야 본사로 전송됩니다.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="kepco_dsm_div" style="<? if($w && !$row['kepco_dsm_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">의뢰여부</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="kepco_dsm_chk" value="1" <? if($row2['kepco_dsm_chk'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">의뢰</span>
<?
	} else {
		if($row2['kepco_dsm_chk']) echo "<b>의뢰</b>";
	}
	//의뢰 시 해당 페이지 링크
	if($row2['kepco_dsm_chk']) echo " <a href='kepco_dsm_list.php'>[".$title_20003."]</a>";
?>
							</td>
						</tr>
					</table>
<?
$title_1901000 = "4대보험절감";
//지사 오픈 불가 김국진 과장 의견 161019 / 군산지사 정미영 팀장 연락옴 지사 임시 차단 161101
//if($member['mb_level'] > 6) {
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="1901000"><!--<?=$title_1901000?>--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_nhis_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span><?=$title_1901000?></span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td>
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">의뢰여부</b> 의뢰 항목에 체크해야 본사로 전송됩니다.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="si4n_nhis_div" style="<? if($w && !$row['si4n_nhis_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">의뢰여부</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="si4n_nhis_chk" value="1" <? if($row2['si4n_nhis_chk'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">의뢰</span>
<?
	} else {
		if($row2['si4n_nhis_chk']) echo "<b>의뢰</b>";
	}
	//의뢰 시 해당 페이지 링크
	if($row2['si4n_nhis_chk']) echo " <a href='si4n_nhis_view.php?w=u&id=".$id."'>[".$title_1901000."]</a>";
?>
							</td>
						</tr>
					</table>
<?
//} //임시 제거 161101
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="17001"><!--직무교육--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_request_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>사업주훈련</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">의뢰여부</b> 의뢰 항목에 체크해야 본사로 전송됩니다.
								<b style="color:red;">체크리스트</b>는 필수서류입니다. 반드시 첨부하여 주십시오.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_request_div" style="<? if($w && $row['job_request_if'] != "1") echo "display:none"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">의뢰여부</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_request_if" value="1" <? if($row['job_request_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">의뢰</span>
<?
	} else {
		if($row['job_request_if']) echo "<b>의뢰</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">HRD아이디<font color="red">*</font>
							</td>
							<td nowrap  class="tdrow" width="376">
<?
	if($is_damdang == "ok") {
?>
								<b>아이디</b>
								<input name="job_hrd_id" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_id']?>" maxlength="14">
								<b>비밀번호</b>
								<input name="job_hrd_pw" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_pw']?>" maxlength="14">
<?
	} else {
		if($row['job_hrd_id']) echo "<b>아이디</b> : ".$row['job_hrd_id']." ";
		if($row['job_hrd_pw']) echo "<b>비밀번호</b> : ".$row['job_hrd_pw'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><span style="color:#343434;">위험성평가</span>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="danger_evaluate_if" value="1" <? if($row['danger_evaluate_if'] == "1") echo "checked"; ?> style="vertical-align:middle">의뢰
<?
	} else {
		if($row['danger_evaluate_if']) echo "<b>의뢰</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">KRAS아이디<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<b>아이디</b>
								<input name="job_kras_id" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_id']?>" maxlength="14">
								<b>비밀번호</b>
								<input name="job_kras_pw" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_pw']?>" maxlength="14">
<?
	} else {
		if($row['job_kras_id']) echo "<b>아이디</b> : ".$row['job_kras_id']." ";
		if($row['job_kras_pw']) echo "<b>비밀번호</b> : ".$row['job_kras_pw'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부서류목록
							</td>
							<td nowrap  class="tdrow" width="" colspan="5">
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
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="" rowspan="4">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">첨부파일
							</td>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일1</b> <input type="checkbox" name="job_file_del_1" value="1" style="vertical-align:middle">삭제
									<input name="job_file_1" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_1']?>" target="_blank"><?=$row['job_file_1']?></a>
									<input type="hidden" name="p_file_1" value="<?=$row['job_file_1']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일2</b> <input type="checkbox" name="job_file_del_2" value="1" style="vertical-align:middle">삭제
									<input name="job_file_2" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_2']?>" target="_blank"><?=$row['job_file_2']?></a>
									<input type="hidden" name="p_file_2" value="<?=$row['job_file_2']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일3</b> <input type="checkbox" name="job_file_del_3" value="1" style="vertical-align:middle">삭제
									<input name="job_file_3" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_3']?>" target="_blank"><?=$row['job_file_3']?></a>
									<input type="hidden" name="p_file_3" value="<?=$row['job_file_3']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일4</b> <input type="checkbox" name="job_file_del_4" value="1" style="vertical-align:middle">삭제
									<input name="job_file_4" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_4']?>" target="_blank"><?=$row['job_file_4']?></a>
									<input type="hidden" name="p_file_4" value="<?=$row['job_file_4']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일5</b> <input type="checkbox" name="job_file_del_5" value="1" style="vertical-align:middle">삭제
									<input name="job_file_5" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_5']?>" target="_blank"><?=$row['job_file_5']?></a>
									<input type="hidden" name="p_file_5" value="<?=$row['job_file_5']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일6</b> <input type="checkbox" name="job_file_del_6" value="1" style="vertical-align:middle">삭제
									<input name="job_file_6" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_6']?>" target="_blank"><?=$row['job_file_6']?></a>
									<input type="hidden" name="p_file_6" value="<?=$row['job_file_6']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일7</b> <input type="checkbox" name="job_file_del_7" value="1" style="vertical-align:middle">삭제
									<input name="job_file_7" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_7']?>" target="_blank"><?=$row['job_file_7']?></a>
									<input type="hidden" name="p_file_7" value="<?=$row['job_file_7']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>파일8</b> <input type="checkbox" name="job_file_del_8" value="1" style="vertical-align:middle">삭제
									<input name="job_file_8" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_8']?>" target="_blank"><?=$row['job_file_8']?></a>
									<input type="hidden" name="p_file_8" value="<?=$row['job_file_8']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">필수교육이수여부</td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_sexual_if" value="1" <? if($row['job_sexual_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>성희롱예방교육</b>
								<input type="checkbox" name="job_safety_if" value="1" <? if($row['job_safety_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>산업안전교육</b>
								<input type="checkbox" name="job_privacy_if" value="1" <? if($row['job_privacy_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>개인정보보호법</b>
								<input name="job_essential" type="text" class="textfm" style="width:200px;vertical-align:middle" value="<?=$row['job_essential']?>" maxlength="50"><b>(필수직무교육)</b>
<?
	} else {
		if($row['job_sexual_if']) echo "<b>성희롱예방교육</b> : ".$row['job_sexual_if']."<br>";
		if($row['job_safety_if']) echo "<b>산업안전교육</b> : ".$row['job_safety_if']."<br>";
		if($row['job_privacy_if']) echo "<b>개인정보보호법</b> : ".$row['job_privacy_if']." ";
		if($row['job_essential']) echo "<b>필수직무교육</b> : ".$row['job_essential'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">교육훈련참여이력<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<input name="job_participate" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['job_participate']?>" maxlength="100">
<?
	} else {
		if($row['job_participate']) echo $row['job_participate'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="job_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['job_memo']?></textarea>
<?
	} else {
		if($row['job_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['job_memo']."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px"></div>
					<a name="19001"><!--시간선택제--></a>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_time_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>시간선택제</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								※ <b style="color:red;">의뢰여부</b> 의뢰 항목에 체크해야 본사로 전송됩니다.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_time_div" style="<? if($w && $row['job_time_if'] != "1") echo "display:none"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">의뢰여부</b>
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_time_if" value="1" <? if($row['job_time_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">의뢰</span>
<?
	} else {
		if($row['job_time_if']) echo "<b>의뢰</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">보험가입인원<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($is_damdang == "ok") {
?>
								<input name="insurance_persons" type="text" class="textfm" style="width:110px;" value="<?=$row['insurance_persons']?>" maxlength="20" />
<?
	} else {
		if($row['insurance_persons']) echo $row['insurance_persons']." ";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">방문일자<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input name="visitdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
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
<?
	} else {
		if($row['visitdt']) echo $row['visitdt']." ";
		if($row['visitdt_time']) echo $row['visitdt_time'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모<font color="red"></font></td>
							<td class="tdrow" colspan="5">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="job_time_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['job_time_memo']?></textarea>
<?
	} else {
		if($row['job_time_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['job_time_memo']."</pre>";
	}
?>
							</td>
						</tr>
					</table>

					<div style="height:10px;font-size:0px"></div>
					<!--댑메뉴 -->
					<a name="11001"><!--컨설팅의뢰서--></a>
					<div style="text-align:left;"><span style="cursor:pointer;" onclick="var div_display='consult_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}"><img src="./images/tab01_on.gif" border="0" id="tab_img1" /></span></div>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<div id="consult_div" style="<? //if($w) echo "display:none;" ?>">
					<div style="height:5px;font-size:0px"></div>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='employment_support_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											고용안정
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
					<div id="employment_support_div" style="<? if(!$row['aid_kind'] && !$row['family_work_if'] && !$row['insurance_holder'] && !$row['refund_request'] && !$row['family_refund_wrong'] && !$row['sj_if'] && !$row['join_request'] && !$row['handicapped1'] && !$row['handicapped2'] && !$row['contributor'] && !$row['rules_report_if'] && !$row['rules_report_date'] && !$row['retirement_age'] && !$row['extend_age'] && !$row['multitude'] && !$row['pay_peak_if'] && !$row['hire_support'] && !$row['refugee'] && !$row['support_etc'] && !$row['employment_support']  && !$row['employment_program'] && !$row['women_matriarch_if'] && !$row['handicapped_employment'] && !$row['rural_areas'] && !$row['employable'] && !$row['disaster_if'] && !$row['disaster_memo'] && !$memo1) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지원금지원내역<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	//컨설팅 의뢰서 변수
	$aid_kind = $row['aid_kind']; //지원금종류
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
	//사업주의 산재 보험가입유무
	if($row['sj_if'] == "1") $sj_if = "YES";
	else if($row['sj_if'] == "2") $sj_if = "NO";
	else $sj_if = "";
	//가입신청의뢰
	if($row['join_request'] == "1") $join_request = "YES";
	else if($row['join_request'] == "2") $join_request = "NO";
	else $join_request = "";
	$handicapped1 = $row['handicapped1']; //중증(1~3급)
	$handicapped2 = $row['handicapped2']; //경증(4~6급)
	$contributor = $row['contributor']; //국가유공자
	if($is_damdang == "ok") {
?>
								<b>종류</b>
								<input name="aid_kind" type="text" class="textfm" style="width:840px;ime-mode:active;" value="<?=$row['aid_kind']?>" maxlength="100">
<?
	} else {
		if($aid_kind) echo "<b>종류</b> : ".$row['aid_kind'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">가족보험관계</td>
							<td nowrap  class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<b>직계가족 근무여부</b>
								<input type="radio" name="family_work_if" value="1" <? if($row['family_work_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="family_work_if" value="2" <? if($row['family_work_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>보험가입자</b>
								<input name="insurance_holder" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['insurance_holder']?>" maxlength="50">
								<br>
								<b>환급신청의뢰</b>
								<input type="radio" name="refund_request" value="1" <? if($row['refund_request'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="refund_request" value="2" <? if($row['refund_request'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>불가사유</b>
								<input name="family_refund_wrong" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['family_refund_wrong']?>" maxlength="50">
								<br>
								<b>사업주의 산재 보험가입유무</b>
								<input type="radio" name="sj_if" value="1" <? if($row['sj_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="sj_if" value="2" <? if($row['sj_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>가입신청의뢰</b>
								<input type="radio" name="join_request" value="1" <? if($row['join_request'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="join_request" value="2" <? if($row['join_request'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($family_work_if) echo "<b>직계가족 근무여부</b> : ".$family_work_if."<br>";
		if($insurance_holder) echo "<b>보험가입자</b> : ".$insurance_holder."<br>";
		if($refund_request) echo "<b>환급신청의뢰</b> : ".$refund_request." ";
		if($family_refund_wrong) echo "<b>불가사유</b> : ".$family_refund_wrong."<br>";
		if($sj_if) echo "<b>사업주의 산재 보험가입유무</b> : ".$sj_if." ";
		if($join_request) echo "<b>가입신청의뢰</b> : ".$join_request;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">장애인/국가유공자
							</td>
							<td nowrap  class="tdrow" width="280">
<?
	if($is_damdang == "ok") {
?>
								중증(1~3급)
								<input name="handicapped1" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['handicapped1']?>" maxlength="50">
								<br>
								경증(4~6급)
								<input name="handicapped2" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['handicapped2']?>" maxlength="50">
								<br>
								국가유공자<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0">
								<input name="contributor" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['contributor']?>" maxlength="50">
<?
	} else {
		if($handicapped1) echo "중증(1~3급) : ".$row['handicapped1'];
		if($handicapped2) echo "<br>경증(4~6급) : ".$row['handicapped2'];
		if($contributor) echo "<br>국가유공자 : ".$row['contributor'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고령자</td>
							<td nowrap class="tdrow" colspan="">
<?
	//취업규칙서 신고여부
	if($row['rules_report_if'] == "1") $rules_report_if = "YES";
	else if($row['rules_report_if'] == "2") $rules_report_if = "NO";
	else $rules_report_if = "";
	//신고일
	$rules_report_date_array = explode(".",$row['rules_report_date']);
	$rules_report_year = $rules_report_date_array[0];
	$rules_report_month = $rules_report_date_array[1];
	$rules_report_day = $rules_report_date_array[2];
	//정년나이 연장나이 다수인원
	$retirement_age = $row['retirement_age'];
	$extend_age = $row['extend_age'];
	$multitude = $row['multitude'];
	//임금피크제 도입여부
	if($row['pay_peak_if'] == "1") $pay_peak_if = "YES";
	else if($row['pay_peak_if'] == "2") $pay_peak_if = "NO";
	else $pay_peak_if = "";
	if($is_damdang == "ok") {
?>
								<b>취업규칙서 신고여부</b>
								<input type="radio" name="rules_report_if" value="1" <? if($row['rules_report_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rules_report_if" value="2" <? if($row['rules_report_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>신고일</b>
								<input name="rules_report_year" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_year?>" maxlength="4">년 <input name="rules_report_month" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_month?>" maxlength="2">월 <input name="rules_report_day" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_day?>" maxlength="2">일
								<br>
								<b>정년나이/기준</b>
								<input name="retirement_age" type="text" class="textfm" style="ime-mode:active;width:100px;" value="<?=$row['retirement_age']?>" maxlength="20"> 
								<b>연장나이</b>
								<input name="extend_age" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$row['extend_age']?>" maxlength="2"> 세
								<b>다수인원</b>
								<input name="multitude" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$row['multitude']?>" maxlength="2"> 명
								<br>
								<b>임금피크제 도입여부</b>
								<input type="radio" name="pay_peak_if" value="1" <? if($row['pay_peak_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="pay_peak_if" value="2" <? if($row['pay_peak_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($rules_report_if) echo "<b>취업규칙서 신고여부</b> : ".$rules_report_if." ";
		if($row['rules_report_date']) echo " <b>신고일</b> : ".$row['rules_report_date'];
		if($retirement_age) echo "<br><b>정년나이</b> : ".$row['retirement_age']." ";
		if($extend_age) echo "<b>연장나이</b> : ".$row['extend_age']." ";
		if($multitude) echo "<b>다수인원</b> : ".$row['multitude'];
		if($pay_peak_if) echo "<br><b>임금피크제 도입여부</b> : ".$pay_peak_if;
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">기타지원</td>
							<td nowrap  class="tdrow">
<?
	$hire_support = $row['hire_support']; //고용유지
	$refugee = $row['refugee']; //새터민
	$support_etc = $row['support_etc']; //기타
	if($is_damdang == "ok") {
?>
								고용유지
								<input name="hire_support" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['hire_support']?>" maxlength="50">
								<br>
								새터민<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 10px 3px 0">
								<input name="refugee" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['refugee']?>" maxlength="50">
								<br>
								기타<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 22px 3px 0">
								<input name="support_etc" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['support_etc']?>" maxlength="50">
<?
	} else {
		if($hire_support) echo "고용유지 : ".$row['hire_support'];
		if($refugee) echo "새터민 : ".$row['refugee'];
		if($support_etc) echo "기타 : ".$row['support_etc'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용촉진(11년이후)
							</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//취업지원프로그램이수자 채용여부
	if($row['employment_support'] == "1") $employment_support = "YES";
	else if($row['employment_support'] == "2") $employment_support = "NO";
	else $employment_support = "";
	$employment_program = $row['employment_program']; //프로그램명
	//여성가장 채용
	if($row['women_matriarch_if'] == "1") $women_matriarch_if = "YES";
	else if($row['women_matriarch_if'] == "2") $women_matriarch_if = "NO";
	else $women_matriarch_if = "";
	//여성가장 유형
	$women_matriarch_kind = explode(',',$row['women_matriarch_kind']);
	$women_matriarch_kind_text = array("한부모가정","기초생활","차상위계층");
	//중증장애인 채용
	if($row['handicapped_employment'] == "1") $handicapped_employment = "YES";
	else if($row['handicapped_employment'] == "2") $handicapped_employment = "NO";
	else $handicapped_employment = "";
	//도서지역 거주자
	if($row['rural_areas'] == "1") $rural_areas = "YES";
	else if($row['rural_areas'] == "2") $rural_areas = "NO";
	else $rural_areas = "";
	$employable = $row['employable']; //대상자
	if($is_damdang == "ok") {
?>
								<b>취업지원프로그램이수자 채용여부</b>
								<input type="radio" name="employment_support" value="1" <? if($row['employment_support'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="employment_support" value="2" <? if($row['employment_support'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>프로그램명</b>
								<input name="employment_program" type="text" class="textfm" style="width:380px;ime-mode:active;" value="<?=$row['employment_program']?>" maxlength="100">
								<br>
								<b>여성가장 채용</b>
								<input type="radio" name="women_matriarch_if" value="1" <? if($row['women_matriarch_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="women_matriarch_if" value="2" <? if($row['women_matriarch_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								(<input type="checkbox" name="women_matriarch_kind1" value="1" <? if($women_matriarch_kind[0] == 1) echo "checked"; ?> style="vertical-align:middle">한부모가정
								<input type="checkbox" name="women_matriarch_kind2" value="1" <? if($women_matriarch_kind[1] == 1) echo "checked"; ?> style="vertical-align:middle">기초생활
								<input type="checkbox" name="women_matriarch_kind3" value="1" <? if($women_matriarch_kind[2] == 1) echo "checked"; ?> style="vertical-align:middle">차상위계층)
								<br>
								<b>중증장애인 채용</b>
								<input type="radio" name="handicapped_employment" value="1" <? if($row['handicapped_employment'] == "1") echo "handicapped_employment"; ?> style="vertical-align:middle">YES
								<input type="radio" name="handicapped_employment" value="2" <? if($row['handicapped_employment'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>도서지역 거주자</b>
								<input type="radio" name="rural_areas" value="1" <? if($row['rural_areas'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rural_areas" value="2" <? if($row['rural_areas'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>대상자</b>
								<input name="employable" type="text" class="textfm" style="width:400px;ime-mode:active;" value="<?=$row['employable']?>" maxlength="100">
<?
	} else {
		if($employment_support) echo "<b>취업지원프로그램이수자 채용여부</b> : ".$employment_support."<br>";
		if($employment_program) echo "<b>프로그램명</b> : ".$employment_program."<br>";
		if($women_matriarch_if) echo "<b>여성가장 채용</b> : ".$women_matriarch_if."<br>";
		if($handicapped_employment) echo "<b>중증장애인 채용</b> : ".$handicapped_employment."<br>";
		if($rural_areas) echo "<b>도서지역 거주자</b> : ".$rural_areas."<br>";
		if($employable) echo "<b>대상자</b> : ".$employable."";
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">산업재해</td>
							<td nowrap  class="tdrow">
<?
	//산재여부
	if($row['disaster_if'] == "1") $disaster_if = "YES";
	else if($row['disaster_if'] == "2") $disaster_if = "NO";
	else $disaster_if = "";
	$disaster_memo = $row['disaster_memo']; //내용
	if($is_damdang == "ok") {
?>
								<b>산재여부</b>
<?
	if($row['disaster_if'] == "1") $chk_disaster_if1 = "checked";
	else if($row['disaster_if'] == "2") $chk_disaster_if2 = "checked";
?>
								<input type="radio" name="disaster_if" value="1" <?=$chk_disaster_if1?> style="vertical-align:middle">YES
								<input type="radio" name="disaster_if" value="2" <?=$chk_disaster_if2?> style="vertical-align:middle">NO
								<br>내용<br>
								<textarea name="disaster_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['disaster_memo']?></textarea>
<?
	} else {
		if($disaster_if) echo "<b>산재여부</b> : ".$disaster_if."<br>";
		if($disaster_memo) echo "내용 : ".$row['disaster_memo'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo1" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo1?></textarea>
<?
	} else {
		if($memo1) echo "<pre>".$memo1."</pre>";
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
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_creation_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
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
					<!--댑메뉴 -->
					<div id="job_creation_div" style="<? if(!$row['career_5year'] && !$row['career_item'] && !$row['scholar_doctor'] && !$row['lab_career'] && !$row['adoption_6months'] && !$row['adoption_env_date'] && !$row['adoption_env_completion'] && !$row['increase_staff'] && !$row['pay_required'] && !$row['fund_item'] && !$row['adoption_env_etc'] && ($row['subsidy_type_if']==',,,,,,,,,,,,,,' || !$row['subsidy_type_if']) && !$row['local_return'] && !$row['adoption_6months_new'] && !$row['employ_execute_yn'] && !$row['employ_execute_age'] && ($row['employ_execute_sex']==',,,' || !$row['employ_execute_date']) && !$row['employ_execute_person'] && !$row['employ_execute_pay'] && !$row['employ_execute_time'] && !$row['employ_execute_id'] && !$row['employ_execute_pw']  && !$row['employ_execute_etc'] && ($row['job_creation_proposal']==',,,,,' || !$row['job_creation_proposal']) && !$row['worktime_shorten_proposal_yn'] && !$row['worktime_shorten_proposal']) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전문인력채용<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	$career_5year = $row['career_5year']; //타회사 5년이상 개발경력
	$career_item = $row['career_item']; //경영기획,인사,노무재무,마케팅경력
	$scholar_doctor = $row['scholar_doctor']; //석,박사
	$lab_career = $row['lab_career']; //연구소경력
	$adoption_6months = $row['adoption_6months']; //6개월이내 채용예정여부
	if($is_damdang == "ok") {
?>
								<b>타회사 5년이상 개발경력</b>
								<input name="career_5year" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['career_5year']?>" maxlength="100">
								<br><b>경영기획,인사,노무재무,마케팅경력</b>
								<input name="career_item" type="text" class="textfm" style="width:254px;ime-mode:active;" value="<?=$row['career_item']?>" maxlength="100">
								<br><b>석,박사</b>
								<input name="scholar_doctor" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['scholar_doctor']?>" maxlength="100">
								<br><b>연구소경력</b>
								<input name="lab_career" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['lab_career']?>" maxlength="100">
								<br><input type="checkbox" name="career_kind" value="1" <? if($row['career_kind'] == 1) echo "checked"; ?> style="vertical-align:middle">기능장
								<input type="checkbox" name="career_kind2" value="1" <? if($row['career_kind2'] == 1) echo "checked"; ?> style="vertical-align:middle">명장
								<input type="checkbox" name="career_kind3" value="1" <? if($row['career_kind3'] == 1) echo "checked"; ?> style="vertical-align:middle">기술사
								<input type="checkbox" name="career_kind4" value="1" <? if($row['career_kind4'] == 1) echo "checked"; ?> style="vertical-align:middle">올림픽입상
								<br><b>6개월이내 채용예정여부</b>
								<input name="adoption_6months" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['adoption_6months']?>" maxlength="100">
<?
	} else {
		if($career_5year) echo "<b>타회사 5년이상 개발경력</b> : ".$row['career_5year'];
		if($career_item) echo "<br><b>경영기획,인사,노무재무,마케팅경력</b> : ".$row['career_item'];
		if($scholar_doctor) echo "<br><b>석,박사</b> : ".$row['scholar_doctor'];
		if($lab_career) echo "<br><b>연구소경력</b> : ".$row['lab_career'];
		if($adoption_6months) echo "<br><b>6개월이내 채용예정여부</b> : ".$row['adoption_6months'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용환경개선</td>
							<td nowrap  class="tdrow" width="300">
<?
	$adoption_env_date = $row['adoption_env_date']; //고용환경신고일
	$adoption_env_completion = $row['adoption_env_completion']; //완료일
	$increase_staff = $row['increase_staff']; //증가인원
	$pay_required = $row['pay_required']; //소요비용
	$fund_item = $row['fund_item']; //투자항목
	$adoption_env_etc = $row['adoption_env_etc']; //기타사항
	if($is_damdang == "ok") {
?>
								<b>고용환경신고일</b>
								<input name="adoption_env_date" type="text" class="textfm" style="width:180px;ime-mode:active;" value="<?=$row['adoption_env_date']?>" maxlength="100">
								<br><b>완료일</b>
								<input name="adoption_env_completion" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_env_completion']?>" maxlength="100">
								<br><b>증가인원</b>
								<input name="increase_staff" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['increase_staff']?>" maxlength="3">명
								<br><b>소요비용</b>
								<input name="pay_required" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['pay_required']?>" maxlength="100">
								<br><b>투자항목</b>
								<input name="fund_item" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['fund_item']?>" maxlength="100">
								<br><b>기타사항</b>
								<input name="adoption_env_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_env_etc']?>" maxlength="100">
<?
	} else {
		if($adoption_env_date) echo "<b>고용환경신고일</b> : ".$row['adoption_env_date'];
		if($adoption_env_completion) echo "<br><b>완료일</b> : ".$row['adoption_env_completion'];
		if($increase_staff) echo "<br><b>증가인원</b> : ".$row['increase_staff'];
		if($pay_required) echo "<br><b>소요비용</b> : ".$row['pay_required'];
		if($fund_item) echo "<br><b>투자항목</b> : ".$row['fund_item'];
		if($adoption_env_etc) echo "<br><b>기타사항</b> : ".$row['adoption_env_etc'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역성장(유망창업)</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//지원대상업종여부
	$subsidy_type_if = explode(',',$row['subsidy_type_if']);
	$subsidy_type_if_text = array("신재생에너지","콘텐츠/소프트웨어","방송통신융합","LED응용","그린수송시스템","로봇응용","신소재/나노융합","IT융합","바이오/헬스케어","교육","고부가식품","탄소저감에너지","첨단그린도시","고도물처리");
	//국내복귀기업 여부
	if($row['local_return'] == "1") $local_return = "YES";
	else if($row['local_return'] == "2") $local_return = "NO";
	else $local_return = "";
	//6개월이내 신규사원 채용예정여부
	$adoption_6months_new = $row['adoption_6months_new'];
	if($is_damdang == "ok") {
?>
								<b>지원대상업종여부</b>
								<br><input type="checkbox" name="subsidy_type_if1" value="1" <? if($subsidy_type_if[0] == 1) echo "checked"; ?> style="vertical-align:middle">신재생에너지
								<input type="checkbox" name="subsidy_type_if2" value="1" <? if($subsidy_type_if[1] == 1) echo "checked"; ?> style="vertical-align:middle">콘텐츠/소프트웨어
								<input type="checkbox" name="subsidy_type_if3" value="1" <? if($subsidy_type_if[2] == 1) echo "checked"; ?> style="vertical-align:middle">방송통신융합
								<input type="checkbox" name="subsidy_type_if4" value="1" <? if($subsidy_type_if[3] == 1) echo "checked"; ?> style="vertical-align:middle">LED응용
								<br>
								<input type="checkbox" name="subsidy_type_if5" value="1" <? if($subsidy_type_if[4] == 1) echo "checked"; ?> style="vertical-align:middle">그린수송시스템
								<input type="checkbox" name="subsidy_type_if6" value="1" <? if($subsidy_type_if[5] == 1) echo "checked"; ?> style="vertical-align:middle">로봇응용
								<input type="checkbox" name="subsidy_type_if7" value="1" <? if($subsidy_type_if[6] == 1) echo "checked"; ?> style="vertical-align:middle">신소재/나노융합
								<input type="checkbox" name="subsidy_type_if8" value="1" <? if($subsidy_type_if[7] == 1) echo "checked"; ?> style="vertical-align:middle">IT융합
								<input type="checkbox" name="subsidy_type_if9" value="1" <? if($subsidy_type_if[8] == 1) echo "checked"; ?> style="vertical-align:middle">바이오/헬스케어
								<br>
								<input type="checkbox" name="subsidy_type_if10" value="1" <? if($subsidy_type_if[9] == 1) echo "checked"; ?> style="vertical-align:middle">교육
								<input type="checkbox" name="subsidy_type_if11" value="1" <? if($subsidy_type_if[10] == 1) echo "checked"; ?> style="vertical-align:middle">고부가식품
								<input type="checkbox" name="subsidy_type_if12" value="1" <? if($subsidy_type_if[11] == 1) echo "checked"; ?> style="vertical-align:middle">탄소저감에너지
								<input type="checkbox" name="subsidy_type_if13" value="1" <? if($subsidy_type_if[12] == 1) echo "checked"; ?> style="vertical-align:middle">첨단그린도시
								<input type="checkbox" name="subsidy_type_if14" value="1" <? if($subsidy_type_if[13] == 1) echo "checked"; ?> style="vertical-align:middle">고도물처리
								<br><b>국내복귀기업 여부</b>
								<input type="radio" name="local_return" value="1" <? if($row['local_return'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="local_return" value="2" <? if($row['local_return'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>6개월이내 신규사원 채용예정여부</b>
								<input name="adoption_6months_new" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_6months_new']?>" maxlength="100">
<?
	} else {
		if($row['subsidy_type_if'] && $row['subsidy_type_if'] != ",,,,,,,,,,,,,,") {
			echo "<b>지원대상업종여부</b> : ";
			for ($i=0; $i<=13; $i++) {
				if($subsidy_type_if[$i]) echo $subsidy_type_if_text[$i].". ";
			}
		}
		if($local_return) echo "<br><b>국내복귀기업 여부</b> : ".$local_return;
		if($adoption_6months_new) echo "<br><b>6개월이내 신규사원 채용예정여부</b> : ".$row['adoption_6months_new'];
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">채용대행</td>
							<td nowrap  class="tdrow">
<?
	//채용대행 의뢰여부
	if($row['employ_execute_yn'] == "1") $employ_execute_yn = "YES";
	else if($row['employ_execute_yn'] == "2") $employ_execute_yn = "NO";
	else $employ_execute_yn = "";
	$employ_execute_age = $row['employ_execute_age']; //연령대
	$employ_execute_sex = $row['employ_execute_sex']; //성별
	$employ_execute_date = $row['employ_execute_date']; //채용시기
	$employ_execute_person = $row['employ_execute_person']; //채용인원
	$employ_execute_pay = $row['employ_execute_pay']; //기본급(구성)
	$employ_execute_time = $row['employ_execute_time']; //근무시간
	$employ_execute_id = $row['employ_execute_id']; //워크넷ID
	$employ_execute_pw = $row['employ_execute_pw']; //비밀번호
	$employ_execute_etc = $row['employ_execute_etc']; //기타사항
	if($is_damdang == "ok") {
?>
								<b>채용대행 의뢰여부</b>
								<input type="radio" name="employ_execute_yn" value="1" <? if($row['employ_execute_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="employ_execute_yn" value="2" <? if($row['employ_execute_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>연령대
								<input name="employ_execute_age" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_age']?>" maxlength="10">
								성별
								<input name="employ_execute_sex" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['employ_execute_sex']?>" maxlength="10">
								<br>채용시기
								<input name="employ_execute_date" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_date']?>" maxlength="10">
								채용인원
								<input name="employ_execute_person" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['employ_execute_person']?>" maxlength="10">
								<br>기본급(구성)
								<input name="employ_execute_pay" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_pay']?>" maxlength="10">
								근무시간
								<input name="employ_execute_time" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['employ_execute_time']?>" maxlength="16">
								<br>워크넷ID
								<input name="employ_execute_id" type="text" class="textfm" style="width:80px;" value="<?=$row['employ_execute_id']?>" maxlength="16">
								비밀번호
								<input name="employ_execute_pw" type="text" class="textfm" style="width:100px;" value="<?=$row['employ_execute_pw']?>" maxlength="16">
								<br>기타사항
								<input name="employ_execute_etc" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$row['employ_execute_etc']?>" maxlength="30">
<?
	} else {
		if($employ_execute_yn) echo "<b>채용대행 의뢰여부</b> : ".$employ_execute_yn;
		if($employ_execute_age) echo "<br>연령대 : ".$employ_execute_age;
		if($employ_execute_sex) echo "<br>성별 : ".$employ_execute_sex;
		if($employ_execute_date) echo "<br>채용시기 : ".$employ_execute_date;
		if($employ_execute_person) echo "<br>채용인원 : ".$employ_execute_person;
		if($employ_execute_pay) echo "<br>기본급(구성) : ".$employ_execute_pay;
		if($employ_execute_time) echo "<br>근무시간 : ".$employ_execute_time;
		if($employ_execute_id) echo "<br>워크넷ID : ".$employ_execute_id;
		if($employ_execute_pw) echo "<br>비밀번호 : ".$employ_execute_pw;
		if($employ_execute_etc) echo "<br>기타사항 : ".$employ_execute_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용창출사업계획서
							</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//지원대상업종여부
	$job_creation_proposal = explode(',',$row['job_creation_proposal']);
	$job_creation_proposal_text = array("전문인력","고용환경","일자리함께","시간선택제","지역성장");
	if($is_damdang == "ok") {
?>
								<b>고용창출사업계획서 의뢰여부</b>
								<br><input type="checkbox" name="job_creation_proposal1" value="1" <? if($job_creation_proposal[0] == 1) echo "checked"; ?> style="vertical-align:middle">전문인력
								<input type="checkbox" name="job_creation_proposal2" value="1" <? if($job_creation_proposal[1] == 1) echo "checked"; ?> style="vertical-align:middle">고용환경
								<!--<input type="checkbox" name="job_creation_proposal3" value="1" <? if($job_creation_proposal[2] == 1) echo "checked"; ?> style="vertical-align:middle">일자리함께-->
								<input type="checkbox" name="job_creation_proposal4" value="1" <? if($job_creation_proposal[3] == 1) echo "checked"; ?> style="vertical-align:middle">시간선택제
								<input type="checkbox" name="job_creation_proposal5" value="1" <? if($job_creation_proposal[4] == 1) echo "checked"; ?> style="vertical-align:middle">지역성장
<?
	} else {
		if($row['job_creation_proposal'] && $row['job_creation_proposal'] != ",,,,,") {
			echo "<b>고용창출사업계획서 의뢰여부</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($job_creation_proposal[$i]) echo $job_creation_proposal_text[$i].". ";
			}
		}
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">시간 선택제</td>
							<td nowrap  class="tdrow">
<?
	//15시간 이상 30시간 미만 근로자 채용계획
	if($row['worktime_shorten_proposal_yn'] == "1") $worktime_shorten_proposal_yn = "YES";
	else if($row['worktime_shorten_proposal_yn'] == "2") $worktime_shorten_proposal_yn = "NO";
	else $worktime_shorten_proposal_yn = "";
	if($is_damdang == "ok") {
?>
								<b>15시간 이상 30시간 미만 근로자 채용계획</b><br>
								<input type="radio" name="worktime_shorten_proposal_yn" value="1" <? if($row['worktime_shorten_proposal_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="worktime_shorten_proposal_yn" value="2" <? if($row['worktime_shorten_proposal_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>
								<input name="worktime_shorten_proposal" type="text" class="textfm" style="width:250px;ime-mode:active;" value="<?=$row['worktime_shorten_proposal']?>" maxlength="100">
<?
	} else {
		if($worktime_shorten_proposal_yn) echo "<b>주15~30시간미만 근로자 채용계획인원</b> : ".$worktime_shorten_proposal_yn."<br>".$row['worktime_shorten_proposal'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
											<textarea name="memo2" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo2?></textarea>
<?
	} else {
		if($memo2) echo "<pre>".$memo2."</pre>";
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
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='found_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style="width:100px;text-align:center;">
											창업관련
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
					<div id="found_div" style="<? if(($row['found_if']==',,,,,,' || !$row['found_if']) && !$row['found_unreg'] && !$row['found_consent_if'] && !$row['first_type'] && !$row['factory_before_type'] && !$row['found_tax_pay'] && ($row['found_tax']==',,' || !$row['found_tax']) && !$row['found_reason'] && ($row['charge_progress']==',,,,' || !$row['charge_progress']) && !$row['charge_progress_etc'] && !$row['charge_progress_reason'] && !$row['charge_progress_factory_scale'] && !$row['factory_site_1000'] && ($row['charge_progress_small']==',,,' || !$row['charge_progress_small']) && !$row['charge_progress_small_etc'] && !$row['charge_progress_small_reason'] && !$row['factory_extend_reduce_yn'] && !$row['factory_extend_reduce'] && !$row['establish_proposal_if']  && !$row['establish_plan_date'] && !$row['establish_area'] && !$row['establish_money'] && ($row['establish_way']===',,,,' || !$row['establish_way']) && ($row['establish_type']==',,,' || !$row['establish_type']) && !$row['establish_type_etc'] && ($row['establish_request']==',,,,,' || !$row['establish_request']) && !$memo3) echo "display:none;" ?>">
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120" rowspan=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">창업여부</td>
							<td nowrap  class="tdrow" width="" rowspan="">
<?
	//창업여부
	$found_if = explode(',',$row['found_if']);
	$found_if_text = array("자가소유","임대","개별입지","계획입지(산업단지)","공장등록(Y)","미등록(N)");
	$found_unreg = $row['found_unreg']; //미등록 사유
	//창업계획승인여부
	if($row['found_consent_if'] == "1") $found_consent_if = "YES";
	else if($row['found_consent_if'] == "2") $found_consent_if = "NO";
	else $found_consent_if = "";
	$first_type = $row['first_type']; //前사업이력 및 최초 사업시 업종
	$factory_before_type = $row['factory_before_type']; //공장의직전 사업업종
	$found_tax_pay = $row['found_tax_pay']; //납부/금액
	//취등록세
	$found_tax = explode(',',$row['found_tax']);
	$found_tax_text = array("면제","납부/금액");
	$found_reason = $row['found_reason']; //납부사유
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="found_if1" value="1" <? if($found_if[0] == 1) echo "checked"; ?> style="vertical-align:middle"><b>자가소유</b>
								<input type="checkbox" name="found_if2" value="1" <? if($found_if[1] == 1) echo "checked"; ?> style="vertical-align:middle"><b>임대</b>
								<br>
								<input type="checkbox" name="found_if3" value="1" <? if($found_if[2] == 1) echo "checked"; ?> style="vertical-align:middle"><b>개별입지</b>
								<input type="checkbox" name="found_if4" value="1" <? if($found_if[3] == 1) echo "checked"; ?> style="vertical-align:middle"><b>계획입지(산업단지)</b>
								<br>
								<input type="checkbox" name="found_if5" value="1" <? if($found_if[4] == 1) echo "checked"; ?> style="vertical-align:middle"><b>공장등록(Y)</b>
								<input type="checkbox" name="found_if6" value="1" <? if($found_if[5] == 1) echo "checked"; ?> style="vertical-align:middle"><b>미등록(N)</b>
								공장 미등록 사유
								<input name="found_unreg" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['found_unreg']?>" maxlength="100">
								<br><b>창업계획승인여부</b>
								<input type="radio" name="found_consent_if" value="1" <? if($row['found_consent_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="found_consent_if" value="2" <? if($row['found_consent_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>前사업이력 및 최초 사업시 업종</b>
								<input name="first_type" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['first_type']?>" maxlength="100">
								<b>공장의직전 사업업종</b>
								<input name="factory_before_type" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['factory_before_type']?>" maxlength="100">
								<br><b>취등록세</b>
								<input type="checkbox" name="found_tax1" value="1" <? if($found_tax[0] == 1) echo "checked"; ?> style="vertical-align:middle">면제
								<input type="checkbox" name="found_tax2" value="1" <? if($found_tax[1] == 1) echo "checked"; ?> style="vertical-align:middle">납부/금액
								<input name="found_tax_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['found_tax_pay']?>" maxlength="100">
								납부사유
								<input name="found_reason" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['found_reason']?>" maxlength="100">
<?
	} else {
		if($row['found_if'] && $row['found_if'] != ",,,,,,") {
			//echo "<b>창업여부</b> : ";
			for ($i=0; $i<=5; $i++) {
				if($found_if[$i]) echo $found_if_text[$i].". ";
			}
			echo "<br>";
		}
		if($found_unreg) echo "<b>미등록 사유</b> : ".$found_unreg."<br>";
		if($found_consent_if) echo "<b>창업계획승인여부</b> : ".$found_consent_if."<br>";
		if($first_type) echo "<b>前사업이력 및 최초 사업시 업종</b> : ".$first_type."<br>";
		if($factory_before_type) echo "<b>공장의직전 사업업종</b> : ".$factory_before_type."<br>";
		if($row['found_tax'] && $row['found_tax'] != ",,") {
			echo "<b>취등록세</b> : ";
			for ($i=0; $i<=1; $i++) {
				if($found_tax[$i]) echo $found_tax_text[$i].". ";
			}
		}
		if($found_tax_pay) echo " ".$found_tax_pay;
		if($found_reason) echo " 납부사유 : ".$found_reason;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">창업부담금</td>
							<td nowrap class="tdrow" colspan="">
<?
	//부담금 진행(제조업)
	$charge_progress = explode(',',$row['charge_progress']);
	$charge_progress_text = array("전기","물","농지보전","기타");
	$charge_progress_etc = $row['charge_progress_etc']; //기타
	$charge_progress_reason = $row['charge_progress_reason']; //미해당 사유
	$charge_progress_factory_scale = $row['charge_progress_factory_scale']; //자가공장의 전체규모
	//자가공장용지(건평) 1,000㎡ 미만 여부
	if($row['factory_site_1000'] == "1") $factory_site_1000 = "YES";
	else if($row['factory_site_1000'] == "2") $factory_site_1000 = "NO";
	else $factory_site_1000 = "";
	//부담금 진행(소상공인)
	$charge_progress_small = explode(',',$row['charge_progress_small']);
	$charge_progress_small_text = array("농지보전","대체산림자원조성비","개발부담금");
	$charge_progress_small_etc = $row['charge_progress_small_etc']; //기타
	$charge_progress_small_reason = $row['charge_progress_small_reason']; //미해당 사유
	//공장추가신설 및 증축에 따른 부담금감면여부
	if($row['factory_extend_reduce_yn'] == "1") $factory_extend_reduce_yn = "YES";
	else if($row['factory_extend_reduce_yn'] == "2") $factory_extend_reduce_yn = "NO";
	else $factory_extend_reduce_yn = "";
	$factory_extend_reduce = $row['factory_extend_reduce']; //내용
	if($is_damdang == "ok") {
?>
								<b>부담금 진행(제조업)</b>
								<input type="checkbox" name="charge_progress1" value="1" <? if($charge_progress[0] == 1) echo "checked"; ?> style="vertical-align:middle">전기
								<input type="checkbox" name="charge_progress2" value="1" <? if($charge_progress[1] == 1) echo "checked"; ?> style="vertical-align:middle">물
								<input type="checkbox" name="charge_progress3" value="1" <? if($charge_progress[2] == 1) echo "checked"; ?> style="vertical-align:middle">농지보전
								<input type="checkbox" name="charge_progress4" value="1" <? if($charge_progress[3] == 1) echo "checked"; ?> style="vertical-align:middle">기타
								<input name="charge_progress_etc" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['charge_progress_etc']?>" maxlength="100">
								<b>미해당 사유</b>
								<input name="charge_progress_reason" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['charge_progress_reason']?>" maxlength="100">
								<br><b>자가공장의 전체규모</b>
								<input name="charge_progress_factory_scale" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['charge_progress_factory_scale']?>" maxlength="5">㎡
								<br><b>자가공장용지(건평) 1,000㎡ 미만 여부</b>
								<input type="radio" name="factory_site_1000" value="1" <? if($row['factory_site_1000'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_site_1000" value="2" <? if($row['factory_site_1000'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>부담금 진행(소상공인)</b>
								<input type="checkbox" name="charge_progress_small1" value="1" <? if($charge_progress_small[0] == 1) echo "checked"; ?> style="vertical-align:middle">농지보전
								<input type="checkbox" name="charge_progress_small2" value="1" <? if($charge_progress_small[1] == 1) echo "checked"; ?> style="vertical-align:middle">대체산림자원조성비
								<input type="checkbox" name="charge_progress_small3" value="1" <? if($charge_progress_small[2] == 1) echo "checked"; ?> style="vertical-align:middle">개발부담금
								<b>미해당 사유</b>
								<input name="charge_progress_small_reason" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['charge_progress_small_reason']?>" maxlength="100">
								<br><b>공장추가신설 및 증축에 따른 부담금감면여부</b>
								<input type="radio" name="factory_extend_reduce_yn" value="1" <? if($row['factory_extend_reduce_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_extend_reduce_yn" value="2" <? if($row['factory_extend_reduce_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>내용</b>
								<input name="factory_extend_reduce" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['factory_extend_reduce']?>" maxlength="100">
<?
	} else {
		if($row['charge_progress'] && $row['charge_progress'] != ",,,,") {
			echo "<b>부담금 진행(제조업)</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($charge_progress[$i]) echo $charge_progress_text[$i].". ";
			}
		}
		if($charge_progress_etc) echo " ".$charge_progress_etc."<br>";
		if($charge_progress_reason) echo "<b>미해당 사유</b> : ".$charge_progress_reason."<br>";
		if($charge_progress_factory_scale) echo "<b>자가공장의 전체규모</b> : ".$charge_progress_factory_scale."<br>";
		if($factory_site_1000) echo "<b>자가공장용지(건평) 1,000㎡ 미만 여부</b> : ".$factory_site_1000."<br>";
		if($row['charge_progress_small'] && $row['charge_progress_small'] != ",,,") {
			echo "<b>부담금 진행(소상공인)</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($charge_progress_small[$i]) echo $charge_progress_small_text[$i].". ";
			}
		}
		if($charge_progress_small_reason) echo " <b>미해당 사유</b> : ".$charge_progress_small_reason."<br>";
		if($factory_extend_reduce_yn) echo "<b>공장추가신설 및 증축에 따른 부담금감면여부</b> : ".$factory_extend_reduce_yn;
		if($factory_extend_reduce) echo " <b>내용</b> : ".$factory_extend_reduce."";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">창업 및 용역업무<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	//공장설립 계획여부
	if($row['establish_proposal_if'] == "1") $establish_proposal_if = "YES";
	else if($row['establish_proposal_if'] == "2") $establish_proposal_if = "NO";
	else $establish_proposal_if = "";
	$establish_plan_date = $row['establish_plan_date']; //설립예정시기
	$establish_area = $row['establish_area']; //설립지역
	$establish_money = $row['establish_money']; //금액
	//공장설립 방법
	$establish_way = explode(',',$row['establish_way']);
	$establish_way_text = array("임대","신규자가 공장설립","공장매입","제2공장");
	//공장설립 업종
	$establish_type = explode(',',$row['establish_type']);
	$establish_type_text = array("동종업종 설립","타 업종 설립","기타");
	$establish_type_etc = $row['establish_type_etc']; //기타
	//공장설립 관련 의뢰여부
	$establish_request = explode(',',$row['establish_request']);
	$establish_request_text = array("사업타당성 분석","사업계획서작성","공장설립","공장설립승인신청","공장등록신청");
	if($is_damdang == "ok") {
?>
								<b>공장설립 계획여부</b>
								<input type="radio" name="establish_proposal_if" value="1" <? if($row['establish_proposal_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="establish_proposal_if" value="2" <? if($row['establish_proposal_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>설립예정시기</b>
								<input name="establish_plan_date" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['establish_plan_date']?>" maxlength="100">
								<b>설립지역</b>
								<input name="establish_area" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['establish_area']?>" maxlength="100">
								<b>금액</b>
								<input name="establish_money" type="text" class="textfm" style="width:100px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$row['establish_money']?>" maxlength="100">
								<br><b>공장설립 방법</b>
								<input type="checkbox" name="establish_way1" value="1" <? if($establish_way[0] == 1) echo "checked"; ?> style="vertical-align:middle">임대
								<input type="checkbox" name="establish_way2" value="1" <? if($establish_way[1] == 1) echo "checked"; ?> style="vertical-align:middle">신규자가 공장설립
								<input type="checkbox" name="establish_way3" value="1" <? if($establish_way[2] == 1) echo "checked"; ?> style="vertical-align:middle">공장매입
								<input type="checkbox" name="establish_way4" value="1" <? if($establish_way[3] == 1) echo "checked"; ?> style="vertical-align:middle">제2공장
								<br><b>공장설립 업종</b>
								<input type="checkbox" name="establish_type1" value="1" <? if($establish_type[0] == 1) echo "checked"; ?> style="vertical-align:middle">동종업종 설립
								<input type="checkbox" name="establish_type2" value="1" <? if($establish_type[1] == 1) echo "checked"; ?> style="vertical-align:middle">타 업종 설립
								<input type="checkbox" name="establish_type3" value="1" <? if($establish_type[2] == 1) echo "checked"; ?> style="vertical-align:middle">기타
								<input name="establish_type_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['establish_type_etc']?>" maxlength="100">
								<br><b>공장설립 관련 의뢰여부</b>
								<input type="checkbox" name="establish_request1" value="1" <? if($establish_request[0] == 1) echo "checked"; ?> style="vertical-align:middle">사업타당성 분석<span style="font-size:8px">10.20</span>
								<input type="checkbox" name="establish_request2" value="1" <? if($establish_request[1] == 1) echo "checked"; ?> style="vertical-align:middle">사업계획서작성<span style="font-size:8px">3.10</span>
								<input type="checkbox" name="establish_request3" value="1" <? if($establish_request[2] == 1) echo "checked"; ?> style="vertical-align:middle">공장설립<span style="font-size:8px">8.16</span>
								<input type="checkbox" name="establish_request4" value="1" <? if($establish_request[3] == 1) echo "checked"; ?> style="vertical-align:middle">공장설립승인신청<span style="font-size:8px">2.6</span>
								<input type="checkbox" name="establish_request5" value="1" <? if($establish_request[4] == 1) echo "checked"; ?> style="vertical-align:middle">공장등록신청<span style="font-size:8px">3.6</span>
<?
	} else {
		if($establish_proposal_if) echo "<b>공장설립 계획여부</b> : ".$establish_proposal_if;
		if($establish_plan_date) echo "<b>설립예정시기</b> : ".$establish_plan_date;
		if($establish_area) echo "<br><b>설립지역</b> : ".$establish_area;
		if($establish_money) echo "<b>금액</b> : ".$establish_money;
		if($row['establish_way'] && $row['establish_way'] != ",,,,") {
			echo "<br><b>공장설립 방법</b> : ";
			for ($i=0; $i<=3; $i++) {
				if($establish_way[$i]) echo $establish_way_text[$i].". ";
			}
			echo "<br>";
		}
		if($row['establish_type'] && $row['establish_type'] != ",,,") {
			echo "<b>공장설립 업종</b> : ";
			for ($i=0; $i<=2; $i++) {
				if($establish_type[$i]) echo $establish_type_text[$i].". ";
			}
			echo "<br>";
		}
		if($row['establish_request'] && $row['establish_request'] != ",,,,,") {
			echo "<b>공장설립 관련 의뢰여부</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($establish_request[$i]) echo $establish_request_text[$i].". ";
			}
		}
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo3" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo3?></textarea>
<?
	} else {
		if($memo3) echo "<pre>".$memo3."</pre>";
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
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center;cursor:pointer;' onclick="var div_display='fund_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
											지방촉진
										</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width="2"></td> 
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<div id="fund_div" style="<? if(($row['fund_kind']==',,,,,,' || !$row['fund_kind']) && !$row['fund_kind_locality'] && !$row['new_fund_scale_site_pay'] && !$row['new_fund_scale_site2_pay'] && !$row['new_fund_scale_site3_pay'] && !$row['new_fund_scale_site4_pay'] && !$row['fund_inside_pay'] && !$row['fund_outside_pay'] && !$row['mou_conclude'] && ($row['fund_type_industry']==',,,,,' || !$row['fund_type_industry']) && !$row['sort_code_number'] && !$row['fund_basic_check1_sales'] && !$row['fund_basic_check2_level'] && !$row['local_tax_yn'] && !$row['fund_etc'] && !$memo4) echo "display:none;" ?>">
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">투자계획여부<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="" style="padding:10px">
<?
	//투자의 형태
	$fund_kind = explode(',',$row['fund_kind']);
	$fund_kind_text = array("지방이전","신축","증축","재2공장","복귀기업","연구소");
	$fund_kind_locality = $row['fund_kind_locality']; //지역
	$new_fund_scale_site_pay = $row['new_fund_scale_site_pay']; //부지(입지)
	$new_fund_scale_site2_pay = $row['new_fund_scale_site2_pay']; //건축물
	$new_fund_scale_site3_pay = $row['new_fund_scale_site3_pay']; //설비
	$new_fund_scale_site4_pay = $row['new_fund_scale_site4_pay']; //합계
	$fund_inside_pay = $row['fund_inside_pay']; //내부자금
	$fund_outside_pay = $row['fund_outside_pay']; //외부자금
	$mou_conclude = $row['mou_conclude']; //MOU 체결
	//업종해당여부
	$fund_type_industry = explode(',',$row['fund_type_industry']);
	$fund_type_industry_text = array("지역선도산업","지역집중유치업종","지식서비스산업","성장촉진지역","특화업종");
	$sort_code_number = $row['sort_code_number']; //표준산업 분류코드번호
	$fund_basic_check1_sales = $row['fund_basic_check1_sales']; //합계
	$fund_basic_check2_level = $row['fund_basic_check2_level']; //합계
	//지방세 체납여부
	if($row['local_tax_yn'] == "1") $local_tax_yn = "YES";
	else if($row['local_tax_yn'] == "2") $local_tax_yn = "NO";
	else $local_tax_yn = "";
	$fund_etc = $row['fund_etc']; //기타사항
	if($is_damdang == "ok") {
?>
								<b>투자의 형태</b>
								<br><input type="checkbox" name="fund_kind1" value="1" <? if($fund_kind[0] == 1) echo "checked"; ?> style="vertical-align:middle">지방이전(지역
								<input name="fund_kind_locality" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['fund_kind_locality']?>" maxlength="50">)
								<input type="checkbox" name="fund_kind2" value="1" <? if($fund_kind[1] == 1) echo "checked"; ?> style="vertical-align:middle">신축
								<input type="checkbox" name="fund_kind3" value="1" <? if($fund_kind[2] == 1) echo "checked"; ?> style="vertical-align:middle">증축
								<input type="checkbox" name="fund_kind4" value="1" <? if($fund_kind[3] == 1) echo "checked"; ?> style="vertical-align:middle">재2공장
								<input type="checkbox" name="fund_kind5" value="1" <? if($fund_kind[4] == 1) echo "checked"; ?> style="vertical-align:middle">복귀기업
								<input type="checkbox" name="fund_kind6" value="1" <? if($fund_kind[5] == 1) echo "checked"; ?> style="vertical-align:middle">연구소
								<BR><b>신규투자 규모</b>
								부지(입지)
								<input name="new_fund_scale_site_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site_pay']?>" maxlength="50">
								건축물
								<input name="new_fund_scale_site2_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site2_pay']?>" maxlength="50">
								<br>
								설비
								<input name="new_fund_scale_site3_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site3_pay']?>" maxlength="50">
								합계
								<input name="new_fund_scale_site4_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site4_pay']?>" maxlength="50">
								<br><b>투자금 조달계획</b>
								내부자금
								<input name="fund_inside_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_inside_pay']?>" maxlength="100">
								외부자금
								<input name="fund_outside_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_outside_pay']?>" maxlength="100">
								<br><b>MOU 체결</b>
								<input name="mou_conclude" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$row['mou_conclude']?>" maxlength="100">
<?
	} else {
		if($row['fund_kind'] && $row['fund_kind'] != ",,,,,,") {
			echo "<b>투자의 형태</b> : ";
			for ($i=0; $i<=5; $i++) {
				if($fund_kind[$i]) echo $fund_kind_text[$i].". ";
			}
			echo "<br>";
		}
		if($fund_kind_locality) echo "<b>지역</b> : ".$fund_kind_locality."<br>";
		if($new_fund_scale_site_pay) echo "<b>부지(입지)</b> : ".$new_fund_scale_site_pay."<br>";
		if($new_fund_scale_site2_pay) echo "<b>건축물</b> : ".$new_fund_scale_site2_pay."<br>";
		if($new_fund_scale_site3_pay) echo "<b>설비</b> : ".$new_fund_scale_site3_pay."<br>";
		if($new_fund_scale_site4_pay) echo "<b>합계</b> : ".$new_fund_scale_site4_pay."<br>";
		if($fund_inside_pay) echo "<b>내부자금</b> : ".$fund_inside_pay."<br>";
		if($fund_outside_pay) echo "<b>외부자금</b> : ".$fund_outside_pay."<br>";
		if($mou_conclude) echo "<b>MOU 체결</b> : ".$mou_conclude;
	}
?>
							</td>
							<td nowrap class="tdrow" colspan="" style="padding:10px">
<?
	if($is_damdang == "ok") {
?>
								<b>업종해당여부</b>
								<input type="checkbox" name="fund_type_industry1" value="1" <? if($fund_type_industry[0] == 1) echo "checked"; ?> style="vertical-align:middle">지역선도산업
								<input type="checkbox" name="fund_type_industry2" value="1" <? if($fund_type_industry[1] == 1) echo "checked"; ?> style="vertical-align:middle">지역집중유치업종
								<input type="checkbox" name="fund_type_industry3" value="1" <? if($fund_type_industry[2] == 1) echo "checked"; ?> style="vertical-align:middle">지식서비스산업
								<br><input type="checkbox" name="fund_type_industry4" value="1" <? if($fund_type_industry[3] == 1) echo "checked"; ?> style="vertical-align:middle">성장촉진지역
								<input type="checkbox" name="fund_type_industry5" value="1" <? if($fund_type_industry[4] == 1) echo "checked"; ?> style="vertical-align:middle">특화업종
								<br><b>표준산업 분류코드번호</b>
								<input name="sort_code_number" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['sort_code_number']?>" maxlength="100">
								공장등록증참조
								<br><b>기본체크사항</b>
								최근3년매출
								<input name="fund_basic_check1_sales" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_basic_check1_sales']?>" maxlength="100">
								신용등급
								<input name="fund_basic_check2_level" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_basic_check2_level']?>" maxlength="100">
								<br>
								<b>지방세 체납여부</b>
								<input type="radio" name="local_tax_yn" value="1" <? if($row['local_tax_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="local_tax_yn" value="2" <? if($row['local_tax_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>기타사항</b>
								<input name="fund_etc" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$row['fund_etc']?>" maxlength="100">
<?
	} else {
		if($row['fund_type_industry'] && $row['fund_type_industry'] != ",,,,,") {
			echo "<b>업종해당여부</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($fund_type_industry[$i]) echo $fund_type_industry_text[$i].". ";
			}
		}
		if($sort_code_number) echo "<b>표준산업 분류코드번호</b> : ".$sort_code_number."<br>";
		if($fund_basic_check1_sales) echo "<b>최근3년매출</b> : ".$fund_basic_check1_sales."<br>";
		if($fund_basic_check2_level) echo "<b>신용등급</b> : ".$fund_basic_check2_level."<br>";
		if($local_tax_yn) echo "<b>지방세 체납여부</b> : ".$local_tax_yn."<br>";
		if($fund_etc) echo "<b>기타사항</b> : ".$fund_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
											<textarea name="memo4" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo4?></textarea>
<?
	} else {
		if($memo4) echo "<pre>".$memo4."</pre>";
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
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center;cursor:pointer;' onclick="var div_display='industrial_disaster_rate_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
											산재요율
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
					<div id="industrial_disaster_rate_div" style="<? if(!$row['industrial_disaster_rate'] && !$row['factory_split'] && !$row['office_rate'] && !$row['office_person'] && !$row['factory_rate'] && !$row['factory_person'] && !$row['lab_rate'] && !$row['lab_person'] && !$row['etc_rate'] && !$row['etc_person'] && !$row['manufacture_process']) echo "display:none;" ?>">
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">산재요율</td>
							<td nowrap class="tdrow" width="">
<?
	$industrial_disaster_rate = $row['industrial_disaster_rate']; //산재적용요율
	//사무실/공장/연구동 분리 여부
	if($row['factory_split'] == "1") $factory_split = "YES";
	else if($row['factory_split'] == "2") $factory_split = "NO";
	else $factory_split = "";
	$office_rate = $row['office_rate']; //사무실(%)
	$office_person = $row['office_person']; //사무실(명)
	$factory_rate = $row['factory_rate']; //공장동(%)
	$factory_person = $row['factory_person']; //공장동(명)
	$lab_rate = $row['lab_rate']; //연구동(%)
	$lab_person = $row['lab_person']; //연구동(명)
	$etc_rate = $row['etc_rate']; //기타(%)
	$etc_person = $row['etc_person']; //기타(명)
	$manufacture_process = $row['manufacture_process']; //제조공정
	if($is_damdang == "ok") {
?>
								<b>산재적용요율</b>
								<input name="industrial_disaster_rate" type="text" class="textfm" style="width:50px;ime-mode:active;" value="<?=$row['industrial_disaster_rate']?>" maxlength="7">%
								(기타 검토업종 : 판넬, 케이블, 주물, 단조, IT소프트웨어 등)
								<br>
								<b>사무실/공장/연구동 분리 여부</b>
								<input type="radio" name="factory_split" value="1" <? if($row['factory_split'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_split" value="2" <? if($row['factory_split'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>
								<b>사무실</b>
								<input name="office_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['office_rate']?>" maxlength="3">%
								<input name="office_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['office_person']?>" maxlength="3">명
								<b>공장동</b>
								<input name="factory_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['factory_rate']?>" maxlength="3">%
								<input name="factory_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['factory_person']?>" maxlength="3">명
								<b>연구동</b>
								<input name="lab_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['lab_rate']?>" maxlength="3">%
								<input name="lab_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['lab_person']?>" maxlength="3">명
								<b>기타</b>
								<input name="etc_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['etc_rate']?>" maxlength="3">%
								<input name="etc_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['etc_person']?>" maxlength="3">명
<?
	} else {
		if($industrial_disaster_rate) echo "<b>산재적용요율</b> : ".$industrial_disaster_rate." %<br>";
		if($factory_split) echo "<b>사무실/공장/연구동 분리 여부</b> : ".$factory_split."<br>";
		if($office_rate) echo "<b>사무실</b> : ".$office_rate." % ";
		if($office_person) echo "".$office_person." 명";
		if($factory_rate) echo "<b>공장동</b> : ".$factory_rate." % ";
		if($factory_person) echo "".$factory_person." 명";
		if($lab_rate) echo "<b>연구동</b> : ".$lab_rate." % ";
		if($lab_person) echo "".$lab_person." 명";
		if($etc_rate) echo "<b>기타</b> : ".$etc_rate." % ";
		if($etc_person) echo "".$etc_person." 명";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">제조공정<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="manufacture_process" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['manufacture_process']?></textarea>
<?
	} else {
		if($manufacture_process) echo $manufacture_process;
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
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='use_program_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											프로그램
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
					<div id="use_program_div" style="<? if(($row['easynomu_request']==',,,' || !$row['easynomu_request']) && !$row['setting_pay'] && !$row['month_pay'] && !$row['easynomu_etc'] && !$memo5) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이지노무<font color="red"></font></td>
							<td class="tdrow" width="">
<?
	$use_program = $row['use_program']; //사용 프로그램
	$use_pay = $row['use_pay']; //사용금액
	//근로계약서 여부
	if($row['contract_employment'] == "1") $contract_employment = "YES";
	else if($row['contract_employment'] == "2") $contract_employment = "NO";
	else $contract_employment = "";
	//취업규칙서/급여정비 필요 여부
	if($row['rules_pay'] == "1") $rules_pay = "YES";
	else if($row['rules_pay'] == "2") $rules_pay = "NO";
	else $rules_pay = "";
	if($is_damdang == "ok") {
?>
								<b>기존 사용 프로그램</b>
								<input name="use_program" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['use_program']?>" maxlength="100">
								<br>사용금액
								<input name="use_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['use_pay']?>" maxlength="100">
								<br>
								<b>근로계약서 유무</b>
								<input type="radio" name="contract_employment" value="1" <? if($row['contract_employment'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="contract_employment" value="2" <? if($row['contract_employment'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>취업규칙서/급여정비 필요 유무</b>
								<input type="radio" name="rules_pay" value="1" <? if($row['rules_pay'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rules_pay" value="2" <? if($row['rules_pay'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($use_program) echo "<b>사용 프로그램</b> : ".$use_program."<br>";
		if($use_pay) echo "<b>사용금액</b> : ".$use_pay."<br>";
		if($contract_employment) echo "<b>근로계약서 유무</b> : ".$contract_employment."<br>";
		if($rules_pay) echo "<b>취업규칙서/급여정비 필요 유무</b> : ".$rules_pay;
	}
?>
							</td>
							<td class="tdrow" width="">
<?
	//이지노무 의뢰
	$easynomu_request = explode(',',$row['easynomu_request']);
	$easynomu_request_text = array("기본설치","급여테이블정비","취업규칙서작성");
	//셋팅비
	if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
	else $setting_pay = "";
	//월정액
	if($row['month_pay']) $month_pay = number_format($row['month_pay']); 
	else $month_pay = "";
	$easynomu_etc = $row['easynomu_etc']; //기타사항
	if($is_damdang == "ok") {
?>
								<b>이지노무 의뢰</b><br>
								<input type="checkbox" name="easynomu_request1"  value="1" <? if($easynomu_request[0] == 1) echo "checked"; ?> style="vertical-align:middle">기본설치
								<input type="checkbox" name="easynomu_request2" value="1" <? if($easynomu_request[1] == 1) echo "checked"; ?> style="vertical-align:middle">급여테이블정비
								<input type="checkbox" name="easynomu_request3" value="1" <? if($easynomu_request[2] == 1) echo "checked"; ?> style="vertical-align:middle">취업규칙서작성
								<br><b>셋팅비</b>
								<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$setting_pay?>" maxlength="20">
								<b>월정액</b>
								<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$month_pay?>" maxlength="20">
								<br><b>기타사항</b>
								<input name="easynomu_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['easynomu_etc']?>" maxlength="100">
<?
	} else {
		if($row['easynomu_request'] && $row['easynomu_request'] != ",,,") {
			echo "<b>이지노무 의뢰</b> : ";
			for ($i=0; $i<=2; $i++) {
				if($easynomu_request[$i]) echo $easynomu_request_text[$i].". ";
			}
			echo "<br>";
		}
		if($setting_pay) echo "<b>셋팅비</b> : ".$setting_pay."<br>";
		if($month_pay) echo "<b>월정액</b> : ".$month_pay."<br>";
		if($easynomu_etc) echo "<b>기타사항</b> : ".$easynomu_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">메모<font color="red"></font></td>
							<td nowrap class="tdrow"  colspan="2">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo5" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo5?></textarea>
<?
	} else {
		if($memo5) echo "<pre>".$memo5."</pre>";
	}
?>
							</td>
						</tr>
					</table>
				</div><!--프로그램 종료-->
			</div><!--컨설팅 의뢰서 종료-->
			<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<a name="16001"><!--정책자금--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='policy_fund_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td>
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											<span>정책자금</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td>
									</tr> 
								</table> 
							</td> 
							<td width="2"></td> 
							<td valign="bottom" style="font-weight:bold;">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="policy_fund_chk" value="1" <? if($row['policy_fund_chk'] == 1) echo "checked"; ?> style="vertical-align:middle">정책자금 의뢰 시 체크 하십시오.
								<span style="color:red;">(정책자금 정보 입력 후 미 체크 시 저장 되지 않습니다.)</span>
<?
	}
?>
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--단일 DIV 묶음-->
					<div  id="policy_fund_div" style="<? if($w && $row['policy_fund_chk'] != "1") echo "display:none"; ?>">
<?
	if($w == "u") {
		//정책자금DB
		$sql_policy = " select * from policy_fund where com_code='$com_code' ";
		$row_policy = sql_fetch($sql_policy);
		$sql_policy_opt = " select * from policy_fund_opt where com_code='$com_code' ";
		$row_policy_opt = sql_fetch($sql_policy_opt);
	}
	$area = $row_policy['area']; //지역
	$reg_factory_array = array("","유","무");
	$reg_factory = $row_policy['reg_factory'];
	$reg_factory_text = $reg_factory_array[$reg_factory];
?>
					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
						<tr>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역</td>
							<td nowrap  class="tdrow" width="170">
<? if($is_damdang == "ok") { ?>
								<input name="area" type="text" class="textfm" style="width:120px;" value="<?=$row_policy['area']?>" maxlength="50">
<?
	} else {
		if($area) echo $area;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장등록증</td>
							<td nowrap class="tdrow">
<? if($is_damdang == "ok") { ?>
								<select name="reg_factory" class="selectfm" onchange="">
									<option value="">선택</option>
									<option value="1" <? if($row_policy['reg_factory'] == 1) echo "selected"; ?>>유</option>
									<option value="2" <? if($row_policy['reg_factory'] == 2) echo "selected"; ?>>무</option>
								</select>
<?
	} else {
		if($reg_factory_text) echo $reg_factory_text;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신용등급</td>
							<td nowrap  class="tdrow">
								기업등급
<? if($is_damdang == "ok") { ?>
								<input name="credit_com" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row_policy['credit_com']?>" maxlength="12">
<?
	} else {
		if($row_policy['credit_com']) echo ": ".$row_policy['credit_com'];
	}
?>
								개인등급
<? if($is_damdang == "ok") { ?>
								<input name="credit_per" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row_policy['credit_per']?>" maxlength="12">
<?
	} else {
		if($row_policy['credit_per']) echo ": ".$row_policy['credit_per'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">물건현황<font color="red"></font></td>
							<td nowrap  class="tdrow">
<? if($is_damdang == "ok") { ?>
								<select name="property" class="selectfm" onchange="" style="width:60px">
									<option value="">선택</option>
									<option value="1" <? if($row_policy['property'] == 1) echo "selected"; ?>>자가</option>
									<option value="2" <? if($row_policy['property'] == 2) echo "selected"; ?>>임대</option>
									<option value="3" <? if($row_policy['property'] == 3) echo "selected"; ?>>전대</option>
									<option value="4" <? if($row_policy['property'] == 4) echo "selected"; ?>>기타</option>
								</select>
<?
	} else {
		$property_array = array("","자가","임대","전대","기타");
		$property = $row_policy['property'];
		$property_text = $property_array[$property];
		if($property_text) echo $property_text;
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">임대내용<font color="red"></font></td>
							<td nowrap  class="tdrow">
								전세
<? if($is_damdang == "ok") { ?>
								<input name="charter" type="text" class="textfm" style="width:70px;" value="<?=$row_policy['charter']?>" maxlength="12">
<?
	} else {
		if($row_policy['charter']) echo ": ".$row_policy['charter'];
	}
?>
								월세
<? if($is_damdang == "ok") { ?>
								<input name="rent_month" type="text" class="textfm" style="width:70px;" value="<?=$row_policy['rent_month']?>" maxlength="12">
<?
	} else {
		if($row_policy['rent_month']) echo ": ".$row_policy['rent_month'];
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">평수<font color="red"></font></td>
							<td nowrap  class="tdrow">
								부지
<? if($is_damdang == "ok") { ?>
								<input name="area_site" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_site']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_site']) echo ": ".$row_policy['area_site'];
	}
?>
								건축물
<? if($is_damdang == "ok") { ?>
								<input name="area_building" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_building']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_building']) echo ": ".$row_policy['area_building'];
	}
?>
								설비
<? if($is_damdang == "ok") { ?>
								<input name="area_facility" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_facility']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_facility']) echo ": ".$row_policy['area_facility'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">상담메모</td>
							<td nowrap  class="tdrow" colspan="5">
								<textarea name="memo_policy" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="내용" required><?=$row_policy[memo]?></textarea>
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk_center" width="96">매출현황</td>
							<td nowrap class="tdrow" style="padding:" width="" colspan="8">
								<b>최근3년 매출현황</b>
								2012
<? if($is_damdang == "ok") { ?>
								<input name="sale_2012" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2012']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2012']) echo ": ".$row_policy['sale_2012'];
	}
?>
								2013
<? if($is_damdang == "ok") { ?>
								<input name="sale_2013" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2013']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2013']) echo ": ".$row_policy['sale_2013'];
	}
?>
								2014
<? if($is_damdang == "ok") { ?>
								<input name="sale_2014" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2014']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2014']) echo ": ".$row_policy['sale_2014'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center" width="" rowspan="4">기관<br>대출내역</td>
							<td nowrap class="tdrowk_center" width="">주관</td>
							<td nowrap class="tdrowk_center" width="114">기보</td>
							<td nowrap class="tdrowk_center" width="114">신보</td>
							<td nowrap class="tdrowk_center" width="114">보증재단</td>
							<td nowrap class="tdrowk_center" width="114">중진공</td>
							<td nowrap class="tdrowk_center" width="114">시자금</td>
							<td nowrap class="tdrowk_center" width="114">도자금</td>
							<td nowrap class="tdrowk_center" width="114">중기청</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">은행</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="bank_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['bank_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['bank_'.$i]) echo $row_policy_opt['bank_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">금액</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="amount_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['amount_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['amount_'.$i]) echo $row_policy_opt['amount_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">금리</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="interst_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['interst_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['interst_'.$i]) echo $row_policy_opt['interst_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
					</table>
					<div style="height:2px;font-size:0px"></div>

					<!-- 입력폼 -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk_center" width="96" rowspan="6">금융권<br>대출내역</td>
							<td nowrap class="tdrowk_center" width="">은행</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_bank_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_bank_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_bank_'.$i]) echo $row_policy_opt['lend_bank_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">대출구분</td>
<?
	$lend_kind_array = array("","시설","운전","어음","매출","구매자금","기타");
	$lend_kind_text = array(); 
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="192">
<? if($is_damdang == "ok") { ?>
								<select name="lend_kind_<?=$i?>" class="selectfm" onchange="" style="width:100%">
									<option value="">선택</option>
									<option value="1" <? if($row_policy_opt['lend_kind_'.$i] == 1) echo "selected"; ?>>시설</option>
									<option value="2" <? if($row_policy_opt['lend_kind_'.$i] == 2) echo "selected"; ?>>운전</option>
									<option value="3" <? if($row_policy_opt['lend_kind_'.$i] == 3) echo "selected"; ?>>어음</option>
									<option value="4" <? if($row_policy_opt['lend_kind_'.$i] == 4) echo "selected"; ?>>매출</option>
									<option value="5" <? if($row_policy_opt['lend_kind_'.$i] == 5) echo "selected"; ?>>구매자금</option>
									<option value="6" <? if($row_policy_opt['lend_kind_'.$i] == 6) echo "selected"; ?>>기타</option>
								</select>
<?
		} else {
			$lend_kind = $row_policy_opt['lend_kind_'.$i];
			$lend_kind_text[$i] = $lend_kind_array[$lend_kind];
			if($lend_kind_text[$i]) echo $lend_kind_text[$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">금액</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_amount_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_amount_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_amount_'.$i]) echo $row_policy_opt['lend_amount_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">금리</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_interst_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_interst_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_interst_'.$i]) echo $row_policy_opt['lend_interst_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">담보내용</td>
							<td nowrap class="tdrow" width="" colspan="4">
<? if($is_damdang == "ok") { ?>
								<input name="security" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['security']?>" maxlength="90">
<?
	} else {
		if($row_policy_opt['security']) echo $row_policy_opt['security'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">주거래은행</td>
							<td nowrap class="tdrow" width="" colspan="4">
<? if($is_damdang == "ok") { ?>
								<input name="primary_bank" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['primary_bank']?>" maxlength="90">
<?
	} else {
		if($row_policy_opt['primary_bank']) echo $row_policy_opt['primary_bank'];
	}
?>
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--댑메뉴 -->

					<!-- 입력폼 -->
					<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
						<tr>
							<td nowrap class="tdrowk_center" width="96" rowspan="">대출의뢰금액</td>
							<td nowrap  class="tdrow" width="" colspan="">
								정책자금
<? if($is_damdang == "ok") { ?>
								<input name="loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_policy']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_policy']) echo ": ".$row_policy_opt['loan_policy'];
	}
?>
								금융자금
<? if($is_damdang == "ok") { ?>
								<input name="loan_finance" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_finance']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_finance']) echo ": ".$row_policy_opt['loan_finance'];
	}
?>
								기타
<? if($is_damdang == "ok") { ?>
								<input name="loan_etc" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_etc']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_etc']) echo ": ".$row_policy_opt['loan_etc'];
	}
?>
							</td>
						</tr>
					</table>
					</div><!--단일 DIV 묶음 종료-->
<?
}
//협력사 제외 IF문 end
?>
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
							<!--<div style="color:red;width:296px;text-align:center;">정책자금의뢰 시 체크 필수입니다.</div>-->
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
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_list.php?search_ok=branch&page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">목 록</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_print_request?>" target="">의뢰서출력</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
	//삭제 권한 : 최고관리자, 임영진
	if($member['mb_level'] == 10 || $member['mb_id'] == "kcmc0331") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_com('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>삭제</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } else { ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_request('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>삭제요청</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">접수처리현황</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
<?
	//직무교육 의뢰 여부 시작
	if($row['job_request_if']) {
		$sql_job = " select idx from job_education where com_code='$id' ";
		$result_job = sql_query($sql_job);
		$row_job=mysql_fetch_array($result_job);
		$idx = $row_job['idx'];
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./job_education_view.php?w=<?=$w?>&id=<?=$idx?>" target="">사업주훈련</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

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
	include "inc/client_comment_only.php";
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
