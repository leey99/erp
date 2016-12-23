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
//검색 : 사업장명칭
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 사업자등록번호
if ($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name like '%$stx_manage_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 팩스번호
if($stx_comp_fax) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_fax like '%$stx_comp_fax%') ";
	$sql_search .= " ) ";
}
//지사
if($stx_man_cust_name) {
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code='110' or a.damdang_code='111') ";
	else if($stx_man_cust_name == "gj") $sql_search .= " and (a.damdang_code>='112' and a.damdang_code<='118') ";
	else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//검색 : 열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
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
//검색 : 처리현황
if($stx_process) {
	$sql_search .= " and ( ";
	if($stx_process == "no") $sql_search .= " (a.electric_charges_process = '') ";
	else $sql_search .= " (a.electric_charges_process = '$stx_process') ";
	$sql_search .= " ) ";
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
//공사진행 160517
if($stx_construct_chk) $sql_search .= " and a.electric_charges_construct_chk != '' ";
//전력구분
if($stx_electric_charges_power_kind) {
	//저압
	if($stx_electric_charges_power_kind == 1) $sql_search .= " and (a.electric_charges_existing='1' or a.electric_charges_existing='4' or a.electric_charges_existing='7' or a.electric_charges_existing='11' or a.electric_charges_existing='14' or a.electric_charges_existing='17' or a.electric_charges_existing='21' or a.electric_charges_existing='24') ";
	//고압
	else $sql_search .= " and (a.electric_charges_existing='2' or a.electric_charges_existing='3' or a.electric_charges_existing='5' or a.electric_charges_existing='6' or a.electric_charges_existing='8' or a.electric_charges_existing='9' or a.electric_charges_existing='40' or a.electric_charges_existing='10' or a.electric_charges_existing='50' or a.electric_charges_existing='20' or a.electric_charges_existing='12' or a.electric_charges_existing='13' or a.electric_charges_existing='32' or a.electric_charges_existing='31' or a.electric_charges_existing='15' or a.electric_charges_existing='16' or a.electric_charges_existing='30' or a.electric_charges_existing='18' or a.electric_charges_existing='19' or a.electric_charges_existing='22' or a.electric_charges_existing='25' or a.electric_charges_existing='26') ";
}
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
	$sql_search .= " and (a.electric_charges_regdt >= '$search_sday_var' and a.electric_charges_regdt <= '$search_eday_var') ";
}

//정렬
if (!$sst) {
    $sst = "a.electric_charges_regdt";
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

$rows = 9999;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sub_title = "전기요금컨설팅";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
			";
//echo $sql;
$result = sql_query($sql);
if($member['mb_level'] > 6) $cell = array("No","등록일시","사업장명","업태","주소","전화번호","대표자HP","이메일","대표자","고객번호","법인등록번호","주민등록번호","기존요금제","계약전력","전기료(1년간)","절감예상금액1","한전불입금1","공사비1","수수료1","절감예상금액2","한전불입금2","공사비2","수수료2","처리현황","지사","담당자","상담메모","처리결과");
else												$cell = array("No","등록일시","사업장명","업태","주소","전화번호","대표자HP","이메일","대표자","고객번호","법인등록번호","주민등록번호",           "전기료(1년간)","절감예상금액1","한전불입금1","공사비1","수수료1","절감예상금액2","한전불입금2","공사비2","수수료2","처리현황","지사","담당자","상담메모","처리결과");
$colspan = count($cell) + 1;
$now_date_file = date("Ymd");
$file_name = $sub_title."_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:x="urn:schemas-microsoft-com:office:excel">
<meta http-equiv="Content-Type" content="application/vnd.ms-excel; charset=euc-kr">
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing="1" cellpadding="3" bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
//계약요금제 배열 160317;
$electric_charges_existing_arry[1] = "산업용(갑)Ⅰ 저압";
$electric_charges_existing_arry[2] = "산업용(갑)Ⅱ 고압A 선택Ⅰ";
$electric_charges_existing_arry[3] = "산업용(갑)Ⅱ 고압A 선택Ⅱ";
$electric_charges_existing_arry[4] = "일반용(갑)Ⅰ 저압";
$electric_charges_existing_arry[5] = "일반용(갑)Ⅱ 고압A 선택Ⅰ";
$electric_charges_existing_arry[6] = "일반용(갑)Ⅱ 고압A 선택Ⅱ";
$electric_charges_existing_arry[7] = "교육용(갑)Ⅰ 저압";
$electric_charges_existing_arry[8] = "교육용(갑)Ⅱ 고압A 선택Ⅰ";
$electric_charges_existing_arry[9] = "교육용(갑)Ⅱ 고압A 선택Ⅱ";

$electric_charges_existing_arry[40] = "일반용(갑)Ⅰ 고압A 선택Ⅰ";
$electric_charges_existing_arry[10] = "일반용(갑)Ⅰ 고압A 선택Ⅱ";
$electric_charges_existing_arry[50] = "산업용(갑)Ⅰ 고압A 선택Ⅰ";
$electric_charges_existing_arry[20] = "산업용(갑)Ⅰ 고압A 선택Ⅱ";

$electric_charges_existing_arry[11] = "산업용(을) 저압";
$electric_charges_existing_arry[12] = "산업용(을) 고압A 선택Ⅰ";
$electric_charges_existing_arry[13] = "산업용(을) 고압A 선택Ⅱ";
$electric_charges_existing_arry[32] = "산업용(을) 고압A 선택Ⅲ";
$electric_charges_existing_arry[31] = "산업용(을) 고압B 선택Ⅲ";

$electric_charges_existing_arry[14] = "일반용(을) 저압";
$electric_charges_existing_arry[15] = "일반용(을) 고압A 선택Ⅰ";
$electric_charges_existing_arry[16] = "일반용(을) 고압A 선택Ⅱ";
$electric_charges_existing_arry[30] = "일반용(을) 고압B 선택Ⅰ";

$electric_charges_existing_arry[17] = "교육용(을) 저압";
$electric_charges_existing_arry[18] = "교육용(을) 고압A 선택Ⅰ";
$electric_charges_existing_arry[19] = "교육용(을) 고압A 선택Ⅱ";

$electric_charges_existing_arry[21] = "농사용(갑) 저압";
$electric_charges_existing_arry[22] = "농사용(갑) 고압";
$electric_charges_existing_arry[24] = "농사용(을) 저압";
$electric_charges_existing_arry[25] = "농사용(을) 고압A";
$electric_charges_existing_arry[26] = "농사용(을) 고압B";
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
		if($row['damdang_code2']) {
			$damdang_code2 = $row['damdang_code2'];
			$branch .= ">".$man_cust_name_arry[$damdang_code2];
		}
	} else {
		$branch = "-";
	}
	//대표자명
	if($row['boss_name']) {
		$boss_name = $row['boss_name'];
	} else {
		$boss_name = "-";
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
	//기존요금제
	if($row['electric_charges_existing']) {
		$electric_charges_existing = $row['electric_charges_existing'];
		$electric_charges_existing_text = $electric_charges_existing_arry[$electric_charges_existing];
	} else {
		$electric_charges_existing_text = "-";
	}
	//계약전력
	if($row['electric_charges_watt']) $electric_charges_watt = $row['electric_charges_watt']."kW";
	else $electric_charges_watt = "-";
	//전기료(1년간)
	if($row['electric_charges_year_fee']) $electric_charges_year_fee = $row['electric_charges_year_fee'];
	else $electric_charges_year_fee = "-";

	//한전불입금
	if($row['electric_charges_payments']) $electric_charges_payments = $row['electric_charges_payments'];
	else $electric_charges_payments = "-";
	//절감예상금액
	if($row['electric_charges_reduce']) $electric_charges_reduce = $row['electric_charges_reduce'];
	else $electric_charges_reduce = "-";
	//공사비
	if($row['electric_charges_cost']) $electric_charges_cost = $row['electric_charges_cost']."~".$row['electric_charges_cost2']."만";
	else $electric_charges_cost = "-";
	//수수료
	if($row['electric_charges_commission']) $electric_charges_commission = $row['electric_charges_commission'];
	else $electric_charges_commission = "-";

	//한전불입금2
	if($row['electric_charges_payments2']) $electric_charges_payments2 = $row['electric_charges_payments2'];
	else $electric_charges_payments2 = "-";
	//절감예상금액2
	if($row['electric_charges_reduce2']) $electric_charges_reduce2 = $row['electric_charges_reduce2'];
	else $electric_charges_reduce2 = "-";
	//공사비2
	if($row['electric_charges_cost_b']) $electric_charges_cost2 = $row['electric_charges_cost_b']."~".$row['electric_charges_cost2_b']."만";
	else $electric_charges_cost2 = "-";
	//수수료2
	if($row['electric_charges_commission2']) $electric_charges_commission2 = $row['electric_charges_commission2'];
	else $electric_charges_commission2 = "-";

	//처리현황
	$check_ok_id = $row['electric_charges_process'];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$row['electric_charges_regdt']?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$row['uptae']?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$row['com_tel']?></td>
				<td align="center"><?=$row['boss_hp']?></td>
				<td align="center"><?=$row['com_mail']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center" x:str><?=$electric_charges_no?></td>
				<td align="center"><?=$electric_charges_bupin?></td>
				<td align="center"><?=$electric_charges_ssnb?></td>
<?
	//본사만 계약전력 표시 160425
	if($member['mb_level'] > 6) {
?>
				<td align="center"><?=$electric_charges_existing_text?></td>
				<td align="center"><?=$electric_charges_watt?></td>
<?
	}
?>
				<td align="center"><?=$electric_charges_year_fee?></td>

				<td align="center"><?=$electric_charges_reduce?></td>
				<td align="center"><?=$electric_charges_payments?></td>
				<td align="center"><?=$electric_charges_cost?></td>
				<td align="center"><?=$electric_charges_commission?></td>

				<td align="center"><?=$electric_charges_reduce2?></td>
				<td align="center"><?=$electric_charges_payments2?></td>
				<td align="center"><?=$electric_charges_cost2?></td>
				<td align="center"><?=$electric_charges_commission2?></td>

				<td align="center"><?=$electric_charges_process_arry[$check_ok_id]?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$manager?></td>
				<td align="left"><?=$memo_full?></td>
				<td align="left" width="328"><?=$etc_full?></td>
			</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
</table>
<?
exit;
?>
