<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
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
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
}
//기본 검색어
$sql_search .= " and b.easynomu_yn = '1' ";

//검색 : 사업장명칭
if($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
//검색 : 사업장관리번호
if($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.t_insureno like '%$stx_t_no%') ";
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
//검색 : 지사
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code = '$stx_man_cust_name') ";
	$sql_search .= " ) ";
}
//검색 : 지사
if($stx_man_cust_name2) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.damdang_code2 = '$stx_man_cust_name2') ";
	$sql_search .= " ) ";
}
//검색 : 담당자
if($stx_manage_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.manage_cust_name = '$stx_manage_name') ";
	$sql_search .= " ) ";
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
//검색 : 업태
if($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
//검색 : 업종
if($stx_upjong) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upjong like '%$stx_upjong%') ";
	$sql_search .= " ) ";
}
//검색 : 의뢰서
if($stx_comp_gubun1) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.editdt != '') ";
	$sql_search .= " ) ";
}
//검색1 : 위탁서
if($stx_comp_gubun2) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.samu_receive_date != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(공단)
if($stx_comp_gubun3) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_public_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 대리인선임(센터)
if($stx_comp_gubun4) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.agent_elect_center_edate != '') ";
	$sql_search .= " ) ";
}
//검색1 : 이지노무
if($stx_comp_gubun5) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '1') ";
	$sql_search .= " ) ";
}
//검색1 : 키즈노무
if($stx_comp_gubun9) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.easynomu_yn = '2') ";
	$sql_search .= " ) ";
}
//검색2 : 지원금
if($stx_comp_gubun6) {
	$sql_search .= " and ( ";
	$sql_search .= " ( c.application_kind != '0' and c.application_kind != '' ) ";
	$sql_search .= " ) ";
}
//거래처구분 : 5인미만
if($stx_emp5_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp5_gbn != '0' and b.emp5_gbn != '' ) ";
	$sql_search .= " ) ";
}
//거래처구분 : 30인미만
if($stx_emp30_gbn) {
	$sql_search .= " and ( ";
	$sql_search .= " ( b.emp30_gbn != '0' and b.emp30_gbn != '' ) ";
	$sql_search .= " ) ";
}
//처리현황 : 프로그램
if ($easynomu_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (c.easynomu_process = '$easynomu_process') ";
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
//정렬
if(!$sst) {
	//$sst = "a.com_code";
	$sst = "b.service_day_start";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";

$sql = " select * $sql_common $sql_search $sql_order ";
$result = sql_query($sql);

//코드, 업체담당자명 161004
$cell = array("No","코드","등록일자","사업장명","우편번호","구번호","주소","사업자등록번호","사업장관리번호","신고수","시작일","종료일","월정액","전화번호","팩스번호","이메일","대표자","대표자HP","업체담당자","업태","관리점","담당자");

$now_date_file = date("Ymd");
$file_name = "이지노무_".$now_date_file.".xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<meta charset="euc-kr">
<style type="text/css">
table { font-size:10px; }
</style>
<table width="1200" border="1" cellspacing="1" cellpadding="3" bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align="center">
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
//리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	$no = $i + 1;
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
	$com_juso = cut_str($com_juso_full, 18, "..");
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
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
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
	$agent_elect_public_text = array("없음","처리중","완료","미접수","지사요청","회원가입","해지완료","해지요청");
	//대리인(공단)
	if($row['agent_elect_public_edate']) {
		$agent_elect_public_edate = $row['agent_elect_public_edate'];
	} else {
		if($row['agent_elect_public_date']) $agent_elect_public_edate = "접수";
		else $agent_elect_public_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_public_yn'] == ($k+1)) $agent_elect_public_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_public_edate >= $search_sday && $agent_elect_public_edate <= $search_eday) $agent_elect_public_edate_color = "color:red";
	else $agent_elect_public_edate_color = "";
	//전자민원(센터)
	if($row['agent_elect_center_edate']) {
		$agent_elect_center_edate = $row['agent_elect_center_edate'];
	} else {
		if($row['agent_elect_center_date']) $agent_elect_center_edate = "접수";
		else $agent_elect_center_edate = "-";
		for ($k=0; $k<=7; $k++) {
			if($row['agent_elect_center_yn'] == ($k+1)) $agent_elect_center_edate = $agent_elect_public_text[$k];
		}
	}
	if($agent_elect_center_edate >= $search_sday && $agent_elect_center_edate <= $search_eday) $agent_elect_center_edate_color = "color:red";
	else $agent_elect_center_edate_color = "";
	//이지노무
	$easynomu_process_array = Array("","기초셋팅중","급여셋팅중","완료","보류","해지","보완서류요청","세무관리");
	$easynomu_process_code = $row['easynomu_process'];
	if($row['easynomu_process']) $easynomu_process = $easynomu_process_array[$easynomu_process_code];
	else $easynomu_process = "-";
	//이지노무 결제일
	if($row['settlement_day']) $settlement_day = $row['settlement_day'];
	else $settlement_day = "-";
	if($row['settlement_day_last']) $settlement_day = "말일";
	//이지노무 세팅비 : 숫자형 변수 변환 150807
	if(!$row['setting_pay']) $row['setting_pay'] = 0;
	else $row['setting_pay'] = (int)$row['setting_pay'];
	$setting_pay = number_format($row['setting_pay']);
	if(!$setting_pay) $setting_pay = "-";
	//이지노무 월정액
	if(!$row['month_pay']) $row['month_pay'] = 0;
	else $row['month_pay'] = (int)$row['month_pay'];
	$month_pay = number_format($row['month_pay']);
	if(!$month_pay) $month_pay = "-";
	//서비스 시작일 종료일
	$service_day_start = $row['service_day_start'];
	if(!$service_day_start) $service_day_start = "-";
	$service_day_end = $row['service_day_end'];
	if(!$service_day_end) $service_day_end = "-";
	//진행취소, 보류 사업장 회색 블럭 표시
	if($easynomu_process_code == '5') {
		$tr_class = "list_row_now_gr";
		$program_text_cancel = "<span style='color:red;'>(해지)</span>";
	} else if($easynomu_process_code == '4') {
		$tr_class = "list_row_now_gr";
		$program_text_cancel = "<span style='color:red;'>(보류)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$program_text_cancel = "";
	}
	//피보험자 신고 카운트 161205
	$sql_common = " from samu_4insure ";
	$sql_search = " where com_code='$id' and delete_yn != '1' ";
	$order_by = " order by regdt desc, idx desc ";
	$sql_cnt = " select count(*) as cnt $sql_common $sql_search ";
	$row_cnt = sql_fetch($sql_cnt);
	$samu_count = $row_cnt['cnt'];
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$no?></td>
				<td align="center"><?=$id?></td>
				<td align="center"><?=$regdt?></td>
				<td align="left" width="194"><?=$com_name_full?></td>
				<td align="center"><?=$row['new_postno']?></td>
				<td align="center"><?=$row['com_postno']?></td>
				<td align="left" width="328"><?=$zip?><?=$com_juso_full?></td>
				<td align="center"><?=$biz_no?></td>
				<td align="center"><?=$t_insureno?></td>
				<td align="center"><?=$samu_count?></td>
				<td align="center"><?=$service_day_start?></td>
				<td align="center"><?=$service_day_end?></td>
				<td align="center"><?=$month_pay?></td>
				<td align="center"><?=$row['com_tel']?></td>
				<td align="center"><?=$row['com_fax']?></td>
				<td align="left"><?=$row['com_mail']?></td>
				<td align="center"><?=$boss_name?></td>
				<td align="center"><?=$row['boss_hp']?></td>
				<td align="center"><?=$com_damdang?></td>
				<td align="center"><?=$uptae?></td>
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

