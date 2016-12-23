<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

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
	if($member['mb_level'] == 4) $sql_search = " where a.com_code = b.com_code and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search = " where a.com_code = b.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}

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
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
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
//검색 : 대표자HP
if ($stx_boss_hp) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_hp like '%$stx_boss_hp%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자HP 등록 여부
if ($stx_boss_hp_yn) {
	if($stx_boss_hp_yn == "no") $sql_search .= " and a.boss_hp = '' ";
	else $sql_search .= " and a.boss_hp != '' ";
}
//검색 : 계약서
if ($stx_contract) {
	if($stx_contract == "no") $stx_contract = "";
	$sql_search .= " and ( ";
	$sql_search .= " (b.chk_contract = '$stx_contract') ";
	$sql_search .= " ) ";
	$sst = "b.chk_contract_no";
	$sod = "desc";
}
//검색 : 지사
if ($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : 열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//검색 : 사업개시일
if ($stx_reg_day_chk) {
	$sql_search .= " and ( ";
	if($stx_reg_day_chk == 1) {
		$sql_search .= " (b.registration_day != '') ";
	} else if($stx_reg_day_chk == 2) {
		$sql_search .= " (b.registration_day >= '$search_year.$search_month.00' and b.registration_day <= '$search_year_end.$search_month_end.32') ";
	}
	$sql_search .= " ) ";
	$sst = "b.registration_day";
	$sod = "desc";
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
//검색 : 위탁번호 여부 (사무위탁업체)
if ($stx_samu_receive_no_search) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_no != '') ";
	$sql_search .= " ) ";
}
//검색2 : 의뢰서
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색2 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색2 : 계약서
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.chk_contract != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(공단)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 대리인선임(센터)
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색2 : 이지노무
if ($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn != '') ";
	$sql_search .= " ) ";
}
//검색 : 지원금
if ($stx_comp_gubun7) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_support > 0) ";
	$sql_search .= " ) ";
}
//검색 : 환급금
if ($stx_comp_gubun8) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_contribution > 0) ";
	$sql_search .= " ) ";
}
//검색 : 기타
if ($stx_comp_gubun9) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.p_construction > 0) ";
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
//인원검색
if(!$stx_scount && $stx_ecount) $stx_scount = 0;
if ($stx_scount != "" || $stx_scount == 0) {
	$sql_search .= " and ( ";
	$sql_search .= " (cast(b.persons AS signed) >= '$stx_scount') ";
	if ($stx_ecount) $sql_search .= " and (cast(b.persons AS signed) <= '$stx_ecount') ";
	$sql_search .= " ) ";
}
//업종분류검색
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11) {
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
}
if($stx_industry1 || $stx_industry2 || $stx_industry3 || $stx_industry4 || $stx_industry5 || $stx_industry6 || $stx_industry7 || $stx_industry8 || $stx_industry9 || $stx_industry10 || $stx_industry11) $sql_search .= " ) ";
//2. 상세검색
//정년나이
if ($stx_retirement_age) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.retirement_age = '$stx_retirement_age') ";
	$sql_search .= " ) ";
}
//가족보험환급
if ($stx_refund_request) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.refund_request = '$stx_refund_request') ";
	$sql_search .= " ) ";
}
//이지노무의뢰
if ($stx_easynomu_request) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_request REGEXP '^(1,|,){".($stx_easynomu_request-1)."}1.*$') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select * $sql_common $sql_search $sql_order ";
$result = sql_query($sql);

//코드, 업체담당자명 161004
$cell = array("No","코드","등록일자","사업장명","주소","사업자등록번호","사업장관리번호","사무위탁","대리인선임","전자민원","전화번호","팩스번호","이메일","대표자","대표자HP","업체담당자","사업개시일","업태","업종","관리점","담당자");

$now_date_file = date("Ymd");
$file_name = "거래처정보_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<style type="text/css">
table { font-size:10px; }
</style>
<table width='1200' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
// 리스트 출력
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $i + 1;
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no']) {
		$samu_receive_no = "".$row['samu_receive_no']."";
	} else {
		$samu_receive_no = "-";
	}
	//등록일자
	$regdt = $row['regdt'];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//등록일시
	if($row['regdt_time'] != "0000-00-00 00:00:00") $regdt_time = $row['regdt_time'];
	else $regdt_time = "";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	//우편번호
	$zip = $row['com_postno']." ";
	//주소
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//전화번호
	$com_tel = $row['com_tel'];
	//1544 국번 지역번호 제거
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	//대표자HP
	if($row['boss_hp']) $boss_hp = $row['boss_hp'];
	else $boss_hp = "-";
	//업체담당자
	if($row['com_damdang']) $com_damdang = $row['com_damdang'];
	else $com_damdang = "-";
	//관리점
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "";
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_state = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_state = "-";
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "";
	if($uptae == "-") $uptae = "";
	//업종
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//의뢰서
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	if($editdt >= $search_sday && $editdt <= $search_eday) $editdt_color = "color:red";
	else $editdt_color = "";
	//위탁서
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	if($samu_receive_date >= $search_sday && $samu_receive_date <= $search_eday) $samu_receive_date_color = "color:red";
	else $samu_receive_date_color = "";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//대리인(공단)
	if($row['agent_elect_public_date']) $agent_elect_public_date = $row['agent_elect_public_date'];
	else $agent_elect_public_date = "-";
	if($row['agent_elect_public_edate']) $agent_elect_public_edate = $row['agent_elect_public_edate'];
	else $agent_elect_public_edate = "-";
	//대리인(센터)
	if($row['agent_elect_center_date']) $agent_elect_center_date = $row['agent_elect_center_date'];
	else $agent_elect_center_date = "-";
	if($row['agent_elect_center_edate']) $agent_elect_center_edate = $row['agent_elect_center_edate'];
	else $agent_elect_center_edate = "-";
	//검토현황
	$review_process_array = Array("","검토중","완료","해당없음");
	$review_process_code = $row['review_process'];
	if($row['review_process']) $review_process = $review_process_array[$review_process_code];
	else $review_process = "-";
	//이지노무
	$easynomu_process_array = Array("","기초셋팅중","급여셋팅중","완료","보류","해지","보완서류요청");
	$easynomu_process_code = $row['easynomu_process'];
	if($row['easynomu_process']) $easynomu_process = $easynomu_process_array[$easynomu_process_code];
	else $easynomu_process = "-";
	//이지노무 월정액
	if($easynomu_process_code == 3) {
		if($row['month_pay']) $easynomu_process = number_format($row['month_pay']);
	}
	//진행사항
	if($row['editdt']) $p_accept = "접수";
	else $p_accept = "-";
	if($row['samu_receive_date']) $p_accept = "처리중";
	if($row['samu_req_date']) $p_accept = "처리중";
	if($row['agent_elect_public_date']) $p_accept = "처리중";
	if($row['agent_elect_center_date']) $p_accept = "처리중";
	if($row['easynomu_process']) $p_accept = "처리중";
	if($row['proxy'] == 1)  $p_accept = "접수";
	else if($row['proxy'] == 3) $p_accept = "완료";
	//상시근로자 고용/산재
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "";
	if($persons_sj == "0") $persons_sj = "";
	//수수료 : 지원금, 부담금, 건설
	$p_support = $row['p_support']."%";
	$p_contribution = $row['p_contribution']."%";
	$p_construction = $row['p_construction']."%";
	if($p_support == "0%") $p_support = "";
	if($p_contribution == "0%") $p_contribution = "";
	if($p_construction == "0%") $p_construction = "";
	//위임장
	if($row[proxy] == "1") {
		$proxy = "○";
	} else {
		$proxy = "";
	}
	//취업규칙
	if($row[employment] > 0) {
		$employment = number_format($row[employment]);
	} else {
		$employment = "";
	}
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$id?></td>
				<td align="center"><?=$regdt?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$samu_state?></td>
				<td align="center"><?=$agent_elect_public_edate?></td>
				<td align="center"><?=$agent_elect_center_edate?></td>
				<td align="center"><?=$com_tel?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="left"><?=$row['com_mail']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$boss_hp?></td>
				<td align="center"><?=$com_damdang?></td>
				<td align="center"><?=$registration_day?></td>
				<td align="center"><?=$uptae?></td>
				<td align="left" width="215"><?=$upjong_full?></td>
				<td align="center"><?=$branch?></td>
				<td align="center"><?=$manage_cust_name?></td>
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

