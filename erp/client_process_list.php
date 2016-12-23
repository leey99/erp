<?
$sub_menu = "100100";
include_once("./_common.php");

//현재 년도
$year_now = date("Y");

//고용촉진 검색
if($stx_comp_gubun7) {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c, com_employment d ";
} else {
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";
}
//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;

$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
if($stx_comp_gubun7) $sql_search .= " and a.com_code = d.com_code ";
//지사 권한
if($member['mb_level'] <= 6) {
	$mb_id = $member['mb_id'];
	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	//지사 딜러, 영업사원 권한
	if($member['mb_level'] <= 5) $sql_search .= " and ( b.manage_cust_numb='$manage_code' ) ";
	else $sql_search .= " and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
else if($member['mb_level'] == 7) {
	//본사 영업사원 권한
	$mb_id = $member['mb_id'];
	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	$sql_search .= " and b.manage_cust_numb='$manage_code' ";
}
//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업자등록번호
if($stx_biz_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.biz_no like '%$stx_biz_no%') ";
	$sql_search .= " ) ";
}
//검색 : 대표자
if($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
//검색 : 전화번호
if($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
//검색 : 처리현황
if($stx_proxy) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.proxy = '$stx_proxy') ";
	$sql_search .= " ) ";
}
//지사
if($stx_man_cust_name) {
	//if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code='110' or a.damdang_code='111') ";
	//else if($stx_man_cust_name == "gj") $sql_search .= " and (a.damdang_code>='112' and a.damdang_code<='118') ";
	if($stx_man_cust_name == "dl") $sql_search .= " and (a.damdang_code>='110' and a.damdang_code<='119') ";
	else $sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
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
//검색 : 업태
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//업태 미분류
if($stx_uptae_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae = '-' or a.uptae = '') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if ($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색 : 열람
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	if($stx_man_cust_name2 == "dl") $sql_search .= " (a.damdang_code2>='110' and a.damdang_code2<='119') ";
	else $sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
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
//검색 : 사업개시일
if($stx_reg_day_chk) {
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
//검색 : 검색기간
if($stx_search_day_chk) {
	$sst = "a.regdt";
	$sod = "desc";
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7 || $search_day8) $sql_search .= " and ( ";
	//위탁서
	if($search_day1) {
		$sql_search .= " (a.regdt >= '$search_sday' and a.regdt <= '$search_eday') ";
	}
	//위탁서
	if($search_day2) {
		if($search_day1) $sql_search .= " or ";
		$sql_search .= " (a.editdt >= '$search_sday' and a.editdt <= '$search_eday') ";
		$sst = "a.editdt";
	}
	//위탁서
	if($search_day3) {
		if($search_day1 || $search_day2) $sql_search .= " or ";
		$sql_search .= " (b.samu_receive_date >= '$search_sday' and b.samu_receive_date <= '$search_eday') ";
		$sst = "b.samu_receive_date";
	}
	//사무수임
	if($search_day4) {
		if($search_day1 || $search_day2 || $search_day3) $sql_search .= " or ";
		$sql_search .= " (b.samu_req_date >= '$search_sday' and b.samu_req_date <= '$search_eday') ";
		$sst = "b.samu_req_date";
	}
	//사무수임 해지
	if($search_day5) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4) $sql_search .= " or ";
		$sql_search .= " (b.samu_close_date >= '$search_sday' and b.samu_close_date <= '$search_eday') ";
		$sst = "b.samu_close_date";
	}
	//대리인(공단)
	if($search_day6) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5) $sql_search .= " or ";
		$sql_search .= " (b.agent_elect_public_edate >= '$search_sday' and b.agent_elect_public_edate <= '$search_eday') ";
		$sst = "b.agent_elect_public_edate";
	}
	//전자민원
	if($search_day7) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6) $sql_search .= " or ";
		$sql_search .= " (b.agent_elect_center_edate >= '$search_sday' and b.agent_elect_center_edate <= '$search_eday') ";
		$sst = "b.agent_elect_center_edate";
	}
	//이지노무
	if($search_day8) {
		if($search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7) $sql_search .= " or ";
		$sql_search .= " (c.easynomu_finish_date >= '$search_sday' and c.easynomu_finish_date <= '$search_eday') ";
		$sst = "c.easynomu_finish_date";
	}
	if($search_day_all || $search_day1 || $search_day2 || $search_day3 || $search_day4 || $search_day5 || $search_day6 || $search_day7 || $search_day8) $sql_search .= " ) ";
}
//검색2 : 고용창출 : 시간선택제(접수)
if ($stx_employment_receive) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.file_check REGEXP '^(1,|,){8}1.*$') ";
	$sql_search .= " ) ";
}
//검색2 : 고용창출 : 시간선택제(신청)
if ($stx_employment_kind1) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.employment_kind REGEXP '^(1,|,){0}1.*$') ";
	$sql_search .= " ) ";
}
//검색2 : 고용창출 : 청년인턴
if ($stx_employment_kind2) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.employment_kind REGEXP '^(1,|,){1}1.*$') ";
	$sql_search .= " ) ";
}
//검색2 : 고용창출 : 장년인턴
if ($stx_employment_kind3) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.employment_kind REGEXP '^(1,|,){2}1.*$') ";
	$sql_search .= " ) ";
}
//검색2 : 고용창출 : 전문인력
if ($stx_employment_kind4) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.employment_kind REGEXP '^(1,|,){3}1.*$') ";
	$sql_search .= " ) ";
}
//검색 : 의뢰서
if ($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색1 : 위탁서
if ($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(공단)
if ($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(센터)
if ($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 이지노무
if ($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
}
//검색2 : 지원금
if ($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " ( c.application_kind != '0' and c.application_kind != '' ) ";
	$sql_search .= " ) ";
}
//고용촉진
if($stx_comp_gubun7) {
	$sql_search .= " and ( d.delete_yn = '' ) ";
}
//전기요금
if($stx_comp_gubun8) {
	$sql_search .= " and ( a.electric_charges_no != '' ) ";
}
//출산육아
if($stx_comp_gubun9) {
	$sql_search .= " and ( c.support_person_kind1 = '1' ) ";
}
//고령자
if($stx_comp_gubun10) {
	$sql_search .= " and ( c.support_person_kind2 = '1' ) ";
}
//산재복귀
if($stx_comp_gubun11) {
	$sql_search .= " and ( c.support_person_kind3 = '1' ) ";
}
//거래처구분 : 5인미만
if ($stx_emp5_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp5_gbn != '0' and b.emp5_gbn != '' ) ";
	$sql_search .= " ) ";
}
//거래처구분 : 30인미만
if ($stx_emp30_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp30_gbn != '0' and b.emp30_gbn != '' ) ";
	$sql_search .= " ) ";
}
//진행현황
if ($samu_req_yn) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_req_yn = '$samu_req_yn') ";
	$sql_search .= " ) ";
}
if ($agent_elect_public_yn) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_yn = '$agent_elect_public_yn') ";
	$sql_search .= " ) ";
}
if ($agent_elect_center_yn) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_yn = '$agent_elect_center_yn') ";
	$sql_search .= " ) ";
}
if ($easynomu_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.easynomu_process = '$easynomu_process') ";
	$sql_search .= " ) ";
}
if ($review_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.review_process = '$review_process') ";
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
//담당자 미등록
if($stx_manage_name_input_not) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '') ";
	$sql_search .= " ) ";
}
//상세검색
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
//사업자 구분 / 전정애 주임 요청 160630
if($stx_comp_type) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upche_div = '$stx_comp_type') ";
	$sql_search .= " ) ";
}
//정렬
if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
//카운트
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산

if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>처음</a>";

$sub_title = "접수처리현황";
$g4['title'] = $sub_title." : 거래처 : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;
//검색 파라미터 전송
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_comp_gubun10=".$stx_comp_gubun10."&stx_comp_gubun11=".$stx_comp_gubun11."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_uptae_input_not=".$stx_uptae_input_not."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&agent_elect_public_yn=".$agent_elect_public_yn."&agent_elect_center_yn=".$agent_elect_center_yn."&easynomu_process=".$easynomu_process."&review_process=".$review_process."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_emp5_gbn=".$stx_emp5_gbn."&stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day2=".$search_day2."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&search_day6=".$search_day6."&search_day7=".$search_day7."&search_day8=".$search_day8."&stx_manage_name=".$stx_manage_name."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_manage_name_input_not=".$stx_manage_name_input_not."&stx_employment_receive=".$stx_employment_receive."&stx_employment_kind1=".$stx_employment_kind1."&stx_employment_kind2=".$stx_employment_kind2."&stx_employment_kind3=".$stx_employment_kind3."&stx_employment_kind4=".$stx_employment_kind4;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not."&stx_comp_type=".$stx_comp_type;
//상세검색
$stx_qstr  = "stx_rules_report_if=".$stx_rules_report_if."&stx_retirement_age=".$stx_retirement_age."&stx_new_fund_scale_site=".$stx_new_fund_scale_site."&stx_establish_type=".$stx_establish_type."&stx_refund_request=".$stx_refund_request."&stx_factory_split=".$stx_factory_split."&stx_extend_age=".$stx_extend_age."&stx_easynomu_request=".$stx_easynomu_request;
$stx_qstr .= "&stx_fund_type_industry=".$stx_fund_type_industry."&stx_employment_support=".$stx_employment_support."&stx_establish_proposal_if=".$stx_establish_proposal_if."&stx_multitude=".$stx_multitude."&stx_charge_progress=".$stx_charge_progress."&stx_establish_way=".$stx_establish_way."&stx_sj_if=".$stx_sj_if."&stx_handicapped_employment=".$stx_handicapped_employment;
$stx_qstr .= "&stx_disaster_if=".$stx_disaster_if."&stx_found_if=".$stx_found_if."&stx_subsidy_type_if=".$stx_found_if."&stx_factory_site_1000=".$stx_factory_site_1000."&stx_women_matriarch_if=".$stx_women_matriarch_if."&stx_found_tax=".$stx_found_tax."&stx_disaster_if=".$stx_disaster_if."&stx_job_creation_proposal=".$stx_job_creation_proposal."&stx_rule_pay=".$stx_rule_pay;
$stx_qstr .= "&stx_rural_areas=".$stx_rural_areas."&stx_pay_peak_if=".$stx_pay_peak_if."&stx_career_kind=".$stx_career_kind."&stx_fund_basic_check=".$stx_fund_basic_check."&stx_shift_system=".$stx_shift_system."&stx_local_tax_yn=".$stx_local_tax_yn."&stx_work_contract=".$stx_work_contract."&stx_fund_kind=".$stx_fund_kind."&stx_establish_request=".$stx_establish_request;
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
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
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
			frm.action="client_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	var frm = document.searchForm;
	if(obj.style.display == "none") {
		obj.style.display = "";
		frm.search_detail.value = "ok";
	} else {
		obj.style.display = "none";
		frm.search_detail.value = "";
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
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
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=8; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=8; i++) {
			frm['search_day'+i].checked = false;
		}
	}
}
//사업자번호 입력 하이픈
function checkhyphen(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//사업장관리번호 입력 하이픈
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.searchForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
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
				type.value = total;
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
</script>
<?
include "inc/top.php";
$url_list = "./client_process_list.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width=""><a href="<?=$url_list?>"><img src="images/top01_02.gif" border="0" /></a></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--타이틀 -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok">
								<input type="hidden" name="search_detail" value="<?=$search_detail?>">
								<!--데이터 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
													검색
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
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장명칭</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업자등록번호</td>
										<td nowrap class="tdrow">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">대표자</td>
										<td nowrap class="tdrow">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">진행사항</td>
										<td nowrap class="tdrow">
											<select name="stx_proxy" class="selectfm" onchange="">
												<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>접수</option>
												<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($stx_proxy == "4") echo "selected"; ?>>진행취소</option>
												<option value="5" <? if($stx_proxy == "5") echo "selected"; ?>>반려</option>
											</select>
										</td>
<?
//본사 권한(영업사원 제외) 160211
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">지사</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name" class="selectfm" onchange="goSearch();">
												<option value="">전체</option>
<?
include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">담당자</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_manage_name"  type="text" class="textfm" style="width:100px;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_manage_name_input_not" value="1" <? if($stx_manage_name_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업장관리번호</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="only_number();if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle">미등록
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업태</td>
										<td nowrap class="tdrow" colspan="">
											<input type="text"     name="stx_uptae"  class="textfm" style="width:90px;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_uptae_input_not" value="1" <? if($stx_uptae_input_not == 1) echo "checked"; ?> style="vertical-align:middle" title="" />미분류
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">업종</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
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
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소검색</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_addr"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
											<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="선검색어">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역검색<input type="checkbox" name="stx_area_not" value="1" <? if($stx_area_not == 1) echo "checked"; ?> style="vertical-align:middle" title="검색제외"><span style="font-size:8pt;">제외</span></td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo "7"; else echo "5"; ?>">
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
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업개시일</td>
										<td nowrap class="tdrow" colspan="3">
											<select name="stx_reg_day_chk" class="selectfm" onchange="">
												<option value=""  <? if($stx_reg_day_chk == "")  echo "selected"; ?>>선택</option>
												<option value="1" <? if($stx_reg_day_chk == "1") echo "selected"; ?>>전체</option>
												<option value="2" <? if($stx_reg_day_chk == "2") echo "selected"; ?>>기간선택</option>
											</select>
											<select name="search_year" class="selectfm" onChange="">
												<option value="1980" <? if(1980 == $search_year) echo "selected"; ?> >1980 이전</option>
<?
if(!$search_year) $search_year = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월 ~
											<select name="search_year_end" class="selectfm" onChange="">
<?
if(!$search_year_end) $search_year_end = $year_now;
for($i=1981;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year_end) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month_end" class="selectfm" onChange="">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month_end) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용창출</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo "5"; else echo "3"; ?>">
											<input type="checkbox" name="stx_employment_receive" value="1" <? if($stx_employment_receive == 1) echo "checked"; ?> style="vertical-align:middle">시간선택제(접수)
											<input type="checkbox" name="stx_employment_kind1" value="1" <? if($stx_employment_kind1 == 1) echo "checked"; ?> style="vertical-align:middle">시간선택제(신청)
											<input type="checkbox" name="stx_employment_kind2" value="1" <? if($stx_employment_kind2 == 1) echo "checked"; ?> style="vertical-align:middle">청년인턴
											<input type="checkbox" name="stx_employment_kind3" value="1" <? if($stx_employment_kind3 == 1) echo "checked"; ?> style="vertical-align:middle">장년인턴
											<input type="checkbox" name="stx_employment_kind4" value="1" <? if($stx_employment_kind4 == 1) echo "checked"; ?> style="vertical-align:middle">전문인력
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">검색기간</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo "7"; else echo "5"; ?>">
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
<?
for($i=1;$i<=8;$i++) {
	if($search_day_all != "1" && $_GET['search_day'.$i]) $search_day_all = "no";
}
if($search_day_all == "no") {
	$search_day_all = "";
} else {
	$search_day_all = 1;
	$search_day1 = 1;
	$search_day2 = 1;
	$search_day3 = 1;
	$search_day4 = 1;
	$search_day5 = 1;
	$search_day6 = 1;
	$search_day7 = 1;
	$search_day8 = 1;
}
?>
											<input type="checkbox" name="search_day_all" value="1" <? if($search_day_all == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)"><b>전체</b>
											<input type="checkbox" name="search_day1" value="1" <? if($search_day1 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">등록일자
											<input type="checkbox" name="search_day2" value="1" <? if($search_day2 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">의뢰서
											<input type="checkbox" name="search_day3" value="1" <? if($search_day3 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">위탁서
											<input type="checkbox" name="search_day4" value="1" <? if($search_day4 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">사무수임
											<input type="checkbox" name="search_day5" value="1" <? if($search_day5 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">사무해지
											<input type="checkbox" name="search_day6" value="1" <? if($search_day6 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">대리인
											<input type="checkbox" name="search_day7" value="1" <? if($search_day7 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">전자민원
											<input type="checkbox" name="search_day8" value="1" <? if($search_day8 == 1) echo "checked"; ?> style="vertical-align:middle" onclick="search_day_func(this)">이지노무
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">구분</td>
										<td nowrap class="tdrow">
											<select name="stx_comp_type" class="selectfm">
												<option value="">전체</option>
												<option value="1" <? if($stx_comp_type == "1") echo "selected"; ?>>개인</option>
												<option value="2" <? if($stx_comp_type == "2") echo "selected"; ?>>법인</option>
												<option value="3" <? if($stx_comp_type == "3") echo "selected"; ?>>유한</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">거래처구분</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo "9"; else echo "7"; ?>">
											<input type="checkbox" name="stx_comp_gubun1" value="1" <? if($stx_comp_gubun1 == 1) echo "checked"; ?> style="vertical-align:middle">의뢰서
											<input type="checkbox" name="stx_comp_gubun2" value="1" <? if($stx_comp_gubun2 == 1) echo "checked"; ?> style="vertical-align:middle">위탁서
											<input type="checkbox" name="stx_comp_gubun3" value="1" <? if($stx_comp_gubun3 == 1) echo "checked"; ?> style="vertical-align:middle">대리인선임(공단)
											<input type="checkbox" name="stx_comp_gubun4" value="1" <? if($stx_comp_gubun4 == 1) echo "checked"; ?> style="vertical-align:middle">전자민원(센터)
											<input type="checkbox" name="stx_comp_gubun5" value="1" <? if($stx_comp_gubun5 == 1) echo "checked"; ?> style="vertical-align:middle">이지노무
											<input type="checkbox" name="stx_comp_gubun6" value="1" <? if($stx_comp_gubun6 == 1) echo "checked"; ?> style="vertical-align:middle">지원금
											<input type="checkbox" name="stx_comp_gubun7" value="1" <? if($stx_comp_gubun7 == 1) echo "checked"; ?> style="vertical-align:middle">고용촉진
											<input type="checkbox" name="stx_comp_gubun8" value="1" <? if($stx_comp_gubun8 == 1) echo "checked"; ?> style="vertical-align:middle">전기요금
											<input type="checkbox" name="stx_comp_gubun9" value="1" <? if($stx_comp_gubun9 == 1) echo "checked"; ?> style="vertical-align:middle">출산육아
											<input type="checkbox" name="stx_comp_gubun10" value="1" <? if($stx_comp_gubun10 == 1) echo "checked"; ?> style="vertical-align:middle">고령자
											<input type="checkbox" name="stx_comp_gubun11" value="1" <? if($stx_comp_gubun11 == 1) echo "checked"; ?> style="vertical-align:middle">산재복귀
											<input type="checkbox" name="stx_emp5_gbn" value="1" <? if($stx_emp5_gbn == 1) echo "checked"; ?> style="vertical-align:middle">5인미만
											<input type="checkbox" name="stx_emp30_gbn" value="1" <? if($stx_emp30_gbn == 1) echo "checked"; ?> style="vertical-align:middle">30인이상
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처리현황</td>
										<td nowrap class="tdrow" colspan="<? if($member['mb_level'] > 7) echo "9"; else echo "7"; ?>">
											<b>사무위탁수임</b>
											<select name="samu_req_yn" class="selectfm" onchange="">
												<option value=""  <? if($samu_req_yn == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>반려</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>수임가능</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>타수임</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>수임</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>해지</option>
											</select>
											<b>대리인선임(공단)</b>
											<select name="agent_elect_public_yn" class="selectfm" onchange="">
												<option value=""  <? if($agent_elect_public_yn == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($agent_elect_public_yn == "1") echo "selected"; ?>>없음</option>
												<option value="2" <? if($agent_elect_public_yn == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($agent_elect_public_yn == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($agent_elect_public_yn == "4") echo "selected"; ?>>미접수</option>
												<option value="5" <? if($agent_elect_public_yn == "5") echo "selected"; ?>>지사요청</option>
												<option value="6" <? if($agent_elect_public_yn == "6") echo "selected"; ?>>회원가입</option>
												<option value="7" <? if($agent_elect_public_yn == "7") echo "selected"; ?>>해지완료</option>
												<option value="8" <? if($agent_elect_public_yn == "8") echo "selected"; ?>>해지요청</option>
											</select>
											<b>전자민원(센터)</b>
											<select name="agent_elect_center_yn" class="selectfm" onchange="">
												<option value=""  <? if($agent_elect_center_yn == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($agent_elect_center_yn == "1") echo "selected"; ?>>없음</option>
												<option value="2" <? if($agent_elect_center_yn == "2") echo "selected"; ?>>처리중</option>
												<option value="3" <? if($agent_elect_center_yn == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($agent_elect_center_yn == "4") echo "selected"; ?>>미접수</option>
												<option value="5" <? if($agent_elect_center_yn == "5") echo "selected"; ?>>지사요청</option>
												<option value="6" <? if($agent_elect_center_yn == "6") echo "selected"; ?>>회원가입</option>
												<option value="7" <? if($agent_elect_center_yn == "7") echo "selected"; ?>>해지완료</option>
												<option value="8" <? if($agent_elect_center_yn == "8") echo "selected"; ?>>해지요청</option>

											</select>
											<b>검토현황</b>
											<select name="review_process" class="selectfm" onchange="">
												<option value=""  <? if($review_process == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($review_process == "1") echo "selected"; ?>>검토중</option>
												<option value="2" <? if($review_process == "2") echo "selected"; ?>>완료</option>
												<option value="3" <? if($review_process == "3") echo "selected"; ?>>해당없음</option>
											</select>
											<b>이지노무</b>
											<select name="easynomu_process" class="selectfm" onchange="">
												<option value=""  <? if($easynomu_process == "")  echo "selected"; ?>>전체</option>
												<option value="1" <? if($easynomu_process == "1") echo "selected"; ?>>기초셋팅중</option>
												<option value="2" <? if($easynomu_process == "2") echo "selected"; ?>>급여셋팅중</option>
												<option value="3" <? if($easynomu_process == "3") echo "selected"; ?>>완료</option>
												<option value="4" <? if($easynomu_process == "4") echo "selected"; ?>>보류</option>
												<option value="5" <? if($easynomu_process == "5") echo "selected"; ?>>해지</option>
												<option value="6" <? if($easynomu_process == "6") echo "selected"; ?>>보완서류요청</option>
											</select>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<div id="request" style="<? if(!$search_detail) echo "display:none"; ?>">
									<!--댑메뉴 -->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
															상세검색
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
<? include "./inc/client_search_detail.php";?>
								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
											<a href="javascript:tab_view('request');" target=""><img src="./images/btn_detail_search_big.png" border="0"></a>
											<!--<a href="<?=$_SERVER['PHPSELF']?>?search_ok=branch" target=""><img src="./images/btn_total_search_big.png" border="0"></a>-->
											<a href="client_list.php" target=""><img src="./images/btn_customer_con_big.png" border="0"></a>
											<a href="client_process_excel.php?<?=$qstr?>&<?=$stx_qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0"></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px"></div>
							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												리스트
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
							<!--리스트 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="chk_data">
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="70" rowspan="2">등록일자</td>
										<td class="tdhead_center" rowspan="2">사업장명</td>
										<td class="tdhead_center" width="98" rowspan="1">사업자등록번호</td>
										<td class="tdhead_center" width="100" rowspan="1">대표자</td>
										<td class="tdhead_center" width="110" rowspan="1">업태</td>
										<td class="tdhead_center" width="74" rowspan="1">의뢰서접수<br></td>
										<td class="tdhead_center" width="80" rowspan="1">사무위탁수임</td>
										<td class="tdhead_center" width="80" rowspan="1">대리인선임</td>
										<td class="tdhead_center" width="70" rowspan="1">고용창출</td>
										<td class="tdhead_center" width="68" rowspan="2">진행사항</td>
										<td class="tdhead_center" width="96" rowspan="1">관리점</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="98" rowspan="1">사업장관리번호</td>
										<td class="tdhead_center" width=""   rowspan="1">사업개시일</td>
										<td class="tdhead_center" width="110" rowspan="1">업종</td>
										<td class="tdhead_center" width="74" rowspan="1">위탁서접수</td>
										<td class="tdhead_center" width="80" rowspan="1">사무위탁해지</td>
										<td class="tdhead_center" width="80" rowspan="1">전자민원</td>
										<td class="tdhead_center" width=""   rowspan="1">이지노무</td>
										<td class="tdhead_center" width="90" rowspan="1">담당자</td>
									</tr>
<?
// 리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//거래처 코드
	$id = $row['com_code'];
	//위탁서래처 코드
	if($row['samu_receive_no']) {
		$samu_receive_no = "(".$row['samu_receive_no'].")";
	} else {
		$samu_receive_no = "";
	}
	//등록일자
	$regdt = $row['regdt'];
	$regdt_time = $row['regdt_time'];
	$regdt_time_array = explode(" ",$row['regdt_time']);
	$regdt_time_only = $regdt_time_array[1];
	//등록일자 색상
	if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
	else $regdt_color = "";
	//사업장명
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//사업개시일
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//법인 구분
	if($row['upche_div'] == "2") {
		$upche_div = "법인";
	} else {
		$upche_div = "개인";
	}
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 30, "..");
	//사업자등록번호
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//사업장관리번호
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//대표자
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 14, "..");
	else $boss_name = "-";
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
	//담당매니저
	$manage_cust_name = $row['manage_cust_name'];
	//사무위탁
	if($row['samu_req_yn'] == "0" || $row['samu_req_yn'] == "") {
		$samu_req = "";
	} else if($row['samu_req_yn'] == "1") {
		$samu_req = "신청";
	}
	//업태
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
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
	//사무위탁수임
	$samu_req_yn_array = Array("","미도착","수임가능","타수임","수임","해지","반려");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn = "-";
	//수임일
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	if($samu_req_date >= $search_sday && $samu_req_date <= $search_eday) $samu_req_date_color = "color:red";
	else $samu_req_date_color = "";
	//해지일
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	if($samu_close_date >= $search_sday && $samu_close_date <= $search_eday) $samu_close_date_color = "color:red";
	else $samu_close_date_color = "";
	//처리상태(대리인, 전자민원)
	$agent_elect_public_text = array("","없음","처리중","완료","미접수","지사요청","회원가입","해지완료","해지요청");
	//대리인(공단)
	$agent_elect_public_yn = $row['agent_elect_public_yn'];
	if($row['agent_elect_public_edate']) {
		$agent_elect_public_edate = $row['agent_elect_public_edate'];
	} else {
		if($row['agent_elect_public_date']) $agent_elect_public_edate = "접수";
		else $agent_elect_public_edate = "-";
		if($row['agent_elect_public_yn']) $agent_elect_public_edate = $agent_elect_public_text[$agent_elect_public_yn];
	}
	if($agent_elect_public_edate >= $search_sday && $agent_elect_public_edate <= $search_eday) $agent_elect_public_edate_color = "color:red";
	else $agent_elect_public_edate_color = "";
	//대리인 해지 160318
	if($row['agent_elect_public_yn'] == 7) $agent_elect_public_edate = $agent_elect_public_text[$agent_elect_public_yn];
	//전자민원(센터)
	$agent_elect_center_yn = $row['agent_elect_center_yn'];
	if($row['agent_elect_center_edate']) {
		$agent_elect_center_edate = $row['agent_elect_center_edate'];
	} else {
		if($row['agent_elect_center_date']) $agent_elect_center_edate = "접수";
		else $agent_elect_center_edate = "-";
		if($row['agent_elect_center_yn']) $agent_elect_center_edate = $agent_elect_public_text[$agent_elect_center_yn];
	}
	if($agent_elect_center_edate >= $search_sday && $agent_elect_center_edate <= $search_eday) $agent_elect_center_edate_color = "color:red";
	else $agent_elect_center_edate_color = "";
	//전자민원 해지
	if($row['agent_elect_center_yn'] == 7) $agent_elect_center_edate = $agent_elect_center_text[$agent_elect_center_yn];
	//검토현황
	$review_process_array = Array("","검토중","완료","해당없음");
	$review_process_code = $row['review_process'];
	if($row['review_process']) $review_process = $review_process_array[$review_process_code];
	else $review_process = "-";
	//고용창출 : 시간선택제 150728
	//if($row['job_time_if']) $job_time_if = "시간선택제";
	/*
	$employment_kind = explode(',',$row['employment_kind']);
	if($employment_kind[0]) $job_time_if = "시간선택제";
	else $job_time_if = "-";
	*/
	$file_check = explode(',',$row['file_check']);
	if($file_check[8]) $job_time_if = "시간선택제";
	else $job_time_if = "-";
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
	else if($row['proxy'] == 2) $p_accept = "처리중";
	else if($row['proxy'] == 3) $p_accept = "완료";
	else if($row['proxy'] == 4) $p_accept = "진행취소";
	else if($row['proxy'] == 5) $p_accept = "반려";
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
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile'] || $row['damdang_code2'] == $member['mb_profile']) {
		$com_view = "client_process_view.php?id=$id&w=u&page=$page&$qstr&$stx_qstr";
	} else {
		$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
	}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td class="ltrow1_center_h22"><?=$no?><br><?=$samu_receive_no?></td>
										<td class="ltrow1_center_h22" style="<?=$regdt_color?>" title="<?=$regdt_time_only?>"><?=$regdt?></td>
										<td class="ltrow1_left_h22">
											<a href="<?=$com_view?>" style="font-weight:bold" title="<?=$com_name_full?>"><?=$com_name?></a>
<? if($row['agent_elect_public_yn'] == 3) { ?>
											<img src="images/icon_agent_elect_public.gif" border="0" alt="대리인" style="vertical-align:middle;margin-bottom:4px;" />
<? } ?>
<? if($row['agent_elect_center_yn'] == 3) { ?>
											<img src="images/icon_agent_elect_center.gif" border="0" alt="전자민원" style="vertical-align:middle;margin-bottom:4px;" />
<? } ?>
<? if($row['samu_req_yn'] == 4) { ?>
										<a href="samu_view.php?id=<?=$id?>&w=u"><img src="images/icon_erp_01.gif" border="0" alt="사무위탁" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//사업주훈련, 위험성평가 DB
if($row['job_request_if'] || $row['danger_evaluate_if']) {
	$sql_job = " select idx from job_education where com_code='$id' ";
	$result_job = sql_query($sql_job);
	$row_job=mysql_fetch_array($result_job);
	$job_idx = $row_job['idx'];
}
if($row['job_request_if']) {
	$job_education_view = "job_education_view.php?w=u&id=$job_idx";
?>
										<a href="<?=$job_education_view?>"><img src="images/icon_erp_02.gif" border="0" alt="사업주훈련" style="vertical-align:middle;margin-bottom:4px;" /></a>
<?
}
if($row['danger_evaluate_if']) {
	$danger_evaluate_view = "job_education_view.php?w=u&id=$job_idx";
?>
										<a href="<?=$danger_evaluate_view?>"><img src="images/icon_erp_03.gif" border="0" alt="위험성평가" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//지원금
$sql_support = " select * from erp_application where com_code='$id' and application_kind!='0' ";
$result_support = sql_query($sql_support);
$total_support = mysql_num_rows($result_support);
if($total_support) {
	$support_view = "client_application_view.php?id=$id&w=u";
?>
										<a href="<?=$support_view?>"><img src="images/icon_erp_04.gif" border="0" alt="지원금" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
if($row['easynomu_yn'] == 1 || $row['easynomu_yn'] == 2 || $row['construction_yn'] == 1) {
	if($row['easynomu_yn'] == 1) $tab_program_url_text = "program";
	else if($row['easynomu_yn'] == 2) $tab_program_url_text = "kidsnomu";
	else if($row['construction_yn'] == 1) $tab_program_url_text = "construction";
	else $tab_program_url_text = "program";
	$client_program_view = "client_".$tab_program_url_text."_view.php?id=$id&w=u";
?>
										<a href="<?=$client_program_view?>"><img src="images/icon_erp_05.gif" border="0" alt="프로그램" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//가족보험료환급
$sql_family_insurance = " select * from com_list_gy_opt b where b.com_code='$id' and ( b.refund_request='1' or b.family_work_if='1' or b.insurance_holder!='' ) ";
$result_family_insurance = sql_query($sql_family_insurance);
$total_family_insurance = mysql_num_rows($result_family_insurance);
if($total_family_insurance) {
	$family_insurance_view = "family_insurance_view.php?id=$id&w=u";
?>
										<a href="<?=$family_insurance_view?>"><img src="images/icon_erp_06.gif" border="0" alt="가족보험료환급" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//정책자금
$sql_policy_fund = " select * from policy_fund where com_code='$id' ";
$result_policy_fund = sql_query($sql_policy_fund);
$row_policy_fund = mysql_fetch_array($result_policy_fund);
$policy_fund_id = $row_policy_fund['id'];
if($policy_fund_id) {
	$policy_fund_view = "policy_fund_view.php?id=$policy_fund_id&w=u";
?>
										<a href="<?=$policy_fund_view?>"><img src="images/icon_erp_07.gif" border="0" alt="정책자금" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
if($row['electric_charges_no']) {
	$electric_charges_view = "electric_charges_view.php?id=$id&w=u";
?>
										<a href="<?=$electric_charges_view?>"><img src="images/icon_erp_09.gif" border="0" alt="전기요금컨설팅" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//지원대상확인
$sql_support_person = " select * from com_list_gy_memo where com_code='$id' and delete_yn='' ";
$result_support_person = sql_query($sql_support_person);
$row_support_person=mysql_fetch_array($result_support_person);
$support_person_idx = $row_support_person['idx'];
if($support_person_idx) {
	$support_person_view = "support_person_view.php?id=$id&w=u";
?>
										<a href="<?=$support_person_view?>"><img src="images/icon_erp_13.gif" border="0" alt="지원대상확인" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//신규고용확인
$sql_employment = " select * from com_employment where com_code='$id' and delete_yn='' ";
$result_employment = sql_query($sql_employment);
$row_employment=mysql_fetch_array($result_employment);
$employment_idx = $row_employment['idx'];
if($employment_idx) {
	$acceleration_employment_view = "acceleration_employment_view.php?id=$id&w=u";
?>
										<a href="<?=$acceleration_employment_view?>"><img src="images/icon_erp_10.gif" border="0" alt="신규고용확인" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//4대보험절감 161116
$sql_si4n_nhis = " select * from com_list_gy_opt2 c where c.com_code='$id' and ( c.si4n_nhis_chk='1' ) ";
$result_si4n_nhis = sql_query($sql_si4n_nhis);
$total_si4n_nhis = mysql_num_rows($result_si4n_nhis);
if($total_si4n_nhis) {
	$si4n_nhis_view = "si4n_nhis_view.php?id=$id&w=u";
?>
										<a href="<?=$si4n_nhis_view?>"><img src="images/icon_erp_14.png" border="0" alt="4대보험절감" style="vertical-align:middle;margin-bottom:4px;" /></a>
<? } ?>
<?
//주소, 지역별
if($stx_addr || $stx_area1 || $stx_area2 || $stx_area3 || $stx_area4 || $stx_area5 || $stx_area6 || $stx_area7 || $stx_area8 || $stx_area9 || $stx_area10 || $stx_area11 || $stx_area12 || $stx_area13 || $stx_area14 || $stx_area15 || $stx_area16 || $stx_area17) {
?>
										<div title="<?=$com_juso_full?>"><?=$com_juso?></title>
<?
}
?>
<?
//근로자수
if($stx_emp5_gbn || $stx_emp30_gbn) {
	$persons_gy = $row['persons_gy'];
	$persons_sj = $row['persons_sj'];
	if($persons_gy == "0") $persons_gy = "";
	if($persons_sj == "0") $persons_sj = "";
	echo "<br />";
	if($persons_gy) {
?>
											고용 <span style="color:blue"><?=$persons_gy?></span>
<?
	}
	if($persons_sj) {
?>
											산재 <span style="color:blue"><?=$persons_sj?></span>
<?
	}
	$persons = $row['persons'];
	$persons_temp = $row['persons_temp'];
	if($persons == "0") $persons = "";
	if($persons_temp == "0") $persons_temp = "";
	if($persons) {
?>
											정규직 <span style="color:blue"><?=$persons?></span>
<?
	}
	if($persons_temp) {
?>
											일용직 <span style="color:blue"><?=$persons_temp?></span>
<?
	}
}
?>
										</td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?><br><?=$registration_day?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span><br><span title="<?=$upjong_full?>"><?=$upjong?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$editdt_color?>"><?=$editdt?></span><br><span style="<?=$samu_receive_date_color?>"><?=$samu_receive_date?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_req_date_color?>"><?=$samu_req_date?></span><br><span style="<?=$samu_close_date_color?>"><?=$samu_close_date?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$agent_elect_public_edate_color?>"><?=$agent_elect_public_edate?></span><br><span style="<?=$agent_elect_center_edate_color?>"><?=$agent_elect_center_edate?></span></td>
										<td class="ltrow1_center_h22"><?=$job_time_if?><br><?=$easynomu_process?></td>
										<td class="ltrow1_center_h22"><?=$p_accept?></td>
										<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
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
												$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&$stx_qstr&page=");
												echo $pagelist;
												?>
											</div>
										</td>
									</tr>
								</table>
							</form>
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
