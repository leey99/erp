<?
$sub_menu = "100100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");
// ��ǥ���ڵ���
if($cust_cel1) $cust_cel = $cust_cel1."-".$cust_cel2."-".$cust_cel3;
//��ȭ��ȣ
if($cust_tel1) $cust_tel = $cust_tel1."-".$cust_tel2."-".$cust_tel3;
//�ѽ���ȣ
if($cust_fax1) $cust_fax = $cust_fax1."-".$cust_fax2."-".$cust_fax3;
//�������ȭ
if($damdang_cel1) $damdang_cel = $damdang_cel1."-".$damdang_cel2."-".$damdang_cel3;
//�����ȣ
if($adr_zip1) $adr_zip = $adr_zip1."-".$adr_zip2;

//ȸ��� ��ȭ��ȣ
if($treasurer_tel1) $treasurer_tel = $treasurer_tel1."-".$treasurer_tel2."-".$treasurer_tel3;
//ȸ��� �ѽ���ȣ
if($treasurer_fax1) $treasurer_fax = $treasurer_fax1."-".$treasurer_fax2."-".$treasurer_fax3;

//÷������ ���
$upload_dir = 'files/contract/';
$pic_name_sql_1 = "";
$pic_name_sql_2 = "";
$pic_name_sql_3 = "";
$pic_name_sql_4 = "";
$pic_name_sql_5 = "";
$pic_name_sql_6 = "";
$pic_name_sql_7 = "";
$pic_name_sql_8 = "";

//÷�μ��� ���� ���
if($file_del_1 == 1) {
	$filename = $upload_dir.$file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_2 == 1) {
	$filename = $upload_dir.$file_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_3 == 1) {
	$filename = $upload_dir.$file_3;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(3)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_4 == 1) {
	$filename = $upload_dir.$file_4;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(4)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_5 == 1) {
	$filename = $upload_dir.$file_5;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(5)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_6 == 1) {
	$filename = $upload_dir.$file_6;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(6)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_7 == 1) {
	$filename = $upload_dir.$file_7;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(7)�� �������� �ʽ��ϴ�.";
	}
}
if($file_del_8 == 1) {
	$filename = $upload_dir.$file_8;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(8)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1
if($_FILES['filename_1']['tmp_name']) {
	$pic_name1 = $_FILES['filename_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_1']['tmp_name'], $upload_file);
}
if($pic_name1) {
	$pic_name_sql_1 = " filename_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_1 == 1) $pic_name_sql_1 = " filename_1 = '', ";
}
//÷�μ���2
if($_FILES['filename_2']['tmp_name']) {
	$pic_name2 = $_FILES['filename_2']['name'];
	$upload_file_name = $now_time_file."_".$pic_name2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_2']['tmp_name'], $upload_file);
}
if($pic_name2) {
	$pic_name_sql_2 = " filename_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_2 == 1) $pic_name_sql_2 = " filename_2 = '', ";
}
//÷�μ���3
if($_FILES['filename_3']['tmp_name']) {
	$pic_name3 = $_FILES['filename_3']['name'];
	$upload_file_name = $now_time_file."_".$pic_name3;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_3']['tmp_name'], $upload_file);
}
if($pic_name3) {
	$pic_name_sql_3 = " filename_3 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_3 == 1) $pic_name_sql_3 = " filename_3 = '', ";
}
//÷�μ���4
if($_FILES['filename_4']['tmp_name']) {
	$pic_name4 = $_FILES['filename_4']['name'];
	$upload_file_name = $now_time_file."_".$pic_name4;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_4']['tmp_name'], $upload_file);
}
if($pic_name4) {
	$pic_name_sql_4 = " filename_4 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_4 == 1) $pic_name_sql_4 = " filename_4 = '', ";
}
//÷�μ���5
if($_FILES['filename_5']['tmp_name']) {
	$pic_name5 = $_FILES['filename_5']['name'];
	$upload_file_name = $now_time_file."_".$pic_name5;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_5']['tmp_name'], $upload_file);
}
if($pic_name5) {
	$pic_name_sql_5 = " filename_5 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_5 == 1) $pic_name_sql_5 = " filename_5 = '', ";
}
//÷�μ���6
if($_FILES['filename_6']['tmp_name']) {
	$pic_name6 = $_FILES['filename_6']['name'];
	$upload_file_name = $now_time_file."_".$pic_name6;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_6']['tmp_name'], $upload_file);
}
if($pic_name6) {
	$pic_name_sql_6 = " filename_6 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_6 == 1) $pic_name_sql_6 = " filename_6 = '', ";
}
//÷�μ���7
if($_FILES['filename_7']['tmp_name']) {
	$pic_name7 = $_FILES['filename_7']['name'];
	$upload_file_name = $now_time_file."_".$pic_name7;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_7']['tmp_name'], $upload_file);
}
if($pic_name7) {
	$pic_name_sql_7 = " filename_7 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_7 == 1) $pic_name_sql_7 = " filename_7 = '', ";
}
//÷�μ���8
if($_FILES['filename_8']['tmp_name']) {
	$pic_name8 = $_FILES['filename_8']['name'];
	$upload_file_name = $now_time_file."_".$pic_name8;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['filename_8']['tmp_name'], $upload_file);
}
if($pic_name8) {
	$pic_name_sql_8 = " filename_8 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_del_8 == 1) $pic_name_sql_8 = " filename_8 = '', ";
}

//÷������ ��� �����빫
$upload_dir = 'files/easynomu/';
$easynomu_fname_sql_1 = "";
$easynomu_fname_sql_2 = "";

//÷�μ��� ���� ��� �����빫
if($file_easynomu_del_1 == 1) {
	$filename = $upload_dir.$feasynomu_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(1)�� �������� �ʽ��ϴ�.";
	}
}
if($file_easynomu_del_2 == 1) {
	$filename = $upload_dir.$feasynomu_2;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "����(2)�� �������� �ʽ��ϴ�.";
	}
}
//÷�μ���1 �����빫
if($_FILES['file_easynomu_1']['tmp_name']) {
	$easynomu_fname1 = $_FILES['file_easynomu_1']['name'];
	$upload_file_name = $now_time_file."_".$easynomu_fname1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['file_easynomu_1']['tmp_name'], $upload_file);
}
if($easynomu_fname1) {
	$easynomu_fname_sql_1 = " file_easynomu_1 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_easynomu_del_1 == 1) $easynomu_fname_sql_1 = " file_easynomu_1 = '', ";
}
//÷�μ���2 �����빫
if($_FILES['file_easynomu_2']['tmp_name']) {
	$easynomu_fname2 = $_FILES['file_easynomu_2']['name'];
	$upload_file_name = $now_time_file."_".$easynomu_fname2;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['file_easynomu_2']['tmp_name'], $upload_file);
}
if($easynomu_fname2) {
	$easynomu_fname_sql_2 = " file_easynomu_2 = '".addslashes($upload_file_name)."', ";
} else {
	if($file_easynomu_del_2 == 1) $easynomu_fname_sql_2 = " file_easynomu_2 = '', ";
}

//�ű� ��Ͻ� �Ƿڼ��������� �ڵ� ��� 
if ($w != 'u') {
	$editdt = $now_date;
	$editdt_chk = '1';
	$sql_common_regdt = " regdt = '$now_date', regdt_time = '$now_time', regdt_id = '$member[mb_id]', ";
} else {
	$sql_common_regdt = "";
}

//õ�����޸� ����
$bonus_money = str_replace(',','',$bonus_money);
$setting_pay = str_replace(',','',$setting_pay);
$month_pay = str_replace(',','',$month_pay);

//����� �⺻����
$sql_common = " com_name = '$firm_name',
						damdang_code = '$damdang_code',
						damdang_code2 = '$damdang_code2',
						upche_div = '$comp_type',
						biz_no = '$comp_bznb',
						bupin_no = '$bupin_no',

						uptae = '$uptae',
						uptae_code = '$uptae_code',
						upjong_code = '$upjong_code',
						upjong = '$upjong',
						jongmok = '$jongmok',

						t_insureno = '$t_insureno',

						boss_name = '$cust_name',
						jumin_no = '$cust_ssnb',

						boss_hp = '$cust_cel',
						com_tel = '$cust_tel',
						com_fax = '$cust_fax',

						treasurer_name = '$treasurer_name',
						treasurer_tel = '$treasurer_tel',
						treasurer_fax = '$treasurer_fax',
						treasurer_adr_zip1 = '$treasurer_adr_zip1',
						treasurer_adr_zip2 = '$treasurer_adr_zip2',
						treasurer_adr_adr1 = '$treasurer_adr_adr1',
						treasurer_adr_adr2 = '$treasurer_adr_adr2',

						com_damdang = '$damdang_name',

						$sql_common_regdt
						editdt = '$editdt',

						com_postno = '$adr_zip',
						new_postno = '$new_zip',
						com_juso = '$adr_adr1',
						com_juso2 = '$adr_adr2',
						com_mail = '$cust_email',

						electric_charges_no = '$electric_charges_no',
						electric_charges_ssnb = '$electric_charges_ssnb',
						electric_charges_bupin = '$electric_charges_bupin',
						electric_charges_memo = '$electric_charges_memo'
";

//÷�μ��� üũ
for($i=1;$i<=10;$i++) {
	$file_check_var .= $_POST['file_check'.$i].",";
}
for($i=1;$i<=4;$i++) {
	$file_easynomu_var .= $_POST['file_easynomu'.$i].",";
}
//����� �߰�����
$sql_common2 = " com_name_opt = '$firm_name',
						jongmok = '$jongmok',
						password = '$user_pass',
						registration_day = '$cntr_sdate',
						cntr_sdate = '$cntr_sdate',
						com_damdang_tel = '$damdang_cel',
						emp5_gbn = '$emp5_gbn',

						manage_cust_numb = '$manage_cust_numb',
						manage_cust_name = '$manage_cust_name',

						employment_report = '$employment_report',
						employment_report_date = '$employment_report_date',
						persons = '$persons',
						persons_temp = '$persons_temp',

						emp30_gbn = '$emp30_gbn',
						emp0_gbn = '$emp0_gbn',
						persons_gy = '$persons_gy',
						persons_sj = '$persons_sj',

						boss_mail = '$boss_mail',

						$pic_name_sql_1
						$pic_name_sql_2
						$pic_name_sql_3
						$pic_name_sql_4
						$pic_name_sql_5
						$pic_name_sql_6
						$pic_name_sql_7
						$pic_name_sql_8

						$easynomu_fname_sql_1
						$easynomu_fname_sql_2

						editdt_chk = '$editdt_chk',

						memo = '$memo',

						file_check = '$file_check_var',
						file_easynomu = '$file_easynomu_var',
						file_etc = '$file_etc'
";
//����� �߰�����2
$sql_common_opt2 = " com_name_opt2 = '$firm_name',
						memo_total = '$memo_total'
";
//����� �⺻����
$sql_base = " select * from com_list_gy where com_code='$id' ";
$result_base = sql_query($sql_base);
$row = mysql_fetch_array($result_base);
//����� �߰�����
$sql_opt = " select * from com_list_gy_opt where com_code='$id' ";
$result_opt = sql_query($sql_opt);
$row_opt = mysql_fetch_array($result_opt);

//�߰� �ʵ� ������ ����
$sql1 = " select * from com_list_gy_opt where com_code='$id' ";
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//�߰� �ʵ� ������ ����2
$sql2 = " select * from com_list_gy_opt2 where com_code='$id' ";
$result2 = sql_query($sql2);
$total2 = mysql_num_rows($result2);

if ($w == 'u'){
	//÷�μ��� üũ
	$result1 = sql_query($sql1);
	$row1 =   mysql_fetch_array($result1);
	$file_check = explode(',',$row1['file_check']);
	//echo $sql1;
	//echo $row1['file_check'];
	$file_easynomu = explode(',',$row1['file_easynomu']);
} else {
	$file_check = array("","","","","","","","","","","","","","","");
	$file_easynomu = array("","","","","","","","","","","","","","","");
}

//�����
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_profile_code = $member['mb_profile'];
$mb_profile = $man_cust_name_arry[$mb_profile_code];
$branch = $man_cust_name_arry[$damdang_code];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//����
if($w == 'u') {
	$sql = " update $g4[com_list_gy] set 
				$sql_common 
			  where com_code = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
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
//���
} else {
	$sql_max = "select max(com_code) from $g4[com_list_gy] ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;

	$sql = " insert $g4[com_list_gy] set 
					$sql_common 
					, com_code = '$id' ";
	sql_query($sql);
	$sql2 = " insert com_list_gy_opt set 
				$sql_common2 
				, com_code = '$id' ";
	sql_query($sql2);
	$sql_opt2 = " insert com_list_gy_opt2 set 
				$sql_common_opt2 
				, com_code = '$id' ";
	sql_query($sql_opt2);

	//�űԵ�� �˸�
	$wr_subject = $now_date." �űԵ�� �Ǿ����ϴ�.";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10001', alert_name = '�űԵ��'
	";
	sql_query($sql_alert);
}

//�������Ƿڼ�
if($file_check[0] != $file_check1) {
	$wr_subject = $now_date." ÷�μ���(�������Ƿڼ�) ��� �Ǿ����ϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10002', alert_name = '�Ƿڼ�����'
	";
	sql_query($sql_alert);
}
//��༭ : ������ ���� ���� 150923
if($file_check[1] != $file_check2) {
	$wr_subject = $now_date." ÷�μ���(��༭) ��� �Ǿ����ϴ�.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10003', alert_name = '��༭����'
	";
	sql_query($sql_alert);
}
//�繫��Ź��
if($file_check[2] != $file_check3) {
	$wr_subject = $now_date." ÷�μ���(�繫��Ź��) ��� �Ǿ����ϴ�.";
	$send_to = "kcmc1007";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '15000', alert_name = '��Ź������'
	";
	sql_query($sql_alert);
}
//�븮�μ���(����)
if($file_check[3] != $file_check4) {
	$wr_subject = $now_date." ÷�μ���(�븮�μ���(����)) ��� �Ǿ����ϴ�.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20001', alert_name = '�븮�μ���(����)'
	";
	sql_query($sql_alert);
}
//���ڹο�(����)
if($file_check[3] != $file_check4) {
	$wr_subject = $now_date." ÷�μ���(���ڹο�(����)) ��� �Ǿ����ϴ�.";
	$send_to = "kcmc1008";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '20002', alert_name = '�븮�μ���(����)'
	";
	sql_query($sql_alert);
}
//�����빫
if($file_easynomu[0] != $file_easynomu1) {
	$wr_subject = $now_date." ÷�μ���(�����빫) ��� �Ǿ����ϴ�.";
	$send_to = "kcmc1009";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '�����빫'
	";
	sql_query($sql_alert);
}
//�Ǽ� �ŷ�ó ��� �˸�
$strpos_text = "�Ǽ�";
if(strpos($row['uptae'], $strpos_text) === false && strpos($uptae, $strpos_text) !== false) {
	$wr_subject = $now_date." �Ǽ� �ŷ�ó�� ��� �Ǿ����ϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10004', alert_name = '�Ǽ���ü'
	";
	sql_query($sql_alert);
}
//��������ȯ�� �˸�
if( ($row_opt['family_work_if'] != "1" && $family_work_if == "1" ) || ($row_opt['refund_request'] != "1" && $refund_request == "1") ) {
	$wr_subject = $now_date." ��������ȯ�޽�û �Ƿڰ� �ֽ��ϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10005', alert_name = '��������'
	";
	sql_query($sql_alert);
}
//�����빫 �Ƿ� �˸�
if(strpos($row_opt['easynomu_request'], "1") === false && strpos($easynomu_request, "1") !== false) {
	$wr_subject = $now_date." �����빫 �Ƿڰ� �ֽ��ϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', 
			send_to = '$send_to',
			user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			com_code = '$id' , com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '50001', alert_name = '�����빫'
	";
	sql_query($sql_alert);
}
//�ð������� �˸�
if($row['job_time_if'] != "1" && $job_time_if == "1") {
	//�湮���� �̵�� ��
	if(!$visitdt) $visitdt = "�湮����";	
	if(!$visitdt_time) $visitdt_time = "����";
	//�ð������� �ű� ��� �˸�
	$wr_subject = $visitdt."(".$visitdt_time.") �ð������� �湮�����Դϴ�.";
	$send_to = "manager";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$com_code' , wr_1 = '$job_time_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '40003', alert_name = '�ð�������'
	";
	sql_query($sql_alert);
}
//���������� �˸�
if($row['electric_charges_no'] == "" && $electric_charges_no != "") {
/*
	//��� �ŷ�ó ������ �˸� ���� 160411
	//���������� �ű� ��� �˸�
	$wr_subject = $now_date." ������������ ���� �Ǿ����ϴ�.";
	//��ǥ�� ���̵�
	$send_to = "kcmc1001";
	//���������� ������ ID
	$electric_charges_id = "";
	$sql_alert = " insert erp_alert set 
			branch = '$damdang_code', branch_name = '$branch', branch2 = '$damdang_code2', branch_name2 = '$branch2', user_code = '$manage_code', user_name = '$mb_name', user_id = '$mb_id', 
			send_to = '$send_to',
			com_code = '$id' , wr_1 = '$electric_charges_id', com_name = '$firm_name', boss_name = '$cust_name', biz_no = '$comp_bznb', wr_datetime='$now_time', memo = '$wr_subject', 
			alert_code = '10006', alert_name = '������������'
	";
	sql_query($sql_alert);
*/
	//������������ ���� �Ͻ� ����� �⺻ ���� DB�� ����
	$sql_electric_charges_regdt = " update com_list_gy set electric_charges_regdt = '$now_time' where com_code = '$id' ";
	sql_query($sql_electric_charges_regdt);
}
if($w == 'u') {
	alert("���������� �ŷ�ó�� ���� �Ǿ����ϴ�.","client_view_dealer.php?id=$id&w=$w&page=$page");
}else{
	alert("���������� �ŷ�ó�� ��� �Ǿ����ϴ�.","main.php");
}
?>