<?
$sub_menu = "1901100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
//if($member['mb_level'] > 6 || $search_ok == "ok") {

$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";

//본사, 수요관리(사룬) 전체 표시 160928
if($member['mb_profile'] == 1 || $member['mb_profile'] == 122) {
	//$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
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
	//지사 딜러, 영업사원 권한
	if($member['mb_level'] <= 5) $sql_search .= " and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search .= " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//필수 검색조건 : 전력수요관리 체크
$sql_search .= " and c.kepco_dsm_chk = '1' ";

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
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code>=110 and a.damdang_code<=119) ";
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
//수요관리 번호
if($stx_kepco_dsm_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.kepco_dsm_no = '$stx_kepco_dsm_no') ";
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
	if($stx_process == "no") $sql_search2 .= " (c.kepco_dsm_process = '') ";
	else $sql_search2 .= " (c.kepco_dsm_process = '$stx_process') ";
	$sql_search2 .= " ) ";
}
//분납 160614
if($stx_installment) $sql_search .= " and a.electric_charges_installment != '' ";
//등록일자
if($stx_search_day_chk) {
	$date = explode(".", $search_sday);
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$search_sday_var = $year."-".$month."-".$day." 00:00:00";
	if($search_eday) {
		$date = explode(".", $search_eday);
		$year = $date[0];
		$month = $date[1]; 
		$day = $date[2]; 
	}
	$search_eday_var = $year."-".$month."-".$day." 23:59:59";
	$sql_search .= " and (c.kepco_dsm_regdt >= '$search_sday_var' and c.kepco_dsm_regdt <= '$search_eday_var') ";
}
//정렬
if (!$sst) {
    $sst = "c.kepco_dsm_regdt";
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

$top_sub_title = "images/top19_11.png";
$sub_title = "전력수요관리";
$g4['title'] = $sub_title." : 사업분야 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search $sql_search2
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 13;

//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok."&stx_process=".$stx_process;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_kepco_dsm_no=".$stx_kepco_dsm_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_installment=".$stx_installment;
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
	check_ok_iframe.location.href = "kepco_dsm_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
//전기요금계산 160212
function pop_electric_calculate() {
	var ret = window.open("pop_electric_calculate.php", "pop_electric_calculate", "width=450,height=420,scrollbars=no");
	return;
}
//등록일자 오늘
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$today?>";
		frm['search_eday'].value = "<?=$today?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
//전기요금계산기 160616
function electric_charges_calculate() {
	var ret = window.open("pop_electric_charges_calculate.php", "pop_electric_charges_calculate", "width=450,height=570,scrollbars=yes");
	return;
}
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
$php_self_list = "kepco_dsm_list.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="사업분야" /></td>
					<td><a href="<?=$php_self_list?>"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></a></td>
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
									<td nowrap class="tdrowk" width="80"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
									<td nowrap class="tdrow" width="112" colspan="">
										<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
//본사 관리부 직원, 본사 전기 담당 권한 160530
if( $member['mb_level'] > 7 || ($member['mb_profile'] == 1 && $member['mb_level'] == 4) ) {
	//echo $stx_man_cust_name;
?>
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
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">분납</td>
									<td nowrap class="tdrow">
										<input type="checkbox" name="stx_installment" value="1" <? if($stx_installment == 1) echo "checked"; ?> style="vertical-align:middle" title="">분납
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
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">iSMART ID</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_kepco_dsm_no"  type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$stx_kepco_dsm_no?>" maxlength="10"  onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
<?
//본사 직원 권한(영업사원 제외) 160527
if($member['mb_level'] > 7) {
?>
								<tr>
									<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">등록일자</td>
									<td nowrap class="tdrow" colspan="9">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>오늘</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_sday);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
											~
											<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.search_eday);" target="">달력</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
									</td>
								</tr>
<?
}
?>
							</table>
						</form>
<?
//진행현황 처리현황 카운트
$contracts_progress = 0;
$progress_task = 0;
$progress_wrong = 0;
$reserve = 0;
$complete_task = 0;
$part_reduce = 0;
$progress_cancel = 0;
$unselect = 0;
$collet_money = 0;
$reduce1 = 0;
$reduce2 = 0;
$reduce3 = 0;
$reduce4 = 0;
$test1 = 0;
$test2 = 0;

//검색 쿼리 초기화
$sql_search_cnt = " where a.com_code = b.com_code and a.com_code = c.com_code and c.kepco_dsm_chk = '1' ";
//본사, 제휴점, 지사 구분 검색
if($damdang_code != "all" && $damdang_code != "dl" && $damdang_code) {
	$sql_search_add = " and a.damdang_code='$damdang_code' ";
} 
//사업장 기본정보 DB : 전기요금컨설팅
if($member['mb_level'] == 6) {
	$sql_search_add2 = " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
//전기요금컨설팅 에이전시, 지사일 경우 160516
} else if($member['mb_level'] == 4 && $member['mb_profile'] != 1) {
	//지사 딜러 권한
	$sql_search_add2 = " and ( b.manage_cust_numb='$manage_code' ) ";
}
$sql_kepco_dsm = " select c.kepco_dsm_process from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";
$sql_kepco_dsm .= " $sql_search_cnt $sql_search_add $sql_search_add2 ";
//echo $sql_kepco_dsm;
$result_kepco_dsm = sql_query($sql_kepco_dsm);
for ($i=0; $row_kepco_dsm=mysql_fetch_assoc($result_kepco_dsm); $i++) {
	if($row_kepco_dsm['kepco_dsm_process'] == 1) $contracts_progress++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 2) $progress_task++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 3) $progress_wrong++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 4) $reserve++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 5) $part_reduce++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 6) $progress_cancel++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 7) $collet_money++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 8) $complete_task++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 9)  $reduce1++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 10) $reduce2++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 11) $reduce3++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 12) $reduce4++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 13) $test1++;
	else if($row_kepco_dsm['kepco_dsm_process'] == 14) $test2++;
	else if($row_kepco_dsm['kepco_dsm_process'] == "") $unselect++;
}
$job_total_count = $i;
?>
						<div>
							<div style="cursor:pointer;float:left;width:92px;height:36px;background:url('images/support_person_tag_total.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>';">
								<div class="ftwhite_div" style="margin:11px 0 0 49px;"><?=$job_total_count?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_job_time_tag11.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_process=no&stx_construct_chk=';">
								<div class="ftwhite_div"><?=$unselect?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag3.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=3';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$contracts_progress?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag4.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=4';">
								<div class="ftwhite_div"><?=$progress_task?></div>
							</div>
							<div style="cursor:pointer;float:left;width:128px;height:36px;background:url('images/erp_electric_charges_tag5.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=5';">
								<div class="ftwhite_div" style="margin:11px 0 0 87px;"><?=$progress_wrong?></div>
							</div>
							<div style="cursor:pointer;float:left;width:95px; height:36px;background:url('images/erp_electric_charges_tag6.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=6';">
								<div class="ftwhite_div" style="margin:11px 0 0 61px;"><?=$reserve?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag5.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=5';">
								<div class="ftwhite_div"><?=$part_reduce?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag9.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=9';">
								<div class="ftwhite_div"><?=$reduce1?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag10.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=10';">
								<div class="ftwhite_div"><?=$reduce2?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag11.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=11';">
								<div class="ftwhite_div"><?=$reduce3?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag12.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=12';">
								<div class="ftwhite_div"><?=$reduce4?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag13.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=13';">
								<div class="ftwhite_div"><?=$test1?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/kepco_dsm_tag14.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=14';">
								<div class="ftwhite_div"><?=$test2?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag14.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=12';">
								<div class="ftwhite_div"><?=$progress_cancel?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag15.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=14';">
								<div class="ftwhite_div"><?=$collet_money?></div>
							</div>
							<div style="cursor:pointer;float:left;width:118px;height:36px;background:url('images/erp_electric_charges_tag9.png');margin:5px 10px 0 0;" onclick="location.href='<?=$php_self_list?>?<?=$qstr?>&stx_construct_chk=&stx_process=9';">
								<div class="ftwhite_div"><?=$complete_task?></div>
							</div>
						</div>
						<div style="clear:both;width:100%;height:10px;font-size:0px;line-height:0px;"></div>
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
							<tr>
								<td align="center">
									<a href="javascript:goSearch();"><img src="./images/btn_search_big.png" border="0" /></a>
<?
if($member['mb_id'] == "master") $electric_charges_excel_url = "electric_charges_excel_admin.php?".$qstr;
else $electric_charges_excel_url = "electric_charges_excel.php?".$qstr;
//프로그램 개발중
$electric_charges_excel_url = "javascript:alert('프로그램 개발 중입니다.');";
?>
									<a href="<?=$electric_charges_excel_url?>"><img src="./images/btn_excel_print_big.png" border="0" /></a>
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
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
<?
$list_date = "등록일자";
?>
									<td class="tdhead_center" width="70"><?=$list_date?></td>
									<td class="tdhead_center" width="188">사업장명</td>
									<td class="tdhead_center" width="100">대표자</td>
									<td class="tdhead_center" width="94">iSMART ID</td>
									<td class="tdhead_center">상담메모</td>
									<td class="tdhead_center" width="62">첨부서류</td>
									<td class="tdhead_center" width="88">계약금</td>
									<td class="tdhead_center" width="80">잔금</td>
									<td class="tdhead_center" width="90">전체수수료</td>
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
	$date1 = substr($row['kepco_dsm_regdt'],0,10); //날짜표시형식변경
	//echo $date1;
	$kepco_dsm_regdt_time = substr($row['kepco_dsm_regdt'],11,8); //시간만 표시
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1];
	$day = $date[2];
	$kepco_dsm_regdt = $year.".".$month.".".$day."";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 28, "..");
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
	//상담메모
	if($row['kepco_dsm_memo']) $memo_full = $row['kepco_dsm_memo'];
	else $memo_full = "상담메모 없음";
	$memo = cut_str($memo_full, 48, "..");
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
	//수요관리 번호
	if($row['kepco_dsm_no']) {
		$kepco_dsm_no = $row['kepco_dsm_no'];
	} else {
		$kepco_dsm_no = "-";
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
	//첨부서류
	if($row['kepco_dsm_file_1']) $kepco_dsm_file_1 = "○";
	else $kepco_dsm_file_1 = "-";
	//계약금
	if($row['kepco_dsm_down_payment']) $kepco_dsm_down_payment = $row['kepco_dsm_down_payment'];
	else $kepco_dsm_down_payment = "-";
	//잔금
	if($row['kepco_dsm_remainder']) $kepco_dsm_remainder = $row['kepco_dsm_remainder'];
	else {
		if($row['kepco_dsm_remainder2']) $kepco_dsm_remainder = $row['kepco_dsm_remainder2'];
		else $kepco_dsm_remainder = "-";
	}
	//절감예상금액
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else {
		if($row['electric_charges_reduce2']) $electric_charges_reduce = $row['electric_charges_reduce2'];
		else $electric_charges_reduce = "-";
	}
	//수수료
	if($row['kepco_dsm_fee']) $kepco_dsm_fee = $row['kepco_dsm_fee'];
	else {
		if($row['kepco_dsm_fee2']) $kepco_dsm_fee = $row['kepco_dsm_fee2'];
		else $kepco_dsm_fee = "-";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22" title="<?=$kepco_dsm_regdt_time?>"><?=$kepco_dsm_regdt?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="kepco_dsm_view.php?id=<?=$id?>&w=u&<?=$qstr?>&page=<?=$page?>" style="font-weight:bold"><?=$com_name?></a>
										<br /><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_no?></td>
									<td class="ltrow1_left_h22">
<?
//본사 권한
if($member['mb_level'] > 6) {
?>
										<a href="javascript:open_memo('<?=$id?>')" title="<?=$memo_full?>"><?=$memo?></a>
<? } else { ?>
										<?=$memo?></span>
<? } ?>
									</td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_file_1?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_down_payment?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_remainder?></td>
									<td class="ltrow1_center_h22"><?=$kepco_dsm_fee?></td>
<?
$sel_check_ok = array();
$check_ok_id = $row['kepco_dsm_process'];
$sel_check_ok[$check_ok_id] = "selected";
?>
									<td class="ltrow1_center_h22">
<?
if($member['mb_level'] > 6) {
?>
										<select name="check_ok_<?=$id?>" class="selectfm" onchange="goCheck_ok(this);">
											<option value="">선택</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$kepco_dsm_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$kepco_dsm_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$kepco_dsm_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$kepco_dsm_process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$kepco_dsm_process_arry[5]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$kepco_dsm_process_arry[9]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$kepco_dsm_process_arry[10]?></option>
												<option value="11" <?=$sel_check_ok['11']?>><?=$kepco_dsm_process_arry[11]?></option>
												<option value="12" <?=$sel_check_ok['12']?>><?=$kepco_dsm_process_arry[12]?></option>
												<option value="13" <?=$sel_check_ok['13']?>><?=$kepco_dsm_process_arry[13]?></option>
												<option value="14" <?=$sel_check_ok['14']?>><?=$kepco_dsm_process_arry[14]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$kepco_dsm_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$kepco_dsm_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$kepco_dsm_process_arry[8]?></option>
										</select>
<?
} else {
	if($kepco_dsm_process_arry[$check_ok_id]) echo $kepco_dsm_process_arry[$check_ok_id];
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
<iframe name="check_ok_iframe" src="kepco_dsm_check_ok_update.php" style="width:500px;height:100px" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
