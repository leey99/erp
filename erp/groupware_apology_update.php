<?
$sub_menu = "700103";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//DB 필드, memo(위반내용)
$sql_common = " regdt = '$now_time',
						drafter_code = '$manage_cust_numb',
						drafter_name = '$manage_cust_name',
						dept_code = '$dept_code',
						doc_code = '$doc_code',
						subject = '$subject',
						subject_date = '$subject_date',
						approval1 = '$approval_1',
						approval2 = '$approval_2',
						approval3 = '$approval_3',
						approval4 = '$approval_4',
						approval5 = '$approval_5',

						memo = '$memo'
";

//상신 버튼 클릭
if($report_bt) {
	if ($w == 'u'){
		$sql = " update business_log set $sql_common , approval1_process=1, approval2_process=1, approval3_process=1, approval4_process=1, approval5_process=1 where id = '$id' ";
		sql_query($sql);
	} else {
		$sql_max = "select max(id) from business_log ";
		$result_max = sql_query($sql_max);
		$row_max = mysql_fetch_array($result_max);
		$id = $row_max[0]+1;
		$sql = " insert business_log set $sql_common , approval1_process=1, approval2_process=1, approval3_process=1, approval4_process=1, approval5_process=1, id='$id' ";
		sql_query($sql);
	}
	//결재라인에 포함된 결재자에게 알림 발송
	for($i=1; $i<=$approval_cnt; $i++) {
		$approval .= $_POST['approval_'.$i].",";
	}
	//로그인 정보 추출
	$damdang_code = 1;
	$mb_id = $member['mb_id'];
	$mb_name = $member['mb_name'];
	$mb_nick = $member['mb_nick'];
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];
	//업무일지 신규 등록 알림
	$wr_subject = $subject." 등록 되었습니다.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', user_code = '$manage_cust_numb', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$approval', wr_1 = '$id',
			wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '90013', alert_name = '시말서'
	";
	//echo $sql_alert;
	//exit;
	sql_query($sql_alert);
	alert("정상적으로 시말서가 상신 되었습니다.","groupware_business_log.php?stx_process=all");
} else {
	if ($w == 'u'){
		$sql = " update business_log set $sql_common where id = '$id' ";
		sql_query($sql);
	} else {
		$sql = " insert business_log set $sql_common ";
		sql_query($sql);
	}
	alert("정상적으로 시말서가 임시저장 되었습니다.","groupware_business_log.php?stx_process=all");
}
?>
