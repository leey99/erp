<?
$sub_menu = "100101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile = $member['mb_profile'];

//������� memo_type = 99
if($contractor || $contractor2 || $contractor3 || $contractor4) $memo_type = 99;

//������� ���� ���޻��� ���� 160831 / ������ ��� ������� ����� job_id �Է� 161019
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
//������� �˸� 160706
//if($contractor) $send_to = "contractor,";
//else $send_to = "";
//������� ���� ���޻��� ���� 160831
$send_to = "";
if($contractor) $send_to .= "el1001,";
if($contractor2) $send_to .= "el1002,";
if($contractor3) $send_to .= "el1003,";
if($contractor4) $send_to .= "el1004,";

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
//����
if ($w == 'u'){
	$sql = " update com_list_gy_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� ������ ���� �Ǿ����ϴ�.","popup_memo.php?id=$id&w=$w&idx=$idx");
//���
}else{
	$sql = " insert com_list_gy_comment set 
					$sql_common 
					";
	sql_query($sql);
	//��б� �˸� ������ ���� 151123
	if(!$secret) {
		//�ŷ�ó ����
		$sql_com = "select * from com_list_gy where com_code = '$id' ";
		$row_com = sql_fetch($sql_com);
		$damdang_code = $row_com['damdang_code'];
		$damdang_code2 = $row_com['damdang_code2'];
		$firm_name = $row_com['com_name'];
		$cust_name = $row_com['boss_name'];
		$comp_bznb = $row_com['biz_no'];
		//����� ����
		$mb_profile_code = $member['mb_profile'];
		$mb_profile = $man_cust_name_arry[$mb_profile_code];
		$branch = $man_cust_name_arry[$damdang_code];
		$branch2 = $man_cust_name_arry[$damdang_code2];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$wr_subject = $memo;
		//�ű԰��Ȯ�� ���޻���
		if($memo_type == 13) {
			$alert_code = "40004";
			$alert_name = "�ű԰��Ȯ��";
		} else {
			$alert_code = "80001";
			$alert_name = "���޻���";
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
	//���� ����
	if($dealer == "ok") alert("���������� ������ ��� �Ǿ����ϴ�.","popup_memo_dealer.php?id=$id&amp;memo_type=$memo_type");
	//�������
	else if($dealer == "contractor") alert("���������� ������ ��� �Ǿ����ϴ�.","popup_memo_contractor.php?id=$id&amp;memo_type=$memo_type");
	else alert("���������� ������ ��� �Ǿ����ϴ�.","popup_memo.php?id=$id&amp;memo_type=$memo_type");
}
?>