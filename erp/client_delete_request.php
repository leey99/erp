<?
$sub_menu = "100100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

$sql = "select * from $g4[com_list_gy] where com_code = '$id' ";
//echo $sql;
//exit;
$row = sql_fetch($sql);
if (!$row['com_code']) {
	$msg ="������ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	$wr_subject = $now_date." �ش� �ŷ�ó ������û�Դϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$mb_profile_code', branch_name = '$mb_profile', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$row[com_name]', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '90001', alert_name = '������û'
	";
	//echo $sql_alert;
	//exit;
	sql_query($sql_alert);
}
//exit;
goto_url("./client_list.php?page=".$page);
?>
