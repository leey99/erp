<?
$sub_menu = "1901000";
include_once("./_common.php");
echo "si4n_nhis_check_ok_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//����� ����
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " si4n_nhis_process = '$check_ok', si4n_nhis_editdt = '$now_time' ";
$sql = " update com_list_gy_opt2 set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
$sql_si4n_common = " si4n_user = '$mb_nick', si4n_editdt = '$now_time' ";
$sql_si4n = " update si4n_nhis set $sql_si4n_common where com_code = '$id' ";
sql_query($sql_si4n);
//����� �⺻���� ȣ��
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);
//����� �⺻���� ȣ��
$sql_com2 = "select * from com_list_gy_opt2 where com_code = '$id' ";
$row_com2 = sql_fetch($sql_com2);
$si4n_installment = $row_com2['si4n_installment'];
//4�뺸������������ DB
$sql2 = " select * from si4n_nhis where com_code='$id' ";
$row2 = sql_fetch($sql2);
$si4n_staff_cnt = $row2['si4n_staff_cnt'];
$si4n_fee = $row2['si4n_fee'];
$si4n_fee_choice = $row2['si4n_fee_choice'];
$si4n_setting = $row2['si4n_setting'];
$si4n_setting_date = $row2['si4n_setting_date'];
$si4n_change_date = $row2['si4n_change_date'];
$si4n_remainder = $row2['si4n_remainder'];
$si4n_remainder_date = $row2['si4n_remainder_date'];
$si4n_etc = $row2['si4n_etc'];
$si4n_memo1 = $row2['si4n_memo1'];
$si4n_memo2 = $row2['si4n_memo2'];

//�̷� ���� 161019
$sql_si4n_history = " insert si4n_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', si4n_nhis_process = '$check_ok', si4n_installment = '$si4n_installment', 
		si4n_staff_cnt = '$si4n_staff_cnt', si4n_fee = '$si4n_fee', si4n_fee_choice = '$si4n_fee_choice', 
		si4n_setting = '$si4n_setting', si4n_setting_date = '$si4n_setting_date', si4n_change_date = '$si4n_change_date', 
		si4n_remainder = '$si4n_remainder', si4n_remainder_date = '$si4n_remainder_date', 
		si4n_etc = '$si4n_etc', si4n_memo1 = '$si4n_memo1', si4n_memo2 = '$si4n_memo2'
";
sql_query($sql_si4n_history);

//����� ���� ����
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
//�ŷ�ó ���Ŵ��� �ڵ� 160322
$manage_cust_numb = $row_com_opt['manage_cust_numb'];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//ó����Ȳ ���������� ���� �� �豹�� ���� �˸� 161026
if($check_ok == 10) {
	if($row_com2['si4n_nhis_process'] != 10) {
		$wr_subject = "[4�뺸������] ���� �Ǿ����ϴ�.";
		$sql_alert = " insert erp_alert set 
				branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
				send_to = 'kcmc1009,', manage_code = '$manage_cust_numb',
				user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id',
				com_code = '$id', wr_1 = '', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
				alert_code = '10008', alert_name = '4�뺸������'
		";
		sql_query($sql_alert);
	}
}
alert("���������� Ȯ��üũ �Ǿ����ϴ�.","si4n_nhis_check_ok_update.php");
?>
