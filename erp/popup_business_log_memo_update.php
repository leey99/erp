<?
$sub_menu = "700100";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$sql_common = " regdt = '$now_time',
						mid = '$id',
						memo = '$memo',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name',
						secret = '$secret'
";
// ����� ����
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
	$send_to .= $send_to11;
}
//����ڰ� ���� ��� ����ڸ� ���
if(!$send_to) $send_to = $drafter_id;
//����
if ($w == 'u'){
	$sql = " update business_log_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� ������ ���� �Ǿ����ϴ�.","popup_business_log_memo.php?id=$id&w=$w&idx=$idx");
//���
} else {
	$sql = " insert business_log_comment set 
					$sql_common 
					";
	sql_query($sql);
	//��б� �˸� ������ ���� 151123
	if(!$secret) {
		$damdang_code = 1;
		//����� ����
		$mb_profile_code = $member['mb_profile'];
		$mb_profile = $man_cust_name_arry[$mb_profile_code];
		$branch = "����";
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		if($memo_type == 1) {
			$alert_code = "90010";
			$alert_name = "��������";
		} else if($memo_type == 2) {
			$alert_code = "90012";
			$alert_name = "���½�û";
		} else if($memo_type == 3) {
			$alert_code = "90013";
			$alert_name = "�ø���";
		} else if($memo_type == 4) {
			$alert_code = "90014";
			$alert_name = "�ް���û";
		}
		$wr_subject = "[".$alert_name."] ".$memo;
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch',
				send_to = '$send_to', manage_code = '$manage_cust_numb',
				user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
				wr_datetime='$now_time', memo = '$wr_subject', 
				alert_code = '$alert_code', alert_name = '$alert_name', wr_1 = '$id'
		";
		sql_query($sql_alert);
	}
	alert("���������� ������ ��� �Ǿ����ϴ�.","popup_business_log_memo.php?id=$id&memo_type=$memo_type&drafter_id=$drafter_id");
}
?>