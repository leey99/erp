<?
$sub_menu = "1800300";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//õ�����޸� ����
$setting_pay = preg_replace('@,@','',$setting_pay);
$month_pay   = preg_replace('@,@','',$month_pay);

//����� �߰�����
$sql_common2 = " 
						settlement_day = '$settlement_day',
						settlement_day_last = '$settlement_day_last',

						easynomu_id = '$easynomu_id',
						easynomu_pw = '$easynomu_pw',

						service_day_start = '$service_day_start',
						service_day_end = '$service_day_end',

						setting_pay = '$setting_pay',
						month_pay = '$month_pay'
";
$sql_common_opt2 = " easynomu_process = '$easynomu_process',
						easynomu_finish_date = '$easynomu_finish_date',
						easynomu_close_date = '$easynomu_close_date',
						easynomu_memo = '$easynomu_memo'
";
//�߰� �ʵ� ������ ����
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

//�߰� �ʵ� ������ ����2
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
//echo $sql;
//echo $sql2;
//echo $sql_opt2;
//exit;
//$id = mysql_insert_id();

//����� ����
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
$branch2 = $man_cust_name_arry[$damdang_code2];

//�˸� DB ����� ������ select
//$row1 = mysql_fetch_array($result1);
$row2 = mysql_fetch_array($result2);

//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//���ÿϷ�
if($row2['easynomu_process'] != "3" && $easynomu_process == "3") {
	$wr_subject = $easynomu_finish_date." �Ǽ������� ���� �Ϸ� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '�����빫'
	";
	sql_query($sql_alert);
}
//����
if($row2['easynomu_process'] != "5" && $easynomu_process == "5") {
	$wr_subject = $easynomu_close_date." �Ǽ������� ���� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '�����빫'
	";
	sql_query($sql_alert);
}
//�˻� �Ķ���� ����
$qstr = $_POST['qstr'];
alert("���������� ������ ���� �Ǿ����ϴ�.$branch2","client_construction_view.php?id=".$id."&w=".$w."&page=".$page."&".$qstr."&".$stx_qstr);
//goto_url("./4insure_list.php");
?>