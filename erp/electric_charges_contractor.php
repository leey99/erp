<?
$sub_menu = "1900300";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code = b.com_code ";
//계약진행 -> 업무진행만 표시 -> 공사진행 접수 건만 표시 160517
//$sql_search .= " and a.electric_charges_process='4' ";

//공사접수 : 허수원 사장, 극동전력 안이사 160629 / 삼호전력 추가 160831 / 성진전력(제주) 161214
if($member['mb_id'] == "el1001") $electric_charges_construct_chk = 1;
else if($member['mb_id'] == "el1002") $electric_charges_construct_chk = 2;
else if($member['mb_id'] == "el1003") $electric_charges_construct_chk = 3;
else if($member['mb_id'] == "el1004") $electric_charges_construct_chk = 4;
else if($member['mb_id'] == "el1005") $electric_charges_construct_chk = 5;
$sql_search .= " and ( a.electric_charges_construct_chk='$electric_charges_construct_chk' or  a.electric_charges_construct_chk2='$electric_charges_construct_chk' ) ";

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
	//else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
	else $sql_search .= " and (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
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
//처리현황
if($stx_process) {
	$sql_search2 = " and ( ";
	if($stx_process == "no") $sql_search2 .= " (a.electric_charges_process = '') ";
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
//1년 요금절감표 요청 160411
if($stx_reduce_ask) $sql_search .= " and a.electric_charges_reduce_ask != '' ";
//1년 요금절감표 요청 160411
if($stx_search_ask) $sql_search .= " and a.electric_charges_search_ask != '' ";

//정렬
if (!$sst) {
    //$sst = "a.electric_charges_regdt";
    $sst = "a.electric_charges_construct_date";
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

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$top_sub_title = "images/top19_03.gif";
$sub_title = "전기요금";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 15;

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok."&stx_process=".$stx_process;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_electric_charges_no=".$stx_electric_charges_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind."&stx_payments=".$stx_payments."&stx_cost=".$stx_cost."&stx_electric_charges_watt1=".$stx_electric_charges_watt1."&stx_electric_charges_watt2=".$stx_electric_charges_watt2."&stx_reduce_ask=".$stx_reduce_ask."&stx_search_ask=".$stx_search_ask;
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
					<td><a href="electric_charges_contractor.php"><img src="<?=$top_sub_title?>" border="0" alt="전기요금컨설팅" /></a></td>
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
									<td nowrap class="tdrow" width="150">
										<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">고객번호</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_electric_charges_no"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_electric_charges_no?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="70"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
									<td nowrap class="tdrow" width="">
										<select name="stx_man_cust_name" class="selectfm">
											<option value="">전체</option>
<?
$damdang_code = $stx_man_cust_name;
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
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
							</table>
						</form>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
								</td>
							</tr>
						</table>
<? } ?>
						<div style="height:4px;font-size:0px"></div>
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
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
									<td class="tdhead_center" width="70">접수일자</td>
									<td class="tdhead_center" width="188">사업장명</td>
									<td class="tdhead_center" width="84">고객번호</td>
									<td class="tdhead_center" width="96" style="padding:4px 0 2px 0;">법인등록번호<br />주민등록번호</td>
									<td class="tdhead_center">상담메모</td>
									<td class="tdhead_center" width="60">계약전력</td>
									<td class="tdhead_center" width="82">전기료(1년간)</td>
									<td class="tdhead_center" width="82">절감예상금액</td>
									<td class="tdhead_center" width="89">한전불입금<br />공사비</td>
									<td class="tdhead_center" width="90">처리현황</td>
									<td class="tdhead_center" width="110">담당자</td>
								</tr>
<?
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//NO 넘버
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row['com_code'];
	//등록일자
/*
	$date1 = substr($row['electric_charges_regdt'],0,10); //날짜표시형식변경
	$electric_charges_regdt_time = substr($row['electric_charges_regdt'],11,8); //시간만 표시
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$electric_charges_regdt = $year.".".$month.".".$day."";
*/
	//접수일자 160704
	$electric_charges_regdt = $row['electric_charges_construct_date'];
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
	else {
		if($row['electric_charges_payments2']) $electric_charges_payments = $row['electric_charges_payments2'];
		else $electric_charges_payments = "-";
	}
	//공사비
	if($row['electric_charges_cost']) $electric_charges_cost = $row['electric_charges_cost'];
	else {
		if($row['electric_charges_cost_b']) $electric_charges_cost = $row['electric_charges_cost_b'];
		else $electric_charges_cost = "-";
	}
	//공사비2
	if($row['electric_charges_cost2']) $electric_charges_cost2 = "~".$row['electric_charges_cost2']."만";
	else {
		if($row['electric_charges_cost2_b']) $electric_charges_cost2 = "~".$row['electric_charges_cost2_b']."만";
		else $electric_charges_cost2 = "";
	}
	//절감예상금액
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else {
		if($row['electric_charges_reduce2']) $electric_charges_reduce = $row['electric_charges_reduce2'];
		else $electric_charges_reduce = "-";
	}
	//수수료
	if($row['electric_charges_commission']) $electric_charges_commission = $row['electric_charges_commission'];
	else {
		if($row['electric_charges_commission2']) $electric_charges_commission = $row['electric_charges_commission2'];
		else $electric_charges_commission = "-";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$electric_charges_regdt_time?>"><?=$electric_charges_regdt?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="electric_charges_contractor_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
										<br><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22"><?=$electric_charges_no?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_bupin?><br /><?=$electric_charges_ssnb?></td>
									<td class="ltrow1_left_h22">
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span></a>
<? } else { ?>
										<?=$memo?><?=$comment_cnt?><span style="color:blue;" title="<?=$etc_full?>"><?=$etc?></span>
<? } ?>
									</td>
									<td class="ltrow1_center_h22"><?=$electric_charges_watt?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_year_fee?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_reduce?></td>
									<td class="ltrow1_center_h22"><?=$electric_charges_payments?><br /><?=$electric_charges_cost?><?=$electric_charges_cost2?></td>
<?
$sel_check_ok = array();
$check_ok_id = $row['electric_charges_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
//if($is_admin == "super" && $member['mb_level'] != 6) {
//권한 오픈 150918
//딜러 제외 모두 표시 160112
if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">선택</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$electric_charges_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$electric_charges_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$electric_charges_process_arry[3]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$electric_charges_process_arry[10]?></option><!--상담완료-->
												<option value="4" <?=$sel_check_ok['4']?>><?=$electric_charges_process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$electric_charges_process_arry[5]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$electric_charges_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$electric_charges_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$electric_charges_process_arry[8]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$electric_charges_process_arry[9]?></option>
										</select>
<?
} else {
	if($electric_charges_process_arry[$check_ok_id]) echo $electric_charges_process_arry[$check_ok_id];
	else echo "-";
}
?>
									</td>
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
