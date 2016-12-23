<?
$sub_menu = "100101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile = $member['mb_profile'];

//전기공사 memo_type = 99
if($contractor || $contractor2 || $contractor3 || $contractor4) $memo_type = 99;

//전기공사 개별 전달사항 열람 160831 / 본사일 경우 전기공사 대상자 job_id 입력 161019
if($mb_profile == 1) {
	if($contractor) $job_id = "el1001";
	if($contractor2) $job_id = "el1002";
	if($contractor3) $job_id = "el1003";
	if($contractor4) $job_id = "el1004";
}
$sql_common = " regdt = '$now_time',
						com_code = '$id',
						memo_type = '$memo_type',
						memo = '$memo',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name',
						job_id = '$job_id',
						secret = '$secret'
";
//전기공사 알림 160706
//if($contractor) $send_to = "contractor,";
//else $send_to = "";
//전기공사 개별 전달사항 열람 160831
$send_to = "";
if($contractor) $send_to .= "el1001,";
if($contractor2) $send_to .= "el1002,";
if($contractor3) $send_to .= "el1003,";
if($contractor4) $send_to .= "el1004,";

// 대상자 지정
if($send_to1) {
	$send_to .= $send_to1.",";
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
	$send_to .= $send_to6.",";
}
if($send_to7) {
	$send_to .= $send_to7.",";
}
if($send_to8) {
	$send_to .= $send_to8.",";
}
if($send_to9) {
	$send_to .= $send_to9.",";
}
if($send_to10) {
	$send_to .= $send_to10.",";
}
if($send_to11) {
	$send_to .= $send_to11.",";
}
if($send_to12) {
	$send_to .= $send_to12.",";
}
if($send_to13) {
	$send_to .= $send_to13.",";
}
if($send_to14) {
	$send_to .= $send_to14;
}
//수정
if ($w == 'u'){
	$sql = " update com_list_gy_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 덧글이 수정 되었습니다.","popup_memo.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert com_list_gy_comment set 
					$sql_common 
					";
	sql_query($sql);
	//비밀글 알림 보내지 않음 151123
	if(!$secret) {
		//거래처 정보
		$sql_com = "select * from com_list_gy where com_code = '$id' ";
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
		$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$wr_subject = $memo;
		//신규고용확인 전달사항
		if($memo_type == 13) {
			$alert_code = "40004";
			$alert_name = "신규고용확인";
		} else {
			$alert_code = "80001";
			$alert_name = "전달사항";
		}
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
				send_to = '$send_to', manage_code = '$manage_cust_numb',
				user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
				com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				memo_type = '$memo_type', alert_code = '$alert_code', alert_name = '$alert_name', wr_1 = '$job_id'
		";
		sql_query($sql_alert);
	}
	//딜러 권한
	if($dealer == "ok") alert("정상적으로 덧글이 등록 되었습니다.","popup_memo_dealer.php?id=$id&amp;memo_type=$memo_type");
	//전기공사
	else if($dealer == "contractor") alert("정상적으로 덧글이 등록 되었습니다.","popup_memo_contractor.php?id=$id&amp;memo_type=$memo_type");
	else alert("정상적으로 덧글이 등록 되었습니다.","popup_memo.php?id=$id&amp;memo_type=$memo_type");
}
?>