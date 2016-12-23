<?
$sub_menu = "1900300";
include_once("./_common.php");

//현재 년도
$year_now = date("Y");
if(!$stx_search_year) $stx_search_year = $year_now;

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code ";
	//본사 영업사원 권한
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//담당매니저 코드 체크
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$mb_id = $member['mb_id'];
	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	//지사 딜러 권한
	if($member['mb_level'] == 4) $sql_search = " where a.com_code = b.com_code and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//필수 검색조건 한전 고객번호 150812
$sql_search .= " and a.electric_charges_no != '' ";
//사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//사업장관리번호
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//사업자등록번호
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//팩스번호
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//지사
if($stx_man_cust_name) {
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code='110' or a.damdang_code='111') ";
	else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//사업자등록번호 미등록
if($stx_biz_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no = '-' or a.biz_no = '') ";
	$sql_search .= " ) ";
}
//사업장관리번호 미등록
if($stx_t_no_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno = '-' or a.t_insureno = '') ";
	$sql_search .= " ) ";
}
//주소검색
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%') ";
	$sql_search .= " ) ";
}
//지역별검색
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " and ( ";
if($stx_area_not) {
	$area_not = "not";
	$area_or_var = "and";
} else {
	$area_not = "";
	$area_or_var = "or";
}
$area_or = "";
if($stx_area1) {
	$sql_search .= " (a.com_juso $area_not like '서울%') ";
	$area_or = $area_or_var;
}
if($stx_area2) {
	$sql_search .= " $area_or (a.com_juso $area_not like '부산%') ";
	$area_or = $area_or_var;
}
if($stx_area3) {
	$sql_search .= " $area_or (a.com_juso $area_not like '인천%') ";
	$area_or = $area_or_var;
}
if($stx_area4) {
	$sql_search .= " $area_or (a.com_juso $area_not like '대구%') ";
	$area_or = $area_or_var;
}
if($stx_area5) {
	$sql_search .= " $area_or (a.com_juso $area_not like '대전%') ";
	$area_or = $area_or_var;
}
if($stx_area6) {
	$sql_search .= " $area_or (a.com_juso $area_not like '광주%') ";
	$area_or = $area_or_var;
}
if($stx_area7) {
	$sql_search .= " $area_or (a.com_juso $area_not like '울산%') ";
	$area_or = $area_or_var;
}
if($stx_area8) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경기%') ";
	$area_or = $area_or_var;
}
if($stx_area9) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경북%' $area_or_var a.com_juso $area_not like '경상북도%') ";
	$area_or = $area_or_var;
}
if($stx_area10) {
	$sql_search .= " $area_or (a.com_juso $area_not like '경남%' $area_or_var a.com_juso $area_not like '경상남도%') ";
	$area_or = $area_or_var;
}
if($stx_area11) {
	$sql_search .= " $area_or (a.com_juso $area_not like '전북%' $area_or_var a.com_juso $area_not like '전라북도%') ";
	$area_or = $area_or_var;
}
if($stx_area12) {
	$sql_search .= " $area_or (a.com_juso $area_not like '전남%' $area_or_var a.com_juso $area_not like '전라남도%') ";
	$area_or = $area_or_var;
}
if($stx_area13) {
	$sql_search .= " $area_or (a.com_juso $area_not like '충북%' $area_or_var a.com_juso $area_not like '충청북도%') ";
	$area_or = $area_or_var;
}
if($stx_area14) {
	$sql_search .= " $area_or (a.com_juso $area_not like '충남%' $area_or_var a.com_juso $area_not like '충청남도%') ";
	$area_or = $area_or_var;
}
if($stx_area15) {
	$sql_search .= " $area_or (a.com_juso $area_not like '강원%') ";
	$area_or = $area_or_var;
}
if($stx_area16) {
	$sql_search .= " $area_or (a.com_juso $area_not like '제주%') ";
	$area_or = $area_or_var;
}
if($stx_area17) {
	$sql_search .= " $area_or (a.com_juso $area_not like '세종%') ";
}
if($stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) $sql_search .= " ) ";
//한전 고객번호 150831
if($stx_electric_charges_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.electric_charges_no like '$stx_electric_charges_no%') ";
	$sql_search .= " ) ";
}
//업종분류검색
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) {
	$sql_search .= " and ( ";
}
if($stx_industry_not) {
	$industry_not = "not";
	$industry_or_var = "and";
} else {
	$industry_not = "";
	$industry_or_var = "or";
}
$industry_or = "";
if($stx_industry1) {
	$sql_search .= " (a.uptae $industry_not like '%제조%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry2) {
	$sql_search .= " $industry_or (a.uptae like '%서비스%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry3) {
	$sql_search .= " $industry_or (a.uptae like '%건설%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry4) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%보육시설%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry5) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%사회복지%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry6) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%교육%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry7) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%의료%' $industry_or_var a.uptae $industry_not like '%제약%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry8) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%도매%' $industry_or_var a.uptae $industry_not like '%소매%' $industry_or_var a.uptae $industry_not like '%유통%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry9) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%디자인%' $industry_or_var a.uptae $industry_not like '%출판%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry10) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%음식점%' $industry_or_var a.uptae $industry_not like '%숙박%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry11) {
	$sql_search .= " $industry_or (a.uptae $industry_not like '%기관%' $industry_or_var a.uptae $industry_not like '%협회%' $industry_or_var a.uptae $industry_not like '%단체%') ";
	$industry_or = $industry_or_var;
}
if($stx_industry99) {
	if(!$industry_not) $sql_search .= " $industry_or (a.uptae = '' $industry_or_var a.uptae = '-') ";
	else $sql_search .= " $industry_or (a.uptae != '' $industry_or_var a.uptae != '-') ";
}
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11 || $stx_industry99) $sql_search .= " ) ";
//처리현황, 최종완료 기본 설정
if(!$stx_process) $stx_process = "sms";
if($stx_process) {
	$sql_search2 = " and ( ";
	if($stx_process == "no") $sql_search2 .= " (a.electric_charges_process = '') ";
	//최종완료9, 수금진행14 모두 표시 160908
	else if($stx_process == "sms") $sql_search2 .= " (a.electric_charges_process = '9' or a.electric_charges_process = '14') ";
	else $sql_search2 .= " (a.electric_charges_process = '$stx_process') ";
	$sql_search2 .= " ) ";
}
//스케줄관리
if ($stx_electric_charges_visit_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " a.electric_charges_visit_kind = '$stx_electric_charges_visit_kind' ";
	$sql_search .= " ) ";
}
//비용 발생 여부 160127
if($stx_payments) $sql_search .= " and a.electric_charges_payments != '' ";
if($stx_cost) $sql_search .= " and a.electric_charges_cost != '' ";
//계약전력, 천단위 콤마 제거 후 비교 160202
if($stx_electric_charges_watt1 != "") $sql_search .= " and ( replace(a.electric_charges_watt,',','') >= $stx_electric_charges_watt1 and replace(a.electric_charges_watt,',','') <= $stx_electric_charges_watt2) ";
//분납, 일시납 구분 160909
if($installment == 1) $sql_search .= " and a.electric_charges_installment != '' ";
else if($installment == 2) $sql_search .= " and a.electric_charges_installment = '' ";

//정렬
if (!$sst) {
    $sst = "a.electric_charges_regdt";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_search2
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 40;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_03.gif";
$sub_title = "전기요금(고객관리)";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 24;

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok."&stx_process=".$stx_process;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_electric_charges_no=".$stx_electric_charges_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind."&stx_payments=".$stx_payments."&stx_cost=".$stx_cost."&stx_electric_charges_watt1=".$stx_electric_charges_watt1."&stx_electric_charges_watt2=".$stx_electric_charges_watt2."&installment=".$installment;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	//alert("데이터 삭제는 관리자에게 문의하십시오.");
	//return;
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("선택된 데이터가 없습니다.");
	 return;
	} else{
		if(confirm("정말 삭제하시겠습니까?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="electric_charges_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./electric_charges_etc.php?id="+id, "electric_charges_etc", "scrollbars=yes,width=600,height=360");
	return;
}
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
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function goCheck_ok(obj) {
	//alert(obj.name+" "+obj.value);
	var id = obj.name.substring(9,14);
	//alert(id);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "electric_charges_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
//전기요금계산 160212
function pop_electric_calculate() {
	var ret = window.open("pop_electric_calculate.php", "pop_electric_calculate", "width=450,height=420,scrollbars=no");
	return;
}
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>
					<td><a href="electric_charges_list.php"><img src="<?=$top_sub_title?>" border="0" alt="전기요금컨설팅" /></a></td>
					<td>
<?
$title_main_no = "19";
//딜러 제외한 모두 표시
if($member['mb_profile'] < 110 && $member['mb_level'] != 4) include "inc/sub_menu.php";
?>
					</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
				<tr>
					<td valign="top" style="padding:10px 0 0 0">
						<!--타이틀 -->	
<?
//현대 전체 사용자 열람 가능
$is_admin = "super";
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
						<!--데이터 -->
						<table border="0" cellpadding="0" cellspacing="0"> 
							<tr> 
								<td id=""> 
									<table border="0" cellpadding="0" cellspacing="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											검색
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
						<!--검색 -->
						<form name="searchForm" method="get">
							<input type="hidden" name="search_ok" />
							<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
							<!--데이터 -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="100"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭</td>
									<td nowrap class="tdrow" width="150">
										<input name="stx_comp_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="110"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
									<td nowrap class="tdrow" width="200">
										<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자명</td>
									<td nowrap class="tdrow" width="112">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
									<td nowrap class="tdrow" width="112" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
									<td nowrap class="tdrow" width="98">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">전체</option>
<?
$damdang_code = $stx_man_cust_name;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">담당자</td>
									<td nowrap class="tdrow">
										<input name="stx_manage_name" type="text" class="textfm" style="width:120px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">사업장관리번호</td>
									<td nowrap class="tdrow">
										<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">전화번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">팩스번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">열람</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name2" class="selectfm">
											<option value="">전체</option>
<?
$stx_man_cust_name = $stx_man_cust_name2;
//협력사, 제휴점, 광주딜러 열람에서 제외
$stx_man_cust_name2_except = 1;
include "inc/stx_man_cust_name.php";
$stx_man_cust_name2_except = "";
?>
										</select>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소검색</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_addr"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역검색<input type="checkbox" name="stx_area_not" value="1" <? if($stx_area_not == 1) echo "checked"; ?> style="vertical-align:middle" title="검색제외"><span style="font-size:8pt;">제외</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_area1" value="1" <? if($stx_area1 == 1) echo "checked"; ?> style="vertical-align:middle">서울
										<input type="checkbox" name="stx_area2" value="1" <? if($stx_area2 == 1) echo "checked"; ?> style="vertical-align:middle">부산
										<input type="checkbox" name="stx_area3" value="1" <? if($stx_area3 == 1) echo "checked"; ?> style="vertical-align:middle">인천
										<input type="checkbox" name="stx_area4" value="1" <? if($stx_area4 == 1) echo "checked"; ?> style="vertical-align:middle">대구
										<input type="checkbox" name="stx_area5" value="1" <? if($stx_area5 == 1) echo "checked"; ?> style="vertical-align:middle">대전
										<input type="checkbox" name="stx_area6" value="1" <? if($stx_area6 == 1) echo "checked"; ?> style="vertical-align:middle">광주
										<input type="checkbox" name="stx_area7" value="1" <? if($stx_area7 == 1) echo "checked"; ?> style="vertical-align:middle">울산
										<input type="checkbox" name="stx_area8" value="1" <? if($stx_area8 == 1) echo "checked"; ?> style="vertical-align:middle">경기
										<input type="checkbox" name="stx_area9" value="1" <? if($stx_area9 == 1) echo "checked"; ?> style="vertical-align:middle">경북
										<input type="checkbox" name="stx_area10" value="1" <? if($stx_area10 == 1) echo "checked"; ?> style="vertical-align:middle">경남
										<input type="checkbox" name="stx_area11" value="1" <? if($stx_area11 == 1) echo "checked"; ?> style="vertical-align:middle">전북
										<input type="checkbox" name="stx_area12" value="1" <? if($stx_area12 == 1) echo "checked"; ?> style="vertical-align:middle">전남
										<input type="checkbox" name="stx_area13" value="1" <? if($stx_area13 == 1) echo "checked"; ?> style="vertical-align:middle">충북
										<input type="checkbox" name="stx_area14" value="1" <? if($stx_area14 == 1) echo "checked"; ?> style="vertical-align:middle">충남
										<input type="checkbox" name="stx_area15" value="1" <? if($stx_area15 == 1) echo "checked"; ?> style="vertical-align:middle">강원
										<input type="checkbox" name="stx_area16" value="1" <? if($stx_area16 == 1) echo "checked"; ?> style="vertical-align:middle">제주
										<input type="checkbox" name="stx_area17" value="1" <? if($stx_area17 == 1) echo "checked"; ?> style="vertical-align:middle">세종
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">고객번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_electric_charges_no"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_electric_charges_no?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종분류<input type="checkbox" name="stx_industry_not" value="1" <? if($stx_industry_not == 1) echo "checked"; ?> style="vertical-align:middle" title="검색제외"><span style="font-size:8pt;">제외</span></td>
									<td nowrap class="tdrow" colspan="7">
										<input type="checkbox" name="stx_industry1" value="1" <? if($stx_industry1 == 1) echo "checked"; ?> style="vertical-align:middle">제조
										<input type="checkbox" name="stx_industry2" value="1" <? if($stx_industry2 == 1) echo "checked"; ?> style="vertical-align:middle">서비스
										<input type="checkbox" name="stx_industry3" value="1" <? if($stx_industry3 == 1) echo "checked"; ?> style="vertical-align:middle">건설
										<input type="checkbox" name="stx_industry4" value="1" <? if($stx_industry4 == 1) echo "checked"; ?> style="vertical-align:middle">보육시설
										<input type="checkbox" name="stx_industry5" value="1" <? if($stx_industry5 == 1) echo "checked"; ?> style="vertical-align:middle">사회복지
										<input type="checkbox" name="stx_industry6" value="1" <? if($stx_industry6 == 1) echo "checked"; ?> style="vertical-align:middle">교육업
										<input type="checkbox" name="stx_industry7" value="1" <? if($stx_industry7 == 1) echo "checked"; ?> style="vertical-align:middle">의료/제약
										<input type="checkbox" name="stx_industry8" value="1" <? if($stx_industry8 == 1) echo "checked"; ?> style="vertical-align:middle">판매/유통
										<input type="checkbox" name="stx_industry9" value="1" <? if($stx_industry9 == 1) echo "checked"; ?> style="vertical-align:middle">디자인/출판
										<input type="checkbox" name="stx_industry10" value="1" <? if($stx_industry10 == 1) echo "checked"; ?> style="vertical-align:middle">음식점/숙박
										<input type="checkbox" name="stx_industry11" value="1" <? if($stx_industry11 == 1) echo "checked"; ?> style="vertical-align:middle">기관/협회
										<input type="checkbox" name="stx_industry99" value="1" <? if($stx_industry99 == 1) echo "checked"; ?> style="vertical-align:middle">미분류
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">스케줄관리</td>
									<td nowrap class="tdrow">
										<select name="stx_electric_charges_visit_kind" class="selectfm">
											<option value="">전체</option>
											<option value="방문" <? if($stx_electric_charges_visit_kind == "방문") echo "selected"; ?>>방문</option>
											<option value="재연락" <? if($stx_electric_charges_visit_kind == "재연락") echo "selected"; ?>>재연락</option>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">비용발생여부</td>
									<td nowrap class="tdrow" colspan="">
										<input type="checkbox" name="stx_payments" value="1" <? if($stx_payments == 1) echo "checked"; ?> style="vertical-align:middle" title="">한전불입금
										<input type="checkbox" name="stx_cost" value="1" <? if($stx_cost == 1) echo "checked"; ?> style="vertical-align:middle" title="">공사비
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">계약전력</td>
									<td nowrap class="tdrow" colspan="3">
										<input name="stx_electric_charges_watt1"  type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$stx_electric_charges_watt1?>" maxlength="4" /> ~
										<input name="stx_electric_charges_watt2"  type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$stx_electric_charges_watt2?>" maxlength="4" />
<?
	//대표, 관리자 권한 160212
	if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "master") {
?>
										<!--<a href="#pop_electric_calculate" onclick="pop_electric_calculate();return false;" onkeypress="this.onclick" style="margin-left:10px;font-weight:bold;">[전기요금계산]</a>-->
<?
	}
?>
									</td>
<?
} else {
?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow" colspan="3">
									</td>
<?
}
?>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">수금</td>
									<td nowrap class="tdrow" width="98">
										<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;margin-left:0;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="electric_charges_collection.php">수금관리</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
									</td>
<? } else { ?>
									<td nowrap class="tdrowk"></td>
									<td nowrap class="tdrow">
									</td>
<? } ?>
								</tr>
							</table>
						</form>
<?
//진행현황 처리현황 카운트
$installment = 0;
$allowance = 0;
//기본 검색 : 
$sql_search = "where a.com_code = b.com_code and (a.electric_charges_process = '9' or a.electric_charges_process = '14') ";
//본사, 지사 구분 검색
if($damdang_code != "all" && $damdang_code) {
	$sql_search_add = " and a.damdang_code='$damdang_code' ";
} 
//사업장 기본정보 DB : 전기요금컨설팅
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
} else if($member['mb_level'] == 4) {
	//지사 딜러 권한
	$sql_search_add2 = " and ( b.manage_cust_numb='$manage_code' ) ";
}
//$sql_electric_charges = " select a.electric_charges_process from com_list_gy a, com_list_gy_opt b where a.com_code=b.com_code and a.electric_charges_no != '' $sql_search_add $sql_search_add2 ";
$sql_electric_charges = " select a.electric_charges_installment from com_list_gy a, com_list_gy_opt b ";
$sql_electric_charges .= " $sql_search $sql_search_add $sql_search_add2 ";
//echo $sql_electric_charges;
$result_electric_charges = sql_query($sql_electric_charges);
for ($i=0; $row_electric_charges=mysql_fetch_assoc($result_electric_charges); $i++) {
	if($row_electric_charges['electric_charges_installment']) $installment++;
	else $allowance++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/erp_job_education_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_sms.php';">
								<div class="ftwhite_div" style="margin:11px 0 0 56px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_sms1.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_sms.php?<?=$qstr?>&installment=1';">
								<div class="ftwhite_div"><?=$installment?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_sms2.png');margin:5px 10px 0 0;" onclick="location.href='electric_charges_sms.php?<?=$qstr?>&installment=2';">
								<div class="ftwhite_div"><?=$allowance?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
									<a href="electric_charges_excel.php?<?=$qstr?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
								</td>
							</tr>
						</table>
						<div style="height:1px;font-size:0px"></div>
<? } ?>
						<!--댑메뉴 -->
						<table border="0" cellspacing="0" cellpadding="0"> 
							<tr>
								<td id=""> 
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif" /></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											리스트
											</td> 
											<td><img src="images/g_tab_on_rt.gif" /></td> 
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

						<!--리스트 -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="idx">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
								<tr>
									<td class="tdhead_center" rowspan="2" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" rowspan="2" width="40">No</td>
									<td class="tdhead_center" rowspan="2" width="70">등록일자</td>
									<td class="tdhead_center" rowspan="2" width="188">사업장명</td>
									<td class="tdhead_center" rowspan="2" width="84">고객번호<br />청구일</td>
									<td class="tdhead_center" rowspan="2" width="">대표자HP<br />담당자HP</td>
									<td class="tdhead_center" rowspan="2" width="60">수금구분<br />요금조회</td>
									<td class="tdhead_center" rowspan="2" width="50">결과표</td>
									<td class="tdhead_center" colspan="12">문자발송(<?=$stx_search_year?>)</td>
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
									<td class="tdhead_center" rowspan="2" width="60">계약전력</td>
<? } ?>
									<td class="tdhead_center" rowspan="2" width="82" style="padding:4px 0 2px 0;">전기료(1년간)</td>
									<td class="tdhead_center" rowspan="2" width="82" style="padding:4px 0 2px 0;">절감예상금액</td>
									<td class="tdhead_center" rowspan="2" width="110">담당자</td>
								</tr>
									<tr>
										<td class="tdhead_center" width="20">1</td>
										<td class="tdhead_center" width="20">2</td>
										<td class="tdhead_center" width="20">3</td>
										<td class="tdhead_center" width="20">4</td>
										<td class="tdhead_center" width="20">5</td>
										<td class="tdhead_center" width="20">6</td>
										<td class="tdhead_center" width="20">7</td>
										<td class="tdhead_center" width="20">8</td>
										<td class="tdhead_center" width="20">9</td>
										<td class="tdhead_center" width="20">10</td>
										<td class="tdhead_center" width="20">11</td>
										<td class="tdhead_center" width="20">12</td>
									</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//NO 넘버
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row['com_code'];
	//등록일자
	$date1 = substr($row['electric_charges_regdt'],0,10); //날짜표시형식변경
	$electric_charges_regdt_time = substr($row['electric_charges_regdt'],11,8); //시간만 표시
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$electric_charges_regdt = $year.".".$month.".".$day."";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//시업장 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 28, "..");
	if($row['electric_charges_memo']) $memo_full = $row['electric_charges_memo'];
	else $memo_full = "상담메모 없음";
	$memo = cut_str($memo_full, 48, "..");
	if($row['electric_charges_etc']) $etc_full = $row['electric_charges_etc'];
	else $etc_full = "";
	$etc = "<br>".cut_str($etc_full, 48, "..");
	//최근 수정일자 NEW 표시
	//echo date("Y-m-d H:i:s", time() - 96 * 3600);
	if($row['editdt'] >= date("Y-m-d H:i:s", time() - 24 * 3600)) { 
		$etc_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$etc_new = "";
	}
	$etc = $etc.$etc_new;
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) {
		$branch = $man_cust_name_arry[$damdang_code];
		$damdang_code2 = $row['damdang_code2'];
		//광주딜러 -> 광주로 표시
		if($damdang_code >= 112 && $damdang_code <= 118) {
			$branch = $man_cust_name_arry[$damdang_code2];
		} else {
			if($damdang_code2) {
				$branch .= ">".$man_cust_name_arry[$damdang_code2];
			}
		}
	} else {
		$branch = "-";
	}
	//고객번호
	if($row['electric_charges_no']) {
		$electric_charges_no = $row['electric_charges_no'];
	} else {
		$electric_charges_no = "-";
	}
	//법인등록번호
	if($row['electric_charges_bupin']) {
		$electric_charges_bupin = $row['electric_charges_bupin'];
	} else {
		$electric_charges_bupin = "-";
	}
	//한전 가입자 주민등록번호
	if($row['electric_charges_ssnb']) {
		$electric_charges_ssnb = $row['electric_charges_ssnb'];
	} else {
		$electric_charges_ssnb = "-";
	}
	//데이터 없을 경우 - 표시 : 전화번호, 휴대폰
	if(!$row['com_tel']) $row['com_tel'] = "-";
	if(!$row['com_hp']) $row['com_hp'] = "-";
	if(!$row['area']) $row['area'] = "-";
	//담당자
	if(!$row['manage_cust_name']) {
		$manager = "-";
	} else {
		$manager = $row['manage_cust_name'];
	}
	if(!$row['writer_tel']) $row['writer_tel'] = "-";
	if(!$row['process_date']) $row['process_date'] = "-";
	if(!$row['process_date2']) $row['process_date2'] = "-";
	//계약전력
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//전기료(1년간)
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";
	//한전불입금
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else $electric_charges_payments = "-";
	//공사비
	if($row['electric_charges_cost']) $electric_charges_cost = $row['electric_charges_cost'];
	else $electric_charges_cost = "-";
	//공사비2
	if($row['electric_charges_cost2']) $electric_charges_cost2 = "~".$row['electric_charges_cost2']."만";
	else $electric_charges_cost2 = "";
	//절감예상금액
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else $electric_charges_reduce = "-";
	//수수료
	if($row['electric_charges_commission']) $electric_charges_commission = $row['electric_charges_commission'];
	else $electric_charges_commission = "-";
	//연도
	$revert_year = $stx_search_year;
	//월별 표시
	for($m=1;$m<=12;$m++) {
		$month = $m;
		$sql_account = " select electric_before_contrast from electric_manage where com_code='$id' and year='$revert_year' and month='$month' ";
		//echo $sql_account;
		$row_account = sql_fetch($sql_account);
		if($row_account['electric_before_contrast']) $account[$m] = "O";
		else $account[$m] = "";
	}
	//요금조회 가능일
	if($row['electric_date_request']) {
		$electric_date_request_arry = explode("~", $row['electric_date_request']);
		//청구일 ~ 문자 없을 경우 - 문자로 배열 생성
		if(!$electric_date_request_arry[1]) $electric_date_request_arry = explode("-", $row['electric_date_request']);
		$electric_date_request_arry[1] = (int)str_replace("일", "", $electric_date_request_arry[1]);
		//7일에서 9일로 변경 임현미 의견 160510 -> 10일 임현미 160926
		$electric_date_inquiry = date("d", strtotime("2016-04-".$electric_date_request_arry[1]." + 10 days"));
		$electric_date_inquiry_day = $electric_date_inquiry."일";
	}
	//대표자HP
	if(!$row['boss_hp']) $row['boss_hp'] = "-";
	//분납
	if($row['electric_charges_installment']) $electric_charges_installment = $row['electric_charges_installment']."회";
	else $electric_charges_installment = "일시납";
	//결과표 160909
	$electric_charges_file_check = explode(',',$row['electric_charges_file_check']);
	if($electric_charges_file_check[1] == 1) $electric_charges_file_check2 = "O";
	else $electric_charges_file_check2 = "";
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$electric_charges_regdt_time?>"><?=$electric_charges_regdt?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="electric_charges_collection_view.php?w=u&id=<?=$id?>" style="font-weight:bold"><?=$com_name?></a>
										<br><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22"><?=$electric_charges_no?><br /><?=$row['electric_date_request']?></td>
									<td class="ltrow1_center_h22"><?=$row['boss_hp']?><br /><?=$row['com_damdang_tel']?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_installment?><br /><?=$electric_date_inquiry_day?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_file_check2?></td>
									<td nowrap class="ltrow1_center_h22" title="1월"><?=$account[1]?></td>
									<td nowrap class="ltrow1_center_h22" title="2월"><?=$account[2]?></td>
									<td nowrap class="ltrow1_center_h22" title="3월"><?=$account[3]?></td>
									<td nowrap class="ltrow1_center_h22" title="4월"><?=$account[4]?></td>
									<td nowrap class="ltrow1_center_h22" title="5월"><?=$account[5]?></td>
									<td nowrap class="ltrow1_center_h22" title="6월"><?=$account[6]?></td>
									<td nowrap class="ltrow1_center_h22" title="7월"><?=$account[7]?></td>
									<td nowrap class="ltrow1_center_h22" title="8월"><?=$account[8]?></td>
									<td nowrap class="ltrow1_center_h22" title="9월"><?=$account[9]?></td>
									<td nowrap class="ltrow1_center_h22" title="10월"><?=$account[10]?></td>
									<td nowrap class="ltrow1_center_h22" title="11월"><?=$account[11]?></td>
									<td nowrap class="ltrow1_center_h22" title="12월"><?=$account[12]?></td>
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
									<td class="ltrow1_center_h22"><?=$electric_charges_watt?></td>
<? } ?>
									<td class="ltrow1_center_h22"><?=$electric_charges_year_fee?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_reduce?></td>

<?
$sel_check_ok = array();
$check_ok_id = $row['electric_charges_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22"><?=$branch?><br><?=$manager?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
								<tr>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
									<td class="tdhead_center"></td>
<? } ?>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
								</tr>
							</table>
							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<iframe name="check_ok_iframe" src="electric_charges_check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
