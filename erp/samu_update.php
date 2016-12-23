<?
$sub_menu = "400100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//사업장 기본정보
$sql_common = " 
						samu_state_gy = '$samu_state_gy',
						samu_state_sj = '$samu_state_sj',
						levy_kind = '$levy_kind',
						employer_insure = '$employer_insure',
						samu_discharge_date_gy = '$samu_discharge_date_gy',
						samu_discharge_date_sj = '$samu_discharge_date_sj',
						samu_branch = '$samu_branch',
						samu_charge = '$samu_charge',

						fax_error = '$fax_error',
						fax_error2 = '$fax_error2',
						fax_error3 = '$fax_error3'
";
//위탁번호 자동 생성
if($samu_req_date && !$samu_receive_no) {
	$sql_samu_receive_no = " select max(samu_receive_no) max_samu_receive_no from com_list_gy_opt ";
	$row_samu_receive_no = sql_fetch($sql_samu_receive_no);
	$max_samu_receive_no = $row_samu_receive_no['max_samu_receive_no'];
	$max_samu_receive_no = (int)$max_samu_receive_no;
	$samu_receive_no = $max_samu_receive_no + 1;
}
//사업장 추가정보 (관리자 전용)
$sql_common2 = " samu_receive_chk = '$samu_receive_chk',
						samu_receive_date = '$samu_receive_date',
						samu_receive_no = '$samu_receive_no',
						samu_receive_no_old = '$samu_receive_no_old',
						samu_req_yn = '$samu_req_yn',
						samu_req_date = '$samu_req_date',
						samu_close_date = '$samu_close_date',

						health_req_yn = '$health_req_yn',
						health_req_date = '$health_req_date',
						health_close_date = '$health_close_date',
						sj_rate = '$sj_rate',

						emp5_gbn = '$emp5_gbn',
						emp30_gbn = '$emp30_gbn',
						emp0_gbn = '$emp0_gbn',
						persons_gy = '$persons_gy',
						persons_sj = '$persons_sj'
";
//사업장 추가정보 2
$sql_common_opt2 = " samu_call_date = '$samu_call_date',
						samu_feedback_memo = '$samu_feedback_memo'
";
//기본 필드 데이터 추가/수정
$sql = " update com_list_gy set 
			$sql_common 
			where com_code = '$id' ";
sql_query($sql);
//추가 필드 데이터 유무
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
if($total1) {
	$sql2 = " update com_list_gy_opt set 
				$sql_common2 
				where com_code = '$id' ";
} else {
	$sql2 = " insert com_list_gy_opt set 
				$sql_common2 
				, com_code = '$id' ";
}
sql_query($sql2);
//추가 필드 데이터 유무2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$total2 = mysql_num_rows($result2);
if($total2) {
	$sql_opt2 = " update com_list_gy_opt2 set 
				$sql_common_opt2 
				where com_code = '$id' ";
} else {
	$sql_opt2 = " insert com_list_gy_opt2 set 
				$sql_common_opt2 
				, com_code = '$id' ";
}
sql_query($sql_opt2);

$row1 = mysql_fetch_array($result1);
$row2 = mysql_fetch_array($result2);

//담당자 설정
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];
//담당매니저 코드 체크
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//사무위탁 이력 DB 저장
if($row1['samu_receive_no'] == "0") $samu_receive_no_db = "";
if($row1['samu_req_yn'] != $samu_req_yn || $row1['samu_req_date'] != $samu_req_date || $row1['samu_receive_no'] != $samu_receive_no || $row1['samu_close_date'] != $samu_close_date) {
	$sql_samu_history = " insert samu_history set 
			com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', samu_req_yn = '$samu_req_yn', samu_req_date = '$samu_req_date', samu_receive_no = '$samu_receive_no', samu_close_date = '$samu_close_date'
	";
	sql_query($sql_samu_history);
}

//위탁서접수
if($row1['samu_receive_date'] != $samu_receive_date) {
	$wr_subject = $samu_receive_date." 위탁서 서류도착 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15000', alert_name = '위탁서접수'
	";
	sql_query($sql_alert);
}
//사무위탁 수임가능
if($row1['samu_req_yn'] != "2" && $samu_req_yn == "2") {
	$wr_subject = $now_date." 사무위탁 수임가능 합니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//사무위탁 수임
if($row1['samu_req_yn'] != "4" && $samu_req_yn == "4") {
	$wr_subject = $samu_req_date." 사무위탁 수임 신고 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}
//사무위탁 해지
if($row1['samu_req_yn'] != "5" && $samu_req_yn == "5") {
	$wr_subject = $samu_close_date." 사무위탁 해지 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15001', alert_name = '사무위탁'
	";
	sql_query($sql_alert);
}

alert("정상적으로 사무위탁 정보가 수정 되었습니다.","samu_view.php?id=$id&w=$w&page=$page");
?>