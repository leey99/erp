<?
$sub_menu = "1700101";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];
$com_code = $_POST['com_code'];
$sql_common = " regdt = '$now_time',
						mid = '$id',
						com_code = '$com_code',
						memo = '$memo',
						user_id = '$user_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
// 대상자 지정
if($send_to1) {
	$send_to = $send_to1.",";
}
if($send_to2) {
	$send_to .= $send_to2.",";
}
if($send_to3) {
	$send_to .= $send_to3.",";
}
if($send_to4) {
	$send_to .= $send_to4.",";
}
if($send_to5) {
	$send_to .= $send_to5.",";
}
if($send_to6) {
	$send_to .= $send_to6;
}
//수정
if ($w == 'u'){
	$sql = " update job_education_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 덧글이 수정 되었습니다.","job_education_memo.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert job_education_comment set 
					$sql_common 
					";
	sql_query($sql);
	//거래처 정보
	$sql_com = "select * from com_list_gy where com_code = '$com_code' ";
	//echo $sql_com;
	//exit;
	$row_com = sql_fetch($sql_com);
	$damdang_code = $row_com['damdang_code'];
	$damdang_code2 = $row_com['damdang_code2'];
	$firm_name = $row_com['com_name'];
	$cust_name = $row_com['boss_name'];
	$comp_bznb = $row_com['biz_no'];
	//담당자 설정
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	$branch2 = $man_cust_name_arry[$damdang_code2];
	//담당매니저 코드 체크
	$sql_manage = "select * from a4_manage where user_id = '$user_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	$wr_subject = $memo;
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$user_id',
			com_code = '$com_code' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '80003', alert_name = '직무교육', wr_1 = '$id'
	";
	sql_query($sql_alert);
	alert("정상적으로 덧글이 등록 되었습니다.","job_education_memo.php?id=$id");
}
?>